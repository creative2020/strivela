<?php

// TT Functions
require_once('tt-lib/tt-functions.php');

// Theme Support Features
add_theme_support( 'builder-3.0' );
add_theme_support( 'builder-responsive' );
add_theme_support( 'builder-full-width-modules' );
add_theme_support( 'post-formats', array( 'image', 'quote', 'status', 'video' ) );


// Enqueuing and Using Custom Javascript/Jquery 
function it_air_load_custom_scripts() {
	wp_register_script( 'it_air_jquery_additions', get_stylesheet_directory_uri() . '/js/it_air_jquery_additions.js', array('jquery'), false, true );
	wp_enqueue_script('it_air_jquery_additions');
}
add_action( 'wp_enqueue_scripts', 'it_air_load_custom_scripts' );


// Tag Cloud Widget functionality
function it_custom_tag_cloud_widget($args) {
	$args['number'] = 0; // adding a 0 will display all tags
	$args['largest'] = 22; // largest tag
	$args['smallest'] = 12; // smallest tag
	$args['unit'] = 'px'; // tag font unit
	$args['format'] = 'flat';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'it_custom_tag_cloud_widget' );


// Add Support for Alternate Module Styles
if ( ! function_exists( 'it_builder_loaded' ) ) {
	function it_builder_loaded() {
		builder_register_module_style( 'navigation', 'Mobile Navigation', 'mobile-nav' );	
		builder_register_module_style( 'image', 'No Spacing', 'image-no-spacing' );
		builder_register_module_style( 'image', 'Full Window', 'image-full-window' );
		builder_register_module_style( 'header', 'Inset', 'header-inset' );
		builder_register_module_style( 'navigation', 'Inset', 'navigation-inset' );
		builder_register_module_style( 'content', 'Inset', 'content-inset' );
		builder_register_module_style( 'content', '2020 Content', 'html-2020-content' );
		builder_register_module_style( 'image', 'Inset', 'image-inset' );
		builder_register_module_style( 'html', 'Inset', 'html-inset' );
		builder_register_module_style( 'html', '2020 Grid', 'html-2020-grid' );
		builder_register_module_style( 'html', '2020 Footer', 'html-2020-footer' );
		builder_register_module_style( 'widget-bar', 'Inset', 'widget-bar-inset' );
		builder_register_module_style( 'widget-bar', '2020 Widget Bar', 'html-2020-widget-bar' );
        builder_register_module_style( 'widget-bar', 'S Footer', 'w-2020-sfooter' );
        builder_register_module_style( 'footer', 'Inset', 'footer-inset' );
	}
}
add_action( 'it_libraries_loaded', 'it_builder_loaded' );


// registering post thumbnail sizes
if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'index-thumbnail', 0, 0, true );
}


// filter out Builder extensions except those provided by the theme
function _it_air_set_extensions_directory( $directories ) {
	$directories = array(
		get_stylesheet_directory() . '/extensions',
	);
	
	return $directories;
}
add_filter( 'builder_get_extension_directories', '_it_air_set_extensions_directory' );

add_image_size('fpw_custom_thumbnail', 304, 130, true);
add_filter('fpw_featured_image', function($img, $page_id) {
	return get_the_post_thumbnail($page_id, 'fpw_custom_thumbnail');
}, 10, 2);
// 2020 menus
register_nav_menus( array(
	'footer_one' => 'Footer One',
	'footer_two' => 'Footer Two'
) );