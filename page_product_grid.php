<?php

// Template Name: Product Grid
remove_action('genesis_post_title', 'genesis_do_post_title');

add_filter('post_class', 'product_grid_post_class');
function product_grid_post_class( $classes ) {
	if (  is_page() ) {
		return $classes;
	} else {
    $classes[] = 'product_grid';
    return $classes;
}}


genesis();
