<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action('init','init_visual_composer_custom',1000);
function init_visual_composer_custom(){
    if(function_exists('vc_map')){

/* Main slider */

$args_slidegroup = array(
  'type'                     => 'post',
  'child_of'                 => 0,
  'parent'                   => '',
  'orderby'                  => 'name',
  'order'                    => 'ASC',
  'hide_empty'               => 1,
  'hierarchical'             => 1,
  'exclude'                  => '',
  'include'                  => '',
  'number'                   => '',
  'taxonomy'                 => 'slidegroup',
  'pad_counts'               => false 

);
$categories_slidegroup = get_categories($args_slidegroup);
$cate_array_slidegroup = array();
$empty_slidegroup = array("Select slide category" => "");
if ($categories_slidegroup) {
	foreach ( $categories_slidegroup as $cate ) {
		$cate_array_slidegroup[$cate->cat_name] = $cate->slug;
	}
} else {
	$cate_array_slidegroup["No content Category found"] = 0;
}


vc_map( array(
	 "name" => __("Main slider", 'ova_event'),
	 "base" => "event_main_slider",
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(

	 	array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Choose a slideshow category",'ova_event'),
	       "description" => __("Display categories that exists item. You need to add item in Slideshows >> Add new slide",'ova_event'),
	       "value" => array_merge($empty_slidegroup,$cate_array_slidegroup),
	       "param_name" => "slug_group",
	       "default"	=> "",
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("order by",'ova_event'),
	       "param_name" => "order_by",
	       "value" => array(   
		            __('id', 'ova_event') => 'id',
		            __('slug', 'ova_event') => 'name',
		            __('date', 'ova_event') => 'date',
		            __('modified', 'ova_event') => 'modified',
		            __('rand', 'ova_event') => 'rand',
		            ),
		    "default" => 'id'
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Order",'ova_event'),
	       "param_name" => "order",
	       "value" => array(
	       		__('DESC', 'ova_event') => "DESC",
	       		__('ASC', 'ova_event') => "ASC",
	       	),
	       "default"	=> "DESC"
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Count slide",'ova_event'),
	       "param_name" => "count",
	       "value"	=> "100"
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Auto slider",'ova_event'),
	       "param_name" => "auto_slider",
	       "value" => array(
	       		__('True', 'ova_event') => "true",
	       		__('False', 'ova_event') => "false",
	       	),
	       "default"	=> "true"
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Duration of slider(ms). 1000ms = 1s",'ova_event'),
	       "param_name" => "duration",
	       "value"	=> '3000'
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Navigation",'ova_event'),
	       "param_name" => "navigation",
	       "value" => array(
	       		__('True', 'ova_event') => "true",
	       		__('False', 'ova_event') => "false",
	       	),
	       "default"	=> "true"
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Loop",'ova_event'),
	       "param_name" => "loop",
	       "value" => array(
	       		esc_html__('True', 'ova_event') => "true",
	       		esc_html__('False', 'ova_event') => "false",
	       	),
	       "default"	=> "true"
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => esc_html__("Display cover background",'ova_event'),
	       "param_name" => "cover_bg",
	       "value" => array(
	       		__('True', 'ova_event') => "true",
	       		__('False', 'ova_event') => "false",
	       	),
	       "default"	=> "true"
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Height desk",'ova_event'),
	       "param_name" => "height_desk",
	       "value" => "680px",
	       "description" => esc_html__('Insert class to use for your style','ova_event')
	    ),
	     array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Height Ipad",'ova_event'),
	       "param_name" => "height_ipad",
	       "value" => "768px",
	       "description" => esc_html__('Insert class to use for your style','ova_event')
	    ),
	      array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Height Mobile",'ova_event'),
	       "param_name" => "height_mobile",
	       "value" => "800px",
	       "description" => esc_html__('Insert class to use for your style','ova_event')
	    ),
		array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Class",'ova_event'),
	       "param_name" => "class",
	       "value" => "",
	       "description" => esc_html__('Insert class to use for your style','ova_event')
	    )

	 
)));

vc_map( array(
	 "name" => __("Button", 'ova_event'),
	 "base" => "event_button",
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(

	 	array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Name",'ova_event'),
	       "param_name" => "name",
	       "value" => ""
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Link",'ova_event'),
	       "param_name" => "link",
	       "value" => ""
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Target",'ova_event'),
	       "param_name" => "target",
	       "value" => array(
	       		__('Scroll', 'ova_event') => "scroll",
	       		__('Blank', 'ova_event') => "_blank",
	       		__('Parent', 'ova_event') => "_parent",
	       		__('Top', 'ova_event') => "_top",
	       		__('Popup Video', 'ova_event') => "popup_video",
	       	),
	       "default"	=> "scroll"
	    ),
	    array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Background color",'ova_event'),
	       "param_name" => "bg",
	    ),
	    array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Background color hover",'ova_event'),
	       "param_name" => "bg_hover",
	    ),
	    array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Text color",'ova_event'),
	       "param_name" => "text_color",
	    ),
	    array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Text color hover",'ova_event'),
	       "param_name" => "text_color_hover",
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Icon",'ova_event'),
	       "param_name" => "icon",
	       "value" => "",
	       "description" => 'Insert font-awesome. You can find here: https://fortawesome.github.io/Font-Awesome/cheatsheet/'
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Border radius",'ova_event'),
	       "param_name" => "border_radius",
	       "value" => "",
	       "description" => 'For example: 30px;'
	    ),
    	array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Border color",'ova_event'),
	       "param_name" => "border_color",
	       "value" => ""
	    ),
	    array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Border color hover",'ova_event'),
	       "param_name" => "border_color_hover",
	       "value" => ""
	    ),
	    
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Margin (px)",'ova_event'),
	       "param_name" => "margin",
	       "value" => "",
	       "description" => 'For example: 10px 10px 10px 10px; = (top right bellow left)'
	    ),
	   
	    
	    
		array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Class",'ova_event'),
	       "param_name" => "class",
	       "value" => "",
	       "description" => 'Insert class to use for your style'
	    )

	 
)));

