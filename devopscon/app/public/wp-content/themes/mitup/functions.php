<?php
	if(defined('MITUP_THEME_URL') 	== false) 	define('MITUP_THEME_URL', get_template_directory());
	if(defined('MITUP_THEME_URI') 	== false) 	define('MITUP_THEME_URI', get_template_directory_uri());

	// Load the theme of translated strings
	load_theme_textdomain( 'mitup', MITUP_THEME_URL . '/languages' );
	
	// require libraries, function
	require( MITUP_THEME_URL.'/framework/init.php' );

	// Require customizer
	
	require( MITUP_THEME_URL.'/framework/customizer/customizer_default.php' );
	require( MITUP_THEME_URL.'/framework/customizer/customizer_google_font.php' );
	require( MITUP_THEME_URL.'/extend/customizer.php' );	
	
	

	// Require metabox
	require( MITUP_THEME_URL.'/framework/metabox_default.php' );
	require( MITUP_THEME_URL.'/extend/metabox.php' );

	// Setup theme
	require( MITUP_THEME_URL.'/framework/setup_theme.php' );

	// Add js, css, live customizer
	require( MITUP_THEME_URL.'/extend/add_js_css.php' );

	// register menu
	require( MITUP_THEME_URL.'/extend/register_menu.php' );	

	// register widget
	require( MITUP_THEME_URL.'/extend/register_widget.php' );

	// require breadcrumbs
	require( MITUP_THEME_URL.'/extend/breadcrumbs.php' );

	// require content
	require_once (MITUP_THEME_URL.'/content/define_blocks_content.php');

	require_once (MITUP_THEME_URL.'/extend/themeslug_walker_nav_menu.php');
	
	// require active plugin
	
	require_once ( MITUP_THEME_URL.'/extend/active_plugins.php' );
	



