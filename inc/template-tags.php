<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package KnowPress
 */

if ( ! function_exists( 'knowpress_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function knowpress_posted_on() {
		$time_string = '<time class="c-post__meta__published published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'knowpress' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		if ( get_theme_mod( 'archive_date', true ) && is_archive() || get_theme_mod( 'archive_date', true ) && is_home() ) {
			echo '<span class="c-post__meta__posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			return;
		}

		if ( get_theme_mod( 'single_date', true ) && is_single() ) {
			echo '<span class="c-post__meta__posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'knowpress_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function knowpress_posted_by() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'knowpress' ),
			'<span class="c-post__meta__author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		if ( get_theme_mod( 'archive_author', true ) && is_archive() || get_theme_mod( 'archive_author', true ) && is_home() ) {
			echo '<span class="c-post__meta__byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			return;
		}

		if ( get_theme_mod( 'single_author', true ) && is_single() ) {
			echo '<span class="c-post__meta__byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'knowpress_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function knowpress_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'knowpress' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				if ( get_theme_mod( 'archive_categories', true ) && is_archive() || get_theme_mod( 'archive_categories', true ) && is_home() ) {
					/* translators: 1: Categories list */
					printf( '<span class="c-post__footer__cat-links">' . esc_html__( 'Posted in %1$s', 'knowpress' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}

				if ( get_theme_mod( 'single_categories', true ) && is_single() ) {
					/* translators: 1: Categories list */
					printf( '<span class="c-post__footer__cat-links">' . esc_html__( 'Posted in %1$s', 'knowpress' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}

			if ( is_single() ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'knowpress' ) );
				if ( $tags_list ) {
					if ( get_theme_mod( 'single_tags', true ) ) {
						/* translators: 1: list of tags. */
						printf( '<span class="c-post__footer__tags-links">' . esc_html__( 'Tagged %1$s', 'knowpress' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				}
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'knowpress' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="c-post__footer__edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'knowpress_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function knowpress_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}


		if ( is_singular() ) :

			if ( get_theme_mod( 'single_thumbnail', true ) ) :
				?>

                <div class="c-post__thumbnail">
					<?php the_post_thumbnail(); ?>
                </div><!-- .post-thumbnail -->

			<?php
			endif; // End if ( get_theme_mod( 'single_author')
		else : if ( get_theme_mod( 'archive_thumbnail', true ) ) : ?>

            <a class="c-post__thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
            </a>

		<?php
		endif; // End get_theme_mod( 'archive_author')
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


if ( ! function_exists( 'knowpress_header_image' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function knowpress_header_image() {
		if ( has_header_image() ) {
			echo sprintf( '<img class="c-header__custom-image" src="%s" height="%s" width="%s" alt="%s" />',
				esc_url( get_header_image() ),
				esc_attr( get_custom_header()->height ),
				esc_attr( get_custom_header()->width ),
				esc_attr__( 'Header Image', 'knowpress' ) );
		}
	}
endif;

if ( ! function_exists( 'knowpress_branding' ) ) :
	function knowpress_branding() {
		if ( has_custom_logo() ) {
			echo '<div class="c-branding s-branding">';
			the_custom_logo();
			echo '</div>';

			return;
		}
		if ( is_front_page() && is_home() ) :
			?>
            <h1 class="c-branding__title">
                <a class="c-branding__title__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </h1>
		<?php
		else :
			?>
            <p class="c-branding__title">
                <a class="c-branding__title__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </p>
		<?php
		endif;
	}
endif;
