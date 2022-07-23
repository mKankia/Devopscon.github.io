<?php  

function event_paypal_set_content_type(){
    return "text/html";
}


/* Change for email from when send mail */
function register_wp_mail_from_pay( $original_email_address ) {
  $options_free = get_option( 'option_name_pay' );

  if( $options_free['from_address_email'] ){
  	
  	return $options_free['from_address_email'];

  }else if( $options_free['business_email_pay'] ){

  	return $options_free['business_email_pay'];

  }else{

  	return get_option( 'admin_email' );

  }
  
}

/* Change for name of email */
function register_wp_mail_from_name_pay( $original_email_from ) {
  
  $options_free = get_option( 'option_name_pay' );
  return $options_free['email_name_pay'];
}




$pagePath = explode('/wp-content/', dirname(__FILE__));
include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));

	/* Paypal redict about site and update status */
	

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		foreach ($_REQUEST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
			$req .= "&$key=$value";
		}

		$options_pay = get_option( 'option_name_pay' );
		$business_email_pay = $options_pay['business_email_pay'];
		$title_store_pay = $options_pay['title_store_pay'];
		$environment_pay = $options_pay['environment_pay'];

		$link_paypal = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	    
	    if($environment_pay == 'live'){
	        $link_paypal = "https://www.paypal.com/cgi-bin/webscr";
	    }else{
	        $link_paypal = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	    }
		

		$ch = curl_init($link_paypal);
		if ($ch == FALSE) {
			return FALSE;

		}
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		if(defined('DEBUG')  && DEBUG == true) {
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		}
		// CONFIG: Optional proxy configuration
		//curl_setopt($ch, CURLOPT_PROXY, $proxy);
		//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		// Set TCP timeout to 30 seconds
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
		// of the certificate as shown below. Ensure the file is readable by the webserver.
		// This is mandatory for some environments.
		//$cert = __DIR__ . "./cacert.pem";
		//curl_setopt($ch, CURLOPT_CAINFO, $cert);
		$res = curl_exec($ch);
		if (curl_errno($ch) != 0){ // cURL error
			if(defined('DEBUG')  && DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
			}
			curl_close($ch);
			exit;
		} else {
			// Log the entire HTTP response if debug is switched on.
			if(defined('DEBUG')  && DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
				error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
				// Split response headers and payload
				list($headers, $res) = explode("\r\n\r\n", $res, 2);
			}
			curl_close($ch);
		}
		
		if (strcmp ($res, "VERIFIED") == 0) {
			global $wpdb;
			$wpdb->update(
				'ovaevent_pay', 
				array(
					'status'		=> $_REQUEST['payment_status'],
					'transaction_id' => $_REQUEST['txn_id'],
				), 
				array( 'customer_id' => $_REQUEST['custom']), 
				array(
					'%s',
					'%s'
				)			
			);

			$results = $wpdb->get_results( "SELECT * FROM `ovaevent_pay` where status = 'Completed' and customer_id = '".$_REQUEST['custom']."' ORDER BY `ID` DESC");	
			
			
			

			$body_email = str_replace('[customerid]',$results['0']->customer_id, $options_pay['email_template_pay']);
	    	$body_email = str_replace('[transaction_id]', $results['0']->transaction_id, $body_email);
	    	$body_email = str_replace('[price]', $results['0']->price, $body_email);
	    	$body_email = str_replace('[currency]', $results['0']->currency, $body_email);
	    	$body_email = str_replace('[ticket]', $results['0']->ticket, $body_email);
	    	$body_email = str_replace('[total]', $results['0']->total, $body_email);
	    	$body_email = str_replace('[date]', date(get_option('date_format'), $results['0']->created), $body_email);
	    	$body_email = str_replace('[userinfo]', html_entity_decode(str_replace('|||','',$results['0']->info)), $body_email);
			
			$multiple_to_recipients = array($business_email_pay, $results['0']->customer_email);	  	

	        $subject = $options_pay['email_object_pay'];
	        $body 	 = $body_email;
	        

	        add_filter( 'wp_mail_from', 'register_wp_mail_from_pay' );
			add_filter( 'wp_mail_from_name', 'register_wp_mail_from_name_pay' );
			add_filter( 'wp_mail_content_type','event_paypal_set_content_type' );
		    
		    wp_mail($multiple_to_recipients, $subject, $body);

		    remove_filter( 'wp_mail_content_type','event_paypal_set_content_type' );
		    remove_filter( 'wp_mail_from', 'register_wp_mail_from_pay' );
    		remove_filter( 'wp_mail_from_name', 'register_wp_mail_from_name_pay' );


	        
			
			
			if(defined('DEBUG')  && DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
			}		
		} else if (strcmp ($res, "INVALID") == 0) {
			// log for manual investigation
			// Add business logic here which deals with invalid IPN messages
			$emailTo = $_REQUEST['payer_email'];
	        $subject = esc_html__('Error Pay', 'event'); 
	        $body 	 = esc_html__('Error Order', 'event');
			
			wp_mail($emailTo, $subject, $body);
			if(defined('DEBUG')  && DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
			}
			return false;
		}