/* Countdown */
vc_map( array(
	 "name" => __("Countdown", 'ova_event'),
	 "base" => "event_countdown",
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(
	  
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("End day",'ova_event'),
		       "param_name" => "end_day",
		       "value" => "",
		       "description" => __('For example: 10','ova_event')

		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("End Month",'ova_event'),
		       "param_name" => "end_month",
		       "value" => "",
		       "description" => __('Insert from 1 to 12. For example: 5','ova_event')

		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("End Year",'ova_event'),
		       "param_name" => "end_year",
		       "value" => "",
		       "description" => __('For example: 2015','ova_event')

		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Display format",'ova_event'),
		       "param_name" => "display_format",
		       "value" => "dHMS",
		       "description" => __("Display Format: dHMS. d: Day, H: Hour, M: Month, S: Second. You can insert HMS or dHM or dH. default dHMS",'ova_event')          
		  ),
		  
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Time zone",'ova_event'),
		       "param_name" => "timezone",
		       "value" => "0",
		       "description" => __('The timezone (hours or minutes from GMT) for the target times. <br/>
					For example:<br/>
					If Timezone is UTC-9:00 you have to insert -9 <br/>
					If Timezone is UTC-9:30, you have to insert -9*60+30=-570. <br/>
					Read about UTC Time: http://en.wikipedia.org/wiki/List_of_UTC_time_offsets','ova_event') 
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label Years",'ova_event'),
		       "param_name" => "years",
		       "value" => "years"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label months",'ova_event'),
		       "param_name" => "months",
		       "value" => "months"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label weeks",'ova_event'),
		       "param_name" => "weeks",
		       "value" => "weeks"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label days",'ova_event'),
		       "param_name" => "days",
		       "value" => "days"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label hours",'ova_event'),
		       "param_name" => "hours",
		       "value" => "hours"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label minutes",'ova_event'),
		       "param_name" => "minutes",
		       "value" => "minutes"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label seconds",'ova_event'),
		       "param_name" => "seconds",
		       "value" => "seconds"
		  ),

		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label Year",'ova_event'),
		       "param_name" => "year",
		       "value" => "year"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label month",'ova_event'),
		       "param_name" => "month",
		       "value" => "month"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label week",'ova_event'),
		       "param_name" => "week",
		       "value" => "week"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label day",'ova_event'),
		       "param_name" => "day",
		       "value" => "day"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label hour",'ova_event'),
		       "param_name" => "hour",
		       "value" => "hour"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label minute",'ova_event'),
		       "param_name" => "minute",
		       "value" => "minute"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("label second",'ova_event'),
		       "param_name" => "second",
		       "value" => "second"
		  ),
		  
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Class",'ova_event'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => 'Insert class to use for your style'
		  )

	 
)));


/* Register form */
vc_map( array(
	 "name" => __("Register form", 'ova_event'),
	 "base" => "event_registerform",
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(
	  
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Type",'ova_event'),
				"param_name" => "type",
				"value" => array(
						__('Free', 'ova_event') => "free",
						__('Paypal', 'ova_event') => "pay",
						
					),
				"default"	=> "free"
			),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Title",'ova_event'),
		       "param_name" => "title",
		       "value" => "Register Now",
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Sub title",'ova_event'),
		       "param_name" => "subtitle",
		       "value" => "* We process using a 100% secure gateway"

		  ),
		  array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Style",'ova_event'),
				"param_name" => "style",
				"value" => array(
						__('Style 1', 'ova_event') => "style1",
						__('Style 2', 'ova_event') => "style2",
						
					),
				"default"	=> "style1"
			),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Button text",'ova_event'),
		       "param_name" => "buttontext",
		       "value" => "Register Now"
		  ),
		  
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("button icon. insert font-awesome",'ova_event'),
		       "param_name" => "iconbutton",
		       "value" => "fa-arrow-circle-o-right"
		  ),
		  array(
		       "type" => "colorpicker",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("button background color",'ova_event'),
		       "param_name" => "bg_button",
		       "value" => "#f74949"
		  ),
		  array(
		       "type" => "colorpicker",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("button hover background color",'ova_event'),
		       "param_name" => "bg_button_hover",
		       "value" => "#ffffff"
		  ),
		  array(
		       "type" => "colorpicker",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("text button color",'ova_event'),
		       "param_name" => "text_button_color",
		       "value" => "#ffffff"
		  ),
		  array(
		       "type" => "colorpicker",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("text button hover color",'ova_event'),
		       "param_name" => "text_button_color_hover",
		       "value" => "#f74949"
		  ),
		  
		array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Class",'ova_event'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => 'Insert class to use for your style'
		)

	 
)));



