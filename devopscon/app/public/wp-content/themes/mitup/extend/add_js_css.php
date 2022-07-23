<?php
add_action('wp_enqueue_scripts', 'mitup_theme_scripts_styles');
add_action('wp_enqueue_scripts', 'mitup_primary_color');


function mitup_theme_scripts_styles() {



    /* Add Javascript */

    $google_api_key = get_theme_mod('google_api_key', '');
    if($google_api_key){
        wp_enqueue_script('map', 'https://maps.googleapis.com/maps/api/js?key='.$google_api_key,array('jquery'),false,true);
    }else{
        wp_enqueue_script('map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false',array('jquery'),false,true);
    }
    
    wp_enqueue_style( 'mitup-fonts', mitup_customize_google_fonts(), array(), null );
    

    // enqueue the javascript that performs in-link comment reply fanciness
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' ); 
    }


    wp_enqueue_script('bootstrap_js', MITUP_THEME_URI.'/assets/plugins/bootstrap-3.3.5-dist/js/bootstrap.min.js',array('jquery'),false,true);
    wp_enqueue_script('owlcarousel2', MITUP_THEME_URI.'/assets/plugins/owlcarousel2/owl.carousel.min.js',array('jquery'),false,true);
    wp_enqueue_script('countdown_jquery', MITUP_THEME_URI.'/assets/plugins/countdown/jquery.plugin.min.js',array('jquery'),false,true);
    wp_enqueue_script('countdown', MITUP_THEME_URI.'/assets/plugins/countdown/jquery.countdown.min.js',array('jquery'),false,true);

    
    wp_enqueue_script('ajax-script', MITUP_THEME_URI.'/assets/js/registration.js',array('jquery'),false,true);
    if(!is_admin()){
      wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }
    
    wp_enqueue_script('waypoints', MITUP_THEME_URI.'/assets/plugins/waypoints/jquery.waypoints.min.js',array('jquery'),false,true);

    

    wp_enqueue_script('prettyphoto', MITUP_THEME_URI.'/assets/plugins/prettyPhoto/jquery.prettyPhoto.js',array('jquery'),false,true);
    wp_enqueue_script('superfish', MITUP_THEME_URI.'/assets/plugins/superfish/js/superfish.js',array('jquery'),false,true);
    wp_enqueue_script('onepagemenu', MITUP_THEME_URI.'/assets/plugins/jquery.nav.js',array('jquery'),false,true);
    wp_enqueue_script('bootstrap-select', MITUP_THEME_URI.'/assets/plugins/bootstrap-select/js/bootstrap-select.min.js',array('jquery'),false,true);

    

    wp_enqueue_script('mitup_theme', MITUP_THEME_URI.'/assets/js/theme.js',array('jquery'),false,true);
    wp_enqueue_script('mitup_theme-init', MITUP_THEME_URI.'/assets/js/theme_init.js',array('jquery'),false,true);


    /* Add Css */
    wp_enqueue_style('jquery-style', MITUP_THEME_URI.'/assets/css/jquery-ui.css');
    wp_enqueue_style('bootstrap_css', MITUP_THEME_URI.'/assets/plugins/bootstrap-3.3.5-dist/css/bootstrap.min.css');
    wp_enqueue_style('font_awesome', MITUP_THEME_URI.'/assets/plugins/font-awesome-4.4.0/css/font-awesome.min.css');
    wp_enqueue_style('owlcarousel2', MITUP_THEME_URI.'/assets/plugins/owlcarousel2/assets/owl.carousel.min.css');
    
    
    wp_enqueue_style('superfish-css', MITUP_THEME_URI.'/assets/plugins/superfish/css/superfish-navbar.css');
    wp_enqueue_style('fix_superfish', MITUP_THEME_URI.'/assets/css/fix_superfish.css');
    wp_enqueue_style('prettyphoto_css', MITUP_THEME_URI.'/assets/plugins/prettyPhoto/prettyPhoto.css');
    wp_enqueue_style('bootstrap-select-css', MITUP_THEME_URI.'/assets/plugins/bootstrap-select/css/bootstrap-select.min.css');
    
    wp_enqueue_style('animate', MITUP_THEME_URI.'/assets/css/animate.css');
    wp_enqueue_style('mitup_fix', MITUP_THEME_URI.'/assets/css/fix.css');

    if ( is_child_theme() ) {
      wp_enqueue_style( 'parent-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css', false );
    }
    wp_enqueue_style( 'mitup_event-style', get_stylesheet_uri(), array(), 'mitup' );


}



