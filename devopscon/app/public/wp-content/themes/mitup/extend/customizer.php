<?php 

function mitup_customize_register( $wp_customize ) {

	// Typography setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section( 'typography_section' , array(
	    'title'      => esc_html__( 'Typography setting', 'mitup' ),
	    'priority'   => 29,
	) );


	$wp_customize->add_setting( 'display_loading', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'yes',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('display_loading', array(
		'label' => esc_html__('Display Loading','mitup'),
		'section' => 'typography_section',
		'settings' => 'display_loading',
		'type' =>'select',
		'choices' => array(
			"yes" => esc_html__("Yes","mitup"),
			"no" => esc_html__("No","mitup"),
		)

	));


	$wp_customize->add_setting( 'logo_img', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_img', array(
	    'label'    => esc_html__( 'Logo image', 'mitup' ),
	    'section'  => 'typography_section',
	    'settings' => 'logo_img'
	)));


	$wp_customize->add_setting( 'event_padding_logo', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '34px 0px 34px 0px',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('event_padding_logo', array(
		'label' => esc_html__('Padding Logo','mitup'),
		'description' => esc_html__('For example: 34px 0px 34px 0px = Top Right Bottom Left','mitup'),
		'section' => 'typography_section',
		'settings' => 'event_padding_logo',
		'type' =>'text'
	));	

	$wp_customize->add_setting( 'event_padding_logo_scroll', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '22px 0px 22px 0px',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('event_padding_logo_scroll', array(
		'label' => esc_html__('Padding Logo when scroll page','mitup'),
		'description' => esc_html__('For example: 22px 0px 22px 0px = Top Right Bottom Left','mitup'),
		'section' => 'typography_section',
		'settings' => 'event_padding_logo_scroll',
		'type' =>'text'
	));	

	$wp_customize->add_setting( 'event_padding_logo_height', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '19px',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('event_padding_logo_height', array(
		'label' => esc_html__('Logo Height when scroll page','mitup'),
		'description' => esc_html__('For example: 19px','mitup'),
		'section' => 'typography_section',
		'settings' => 'event_padding_logo_height',
		'type' =>'text'
	));	




	$wp_customize->add_setting( 'body_font', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'Roboto',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control( 
		new Google_Font_Dropdown_Custom_Control( 
		$wp_customize, 
		'body_font', 
		array(
			'label'          => esc_html__('Body font','mitup'),
            'section'        => 'typography_section',
            'settings'       => 'body_font',
		) ) 
	);



	$wp_customize->add_setting( 'heading_font', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'Ubuntu',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );
	
	$wp_customize->add_control(
		new Google_Font_Dropdown_Custom_Control( 
		$wp_customize, 
		'heading_font', 
		array(
			'label'          => esc_html__('Heading font','mitup'),
            'section'        => 'typography_section',
            'settings'       => 'heading_font',
		) ) 
	);

	$wp_customize->add_setting( 'main_color', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '#ffb03b',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'main_color', 
		array(
			'label'          => esc_html__("Main color",'mitup'),
            'section'        => 'typography_section',
            'settings'       => 'main_color',
		) ) 
	);


	$wp_customize->add_setting( 'menu_color', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '#ffffff',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'menu_color', 
		array(
			'label'          => esc_html__("Menu color",'mitup'),
            'section'        => 'typography_section',
            'settings'       => 'menu_color',
		) ) 
	);



	$wp_customize->add_setting( 'menushrink_color', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '#ffffff',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'menushrink_color', 
		array(
			'label'          => esc_html__("Menu shrink color",'mitup'),
            'section'        => 'typography_section',
            'settings'       => 'menushrink_color',
		) ) 
	);


	$wp_customize->add_setting( 'bgmenushrink_color', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '#000000',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'bgmenushrink_color', 
		array(
			'label'          => esc_html__("Background Menu shrink color",'mitup'),
            'section'        => 'typography_section',
            'settings'       => 'bgmenushrink_color',
		) ) 
	);


	$wp_customize->add_setting( 'event_custom_font', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'mitup_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('event_custom_font', array(
		'label' => esc_html__('Custom Font','mitup'),
		'description' => esc_html__('Step 1: Insert font-face in style.css file: Refer https://css-tricks.com/snippets/css/using-font-face/.  Step 2: Insert name-font here. For example: name-font1, name-font2','mitup'),
		'section' => 'typography_section',
		'settings' => 'event_custom_font',
		'type' =>'textarea'
	));	

	

	
	// /Typography setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	



}
add_action( 'customize_register', 'mitup_customize_register' );	