/* Event Heading*/
vc_map( array(
       "name" => __("heading", 'ova_event'),
       "base" => "event_heading",
       "class" => "",
       "category" => __("My shortcode", 'ova_event'),
       "icon" => "icon-qk",   
       "params" => array(
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Title",'ova_event'),
             "param_name" => "title",
             "value" => ""
          ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Sub Title",'ova_event'),
             "param_name" => "subtitle",
             "value" => ""
          ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("FontAwesome",'ova_event'),
             "param_name" => "fontclass",
             "value" => "",
             "description" => 'You can find fontclass here: http://fontawesome.io/icons/ For instance: fa-star'
          ),
        array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Style ",'ova_event'),
				"param_name" => "style",
				"value" => array(
			            __('Style 1', 'ova_event') => 'style1',
			            __('Style 2', 'ova_event') => 'style2'
			            ),
			    "default" => 'style1'
		  ),
        
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Class",'ova_event'),
             "param_name" => "class",
             "value" => ""
          ),
        
       )
) );


/* Schedule */
vc_map( array(
	 "name" => __("Schedule", 'ova_event'),
	 "base" => "event_schedule",
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Insert Parent Category (category level 1)",'ova_event'),
		       "param_name" => "array_slug",
		       "description"	=> esc_html__('Go to Schedule >> Categories >> copy value in slug filed of category level 1. For example: sep-26-2015,sep-27-2015,sep-28-2015,sep-29-2015','ova_event'),
		       "value" => ""
		  ),
		  array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Display sub-category (category level 2) order by: ",'ova_event'),
				"param_name" => "order_by_subcat",
				"value" => array(
			            __('ID', 'ova_event') => 'id',
			            __('Count', 'ova_event') => 'count',
			            __('Slug', 'ova_event') => 'slug',
			            ),
			    "default" => 'id'
		  ),
		  array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Display sub-category (category level 2) order: ",'ova_event'),
				"param_name" => "order_subcat",
				"value" => array(
						__('asc', 'ova_event') => 'asc',
						__('desc', 'ova_event') => 'desc',
					),
				"default"	=> 'asc'
		),
		  
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Item count in each sub-category",'ova_event'),
		       "param_name" => "schedule_count",
		       "value" => "50"
		  ),
		  array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Display item list order by: ",'ova_event'),
				"param_name" => "order_by_item",
				"value" => array(
			            __('id', 'ova_event') => 'id',
			            __('slug', 'ova_event') => 'slug',
			            __('date', 'ova_event') => 'date',
			            __('modified', 'ova_event') => 'modified',
			            __('rand', 'ova_event') => 'rand',
			            ),
			    "default" => 'id'
		  ),
		  array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Display item list order: ",'ova_event'),
				"param_name" => "order_item",
				"value" => array(
						__('asc', 'ova_event') => "asc",
						__('desc', 'ova_event') => "desc",
					),
				"default"	=> "asc"
		),
		
		array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Disable link of title",'ova_event'),
				"param_name" => "turnofflink",
				"value" => array(
						__('No', 'ova_event') => "no",
						__('Yes', 'ova_event') => "yes",
						
					),
				"default"	=> "no"
		),
		array(
		   "type" => "colorpicker",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("Time color",'ova_event'),
		   "param_name" => "time_color",
		   "value" => "#44cb9a"
		),
		array(
		   "type" => "colorpicker",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("Intermediate color",'ova_event'),
		   "param_name" => "intermediate_color",
		   "value" => "#fac42b"
		),
		
		
		array(
		   "type" => "textfield",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("Class",'ova_event'),
		   "param_name" => "class",
		   "value" => "",
		   "description" => 'Insert class to use for your style'
		)
	 
)));
/* /Schedule */


/*event_address vc_map*/
vc_map( array(
	 "name" => __("Address", 'ova_event'),
	 "base" => "event_address",
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(

	 	array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Font awesome",'ova_event'),
	       "param_name" => "fonts_icon",
	       "value" => "",
	       "description" => 'Insert font-awesome. For example: fa-heart. You can find here: https://fortawesome.github.io/Font-Awesome/cheatsheet/'
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Direction",'ova_event'),
	       "param_name" => "direction",
	       "value" => array(
	       		__('Left', 'ova_event') => "text-left",
	       		__('Right', 'ova_event') => "text-right",
	       	),
	       "default"	=> "text-left"
	    ),array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title",'ova_event'),
	       "param_name" => "title",
	       "value" => ""
	    ),array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title color",'ova_event'),
	       "param_name" => "title_color",
	    ),array(
	       "type" => "textarea",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Description",'ova_event'),
	       "param_name" => "description",
	       "value" => ""
	    ),array(
	       "type" => "checkbox",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Border Right",'ova_event'),
	       "param_name" => "show_border_right",
	       'value' => array( __( 'Yes', 'js_composerp' ) => true ),
	    ),
	    array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Border color",'ova_event'),
	       "param_name" => "border_color",
	    ),
	    
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Class",'ova_event'),
	       "param_name" => "class",
	       "value" => ""
	    )

	 //show_border_right
)));
/*end event*/

