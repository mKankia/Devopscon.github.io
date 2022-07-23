<?php
// Create sidebar
function mitup_second_widgets_init() {
  
  $args_blog = array(
    'name' => esc_html__( 'Main Sidebar', 'mitup'),
    'id' => "main-sidebar",
    'description' => esc_html__( 'Main Sidebar', 'mitup' ),
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $args_blog );

  $footer = array(
    'name' => esc_html__( 'Footer', 'mitup'),
    'id' => "footer",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer );


  $footer_social = array(
    'name' => esc_html__( 'Footer Social', 'mitup'),
    'id' => "footer_social",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_social );

  $footer_contact = array(
    'name' => esc_html__( 'Footer Contact', 'mitup'),
    'id' => "footer_contact",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_contact );

  $footer_mailchimp = array(
    'name' => esc_html__( 'Footer mailchimp', 'mitup'),
    'id' => "footer_sub",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_mailchimp );

  

}
add_action( 'widgets_init', 'mitup_second_widgets_init' );



