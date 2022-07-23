<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
	
	<!-- loading -->
	<?php if( get_theme_mod("display_loading","yes") != "no" ){  ?>
	   <div id="loading">
	        <div class="timer-loader">
	          <?php esc_html_e('Loading...','mitup'); ?>
	        </div>    
	    </div>
	<?php } ?>
	<!-- /loading -->

    <div class="ovatheme_container_<?php echo esc_attr(mitup_get_current_width_site()); ?>">
        <div class="wrapper">
    	
        <?php  $header = mitup_get_current_header(); 
			get_template_part( 'header/header', $header ); ?>

