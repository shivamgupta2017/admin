<?php
function set_upload_profilepic($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}

function set_upload_userprofilepic($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}


function set_upload_logo($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}




function set_upload_shoperfilepic($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}



function set_upload_edituser($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}



function set_upload_agent($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}

function set_upload_favicono($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}


function set_upload_optionscategory($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}
function set_upload_optionscategory1($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}
function set_upload_options_subcategory($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}

function set_upload_options_product($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}

function set_upload_user($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}

function set_upload_editagent($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}

function set_upload_profile($path) {   
	//upload an image options
	$config = array();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']      = '0';
	$config['overwrite']     = FALSE;

	return $config;
}





/* User Capabilities */
function user_capabilities() {

	$capabilities = array(
						"shopper"		         => "Shopper Details",

                        "store_products"		 => "Store Products Details",
						
						"customer"   		     => "Customer Details",
						
                        "city"			         => "City",
						
						"store_user"   	         => "Store User Details",
						
						"order"      	         => "Order Details",				
						
						"category"               => "Category Details",
						
						"sub_category"           => "Sub Category",
						
						"product"                => "product Details",						
						
						"promocode"              => "Promocodes Details",
						
						"settings"              => "Settind Details",

					);

	return $capabilities;

}

/* User Capabilities - Pages */
function user_page_capabilities() {

	$capability_pages= array(

							"Shopper_ctrl-view_shopper_details"            	          => "shopper",
							"Shopper_ctrl-send_mail"                                  => "shopper",
							"Shopper_ctrl-shopper_active"                             => "shopper",
							"Shopper_ctrl-delete_shopper"                             => "shopper",
							

                            "Shopper_ctrl-view_store_products"           	          => "store_products",
							"Shopper_ctrl-add_store_products"                         => "store_products",
						    "Shopper_ctrl-store_product_update"                       => "store_products",
							"Shopper_ctrl-delete_store_product"                       => "store_products",
							
							
							"Customer_ctrl/view_customer_details"                     => "customer",
							"Customer_ctrl/view_customerpopup"                        => "customer",
							"Customer_ctrl/delete_customer"                           => "customer",
							
							"Store_ctrl/view_city"                                    => "city",
							"Store_ctrl-citydetails_view"                             => "city",
							"Store_ctrl/add_city"                                     => "city",
							"Store_ctrl/edit_city"                                    => "city",
							"Store_ctrl/delete_city"                                  => "city",

                            "User_ctrl/view_user_details"                             => "store_user",
                            "User_ctrl/add_user_details"                              => "store_user",
                            "User_ctrl/view_userpopup"                                => "store_user",
                            "User_ctrl/edit_user_details"                             => "store_user",
                            "User_ctrl/user_delete"                                   => "store_user",
							
							
							
							
                            "Customer_ctrl/view_order_details"                        => "order",
                            "Customer_ctrl/view_orderpopup"                           => "order",
                            "Customer_ctrl/delete_order"                              => "order",
							
							
                            "Home_ctrl/view_category"       	                      => "category",
                            "Home_ctrl/add_category"       	                          => "category",
                            "Home_ctrl/edit_cat"       	                              => "category",
                            "Home_ctrl/catdetails_view"       	                      => "category",
                            "Home_ctrl/delete_cat"       	                          => "category",
							
							"Home_ctrl/view_subcategory"       	                      => "sub_category",
                            "Home_ctrl/add_sub_category"       	                      => "sub_category",
                            "Home_ctrl/edit_subcat"       	                          => "sub_category",
                            "Home_ctrl/delete_subcat"       	                      => "sub_category",
							
							
							
                            "Home_ctrl/view_product"                                  => "product",
                            "Home_ctrl/add_products"                                  => "product",
                            "Home_ctrl/edit_pro"                                      => "product",
                            "Home_ctrl/prodetails_view"                               => "product",
                            "Home_ctrl/delete_pro"                                    => "product",
							
							
							"Promocode_ctrl/view_promocode"                           => "promocode",
							"Promocode_ctrl/add_promocode"                            => "promocode",
                            "Promocode_ctrl/edit_promocode"                           => "promocode",
                            "Promocode_ctrl/promodetails_view"                        => "promocode",
                            "Promocode_ctrl/delete_promocode"                         => "promocode",
							
                            "Settings_ctrl/view_settings"                             => "settings",
                         
						);

	return $capability_pages;
}

