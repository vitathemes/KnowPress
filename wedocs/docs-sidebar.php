<div class="c-docs-nav s-docs-nav">
	<?php
	$ancestors = [];
	$root      = $parent = false;

	if (isset($post)){
        if ( $post->post_parent ) {
            $ancestors = get_post_ancestors( $post->ID );
            $root      = count( $ancestors ) - 1;
            $parent    = $ancestors[ $root ];
        } else {
            $parent = $post->ID;
        }
	}

	$walker = new Knowpress_page_walker();

	$sidebar_args = [
		'title_li'  => '',
		'order'     => 'menu_order',
		'child_of'  => $parent,
		'echo'      => false,
		'post_type' => 'docs',
		'walker'    => $walker,
	];

	if ( get_theme_mod( 'show_sidebar_all_pages', false ) ) {
		$sidebar_args['child_of'] = false;
	}

	$children = wp_list_pages( $sidebar_args );

	if ( $children ) {
		if ( ! get_theme_mod( 'show_sidebar_all_pages', false ) ) :
			?>
            <h4 class="c-docs-nav__title"><?php echo esc_html(get_post_field( 'post_title', $parent, 'display' )); ?></h4>
		<?php
		endif;
		?>
        <ul class="c-docs-nav__list s-docs-nav-list">
			<?php echo $children; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </ul>
	<?php } ?>
</div>
