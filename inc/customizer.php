<?php
/**
 * KnowPress Theme Customizer
 *
 * @package KnowPress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function knowpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'knowpress_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'knowpress_customize_partial_blogdescription',
			)
		);
	}
}

add_action( 'customize_register', 'knowpress_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function knowpress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function knowpress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function knowpress_customize_preview_js() {
	wp_enqueue_script( 'knowpress-customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		KNWOPRESS_VERSION,
		true );
}

add_action( 'customize_preview_init', 'knowpress_customize_preview_js' );


/**
 * Custom theme customizer
 *
 * If the Kirki customizer framework is not enabled, these controls won't show up.
 */
if ( function_exists( 'kirki' ) ) {
	add_action( 'init',
		function () {
			// Disable Kiriki help notice
			add_filter( 'kirki_telemetry', '__return_false' );

			// Add config
			Kirki::add_config( 'knowpress',
				array(
					'option_type' => 'theme_mod',
				) );

			/* Panel */
			Kirki::add_panel('elements', [
				'title' => esc_html__('Elements', 'knowpress'),
				'priority' => 25
			]);

			Kirki::add_panel('blocks', [
				'title' => esc_html__('Blocks', 'knowpress'),
				'priority' => 26
			]);
			/* Panel */


			/* Section */
			Kirki::add_section( 'typography',
				[
					'title' => esc_html__( 'Typography', 'knowpress' ),
					'priority' => 20
				] );

			Kirki::add_section( 'el_archive',
				[
					'title' => esc_html__( 'Archive Options', 'knowpress' ),
					'panel' => 'elements',
					'priority' => 10
				] );

			Kirki::add_section( 'el_single',
				[
					'title' => esc_html__( 'Single Options', 'knowpress' ),
					'panel' => 'elements',
					'priority' => 10
				] );

			Kirki::add_section( 'sidebar',
				[
					'title' => esc_html__( 'Sidebar Options', 'knowpress' ),
					'priority' => 23
				] );

			Kirki::add_section( 'paragraph',
				[
					'title' => esc_html__( 'Paragraph (Messages)', 'knowpress' ),
					'priority' => 23,
					'panel' => 'blocks'
				] );

			Kirki::add_section( 'list',
				[
					'title' => esc_html__( 'List', 'knowpress' ),
					'priority' => 24,
					'panel' => 'blocks'
				] );
			/* Section */

			/* Color */
			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_primary_color',
					'label'    => __( 'Primary Color', 'knowpress' ),
					'section'  => 'colors',
					'default'  => '#0090AD',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_primary_text_color',
					'label'    => __( 'Primary Text Color', 'knowpress' ),
					'section'  => 'colors',
					'default'  => '#242A31',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_secondary_text_color',
					'label'    => __( 'Secondary Text Color', 'knowpress' ),
					'section'  => 'colors',
					'default'  => '#4D5A66',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_sidebar_color',
					'label'    => __( 'Sidebar Color', 'knowpress' ),
					'section'  => 'colors',
					'default'  => '#f6f8fa',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_border_color',
					'label'    => __( 'Border Color', 'knowpress' ),
					'section'  => 'colors',
					'default'  => '#E2E8EE',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_card_bg_color',
					'label'    => __( 'Hover Card Background Color', 'knowpress' ),
					'section'  => 'colors',
					'default'  => '#F5F7F9',
				] );
			/* Color */

			/* Typography */
			Kirki::add_field( 'knowpress',
				[
					'type'     => 'toggle',
					'settings' => 'use_google_fonts',
					'label'    => esc_html__( 'Use Google Fonts', 'knowpress' ),
					'section'  => 'typography',
					'default'  => 1,
					'priority' => 10,
				] );

			// Base Font
			Kirki::add_field( 'knowpress',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'text_typography',
					'label'           => esc_html__( 'Base font', 'knowpress' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'Inter',
						'variant'        => '400',
						'font-size'      => '16px',
						'line-height'    => '1.65',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => 'html',
						),
						array(
							'element' => '.edit-post-visual-editor.editor-styles-wrapper',
							'context' => [ 'editor' ],
						)
					),
				] );
			// Base Font - Mobile
			Kirki::add_field( 'knowpress',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'text_typography_m',
					'label'           => esc_html__( 'Base font (Mobile)', 'knowpress' ),
					'section'         => 'typography',
					'default'         => [
						'font-size'   => '16px',
						'line-height' => '1.5',
					],
					'transport'       => 'auto',
					'priority'        => 10,
				] );
			// H1
			Kirki::add_field( 'knowpress',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h1',
					'label'           => esc_html__( 'H1', 'knowpress' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'Inter',
						'font-size'      => '29px',
						'font-weight'    => '600',
						'line-height'    => '1.4',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h1', '.h1' ),
						),
					),
				] );
			// H2
			Kirki::add_field( 'knowpress',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h2',
					'label'           => esc_html__( 'H2', 'knowpress' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'Inter',
						'font-size'      => '23px',
						'font-weight'    => '600',
						'line-height'    => '1.35',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h2', '.h2' ),
						),
					),
				] );
			// H3
			Kirki::add_field( 'knowpress',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h3',
					'label'           => esc_html__( 'H3', 'knowpress' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'Inter',
						'font-size'      => '20px',
						'font-weight'    => '600',
						'line-height'    => '1.35',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h3', '.h3' ),
						),
					),
				] );
			// H4
			Kirki::add_field( 'knowpress',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h4',
					'label'           => esc_html__( 'H4', 'knowpress' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'Inter',
						'font-size'      => '18px',
						'font-weight'    => '600',
						'line-height'    => '1.4',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h4', '.h4' ),
						),
					),
				] );
			// H5
			Kirki::add_field( 'knowpress',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h5',
					'label'           => esc_html__( 'H5', 'knowpress' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'Inter',
						'font-size'      => '16px',
						'font-weight'    => '600',
						'line-height'    => '1.4',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h5', '.h5' ),
						),
					),
				] );
			// H6
			Kirki::add_field( 'knowpress',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h6',
					'label'           => esc_html__( 'H6', 'knowpress' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'Inter',
						'font-size'      => '14px',
						'font-weight'    => '600',
						'line-height'    => '1.5',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h6', '.h2' ),
						),
					),
				] );
			/* Typography */

			/* Elements */
			/**
			 * Archive Options
			 * - Published date
			 * - Author
			 * - Thumbnail
			 * - Categories
			 */
			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'archive_date',
				'label'       => esc_html__( 'Show Published Date', 'knowpress' ),
				'section'     => 'el_archive',
				'default'     => '1',
				'priority'    => 10,
			] );

			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'archive_author',
				'label'       => esc_html__( 'Show Author Name', 'knowpress' ),
				'section'     => 'el_archive',
				'default'     => '1',
				'priority'    => 10,
			] );

			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'archive_thumbnail',
				'label'       => esc_html__( 'Show Thumbnail', 'knowpress' ),
				'section'     => 'el_archive',
				'default'     => '1',
				'priority'    => 10,
			] );

			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'archive_categories',
				'label'       => esc_html__( 'Show Categories', 'knowpress' ),
				'section'     => 'el_archive',
				'default'     => '1',
				'priority'    => 10,
			] );

			/**
			 * Single Options
			 * - Published date
			 * - Author
			 * * - Thumbnail
			 * - Categories
			 * - Tags

			 */
			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'single_date',
				'label'       => esc_html__( 'Show Published Date', 'knowpress' ),
				'section'     => 'el_single',
				'default'     => '1',
				'priority'    => 10,
			] );

			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'single_author',
				'label'       => esc_html__( 'Show Author Name', 'knowpress' ),
				'section'     => 'el_single',
				'default'     => '1',
				'priority'    => 10,
			] );

			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'single_thumbnail',
				'label'       => esc_html__( 'Show Thumbnail', 'knowpress' ),
				'section'     => 'el_single',
				'default'     => '1',
				'priority'    => 10,
			] );

			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'single_categories',
				'label'       => esc_html__( 'Show Categories', 'knowpress' ),
				'section'     => 'el_single',
				'default'     => '1',
				'priority'    => 10,
			] );

			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'single_tags',
				'label'       => esc_html__( 'Show Tags', 'knowpress' ),
				'section'     => 'el_single',
				'default'     => '1',
				'priority'    => 10,
			] );
			/* Elements */

			/* Sidebar */
			Kirki::add_field( 'knowpress', [
				'type'        => 'toggle',
				'settings'    => 'show_sidebar_all_pages',
				'label'       => esc_html__( 'Show Sidebar In All Pages', 'knowpress' ),
				'section'     => 'sidebar',
				'default'     => '0',
				'priority'    => 10,
			] );
			/* Sidebar */

			/* Blocks */
			// Message
			Kirki::add_field( 'theme_config_id', [
				'type'        => 'custom',
				'settings'    => 'knowpress_message_heading',
				// 'label'       => esc_html__( 'This is the label', 'kirki' ), // optional
				'section'     => 'paragraph',
				'default'         => '<h3 style="padding:4px 0; margin:0;">' . __( 'Message', 'knowpress' ) . '</h3>',
				'priority'    => 10,
			] );
			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_message_bg',
					'label'    => __( 'Background Color', 'knowpress' ),
					'section'  => 'paragraph',
					'default'  => '#EBFCFF',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_message_border',
					'label'    => __( 'Border Color', 'knowpress' ),
					'section'  => 'paragraph',
					'default'  => '#0090AD',
				] );
			Kirki::add_field( 'theme_config_id', [
				'type'        => 'custom',
				'settings'    => 'knowpress_message_sep',
				'section'     => 'paragraph',
				'default'         => '<hr />',
				'priority'    => 10,
			] );

			// Message - Warning
			Kirki::add_field( 'theme_config_id', [
				'type'        => 'custom',
				'settings'    => 'knowpress_warning_heading',
				// 'label'       => esc_html__( 'This is the label', 'kirki' ), // optional
				'section'     => 'paragraph',
				'default'         => '<h3 style="padding:4px 0; margin:0;">' . __( 'Warning Message', 'knowpress' ) . '</h3>',
				'priority'    => 10,
			] );
			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_warning_bg',
					'label'    => __( 'Background Color', 'knowpress' ),
					'section'  => 'paragraph',
					'default'  => '#FEFAEB',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_warning_border',
					'label'    => __( 'Border Color', 'knowpress' ),
					'section'  => 'paragraph',
					'default'  => '#F2BB08',
				] );
			Kirki::add_field( 'theme_config_id', [
				'type'        => 'custom',
				'settings'    => 'knowpress_warning_sep',
				'section'     => 'paragraph',
				'default'         => '<hr />',
				'priority'    => 10,
			] );

			// Message - Danger
			Kirki::add_field( 'theme_config_id', [
				'type'        => 'custom',
				'settings'    => 'knowpress_danger_heading',
				// 'label'       => esc_html__( 'This is the label', 'kirki' ), // optional
				'section'     => 'paragraph',
				'default'         => '<h3 style="padding:4px 0; margin:0;">' . __( 'Danger Message', 'knowpress' ) . '</h3>',
				'priority'    => 10,
			] );
			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_danger_bg',
					'label'    => __( 'Background Color', 'knowpress' ),
					'section'  => 'paragraph',
					'default'  => '#FBEEEF',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_danger_border',
					'label'    => __( 'Border Color', 'knowpress' ),
					'section'  => 'paragraph',
					'default'  => '#D4303B',
				] );


			/**
			 * List
			 */
			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_list_bg',
					'label'    => __( 'Background Color', 'knowpress' ),
					'section'  => 'list',
					'default'  => '#F5F7F9',
				] );

			Kirki::add_field( 'knowpress',
				[
					'type'     => 'color',
					'settings' => 'knowpress_list_border',
					'label'    => __( 'Border Color', 'knowpress' ),
					'section'  => 'list',
					'default'  => '#0090AD',
				] );
			/* Blocks */



			/**
			 *  Add edit buttons to customizer preview
			 */
			function knowpress_add_edit_icons( $wp_customize ) {
				$wp_customize->selective_refresh->add_partial( 'show_slider_menu_index',
					array(
						'selector' => '.c-categories-list',
					) );

				$wp_customize->selective_refresh->add_partial( 'search_header',
					array(
						'selector' => '.c-header .c-search-form',
					) );

				$wp_customize->selective_refresh->add_partial( 'show_post_thumbnail',
					array(
						'selector' => '.c-post--single .c-post__thumbnail--single',
					) );

				$wp_customize->selective_refresh->add_partial( 'show_post_date',
					array(
						'selector' => '.c-post--single .c-post__date__published',
					) );

				$wp_customize->selective_refresh->add_partial( 'show_share_icons',
					array(
						'selector' => '.c-social-share',
					) );

				$wp_customize->selective_refresh->add_partial( 'show_post_tags',
					array(
						'selector' => '.c-post__footer__tags',
					) );


				$wp_customize->selective_refresh->add_partial( 'show_posts_thumbnail',
					array(
						'selector' => '.c-post__thumbnail--single',
					) );
			}

			add_action( 'customize_preview_init', 'knowpress_add_edit_icons' );
		}
	);
}
