<?php if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/* Main slider */

add_shortcode('event_main_slider', 'event_main_slider');
function event_main_slider($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'slug_group'  => '',
      'order_by'    => 'id',
      'order'       => 'DESC',
      'count'       => '100',
      'auto_slider' => 'true',
      'duration'    => '3000',
      'navigation'  => 'true',
      'loop'        => 'true',
      'cover_bg'     => 'true',
      'height_desk' => '680px',
      'height_ipad' => '768px',
      'height_mobile' => '800px',
      'class'       => '',
    ), $atts);

    if($atts['slug_group'] == ''){
      printf("<h3 style='min-height:300px;text-align:center; background-color:#000; color:red;'>Please choose a slide category</h3>",'ova_event');
      return true;
    } 
    $args = array(
        'post_type'=>'slideshow', 
        'slidegroup'=> $atts['slug_group'], 
        'orderby'=> $atts['order_by'], 
        'order'=> $atts['order'], 
        'posts_per_page' => $atts['count'],
        'post_status' => array('publish')
    );

    $slideshow = new WP_QUery($args);

    if(count($slideshow->posts) <= 1){
      $atts['loop'] = 'false';
      $atts['navigation'] = 'false';
    }

    $html = '';
    $html .= '<div class="main_slider owl-carousel '.$atts['class'].'" data-height_desk="'.$atts['height_desk'].'"  data-height_ipad="'.$atts['height_ipad'].'" data-height_mobile="'.$atts['height_mobile'].'" data-loop="'.$atts['loop'].'" data-auto_slider="'.$atts['auto_slider'].'" data-duration="'.$atts['duration'].'" data-navigation="'.$atts['navigation'].'" >';
    
    
    $template = $title = $subtitle = $desc = $button_sc = $coutndown_sc =  $register_sc = '';

    if($slideshow->have_posts()):
      while($slideshow->have_posts()): $slideshow->the_post();
      $current_id = get_the_id();

        $template = get_post_meta($current_id, "mitup_met_slideshow_choose_template", true);
        $title = get_post_meta($current_id, "mitup_met_slideshow_title", true);
        $subtitle = get_post_meta($current_id, "mitup_met_slideshow_subtitle", true);
        $desc = get_post_meta($current_id, "mitup_met_slideshow_desc", true);
        $button_sc = get_post_meta($current_id, "mitup_met_slideshow_button_shortcode", true);
        $coutndown_sc = get_post_meta($current_id, "mitup_met_slideshow_countdown_shortcode", true);
        $register_sc = get_post_meta($current_id, "mitup_met_slideshow_register_shortcode", true);
        $bg = get_post_meta($current_id, "mitup_met_slideshow_bg", true);

        $html .= '<div class="item page text-center '.$template.'" style="background: url('.$bg.')" data-speed="10">';
                    $html .= ($atts['cover_bg'] == 'true') ? '<div class="cover_bg"></div>':'';
                    $html.= '<div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">';

                                            if($template == 'basic'){
                                                $html .= '<div class="col-md-10 col-md-offset-1 itemslide">';
                                                  $html .= ($title != '') ? '<h2 class="title">'.$title.'</h2>':'';
                                                  $html .= ($subtitle != '') ? '<h3 class="sub_title">'.$subtitle.'</h3>':'';
                                                  $html .= ($desc != '') ? '<div class="desc">'.$desc.'</div>':'';
                                                  $html .= ($button_sc != '') ? '<div class="button_sc">'.do_shortcode($button_sc).'</div>':'';
                                                $html .= '</div>';
                                            }
                                            else if($template == 'countdown'){
                                                $html .= '<div class="itemslide">';
                                                  $html .= ($title != '') ? '<h2 class="title">'.$title.'</h2>':'';
                                                  $html .= ($subtitle != '') ? '<h3 class="sub_title">'.$subtitle.'</h3>':'';
                                                  $html .= ($coutndown_sc != '') ? '<div class="coutndown_sc">'.do_shortcode($coutndown_sc).'</div>':'';
                                                  $html .= ($button_sc != '') ? '<div class="button_sc">'.do_shortcode($button_sc).'</div>':'';
                                                $html .= '</div>';
                                            }
                                            else if($template == 'register'){
                                                $html .= '<div class="itemslide">';
                                                  $html .= '<div class="col-md-6">';
                                                      $html .= ($title != '') ? '<h2 class="title">'.$title.'</h2>':'';
                                                      $html .= ($subtitle != '') ? '<h3 class="sub_title">'.$subtitle.'</h3>':'';
                                                      $html .= ($desc != '') ? '<div class="desc">'.$desc.'</div>':'';
                                                      $html .= ($button_sc != '') ? '<div class="button_sc">'.do_shortcode($button_sc).'</div>':'';
                                                  $html .= '</div>';
                                                  $html .= '<div class="col-md-5 col-md-offset-1 slide_register_form">';
                                                      $html .= ($register_sc != '') ? do_shortcode($register_sc) :'';
                                                  $html .= '</div>';
                                                $html .= '</div>';
                                            }
                                    
        $html .= '</div></div></div></div></div>';

      endwhile;
    endif;
     wp_reset_postdata();
    $html .= '</div>';

    
    return $html;
}
/* Main slider */


/* Coutdown shortcode */
add_shortcode('event_countdown', 'event_countdown');
function event_countdown($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'end_day'     => '',
      'end_month'   => '',
      'end_year'    => '',
      'display_format'=> 'dHMS',
      'timezone'    => '0',
      'years'       => "years",
      "months"      => "months",
      "weeks"       => "weeks",
      'days'        => 'days',
      'hours'       => 'hours',
      'minutes'     => 'minutes',
      'seconds'     => 'seconds',
      'year'        => "year",
      "month"       => "month",
      "week"        => "week",
      'day'         => 'day',
      'hour'        => 'hour',
      'minute'      => 'minute',
      'second'      => 'second',
    
      'class'       => '',
    ), $atts);

    $html = '';

    $end_day = $atts['end_day'];
    $end_month = $atts['end_month']-1;
    $end_year = $atts['end_year'];

    $display_format = $atts['display_format'];
    $timezone = $atts['timezone'];

    $years = $atts['years'];
    $months = $atts['months'];
    $weeks = $atts['weeks'];
    $days = $atts['days'];
    $hours = $atts['hours'];
    $minutes = $atts['minutes'];
    $seconds = $atts['seconds'];
    $year = $atts['year'];
    $month = $atts['month'];
    $week = $atts['week'];
    $day = $atts['day'];
    $hour = $atts['hour'];
    $minute = $atts['minute'];
    $second = $atts['second'];

    

    $html .= '<div >';

        $html .= '
        <div class="countdown-wrapper '.$atts['class'].'">
        <div class="event_countdown" 
                     data-years='.$years.' data-months='.$months.' data-weeks="'.$weeks.'" data-days="'.$days.'" data-hours="'.$hours.'" data-minutes="'.$minutes.'" data-seconds="'.$seconds.'" 
                     data-year='.$year.' data-month='.$month.' data-week="'.$week.'" data-day="'.$day.'" data-hour="'.$hour.'" data-minute="'.$minute.'" data-second="'.$second.'" 
                     data-end_date_y = "'.$end_year.'" data-end_date_m="'.$end_month.'" data-end_date_d="'.$end_day.'" 
                     data-timezone = "'.$timezone.'" data-display_format="'.$display_format.'"
          ></div></div></div>
        ';
    
    return $html;
}
/* /Coutdown shortcode */


