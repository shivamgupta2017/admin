	<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard_ctrl extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		
		$this->load->model('dashboard_model');
		
		if(!$this->session->userdata('logged_in_adminw1')) 
		{
			redirect(base_url());
			
		}
 	}
	
	
	public function dashboard() 
	{
		/*$template['page'] = 'dashboard';
		$template['page_title'] = "Dashboard";
		//$template['shops'] = $this->dashboard_model->get_shops_count();
		//$template['users'] = $this->dashboard_model->get_users_count();
		//$template['customers'] = $this->dashboard_model->get_customers_count();
		//$template['bookings'] = $this->dashboard_model->get_bookings_count();
		$this->load->view('template',$template);*/
		redirect(base_url('Dashboard_ctrl'));
	}

	public function index(){
	  
		 $template['orders'] = $this->dashboard_model->get_orders();
		//$template['subscriptions'] = $this->dashboard_model->get_subscriptions();
				
			
		$template['totals'] = $this->dashboard_model->get_totals();
		$template['page'] = 'dashboard';
		$template['page_title'] = "Dashboard";		
//		{"orders":9,"products":2,"customers":2,"vendors":1}
		//print_r(json_encode($template)); die;
		$this->load->view('template',$template);
		
	}
	
	
}
