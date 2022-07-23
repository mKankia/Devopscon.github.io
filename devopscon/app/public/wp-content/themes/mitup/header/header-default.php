<?php

    $general_bg_heading = get_post_meta( mitup_get_current_id(), "mitup_met_general_bg_heading", true ) ? get_post_meta( mitup_get_current_id(), "mitup_met_general_bg_heading", true ): ''; 
    $bgcolor_menu = get_post_meta( mitup_get_current_id(), "mitup_met_bgcolor_menu", true ) ? get_post_meta( mitup_get_current_id(), "mitup_met_bgcolor_menu", true ): 'transparent'; 

    $bg_mask_no = '';
    if($general_bg_heading != ''){
        $bgmenu = 'style="background:url('.esc_url($general_bg_heading).')"';
    }else if($bgcolor_menu != 'transparent'){
        $bgmenu = 'style="background-color:'.esc_html($bgcolor_menu).'"';
    }else{
        $bgmenu = 'style="background-color:'.esc_html($bgcolor_menu).'"';
        $bg_mask_no = 'no_mask';
    }


    $menu_fixed = get_post_meta( mitup_get_current_id(), "mitup_met_menu_fixed", true ) ? get_post_meta( mitup_get_current_id(), "mitup_met_menu_fixed", true ): 'nofixed'; 
    $menu_sticky = get_post_meta( mitup_get_current_id(), "mitup_met_menu_sticky", true ) ? get_post_meta( mitup_get_current_id(), "mitup_met_menu_sticky", true ): 'menu_sticky'; 

    $title_heading = get_post_meta( mitup_get_current_id(), "mitup_met_general_title_heading", true ) ? get_post_meta( mitup_get_current_id(), "mitup_met_general_title_heading", true ): ''; 
    $subtitle_heading = get_post_meta( mitup_get_current_id(), "mitup_met_general_subtitle_heading", true ) ? get_post_meta( mitup_get_current_id(), "mitup_met_general_subtitle_heading", true ): '';     
?>


<header class="header header_default wrap_<?php echo esc_attr($menu_fixed).' wrap_'.esc_attr($menu_sticky); ?>">

    <div class="header_menu <?php echo esc_attr($menu_fixed).' '.esc_attr($menu_sticky); ?>">
        <div class="container">
            <div class=" menu_pos">
                

                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                            <?php if( get_theme_mod( 'logo_img', '' ) != '' ) { ?>
                                <img src="<?php  echo esc_url( get_theme_mod('logo_img', '') ); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>"/>
                            <?php } else{  bloginfo('name'); } ?>
                        </a>
                    </div>
                    
                    <nav class="menutop navbar navbar-default ">
                       
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu_top" aria-expanded="false">
                                    <span class="sr-only"><?php esc_html_e('Toggle navigation', 'mitup'); ?></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                
                                <a class="navbar-brand logo_image" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php if( get_theme_mod( 'logo_img', '' ) != '' ) { ?>
                                        <img src="<?php  echo esc_url( get_theme_mod('logo_img', '') ); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>"/>   
                                    <?php } else{  bloginfo('name'); } ?>
                                </a>
                            </div>

                            <div class="collapse navbar-collapse" id="menu_top">
                                <?php
                                    $themelocation =  get_post_meta( mitup_get_current_id(), "mitup_met_location_theme", true) ? get_post_meta( mitup_get_current_id(), "mitup_met_location_theme", true):'primary';
                                    wp_nav_menu( array(
                                        'menu'              => '',
                                        'theme_location'    => $themelocation,
                                        'depth'             => 3,
                                        'container'         => '',
                                        'container_class'   => '',
                                        'container_id'      => '',
                                        'menu_class'        => 'sf-menu nav',
                                        'link_after'        => '',
                                        'fallback_cb'       => 'mitup_wp_bootstrap_navwalker::fallback',
                                        'walker'            => new mitup_wp_bootstrap_navwalker()
                                    ));
                                ?>
                            </div>
                        
                    </nav>
                
            </div>
        </div>
    </div>

    <?php if($bg_mask_no != 'no_mask'){ ?>
        <div class="bg_heading" <?php echo wp_kses($bgmenu, true); ?>>
            <div class="bg_mask <?php echo esc_attr($bg_mask_no); ?>"></div>
            <div class="container">
                <div class="row">
                    <?php if($title_heading != ''){ ?><h1><?php echo esc_html($title_heading); ?></h1><?php } ?>
                    <?php if($subtitle_heading != ''){ ?><div class="subtitle"><?php echo esc_html($subtitle_heading); ?></div> <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>


</header>
<!-- header -->


