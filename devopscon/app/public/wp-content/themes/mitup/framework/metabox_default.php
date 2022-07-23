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



add_action( 'cmb2_init', 'mitup_metaboxes_default' );
function mitup_metaboxes_default() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'mitup_met_';

    

    
    /* Page Settings ***************************************************************************/
    /* ************************************************************************************/
    $page_settings = new_cmb2_box( array(
        'id'            => 'page_heading_settings',
        'title'         => esc_html__( 'Show Page Heading', 'mitup' ),
        'object_types'  => array( 'page'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        
    ) );

        // Display title of page
        $page_settings->add_field( array(
            'name'       => esc_html__( 'Show title of page', 'mitup' ),
            'desc'       => esc_html__( 'Allow display title of page', 'mitup' ),
            'id'         => $prefix . 'page_heading',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'yes' => esc_html__( 'Yes', 'mitup' ),
                'no'   => esc_html__('No', 'mitup' )
            ),
            'default' => 'yes',
            
        ) );

        // Blog page
        $page_settings->add_field( array(
            'name'       => esc_html__( 'Config Blog Page', 'mitup' ),
            'id'         => $prefix . 'blog_page',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                '1'   => esc_html__('1 Column', 'mitup' ),
                '2' => esc_html__( '2 Columns', 'mitup' ),
                '3'   => esc_html__('3 Columns', 'mitup' ),
                '4'   => esc_html__('4 Columns', 'mitup' )
            ),
            'default' => '3',
            
        ) );


 
   

    
    /* Post Settings *********************************************************************************/
    /* *******************************************************************************/
    $post_settings = new_cmb2_box( array(
        'id'            => 'post_video',
        'title'         => esc_html__( 'Post Settings', 'mitup' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

        // Video or Audio
        $post_settings->add_field( array(
            'name'       => esc_html__( 'Link audio or video', 'mitup' ),
            'desc'       => esc_html__( 'Insert link audio or video use for video/audio post-format', 'mitup' ),
            'id'         => $prefix . 'embed_media',
            'type'             => 'oembed',
        ) );


        // Gallery image
        $post_settings->add_field( array(
            'name'       => esc_html__( 'Gallery image', 'mitup' ),
            'desc'       => esc_html__( 'image in gallery post format', 'mitup' ),
            'id'         => $prefix . 'file_list',
            'type'             => 'file_list',
        ) );




    /* General Settings ***************************************************************/
    /* ********************************************************************************/
    $general_settings = new_cmb2_box( array(
        'id'            => 'layout_settings',
        'title'         => esc_html__( 'General Settings', 'mitup' ),
        'object_types'  => array( 'page', 'post'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

        $general_settings->add_field( array(
                'name'              => esc_html__( 'Choose theme location to display menu', 'mitup' ),
                'id'                => $prefix . 'location_theme',
                'type'              => 'select',
                'show_option_none'  => false,
                'options'           => array(
                    'primary'       => esc_html__( 'Primary', 'mitup' ),
                    'onepage'       => esc_html__('One page', 'mitup')
                ),
                'default' => 'primary',
                
            ) );

        $general_settings->add_field( array(
                'name'       => esc_html__( 'Background heading', 'mitup' ),
                'desc'       => esc_html__( 'You have to choose a background', 'mitup' ),
                'id'         => $prefix . 'general_bg_heading',
                'type'             => 'file',
                'allow' => array( 'url', 'attachment' )
            ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Title in heading', 'mitup' ),
            'id'         => $prefix . 'general_title_heading',
            'type'             => 'text'
        ) );
        $general_settings->add_field( array(
            'name'       => esc_html__( 'Sub title in heading', 'mitup' ),
            'id'         => $prefix . 'general_subtitle_heading',
            'type'             => 'text'
        ) );

        $general_settings->add_field(array(
            'name' => esc_html__( 'Background color for menu', 'mitup' ),
            'id'   => $prefix . 'bgcolor_menu',
            'type' => 'colorpicker',
            'desc' => esc_html__('Insert transparent to display transparent-background', 'mitup')
        ));



        $general_settings->add_field( array(
            'name'       => esc_html__( 'Header Version', 'mitup' ),
            'id'         => $prefix . 'header_version',
            'description' => esc_html__( 'This value will override value in customizer', 'mitup' ),
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => mitup_load_header_metabox(),
            'default' => 'global'
            
        ));

        $general_settings->add_field( array(
                'name'              => esc_html__( 'Menu Fixed', 'mitup' ),
                'id'                => $prefix . 'menu_fixed',
                'type'              => 'select',
                'show_option_none'  => false,
                'options'           => array(
                    'nofixed'       => esc_html__('No', 'mitup'),    
                    'fixed'       => esc_html__( 'Yes', 'mitup' )
                ),
                'default' => 'nofixed',
                
            ) );

        $general_settings->add_field( array(
                'name'              => esc_html__( 'Menu Sticky when scroll page', 'mitup' ),
                'id'                => $prefix . 'menu_sticky',
                'type'              => 'select',
                'show_option_none'  => false,
                'options'           => array(
                    'menu_sticky'       => esc_html__('Yes', 'mitup'),    
                    'nosticky'       => esc_html__( 'No', 'mitup' )
                ),
                'default' => 'menu_sticky',
                
            ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Footer Version', 'mitup' ),
            'id'         => $prefix . 'footer_version',
            'description' => esc_html__( 'This value will override value in customizer', 'mitup'  ),
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => mitup_load_footer_metabox(),
            'default' => 'global'

        ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Main Layout', 'mitup' ),
            'desc'       => esc_html__( 'This value will override value in theme customizer', 'mitup' ),
            'id'         => $prefix.'main_layout',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'global'   => esc_html__('Global in customizer', 'mitup' ),
                'right_sidebar' => esc_html__( 'Right Sidebar', 'mitup' ),
                'left_sidebar'   => esc_html__('Left Sidebar', 'mitup' ),
                'no_sidebar'   => esc_html__('No Sidebar', 'mitup' ),
                'full_width' => esc_html__('Full Width','mitup'),
            ),
            'default' => 'global',
            
        ) );


        $general_settings->add_field( array(
            'name'       => esc_html__( 'Width of site', 'mitup' ),
            'desc'       => esc_html__( 'This value will override value in theme customizer', 'mitup' ),
            'id'         => $prefix . 'width_site',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'global'    => esc_html__('Global in customizer', 'mitup'),
                'wide' => esc_html__( 'Wide', 'mitup' ),
                'boxed'   => esc_html__('Boxed', 'mitup' ),
            ),
            'default' => 'global',
            
        ) );

       

   
}