/* User menu */
function user_menu() {

	$mainmenu = array(

		array(
			"slug" => "Dashboard",
			"name" => "Dashboard",
			"url" => "Dashboard_ctrl",
			"icon" => "fa fa-dashboard",
			"submenu" => false,
			"super_admin" => true,
			"capabilities" => array("basic_cap")
		),
			/*array(
			"slug" => "Payments",
			"name" => "Payments",
			"url" => "Payment_ctrl",
			"icon" => "fa fa-inr",
			"submenu" => false,
			"super_admin" => true,
			"capabilities" => array("billing"),
// 			"submenu_items" => '[
								
// 									{"name":"Generate Bills","cap":"store_products","url":"Service/billing/schedular"},
// 									{"name":"View Bills","cap":"store_products","url":"Customer_ctrl/view_bills"}
									
// 								]'
			
		),*/
			array(
            "slug" => "Customers",
            "name" => "Customer",
            "url" => "Customer_ctrl",
            "icon" => "fa fa-user",
            "submenu" => true,
			"super_admin" => true,
			"capabilities" => array("package"),
            "submenu_items" => '[
								
									{"name":"Add Customers","cap":"store_products","url":"Customer_ctrl/create_customer"}
									,
									{"name":"View Customers","cap":"store_products","url":"Customer_ctrl"}
									
								]'
        ),



         /*array(
            "slug" => "Order",
            "name" => "Order",
            "url" => "Order_ctrl",
            "icon" => "fa fa-shopping-cart",
            "submenu" => true,
			"super_admin" => true,
            "capabilities" => array("order"),
            "submenu_items" => '[
                                    {"name":"Orders","cap":"category","url":"Order_ctrl/"},
									{"name":"Update Order","cap":"category","url":"Order_ctrl/view_update_requests"},
									{"name":"Order Verification","cap":"category","url":"Order_ctrl/admin_verification"}
								]'
        ),*/


        



        /*array(
            "slug" => "Concerns",
            "name" => "Concerns",
            "url" => "Concern_ctrl",
            "icon" => "fa fa-feed",
            "submenu" => false,
			"super_admin" => true,
            "capabilities" => array("order")
        ),*/
//          array(
//             "slug" => "Update Orders",
//             "name" => "Update Orders",
//             "url" => "Order_ctrl/view_update_requests",
//             "icon" => "fa fa-shopping-cart",
//             "submenu" => false,
// 			"super_admin" => true,
//             "capabilities" => array("order")
//         ),
         array(
            "slug" => "Purchase Order",
            "name" => "Purchase Order",
            "url" => "Purchase_ctrl/",
            "icon" => "fa fa-shopping-cart",
            "submenu" => true,
			"super_admin" => true,
            "capabilities" => array("order"),
            "submenu_items" => '[
                                    
									{"name":"Purchase History","cap":"category","url":"Purchase_ctrl"},
									{"name":"Add New Purchase","cap":"category","url":"Purchase_ctrl/add_new_purchase_order"},
									{"name":"Payments","cap":"category","url":"Purchase_ctrl/paid_payment"},
									{"name":"Add Payments","cap":"category","url":"Purchase_ctrl/add_new_payment"}


								]'
        ),
         array(
            "slug" => "Sales Order",
            "name" => "Sales Order",
            "url" => "Sales_ctrl/",
            "icon" => "fa fa-shopping-cart",
            "submenu" => true,
			"super_admin" => true,
            "capabilities" => array("order"),
            "submenu_items" => '[
                                    
									{"name":"Sales History","cap":"category","url":"Sales_ctrl/"},
									{"name":"Add New Sales","cap":"category","url":"Sales_ctrl/add_new_sales"},
									{"name":"Payment Received","cap":"category","url":"Sales_ctrl/view_receiving"},
									{"name":"Receive Payment","cap":"category","url":"Sales_ctrl/add_new_receiving"}


								]'
        ),
//           array(
//             "slug" => "Verify Orders",
//             "name" => "Verify Orders",
//             "url" => "Order_ctrl/admin_verification",
//             "icon" => "fa fa-shopping-cart",
//             "submenu" => false,
// 			"super_admin" => true,
//             "capabilities" => array("order")
//         ),
        /*array(
            "slug" => "Notification",
            "name" => "Notification",
            "url" => "Notification/create_notification",
            "icon" => "fa fa-bell",
            "submenu" => false,
			"super_admin" => true,
            "capabilities" => array("order")
        ),*/
         /*array(
            "slug" => "Invoice",
            "name" => "Invoice",
            "url" => "Invoice/view_invoice",
            "icon" => "fa fa-book",
            "submenu" => false,
			"super_admin" => true,
            "capabilities" => array("create_invoice")
        ),*/

          array(
            "slug" => "Vendors",
            "name" => "Vendors",
            "url" => "Vendor_ctrl/view_vendors",
            "icon" => "fa fa-book",
            "submenu" => true,
			"super_admin" => true,
            "capabilities" => array("create_invoice"),
            "submenu_items" => '[
                                    
									{"name":"Vendors","cap":"category","url":"Vendor_ctrl/view_vendors"},
									
									{"name":"Add Vendor","cap":"category","url":"Vendor_ctrl/create_vendor"}


								]'
        ),