/*event topic*/
vc_map( array(
	 "name" => __("Topics", 'ova_event'),
	 "base" => "event_topics_covered",
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(

	 	array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Font awesome",'ova_event'),
	       "param_name" => "fonts_icon",
	       "value" => "",
	       "description" => 'For example: fa-heart. Insert font-awesome. You can find here: https://fortawesome.github.io/Font-Awesome/cheatsheet/'
	    ),
	    array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Align",'ova_event'),
	       "param_name" => "align",
	       "value" => array(
	       		__('Left', 'ova_event') => "text-left",
	       		__('Right', 'ova_event') => "text-right",
	       		__('Center', 'ova_event') => "text-center",
	       	),
	       "default"	=> "text-left"
	    ),array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Icon color",'ova_event'),
	       "param_name" => "icon_color",
	    )
	    ,array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title",'ova_event'),
	       "param_name" => "title",
	       "value" => ""
	    ),array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title color",'ova_event'),
	       "param_name" => "title_color",
	    ),array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title Link",'ova_event'),
	       "param_name" => "title_link",
	       "value" => "",
	       "description" => 'For example:http://ovatheme.com'
	    ),array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Target Link",'ova_event'),
	       "param_name" => "target_link",
	       "value" => array(
	       		__('Self', 'ova_event') => "_self",
	       		__('Blank', 'ova_event') => "_blank",
	       		__('Parent', 'ova_event') => "_parent",
	       		__('Top', 'ova_event') => "_top",
	       	),
	       "default"	=> "_self"
	    )
	    ,array(
	       "type" => "textarea",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Info",'ova_event'),
	       "param_name" => "description",
	       "value" => ""
	    ),array(
	       "type" => "textarea_html",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Description",'ova_event'),
	       "param_name" => "content",
	       "value" => "",
	       "description" => __("Open text tab and insert code like: &lt;ul&gt;
	&lt;li&gt;&lt;i class=&quot;fa fa-angle-right&quot;&gt;&lt;/i&gt;&lt;a href=&quot;#&quot;&gt;Introduction to WordPress&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;i class=&quot;fa fa-angle-right&quot;&gt;&lt;/i&gt;&lt;a href=&quot;#&quot;&gt;How WordPress changed the web&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;i class=&quot;fa fa-angle-right&quot;&gt;&lt;/i&gt;&lt;a href=&quot;#&quot;&gt;Why developers love ?&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;i class=&quot;fa fa-angle-right&quot;&gt;&lt;/i&gt;&lt;a href=&quot;#&quot;&gt;Improving WordPress workflow&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;",'ova_event')
	    ),
	    
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Class",'ova_event'),
	       "param_name" => "class",
	       "value" => ""
	    )
)));
/*End topic*/




/* Speakers */
vc_map( array(
    "name" => __("Speakers", 'ova_event'),
    "base" => "event_speakers",
    "class" => "",
    "category" => __("My shortcode", 'ova_event'),
    "icon" => "icon-qk",
    "as_parent" => array('only' => 'event_speakers_item', ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "js_view" => 'VcColumnView',
    "show_settings_on_create" => false,
    "params" => array(
        
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Item count in each slide",'ova_event'),
            "param_name" => "count",
            "value" => "3"
        ),       
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Duration ms. 1000ms=3s",'ova_event'),
            "param_name" => "duration",
            "value" => "3000"
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Auto play",'ova_event'),
            "param_name" => "autoplay",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Display pagination",'ova_event'),
            "param_name" => "dots",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Loop",'ova_event'),
            "param_name" => "loop",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Class",'ova_event'),
             "param_name" => "class",
             "default"  => ''
        ),

       
)));
/* /Speaker */


/*event speakers item*/

vc_map( array(
	 "name" => __("Speakers item", 'ova_event'),
	 "base" => "event_speakers_item",
	 "as_child" => array('only' => 'event_speakers'),
     "content_element" => true,
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(

	 	array(
	       "type" => "attach_image",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Thumbnail",'ova_event'),
	       "param_name" => "thumb_image",
	       "value" => "",
	       "description" =>  __("Insert path of thumbnail",'ova_event')
	    ),array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title",'ova_event'),
	       "param_name" => "title",
	       "value" => ""
	    ),array(
	       "type" => "colorpicker",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title color",'ova_event'),
	       "param_name" => "title_color",
	    ),array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title Link",'ova_event'),
	       "param_name" => "title_link",
	       "value" => "",
	       "description" => 'For example:http://ovatheme.com'
	    ),array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Job",'ova_event'),
	       "param_name" => "job",
	       "value" => ""
	    ),array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Target Link",'ova_event'),
	       "param_name" => "target_link",
	       "value" => array(
	       		__('Self', 'ova_event') => "_self",
	       		__('Blank', 'ova_event') => "_blank",
	       		__('Parent', 'ova_event') => "_parent",
	       		__('Top', 'ova_event') => "_top",
	       	),
	       "default"	=> "_self"
	    ),
	    array(
	       "type" => "textarea_raw_html",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("social icon",'ova_event'),
	       "param_name" => "content",
	       "value" => "",
	       "description" => __("click text tab and insert code like:<br/> &lt;ul&gt;
	&lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-facebook&quot;&gt;&lt;/i&gt;&lt;span class=&quot;hidden&quot;&gt;fb&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-twitter&quot;&gt;&lt;/i&gt;&lt;span class=&quot;hidden&quot;&gt;twitter&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-youtube&quot;&gt;&lt;/i&gt;&lt;span class=&quot;hidden&quot;&gt;youtube&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;",'ova_event')
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Class",'ova_event'),
	       "param_name" => "class",
	       "value" => ""
	    )
)));


 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_event_speakers extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_event_speakers_item extends WPBakeryShortCode {
    }
}