/* Button Shortcode */
add_shortcode('event_button', 'event_button');
function event_button($atts, $content = null) {

    $atts = shortcode_atts(
    array(
		'name'				=> '',
		'link'				=> '',
		'target'			=> 'scroll',
		'bg'				=> '',
		'bg_hover'			=> '',
		'text_color'		=> '',
		'text_color_hover'	=> '',
		'icon'				=> '',
		'border_radius'		=> '',
    'border_color'  => '',
    'border_color_hover'  => '',
		'margin'			=> '',
   
		'class'		=> '',
    ), $atts);

    $html = '';
    
     

      $html .= '<div class="sc_button">';
      $popup_video = ( $atts['target'] == 'popup_video' ) ? ' data-rel="prettyPhoto" ':'';
    	$html .='<a href="'.$atts['link'].'"  '.$popup_video.'
    	data-bg="'.$atts['bg'].'" data-bg_hover="'.$atts['bg_hover'].'" data-border_color="'.$atts['border_color'].'" data-border_color_hover="'.$atts['border_color_hover'].'"
    	data-text_color = "'.$atts['text_color'].'" data-text_color_hover = "'.$atts['text_color_hover'].'"';
    	
      $html .= ($atts['target'] == 'scroll') ? '' : ' target="'.$atts['target'].'"';
    	 
      $scroll_class = ($atts['target'] == 'scroll') ? 'scroll':'';

      $html .= ' style="background-color: '.$atts['bg'].'; color: '.$atts['text_color'].'; border-radius:'.$atts['border_radius'].'; margin: '.$atts['margin'].';  border-color: '.$atts['border_color'].'; "
    	class="'.$scroll_class.' '.$atts['class'].'" >'
    	.$atts['name'].'
    	<i class="fa '.$atts['icon'].'"></i>
    	</a>';
      
    $html .='</div>';
      
    return $html;

}



