<?php

function event_set_content_type(){
    return "text/html";
}

/* Change for email from when send mail */
function register_wp_mail_from( $original_email_address ) {
  $options_free = get_option( 'option_name_free' );
  return $options_free['email_free'];
}

/* Change for name of email */
function register_wp_mail_from_name( $original_email_from ) {
  
  $options_free = get_option( 'option_name_free' );
  return $options_free['email_name_free'];
}




function ajax_action_stuff() {

	$data     = $_POST['data'];
	$customer_info    = wp_kses_post( $data['customer_info'] );
	$customer_id = sanitize_text_field( $data['customer_id'] );
	$register_type = sanitize_text_field( $data['register_type'] );
	$customer_email = sanitize_text_field( $data['customer_email'] );

	$price = $data['price'];
	$ticket = $data['ticket'];
	$currency = $data['currency'];

	if(trim($customer_info) == ''){
		echo 'false';
		return false;
	}

	if($register_type == 'free'){

		global $wpdb;
		$register_free = array(
			'customer_email' 	=> $customer_email,
			'info'       		=> $customer_info,
			'customer_id'		=> $customer_id,
			'created'     		=> time()
		);
		$insert_format = array('%s', '%s', '%s', '%s');
  		$wpdb->insert('ovaevent_free', $register_free, $insert_format);

  		if($customer_email != ''){
  			$options_free = get_option( 'option_name_free' );
	  		$admin_email =  $options_free['email_free'];
		    

		    $body_email = str_replace('[customerid]',$customer_id, $options_free['email_template_free']);
    		$body_email = str_replace('[userinfo]', str_replace('|||','',$customer_info), $body_email);


		    
		        $multiple_to_recipients = array($admin_email, $customer_email);

		        $subject = $options_free['email_object_free'];
		        $body    = $body_email;

		    add_filter( 'wp_mail_from', 'register_wp_mail_from' );
			add_filter( 'wp_mail_from_name', 'register_wp_mail_from_name' );
			add_filter( 'wp_mail_content_type','event_set_content_type' );
		    
		    wp_mail($multiple_to_recipients, $subject, $body);

		    remove_filter( 'wp_mail_content_type','event_set_content_type' );
		    remove_filter( 'wp_mail_from', 'register_wp_mail_from' );
    		remove_filter( 'wp_mail_from_name', 'register_wp_mail_from_name' );


  		}
  		
	  

	  echo 'true';
	  die();


	} else if( $register_type == 'pay' ){

		global $wpdb;
		$total = $price * $ticket;
		$register_pay = array(
			'customer_email' 	=> $customer_email,
			'total'				=> $total,
			'price'				=> $price,
			'ticket'			=> $ticket,
			'currency'			=> $currency,
			'customer_id'		=> $customer_id,
			'transaction_id'	=> '',
			'info'       		=> $customer_info,
			'status'			=> 'pending',
			'created'     		=> time()
		);
		$insert_format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');
  		$wpdb->insert('ovaevent_pay', $register_pay, $insert_format);

  		echo 'true';
  		die();

	}
 
}
add_action( 'wp_ajax_ajax_action', 'ajax_action_stuff' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_ajax_action', 'ajax_action_stuff' );
