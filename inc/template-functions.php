<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package KnowPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function knowpress_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'knowpress_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function knowpress_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'knowpress_pingback_header' );

if ( ! function_exists( 'knowpress_theme_settings' ) ) {
	function knowpress_theme_settings() {

		if( is_admin() ) {
			global $current_screen;
			$in_editor = method_exists($current_screen, 'is_block_editor') &&
			             $current_screen->is_block_editor();
			if( !$in_editor ) { return; }
		}

		$vars = ':root {	
	            --knowpress-primary-color: ' . get_theme_mod( "knowpress_primary_color", "#0090AD" ) . ';
	            --knowpress-primary-text-color: ' . get_theme_mod( "knowpress_primary_text_color", "#242A31" ) . ';
	            --knowpress-secondary-text-color: ' . get_theme_mod( "knowpress_secondary_text_color", "#4D5A66" ) . ';
	            --knowpress-sidebar-color: ' . get_theme_mod( "knowpress_sidebar_color", "#f6f8fa" ) . ';
	            --knowpress-border-color: ' . get_theme_mod( "knowpress_border_color", "#E2E8EE" ) . ';
	            --knowpress-card-bg-color: ' . get_theme_mod( "knowpress_card_bg_color", "#F5F7F9" ) . ';
	            --knowpress-message-bg-color: ' . get_theme_mod( "knowpress_message_bg", "#EBFCFF" ) . ';
	            --knowpress-message-border-color: ' . get_theme_mod( "knowpress_message_border", "#0090AD" ) . ';
	            --knowpress-warning-bg-color: ' . get_theme_mod( "knowpress_warning_bg", "#FEFAEB" ) . ';
	            --knowpress-warning-border-color: ' . get_theme_mod( "knowpress_warning_border", "#F2BB08" ) . ';
	            --knowpress-danger-bg-color: ' . get_theme_mod( "knowpress_danger_bg", "#FBEEEF" ) . ';
	            --knowpress-danger-border-color: ' . get_theme_mod( "knowpress_danger_border", "#D4303B" ) . ';
	            --knowpress-list-bg-color: ' . get_theme_mod( "knowpress_list_bg", "#F5F7F9" ) . ';
	            --knowpress-list-border-color: ' . get_theme_mod( "knowpress_list_border", "#0090AD" ) . ';
			}';

		$mobile_base_font        = get_theme_mod( 'text_typography_m', false );
		$mobile_base_font_styles = "";
		if ( $mobile_base_font ) {
			$mobile_base_font_styles = "@media (max-width: 576px) { html {font-size:" . $mobile_base_font['font-size'] . " !important; line-height:" . $mobile_base_font['line-height'] . " !important; }}";
		}

		?>
        <style>
            <?php echo esc_html($vars); ?>
            <?php echo esc_html($mobile_base_font_styles); ?>
        </style>
		<?php
	}
}
add_action( 'wp_head', 'knowpress_theme_settings' );
add_action( 'admin_head', 'knowpress_theme_settings' );

add_action( 'enqueue_block_editor_assets',
	function () {
		wp_enqueue_script( 'knowpress-editor-blocks-script',
			get_template_directory_uri() . '/assets/js/editor-script.js',
			array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
			wp_get_theme()->get( 'Version' ) );
	} );

