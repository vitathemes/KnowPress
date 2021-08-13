<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KnowPress
 */

if (!isset($skip_sidebar)) {
	$skip_sidebar = false;
}

if ( get_theme_mod('show_sidebar_all_pages', false) || class_exists('WeDocs') && is_singular( 'docs' ) || is_post_type_archive( 'docs' ) ) : ?>
    <aside class="c-sidebar js-sidebar c-branding--documentation">
        <div class="c-sidebar__main js-sidebar-simplebar">
            <button class="c-sidebar__close js-sidebar-close">
                <svg class="c-sidebar__close__icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1.4em" height="1.4em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256"><path d="M224 128a8 8 0 0 1-8 8H59.313l58.344 58.343a8 8 0 0 1-11.314 11.314l-72-72a8 8 0 0 1 0-11.314l72-72a8 8 0 0 1 11.314 11.314L59.313 120H216a8 8 0 0 1 8 8z" /><rect x="0" y="0" width="256" height="256" fill="rgba(0, 0, 0, 0)" /></svg>
            </button>
            <div class="c-branding-wrapper js-branding">
		        <?php knowpress_branding(); ?>
            </div>
            <div class="c-sidebar__search">
		        <?php get_search_form(); ?>
            </div>
            <div class="c-sidebar__docs js-sidebar-scroller">
		        <?php if ( ! $skip_sidebar ) {
			        wedocs_get_template_part( 'docs', 'sidebar' );
		        } ?>
            </div>
        </div>
        <div class="c-sidebar__credit s-credit">
        </div>
    </aside>
	<?php
	return;
endif;
?>
<aside class="c-sidebar js-sidebar">
    <button class="c-sidebar__close js-sidebar-close">
        <svg class="c-sidebar__close__icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1.4em" height="1.4em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256"><path d="M224 128a8 8 0 0 1-8 8H59.313l58.344 58.343a8 8 0 0 1-11.314 11.314l-72-72a8 8 0 0 1 0-11.314l72-72a8 8 0 0 1 11.314 11.314L59.313 120H216a8 8 0 0 1 8 8z" /><rect x="0" y="0" width="256" height="256" fill="rgba(0, 0, 0, 0)" /></svg>
    </button>
    <div class="c-branding-wrapper js-branding">
	<?php knowpress_branding(); ?>
    </div>
    <div class="c-sidebar__main js-sidebar-simplebar">
    </div>
	<?php  if ( $skip_sidebar && ! is_404() && function_exists('wedocs_get_template_part') ) {
		wedocs_get_template_part( 'docs', 'sidebar' );
	}   ?>
</aside>
