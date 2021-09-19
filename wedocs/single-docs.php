<?php
/**
 * The template for displaying a single doc
 *
 * To customize this template, create a folder in your current theme named "wedocs" and copy it there.
 */
$skip_sidebar = ( get_post_meta( $post->ID, 'skip_sidebar', true ) == 'yes' ) ? true : false;

get_header(); ?>

<?php
/**
 * @since 1.4
 *
 * @hooked wedocs_template_wrapper_start - 10
 */
do_action( 'wedocs_before_main_content' );
?>

<?php while ( have_posts() ) {
	the_post(); ?>

    <div class="c-docs s-docs">
        <div class="c-breadcrumb s-breadcrumb">
			<?php wedocs_breadcrumbs(); ?>
        </div>
        <div class="c-docs__wrapper">
            <article id="post-<?php the_ID(); ?>" <?php post_class('c-doc'); ?> itemscope itemtype="http://schema.org/Article">
                <header class="c-doc__header entry-header">
					<?php the_title( '<h1 class="c-doc__title" itemprop="headline">', '</h1>' ); ?>

					<?php if ( wedocs_get_option( 'print', 'wedocs_settings', 'on' ) == 'on' ) { ?>
                        <a href="#" class="c-doc__print wedocs-print-article wedocs-hide-print wedocs-hide-mobile" title="<?php echo esc_attr( __( 'Print this article',
							'knowpress' ) ); ?>"><i class="wedocs-icon wedocs-icon-print"></i><span><?php esc_html_e('Print', 'knowpress'); ?></span></a>
					<?php } ?>
                </header><!-- .entry-header -->

                <div class="s-content c-doc__main entry-content" itemprop="articleBody">
					<?php
					the_content( sprintf(
					/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'knowpress' ),
							[ 'span' => [ 'class' => [] ] ] ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( [
						'before' => '<div class="page-links">' . esc_html__( 'Docs:', 'knowpress' ),
						'after'  => '</div>',
					] );

					$children = wp_list_pages( 'title_li=&order=menu_order&child_of=' . $post->ID . '&echo=0&post_type=' . $post->post_type );

					if ( $children ) {
						echo '<div class="c-child-articles article-child well">';
						echo '<h4 class="c-child-articles__title">' . esc_html__( 'Articles', 'knowpress' ) . '</h4>';
						echo '<ul class="c-child-articles__list s-child-articles-list">';
						echo $children; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo '</ul>';
						echo '</div>';
					}

					$tags_list = wedocs_get_the_doc_tags( $post->ID, '', ', ' );

					if ( $tags_list ) {
						printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
							esc_attr_x( 'Tags', 'Used before tag names.', 'knowpress' ),
							$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						);
					}
					?>
                </div><!-- .entry-content -->

                <footer class="c-doc__footer entry-footer wedocs-entry-footer">
					<?php if ( wedocs_get_option( 'email', 'wedocs_settings', 'on' ) == 'on' ) { ?>
                        <span class="wedocs-help-link wedocs-hide-print wedocs-hide-mobile">
                                <i class="wedocs-icon wedocs-icon-envelope"></i>
                                <?php printf( '%s <a class="c-doc__footer__link" id="wedocs-stuck-modal" href="%s">%s</a>',
	                                esc_html__( 'Still stuck?', 'knowpress' ),
	                                '#',
	                                esc_html__( 'How can we help?', 'knowpress' ) ); ?>
                            </span>
					<?php } ?>

                    <div class="wedocs-article-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <meta itemprop="name" content="<?php echo get_the_author(); ?>"/>
                        <meta itemprop="url" content="<?php echo esc_attr(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"/>
                    </div>

                    <meta itemprop="datePublished" content="<?php echo esc_attr(get_the_time( 'c' )); ?>"/>
                </footer>

				<div class="c-post-nav s-post-nav">
					<?php wedocs_doc_nav(); ?>
                </div>

				<?php if ( wedocs_get_option( 'helpful', 'wedocs_settings', 'on' ) == 'on' ) { ?>
					<?php wedocs_get_template_part( 'content', 'feedback' ); ?>
				<?php } ?>

				<?php if ( wedocs_get_option( 'email', 'wedocs_settings', 'on' ) == 'on' ) { ?>
					<?php wedocs_get_template_part( 'content', 'modal' ); ?>
				<?php } ?>

				<?php if ( wedocs_get_option( 'comments', 'wedocs_settings', 'off' ) == 'on' ) { ?>
					<?php if ( comments_open() || get_comments_number() ) { ?>
                        <div class="wedocs-comments-wrap">
							<?php comments_template(); ?>
                        </div>
					<?php } ?>
				<?php } ?>

            </article><!-- #post-## -->
        </div><!-- .wedocs-single-content -->
    </div><!-- .wedocs-single-wrap -->

<?php } ?>

<?php
/**
 * @since 1.4
 *
 * @hooked wedocs_template_wrapper_end - 10
 */
do_action( 'wedocs_after_main_content' );
?>

<?php get_footer(); ?>
