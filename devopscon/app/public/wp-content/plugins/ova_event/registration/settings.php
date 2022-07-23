<?php 

class ovaevent_settings{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $free;
    private $pay;
    
    /**
     * Start up
     */
    public function __construct(){
    	add_action( 'admin_init', array( $this, 'create_table' ) );
        add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
        
    }

    /* Create table */
    public function create_table(){
    	global $wpdb;

		$wpdb->query('CREATE TABLE IF NOT EXISTS `ovaevent_free` (
		        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		        `customer_email` TEXT NOT NULL,
		        `info` TEXT NOT NULL,
                `customer_id` TEXT NOT NULL,
		        `created` INT( 4 ) UNSIGNED NOT NULL
		) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;');

		$wpdb->query('CREATE TABLE IF NOT EXISTS `ovaevent_pay` (
		        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		        `customer_email` TEXT NOT NULL,
		        `total` TEXT NOT NULL,
                `price` TEXT NOT NULL,
                `ticket` TEXT NOT NULL,
		        `currency` TEXT NOT NULL,
		        `customer_id` TEXT NOT NULL,
		        `transaction_id` TEXT NOT NULL,
		        `info` TEXT NOT NULL,
		        `status` TEXT NOT NULL,
		        `created` INT( 4 ) UNSIGNED NOT NULL
		) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;');
    }

    /**
     * Add options page
     */
    public function add_menu_page(){
        
        //add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);

        add_menu_page(
        	__( 'Registration', 'event' ),
        	__( 'Registration', 'event' ), 
        	'manage_options', 
        	'ovaevent_settings',
        	array( $this, 'create_settings_free' )
        );

	    add_submenu_page(
	    	'ovaevent_settings', 
	    	__( 'Settings free form ', 'event' ), 
	    	__( 'Settings free form', 'event' ),
	    	'manage_options', 
	    	'p_free', 
	    	array( $this, 'create_settings_free' )
	    );

	    add_submenu_page(
	    	'ovaevent_settings', 
	    	__( 'Settings for paypal', 'event' ), 
	    	__( 'Settings for paypal', 'event' ), 
	    	'manage_options', 
	    	'p_pay', 
	    	array( $this, 'create_settings_pay' )
	    );

    }