/* Register Form Shortcode */
add_shortcode('event_registerform', 'event_registerform');
function event_registerform($atts, $content = null) {

  $atts = shortcode_atts(
    array(
      'type'        => 'free',
      'title'       => 'Register Now',
      'subtitle'    => '* We process using a 100% secure gateway',
      'style'       => 'style1',
      'buttontext'  => esc_attr__('Register Now', 'ova_event'),
      'iconbutton'  => 'fa-arrow-circle-o-right',
      'bg_button'   => '#f74949',
      'bg_button_hover' => '#ffffff',
      'text_button_color' => '#ffffff',
      'text_button_color_hover' => '#f74949',
      'border_color' => '#ffffff',
      'border_color_hover' => '#ffffff',
    
      'class'       => '',
    ), $atts);

    $unique = uniqid();

    $html = '';

    
    global $post;
    if(is_front_page () ){
      $form_action = 'index.php';  
    }else{
      $form_action = home_url('/');
    }

    

    if($atts['style'] == 'style1'){

      $html .= '<div class="'.$atts['class'].' " ><form id="ova_'.$unique.'" name="ovatheme_form" class="style1 ovatheme_form" action="'.$form_action.'" method="post">';
      $html .= '<div class="col-md-12 event_loading hide text-center"><img class="img-responsive" src="'.get_template_directory_uri()."/assets/img/preloader.gif".'" alt="'.$atts['title'].'"></div>';
      $html .= '<div class="row"><div class="col-sm-12 form-alert"></div>';
      $html .= ($atts['title'] != '') ? '<h3 class="title_form">'.$atts['title'].'</h3>':'';
      $html .= ($atts['subtitle'] != '') ? '<div class="subtitle_form">'.$atts['subtitle'].'</div>':'';

    }else if($atts['style'] == 'style2'){

     $html .='<div class="form-background " >';
     $html .= '<div class="'.$atts['class'].'"><form id="ova_'.$unique.'" name="ovatheme_form" class="style2 ovatheme_form '.$atts['class'].'" action="'.$form_action.'" method="post">';
     $html .= '<div class="row"><div class="col-sm-12 form-alert"></div>';
     $html .= '<div class="col-md-12 event_loading hide text-center"><img class="img-responsive" src="'.get_template_directory_uri()."/assets/img/preloader.gif".'" alt="'.$atts['title'].'"></div>';
     $html .= ($atts['title'] != '') ? '<h3 class="title_form">'.$atts['title'].'</h3>':'';
     $html .= ($atts['subtitle'] != '') ? '<div class="subtitle_form">'.$atts['subtitle'].'</div>':'';
    }

    if( $atts['type'] == 'free' ){

      $options_free = get_option( 'option_name_free' );
      $json_register_fields = json_decode( '{'.$options_free['fields_free'].'}' );
      $successmg_free = $options_free['successmg_free'];

    }else if( $atts['type'] == 'pay' ){

      $options_pay = get_option( 'option_name_pay' );
      $json_register_fields = json_decode( '{'.$options_pay['fields_pay'].'}' );
      $price_pay = $options_pay['price_pay'];
      $currency = $options_pay['currency_pay'];
    }
    
    

    $i=rand();
  if($json_register_fields){
    foreach ($json_register_fields as $key => $value) {


        $require_class = '';
        $require = '';

        $price_paypal_class = '';

        if(isset($value->require)){
          $require = $value->require;
        }

        if($require == 'true'){
        $require_class = 'require';
        }

        if($atts['type'] == 'pay'){
          if($key == $price_pay){
            $price_paypal_class = 'unique_price_paypal';
          }  
        }
        

        if($atts['style'] == 'style1'){

          $html .= '<div class="'.$value->class.' form-group">';  

        }else if($atts['style'] == 'style2'){

          $html .= '<div class="'.$value->class.' col-md-6 form-group">';  

        }
        

        // Display TextField field
        if($value->type=='textfield'){
        $html .= '<input  type="text" name="'.$key.'" class="get_data form-control  field'.$key.' input-text '.$require_class.' '.$price_paypal_class.'" data-toggle="tooltip" data-placeholder="'.$value->label.'" data-place="'.$key.'"
            title="'.$value->label.'" value="'.$value->value.'" placeholder="'.$value->label.'" />';
        }

        // Display Email Field
        if($value->type=='email'){
        $html .= '<input  data-placeholder="'.$value->label.'" name="'.$key.'"  data-place="'.$key.'" type="text" class="get_data form-control  field'.$key.' input-email '.$require_class.' '.$price_paypal_class.'" data-toggle="tooltip" 
            title="'.$value->label.'" value="'.$value->value.'"  placeholder="'.$value->label.'"/>';
        }

        // Display Url Field
        if($value->type=='url'){
        $html .= '<input  data-placeholder="'.$value->label.'"  name="'.$key.'"  data-place="'.$key.'" type="text" class="get_data form-control  field'.$key.' input-url '.$require_class.' '.$price_paypal_class.'" data-toggle="tooltip" 
            title="'.$value->label.'" value="'.$value->value.'"  placeholder="'.$value->label.'"/>';
        }

        // Display number Field
        if($value->type=='number'){
        $html .= '<input  data-placeholder="'.$value->label.'" name="'.$key.'"  data-place="'.$key.'" type="text" class="get_data form-control  field'.$key.' input-number '.$require_class.' '.$price_paypal_class.'" data-toggle="tooltip" 
            title="'.$value->label.'" value="'.$value->value.'"  placeholder="'.$value->label.'"/>';
        }

        // Display date Field
        if($value->type=='date'){
        $html .= '<input   data-placeholder="'.$value->label.'" name="'.$key.'"  data-place="'.$key.'"  data-format="'.$value->format.'" type="text" data-idunique="'.$key.$unique.'" id="'.$key.$unique.'" placeholder="'.$value->label.'" data-toggle="tooltip" title="'.$value->label.'" class="get_data form-control  field'.$key.' input-date '.$require_class.' '.$price_paypal_class.'" />';
        wp_enqueue_script('jquery-ui-datepicker');
        }
        

        // Display textarea Field
        if($value->type=='textarea'){
        $html .= '<textarea   data-placeholder="'.$value->label.'"  name="'.$key.'" data-place="'.$key.'"  class="get_data form-control  field'.$key.' input-textarea '.$require_class.' '.$price_paypal_class.'" placeholder="'.$value->label.'" rows="'.$value->rows.'" cols="'.$value->cols.'" data-toggle="tooltip" title="'.$value->label.'">'.$value->value.'</textarea>';
        }

        // Display Dropdown Field
        if($value->type=='dropdown'){
        
        $html .= '<label class="styled-select"><select  title="'.$value->label.'"  data-placeholder="'.$value->label.'" name="'.$key.'"  data-place="'.$key.'" class="selectpicker get_data form-control-old input-dropdown field'.$key.'  input-'.$key.' '.$require_class.' '.$price_paypal_class.'"  data-width="100%" data-toggle="tooltip">
              <option  selected="selected" value="">'.$value->label.'</option>';                        
              foreach ($value->value as $key_opt => $value_opt) {
                $html .= '<option  value="'.$value_opt.'">'.$key_opt.'</option>';
              }
              
            $html .= '</select></label>';
        }  




        // Display checkbox field
         if($value->type=='checkbox'){
          $html .= '<label>'.$value->label.'</label><br/>';
          foreach ($value->value as $key_check => $value_check) {
          $html .= '<input  class="get_data   field'.$key.' '.$price_paypal_class.'"  type="checkbox" name="'.$key.'" value="'.$value_check.'"> '.$key_check.'<br>';
          }
        }

        // Display radio field
        if($value->type=='radio'){
          $html .= '<label>'.$value->label.'</label><br/>';
          foreach ($value->value as $key_rad => $value_rad) {
          $checked = '';
          if($value_rad == $value->value_default){
            $checked = 'checked';
          }
          $html .= '<input  '.$checked.' class="get_data   field'.$key.' '.$price_paypal_class.'"  data-placeholder="'.$value->label.'"  data-place="'.$key.'" type="radio" name="'.$key.'" value="'.$value_rad.'"> '.$key_rad.'<br>';                
          }
        }
        $i++;

        // Display hidden field
        if($value->type == "hidden"){
          $html .= '<input  type="hidden" name="'.$key.'" class="get_data form-control  field'.$key.' input-text '.$price_paypal_class.'" data-placeholder="'.$value->label.'" data-place="'.$key.'"
            title="'.$value->label.'" value="'.$value->value.'"  />';
        }

        // Display message field
        if($value->type=='message'){
          $html .= $value->value;
        }

        $html .= '</div>';
        

    } // endforeach
  } // endif
    if($atts['style'] == 'style1'){

      $html .= '<div class="col-md-12"></div><div class="register_pay_button">';

    }else if($atts['style'] == 'style2'){

      $html .= '<div class="col-md-12 overflowed register_pay_button register_tempalte_2">';

    }

    $html .='<div class="text-center margin-top">';
                  $html .= '<button data-idform="ova_'.$unique.'" class="btn btn-theme btn-theme-xl submit-button" 
                            type="submit"  
                            data-bg="'.$atts['bg_button'].'" data-bg_hover="'.$atts['bg_button_hover'].'"
                            data-text_color = "'.$atts['text_button_color'].'" data-text_color_hover = "'.$atts['text_button_color_hover'].'" 
                            data-border_color="'.$atts['border_color'].'" data-border_color_hover="'.$atts['border_color_hover'].'" style="background-color:'.$atts['bg_button'].'; color: '.$atts['text_button_color'].'; border-color: '.$atts['border_color'].'"> '.$atts['buttontext'].' <i class="fa fa-arrow-circle-right"></i></button>';
    $html .='</div></div>';
              

    $html .= '</div>';

    if($atts['type'] == 'free'){

      $html .= '
          <input type="hidden" class="customer" name="customer"  value="'.$unique.'">
          <input type="hidden" class="register_type" name="register_type"  value="free">
          <input type="hidden" class="register_success_msg" value="'.$successmg_free.'">
      ';

    }else if( $atts['type'] == 'pay' ){

      $html .= '
          <input type="hidden" class="currency" name="currency" value="'.$currency.'">
          <input type="hidden" class="customer" name="customer"  value="'.$unique.'">
          <input type="hidden" class="register_type" name="register_type"  value="pay">
      ';

    }

    
    if($atts['style'] == 'style1'){
      $html .= '</form></div>';
    } else if($atts['style'] == 'style2'){
      $html .= '</form></div></div>';
    }     
    

    return $html;
}
/* /Register Form Shortcode */


/* iframe eventbrite */
add_shortcode('event_iframe_eventbrite', 'event_iframe_eventbrite');
function event_iframe_eventbrite($atts, $content = null) {

  $atts = shortcode_atts(
      array(
        'id' => '',
     
        'class' => '',
    ), $atts);

    $html = '';

    

    $html .= '<div >';
    $html .= '
        <div class="iframe_eventbrite '.$atts['class'].'">
          <iframe src="//eventbrite.com/tickets-external?eid='.$atts['id'].'&amp;ref=etckt&amp;v=2" height="314" width="100%" frameborder="0" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="auto" allowtransparency="true"></iframe>
          
        </div></div>
    ';

    return $html;

}
/* /iframe eventbrite */

/* heading */
add_shortcode('event_heading', 'event_heading');
function event_heading($atts, $content = null) {
    
    $atts = shortcode_atts(
    array(      
      'title'  => '',      
      'subtitle'  => '',
      'fontclass' => '',
      'style' => 'style1',
    
      'class' => '',
    ), $atts);

    $html = '';
    
    $html .= '
      <h3 class="event_heading section-title '.$atts['class'].' '.$atts['style'].'">';
          
          $html .= ($atts['fontclass'] != '') ? '<span" class="icon-inner ">
            <span class="fa-stack"><i class="fa  fa-stack-2x"></i><i class="fa '.$atts['fontclass'].' fa-stack-1x"></i></span>
          </span>' : '';

          $html .= '<span " class="title-inner ">'.$atts['title'].' <small> '.$atts['subtitle'].'</small></span>
      </h3>
    ';
    return $html;

}
/* /heading */

