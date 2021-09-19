<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KnowPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post' ); ?>>
    <header class="c-post__header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="c-post__title">', '</h1>' );
		else :
			the_title( '<h2 class="c-post__title"><a class="c-post__title__link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
				'</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
            <div class="c-post__meta s-post-meta">
				<?php
				knowpress_posted_on();
				knowpress_posted_by();
				?>
            </div><!-- .entry-meta -->
		<?php endif; ?>
    </header><!-- .entry-header -->

	<?php knowpress_post_thumbnail(); ?>

    <div class="c-post__content<?php if ( ! is_singular() ) {
		echo " c-post__content--excerpt";
	} ?>">
		<?php
		if ( is_singular() ) {
			the_content();
		} else {
			the_excerpt();
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'knowpress' ),
				'after'  => '</div>',
			)
		);
		?>
    </div><!-- .entry-content -->
	<?php if ( is_singular() ) : ?>
        <footer class="c-post__footer s-post-meta s-post-meta--footer">
			<?php knowpress_entry_footer(); ?>
        </footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
