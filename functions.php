<?php
/**
 * KnowPress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KnowPress
 */

if ( ! defined( 'KNWOPRESS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$knowpress_theme_data = wp_get_theme();
	define( 'KNWOPRESS_VERSION', $knowpress_theme_data->get( 'Version' ) );
}

if ( ! function_exists( 'knowpress_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function knowpress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'knowpress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'knowpress', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Add editor style support */
		add_theme_support( 'editor-styles' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'knowpress' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'knowpress_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for custom background
		add_theme_support( "custom-background" );

		// Add theme support for custom header
		add_theme_support( 'custom-header' );
		knowpress_custom_header_setup();

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 50,
				'width'       => 200,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'knowpress_setup' );

/**
 * Registers an editor stylesheet for the theme.
 */
add_action( 'enqueue_block_editor_assets',
	function () {
		wp_enqueue_style( 'knowpress-editor-styles',
			get_template_directory_uri() . '/assets/css/editor-style.css',
			false,
			wp_get_theme()->get( 'Version' ) );
	} );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function knowpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'knowpress_content_width', 640 );
}

add_action( 'after_setup_theme', 'knowpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function knowpress_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Left Side', 'knowpress' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'knowpress' ),
			'before_widget' => '<section id="%1$s" class="c-widget s-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="c-widget__title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Right Side', 'knowpress' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'knowpress' ),
			'before_widget' => '<section id="%1$s" class="c-widget s-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="c-widget__title">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'knowpress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function knowpress_scripts() {
	wp_enqueue_style( 'knowpress-style',
		get_template_directory_uri() . '/assets/css/style.css',
		array(),
		KNWOPRESS_VERSION );
	wp_style_add_data( 'knowpress-style', 'rtl', 'replace' );

	wp_enqueue_script( 'knowpress-scripts-vendor',
		get_template_directory_uri() . '/assets/js/scripts.js',
		array(),
		KNWOPRESS_VERSION,
		true );
	wp_enqueue_script( 'knowpress-scripts',
		get_template_directory_uri() . '/assets/js/main.js',
		array( 'jquery' ),
		KNWOPRESS_VERSION,
		true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'knowpress_scripts' );

/**
 * Walker_Page extended class
 */
require get_template_directory() . '/classes/Knowpress_page_walker.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load TGMPA file
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa-config.php';