/* Schedule */
add_shortcode('event_schedule', 'event_schedule');
function event_schedule($atts, $content = null) {
    
    $atts = shortcode_atts(
    array(
      'array_slug'  => '',
      'order_by_subcat' => 'id',
      'order_subcat'    => 'asc',
      'schedule_count'  => '50',
      'order_by_item'    => 'id',
      'order_item'       => 'asc',
      'turnofflink' => 'no',
      'time_color'  => '#44cb9a',
      'intermediate_color' => '#fac42b',
    
      'class'       => ''
    ), $atts);

    $order_by_subcat = $atts['order_by_subcat'];
    $order_subcat = $atts['order_subcat'];

    $filter_orderby = $atts['order_by_item'];
    $filter_order = $atts['order_item'];

    $schedule_count_each_tab = $atts['schedule_count'];
  

    $html = '';

    

    $html .= '<div class="event_schedule  clear '.$atts['class'].'" >';

    /* Display navigation Category lv1 */
    $html .= '<div class="event-schedule-tabs lv1"><ul id="tabs-lv1"  class="nav nav-justified_old">';
      $array_slug_new = explode(',', $atts['array_slug']);
      foreach ($array_slug_new as $key => $value) {

        $category_lv1 = get_term_by('slug', $value, 'categories');
        $class_active_lv1 = ($key == 0) ? 'class="active"':'';

        $html .= '<li '.$class_active_lv1.'><a class="ova_schedule_subcat_lv1" href="#tab-'.$category_lv1->slug.'" data-toggle="tab">'.$category_lv1->name.'</a><span class="sub_cat">'.$category_lv1->description.'</span></li>';
      }
    $html .= '</ul></div>';
    /* /Display navigation Category lv1 */

    $html .= '<div class="tab-content lv1">';
    /* Display content for tab lv1 */
      
        foreach ($array_slug_new as $key1 => $value1) {

          $class_active_lv2 = ($key1 == 0) ? 'in active':'';

          $category_lv1 = get_term_by('slug', $value1, 'categories');      
          

             $html .= '<div id="tab-'.trim($value1).'" class="tab-pane fade '.$class_active_lv2.'">';
                      $html .= '<div class="event-schedule-tabs lv2">
                                  <ul id="tabs-lv2'.$key1.'"  class="nav nav-justified">';
                                      /* Display navigation category lv2 */
                                        $array_term_childrens = get_terms( 'categories', 
                                                                            array(  'child_of'    => $category_lv1->term_id, 
                                                                                    'orderby'     =>  $order_by_subcat,
                                                                                    'order'       => $order_subcat,
                                                                                    'hide_empty'  => false ) 
                                                                            );
                                        foreach ($array_term_childrens as $key2 => $category_lv2) {
                                            $class_active_lv2_ac = ($key2 == 0)?'active':'';
                                            $style_lv2 = ($key2%2 == 0) ? '':'odd';
                                            $html .= '<li class="'.$style_lv2.' '.$class_active_lv2_ac.'"><a href="#tab-lv2-'.$category_lv2->slug.'" data-toggle="tab">'.$category_lv2->name.'</a></li>';
                                        }
                                $html .= '</ul></div>';

                /* Display content for tab lv1 and lv2 */
                $html .= '<div class="tab-content lv2">';

                /* Has sub-cateogry */
                if($array_term_childrens != NULL){
                  foreach ($array_term_childrens as $key3=> $value3) {
                        $args = array('post_type' => 'schedule', 
                                      'categories'=>$value3->slug, 
                                      'orderby'=> $filter_orderby, 
                                      'order'=> $filter_order, 
                                      'posts_per_page'=> $schedule_count_each_tab
                                    );
                        $schedule = new WP_QUery($args);

                        
                        $class_term_lv2 = ($key3 == 0) ? 'in active':'';
                        $order_lv3 = 0;

                        $html .= '<div id="tab-lv2-'.$value3->slug.'" class="tab-pane fade '.$class_term_lv2.'">
                                    <div class="schedule_timeline">';
                                      
                                      if($schedule->have_posts()):
                                        while($schedule->have_posts()): $schedule->the_post();

                                          $current_id = get_the_id();

                                          $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id());

                                          $schedule_timetext = get_post_meta($current_id, "mitup_met_schedule_timetext", true);
                                          $schedule_timeicon = get_post_meta($current_id, "mitup_met_schedule_timeicon", true);
                                          $speaker_intermediate = get_post_meta($current_id, "mitup_met_schedule_intermediate", true);
                                          $speaker_intermediate_icon = get_post_meta($current_id, "mitup_met_speaker_intermediate_icon", true);
                                          $schedule_author = get_post_meta($current_id, "mitup_met_schedule_author", true);
                                          $schedule_author_job = get_post_meta($current_id, "mitup_met_schedule_author_job", true);
                                          $schedule_link_speaker = get_post_meta($current_id, "mitup_met_schedule_link_speaker", true);

                                          $style_lv3 = ($order_lv3%2 == 0) ? '':'odd';

                                            $html .= '
                                              <article class="item '.$style_lv3.'">
                                                <div class="container-fluid"><div class="row">';
                                                  
                                                  $html .= '<div class="col-md-3">';
                                                    $html .='<div class="quick_speaker">';
                                                        
                                                        $html .= '<div class="time" style="color: '.$atts['time_color'].'">';
                                                        $html .= ($schedule_timeicon != '') ? '<i class="fa '.$schedule_timeicon.'"></i>&nbsp;&nbsp;':'';
                                                        $html .= ($schedule_timetext != '') ? $schedule_timetext:'';
                                                        $html .= '</div>';

                                                        $html .= '<div class="intermediate" style="color: '.$atts['intermediate_color'].'">';
                                                        $html .= ($speaker_intermediate_icon != '') ? '<i class="fa '.$speaker_intermediate_icon.'"></i>&nbsp;&nbsp;':'';
                                                        $html .= ($speaker_intermediate != '') ? $speaker_intermediate:'';
                                                        $html .= '</div>';

                                                        $html .= '<div class="share_schedule">';
                                                        $html .= '<a target="_blank" href="https://twitter.com/share?url='.urlencode( get_permalink() ).'&amp;text='.urlencode( get_the_title() ).'&amp;hashtags=simplesharebuttons"><i class="fa fa-twitter"></i></a>
                                                                  <a target="_blank" href="http://www.facebook.com/sharer.php?u='.get_permalink().'"><i class="fa fa-facebook"></i></a>
                                                                  <a target="_blank" href="https://plus.google.com/share?url='.get_permalink().'"><i class="fa fa-google-plus"></i></a>';

                                                        $html .= '</div>';

                                                    $html .= '</div>';
                                                  $html .= '</div>';

                                                  $html .= '<div class="col-md-7">';
                                                    $html .= ($atts['turnofflink'] == "no") ? '<h2 class="post-title"><a href="'.get_permalink().'">'.get_the_title( ).'</a></h2>' : '<h2 class="post-title">'.get_the_title( ).'</h2>';
                                                    $html .= (get_the_excerpt() != '') ? '<div class="schedule_info">'.get_the_excerpt().'</div>':'';
                                                  $html .= '</div>';

                                                  
                                                  $html .= '<div class="col-md-2 list_speaker">
                                                              <a href="'.$schedule_link_speaker.'"><span>'.esc_html__('View Speaker','ova_event').'</span>

                                                              <img src="'.get_the_post_thumbnail_url(  $current_id, 'mitup_thumbnail_70x70' ).'" alt="'.get_the_title( ).'" />
                                                              </a>
                                                            </div>';

                                                $html .= '</div></div>
                                              </article>';

                                              $order_lv3++;
                                        endwhile;
                                      endif;
                                       wp_reset_postdata();
                        $html .= '</div></div>';
                  }
                }else{ /* Display with parent category */
                  
                      // $term_lv2 = get_term_by('term_id', $value1, 'categories');
                        $args = array('post_type' => 'schedule', 
                                      'categories'=>$value1, 
                                      'orderby'=> $filter_orderby, 
                                      'order'=> $filter_order,
                                      'posts_per_page'=> $schedule_count_each_tab
                                    );
                        $schedule = new WP_QUery($args);
                      
                        $class_term_lv2 = '';
                        $order_lv3 = 0;
                        $html .= '<div class="schedule_line"></div>';
                        $html .= '<div id="tab-lv2-'.$value1.'" class="tab-pane1 fade1 '.$class_term_lv2.'">
                                    <div class="schedule_timeline">';
                                      
                                      if($schedule->have_posts()):
                                        while($schedule->have_posts()): $schedule->the_post();

                                        $current_id = get_the_id();
                                          
                                        $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id());

                                       
                                          
                                          $schedule_timetext = get_post_meta($current_id, "mitup_met_schedule_timetext", true);
                                          $schedule_timeicon = get_post_meta($current_id, "mitup_met_schedule_timeicon", true);
                                          $speaker_intermediate = get_post_meta($current_id, "mitup_met_schedule_intermediate", true);
                                          $speaker_intermediate_icon = get_post_meta($current_id, "mitup_met_speaker_intermediate_icon", true);

                                          $schedule_author = get_post_meta($current_id, "mitup_met_schedule_author", true);
                                          $schedule_author_job = get_post_meta($current_id, "mitup_met_schedule_author_job", true);
                                          $schedule_link_speaker = get_post_meta($current_id, "mitup_met_schedule_link_speaker", true);

                                          


                                          $style_lv3 = ($order_lv3%2 == 0) ? '':'odd';

                                            $html .= '
                                              <article class="item '.$style_lv3.'">
                                                <div class="container-fluid"><div class="row">';

                                                  $html .= '<div class="col-md-3">';
                                                    $html .='<div class="quick_speaker">';
                                                        
                                                        $html .= '<div class="time" style="color: '.$atts['time_color'].'">';
                                                        $html .= ($schedule_timeicon != '') ? '<i class="fa '.$schedule_timeicon.'"></i>&nbsp;&nbsp;':'';
                                                        $html .= ($schedule_timetext != '') ? $schedule_timetext:'';
                                                        $html .= '</div>';

                                                        $html .= '<div class="intermediate" style="color: '.$atts['intermediate_color'].'">';
                                                        $html .= ($speaker_intermediate_icon != '') ? '<i class="fa '.$speaker_intermediate_icon.'"></i>&nbsp;&nbsp;':'';
                                                        $html .= ($speaker_intermediate != '') ? $speaker_intermediate:'';
                                                        $html .= '</div>';

                                                        $html .= '<div class="share_schedule">';
                                                        $html .= '<a target="_blank" href="https://twitter.com/share?url='.urlencode( get_permalink() ).'&amp;text='.urlencode( get_the_title() ).'&amp;hashtags=simplesharebuttons"><i class="fa fa-twitter"></i></a>
                                                                  <a target="_blank" href="http://www.facebook.com/sharer.php?u='.get_permalink().'"><i class="fa fa-facebook"></i></a>
                                                                  <a target="_blank" href="https://plus.google.com/share?url='.get_permalink().'"><i class="fa fa-google-plus"></i></a>';
                                                        $html .= '</div>';

                                                    $html .= '</div>';
                                                  $html .= '</div>';

                                                  $html .= '<div class="col-md-7">';
                                                    $html .= ($atts['turnofflink'] == "no") ? '<h2 class="post-title"><a href="'.get_permalink().'">'.get_the_title( ).'</a></h2>' : '<h2 class="post-title">'.get_the_title( ).'</h2>';
                                                    $html .= (get_the_excerpt() != '') ? '<div class="schedule_info">'.get_the_excerpt().'</div>':'';
                                                  $html .= '</div>';

                                                  
                                                  $html .= '<div class="col-md-2 list_speaker">
                                                              <a href="'.$schedule_link_speaker.'"><span>'.esc_html__('View Speaker','ova_event').'</span>
                                                              <img src="'.get_the_post_thumbnail_url(  $current_id, 'mitup_thumbnail_70x70'  ).'" alt="'.get_the_title( ).'" />
                                                              </a>
                                                            </div>';


                                                $html .= '</div></div>
                                              </article>';
                                        endwhile;
                                      endif;
                                       wp_reset_postdata();
                        $html .= '</div></div>';
                  
                }
                  
                $html .= '</div>';
                /* /Display content for tab lv1 and lv2 */
              
            /* /Display navigation category lv2 */         
          $html .= '</div>'; 
        }
      
    /* /Display content for category lv1 */
    $html .= '</div>';




    
    $html .= "</div>";
    
    return $html;
}
/* /Schedule */


