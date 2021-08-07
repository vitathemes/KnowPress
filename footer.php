<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KnowPress
 */

?>

<footer id="colophon" class="c-footer">
    <div class="c-footer__widgets">
		<?php
		if ( is_active_sidebar( 'sidebar-1' ) ) :
			?>
            <div id="secondary" class="c-widget-area">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div><!-- #secondary -->
		<?php
		endif;
		if ( is_active_sidebar( 'sidebar-2' ) ) :
			?>
            <div id="secondary" class="c-widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
            </div><!-- #secondary -->
		<?php
		endif; ?>
    </div>
    <div class="c-footer__info s-credit">
            <span class="js-credit">
                <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf('%1$s %2$s <a href="%3$s">%4$s</a>.' ,
	                esc_html__('KnowPress', 'knowpress'),
	                esc_html__('by', 'knowpress'),
	                esc_url('http://vitathemes.com'),
	                esc_html__('VitaThemes', 'knowpress') );
                ?>
            </span>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->
</div>
<?php wp_footer(); ?>

</body>
</html>
