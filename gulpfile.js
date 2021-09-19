'use strict';

const { series, parallel } = require( 'gulp' );
const browserSync = require( 'browser-sync' ).create();
const gulp = require( 'gulp' );
const rtlcss = require( 'gulp-rtlcss' );
const rename = require( 'gulp-rename' );
const concat = require( 'gulp-concat' );
const autoprefixer = require( 'gulp-autoprefixer' );
const sass = require( 'gulp-sass' );
sass.compiler = require( 'node-sass' );

const sassSrc = './assets/src/sass/';
const editorSrc = './assets/src/editor/';
const jsSrc = './assets/src/js/';
const cssDest = './assets/css/';
const jsDest = './assets/js/';

const sassTask = ( cb ) => {
	return gulp.src( sassSrc + 'style.scss' )
		.pipe( sass().on( 'error', sass.logError ) )
		.pipe( autoprefixer( { cascade: false } ) )
		.pipe( gulp.dest( cssDest ) )
		.pipe( browserSync.stream() );
	cb();
};

const editorStylesTask = ( cb ) => {
	return gulp.src( editorSrc + 'editor-style.scss' )
		.pipe( sass().on( 'error', sass.logError ) )
		.pipe( autoprefixer( { cascade: false } ) )
		.pipe( gulp.dest( cssDest ) )
		.pipe( browserSync.stream() );
	cb();
}

const rtlCssTask = ( cb ) => {
	return gulp.src( cssDest + 'style.css' )
		.pipe( rtlcss() )
		.pipe( rename( 'style-rtl.css' ) )
		.pipe( gulp.dest( cssDest ) );
	cb();
};

const vendorScriptsTask = ( cb ) => {
	return gulp.src( [ './node_modules/simplebar/dist/simplebar.js' ] )
		.pipe( concat( 'scripts.js' ) )
		.pipe( gulp.dest( './assets/js' ) );
	cb();
}

const cssConcatExternalTask = ( cb ) => {
	return gulp.src( [ './node_modules/simplebar/dist/simplebar.css', cssDest + 'style.css' ] )
		.pipe( concat( 'style.css' ) )
		.pipe( gulp.dest( cssDest ) );
	cb();
}

function liveServerTask( cb ) {
	browserSync.init( {
		proxy: 'knowledge-base.local',
	} );
	gulp.watch( [ sassSrc + '**/*.scss' ] ).on( 'change', series(sassTask, cssConcatExternalTask) );
	gulp.watch( './**/*.php' ).on( 'change', browserSync.reload );
	cb();
}

exports.default = series( sassTask, cssConcatExternalTask, vendorScriptsTask, liveServerTask );
exports.rtlcss = series( rtlCssTask );
exports.editor = editorStylesTask;