/* /Speakers item */


/*End speakers*/







/* background slide */
vc_map( array(
    "name" => __("Background slider", 'ova_event'),
    "base" => "event_bgslide",
    "class" => "",
    "category" => __("My shortcode", 'ova_event'),
    "icon" => "icon-qk",
    "as_parent" => array('only' => 'event_bgslide_item', ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "js_view" => 'VcColumnView',
    "show_settings_on_create" => false,
    "params" => array(
        
            
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Duration ms. 1000ms=3s",'ova_event'),
            "param_name" => "duration",
            "value" => "3000"
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Auto play",'ova_event'),
            "param_name" => "auto_slider",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Display navigation",'ova_event'),
            "param_name" => "navigation",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Loop",'ova_event'),
            "param_name" => "loop",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Class",'ova_event'),
             "param_name" => "class",
             "default"  => ''
        ),

       
)));
/* /background slide */


/* background slide item*/

vc_map( array(
	 "name" => __("Background Slide item", 'ova_event'),
	 "base" => "event_bgslide_item",
	 "as_child" => array('only' => 'event_bgslide'),
     "content_element" => true,
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(

	 	array(
	       "type" => "attach_image",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Thumbnail",'ova_event'),
	       "param_name" => "thumb_image",
	       "value" => "",
	       "description" =>  __("Insert path of thumbnail",'ova_event')
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Class",'ova_event'),
	       "param_name" => "class",
	       "value" => ""
	    )
)));


 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_event_bgslide extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_event_bgslide_item extends WPBakeryShortCode {
    }
}

/* /background slide item*/









/*event Nearby Accomodation*/
vc_map( array(
 "name" => __("Nearby Accomodation", 'ova_event'),
 "base" => "event_nearby_accomodation",
 "class" => "",
 "category" => __("My shortcode", 'ova_event'),
 "icon" => "icon-qk",   
 "params" => array(
	array(
	   "type" => "attach_image",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("Thumbnail",'ova_event'),
	   "param_name" => "thumbnail",
	   "value" => "",
	   "description" =>  __("Insert path of thumbnail",'ova_event')
    ),
    array(
	   "type" => "textfield",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("Price",'ova_event'),
	   "param_name" => "price",
	   "value" => ""
	),
	array(
	   "type" => "textfield",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("Title",'ova_event'),
	   "param_name" => "title",
	   "value" => ""
	),
	array(
	   "type" => "colorpicker",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("Title color",'ova_event'),
	   "param_name" => "title_color",
	),array(
	   "type" => "textfield",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("Title Link",'ova_event'),
	   "param_name" => "title_link",
	   "value" => "",
	   "description" => 'For example:http://ovatheme.com'
	),array(
	   "type" => "dropdown",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("Target Link",'ova_event'),
	   "param_name" => "target_link",
	   "value" => array(
	   		__('Self', 'ova_event') => "_self",
	   		__('Blank', 'ova_event') => "_blank",
	   		__('Parent', 'ova_event') => "_parent",
	   		__('Top', 'ova_event') => "_top",
	   	),
	   "default"	=> "_self"
	)
	,array(
	   "type" => "textarea",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("Description",'ova_event'),
	   "param_name" => "description",
	   "value" => ""
	),
	array(
	   "type" => "textfield",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("name readmore",'ova_event'),
	   "param_name" => "readmore",
	   "value" => ""
	),
	
	array(
	   "type" => "colorpicker",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("readmore color",'ova_event'),
	   "param_name" => "readmore_color",
	   "value" => ""
	)
 )
));  

/*End event Nearby Accomodation*/

/*event From our blog*/
$args = array(
  'orderby' => 'name',
  'order' => 'ASC'
  );

