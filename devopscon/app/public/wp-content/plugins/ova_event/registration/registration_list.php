<?php

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Register_free_list_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'registration',     //singular name of the listed records
            'plural'    => 'registrations',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'id':
            case 'customer_email':
            case 'customer_id':
            case 'info':
            case 'created':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_id($item){
        
        //Build row actions
        $actions = array(
            'delete'    => sprintf('<a href="?page=%s&action=%s&registration=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );
        
        //Return the title contents
        return sprintf('<span>%1$s</span>%2$s',
            $item['id'],
            $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'id'     => 'Id',
            'customer_email'     => 'Email',
            'customer_id'    => 'customer id',
            'info'  => 'Registration information',
            'created'  => 'Created'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'id'    => array('id',true),
            'customer_email'     => array('customer_email',false),  //true means it's already sorted
            'customer_id'    => array('customer_id',false),         
            'info'  => array('info',false),
            'created'  => array('created',false)
        );
        return $sortable_columns;
    }


    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
        global $wpdb;
        //Detect when a bulk action is being triggered...
        if(isset($_REQUEST['registration'])){
            if(is_array($_REQUEST['registration'])){
                $ids = implode(',',$_REQUEST['registration']);  
            }else{
                $ids = $_REQUEST['registration'];
            }
        }        
        
        //var_dump($ids);exit();
        if( 'delete'===$this->current_action() ) {          
            $wpdb->query("DELETE FROM ovaevent_free WHERE id IN (".$ids.")");            
            esc_html_e('The Items deleted!', 'event');
        }
        
    }

    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = get_option('posts_per_page ');
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        $this->process_bulk_action();

        $data = array();
        $result = $wpdb->get_results( "SELECT * FROM ovaevent_free ORDER BY id DESC ");
        foreach($result as $r) {
            $data[] = array(
                'id'            => $r->id,
                'customer_email'        => $r->customer_email,
                'customer_id'      => $r->customer_id,
                'info'    => str_replace( '|||', '', html_entity_decode($r->info) ),
                'created'       => date(get_option('date_format'), $r->created)
            );
        }

       $sortable = $this->get_sortable_columns();
       function get_sortable_columns() {
          $sortable_columns = array(
            'id'  => array('id',false),
            'created' => array('created',false)
          );
          return $sortable_columns;
        }


        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        //usort($data, 'usort_reorder');

        
        $current_page = $this->get_pagenum();
        
        $total_items = count($data);
        
       
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
       
        $this->items = $data;
        
       
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }

}