/* Gallery */
add_shortcode('event_gallery', 'event_gallery');
function event_gallery($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'class' => ''
    ), $atts);
    
    $html = '<div class="ova_gallery">'.do_shortcode($content).'</div>';

    return $html;
}

add_shortcode('event_gallery_item', 'event_gallery_item');
function event_gallery_item($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'thumbnail' => '',
      'image' => '',
      'alt'   => '',
      'class' => ''
    ), $atts);

    $thumbnail = wp_get_attachment_image_src($atts['thumbnail'], 'full');
    $image = wp_get_attachment_image_src($atts['image'], 'full');
    $rand = 'ova_'.rand().'_event';
    $html = '';

    $html .= '<div class="col-md-12 event_gallery_item '.$atts['class'].'">';
    $html .= '<a href="'.$image['0'].'" data-rel="prettyPhoto['.$rand.']" title="'.$atts['alt'].'"><img src="'.$thumbnail[0].'"  alt="'.$atts['alt'].'" /></a>';
    $html .= '</div>';

    return $html;
}







/*adress shortcut*/
add_shortcode('event_address', 'event_address');
function event_address($atts, $content = null) {

    $atts = shortcode_atts(
    array(      
      'fonts_icon'  => '',
      'direction'  => 'text-left',
      'title'  => '',
      'title_color'  => '',
      'description' => '',
      'show_border_right'  => '',
      'border_color' => '',
    
      'class' => '',
    ), $atts);

    

      $html ='<div  class="address  '.$atts['class'].' '.$atts['direction'].'">';
      $html .= '<ul>';

      if($atts['direction'] == 'text-left'){
        $html .=$atts['fonts_icon']==''?'':'<li><span class="pull-circle">
                        <i class="fa '.$atts['fonts_icon'].'"></i>
                    </span></li>';

        $html .= '<li>';
          $html .= $atts['title']==''?'':'<h4 class="title" style="color:'.$atts['title_color'].'">'.$atts['title'].'</h4>';
          $html .= $atts['description']==''?'':'<span class="desc">'.$atts['description'].'</span>';
        $html .= '</li>';

      }else{
        $html .= '<li>';
          $html .= $atts['title']==''?'':'<h4 class="title" style="color:'.$atts['title_color'].'">'.$atts['title'].'</h4>';
          $html .= $atts['description']==''?'':'<span class="desc">'.$atts['description'].'</span>';
        $html .= '</li>';
        $html .=$atts['fonts_icon']==''?'':'<li><span class="pull-circle">
                        <i class="fa '.$atts['fonts_icon'].'"></i>
                    </span></li>';
      }
      $html .= '</ul>';

    $html.= ($atts['show_border_right']) ? '<div class="media-border-right" style="background-color:'.$atts['border_color'].'"></div>' : '';
    $html .='</div>';
    return $html;
} 