$categories=get_categories($args);
$cate_array = array();$arrayCateAll = array('All categories ' => 'all' );
if ($categories) {
	foreach ( $categories as $cate ) {
		$cate_array[$cate->cat_name] = $cate->cat_ID;
	}
} else {
	$cate_array["No content Category found"] = 0;
}
vc_map( array(
	 "name" => __("From Our Blog", 'ova_event'),
	 "base" => "event_from_our_blog",
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(
	 	array(
	       "type" => "dropdown",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Category",'ova_event'),
	       "param_name" => "category",
	       "value" => array_merge($arrayCateAll,$cate_array),
	       "description" => __("Choose a Content Category from the drop down list.", 'ova_event')
	    ),array(
    	   "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Total item show",'ova_event'),
	       "param_name" => "total_count",
	       "value" => "20",
	       "description" => __('For example: 10','ova_event')
	     ),
	    array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Columns show",'ova_event'),
			"param_name" => "cols_count",
			"value" => array(
					__('1 Columns', 'ova_event') => "1",
					__('2 Columns', 'ova_event') => "2",
					__('3 Columns', 'ova_event') => "3",
					__('4 Columns', 'ova_event') => "4",
					__('5 Columns', 'ova_event') => "5",
					__('6 Columns', 'ova_event') => "6"
					
				),
			"default"	=> "3"
		),array(
    	   "type" => "checkbox",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Show image thumbnail",'ova_event'),
	       "param_name" => "show_thumb",
	       'value' => array( __( 'Yes', 'js_composerp' ) => true ),
	     ),array(
    	   "type" => "checkbox",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Show title",'ova_event'),
	       "param_name" => "show_title",
	       'value' => array( __( 'Yes', 'js_composerp' ) => true ),
	     ),array(
    	   "type" => "checkbox",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Show description",'ova_event'),
	       "param_name" => "show_desc",
	       'value' => array( __( 'Yes', 'js_composerp' ) => true ),
	     ),array(
    	   "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Text readmore",'ova_event'),
	       "param_name" => "name_readmore",
	       "value" => "",
	       "description" => __('For example: Read more','ova_event')
	     ),array(
    	   "type" => "checkbox",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Show read more",'ova_event'),
	       "param_name" => "show_readmore",
	       'value' => array( __( 'Yes', 'js_composerp' ) => true ),
	     ),array(
    	   "type" => "checkbox",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Show author",'ova_event'),
	       "param_name" => "show_author",
	       'value' => array( __( 'Yes', 'js_composerp' ) => true ),
	     ),
	     array(
    	   "type" => "checkbox",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Show date create",'ova_event'),
	       "param_name" => "show_create_date",
	       'value' => array( __( 'Yes', 'js_composerp' ) => true ),
	     ),
	     array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Duration ms. 1000ms=3s",'ova_event'),
            "param_name" => "duration",
            "value" => "3000"
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Auto play",'ova_event'),
            "param_name" => "autoplay",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Display pagination",'ova_event'),
            "param_name" => "dots",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Loop",'ova_event'),
            "param_name" => "loop",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        
)));
/*End event From our blog*/


/* Price */

vc_map( array(
 "name" => __("Price", 'ova_event'),
 "base" => "event_pricing",
 "class" => "",
 "category" => __("My shortcode", 'ova_event'),
 "icon" => "icon-qk",   
 "params" => array(
  array(
       "type" => "textfield",
       "holder" => "div",
       "class" => "",
       "heading" => __("Name",'ova_event'),
       "param_name" => "name",
       "value" => "",
       "description" => 'Name of package. For instance: Personal'
    ),

  array(
       "type" => "dropdown",
       "holder" => "div",
       "class" => "",
       "heading" => __("Price style",'ova_event'),
       "param_name" => "pricing_style",
       "value" => array(   
              __('Currency - Value', 'ova_event') => 'ca',                
              __('Price - Value', 'ova_event') => 'ac',
              ),
       "default" => 'ca'
    ),
  array(
       "type" => "textfield",
       "holder" => "div",
       "class" => "",
       "heading" => __("Value",'ova_event'),
       "param_name" => "value",
       "value" => "",
       "description" => 'Value of package. For instance: 111'
    ),
  array(
       "type" => "textfield",
       "holder" => "div",
       "class" => "",
       "heading" => __("Currency",'ova_event'),
       "param_name" => "currency",
       "value" => "",
       "description" => 'Currency of package. For instance: $'
    ),
  array(
       "type" => "colorpicker",
       "holder" => "div",
       "class" => "",
       "heading" => __("Main color",'ova_event'),
       "param_name" => "color",
       "value" => ""
    ),
  array(
       "type" => "dropdown",
       "holder" => "div",
       "class" => "",
       "heading" => __("Feature Package",'ova_event'),
       "param_name" => "feature",
       "value" => array(   
              __('Normal', 'ova_event') => 'nofeature',                
              __('Feature', 'ova_event') => 'featured',
              ),
       "description" => 'Choose package is feature',
       "default" => "nofeature"
    ),
  array(
       "type" => "textarea_html",
       "holder" => "div",
       "class" => "",
       "heading" => __("Content",'ova_event'),
       "param_name" => "content",
       "value" => '',
       "description" => 'Insert Content and button shortcode <br/>[event_button name="REGISTER NOW" link="#register" target="scroll" bg="#f74949" bg_hover="#fff" text_color="#fff" text_color_hover="#f74949" icon="fa-arrow-circle-o-right" border_radius="4px" border_color="#f74949" border_color_hover="#ffffff" padding="11px 20px" margin="2px 5px"  class="" /]'
   ),
   
    array(
       "type" => "textfield",
       "holder" => "div",
       "class" => "",
       "heading" => __("Class",'ova_event'),
       "param_name" => "class",
       "value" => "",
       "description" => 'Insert class'
    ),

 )));
/* /Pricing */

/* Testimonial */
vc_map( array(
    "name" => __("Testimonial", 'ova_event'),
    "base" => "event_testimonial",
    "class" => "",
    "category" => __("My shortcode", 'ova_event'),
    "icon" => "icon-qk",
    "as_parent" => array('only' => 'event_testimonial_item', ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "js_view" => 'VcColumnView',
    "show_settings_on_create" => false,
    "params" => array(
               
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Duration ms. 1000ms=3s",'ova_event'),
            "param_name" => "duration",
            "value" => "3000"
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Auto play",'ova_event'),
            "param_name" => "autoplay",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Display pagination",'ova_event'),
            "param_name" => "dots",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Loop",'ova_event'),
            "param_name" => "loop",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Class",'ova_event'),
             "param_name" => "class",
             "default"  => ''
        ),

       
)));
/* /Testimonial */