// 		array(
// 			"slug" => "Category",
// 			"name" => "Categocry",
// 			"url" => "#",
// 			"icon" => "fa fa-caret-square-o-left",
// 			"submenu" => true,
// 			"super_admin" => true,
// 			"capabilities" => array("category"),
// 			"submenu_items" => '[
// 									{"name":"View Category","cap":"category","url":"Home_ctrl/view_category"},
// 									{"name":"Add  Category","cap":"category","url":"Home_ctrl/add_category"}
// 								]'
// 		),
		
// 		array(
// 			"slug" => "Sub Category",
// 			"name" => "Sub Category",
// 			"url" => "#",
// 			"icon" => "fa fa-bars",
// 			"submenu" => true,
// 			"super_admin" => true,
// 			"capabilities" => array("sub_category"),
// 			"submenu_items" => '[
// 									{"name":"View SubCategory","cap":"sub_category","url":"Home_ctrl/view_subcategory"},
// 									{"name":"Add SubCategory","cap":"sub_category","url":"Home_ctrl/add_sub_category"}
// 								]'
// 		),

		array(
			"slug" => "Products",
			"name" => "Products",
			"url" => "Product_ctrl/view_product",
			"icon" => "fa fa-fw fa-list",
			"submenu" => true,
			"super_admin" => true,
			"capabilities" => array("product"),
			"submenu_items" => '[
			 						{"name":"View Product","cap":"product","url":"Product_ctrl/view_product"},
			 						{"name":"Add Product","cap":"product","url":"Product_ctrl/add_products"}
			 					]'
		),
// 		array(
//             "slug" => "Shopper",
//             "name" => "Shopper",
//             "url" => "Shopper_ctrl/view_shopper_details",
//             "icon" => "fa fa-users",
//             "submenu" => false,
// 			"super_admin" => true,
//             "capabilities" => array("shopper")
//         ),
		
		
// 		array(
// 			"slug" => "Store Products",
// 			"name" => "Store Products",
// 			"url" => "#",
// 			"icon" => "fa fa-desktop",
// 			"submenu" => true,
// 			"super_admin" => true,
// 			"capabilities" => array("store_products"),
// 			"submenu_items" => '[
// 									{"name":"View Store Products","cap":"store_products","url":"Shopper_ctrl/view_store_products"},
// 									{"name":"Add Store Products","cap":"store_products","url":"Shopper_ctrl/add_store_products"}
									
// 								]'
// 		),
		
		
		// array(
		// 	"slug" => "Package",
		// 	"name" => "Package",
		// 	"url" => "#",
		// 	"icon" => "fa fa-reorder",
		// 	"submenu" => true,
		// 	"super_admin" => true,
		// 	"capabilities" => array("package"),
		// 	"submenu_items" => '[
		// 							{"name":"Add New Package","cap":"add_new_package","url":"Package_ctrl"},
		// 							{"name":"Add Package Sizes","cap":"store_products","url":"Package_ctrl/add_package_size"},
		// 							{"name":"View Packages","cap":"store_products","url":"Package_ctrl/view_packages/view"},
		// 							{"name":"Add Daily Products","cap":"store_products","url":"Package_ctrl/add_daily_products"}
									
		// 						]'
			
		// ),
// 			array(
// 			"slug" => "Next Day Needs",
// 			"name" => "Next Day Needs",
// 			"url" => "#",
// 			"icon" => "fa fa-calendar-o",
// 			"submenu" => true,
// 			"super_admin" => true,
// 			"capabilities" => array("package"),
// 			"submenu_items" => '[
								
// 									{"name":"For Packages","cap":"store_products","url":"Package_ctrl/view_daily_needs/package"},
// 									{"name":"For Single Subscriptions","cap":"store_products","url":"Package_ctrl/view_daily_needs/subscription"},
// 									{"name":"For Orders","cap":"store_products","url":"Package_ctrl/view_daily_needs/orders"}
									
// 								]'
			
// 		),
		
	

		// array(
		// 	"slug" => "City",
		// 	"name" => "City",
		// 	"url" => "#",
		// 	"icon" => "fa fa-map-marker",
		// 	"submenu" => true,
		// 	"super_admin" => true,
		// 	"capabilities" => array("city"),
		// 	"submenu_items" => '[
		// 									{"name":"View City","cap":"city","url":"Store_ctrl/view_city"},
		// 									{"name":"Add City","cap":"city","url":"Store_ctrl/add_city"}
		// 									]'
		// ),
		
		// array(
		// 	"slug" => "Super Users",
		// 	"name" => "Super Users",
		// 	"url" => "#",
		// 	"icon" => "fa fa-user",
		// 	"submenu" => true,
		// 	"super_admin" => true,
		// 	"capabilities" => array("City"),
		// 	"submenu_items" => '[
		// 									{"name":"View Super User","cap":"store_user","url":"User_ctrl/view_user_details"},
		// 									{"name":"Add Super User","cap":"store_user","url":"User_ctrl/add_user_details"}
		// 									]'
		// ),
		
