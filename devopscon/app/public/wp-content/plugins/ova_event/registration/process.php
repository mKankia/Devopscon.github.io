<?php 

function ova_process_register_pay(){

	/* Direct to paypal */
	if ( isset( $_POST['register_type'] ) && $_POST['register_type'] == 'pay' ) {

		$customer = $_POST['customer'];
		$price = $_POST['price'];
		$ticket = $_POST['ticket'];
		$total = $price * $ticket;

		$options_pay = get_option( 'option_name_pay' );

		$environment_pay = $options_pay['environment_pay'];
		$currency_pay = $options_pay['currency_pay'];
		$business_email_pay = $options_pay['business_email_pay'];
		$title_store_pay = $options_pay['title_store_pay'];
		$thanks_page_pay = $options_pay['thanks_page_pay'];
		$cancel_page_pay = $options_pay['cancel_page_pay'];
		$register_notify_paypal_page = home_url('/').'wp-content/plugins/ova_event/registration/update_pay.php';

		$link_paypal = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	    
	    if($environment_pay == 'live'){
	        $link_paypal = "https://www.paypal.com/cgi-bin/webscr";
	    }else{
	        $link_paypal = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	    }

	    $paypal_url = $link_paypal.'?cmd=_xclick&business='
	    			.urlencode($business_email_pay)
	    			.'&item_name='.urlencode($title_store_pay)
	    			.'&amount='.urlencode($price)
	    			.'&currency_code='.urlencode($currency_pay)
	    			.'&return='.urlencode($thanks_page_pay)
	    			.'&cancel_return='.urlencode($cancel_page_pay)
	    			.'&notify_url='.urlencode($register_notify_paypal_page)
	    			.'&custom='.urlencode($customer)
	    			.'&quantity='.urlencode($ticket);

	    wp_redirect( $paypal_url ); exit;

	}

}
add_action( 'init', 'ova_process_register_pay' );