/* Testimonial item */

vc_map( array(
    "name" => __("Testimonial item", 'ova_event'),
    "base" => "event_testimonial_item",
    "class" => "",
    "category" => __("ThemeBox", 'ova_event'),
    "icon" => "icon-qk",
    "content_element" => true,
    "as_child" => array('only' => 'event_testimonial'),
    "params" => array(
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __("image",'ova_event'),
            "param_name" => "image",
            "value" => ""
        ),          
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __("Description",'ova_event'),
            "param_name" => "desc",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Author",'ova_event'),
            "param_name" => "author",
            "value" => ""
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Rate",'ova_event'),
            "param_name" => "rate",
            "value" => array(
            	__('5 Stars', 'ova_event') => '5',
            	__('4 Stars', 'ova_event') => '4',
            	__('3 Stars', 'ova_event') => '3',
            	__('2 Stars', 'ova_event') => '2',
            	__('1 Star', 'ova_event') => '1'
            ),
            "default"  => '5'
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Link",'ova_event'),
            "param_name" => "link",
            "value" => ""
        ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Class",'ova_event'),
             "param_name" => "class",
             "default"  => ''
        ),

       
)));

 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_event_testimonial extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_event_testimonial_item extends WPBakeryShortCode {
    }
}

/* /Testimonial item */


/* Gmap */

vc_map( array(
	"name" => __("Google Map", 'ova_event'),
	"base" => "event_map",
	"class" => "",
	"category" => __("My shortcode", 'ova_event'),
	"icon" => "icon-qk",
	"params" => array(
		array(
		   "type" => "textfield",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("Id for map section",'ova_event'),
		   "param_name" => "idmap",
		   "value" => "map-canvas",
		   "description" => 'Insert id to display map. For example: map-canvas'
		),
		array(
		   "type" => "textarea_raw_html",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("location",'ova_event'),
		   "param_name" => "location",
		   "value" => "",
		   "description" => 'Insert latitude parameter for google map. <br/>For example: 51.503454,-0.119562 | 51.499633,-0.124755'
                        
		),
		array(
		   "type" => "textarea_raw_html",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("title",'ova_event'),
		   "param_name" => "title",
		   "value" => "",
		   "description" => 'Insert title parameter for google map. <br/>For example: Hotel 1 | Hotel 2'
		),
		array(
		   "type" => "textfield",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("Zoom",'ova_event'),
		   "param_name" => "zoom",
		   "value" => "15",
		   "description" => 'Insert zoom parameter for google map. Default 12'
		),
		array(
		   "type" => "attach_image",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("Icon for marker",'ova_event'),
		   "param_name" => "icon",
		   "value" => ""
		), 
		
		array(
		   "type" => "textfield",
		   "holder" => "div",
		   "class" => "",
		   "heading" => __("Class",'ova_event'),
		   "param_name" => "class",
		   "value" => "",
		   "description" => 'Insert class'
		),

)));
/* /map */






/* Speakers */
vc_map( array(
    "name" => __("Sponsor", 'ova_event'),
    "base" => "event_sponsor",
    "class" => "",
    "category" => __("My shortcode", 'ova_event'),
    "icon" => "icon-qk",
    "as_parent" => array('only' => 'event_sponsor_item', ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "js_view" => 'VcColumnView',
    "show_settings_on_create" => false,
    "params" => array(
        
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Item count in each slide",'ova_event'),
            "param_name" => "count",
            "value" => "3"
        ),       
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Duration ms. 1000ms=3s",'ova_event'),
            "param_name" => "duration",
            "value" => "3000"
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Auto play",'ova_event'),
            "param_name" => "autoplay",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Display pagination",'ova_event'),
            "param_name" => "dots",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Loop",'ova_event'),
            "param_name" => "loop",
            "value" => array(
                  __('true', 'ova_event') => 'true',
                  __('false', 'ova_event') => 'false',
            ),
            "default"  => 'true'
        ),
        
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Class",'ova_event'),
             "param_name" => "class",
             "default"  => ''
        ),

       
)));
/* /event_sponsor */


/*event sponsor item*/

vc_map( array(
	 "name" => __("Sponsor item", 'ova_event'),
	 "base" => "event_sponsor_item",
	 "as_child" => array('only' => 'event_sponsor'),
     "content_element" => true,
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(

	 	array(
	       "type" => "attach_image",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Thumbnail",'ova_event'),
	       "param_name" => "thumb_image",
	       "value" => "",
	       "description" =>  __("Insert path of thumbnail",'ova_event')
	    ),array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Title",'ova_event'),
	       "param_name" => "title",
	       "value" => ""
	    ),array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Alt",'ova_event'),
	       "param_name" => "alt",
	    )
)));


 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_event_sponsor extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_event_sponsor_item extends WPBakeryShortCode {
    }
}

/* /event_sponsor_item */
/*End event_sponsor*/


