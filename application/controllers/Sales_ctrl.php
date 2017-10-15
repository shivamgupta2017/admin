<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_ctrl extends CI_Controller 
{

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
		 $template['page'] = 'Sales/view_sales';
		 $template['title'] = 'Sales Orders';

		 $join = array('{PRE}users'=>'{PRE}sales.client_id = {PRE}users.user_id,inner');
		 $template['data'] =$this->basic->get_data('{PRE}sales','','*',$join);
	//	 print_r(json_encode($template['data'])); die;				 

		 $this->load->view('template',$template);
	}
	public function add_new_sales()
	{
		$template['page'] = 'Sales/add_new_sales';
		$template['title'] = 'Sales Orders';
		$join = array('{PRE}product_price'=>'{PRE}.product_price.product_id = {PRE}products.product_id,inner');
		$where['where']=array('is_deleted'=>0);
		$template['products'] =$this->basic->get_data('{PRE}products',$where,'{PRE}products.*, {PRE}product_price.*', $join);
		$template['client'] =$this->basic->get_data('{PRE}users','','*');
		if($_POST)
		 {
		     $data = $this->basic->get_post_data();

		     $data1= array_slice($data,2);
			 $temp_data['client_id'] = $data['vendor_id'];
			 $temp_data['payment_type'] = $data['payment_method'];
			 $temp_data['date'] = date('Y-m-d');
			 $sales_id = $this->basic->insert_data_id('{PRE}sales',$temp_data);
			 $temp_data = array();
			 $sales_id2=$sales_id;
		     $temp_data2['receivable_amount'] = 0;
		     for($i = 1; $i < $data['option_counts'];++$i)
		     {
		         $temp_data['sales_id'] = $sales_id;
		         $temp_data['product_id'] = $data['item_id'.$i];
		         $temp_data['sales_price'] = $data['cost'.$i];
		         $temp_data['quantity'] = $data['quantity'.$i];
		         $temp_data['tax'] = $data['tax'.$i];
 			     $temp_data['date'] =date('Y-m-d');
		         $this->basic->insert_data('{PRE}sales_details',$temp_data);
		         $temp_data2['receivable_amount'] = $temp_data2['receivable_amount'] + ($temp_data['sales_price'] * $temp_data['quantity']);
		     	 $inventory_data=array();
			     $inventory_data['type']='out';
			     $inventory_data['date']=date('Y-m-d');
			     $inventory_data['sales_price'] = $temp_data['sales_price'];
			     $inventory_data['quantity'] =$temp_data['quantity'];
			     $inventory_data['total_sales'] =$temp_data['quantity']*$temp_data['sales_price'];
			     $where['where'] =array('product_id'=>$temp_data['product_id']);
			     $cp=$this->basic->get_data('{PRE}product_price', $where, 'purchase_price');
			     $inventory_data['cost_price']=$cp[0]->purchase_price;
			     $inventory_data['total_cost']=$inventory_data['cost_price']*$inventory_data['quantity'];	
			     $inventory_data['sales_id']= $sales_id;
			     $inventory_data['product_id']=$temp_data['product_id'];
			     $this->basic->insert_data('{PRE}inventory',$inventory_data);

		     }
		     if($data['payment_method']==0)
		     {
		     	$this->basic->update_data('{PRE}sales',array('sales_id'=>$sales_id),$temp_data2);
		     }
		     else
		     {
		     	$update_sales=array();
		     	$update_sales['received_amount']=$temp_data2['receivable_amount'];
		     	$update_sales['receivable_amount']=$temp_data2['receivable_amount'];
		     	$this->basic->update_data('{PRE}sales',array('sales_id'=>$sales_id2),$update_sales);
		     	$receiving_data=array();
		     	$receiving_data['date']= date('Y-m-d');
		     	$receiving_data['method']= 'cash';
		     	$receiving_data['client_id']= $data['vendor_id'];
		     	$receiving_data['received']= $temp_data2['receivable_amount'];
		     	$this->basic->insert_data('{PRE}receiving',$receiving_data);
		     }
		     /*$inventory_data=array();
		     $inventory_data['type']=1;
		     $inventory_data['sales_id']= $sales_id;
		     $this->basic->insert_data('{PRE}inventory',$inventory_data);*/

		     $customer_log_data=array();
		     $customer_log_data['customer_id']= $data['vendor_id'];
		     $customer_log_data['date']= date('Y-m-d');
		     if($data['payment_method']==0)
		     {
		     	$customer_log_data['receivable']=$temp_data2['receivable_amount'];

		     }
		     else
		     {
		     	$customer_log_data['receivable']=$receiving_data['received'];
		     	$customer_log_data['received']=$receiving_data['received'];
		     }
		     $this->basic->insert_data('{PRE}customer_log', $customer_log_data);
		     $this->session->set_flashdata('message', array('message'=>"Added Succussfully",'class' => 'success'));
		  		redirect('Sales_ctrl/', 'refresh');
		 }
		 $this->load->view('template',$template);
	}
	public function add_vendor_popup(){
	    $this->load->view('Purchase/add_vendor_popup');
	}
	public function add_vendor()
	{
		     $data = $this->basic->get_post_data();
		     $data['vendor_id'] = $this->basic->insert_data_id('{PRE}sales',$data);
		     print_r(json_encode($data));
	}
	public function view_receiving()
	{
			$template['page'] = 'Sales/view_receiving';
			$template['title'] = 'View Receiving';
			$join = array('{PRE}users'=>'{PRE}receiving.client_id = {PRE}users.user_id,inner');
			$template['data']=$this->basic->get_data('{PRE}receiving', '', '{PRE}users.client_name, {PRE}receiving.*', $join);
			$this->load->view('template',$template);
	}
	public function add_new_receiving()
	{
		$template['page'] = 'Sales/add_received';
		$template['title'] = 'Add Receiving';
		$template['client']= $this->basic->get_data('{PRE}users', '', 'user_id,client_name, business_title');
		if($_POST)
		{
		    $data = $this->basic->get_post_data();
		    $data['date']=date('Y-m-d');
		    $data['method']='cash';
		    $data['receivable_amount_f']=-1;
		    $insert_id = $this->basic->insert_data_id('{PRE}receiving',$data);
		    $customer_log_data=array();
		    $customer_log_data['customer_id'] = $data['client_id'];
		    $customer_log_data['date'] = $data['date'];
		    $customer_log_data['received'] = $data['received'];
		    $insert_id = $this->basic->insert_data_id('{PRE}customer_log',$customer_log_data);

		    $this->session->set_flashdata('message', array('message'=>"Added Succussfully",'class' => 'success'));
		  		redirect('Sales_ctrl/', 'refresh');
		}

		$this->load->view('template', $template);
	}
	public function dhak_dhak_go()
	{

		$res=$this->input->post('id');
		$where['where']=array('user_id'=>$res);
		$template['shipping_details'] = $this->basic->get_data('{PRE}users', $where, '*');
		$where1=array('client_id' => $res);
		$template['total'] = $this->basic->get_sum_of_sales('{PRE}sales', $where1, 'receivable_amount');// - $this->basic->get_sum('{PRE}sales', $where);
		$where2=array('client_id' => $res);
		$template['received'] = $this->basic->get_sum_of_sales('{PRE}receiving', $where2, 'received');
		print_r(json_encode($template));
	}
	public function view_invoice($sales_id, $user_id, $payment_type)
	{

		//print_r($payment_type); die;
		$where['where']=array('user_id'=>$user_id);
		$template['shipping_details'] = $this->basic->get_data('{PRE}users', $where, '*');
		$template['invoice_id'] = 123;
		/*$join = array('{PRE}sales_details'=>'{PRE}sales.sales_id = {PRE}sales_details.sales_id,inner', '{PRE}sales_details'=>'{PRE}sales_details.product_id = {PRE}products.sales_id,inner');*/
		$template['products']= $this->basic->multiple_join_get_data($sales_id, $user_id);
		$template['logo'] = $this->Settings_model->settings_viewings();
		$template['payment_type']=$payment_type;

		$where1=array('client_id' => $user_id);
		$total = $this->basic->get_sum_of_sales('{PRE}sales', $where1, 'receivable_amount');// - $this->basic->get_sum('{PRE}sales', $where);
		$where2=array('client_id' => $user_id);
		$received = $this->basic->get_sum_of_sales('{PRE}receiving', $where2, 'received');
		$template['net_balance']=$total[0]->receivable_amount-$received[0]->received;
		$this->load->view('Pdf/subs',$template);
	}
}
?>
