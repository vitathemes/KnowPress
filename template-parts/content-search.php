<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KnowPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-post'); ?>>
	<header class="c-post__header">
		<?php the_title( sprintf( '<h2 class="c-post__title"><a class="c-post__title__link" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="c-post__meta s-post-meta">
			<?php
			knowpress_posted_on();
			knowpress_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php knowpress_post_thumbnail(); ?>

	<div class="c-post__content c-post__content--excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="c-post__footer s-post-meta s-post-meta--footer">
		<?php knowpress_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