// 		array(
// 			"slug" => "Verification",
// 			"name" => "Verification",
// 			"url" => "Customer_ctrl/get_verification",
// 			"icon" => "fa fa-user",
// 			"submenu" => false,
// 			"super_admin" => true,
// 			"capabilities" => array("City"),
// 			"submenu_items" => '[
									
// 											]'
// 		),
       
		
		
		// array(
		// 	"slug" => "Promocodes",
		// 	"name" => "Promocodes",
		// 	"url" => "#",
		// 	"icon" => "fa fa-product-hunt",
		// 	"submenu" => true,
		// 	"super_admin" => true,
		// 	"capabilities" => array("promocode"),
		// 	"submenu_items" => '[
		// 							{"name":"View Promocode","cap":"promocode","url":"Promocode_ctrl/view_promocode"},
		// 							{"name":"Add Promocode","cap":"promocode","url":"Promocode_ctrl/add_promocode"}
		// 						]'
		// ),
		
		
		array(
            "slug" => "Reports",
            "name" => "Reports",
            "url" => "reports_ctrl",
            "icon" => "fa fa-info",
            "submenu" => true,
			"super_admin" => true,
            "capabilities" => array("settings"),
        	"submenu_items" => '[
		 							{"name":"Customer Balance Summary","cap":"promocode","url":"reports_ctrl/customer_balance_summary"},
		 							{"name":"Customer Balance Ledger","cap":"promocode","url":"reports_ctrl/customer_ledger_summary"},
		 							{"name":"Vendor Balance Summary","cap":"promocode","url":"reports_ctrl/vendor_balance_summary"},
		 							{"name":"Vendor Balance Ledger","cap":"promocode","url":"reports_ctrl/vendor_ledger_summary"},
		 							{"name":"Profit/Loss","cap":"promocode","url":"reports_ctrl/profit"}
		 						]'
		    
        ),

		array(
            "slug" => "Settings",
            "name" => "Settings",
            "url" => "Settings_ctrl/view_settings",
            "icon" => "fa fa-wrench",
            "submenu" => false,
			"super_admin" => true,
            "capabilities" => array("settings")
        ),
		
// 		array(
//             "slug" => "Test Invoice",
//             "name" => "Test Invoice",
//             "url" => "Test_ctrl/test",
//             "icon" => "fa fa-wrench",
//             "submenu" => false,
// 			"super_admin" => true,
//             "capabilities" => array("settings")
//         ),
        
	);
	return $mainmenu;

}


/* Get role capabilities */
function get_capabilities($role_id) {
	if($role_id != 1) {
		$CI = & get_instance();
		$CI->db->where('id', 1);
		$CI->db->where("status",1);
		$query = $CI->db->get('roles');
		$roles = $query->row();
		//$roles = $CI->settings_model->get_single_role($role_id);
		$user_roles = explode(",", $roles->role_pages);
		return $user_roles;
	}
}


/* Check the page is accessible */
function can_access_page() {
	$CI = & get_instance();

	if($CI->session->userdata('admin') == 1) {
		return true;
	}
	else {
	$exclude_pages = array("dashboard-index", "profile-index", 'leads-view_single_lead');
	$user_caps = array();
	$all_caps = user_page_capabilities();

	$controller_name = $CI->uri->segment(1);

	$method_name = $CI->uri->segment(2);

	if(!$method_name) {
		$method_name = "index";
	}
	$page = $controller_name."-".$method_name;
	if(in_array($page, $exclude_pages)) {
		return true;
	}
	else {
		$current_page_cap = $all_caps[$page];

		$role = $CI->session->userdata('admin');
		$user_caps = get_capabilities($role);
		if($user_caps) {
			if(in_array($current_page_cap, $user_caps)) {
				return true;
			}
			else {
				return false;
			}
		}
	}
	//exit;
	}
}


function store_info($store_id){
	$ci = & get_instance();
	$rs = $ci->db->where('id',$store_id)->get('shopper')->row();
	return $rs->store_name;
}

function get_customer($id){
		$ci = & get_instance();
		$rs = $ci->db->where('id',$id)->get('customer_registration')->row();
		return $rs->first_name.' '.$rs->last_name;
	}

	function getSettings(){

		$ci = & get_instance();
		$ci->db->where('id',1);
		$s = $ci->db->get('settings');
		$s = $s->row();
		return $s;
	}















function remove_html(&$item, $key)
{
    $item = strip_tags($item);
}
?>	
