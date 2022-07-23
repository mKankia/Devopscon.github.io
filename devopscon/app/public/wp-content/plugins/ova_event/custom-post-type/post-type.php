<?php if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Slideshow //////////////////////////////////////////
add_action( 'init', 'slideshow_init',0 );
function slideshow_init() {
    
    $labels = array(
        'name'               => __( 'Slideshows', 'post type general name', 'ova_event' ),
        'singular_name'      => __( 'Slide', 'post type singular name', 'ova_event' ),
        'menu_name'          => __( 'Slideshows', 'admin menu', 'ova_event' ),
        'name_admin_bar'     => __( 'Slide', 'add new on admin bar', 'ova_event' ),
        'add_new'            => __( 'Add New slide', 'Slide', 'ova_event' ),
        'add_new_item'       => __( 'Add New Slide', 'ova_event' ),
        'new_item'           => __( 'New Slide', 'ova_event' ),
        'edit_item'          => __( 'Edit Slide', 'ova_event' ),
        'view_item'          => __( 'View Slide', 'ova_event' ),
        'all_items'          => __( 'All Slides', 'ova_event' ),
        'search_items'       => __( 'Search Slides', 'ova_event' ),
        'parent_item_colon'  => __( 'Parent Slides:', 'ova_event' ),
        'not_found'          => __( 'No Slides found.', 'ova_event' ),
        'not_found_in_trash' => __( 'No Slides found in Trash.', 'ova_event' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-format-gallery',
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'slideshow' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail','comments'),
        'taxonomies'          => array('slidegroup'),
    );

    register_post_type( 'slideshow', $args );
}


add_action( 'init', 'create_slidegroup_taxonomies', 0 );
// create slidegroup taxonomy
function create_slidegroup_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => __( 'Group', 'taxonomy general name' , 'ova_event'),
        'singular_name'     => __( 'Group', 'taxonomy singular name' , 'ova_event'),
        'search_items'      => __( 'Search Group', 'ova_event'),
        'all_items'         => __( 'All Group', 'ova_event' ),
        'parent_item'       => __( 'Parent Group', 'ova_event' ),
        'parent_item_colon' => __( 'Parent Group:' , 'ova_event'),
        'edit_item'         => __( 'Edit Group' , 'ova_event'),
        'update_item'       => __( 'Update Group' , 'ova_event'),
        'add_new_item'      => __( 'Add New Group' , 'ova_event'),
        'new_item_name'     => __( 'New Group Name' , 'ova_event'),
        'menu_name'         => __( 'Group' , 'ova_event'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'slideshow' )
    );

    register_taxonomy( 'slidegroup', array('slideshow'), $args );
}







// Schedule /////////////////////////////////////////////////////////
add_action( 'init', 'schedule_post_type', 0 );
function schedule_post_type() {

    $labels = array(
        'name'                => __( 'Schedule', 'Post Type General Name', 'ova_event' ),
        'singular_name'       => __( 'Schedule', 'Post Type Singular Name', 'ova_event' ),
        'menu_name'           => __( 'Schedule', 'ova_event' ),
        'parent_item_colon'   => __( 'Parent Schedule:', 'ova_event' ),
        'all_items'           => __( 'All Schedules', 'ova_event' ),
        'view_item'           => __( 'View Schedule', 'ova_event' ),
        'add_new_item'        => __( 'Add New Schedule', 'ova_event' ),
        'add_new'             => __( 'Add New Schedule', 'ova_event' ),
        'edit_item'           => __( 'Edit Schedule', 'ova_event' ),
        'update_item'         => __( 'Update Schedule', 'ova_event' ),
        'search_items'        => __( 'Search Schedules', 'ova_event' ),
        'not_found'           => __( 'No Schedules found', 'ova_event' ),
        'not_found_in_trash'  => __( 'No Schedules found in Trash', 'ova_event' ),
    );
    $args = array(
        'label'               => __( 'schedule', 'ova_event' ),
        'description'         => __( 'Schedule information pages', 'ova_event' ),
        'labels'              => $labels,
        'supports'            => array( 'thumbnail', 'editor', 'title', 'comments','excerpt'),
        'taxonomies'          => array('categories'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'menu_icon'          => 'dashicons-calendar',
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,        
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'schedule', $args );
}

add_action( 'init', 'create_schedule_taxonomies', 0 );
// create categories taxonomy
function create_schedule_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => __( 'Categories', 'taxonomy general name' , 'ova_event'),
        'singular_name'     => __( 'Categories', 'taxonomy singular name' , 'ova_event'),
        'search_items'      => __( 'Search Categories', 'ova_event'),
        'all_items'         => __( 'All Categories', 'ova_event' ),
        'parent_item'       => __( 'Parent Category', 'ova_event' ),
        'parent_item_colon' => __( 'Parent Category:' , 'ova_event'),
        'edit_item'         => __( 'Edit Category' , 'ova_event'),
        'update_item'       => __( 'Update Category' , 'ova_event'),
        'add_new_item'      => __( 'Add New Category' , 'ova_event'),
        'new_item_name'     => __( 'New Category Name' , 'ova_event'),
        'menu_name'         => __( 'Categories' , 'ova_event'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'schedule' )        
    );

    register_taxonomy( 'categories', array('schedule'), $args );
}

