<?php
/*
Author: 2020 Creative
URL: htp://2020creative.com
*/
//////////////////////////////////////////////////////// 2020 Functions
define( 'TEMPPATH', get_stylesheet_directory_uri());
define( 'IMAGES', TEMPPATH. "/imgages");

// Plugins
require_once ('plugins/acf-master/acf.php');
//require_once ('plugins/github-updater/github-updater.php');

// Shortcodes
require_once ('tt-shortcodes.php');

// CPT's
require_once ('tt-cpt.php');

// Custom fields
require_once ('tt-acf-fields.php');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////// Add boostrap from CDN

if( !function_exists("tt_bootstrap_cdn") ) {  
    function tt_bootstrap_cdn() { 
        // parent theme
        wp_register_style( 'tt-boot', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'tt-boot' );
        
        wp_register_style( 'tt-boot-js', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array(), '1.0', 'all' );
        wp_enqueue_style( 'tt-boot-js' );
        
        wp_register_style( 'tt-boot-fontawesome', 'maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'tt-boot-fontawesome' );

        // child themes
        // wp_register_style( 'tt-child', get_stylesheet_directory_uri() . '/tt-child.css', array(), '1.0', 'all' );
        // wp_enqueue_style( 'tt-child' );
        
    }
}
add_action( 'wp_enqueue_scripts', 'tt_bootstrap_cdn' );

////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////// CSS Enqueue Styles

if( !function_exists("tt_theme_styles") ) {  
    function tt_theme_styles() { 
        // parent theme
        // wp_register_style( 'tt-main', get_template_directory_uri() . '/css/tt-main.css', array(), '1.0', 'all' );
        // wp_enqueue_style( 'tt-main' );

        // child themes
        wp_register_style( 'tt-main', get_stylesheet_directory_uri() . '/tt-lib/css/tt-main.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'tt-main' );
        wp_register_style( 'tt-lightbox', get_stylesheet_directory_uri() . '/tt-lib/lightbox/lightbox.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'tt-lightbox' );
    }
}
add_action( 'wp_enqueue_scripts', 'tt_theme_styles' );

////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////// TT Admin

// Custom Backend Footer
add_filter('admin_footer_text', 'tt_custom_admin_footer');
function tt_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://2020creative.com" target="_blank">2020creative.com</a></span>.';
}
// adding it to the admin area
add_filter('admin_footer_text', 'tt_custom_admin_footer');

////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////// Menus

register_nav_menus( array(
	'tt_main' => 'TT Main',
	
) );

//////////////////////////////////////////////////////////////////////////////////////////////////////////////// Sidebars

////////////////////////////////////////////////////////

$args = array(
	'name'          => __( 'TT Sidebar', 'theme_text_domain' ),
	'id'            => 'tt_sidebar',
	'description'   => '',
    'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' );

register_sidebar( $args );

////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////// disable admin area

function tt_disable_admin_bar() { 
	if( ! current_user_can('edit_dashboard') )
		add_filter('show_admin_bar', '__return_false');	
}
add_action( 'after_setup_theme', 'tt_disable_admin_bar' );
 

function tt_redirect_admin(){
	if ( ! current_user_can( 'edit_dashboard' ) ){
		wp_redirect( site_url() . '/' );
		exit;		
	}
}
add_action( 'admin_init', 'tt_redirect_admin' );

////////////////////////////////////////////////////////

function tt_print_acf() {
    
    //$user_meta = get_user_meta(1);
    //print_r($user_meta);
}
add_action('admin_print_footer_scripts', 'tt_print_acf');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

