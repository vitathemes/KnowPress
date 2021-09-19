<?php


class Knowpress_page_walker extends Walker_Page {
	/**
	 * Initialize the class
	 */

	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		$classes = "item";

		if ( get_the_ID() === $page->ID ) {
			$classes .= " current_page_item";
		}

		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );
			if ( $_current_page && in_array( $page->ID, $_current_page->ancestors, true ) ) {
				$classes .= ' current_page_ancestor';
			}
		}

		if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
			$output .= '<li class="' . $classes . '"><span class="item__header"><button class="item-toggle js-docs-nav-toggle"><span class="o-arrow"></span></button>';
		} else {
			$output .= '<li class="' . $classes . '">';
		}

		$output .= '<a class="item-link" href="' . get_permalink( $page->ID ) . '">' . apply_filters( 'the_title',
				$page->post_title,
				$page->ID ) . '</a></span>';
	}
}
