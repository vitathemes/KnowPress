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
add_action( 'enqueue_block_editor_assets', 'knowpress_theme_settings' );

// Get fonts in editor
if ( ! function_exists( 'knowpress_editor_fonts' ) ) {
	function knowpress_editor_fonts() {
		if ( ! function_exists( 'kirki' ) ) {
		    return;
		}
		?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<?php
		if ( ! function_exists( 'kirki' ) ) {
			wp_enqueue_style( 'knowpress-editor-google-font',
				 'https://fonts.googleapis.com/css2?family=Inter&display=swap',
				false,
				wp_get_theme()->get( 'Version' ) );

			wp_enqueue_style( 'knowpress-editor-google-font-inter',
				'https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap',
				false,
				wp_get_theme()->get( 'Version' ) );

			return;
		}

		$base_font = get_theme_mod( 'text_typography', array() );
		$h1_font   = get_theme_mod( 'typography_h1', array() );
		$h2_font   = get_theme_mod( 'typography_h2', array() );
		$h3_font   = get_theme_mod( 'typography_h3', array() );
		$h4_font   = get_theme_mod( 'typography_h4', array() );
		$h5_font   = get_theme_mod( 'typography_h5', array() );
		$h6_font   = get_theme_mod( 'typography_h6', array() );

		if (!empty($base_font)) {
			if ( $base_font['variant'] == 400 || $base_font['variant'] == 'regular' ) {
				wp_enqueue_style( 'knowpress-editor-google-font-base',
					'https://fonts.googleapis.com/css2?family=' . $base_font['font-family'] . '&display=swap',
					false,
					wp_get_theme()->get( 'Version' ) );
			} else {
				wp_enqueue_style( 'knowpress-editor-google-font-base',
					'https://fonts.googleapis.com/css2?family='  . $base_font['font-family'] . ':wght@' . $base_font['variant'] . '&display=swap',
					false,
					wp_get_theme()->get( 'Version' ) );
			}
		}

		if (!empty($h1_font)) {
            if ( $h1_font['variant'] == 400 || $h1_font['variant'] == 'regular' ) {
	            wp_enqueue_style( 'knowpress-editor-google-font-base',
		            'https://fonts.googleapis.com/css2?family=' . $h1_font['font-family'] . '&display=swap',
		            false,
		            wp_get_theme()->get( 'Version' ) );
            } else {
	            wp_enqueue_style( 'knowpress-editor-google-font-base',
		            'https://fonts.googleapis.com/css2?family='  . $h1_font['font-family'] . ':wght@' . $h1_font['variant'] . '&display=swap',
		            false,
		            wp_get_theme()->get( 'Version' ) );
            }
		}

		if (!empty($h2_font)) {
            if ( $h2_font['variant'] != $h1_font['variant'] && $h2_font['font-family'] != $h1_font['font-family'] ) {
                if ( $h2_font['variant'] == 400 || $h2_font['variant'] == 'regular' ) {
	                wp_enqueue_style( 'knowpress-editor-google-font-base',
		                'https://fonts.googleapis.com/css2?family=' . $h2_font['font-family'] . '&display=swap',
		                false,
		                wp_get_theme()->get( 'Version' ) );
                } else {
	                wp_enqueue_style( 'knowpress-editor-google-font-base',
		                'https://fonts.googleapis.com/css2?family='  . $h2_font['font-family'] . ':wght@' . $h2_font['variant'] . '&display=swap',
		                false,
		                wp_get_theme()->get( 'Version' ) );
                }
            }
		}

		if (!empty($h3_font)) {
            if ( $h3_font['variant'] != $h1_font['variant'] && $h3_font['font-family'] != $h1_font['font-family'] || $h3_font['variant'] != $h2_font['variant'] && $h3_font['font-family'] != $h2_font['font-family'] ) {
                if ( $h3_font['variant'] == 400 || $h3_font['variant'] == 'regular' ) {
	                wp_enqueue_style( 'knowpress-editor-google-font-base',
		                'https://fonts.googleapis.com/css2?family=' . $h3_font['font-family'] . '&display=swap',
		                false,
		                wp_get_theme()->get( 'Version' ) );
                } else {
	                wp_enqueue_style( 'knowpress-editor-google-font-base',
		                'https://fonts.googleapis.com/css2?family='  . $h3_font['font-family'] . ':wght@' . $h3_font['variant'] . '&display=swap',
		                false,
		                wp_get_theme()->get( 'Version' ) );
                }
            }
		}

		if (!empty($h4_font)) {
            if ( $h4_font['variant'] != $h1_font['variant'] && $h4_font['font-family'] != $h1_font['font-family'] || $h4_font['variant'] != $h2_font['variant'] && $h4_font['font-family'] != $h2_font['font-family'] || $h4_font['variant'] != $h3_font['variant'] && $h4_font['font-family'] != $h3_font['font-family'] ) {
                if ( $h4_font['variant'] == 400 || $h4_font['variant'] == 'regular' ) {
	                wp_enqueue_style( 'knowpress-editor-google-font-base',
		                'https://fonts.googleapis.com/css2?family=' . $h4_font['font-family'] . '&display=swap',
		                false,
		                wp_get_theme()->get( 'Version' ) );
                } else {
	                wp_enqueue_style( 'knowpress-editor-google-font-base',
		                'https://fonts.googleapis.com/css2?family='  . $h4_font['font-family'] . ':wght@' . $h4_font['variant'] . '&display=swap',
		                false,
		                wp_get_theme()->get( 'Version' ) );
                }
            }
		}

		if (!empty($h5_font)) {
            if ( $h5_font['variant'] != $h1_font['variant'] && $h5_font['font-family'] != $h1_font['font-family'] || $h5_font['variant'] != $h2_font['variant'] && $h5_font['font-family'] != $h2_font['font-family'] || $h5_font['variant'] != $h3_font['variant'] && $h5_font['font-family'] != $h3_font['font-family'] || $h5_font['variant'] != $h4_font['variant'] && $h5_font['font-family'] != $h4_font['font-family'] ) {
                if ( $h5_font['variant'] == 400 || $h5_font['variant'] == 'regular' ) {
	                wp_enqueue_style( 'knowpress-editor-google-font-base',
		                'https://fonts.googleapis.com/css2?family=' . $h5_font['font-family'] . '&display=swap',
		                false,
		                wp_get_theme()->get( 'Version' ) );
                } else {
	                wp_enqueue_style( 'knowpress-editor-google-font-base',
		                'https://fonts.googleapis.com/css2?family='  . $h5_font['font-family'] . ':wght@' . $h5_font['variant'] . '&display=swap',
		                false,
		                wp_get_theme()->get( 'Version' ) );
                }
            }
		}

		if (!empty($h6_font)) {
			if ( $h6_font['variant'] != $h1_font['variant'] && $h6_font['font-family'] != $h1_font['font-family'] || $h6_font['variant'] != $h2_font['variant'] && $h6_font['font-family'] != $h2_font['font-family'] || $h6_font['variant'] != $h3_font['variant'] && $h6_font['font-family'] != $h3_font['font-family'] || $h6_font['variant'] != $h4_font['variant'] && $h6_font['font-family'] != $h4_font['font-family'] || $h6_font['variant'] != $h4_font['variant'] && $h6_font['font-family'] != $h4_font['font-family'] || $h6_font['variant'] != $h5_font['variant'] && $h6_font['font-family'] != $h5_font['font-family'] ) {
				if ( $h6_font['variant'] == 400 || $h6_font['variant'] == 'regular' ) {
					wp_enqueue_style( 'knowpress-editor-google-font-base',
						'https://fonts.googleapis.com/css2?family=' . $h6_font['font-family'] . '&display=swap',
						false,
						wp_get_theme()->get( 'Version' ) );
				} else {
					wp_enqueue_style( 'knowpress-editor-google-font-base',
						'https://fonts.googleapis.com/css2?family='  . $h6_font['font-family'] . ':wght@' . $h6_font['variant'] . '&display=swap',
						false,
						wp_get_theme()->get( 'Version' ) );
				}
			}
		}


	}
}
add_action( 'enqueue_block_editor_assets', 'knowpress_editor_fonts' );

