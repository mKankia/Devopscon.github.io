<?php
function mitup_fun_sanitize_callback($value){
    return $value;
}

function mitup_customize_default_register( $wp_customize ) {


	// Header setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section( 'header_section' , array(
	    'title'      => esc_html( 'Header setting', 'mitup' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'header_version', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'default',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('header_version', array(
		'label' => esc_html('Header version','mitup'),
		'description' => esc_html('Select header default version.','mitup'),
		'section' => 'header_section',
		'settings' => 'header_version',
		'type' =>'select',
		'choices' => mitup_load_header()

	));

	
	// /Header setting ////////////////////////////////////////////////////////////////////////////////////////////////////////



	// Footer setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'footer_section' , array(
	    'title'      => esc_html( 'Footer setting', 'mitup' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'footer_version', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'default',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('footer_version', array(
		'label' => esc_html('Footer version','mitup'),
		'description' => esc_html('Select footer default version.','mitup'),
		'section' => 'footer_section',
		'settings' => 'footer_version',
		'type' =>'select',
		'choices' => mitup_load_footer()

	));
	
	// /Footer setting ////////////////////////////////////////////////////////////////////////////////////////////////////////



	// Layout setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'layout_section' , array(
	    'title'      => esc_html( 'Layout setting', 'mitup' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'main_layout', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'right_sidebar',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('main_layout', array(
		'label' => esc_html__('Global Layout for site','mitup'),
		'section' => 'layout_section',
		'settings' => 'main_layout',
		'type' =>'select',
		'choices' => array(
			'right_sidebar' => esc_html__('Right Sidebar', 'mitup'),
			'left_sidebar' => esc_html__('Left Sidebar', 'mitup'),
			'no_sidebar' => esc_html__('No Sidebar','mitup'),
			'full_width' => esc_html__('Full Width','mitup'),
			)

	));


	$wp_customize->add_setting( 'width_site', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'wide',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('width_site', array(
		'label' => esc_html__('Width of site','mitup'),
		'section' => 'layout_section',
		'settings' => 'width_site',
		'type' =>'select',
		'choices' => array(
			'wide' => esc_html__( 'Wide', 'mitup' ),
            'boxed'   => esc_html__('Boxed', 'mitup')
			)

	));

	// Sidebar column setting
	$wp_customize->add_setting( 'sidebar_column', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '4',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('sidebar_column', array(
		'label' => esc_html__('Sidebar column','mitup'),
		'description' => esc_html__('main column + sidebar column = 12 columns','mitup'),
		'section' => 'layout_section',
		'settings' => 'sidebar_column',
		'type' =>'select',
		'choices' => array(
			'1' => esc_html__('1 column', 'mitup'),
			'2' => esc_html__('2 columns', 'mitup'),
			'3' => esc_html__('3 columns', 'mitup'),
			'4' => esc_html__('4 columns', 'mitup'),
			'5' => esc_html__('5 columns', 'mitup'),
			'6' => esc_html__('6 columns', 'mitup')
			)
	));

	// Main column settings
	$wp_customize->add_setting( 'main_column', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '8',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('main_column', array(
		'label' => esc_html__('Main column','mitup'),
		'description' => esc_html__('main column + sidebar column = 12 columns','mitup'),
		'section' => 'layout_section',
		'settings' => 'main_column',
		'type' =>'select',
		'choices' => array(
			'11' => esc_html__('11 columns', 'mitup'),
			'10' => esc_html__('10 columns', 'mitup'),
			'9' => esc_html__('9 columns', 'mitup'),
			'8' => esc_html__('8 columns', 'mitup'),
			'7' => esc_html__('7 columns', 'mitup'),
			'6' => esc_html__('6 columns', 'mitup'),
			)
	));
	
	// /Layout setting ////////////////////////////////////////////////////////////////////////////////////////////////////////



	// Google api setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'google_api_section' , array(
	    'title'      => esc_html( 'Google API setting', 'mitup' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'google_api_key', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('google_api_key', array(
		'label' => esc_html('Insert Google API Key','mitup'),
		'description' => esc_html('Make Google API Key: https://developers.google.com/maps/documentation/javascript/get-api-key','mitup'),
		'section' => 'google_api_section',
		'settings' => 'google_api_key',
		'type' =>'text'

	));
	
	// /Footer setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	




}
add_action( 'customize_register', 'mitup_customize_default_register' );