    /**
     * Options page callback
     */
    public function create_settings_free(){
        // Set class property
        $this->free = get_option( 'option_name_free' );

        ?>
        <div class="wrap">
                   
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'option_group_free' );   
                do_settings_sections( 'p_free' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    public function create_settings_pay(){
        // Set class property
        $this->pay = get_option( 'option_name_pay' );
        ?>
        <div class="wrap">
                   
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'option_group_pay' );   
                do_settings_sections( 'setting-admin-pay' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init(){

        register_setting(
            'option_group_free', // Option group
            'option_name_free' // Option name
        );

	        add_settings_section(
	            'section_free', // ID
	            'Settings Registration Free', // Title
	            array( $this, 'print_section_info' ), // Callback
	            'p_free' // Page
	        );

	        add_settings_field(
	            'fields_free', 
	            esc_html__( 'Define Fields','event' ), 
	            array( $this, 'fields_free_callback' ), 
	            'p_free', // Page
	            'section_free' // Section
	        );

	        add_settings_field(
	            'email_free', // ID
	            esc_html__('Email to received notice when registing successfully', 'event'), // Title 
	            array( $this, 'email_free_callback' ), // Callback
	            'p_free', // Page
	            'section_free' // Section           
	        );

	        add_settings_field(
	            'successmg_free', 
	            esc_html__( 'Success Message','event' ), 
	            array( $this, 'successmg_free_callback' ), 
	            'p_free', // Page
	            'section_free' // Section
	        );

            add_settings_field(
                'email_name_free', 
                esc_html__( 'Email Name When register successfully','events' ), 
                array( $this, 'email_name_free_callback' ), 
                'p_free', // Page
                'section_free' // Section
            );

            add_settings_field(
                'email_object_free', 
                esc_html__( 'Email Object When register successfully','events' ), 
                array( $this, 'email_object_free_callback' ), 
                'p_free', // Page
                'section_free' // Section
            );

            add_settings_field(
                'email_template_free', 
                esc_html__( 'Email Template When register successfully','events' ), 
                array( $this, 'email_template_free_callback' ), 
                'p_free', // Page
                'section_free' // Section
            );




	    register_setting(
            'option_group_pay', // Option group
            'option_name_pay' // Option name
        );

	        add_settings_section(
	            'ovaevent_settings_pay', // ID
	            'Settings Registration Paypal', // Title
	            array( $this, 'print_section_info' ), // Callback
	            'setting-admin-pay' // Page
	        );

	        add_settings_field(
	            'fields_pay', 
	            'Fields', 
	            array( $this, 'fields_pay_callback' ), 
	            'setting-admin-pay', 
	            'ovaevent_settings_pay'
	        );
	        
	        add_settings_field(
	            'price_pay', // ID
	            esc_html__('Require: Price', 'event' ), // Title 
	            array( $this, 'price_pay_callback' ), // Callback
	            'setting-admin-pay', // Page
	            'ovaevent_settings_pay' // Section           
	        );

            add_settings_field(
                'ticket_pay', // ID
                esc_html__('Require: Ticket.', 'event' ), // Title 
                array( $this, 'ticket_pay_callback' ), // Callback
                'setting-admin-pay', // Page
                'ovaevent_settings_pay' // Section           
            );

	        add_settings_field(
	            'environment_pay', // ID
	            'Environment', // Title 
	            array( $this, 'environment_pay_callback' ), // Callback
	            'setting-admin-pay', // Page
	            'ovaevent_settings_pay' // Section           
	        );  
	        add_settings_field(
	            'currency_pay', // ID
	            'Currency code', // Title 
	            array( $this, 'currency_pay_callback' ), // Callback
	            'setting-admin-pay', // Page
	            'ovaevent_settings_pay' // Section           
	        );
	        add_settings_field(
	            'business_email_pay', // ID
	            'Business Email Paypal', // Title 
	            array( $this, 'business_email_pay_callback' ), // Callback
	            'setting-admin-pay', // Page
	            'ovaevent_settings_pay' // Section           
	        );

             add_settings_field(
                'from_address_email', // ID
                '"From" address', // Title 
                array( $this, 'from_address_email_callback' ), // Callback
                'setting-admin-pay', // Page
                'ovaevent_settings_pay' // Section           
            );

	        add_settings_field(
	            'title_store_pay', // ID
	            'Description display in paypal page', // Title 
	            array( $this, 'title_store_pay_callback' ), // Callback
	            'setting-admin-pay', // Page
	            'ovaevent_settings_pay' // Section           
	        );
	        add_settings_field(
	            'thanks_page_pay', // ID
	            'Thanks Page', // Title 
	            array( $this, 'thanks_page_pay_callback' ), // Callback
	            'setting-admin-pay', // Page
	            'ovaevent_settings_pay' // Section           
	        );
	        add_settings_field(
	            'cancel_page_pay', // ID
	            'Cancel Page', // Title 
	            array( $this, 'cancel_page_pay_callback' ), // Callback
	            'setting-admin-pay', // Page
	            'ovaevent_settings_pay' // Section           
	        );

            add_settings_field(
                'email_name_pay', 
                esc_html__( 'Email Name When register successfully','events' ), 
                array( $this, 'email_name_pay_callback' ), 
                'setting-admin-pay', // Page
                'ovaevent_settings_pay' // Section
            );

            add_settings_field(
                'email_object_pay', 
                esc_html__( 'Email Object When register successfully','events' ), 
                array( $this, 'email_object_pay_callback' ), 
                'setting-admin-pay', // Page
                'ovaevent_settings_pay' // Section
            );

            add_settings_field(
                'email_template_pay', 
                esc_html__( 'Email Template When register successfully','events' ), 
                array( $this, 'email_template_pay_callback' ), 
                'setting-admin-pay', // Page
                'ovaevent_settings_pay' // Section
            );
	        
	        

    }

    

    
    public function print_section_info(){
        //print 'Enter your settings below:';
    }

    public function fields_free_callback(){
        printf(
            '<textarea rows="40" cols="70" id="fields_free" name="option_name_free[fields_free]">%s</textarea><br/>',
            isset( $this->free['fields_free'] ) ? esc_attr( $this->free['fields_free']) : ''
        );
        printf( 'You will find "How to define field" in the documentation<br/>');
        printf( '<br/><strong>Require: You have to use email field: </strong><br/>"email":{<br/>"type": "email",<br/>"label":"Your Email Here",<br/>"value":"",<br/>"require":"true",<br/>"class":""<br/>}' );
    }

    public function email_free_callback(){
        printf(
            '<input size="70" type="text" id="email_free" name="option_name_free[email_free]" value="%s" />',
            isset( $this->free['email_free'] ) ? esc_attr( $this->free['email_free']) : ''
        );
    }

    public function successmg_free_callback(){
    	printf(
    		'<textarea rows="5" cols="70" id="successmg_free" name="option_name_free[successmg_free]">%s</textarea>',
    		isset( $this->free['successmg_free'] ) ? esc_attr( $this->free['successmg_free']) : ''
    	);
    }

    public function email_name_free_callback(){
        printf(
            '<input size="70" type="text" id="email_name_free" name="option_name_free[email_name_free]" value="%s" />',
            isset( $this->free['email_name_free'] ) ? esc_attr( $this->free['email_name_free']) : ''
        );
        printf('<br/>For example: Register Event');
    }


    public function email_object_free_callback(){
        printf(
            '<input size="70" type="text" id="email_object_free" name="option_name_free[email_object_free]" value="%s" />',
            isset( $this->free['email_object_free'] ) ? esc_attr( $this->free['email_object_free']) : ''
        );
        printf('<br/>For example: Register Event Successfully');
    }
    

    public function email_template_free_callback(){
        printf(
            '<textarea rows="12" cols="70" id="email_template_free" name="option_name_free[email_template_free]">%s</textarea>',
            isset( $this->free['email_template_free'] ) ? esc_attr( $this->free['email_template_free']) : ''
        );
        printf('<br/>For example:<br/   > &lt;html&gt;&lt;body&gt;<br/>
&lt;h2&gt;New Free Register&lt;/h2&gt;<br/>
&lt;h4&gt;This is information&lt;/h4&gt;<br/>
&lt;strong&gt;Customer ID&lt;/strong&gt;[customerid]&lt;br/&gt;<br/>
&lt;strong&gt;Buyer Information&lt;/strong&gt;&lt;br/&gt;[userinfo]&lt;/body&gt;&lt;/html&gt;');
        printf('<br/><br/> Note: [customerid], [userinfo] : To display info of customer');
    }



    public function fields_pay_callback(){
    	printf(
    		'<textarea rows="40" cols="70" id="fields_pay" name="option_name_pay[fields_pay]">%s</textarea>',
    		isset( $this->pay['fields_pay'] ) ? esc_attr( $this->pay['fields_pay']) : ''
    	);
    }
    
    
    public function price_pay_callback(){
        printf(
            '<input size="70" type="text" id="price_pay" name="option_name_pay[price_pay]" value="%s"  />',
            isset( $this->pay['price_pay'] ) ? esc_attr( $this->pay['price_pay']) : ''
        );
        printf("<br/>");
        esc_html_e('This field use for paying that defined above. Please dont change this field value', 'event');
    }
    public function ticket_pay_callback(){
        printf(
            '<input size="70" type="text" id="ticket_pay" name="option_name_pay[ticket_pay]" value="%s"  />',
            isset( $this->pay['ticket_pay'] ) ? esc_attr( $this->pay['ticket_pay']) : ''
        );
        printf("<br/>");
        esc_html_e('This field use for paying that defined above. Please dont change this field value', 'event');
    }

    public function environment_pay_callback(){

        printf(
            '<select id="environment_pay" name="option_name_pay[environment_pay]">
				<option %s value="sandbox">Sandbox Test</option>
				<option %s value="live">Live Paypal</option>
			</select>',
            ( isset( $this->pay['environment_pay'] ) && $this->pay['environment_pay'] == 'sandbox' ) ? 'selected' : '',
            ( isset( $this->pay['environment_pay'] ) && $this->pay['environment_pay'] == 'live' ) ? 'selected' : ''
        );
    }
    public function currency_pay_callback(){
        printf(
            '<input size="70" type="text" id="currency_pay" name="option_name_pay[currency_pay]" value="%s" />',
            isset( $this->pay['currency_pay'] ) ? esc_attr( $this->pay['currency_pay']) : ''
        );
    }
    public function business_email_pay_callback(){
        printf(
            '<input size="70" type="text" id="business_email_pay" name="option_name_pay[business_email_pay]" value="%s" />',
            isset( $this->pay['business_email_pay'] ) ? esc_attr( $this->pay['business_email_pay']) : ''
        );
    }

     public function from_address_email_callback(){
        printf(
            '<input size="70" type="text" id="from_address_email" name="option_name_pay[from_address_email]" value="%s" placeholder="yourmail@mail.com" />',
            isset( $this->pay['from_address_email'] ) ? esc_attr( $this->pay['from_address_email']) : ''
        );
        printf("<br/>");
        esc_html_e( 'How the sender email appears in outgoing emails.', 'ova_event' );
    }

    public function title_store_pay_callback(){
        printf(
            '<input size="70" type="text" id="title_store_pay" name="option_name_pay[title_store_pay]" value="%s" />',
            isset( $this->pay['title_store_pay'] ) ? esc_attr( $this->pay['title_store_pay']) : ''
        );
    }
    public function thanks_page_pay_callback(){
        printf(
            '<input size="70" type="text" id="thanks_page_pay" name="option_name_pay[thanks_page_pay]" value="%s" />',
            isset( $this->pay['thanks_page_pay'] ) ? esc_attr( $this->pay['thanks_page_pay']) : ''
        );
    }
    public function cancel_page_pay_callback(){
        printf(
            '<input size="70" type="text" id="cancel_page_pay" name="option_name_pay[cancel_page_pay]" value="%s" />',
            isset( $this->pay['cancel_page_pay'] ) ? esc_attr( $this->pay['cancel_page_pay']) : ''
        );
    }

    public function email_name_pay_callback(){
        printf(
            '<input size="70" type="text" id="email_name_pay" name="option_name_pay[email_name_pay]" value="%s" />',
            isset( $this->pay['email_name_pay'] ) ? esc_attr( $this->pay['email_name_pay']) : ''
        );
        printf('<br/>For example: Register Event');
    }


    public function email_object_pay_callback(){
        printf(
            '<input size="70" type="text" id="email_object_pay" name="option_name_pay[email_object_pay]" value="%s" />',
            isset( $this->pay['email_object_pay'] ) ? esc_attr( $this->pay['email_object_pay']) : ''
        );
        printf('<br/>For example: Register Event Successfully');
    }
    

    public function email_template_pay_callback(){
        printf(
            '<textarea rows="12" cols="70" id="email_template_pay" name="option_name_pay[email_template_pay]">%s</textarea>',
            isset( $this->pay['email_template_pay'] ) ? esc_attr( $this->pay['email_template_pay']) : ''
        );
        printf('<br/>For example:<br/> &lt;html&gt;&lt;body&gt;<br/>
&lt;h3&gt;Thanks for your registration&lt;h3&gt;<br/>
&lt;strong&gt;Customer ID: &lt;/strong&gt;[customerid]&lt;br/&gt;<br/>
&lt;strong&gt;Transaction ID: &lt;/strong&gt;[transaction_id]&lt;br/&gt;<br/>
&lt;strong&gt;Price item: &lt;/strong&gt;[price] [currency]&lt;br/&gt;<br/>
&lt;strong&gt;Ticket: &lt;/strong&gt;[ticket]&lt;br/&gt;<br/>
&lt;strong&gt;Total: &lt;/strong&gt;[total][currency]&lt;br/&gt;<br/>
&lt;strong&gt;Registration Date: &lt;/strong&gt;[date]&lt;br/&gt;<br/>
&lt;strong&gt;Buyer Information: &lt;/strong&gt;&lt;br/&gt;[userinfo]<br/>
&lt;/body&gt;&lt;/html&gt;');
        printf('<br/><br/> Note: [customerid], [transaction_id] [price] [currency] [ticket] [total] [date] [userinfo]: To display info of customer');
    }



}

if( is_admin() )
    $ovaevent_settings = new ovaevent_settings();

