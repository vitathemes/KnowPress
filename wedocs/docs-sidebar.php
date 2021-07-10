<div class="c-docs-nav s-docs-nav">
	<?php
	$ancestors = [];
	$root      = $parent = false;

	if ( $post->post_parent ) {
		$ancestors = get_post_ancestors( $post->ID );
		$root      = count( $ancestors ) - 1;
		$parent    = $ancestors[ $root ];
	} else {
		$parent = $post->ID;
	}

	// var_dump( $parent, $ancestors, $root );
	$walker = new Docpress_page_walker();
	//$walker   = new WeDevs\WeDocs\Walker();

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

	if ( ! get_theme_mod( 'show_sidebar_all_pages', false ) ) :
		?>
        <h4 class="c-docs-nav__title"><?php echo get_post_field( 'post_title', $parent, 'display' ); ?></h4>
	<?php
	endif;
	if ( $children ) { ?>
        <ul class="c-docs-nav__list s-docs-nav-list">
			<?php echo $children; ?>
        </ul>
	<?php } ?>
</div>
