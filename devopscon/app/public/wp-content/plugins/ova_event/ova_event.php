<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 
* Plugin Name: Ovatheme event
 
* Plugin URI: ovatheme.com
 
* Description: A plugin to create custom post type, metabox,  shortcode, registration, payment...
 
* Version:  1.2.1
 
* Author: Ovatheme
 
* Author URI: ovatheme.com
 
* License:  GPL2
 
* Text Domain: ova_event
*/

include plugin_dir_path( __FILE__ ) . '/custom-post-type/post-type.php';
include plugin_dir_path( __FILE__ ) . '/shortcode/shortcode.php';
include plugin_dir_path( __FILE__ ) . '/shortcode/vc-shortcode.php';


if ( is_admin() )
	require_once( plugin_dir_path( __FILE__ ).'/registration/settings.php' );



include plugin_dir_path( __FILE__ ) . '/registration/register.php';
include plugin_dir_path( __FILE__ ) . '/registration/process.php';


if( is_admin() ){
	include plugin_dir_path( __FILE__ ) . '/registration/registration_list.php';
	include plugin_dir_path( __FILE__ ) . '/registration/pagination_list.php';
}




load_plugin_textdomain( 'ova_event', false, basename( dirname( __FILE__ ) ) .'/languages' ); 