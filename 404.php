<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package KnowPress
 */

get_header();
?>

	<main id="primary" class="c-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'knowpress' ); ?></h1>
                <h2><?php esc_html_e('Error 404', 'knowpress'); ?></h2>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'knowpress' ); ?>
                <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Back to home', 'knowpress'); ?></a>
                </p>

					<?php
					get_search_form();
					?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
