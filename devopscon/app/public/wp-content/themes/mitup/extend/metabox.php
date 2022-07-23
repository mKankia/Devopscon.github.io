<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

add_action( 'cmb2_init', 'mitup_metaboxes' );
function mitup_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'mitup_met_';



    /* Slideshow Settings */        
    $cmb = new_cmb2_box( array(
        'id'            => 'slideshow_settings',
        'title'         => esc_html__( 'Slideshow Settings', 'mitup' ),
        'object_types'  => array( 'slideshow'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        
    ) );

            $cmb->add_field( array(
                'name'       => esc_html__( 'Choose template', 'mitup' ),
                'id'         => $prefix . 'slideshow_choose_template',
                'type'             => 'select',
                'show_option_none' => false,
                'options'          => array(
                    'basic'   => esc_html__('Basic', 'mitup' ),
                    'countdown' => esc_html__( 'Countdown', 'mitup' ),
                    'register'   => esc_html__('Register', 'mitup' ),
                    
                ),
                'default' => 'basic',
            ) );

            $cmb->add_field( array(
                'name'       => esc_html__( 'Background slide', 'mitup' ),
                'id'         => $prefix . 'slideshow_bg',
                'type'             => 'file',
                
            ) );

            $cmb->add_field( array(
                'name'       => esc_html__( 'Title', 'mitup' ),
                'id'         => $prefix . 'slideshow_title',
                'type'             => 'text',
                
            ) );

            $cmb->add_field( array(
                'name'       => esc_html__( 'Sub Title', 'mitup' ),
                'id'         => $prefix . 'slideshow_subtitle',
                'type'             => 'text',
                
            ) );

            $cmb->add_field( array(
                'name'       => esc_html__( 'Description', 'mitup' ),
                'id'         => $prefix . 'slideshow_desc',
                'type'             => 'textarea',
                
            ) );

             $cmb->add_field( array(
                'name'       => esc_html__( 'Countdown shortcode', 'mitup' ),
                'id'         => $prefix . 'slideshow_countdown_shortcode',
                'type'             => 'textarea',
                'description'=> esc_html__( 'Countdown shortcode like: [event_countdown end_day="05" end_month="1" end_year="2016" display_format="dHMS" timezone="0" years="years" months="months" weeks="weeks" days="days" hours="hours" minutes="minutes" seconds="seconds" year="year" month="month" week="week" day="day" hour="hour" minute="minute" second="second" animation="" animation_delay="0" class="" /] .You will find shortcode detail in the documentation', 'mitup' ),
                
            ) );

            $cmb->add_field( array(
                'name'       => esc_html__( 'Button shortcode', 'mitup' ),
                'id'         => $prefix . 'slideshow_button_shortcode',
                'type'             => 'textarea',
                'description'=> esc_html__( 'Button shortcode like: [event_button name="WATCH VIDEO" link="https://www.youtube.com/watch?v=nrJtHemSPW4" target="popup_video" bg="transparent" bg_hover="#44cb9a" text_color="#fff" text_color_hover="#fff" icon="fa-chevron-circle-right" border_radius="4px" border_color="#fff" border_color_hover="#44cb9a"  margin="2px 5px" animation="" animation_delay="0" class="" /] .You will find shortcode detail in the documentation', 'mitup' ),
                
            ) );

           

            $cmb->add_field( array(
                'name'       => esc_html__( 'Register shortcode', 'mitup' ),
                'id'         => $prefix . 'slideshow_register_shortcode',
                'type'             => 'textarea',
                'description'=> esc_html__( 'Register shortcode like: [event_registerform type="free" title="Register Free Form" subtitle="* We process using a 100% secure gateway" style="style1" buttontext="REGISTER FORM" iconbutton="fa-arrow-circle-o-right" id="" bg_button="#f74949" bg_button_hover="#fff" text_button_color="#fff" text_button_color_hover="#f74949" animation="" animation_delay="0" class=""  /] .You will find shortcode detail in the documentation', 'mitup' ),
                
            ) );




    /* Schedule Settings */        
    $cmb = new_cmb2_box( array(
        'id'            => 'schedule_settings',
        'title'         => esc_html__( 'Schedule Settings', 'mitup' ),
        'object_types'  => array( 'schedule'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        
    ) );
            // thumbnail image
            $cmb->add_field( array(
                'name'       => esc_html__( 'Background heading', 'mitup' ),
                'desc'       => esc_html__( 'You have to choose a background', 'mitup' ),
                'id'         => $prefix . 'schedule_bg_heading',
                'type'             => 'file',
                'allow' => array( 'url', 'attachment' )
            ) );

            /* Title */
            $cmb->add_field( array(
                'name'       => esc_html__( 'Title in heading', 'mitup' ),
                'id'         => $prefix . 'schedule_title_heading',
                'type'             => 'textarea'
            ) );
            /* subitle */
            $cmb->add_field( array(
                'name'       => esc_html__( 'Sub title in heading', 'mitup' ),
                'id'         => $prefix . 'schedule_subtitle_heading',
                'type'             => 'textarea'
            ) );
            $cmb->add_field( array(
                'name' => esc_html__('Time Text', 'mitup'),
                'desc' => esc_html__('For example: 45 minutes', 'mitup'),
                'id'   => $prefix . 'schedule_timetext',
                'type' => 'text',
            ));
            $cmb->add_field( array(
                'name' => esc_html__('icon for time', 'mitup'),
                'desc' => esc_html__('For example: fa-clock-o', 'mitup'),
                'id'   => $prefix . 'schedule_timeicon',
                'type' => 'text',               
            ));
            $cmb->add_field( array(
                'name' => esc_html__('intermediate', 'mitup'),
                'desc' => esc_html__('Intermediate', 'mitup'),
                'id'   => $prefix . 'schedule_intermediate',
                'type' => 'text',               
            ));
            $cmb->add_field( array(
                'name' => esc_html__('icon for Intermediate', 'mitup'),
                'desc' => esc_html__('For example: fa-signal', 'mitup'),
                'id'   => $prefix . 'speaker_intermediate_icon',
                'type' => 'text',               
            ));
            $cmb->add_field( array(
                'name' => esc_html__('Author', 'mitup'),
                'desc' => esc_html__('Author will speak: John Doe', 'mitup'),
                'id'   => $prefix . 'schedule_author',
                'type' => 'text',
            ));
            $cmb->add_field( array(
                'name' => esc_html__('Author Job', 'mitup'),
                'desc' => esc_html__('Job of author: CEO at Crown.io', 'mitup'),
                'id'   => $prefix . 'schedule_author_job',
                'type' => 'text',
            ));
            $cmb->add_field( array(
                'name' => esc_html__('Link of thumbnail', 'mitup'),
                'desc' => esc_html__('Insert link for thumbnail in home page', 'mitup'),
                'id'   => $prefix . 'schedule_link_speaker',
                'type' => 'text',
            ));
    
}

