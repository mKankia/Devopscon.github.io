<?php

// Get all file name in header
function mitup_load_header(){
    $files = array('default'=> esc_html__("Default","mitup" ) );
	return $files;
}

// Get all file name in footer
function mitup_load_footer(){
	$files = array('default'=> esc_html__("Default", "mitup") );
	return $files;
}

// Set header in metabox default
function mitup_load_header_metabox(){
    $files = array('global' => esc_html__("Global in Customizer","mitup") , 'default'=> esc_html__("Default","mitup") );
    return $files;
}

// Set footer in metabox default
function mitup_load_footer_metabox(){
    $files = array('global' => esc_html__("Global in Customizer","mitup" ), 'default'=> esc_html__("Default","mitup") );
    return $files;
}

// Get current header
function mitup_get_current_header(){
	// Get header default from customizer
	$customizer_header = get_theme_mod('header_version','default');
	// Get header from Post / Page setting
	$current_id = mitup_get_current_id();
  	$header = ( $current_id != '' && get_post_meta($current_id,'mitup_met_header_version', 'true') != 'global' && get_post_meta($current_id,'mitup_met_header_version', 'true') != '' ) ? get_post_meta($current_id,'mitup_met_header_version', 'true') : $customizer_header;
	return $header;
}


// Get current footer
function mitup_get_current_footer(){
	// Get header default from customizer
	$customizer_footer = get_theme_mod('footer_version','default');
	// Get footer from Post / Page setting
	$current_id = mitup_get_current_id();
  	$footer = ( $current_id != '' && get_post_meta($current_id,'mitup_met_footer_version', 'true') != 'global'  && get_post_meta($current_id,'mitup_met_footer_version', 'true') != '' ) ? get_post_meta($current_id,'mitup_met_footer_version', 'true') : $customizer_footer;
	
    return $footer;
}


// Get current main layout
function mitup_get_current_main_layout(){
    // Get header default from customizer
    $customizer_main_layout = get_theme_mod('main_layout','right_sidebar');
    // Get mainlayout from Post / Page setting
    $current_id = mitup_get_current_id();
    $mainlayout = ( $current_id != '' && get_post_meta($current_id,'mitup_met_main_layout', 'true') != 'global' && get_post_meta($current_id,'mitup_met_main_layout', 'true') != '' ) ? get_post_meta($current_id,'mitup_met_main_layout', 'true') : $customizer_main_layout;

    return $mainlayout;
}

// Get current width site
function mitup_get_current_width_site(){
    // Get header default from customizer
    $customizer_width_site = get_theme_mod('width_site','wide');
    // Get mainlayout from Post / Page setting
    $current_id = mitup_get_current_id();
    $width_site = ( $current_id != '' && get_post_meta($current_id,'mitup_met_width_site', 'true') != 'global' && get_post_meta($current_id,'mitup_met_width_site', 'true') != '' ) ? get_post_meta($current_id,'mitup_met_width_site', 'true') : $customizer_width_site;
    return $width_site;
}

// Get current ID of post/page, etc
function mitup_get_current_id(){
	global $post, $wp_query;
    $current_page_id = '';
    // Get The Page ID You Need
    if($current_page_id=='') {
        if ( is_home () && is_front_page () ) {
            $current_page_id = '';
        } elseif ( is_home () ) {
            $current_page_id = get_option ( 'page_for_posts' );
        } elseif ( is_search () || is_category () || is_tag () || is_tax () || is_archive() ) {
            $current_page_id = '';
        } elseif ( !is_404 () ) {
           $current_page_id = $post->ID;
        } 
    }

    return $current_page_id;
}




// Get width sidebar
function mitup_width_sidebar(){
    $main_layout = mitup_get_current_main_layout();
    $sidebar_column = get_theme_mod('sidebar_column','4');
    
    $col_width_sidebar = '';

    if($main_layout == 'left_sidebar'){
        switch ($sidebar_column) {

            case 1:
                $col_width_sidebar = 'col-md-1 col-md-pull-11';
                break;
            case 2:
                $col_width_sidebar = 'col-md-2 col-md-pull-10';
                break;
            case 3:
                $col_width_sidebar = 'col-md-3 col-md-pull-9';
                break;
            case 4:
                $col_width_sidebar = 'col-md-4 col-md-pull-8';
                break;
            case 5:
                $col_width_sidebar = 'col-md-5 col-md-pull-7';
                break;
            case 6:
                $col_width_sidebar = 'col-md-6 col-md-pull-6';
                break;
            default:
                $col_width_sidebar = 'col-md-4 col-md-pull-8';
                break;
        }


    }else if($main_layout == 'right_sidebar'){

        switch ($sidebar_column) {
            case 1:
                $col_width_sidebar = 'col-md-1';
                break;
            case 2:
                $col_width_sidebar = 'col-md-2';
                break;
            case 3:
                $col_width_sidebar = 'col-md-3';
                break;
            case 4:
                $col_width_sidebar = 'col-md-4';
                break;
            case 5:
                $col_width_sidebar = 'col-md-5';
                break;
            case 6:
                $col_width_sidebar = 'col-md-6';
                break;
            default:
                $col_width_sidebar = 'col-md-4';
                break;
        }

    }else if($main_layout == 'no_sidebar' || $main_layout == 'full_width'){

        $col_width_sidebar = '';

    }
    
    return $col_width_sidebar;
}

// Get main sidebar
function mitup_width_main_content(){
    $main_layout = mitup_get_current_main_layout();
    $main_column = get_theme_mod('main_column','8');

    $col_width_main = '';

    if($main_layout == 'left_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-md-6 col-md-push-6';
                break;
            case 7:
                $col_width_main = 'col-md-7 col-md-push-5';
                break;
            case 8:
                $col_width_main = 'col-md-8 col-md-push-4';
                break;
            case 9:
                $col_width_main = 'col-md-9 col-md-push-3';
                break;
            case 10:
                $col_width_main = 'col-md-10 col-md-push-2';
                break;
            case 11:
                $col_width_main = 'col-md-11 col-md-push-1';    
                break;
            default:
                $col_width_main = 'col-md-8 col-md-push-4';
                break;
        }

    }else if($main_layout == 'right_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-md-6';
                break;
            case 7:
                $col_width_main = 'col-md-7';
                break;
            case 8:
                $col_width_main = 'col-md-8';
                break;
            case 9:
                $col_width_main = 'col-md-9';
                break;
            case 10:
                $col_width_main = 'col-md-10';
                break;
            case 11:
                $col_width_main = 'col-md-11';    
                break;
            default:
                $col_width_main = 'col-md-8';
                break;
        }

    }else if($main_layout == 'no_sidebar'){

        $col_width_main = 'col-md-12';

    }else if($main_layout == 'full_width'){

        $col_width_main = '';

    }

    return $col_width_main;

}