class Register_paypal_list_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'registration',     //singular name of the listed records
            'plural'    => 'registrations',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'id':
            case 'customer_email':
            case 'total':
            case 'price':
            case 'ticket':            
            case 'currency':
            case 'customer_id':
            case 'transaction_id':            
            case 'info':
            case 'status':
            case 'created':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_id($item){
        
        //Build row actions
        $actions = array(            
            'delete'    => sprintf('<a href="?page=%s&action=%s&registration=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );
        
        //Return the title contents
        return sprintf('<span>%1$s</span>%2$s',
            $item['id'],
            $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],
            /*$2%s*/ $item['id']
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'id'            => esc_html__('ID', 'event'),
            'customer_email'=> esc_html__('Email', 'event'),
            'ticket'        => esc_html__('Ticket', 'event'),
            'price'         => esc_html__('Price','event'),
            'total'         => esc_html__('Total','event'),
            'currency'      => esc_html__('Currency','event'),
            'customer_id'   => esc_html__('Customer id','event'),
            'transaction_id'=> esc_html__('Transaction id','event'),
            'status'        => esc_html__('Status','event'),
            'info'          => esc_html__('Registration info','event'),
            'created'       => esc_html__('Created','event')
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'id'     => array('id',true),
            'customer_email'     => array('customer_email',false),     //true means it's already sorted
            'ticket'    => array('ticket',false),
            'price'  => array('price',false),
            'total'  => array('total',false),  
            'currency' => array('currency', false),
            'customer_id'  => array('customer_id',false),
            'transaction_id'  => array('transaction_id',false),            
            'status'    => array('status', false),
            'info'  => array('buyer_info',false),
            'created'  => array('created',false),
        );
        return $sortable_columns;
    }


    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
        global $wpdb;
        //Detect when a bulk action is being triggered...
        if(isset($_REQUEST['registration'])){
            if(is_array($_REQUEST['registration'])){
                $ids = implode(',',$_REQUEST['registration']);  
            }else{
                $ids = $_REQUEST['registration'];
            }
        }        
        
        //var_dump($ids);exit();
        if( 'delete'===$this->current_action() ) {
            $wpdb->query("DELETE FROM ovaevent_pay WHERE id IN (".$ids.")");            
            esc_html_e('The Items deleted!', 'event');
        }
        
    }

    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = get_option('posts_per_page ');
        
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        $this->process_bulk_action();

        $data = array();
        //$result = $wpdb->get_results( "SELECT * FROM ovaevent_pay where status = 'Completed' ORDER BY id DESC ");
        $result = $wpdb->get_results( "SELECT * FROM ovaevent_pay where status = 'Completed' ORDER BY id DESC ");
        foreach($result as $r) {
            $data[] = array(
                'id'            => $r->id,
                'customer_email'        => $r->customer_email,
                'ticket'      => $r->ticket,
                'price'     => $r->price,
                'total'     => $r->total,
                'currency'      => $r->currency,
                'customer_id'      => $r->customer_id,
                'transaction_id'      => $r->transaction_id,
                'status'      => $r->status,
                'info'    => str_replace( '|||', '', html_entity_decode($r->info) ),
                'created'       => date(get_option('date_format'), $r->created)
            );
        }

       
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
        
        $current_page = $this->get_pagenum();
        
        $total_items = count($data);
        
        
       
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
       
        $this->items = $data;
        
       
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }

}





/** ************************ REGISTER THE TEST PAGE ****************************
 *******************************************************************************
 * Now we just need to define an admin page. For this example, we'll add a top-level
 * menu item to the bottom of the admin menus.
 */
function tt_add_menu_items(){
    //add_menu_page('Example Plugin List Table', 'List Table Example', 'activate_plugins', 'tt_list_test', 'tt_render_list_page');
    add_submenu_page(
        'ovaevent_settings', 
        esc_html__( 'Free Registration List', 'event' ), 
        esc_html__( 'Free Registration List', 'event' ), 
        'manage_options', 
        'free_register', 
        'tt_render_list_page_free'
    );
    add_submenu_page(
        'ovaevent_settings',
        esc_html__( 'Paypal Registration List', 'event' ), 
        esc_html__( 'Paypal Registration List', 'event' ), 
        'manage_options', 
        'paypal_register', 
        'tt_render_list_page_paypal'
    );
} 
add_action('admin_menu', 'tt_add_menu_items');





/** *************************** RENDER TEST PAGE ********************************
 *******************************************************************************/