/* Social icon */
vc_map( array(
	 "name" => __("Social icons", 'ova_event'),
	 "base" => "event_social",
	 "as_parent" => array('only' => 'event_social_item'),
	 "js_view" => 'VcColumnView',
     "content_element" => true,
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(
	 	array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Class",'ova_event'),
	       "param_name" => "class",
	       "value" => ""
	    )
)));


/* EventBrite */
vc_map( array(
 "name" => __("Iframe Eventbrite", 'ova_event'),
 "base" => "event_iframe_eventbrite",
 "class" => "",
 "category" => __("My shortcode", 'ova_event'),
 "icon" => "icon-qk",   
 "params" => array(
 	
 	
	array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Insert ID of event at eventbrite.com",'ova_event'),
	       "description" => "Find ID. This is your event url: https://www.eventbrite.com/e/sell-imevent-wordpress-theme-tickets-19209099935 => ID is 19209099935",
	       "param_name" => "id",
	       "value" => "",               
	  ),
	
  	array(
       "type" => "textfield",
       "holder" => "div",
       "class" => "",
       "heading" => __("Class",'ova_event'),
       "param_name" => "class",
       "value" => ""
    ),

)));



vc_map( array(
 "name" => __("Social icon item", 'ova_event'),
 "base" => "event_social_item",
 "content_element" => true,
 "as_child" => array('only' => 'event_social'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
 "class" => "",
 "category" => __("My shortcode", 'ova_event'),
 "icon" => "icon-qk",   
 "params" => array(
	array(
       "type" => "textfield",
       "holder" => "div",
       "class" => "",
       "heading" => __("Font awesome",'ova_event'),
       "param_name" => "fonts_icon",
       "value" => "",
       "description" => 'For example: fa-heart. Insert font-awesome. You can find here: https://fortawesome.github.io/Font-Awesome/cheatsheet/'
    ),array(
	   "type" => "colorpicker",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("color fonts icon",'ova_event'),
	   "param_name" => "icon_color",
	),array(
	   "type" => "textfield",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("icon Link",'ova_event'),
	   "param_name" => "icon_link",
	   "value" => "",
	   "description" => 'For example:http://ovatheme.com'
	),array(
	   "type" => "dropdown",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("Target Link",'ova_event'),
	   "param_name" => "target_link",
	   "value" => array(
	   		__('Self', 'ova_event') => "_self",
	   		__('Blank', 'ova_event') => "_blank",
	   		__('Parent', 'ova_event') => "_parent",
	   		__('Top', 'ova_event') => "_top",
	   	),
	   "default"	=> "_self"
	),array(
	   "type" => "textfield",
	   "holder" => "div",
	   "class" => "",
	   "heading" => __("class",'ova_event'),
	   "param_name" => "class",
	   "value" => "",
	)
 )
));  

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_event_social extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_event_social_item extends WPBakeryShortCode {
  }
}
/* Social icon */





/* Gallery */
vc_map( array(
    "name" => __("Event Gallery", 'ova_event'),
    "base" => "event_gallery",
    "class" => "",
    "category" => __("My shortcode", 'ova_event'),
    "icon" => "icon-qk",
    "as_parent" => array('only' => 'event_gallery_item', ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "js_view" => 'VcColumnView',
    "show_settings_on_create" => false,
    "params" => array(
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Class",'ova_event'),
             "param_name" => "class",
             "default"  => ''
        )

)));
/* /Gallery */


/* Gallery item */

vc_map( array(
	 "name" => __("Gallery item", 'ova_event'),
	 "base" => "event_gallery_item",
	 "as_child" => array('only' => 'event_gallery'),
     "content_element" => true,
	 "class" => "",
	 "category" => __("My shortcode", 'ova_event'),
	 "icon" => "icon-qk",   
	 "params" => array(

	 	
	 	array(
	       "type" => "attach_image",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Thumbnail",'ova_event'),
	       "param_name" => "thumbnail",
	       "value" => "",
	       "description" =>  __("Choose thumbnail",'ova_event')
	    ),
	 	array(
	       "type" => "attach_image",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Popup Image",'ova_event'),
	       "param_name" => "image",
	       "value" => "",
	       "description" =>  __("Choose image when display popup",'ova_event')
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Alt",'ova_event'),
	       "param_name" => "alt",
	       "value" => ""
	    ),
	    array(
	       "type" => "textfield",
	       "holder" => "div",
	       "class" => "",
	       "heading" => __("Class",'ova_event'),
	       "param_name" => "class",
	       "value" => ""
	    )
)));


 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_event_gallery extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_event_gallery_item extends WPBakeryShortCode {
    }
}





/* Make Donation */
vc_map( array(
    "name" => __("Make Donation", 'ova_event'),
    "base" => "event_makedonation",
    "class" => "",
    "category" => __("My shortcode", 'ova_event'),
    "icon" => "icon-qk",
    "params" => array(
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Title",'ova_event'),
             "param_name" => "title",
             "default"  => ''
        ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Paypal Email",'ova_event'),
             "param_name" => "paypalemail",
             "default"  => ''
        ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Currency Code",'ova_event'),
             "param_name" => "currency_code",
             "default"  => ''
        ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Placeholder",'ova_event'),
             "param_name" => "place_holder",
             "default"  => 'Insert Number'
        ),
        
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => __("Class",'ova_event'),
             "param_name" => "class",
             "default"  => ''
        )


)));
/* /Make Donation */



}} /* /if //function */
?>