/*End adress shortcut*/

/*Topics covered shortcut*/
add_shortcode('event_topics_covered', 'event_topics_covered');
function event_topics_covered($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'fonts_icon'  => '',
      'align'  => 'text-left',
      'icon_color'  => '',
      'title'  => '',
      'title_color'  => '',
      'title_link'=>'',
      'target_link'=>'_self',
      'description' => '',
   
      'class' => '',
    ), $atts);

    

    $html ='<div class="topics_covered '.$atts['class'].' '.$atts['align'].'" >';
    $html .=$atts['fonts_icon']==''?'':'<span class="media-title" style="border-color: '.$atts['icon_color'].'"> 
                      <i class="fa '.$atts['fonts_icon'].'" style="color:'.$atts['icon_color'].'"></i>
                  </span>';
    
    $html .= ( $atts['title']=='' ) ? '':'<div class="media-heading">';
    $html .= ( $atts['title_link']=='' ) ? $atts['title']:'<a style="color:'.$atts['title_color'].'" href="'.$atts['title_link'].'" target="'.$atts['target_link'].'">'.$atts['title'].'</a>';
    $html .= ( $atts['title']=='' ) ? '':'</div>';
    $html .= ( $atts['description']=='' ) ? '' : '<span class="media-desc">'.$atts['description'].'</span>';
    
    $html .=( $content=='' ) ? '' : '<div class="media-other_desc">'.do_shortcode($content).'</div>';
    $html .='</div>';
    return $html;
} 
/*End Topics covered shortcut*/


/* speakers */
add_shortcode('event_speakers', 'event_speakers');
function event_speakers($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'count' => '3',
      'duration'  => '3000',
      'autoplay'  => 'true',
      'dots' => 'true',
      'loop'    => 'true',
    
      'class'       => '',
    ), $atts);

    $html = '';
    

    $html .='
    <div >
      <div  class="owl-carousel event_speakers  '.$atts['class'].'" data-count="'.$atts['count'].'"  data-duration="'.$atts['duration'].'" data-autoplay="'.$atts['autoplay'].'" data-dots="'.$atts['dots'].'" data-loop="'.$atts['loop'].'">
      '.do_shortcode($content).'
    </div></div>
    ';
    return $html;
}
/* /speakers */

/*Event event_speakers_item shortcut*/
add_shortcode('event_speakers_item', 'event_speakers_item');
function event_speakers_item($atts, $content = null) {

    $atts = shortcode_atts(
    array(     
      'thumb_image'  => '',
      'title'  => '',
      'title_color'  => '',
      'title_link'=>'',
      'job'=>'',
      'target_link'=>'_self',
      
      'class' => '',
    ), $atts);

    $html = '<div class=" speaker '.$atts['class'].'">';

    $thumbnail = wp_get_attachment_image_src($atts['thumb_image'], 'full');
    $html .='<div class="event_speakers_item '.$atts['class'].'">';
    
    $html .= '<div class="media-thumb">';
    $html .= $thumbnail['0'] ==''?'':'<img src="'.$thumbnail['0'].'" alt="'.$atts['title'].'" title="'.$atts['title'].'" class="img-responsive">';
    $html .= '<div class="picture_overlay">';
    $html .= '<div class="icons">';
    $html .='<div class="media-social">';
    $html .= rawurldecode( base64_decode( strip_tags( $content ) ) );
    $html .='</div>';  
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    $html .='<div class="media-body-old">';

    $html .= $atts['title']==''?'':'<h4 class="media-heading" style="color:'.$atts['title_color'].'">';
    $html .=$atts['title_link']==''?$atts['title']:'<a style="color:'.$atts['title_color'].'" href="'.$atts['title_link'].'" target="'.$atts['target_link'].'">'.$atts['title'].'</a>';
    $html .=$atts['job']==''?'':'<span class="media-info">'.$atts['job'].'</span>';
    $html .= '</h4>';
    $html .='</div>';
    
    $html .='</div>';

    $html .= '</div>';
    return $html;
} 
/*Event event_speakers_item shortcut*/




/* event_bgslide */
add_shortcode('event_bgslide', 'event_bgslide');
function event_bgslide($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'duration'  => '3000',
      'auto_slider'  => 'true',
      'navigation' => 'true',
      'loop'    => 'true',
    
      'class'       => '',
    ), $atts);

    $html = '';
    

    $html .='
    <div >
      <div  class="owl-carousel event_bgslide  '.$atts['class'].'" data-loop="'.$atts['loop'].'" data-auto_slider="'.$atts['auto_slider'].'" data-duration="'.$atts['duration'].'" data-navigation="'.$atts['navigation'].'">
      '.do_shortcode($content).'
    </div></div>
    ';
    return $html;
}
/* /event_bgslide */

/*Event event_bgslide_item shortcut*/
add_shortcode('event_bgslide_item', 'event_bgslide_item');
function event_bgslide_item($atts, $content = null) {

    $atts = shortcode_atts(
    array(     
      'thumb_image'  => '',
      'class' => '',
    ), $atts);

    $html = '<div class="bgslide_item '.$atts['class'].'">';

      $thumbnail = wp_get_attachment_image_src($atts['thumb_image'], 'full');
      $html .='<div class="bg" style="background: url('.$thumbnail['0'].') no-repeat"></div>';
      
    $html .= '</div>';
    return $html;
} 
/*Event event_bgslide_item shortcut*/




/*event Nearby Accomodation*/
add_shortcode('event_nearby_accomodation', 'event_nearby_accomodation');
function event_nearby_accomodation($atts, $content = null) {

    $atts = shortcode_atts(
    array( 
      'thumbnail'=>'',     
      'title'  => '',
      'title_color'  => '',
      'title_link'=>'',
      'target_link'=>'_self',
      'description' => '',
      'price' => '',
      'readmore' => '',
    
      'readmore_color' => ''
    ), $atts);

    


    $thumbnail = wp_get_attachment_image_src($atts['thumbnail'], 'full');
    $html='<div class="nearby_accomodation ">';
    $html.=$thumbnail['0']==''?'':'<div class="media-thumb"><img src="'.$thumbnail['0'].'" alt="'.$atts['title'].'"><div class="price">'.$atts['price'].'<div class="arrow-left"></div></div></div>';
    $html .='<div class="media-body">';
    $html .= $atts['title']==''?'':'<h4 class="media-heading" style="color:'.$atts['title_color'].'">';
    $html .=$atts['title_link']==''?$atts['title']:'<a style="color:'.$atts['title_color'].'" href="'.$atts['title_link'].'" target="'.$atts['target_link'].'">'.$atts['title'].'</a>';
    $html .= '</h4>';
    $html .= $atts['description']==''?'':'<span class="media-desc">'.$atts['description'].'</span>';
    
    $html .=$atts['readmore']==''?'':'<span class="media-readmore"><a style="color:'.$atts['readmore_color'].'" href="'.$atts['title_link'].'" target="'.$atts['target_link'].'">'.$atts['readmore'].'</a></span>';
    $html .='</div></div>';
    return $html;
} 
/*End event Nearby Accomodation*/