function mitup_primary_color(){ ?>

        

            <?php
                $main_color = get_theme_mod('main_color', '#ffb03b');
                $body_font = str_replace('ovatheme_','',get_theme_mod('body_font', 'Roboto'));
                $heading_font = str_replace('ovatheme_','',get_theme_mod('heading_font', 'Ubuntu'));

                $menu_color = get_theme_mod('menu_color', '#ffffff');
                $menushrink_color = get_theme_mod('menushrink_color', '#ffffff');
                $bgmenushrink_color = get_theme_mod('bgmenushrink_color', '#000000');

                $event_padding_logo = get_theme_mod('event_padding_logo', '30px 0px 30px 0px');
                $event_padding_logo_scroll = get_theme_mod('event_padding_logo_scroll', '22px 0px 2px 0px');
                $event_padding_logo_height = get_theme_mod('event_padding_logo_height', '19px');


            $custom_css = "
            .timer-loader:not(:required) {
                border-color: {$main_color};
            }
            .timer-loader:not(:required)::before {
                background: {$main_color};
            }
            .timer-loader:not(:required)::after {
                background: {$main_color};
            }

            @-webkit-keyframes timer-loader {
              0%,
              100% {
                box-shadow: 0 -3em 0 0.2em {$main_color}, 2em -2em 0 0em {$main_color}, 3em 0 0 -1em {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 -1em {$main_color}, -3em 0 0 -1em {$main_color}, -2em -2em 0 0 {$main_color};
              }
              12.5% {
                box-shadow: 0 -3em 0 0 {$main_color}, 2em -2em 0 0.2em {$main_color}, 3em 0 0 0 {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 -1em {$main_color}, -3em 0 0 -1em {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              25% {
                box-shadow: 0 -3em 0 -0.5em {$main_color}, 2em -2em 0 0 {$main_color}, 3em 0 0 0.2em {$main_color}, 2em 2em 0 0 {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 -1em {$main_color}, -3em 0 0 -1em {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              37.5% {
                box-shadow: 0 -3em 0 -1em {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0em 0 0 {$main_color}, 2em 2em 0 0.2em {$main_color}, 0 3em 0 0em {$main_color}, -2em 2em 0 -1em {$main_color}, -3em 0em 0 -1em {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              50% {
                box-shadow: 0 -3em 0 -1em {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0 0 -1em {$main_color}, 2em 2em 0 0em {$main_color}, 0 3em 0 0.2em {$main_color}, -2em 2em 0 0 {$main_color}, -3em 0em 0 -1em {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              62.5% {
                box-shadow: 0 -3em 0 -1em {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0 0 -1em {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 0 {$main_color}, -2em 2em 0 0.2em {$main_color}, -3em 0 0 0 {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              75% {
                box-shadow: 0em -3em 0 -1em {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0em 0 -1em {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 0 {$main_color}, -3em 0em 0 0.2em {$main_color}, -2em -2em 0 0 {$main_color};
              }
              87.5% {
                box-shadow: 0em -3em 0 0 {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0 0 -1em {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 0 {$main_color}, -3em 0em 0 0 {$main_color}, -2em -2em 0 0.2em {$main_color};
              }
            }
            @keyframes timer-loader {
              0%,
              100% {
                box-shadow: 0 -3em 0 0.2em {$main_color}, 2em -2em 0 0em {$main_color}, 3em 0 0 -1em {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 -1em {$main_color}, -3em 0 0 -1em {$main_color}, -2em -2em 0 0 {$main_color};
              }
              12.5% {
                box-shadow: 0 -3em 0 0 {$main_color}, 2em -2em 0 0.2em {$main_color}, 3em 0 0 0 {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 -1em {$main_color}, -3em 0 0 -1em {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              25% {
                box-shadow: 0 -3em 0 -0.5em {$main_color}, 2em -2em 0 0 {$main_color}, 3em 0 0 0.2em {$main_color}, 2em 2em 0 0 {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 -1em {$main_color}, -3em 0 0 -1em {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              37.5% {
                box-shadow: 0 -3em 0 -1em {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0em 0 0 {$main_color}, 2em 2em 0 0.2em {$main_color}, 0 3em 0 0em {$main_color}, -2em 2em 0 -1em {$main_color}, -3em 0em 0 -1em {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              50% {
                box-shadow: 0 -3em 0 -1em {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0 0 -1em {$main_color}, 2em 2em 0 0em {$main_color}, 0 3em 0 0.2em {$main_color}, -2em 2em 0 0 {$main_color}, -3em 0em 0 -1em {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              62.5% {
                box-shadow: 0 -3em 0 -1em {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0 0 -1em {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 0 {$main_color}, -2em 2em 0 0.2em {$main_color}, -3em 0 0 0 {$main_color}, -2em -2em 0 -1em {$main_color};
              }
              75% {
                box-shadow: 0em -3em 0 -1em {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0em 0 -1em {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 0 {$main_color}, -3em 0em 0 0.2em {$main_color}, -2em -2em 0 0 {$main_color};
              }
              87.5% {
                box-shadow: 0em -3em 0 0 {$main_color}, 2em -2em 0 -1em {$main_color}, 3em 0 0 -1em {$main_color}, 2em 2em 0 -1em {$main_color}, 0 3em 0 -1em {$main_color}, -2em 2em 0 0 {$main_color}, -3em 0em 0 0 {$main_color}, -2em -2em 0 0.2em {$main_color};
              }
            }
            /* /Loading */ 

            /* Font-family default Untubu */
            h1,h2,h3,h4,h5,h6,
            .events_countdown .countdown-section,
            .main_slider .item .title,
            #tabs-lv1 li a,
            .schedule_timeline .info_left .speaker_info .author,
            .events_price .price_title,
            .events_price .price_amount,
            .events-google-map .marker_title,
            .commentlists .author-name .name_author a,
            .events_speakers .media-body-old h4.media-heading,
            .topics_covered .media-heading a,
            button.submit-button,
            .subscribe_form input.submit,
            .events_contactform .events_submit,
            .sf-menu a,
            .page-section article.post-wrap .post-readmore a,
            .comment-form input[type='submit'],
            .contact_info .info,
            .schedule_timeline .item h2.post-title a,
            .schedule_timeline .info_left .speaker_info .author a,
            .events_price .price_value sub,
            .nearby_accomodation .media-heading,
            .ovatheme_form.style1 .title_form,
            .events-google-map .marker_title h4,
            .quickinfo .quick_content .title,
            .quickinfo .quick_content .description,
            .event_faq .vc_toggle_title,
            .faq_sec .vc_tta-panel-title>a,
            .event_countdown .countdown-section .countdown-amount,
            h3.event_heading span.title-inner,
            .faq_contact input.wpcf7-submit,
             #tabs-lv20 li a,
             footer .footer_sub input[type='submit'],
             .bg_heading h2,
             .from_our_blog article.post-wrap .post-readmore a,
             .nav_comment_text
            
            { 
              font-family: {$heading_font}, sans-serif;
              
            }
            .cbp-l-caption-title{
                font-family: {$heading_font}, sans-serif!important;
                letter-spacing: 0.2em!important;
                font-size: 14px!important;
                text-align: center!important;
                text-transform: uppercase!important;
            }

            .events_heading h2{
                font-family: {$heading_font}, sans-serif;
            }
            .sc_button a{
                font-family: {$heading_font}, sans-serif;
            }
            /* /Font-family default Untubu */

            /* cusbodyfont default Roboto */
            body,
            .main_slider .item .desc,
            .events_heading h3,
            .events_speakers .media-heading .media-info,
            .ovatheme_form input,
            .ovatheme_form textarea,
            .ovatheme_form select,
            .quickinfo .quick_content .time,
            .main_slider .item .sub_title,
            h3.event_heading small,
            .event_speakers .media-heading .media-info,
            .bg_heading .subtitle
            { 
              font-family: {$body_font}, sans-serif;
              font-weight: 300;
              
            }
            #cbpw-grid2 .cbp-l-caption-desc{
                font-family: {$body_font}, sans-serif!important;
                text-align: center!important;
            }

            .events-schedule-tabs.lv2 ul li.active{
            
                border-bottom-color: {$main_color};
            }
            .tooltip-inner{
                background-color: {$main_color};
            }
            .events-schedule-tabs.lv1 li.active a,
            .events-schedule-tabs.lv1 li.active a:hover,
            .schedule_timeline .info_left .speaker_info a:hover,
            .schedule_timeline .item h2.post-title a:hover,
            .topics_covered .media-other_desc li .fa{
                color: {$main_color};
            }
            .events-schedule-tabs.lv1 .nav>li>a:focus,
            .events-schedule-tabs.lv2 .nav>li>a:focus{
                background-color: transparent;
            }

            .schedule_single .quick_speaker .time,
            .schedule_single .quick_speaker .intermediate{
                color: {$main_color};
            }
            .from_our_blog .post-footer .post-readmore a,
            .nearby_accomodation .media-readmore a,
            .getintouch{
                border-color: {$main_color};
            }



            .sf-menu li:hover .show_dropmenu{
                color: {$main_color};
            }
            header ul.sf-menu li a{
                color: {$menu_color};   
            }
            header ul.sf-menu li a:hover,
            header ul.sf-menu li a.active{
                color: {$main_color}!important;   
            }
            .sf-menu>li>a.active>.af_border, 
            .sf-menu>li>a:hover>.af_border{
                    background-color: {$main_color}!important;  
            }

            



            /*header.alway_sticky,*/
            header .header_menu.shrink{
                background-color: {$bgmenushrink_color}; 
            }

            .sf-menu>li.current-menu-item>a{
                color: {$main_color}!important;
            }
            .sf-menu>li.current-menu-item>a>.af_border{
                border-bottom: 2px solid {$main_color};
            }


             .dropdown-menu>.active>a,
             header.fixed ul.sf-menu .dropdown-menu li.current a:hover,
             header .sf-menu .dropdown-menu a:hover{
                background-color: #f3f3f3;
                color: #5c5c5c!important;
             }

              header .header_menu.shrink ul.sf-menu li a{
                color: {$menushrink_color};
             }
             header .header_menu.shrink ul.sf-menu li.current a{
                color: {$main_color};
             }



            .address .media-desc,.events_speckers .media-heading .media-info,
            .events_registernow_text .register_text h5,
            .venue_location h4, .venue_location h5,
            .from_our_blog .post-title{
                font-family: {$heading_font}, sans-serif;
                font-weight: 300;
            }

            .topics_covered .media-title,
            .events_registernow_text .register_text h3{
                font-family: {$heading_font}, sans-serif; 
            }

            .square_countdown .events_countdown .countdown-section:nth-child(2),
            .square_countdown .events_countdown .countdown-section:nth-child(4){
                background-color: {$main_color};
            }

            a:hover{
                color: {$main_color}; 
            }
            .events_registernow_text .register_text h3 a:hover{
                color: {$main_color};    
            }
            .nearby_accomodation .price{
                background-color: {$main_color};   
            }
            .nearby_accomodation .price:before{
                border-top-color: {$main_color};
            }
            .nearby_accomodation .price:after{
                border-bottom-color: {$main_color};   
            }
            .nearby_accomodation .media-heading a:hover{
                color: {$main_color};
            }


            

             .events_heading hr{
                border-top: 3px solid {$main_color};   
                color: {$main_color};
             }
             .events_heading.sponsor_heading  hr{
                border-top: 3px solid {$main_color};   
                color: {$main_color};
             }

             .events_bgslide .owl-controls .owl-next{
                background-color: {$main_color};  
             }

            .events_speakers h4.media-heading a:hover,
            .events_speakers .media-social a:hover i{
                color:{$main_color}!important;
            }
            .from_our_blog .post-title a:hover,
            .from_our_blog .post-footer .post-readmore a
            {
                color:{$main_color};   
            }
            .contact_info .icon
            {
                border-color: {$main_color};
            }
            .contact_info .icon .fa{
                color: {$main_color};   
            }
            .topics_covered a:hover{
               color:{$main_color}!important;
            }
            .frequently_questions_item a:hover{
                color:{$main_color}!important;   
            }

            .events_contactform .button .events_submit:hover{
                background-color: {$main_color}!important;
            }

            footer.footer ul.social li a:hover{
                color: {$main_color};
                border-color: {$main_color};
            }

            .page-section article.post-wrap .post-title a:hover,
            article.post-wrap .post-meta .comment a:hover,
            #sidebar .widget a:hover
            {
                color: {$main_color};
            }
            .page-section article.post-wrap .post-readmore a:hover,
            .sidebar h4.widget-title:before
            {
                color: {$main_color};
            }
            #sidebar .widget_tag_cloud .tagcloud a:hover{
                background-color: {$main_color};
                border-color: {$main_color};
            }

            .sidebar .events_social_icon a:hover{
                color: {$main_color};
                border-color: {$main_color};   
            }
            .sidebar .events_social_icon a:hover i{
                color: {$main_color}!important;
            }
            .single .post-tag .post-tags a:hover{
                border-color: {$main_color};
                background-color: {$main_color};
                color: #fff;
            }
            .commentlists .author-name a:hover{
                color: {$main_color}!important;
            }
            .commentlists div.comment_date a,
            .commentlists div.comment_date .fa{
                color: {$main_color}!important;   
            }
            .comment-form textarea:focus, 
            .comment-form input:focus, 
            .content_comments input[type='text']:focus, 
            .content_comments textarea:focus{
                border-color: {$main_color};
            }

            footer.footer .scrolltop a:hover i{
                color: {$main_color};
            }
            .comment-form input[type='submit']:hover{
                background-color: {$main_color};   
            }

            .sticky{
                border-top: 5px solid {$main_color};
            }

            .address .pull-circle i{
                color: {$main_color};
            }

            h3.section-title.style1 span.fa-stack,
            h3.section-title.style2 span.fa-stack{
                background-color: {$main_color};
                color: #fff;
            }
            .event-schedule-tabs.lv1 ul li>a:hover,
            .event-schedule-tabs.lv1 ul li.active>a{
                color: {$main_color};
            }
            .event-schedule-tabs.lv2 ul li.active{
                border-bottom-color: {$main_color};
            }
            .event_service .fa{
                color: {$main_color};    
            }

            .schedule_timeline .item .quick_speaker .share_schedule a:hover{
                color: {$main_color};   
            }

            .list_speaker a:hover span{
                color: {$main_color};    
            }

            .event_speakers .event_speakers_item .media-social{
                background-color: {$main_color};
            }
            h3.event_heading.heading_color span.title-inner {
                color: {$main_color};
            }
            .faq_contact input.wpcf7-submit:hover{
                background-color: {$main_color};   
                border-color: {$main_color}!important;   
                color: #fff;
            }

            .owl-dots .owl-dot.active span,
            .owl-dots .owl-dot:hover span,
            .event_donation button {
              background-color: {$main_color}!important;  
            }
            
            footer .footer_sub input[type='submit']:hover{
                background-color: {$main_color};      
                color: #fff;
                 -webkit-transition: all .3s ease-in-out 0s;
                -moz-transition: all .3s ease-in-out 0s;
                -ms-transition: all .3s ease-in-out 0s;
                -o-transition: all .3s ease-in-out 0s;
                transition: all .3s ease-in-out 0s;
            } 
            
            .bg_heading h2,
            .main_slider .item .title{
              color: {$main_color};
            }



            @media (max-width: 990px){
                .schedule_single .item .info_left .speaker_info .author a:hover{
                    color: {$main_color};
                }
                .schedule_single .item .info_left .speaker_info .social a:hover{
                    color: {$main_color};   
                }
            }


            @media (max-width: 767px){

                header.header ul.sf-menu>li>a,
                header.header .sf-menu li a{
                    color: {$menushrink_color};    
                }



                .dropdown-menu>.active>a,
                header.header ul.sf-menu .dropdown-menu li.current a:hover,
                header .sf-menu .dropdown-menu a:hover,
                header.header ul.sf-menu>li>a:hover, header.header .sf-menu li a:hover{
                    background-color: transparent!important;
                    color: {$main_color}!important;
                }

                header.header {
                    background-color: {$bgmenushrink_color};
                }

                header.header .dropdown-menu{
                    background-color: {$bgmenushrink_color};   
                }
                .af_border{
                    display: none;
                }

            }
            header.header .logo{
                padding: {$event_padding_logo};
            }
            header .shrink .navbar-header a.navbar-brand{
                padding: {$event_padding_logo_scroll};
            }
            header .shrink .navbar-header a.navbar-brand.logo_image img{
                height:{$event_padding_logo_height};
            }
            ";

           wp_add_inline_style( 'mitup_event-style', $custom_css );

    }

/* Google Font */
function mitup_customize_google_fonts() {
    $fonts_url = '';

    $body_font = get_theme_mod('body_font', 'Roboto');
    $heading_font = get_theme_mod('heading_font', 'Ubuntu');
    
    $body_font_c = _x( 'on', $body_font.': on or off', 'mitup');
    $heading_font_c = _x( 'on', $heading_font.': on or off', 'mitup' );

 
    if ( 'off' !== $body_font_c || 'off' !== $heading_font_c ) {
        $font_families = array();
 
        if ( 'off' !== $body_font_c && strpos($body_font,'ovatheme_') === false ) {
            $font_families[] = $body_font.':100,200,300,400,500,600,700,800,900"';
        }
 
        if ( 'off' !== $heading_font_c  && strpos($heading_font,'ovatheme_') === false ) {
            $font_families[] = $heading_font.':100,200,300,400,500,600,700,800,900';
        }
        

        if($font_families != null){
          $query_args = array(
              'family' => urlencode( implode( '|', $font_families ) ),
              'subset' => urlencode( 'latin,latin-ext' ),
          );  
          $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }
        
 
        
    }
 
    return esc_url_raw( $fonts_url );
}


/************************************************************************************************/
/************************************************************************************************/

function mitup_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}

