<?php

add_action( 'genesis_meta', 'legacy_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function legacy_home_genesis_meta() {

	if ( is_active_sidebar( 'slider' ) || is_active_sidebar( 'welcome' ) || is_active_sidebar( 'home-bottom-1' ) || is_active_sidebar( 'home-bottom-2' ) || is_active_sidebar( 'home-bottom-3' ) || is_active_sidebar( 'home-bottom-message' ) ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_after_header', 'legacy_home_loop_helper_top' );
		add_action( 'genesis_after_header', 'legacy_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

/**
 * Display widget content for "slider" and "welcome" sections.
 *
 */
function legacy_home_loop_helper_top() {
			
		if ( is_active_sidebar( 'slider' ) ) {
			echo '<div class="slider-wrap"><div class="slider-inner">';
			dynamic_sidebar( 'slider' );
			echo '</div><!-- end .slider-wrap --></div><!-- end .slider-inner -->';
		}
		
		if ( is_active_sidebar( 'welcome' ) ) {
			echo '<div class="welcome-wrap"><div class="welcome-inner">';
			dynamic_sidebar( 'welcome' );
			echo '</div><!-- end .welcome-wrap --></div><!-- end .welcome-inner -->';
		}
		
}

/**
 * Display widget content for "home bottom #1", "home bottom #2", "home bottom #3" and "home bottom message" sections.
 *
 */
function legacy_home_loop_helper() {

		echo '<div id="home-middle"><div class="wrap">';
		
		echo '<div id="home-middle-top"><div class="wrap">';	
		
		if ( is_active_sidebar( 'home-middle-top-0' ) ) {
			echo '<div class="home-middle-top">';
			dynamic_sidebar( 'home-middle-top-0' );
			echo '</div><!-- end .home-middle-top -->';
		}
		
		// if ( is_active_sidebar( 'home-middle-top-1' ) ) {
		// 	echo '<div class="home-middle-top-1">';
		// 	dynamic_sidebar( 'home-middle-top-1' );
		// 	echo '</div><!-- end .home-middle-top-1 -->';
		// }
		
		// if ( is_active_sidebar( 'home-middle-top-2' ) ) {
		// 	echo '<div class="home-middle-top-2">';
		// 	dynamic_sidebar( 'home-middle-top-2' );
		// 	echo '</div><!-- end .home-middle-top-2 -->';
		// }
		echo '</div><!-- end .wrap --></div><!-- end #home-middle-top -->';		
		// echo '<div id="home-middle-center"><div class="wrap">';				
		
		// if ( is_active_sidebar( 'home-middle-center-1' ) ) {
		// 	echo '<div class="home-middle-center-1">';
		// 	dynamic_sidebar( 'home-middle-center-1' );
		// 	echo '</div><!-- end .home-middle-center-1 -->';
		// }
		
		// if ( is_active_sidebar( 'home-middle-center-2' ) ) {
		// 	echo '<div class="home-middle-center-2">';
		// 	dynamic_sidebar( 'home-middle-center-2' );
		// 	echo '</div><!-- end .home-middle-center-2 -->';
		// }
				
		// if ( is_active_sidebar( 'home-middle-center-3' ) ) {
		// 	echo '<div class="home-middle-center-3">';
		// 	dynamic_sidebar( 'home-middle-center-3' );
		// 	echo '</div><!-- end .home-middle-center-3 -->';
		// }
		// if ( is_active_sidebar( 'home-middle-center-4' ) ) {
		// 	echo '<div class="home-middle-center-4">';
		// 	dynamic_sidebar( 'home-middle-center-4' );
		// 	echo '</div><!-- end .home-middle-center-4 -->';
		// }
		
		// echo '</div><!-- end .wrap --></div><!-- end #home-middle-center -->';
		echo '<div id="home-middle-bottom"><div class="wrap">';	
		
		if ( is_active_sidebar( 'home-middle-bottom-1' ) ) {
			echo '<div class="home-middle-bottom-1">';
			dynamic_sidebar( 'home-middle-bottom-1' );
			echo '</div><!-- end .home-middle-bottom-1 -->';
		}
		
		if ( is_active_sidebar( 'home-middle-bottom-2' ) ) {
			echo '<div class="home-middle-bottom-2">';
			dynamic_sidebar( 'home-middle-bottom-2' );
			echo '</div><!-- end .home-middle-bottom-2 -->';
		}
				
		
		if ( is_active_sidebar( 'home-bottom-message' ) ) {
			echo '<div class="home-bottom-message">';
			dynamic_sidebar( 'home-bottom-message' );
			echo '</div><!-- end .home-bottom-message -->';
		}
		echo '</div><!-- end .wrap --></div><!-- end #home-middle-bottom -->';		
		echo '</div><!-- end .wrap --></div><!-- end #home-middle -->';
		
}

genesis();