function tt_render_list_page_free(){
    
    //Create an instance of our package class...
    $testListTable = new Register_free_list_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    
    ?>
    <div class="wrap">        
        <div id="icon-users" class="icon32"><br/></div>
        <h2><?php _e('Free Registration List', 'event') ?></h2>

        <!-- Update in version 2.6 -->
        <div class="export_paypal">
            <form action= "<?php echo home_url('/').'wp-content/plugins/ova_event/registration/export_csv_free.php';?>" method="post">
                <div class="metabox-prefs">
                    <h3><?php esc_html_e('Choose fields that you want to export to CSV file','event'); ?> </h3>
                    
                        <label for="id"><input  name="check_list[]"  value="id"  type="checkbox"><?php esc_html_e('ID', 'event'); ?></label>
                        <label for="customer_email"><input  name="check_list[]"  value="customer_email"  type="checkbox"><?php esc_html_e('Email','event'); ?></label>
                        <label for="orderaaa"><input  name="check_list[]"  value="customer_id"  type="checkbox"><?php esc_html_e('Customer ID','event'); ?></label>
                        
                        <label for="createaa"><input  name="check_list[]"  value="created"  type="checkbox"><?php esc_html_e('Created', 'event'); ?></label><br>
                        <label for="createaa"><?php esc_html_e('Insert Key. For example: name,address','event'); ?></label><input  name="extra_field_export"  value=""  type="text" size="50"><br/>
                        <?php esc_html_e('You can find Key here:', 'event'); ?> <a href="http://demo.ovatheme.com/Documentation/wordpress/event/key_export.png" target="_blank">http://demo.ovatheme.com/Documentation/wordpress/event/key_export.png</a>
                        <br>Note syntax: your-key,your-key,your-key
                        <br class="clear">
                </div>
                <br>
            <input id="button" class="button action exportcsv" name ="submit"value="Export to CSV" type="submit" style="background-color:#555; color: #fff; border-color: #555; box-shadow: none;">
            </form>
            <br><br>
        </div>
        <!-- /Update in version 2.6 -->

        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display() ?>
        </form>
        
    </div>
    <?php
}


function tt_render_list_page_paypal(){
    
    //Create an instance of our package class...
    $testListTablepaypal = new Register_paypal_list_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTablepaypal->prepare_items();
    
    ?>
    <div class="wrap">        
        <div id="icon-users" class="icon32"><br/></div>
        <h2><?php _e('Paypal Registration List', 'event') ?></h2>


        <div class="export_paypal">
            <form action= "<?php echo home_url('/').'wp-content/plugins/ova_event/registration/export_csv_pay.php';?>" method="post">
                <div class="metabox-prefs">
                    <h3>Choose fields that you want to export to CSV file</h3>
                    
                        <label ><input  name="check_list[]"  value="id"  type="checkbox"><?php esc_html_e('ID', 'event'); ?></label>
                        <label ><input  name="check_list[]"  value="customer_email"  type="checkbox"><?php esc_html_e('Email','event'); ?></label>
                        <label ><input  name="check_list[]"  value="price"  type="checkbox"><?php esc_html_e('Price','event'); ?></label>
                        <label ><input  name="check_list[]"  value="ticket"  type="checkbox"><?php esc_html_e('Ticket','event'); ?></label>
                        <label ><input  name="check_list[]"  value="total"  type="checkbox"><?php esc_html_e('Total','event'); ?></label>
                        <label ><input  name="check_list[]"  value="currency"  type="checkbox"><?php esc_html_e('Currency','event'); ?></label>
                        <label ><input  name="check_list[]"  value="customer_id"  type="checkbox"><?php esc_html_e('Customer Id','event'); ?></label>
                        <label ><input  name="check_list[]"  value="transaction_id"  type="checkbox"><?php esc_html_e('Transactionn Id','event'); ?></label>
                        <label ><input  name="check_list[]"  value="status"  type="checkbox"><?php esc_html_e('Status','event'); ?></label>
                        <label ><input  name="check_list[]"  value="created"  type="checkbox"><?php esc_html_e('Created','event'); ?></label>
                        
                        <br>
                        <label for="createaa"><?php esc_html_e('Insert Key. For example: name,address,phone', 'event'); ?></label><input  name="extra_field_export"  value=""  type="text" size="50"><br/>
                        <?php esc_html_e('You can find Key here:', 'event'); ?> <a href="http://demo.ovatheme.com/Documentation/wordpress/event/key_export.png" target="_blank">http://demo.ovatheme.com/Documentation/wordpress/event/key_export.png</a>
                        <br>Note syntax: your-key,your-key,your-key
                        <br class="clear">

                        <br class="clear">
                </div>
            <input id="button" class="button action" name ="submit"value="Export to CSV" type="submit" style="background-color:#555; color: #fff; border-color: #555; box-shadow: none;">
            </form>
        </div>


        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTablepaypal->display() ?>
        </form>
        
    </div>
    <?php
}





