<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class reports_ctrl extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('Settings_model');

		$this->load->model('basic');
			if(!$this->session->userdata('logged_in_adminw1')) { 
			redirect(base_url());
		}
	}
	
	public function index()
	{

		 $template['page'] = 'Reports/show_report_type';
		 $template['title'] = 'Reports';
		 $template['client'] = $this->basic->get_data('{PRE}users', '', '{PRE}users.user_id, {PRE}users.client_name'); 
		 $this->load->view('template',$template);

	}
	public function select_client_for_ledger()
	{	
		    $data = $this->basic->get_post_data();
		    $where['where']=array('user_id'=>$data['id']);
		    $template['shipping_details'] = $this->basic->get_data('{PRE}users', $where, '*');
		    $where2['where']=array('customer_id'=>$data['id']);
		    $template['data'] = $this->basic->get_data('{PRE}customer_log', $where2, '*');
		    //$this->basic->get_two_table_data($data['id']);


		    $where1=array('client_id' => $data['id']);
			$template['total'] = $this->basic->get_sum_of_sales('{PRE}sales', $where1, 'receivable_amount');// - $this->basic->get_sum('{PRE}sales', $where);
			$where2=array('client_id' => $data['id']);
			$template['received'] = $this->basic->get_sum_of_sales('{PRE}receiving', $where2, 'received');
			 print_r(json_encode($template)); 		     
		    // $where2['where']=array('{PRE}sales.client_id'=>$data['id'], '{PRE}ree.client_id'=>$data['id']);
			 //$template['data'] = $this->basic->get_data('{PRE}sales', $where2, '{PRE}sales.*');
		     //print_r(json_encode($template['data'])); 
	}
	public function select_vendor_for_ledger()
	{
		$data = $this->basic->get_post_data();
		$where['where']=array('vendor_id'=>$data['id']);
		$template['shipping_details'] = $this->basic->get_data('{PRE}vendor', $where, '*');
		$this->basic->get_data('{PRE}purchase', $where, 'date, payable_amount, paid_amount');
		$query1=$this->db->last_query();


		$where2['where']=array('vendor_id'=>$data['id']);
		$this->basic->get_data('{PRE}paid', $where2, 'date, payable_f as payable_amount, paid_amount');
		$query2=$this->db->last_query();
		$template['data']=$this->db->query($query1." UNION ".$query2)->result();
		$template['payable']=$this->basic->get_sum_of_sales('{PRE}purchase', $where['where'], 'payable_amount');
		$template['paid']=$this->basic->get_sum_of_sales('{PRE}paid', $where['where'], 'paid_amount');
		
		print(json_encode($template));
	}
	public function customer_balance_summary()
	{
		$template['page']='Reports/report_details_customer_balance';
		$template['title']='Balance Summary';
		$template['data']=$this->basic->get_sum_of_rows_in_customer_balance();
		 $this->load->view('template',$template);

	}
	public function customer_ledger_summary()
	{

		$template['page']='Reports/show_customer_individual_ledger';
		$template['title']='Balance Summary';
		$template['client']= $this->basic->get_data('{PRE}users', '', 'user_id, client_name');
		$this->load->view('template', $template);


	}
	public function vendor_balance_summary()
	{

		$template['page']= 'Reports/show_vendor_balance';
		$template['title']='Balance Summary';
		$template['data']=$this->basic->get_sum_of_rows_in_vendor_details();
		//print_r(json_encode($template)); die;
		$this->load->view('template', $template);
	}
	public function vendor_ledger_summary()
	{
		$template['page']='Reports/show_vendors_individual_ledger';
		$template['title']='Balance Summary';
		$template['vendor']= $this->basic->get_data('{PRE}vendor', '', 'vendor_id, vendor_name');
		$this->load->view('template', $template);
	}
	public function profit()
	{

		try 
		{
			$template['page']	='Reports/profit';
			$template['title']='Profit';
			$this->load->view('template', $template);
		} 
		catch (Exception $e) 
		{
		    $this->load->library('definitely_exists', 'alias');
		}
	}
	public function date_selected()
	{
		$data = $this->basic->get_post_data();
		$newDate1 = date("Y-m-d", strtotime($data['date1']));
		$newDate2 = date("Y-m-d", strtotime($data['date2']));
		$template['data']= $this->basic->get_profit_loss($newDate1, $newDate2);
		print_r(json_encode($template)); 
	}
}
?>