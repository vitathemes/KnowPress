<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KnowPress
 */

?>
    <!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'knowpress' ); ?></a>

    <header id="masthead" class="c-header js-header">
		<?php knowpress_header_image(); ?>
        <div class="js-header-menu-wrapper c-header__menu">
            <div class="o-container">
                <nav id="site-navigation" class="c-header__nav js-header-nav-wrapper">
                    <button class="c-header__nav__toggle js-header-menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">

                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1.5em" height="1.5em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                            <path d="M224 128a8 8 0 0 1-8 8H40a8 8 0 0 1 0-16h176a8 8 0 0 1 8 8zM40 72h176a8 8 0 0 0 0-16H40a8 8 0 1 0 0 16zm176 112H40a8 8 0 0 0 0 16h176a8 8 0 0 0 0-16z"/>
                            <rect x="0" y="0" width="256" height="256" fill="rgba(0, 0, 0, 0)"/>
                        </svg>
                    </button>
					<?php
					if ( has_nav_menu( 'menu-1' ) ) {
						wp_nav_menu(
							array(
								'theme_location'  => 'menu-1',
								'menu_id'         => 'primary-menu',
								'menu_class'      => 'c-nav s-nav js-primary-menu',
								'container'       => 'div',
								'container_class' => 'c-header__nav__container js-header-nav',
							)
						);
					}
					?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
        <div class="js-header-branding-wrapper c-header__branding"></div>
        <div class="js-header-search-wrapper c-header__search">
            <button class="c-header__search-toggle js-search-toggle search-toggle" aria-controls="search-box" aria-expanded="false">
                <svg class="c-header__search-toggle__icon c-header__search-toggle__icon--close" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1.5em" height="1.5em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                    <path d="M229.651 218.344l-43.222-43.223a92.112 92.112 0 1 0-11.315 11.314l43.223 43.223a8 8 0 1 0 11.314-11.314zM40 116a76 76 0 1 1 76 76a76.086 76.086 0 0 1-76-76z"/>
                    <rect x="0" y="0" width="256" height="256" fill="rgba(0, 0, 0, 0)"/>
                </svg>
                <svg class="c-header__search-toggle__icon c-header__search-toggle__icon--open" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1.5em" height="1.5em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                    <path d="M205.657 194.343a8 8 0 1 1-11.314 11.314L128 139.313l-66.343 66.344a8 8 0 0 1-11.314-11.314L116.687 128L50.343 61.657a8 8 0 0 1 11.314-11.314L128 116.687l66.343-66.344a8 8 0 0 1 11.314 11.314L139.313 128z"></path>
                    <rect x="0" y="0" width="256" height="256" fill="rgba(0, 0, 0, 0)"></rect>
                </svg>
            </button>
            <div id="search-box" class="c-header__search-box js-header-search-box">
				<?php get_search_form(); ?>
            </div>
        </div>
    </header><!-- #masthead -->
    <div class="o-overlay js-overlay is-hide"></div>
    <div class="o-container">

<?php
get_sidebar();
