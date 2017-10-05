<?php 

class Dashboard_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	function get_shops_count() {
		
		$menu = $this->session->userdata('admin');
		if($menu!='1'){
			$user = $this->session->userdata('id');
			$this->db->where('{PRE}shop_details.created_user', $user);
		}
		$result = $this->db->count_all_results('{PRE}shop_details');
		return $result;
	}
	
	function get_users_count() {
		$result = $this->db->count_all_results('{PRE}users');
		return $result;
	}
	
	function get_customers_count() {
		$result = $this->db->count_all_results('{PRE}saloon_users');
		return $result;
	}
	
	function get_bookings_count() {
		
		$this->db->join('{PRE}shop_details as sd', 'bh.shop_id = sd.id','left');
		$menu = $this->session->userdata('admin');
		if($menu!='1'){
			$user = $this->session->userdata('id');
			$this->db->where('sd.created_user', $user);
		}
		
		$result = $this->db->count_all_results('{PRE}booking_history as bh');
		return $result;
	}
	function get_orders(){
	    // return $this->db->join('customer_registration','orders.cust_id = customer_registration.id')->order_by('orders.id','desc')->limit(5)->get('orders')->result();
	}
// 	function get_subscriptions(){
// 	    return $this->db->join('customer_registration','cust_subscription.cust_id = customer_registration.id')->order_by('cust_subscription.id','desc')->limit(5)->get('cust_subscription')->result();
// 	}
	function get_totals()
	{
	    $data['orders'] = $this->db->count_all_results('{PRE}sales');
	    $this->db->where(array('is_deleted'=>0)); 
	    $data['products'] = $this->db->count_all_results('{PRE}products');
	    $data['customers'] = $this->db->count_all_results('{PRE}users');
	  	$data['vendors'] = $this->db->count_all_results('{PRE}vendor');
	    return $data;
	}
}