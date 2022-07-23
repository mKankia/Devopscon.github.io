(function($) { 

"use strict";

jQuery(window).load(function(){

	/* Config for Page with Visual Composer Template */
	var main_layout = jQuery(".cmb2-id-mitup-met-main-layout");

	main_layout.bind("toggle_showhide",function(){
		var template = 	jQuery('#page_template :selected').text();
		if(template == "Visual Composer Template"){
			jQuery(main_layout).css("display","none")
			jQuery('#page_heading_settings').css("display","none");
		}else{
			jQuery(main_layout).css("display","block");
			jQuery('#page_heading_settings').css("display","block");
		}

	});
	main_layout.trigger("toggle_showhide");
	jQuery('#page_template').change(function(){
		main_layout.trigger("toggle_showhide");
	});
	

	

	/* Config for post format */
   	var $post_formats_select = jQuery('#post-formats-select');
   	var type = $post_formats_select.find('input[checked="checked"]').val();
   	// Check option show header
   	var postformatOption=function(type){
   		jQuery(".cmb2-id-mitup-met-embed-media, .cmb2-id-mitup-met-file-list").hide();
        switch(type){
        	case'0':
        		jQuery(".cmb2-id-mitup-met-embed-media, .cmb2-id-mitup-met-file-list").hide();
        	break;
        	case'image':
				jQuery(".cmb2-id-mitup-met-embed-media, .cmb2-id-mitup-met-file-list").hide();
        	break;
        	case'gallery':
				jQuery(".cmb2-id-mitup-met-embed-media").hide();
				jQuery(".cmb2-id-mitup-met-file-list").show();
        	break;
        	case'audio':
				jQuery(".cmb2-id-mitup-met-file-list").hide();
				jQuery(".cmb2-id-mitup-met-embed-media").show();
        	break;
        	case'video':
				jQuery(".cmb2-id-mitup-met-file-list").hide();
				jQuery(".cmb2-id-mitup-met-embed-media").show();
        	break;

        }
   	};
   	if(typeof(type)!='undefined') postformatOption(type);

	$post_formats_select.find("input").off('click').on('click',function() {
			var type =jQuery(this).val();
          postformatOption(type);
    });
			   
			    



	/* Slideshow: Choose template */
	var desc = jQuery("#mitup_met_slideshow_desc");

	desc.bind("toggle_showhide",function(){
		var template = 	jQuery('#mitup_met_slideshow_choose_template :selected').text();
		if(template == "Basic"){
			jQuery('.cmb2-id-mitup-met-slideshow-countdown-shortcode').css("display","none");
			jQuery('.cmb2-id-mitup-met-slideshow-register-shortcode').css("display","none");
			jQuery('.cmb2-id-mitup-met-slideshow-desc').css("display","block");
		}else if(template == "Countdown"){
			jQuery('.cmb2-id-mitup-met-slideshow-countdown-shortcode').css("display","block");
			jQuery('.cmb2-id-mitup-met-slideshow-register-shortcode').css("display","none");
			jQuery('.cmb2-id-mitup-met-slideshow-desc').css("display","none");
		} else if(template == "Register"){
			jQuery('.cmb2-id-mitup-met-slideshow-countdown-shortcode').css("display","none");
			jQuery('.cmb2-id-mitup-met-slideshow-register-shortcode').css("display","block");
			jQuery('.cmb2-id-mitup-met-slideshow-desc').css("display","block");
		}

	});
	desc.trigger("toggle_showhide");
	jQuery('#mitup_met_slideshow_choose_template').change(function(){
		desc.trigger("toggle_showhide");
	});

	/* Header */
	var header_style = jQuery("#mitup_met_header_style");

	header_style.bind("toggle_showhide",function(){
		var header_style_value = 	jQuery('#mitup_met_header_style :selected').text();
		if(header_style_value == "Header default"){
			
			jQuery('.cmb2-id-mitup-met-general-bg-heading').css("display","none");
			jQuery('.cmb2-id-mitup-met-general-title-heading').css('display',"none");
			jQuery('.cmb2-id-mitup-met-general-subtitle-heading').css('display',"none");
			jQuery('.cmb2-id-mitup-met-bgcolor-menu').css("display","block");

		}else if(header_style_value == "Header background image"){
			jQuery('.cmb2-id-mitup-met-general-bg-heading').css("display","block");
			jQuery('.cmb2-id-mitup-met-general-title-heading').css('display',"block");
			jQuery('.cmb2-id-mitup-met-general-subtitle-heading').css('display',"block");
			jQuery('.cmb2-id-mitup-met-bgcolor-menu').css("display","none");

		}else if(header_style_value == "Header transparent"){
			jQuery('.cmb2-id-mitup-met-general-bg-heading').css("display","none");
			jQuery('.cmb2-id-mitup-met-general-title-heading').css('display',"none");
			jQuery('.cmb2-id-mitup-met-general-subtitle-heading').css('display',"none");
			jQuery('.cmb2-id-mitup-met-bgcolor-menu').css("display","none");

		} 

	});
	header_style.trigger("toggle_showhide");
	jQuery('#mitup_met_header_style').change(function(){
		header_style.trigger("toggle_showhide");
	});


	
});


})(jQuery);