// Add Typography styles in editor
if ( ! function_exists( 'knowpress_editor_typography' ) ) {
	function knowpress_editor_typography() {
		$base_font = get_theme_mod( 'text_typography', array() );
		if ( ! function_exists( 'kirki' ) || empty($base_font) ) { ?>
            <style>
                .editor-styles-wrapper {
                    font-family: 'Inter' !important;
                    font-weight: 400 !important;
                }

                .editor-styles-wrapper h1, .editor-styles-wrapper h2, .editor-styles-wrapper h3, .editor-styles-wrapper h4, .editor-styles-wrapper h5, .editor-styles-wrapper h6 , .editor-post-title__input{
                    font-family: 'Inter' !important;
                    font-weight: 600 !important;
                    line-height: 1.5 !important;
                }

                .editor-styles-wrapper h1, .editor-post-title__input {
                    font-size: 29px !important;
                }

                .editor-styles-wrapper h2 {
                    font-size: 23px !important;
                }

                .editor-styles-wrapper h3 {
                    font-size: 20px !important;
                }

                .editor-styles-wrapper h4 {
                    font-size: 18px !important;
                }

                .editor-styles-wrapper h5 {
                    font-size: 16px !important;
                }

                .editor-styles-wrapper h6 {
                    font-size: 14px !important;
                }
            </style>

                <?php
			return;
		}


		$h1_font   = get_theme_mod( 'typography_h1', array() );
		$h2_font   = get_theme_mod( 'typography_h2', array() );
		$h3_font   = get_theme_mod( 'typography_h3', array() );
		$h4_font   = get_theme_mod( 'typography_h4', array() );
		$h5_font   = get_theme_mod( 'typography_h5', array() );
		$h6_font   = get_theme_mod( 'typography_h6', array() );

		?>
        <style>
            .editor-styles-wrapper {
                font-family: '<?php echo esc_html($base_font['font-family']) ?>' !important;
                font-weight: <?php echo esc_html($base_font['variant']) ?> !important;
                font-size: <?php echo esc_html($base_font['font-size']) ?> !important;
            }

            .editor-styles-wrapper p {
                font-family: '<?php echo esc_html($base_font['font-family']) ?>' !important;
                font-weight: <?php echo esc_html($base_font['variant']) ?> !important;
                font-size: <?php echo esc_html($base_font['font-size']) ?> !important;
            }

            .editor-styles-wrapper h1, .editor-post-title__input {
                font-family: '<?php echo esc_html($h1_font['font-family']) ?>' !important;
                font-weight: <?php echo esc_html($h1_font['variant']) ?> !important;
                font-size: <?php echo esc_html($h1_font['font-size']) ?> !important;
            }

            .editor-styles-wrapper h2 {
                font-family: '<?php echo esc_html($h2_font['font-family']) ?>' !important;
                font-weight: <?php echo esc_html($h2_font['variant']) ?> !important;
                font-size: <?php echo esc_html($h2_font['font-size']) ?> !important;
            }

            .editor-styles-wrapper h3 {
                font-family: '<?php echo esc_html($h3_font['font-family']) ?>' !important;
                font-weight: <?php echo esc_html($h3_font['variant']) ?> !important;
                font-size: <?php echo esc_html($h3_font['font-size']) ?> !important;
            }

            .editor-styles-wrapper h4 {
                font-family: '<?php echo esc_html($h4_font['font-family']) ?>' !important;
                font-weight: <?php echo esc_html($h4_font['variant']) ?> !important;
                font-size: <?php echo esc_html($h4_font['font-size']) ?> !important;
            }

            .editor-styles-wrapper h5 {
                font-family: '<?php echo esc_html($h5_font['font-family']) ?>' !important;
                font-weight: <?php echo esc_html($h5_font['variant']) ?> !important;
                font-size: <?php echo esc_html($h5_font['font-size']) ?> !important;
            }

            .editor-styles-wrapper h6 {
                font-family: '<?php echo esc_html($h6_font['font-family']) ?>' !important;
                font-weight: <?php echo esc_html($h6_font['variant']) ?> !important;
                font-size: <?php echo esc_html($h6_font['font-size']) ?> !important;
            }
        </style>
		<?php
	}
}
add_action( 'enqueue_block_editor_assets', 'knowpress_editor_typography' );

add_action( 'enqueue_block_editor_assets',
	function () {
		wp_enqueue_script( 'knowpress-editor-blocks-script',
			get_template_directory_uri() . '/assets/js/editor-script.js',
			false,
			wp_get_theme()->get( 'Version' ) );
	} );