/* Pricing */
/* Create pricing */
add_shortcode('event_pricing', 'event_pricing');
function event_pricing($atts, $content = null) {
$atts = shortcode_atts(
    array(
      'name' => '',
      'pricing_style' => 'ca',
      'value'   => '',
      'currency' => '',
      'feature' => 'nofeature',
    
      'color' => '',
      'class'     => '',
    ), $atts);

    $html = '';
    

    $html .= '
      <div class="event_price '.$atts['class'].'  " >
          <div class="price-header">';
              
              $html .='<h3 class="price_title" style="background-color:'.$atts['color'].'">';
              $html .= ($atts['feature'] != 'nofeature') ? '<span class="feature fa  fa-star clear"></span>':'';
              $html .= $atts['name'].'</h3>
              
              <div class="price_value" style="color:'.$atts['color'].'">';

               if($atts['pricing_style'] == 'ac'){
                  $html .= '<span class="price_amount">'.$atts['value'].'</span><sub>'.$atts['currency'].'</sub><span class="price-per"></span>';
               }else{
                  $html .= '<sub>'.$atts['currency'].'</sub><span class="price_amount ac">'.$atts['value'].'</span><span class="price-per"></span>';
               }

              $html .= '</div>
          </div>
          <div class="price-table-rows">'.do_shortcode( $content );
            
            
          $html .= '</div>
      </div>
    ';

    return $html;

} 
/* /Pricing */








/* event_twitter_status */
add_shortcode('event_twitter_status', 'event_twitter_status');
function event_twitter_status($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'count' => '3',
      'duration'  => '3000',
      'autoplay'  => 'true',
      'dots' => 'true',
      'loop'    => 'true',
    
      'class'       => '',
    ), $atts);

    $html = '';
    

    $html .='
    <div >
      <div  class="owl-carousel event_twitter  '.$atts['class'].'" data-count="'.$atts['count'].'"  data-duration="'.$atts['duration'].'" data-autoplay="'.$atts['autoplay'].'" data-dots="'.$atts['dots'].'" data-loop="'.$atts['loop'].'">
      '.do_shortcode($content).'
    </div></div>
    ';
    return $html;
}
/* /event_twitter_status */

/*Event event_twitter_status_item shortcut*/
add_shortcode('event_twitter_status_item', 'event_twitter_status_item');
function event_twitter_status_item($atts, $content = null) {

    $atts = shortcode_atts(
    array(     
      'link'  => ''
    ), $atts);

    $html = '<div class="twitter-wjs">
            <blockquote class="twitter-tweet">
            <a href="'.$atts['link'].'">
            </a>
            </blockquote>
            </div>
            ';
    return $html;
} 
/*Event event_twitter_status_item shortcut*/




/* Testimonial */
add_shortcode('event_testimonial', 'event_testimonial');
function event_testimonial($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'duration'  => '3000',
      'autoplay'  => 'true',
      'dots' => 'true',
      'loop'    => 'true',
    
      'class'       => '',
    ), $atts);

    $html = '';
    

    $html .='
    <div class="testimonials-carousel alt " >
      <div  class="owl-carousel testimonials-alt '.$atts['class'].'"  data-duration="'.$atts['duration'].'" data-autoplay="'.$atts['autoplay'].'" data-dots="'.$atts['dots'].'" data-loop="'.$atts['loop'].'">
      '.do_shortcode($content).'
    </div></div>
    ';
    return $html;
}
/* /Testimonial */


/* Testimonial item */
add_shortcode('event_testimonial_item', 'event_testimonial_item');
function event_testimonial_item($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'image' => '',
      'desc'   => '',
      'author'    => '',
      'rate'      => '5',
      'link'      => '',
      'class'     => '',
    ), $atts);

    $image_info = '';
    $link_img = '';

    if($atts['image']) $image_info = wp_get_attachment_image_src($atts['image'], 'full');
    if($image_info[0]){
        $link_img = $image_info[0];
    }else{
        $link_img = $atts['image'];
    }

    $html = '<div class="testimonial">
                    <div class="media">
                        <div class="media-body">
                            <div class="media-left">
                                <a href="'.$atts['link'].'">
                                    <img class="media-object testimonial-avatar" src="'.$link_img.'" alt="'.$atts['author'].'">
                                </a>
                            </div>
                            <div class="testimonial-text">'.$atts['desc'].'</div>
                            <div class="testimonial-name">'.$atts['author'].'</div>';

                            if($atts['rate'] > 0){
                                $html .= '<div class="testimonial-rating">';
                                for($i = 1; $i <= $atts['rate']; $i++){
                                    $html .= '<i class="fa fa-star"></i>';
                                }
                                $html .= '</div>';    
                            }
                            

                        $html .= '</div>
                    </div>
                </div>';
    
    return $html;
    
}    
/* /Testimonial item */



/* event_sponsor */
add_shortcode('event_sponsor', 'event_sponsor');
function event_sponsor($atts, $content = null) {

    $atts = shortcode_atts(
    array(
      'count' => '3',
      'duration'  => '3000',
      'autoplay'  => 'true',
      'dots' => 'true',
      'loop'    => 'true',
    
      'class'       => '',
    ), $atts);

    $html = '';
    

    $html .='
    <div >
      <div  class="owl-carousel event_sponsor  '.$atts['class'].'" data-count="'.$atts['count'].'"  data-duration="'.$atts['duration'].'" data-autoplay="'.$atts['autoplay'].'" data-dots="'.$atts['dots'].'" data-loop="'.$atts['loop'].'">
      '.do_shortcode($content).'
    </div></div>
    ';
    return $html;
}
/* /event_sponsor */

/* event_sponsor_item shortcut*/
add_shortcode('event_sponsor_item', 'event_sponsor_item');
function event_sponsor_item($atts, $content = null) {

    $atts = shortcode_atts(
    array(     
      'thumb_image'  => '',
      'title' => '',
      'alt'  => ''
    ), $atts);

    $html = '<div class="sponsor_item">';
    $thumbnail = wp_get_attachment_image_src($atts['thumb_image'], 'full');
    $html .= $thumbnail['0'] ==''?'':'<img src="'.$thumbnail['0'].'" alt="'.$atts['alt'].'" title="'.$atts['title'].'" class="img-responsive">';
    $html .= '</div>';
    return $html;
} 
/* event_sponsor_item shortcut*/




