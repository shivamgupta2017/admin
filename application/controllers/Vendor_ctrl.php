	<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Vendor_ctrl extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('basic');
		
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

	public function index()
	{
	 	$template['data']=$this->basic->get_data('{PRE}vendor', '', '*');
		$template['page_title'] = "Vendors";
		$template['page'] = "vendors/view_vendors";
		$this->load->view('template', $template);

	}
	public function view_vendors()
	{
		$template['data']=$this->basic->get_data('{PRE}vendor', '', '*');
		$template['page_title'] = "Vendors";
		$template['page'] = "vendors/view_vendors";
		$this->load->view('template', $template);
	}
	public function create_vendor()
	{


		  $template['page'] = 'vendors/create_vendor';
		  $template['title'] = 'Create Vendor';
		  $this->load->view('template',$template);
		  


		  if($_POST)
		  {

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[{PRE}users'.'.email]');
		  if ($this->form_validation->run() == TRUE)
		  {

		  		$data = $this->basic->get_post_data();
		  		$result = $this->basic->insert_data_id('{PRE}vendor',$data);
		  		$temp['user_id'] = $result;

		  		if($result!=0)
		  		{
		  			$this->session->set_flashdata('message', array('message'=>"Customer Created Successfully",'class' => 'success'));
			  		redirect('Vendor_ctrl', 'refresh');
		  		}
		  		else
		  		{
		  			$this->session->set_flashdata('message', array('message'=>validation_errors(),'class' => 'danger'));
			  		redirect('Vendor_ctrl/create_vendor', 'refresh');
		  		}
		      
		  	}
		  	else
		  	{
		  		$this->session->set_flashdata('message', array('message'=>validation_errors(),'class' => 'danger'));
		  		redirect('Vendor_ctrl/create_vendor', 'refresh');
		  	}
		  }



	}

}