/*event From our blog*/
  add_shortcode('event_from_our_blog', 'event_from_our_blog');
  function event_from_our_blog($atts, $content = null) {

      $atts = shortcode_atts(
      array( 
        'category'=>'',
        'total_count'=>'20',
        'cols_count'=>'3',
        'show_thumb'=>'',
        'show_title'=>'',
        'show_desc'=>'',
        'name_readmore'=>'',
        'show_readmore'=>'',
        'show_author'=>'',
        'show_create_date'=>'',
        'duration'  => '3000',
        'autoplay'  => 'true',
        'dots' => 'true',
        'loop'    => 'true',
       
        'class' => '',
      ), $atts);

   

      $args =array();
      if ($atts['category']=='all') {
        $args=array('post_type' => 'post', 'posts_per_page' => $atts['total_count']);
      }else{
        $args=array('post_type' => 'post', 'cat'=>$atts['category'],'posts_per_page' => $atts['total_count']);
      }
     
      $blog = new WP_Query($args);
      
      ob_start(); ?>

      <div  class="owl-carousel event_blog <?php echo esc_attr($atts['class']);?>  "  data-count="<?php echo esc_attr($atts['cols_count']); ?>" data-duration="<?php echo esc_attr($atts['duration']); ?>" data-autoplay="<?php echo esc_attr($atts['autoplay']); ?>" data-dots="<?php echo  esc_attr($atts['dots']); ?>" data-loop="<?php echo  esc_attr($atts['loop']); ?>">

        <?php while($blog->have_posts()) : $blog->the_post(); ?>
         
           <div class="from_our_blog">
              <article class="post-wrap">

                  <?php if($atts['show_thumb']){ ?>
                    <div class="post-media">

                            <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                            <?php if($thumbnail_url){ ?>
                                <img  src="<?php   the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="img-responsive">
                            <?php } ?>
                    </div>
                  <?php } ?>
                  <div class="post-wrapbody">
                    <div class="post-header">
                        <?php if($atts['show_title']){ ?>
                          <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title( ); ?></a></h2>
                        <?php } ?>
                        <div class="post-meta">
                            <?php if($atts['show_create_date']){ ?>
                            <span class="post-date">
                                <i class="fa fa-clock-o"></i>&nbsp;
                                <span class="day"> <?php the_time( get_option( 'date_format' ));?></span>
                            </span>
                            <?php } ?>

                            <?php if($atts['show_create_date'] && $atts['show_author']){ ?>
                               <span class="slash">/</span>
                            <?php } ?>

                           <?php if($atts['show_author']){ ?>
                             <span class="post-author">
                               <i class="fa fa-meh-o"></i>&nbsp;
                               <span class="author"><?php the_author() ; ?></span>
                             </span>
                            <?php } ?> 
                           
                            <span class="slash">/</span>
                            <i class="fa fa-comment-o"></i>&nbsp;                   
                            <?php comments_popup_link(__(' Leave Comment', 'ova_event'), __(' 1', 'ova_event'), ' %'.__('', 'ova_event')); ?>

                        </div>
                    </div>
                    <?php if($atts['show_desc']){ ?>
                      <div class="post-body">
                          <div class="post-excerpt">
                              <?php the_excerpt();?>                  
                          </div>
                      </div>
                    <?php } ?>
                   
                    <?php if($atts['show_readmore']){ ?>
                      <div class="post-footer">
                          <span class="post-readmore">
                              <a href="<?php the_permalink(); ?>"><?php  _e($atts['name_readmore'], "event"); ?></a>
                          </span>
                      </div>
                    <?php } ?>
                  </div>
              </article>
          </div>
        <?php endwhile; ?>
      </div>
      <?php
         wp_reset_postdata();
          return ob_get_clean();
      }

/*End From our blog*/


/* Map */
add_shortcode('event_map', 'event_map');
function event_map($atts, $content = null) {
$atts = shortcode_atts(
    array(
      'idmap'  => 'gmap-canvas',
      'location'  => '',
      'title'   => '',
      'zoom'      => '15',
      'icon'  => '',
    
      'class'  => '',
    ), $atts);
    $html = '';
    

    $icon = wp_get_attachment_image_src($atts['icon'], 'medium');
    

    $html .= '
      <div class="event-google-map-wrap '.$atts['class'].' " >
        <div class="event-google-map" data-zoom="'.$atts['zoom'].'" data-icon="'.$icon[0].'" data-title="'.htmlentities(rawurldecode( base64_decode( strip_tags( $atts['title'] ) ) )).'" data-location="'.htmlentities(rawurldecode( base64_decode( strip_tags( $atts['location'] ) ) ) ).'" data-idmap="'.$atts['idmap'].'" >
            <div id="'.trim($atts['idmap']).'" class="iframemap"></div>
        </div>
      </div>
    ';

    return $html;

}
/* /Map */




/*event social*/
add_shortcode('event_social', 'event_social');
function event_social($atts, $content = null) {
$atts = shortcode_atts(
    array(
      'class'   => ''
    ), $atts);
   $html ='<div class="event_social_icon">';
   $html .= do_shortcode( $content );
   $html .='</div>';
    return $html;
}
add_shortcode('event_social_item', 'event_social_item');
function event_social_item($atts, $content = null) {
$atts = shortcode_atts(
    array(
      'fonts_icon' => '',
      'icon_color' => '',
      'icon_link' => '',
      'target_link' => '',
      'class'   => ''
    ), $atts);
   $html ='';
   $html .= $atts['fonts_icon']==''?'':'<a class="'.$atts['class'].'" href="'.$atts['icon_link'].'" target="'.$atts['target_link'].'"><i style="color:'.$atts['icon_color'].'" class="fa '.$atts['fonts_icon'].'"></i></a>';
    return $html;
}
/*End event social*/


/* Service */
add_shortcode('event_service', 'event_service');
function event_service($atts, $content = null) {

  $atts = shortcode_atts(
    array(
      'icon'    => '',
      'title'   => '',
      'desc'    => '',
      'class'   => ''
  ), $atts);

   $html ='<div class="event_service">
            <i class="fa '.$atts['icon'].'"></i>
            <div class="title">'.$atts['title'].'</div>
            <div class="desc">'.$atts['desc'].'</div>
          </div>';
   
    return $html;
}

/* /Service */



/* Create makedonation */
add_shortcode('event_makedonation', 'event_makedonation');
function event_makedonation($atts, $content = null) {
    global $theme_option;
    $atts = shortcode_atts(
    array(
      'title'         => '',
      'paypalemail'   => '',
      'currency_code' => '',
      'place_holder'  => 'Insert Number',
    
      'class' => ''
    ), $atts);
    $html = '';

    

    $html .= '
      <div class="event_donation '.$atts['class'].'  " >
          <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <!-- Identify your business so that you can collect the payments. -->
              <input type="hidden" name="business" value="'.$atts['paypalemail'].'">
              <!-- Specify a Donate button. -->
              <input type="hidden" name="cmd" value="_donations">
              <!-- Specify details about the contribution -->
              <input type="hidden" name="item_name" value="Donate">
              <input type="hidden" name="item_number" value="">
              <input type="text" placeholder="'.$atts['place_holder'].'" class="number" name="amount" value="">
              <input type="hidden" name="currency_code" value="'.$atts['currency_code'].'">
              <!-- Display the payment button. -->
              <button name="submit" class="btn btn-theme">'.$atts['title'].'</button>
              <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
          </form>
      </div>  
    ';

    return $html;
}



?>