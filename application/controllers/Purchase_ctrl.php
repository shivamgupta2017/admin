<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_ctrl extends CI_Controller {

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

		 $template['page'] = 'Purchase/view_purchase';
		 $template['title'] = 'Purchase Orders';
		 $join = array('{PRE}vendor'=>'{PRE}purchase.vendor_id = {PRE}vendor.vendor_id,inner');
		 $template['data'] =$this->basic->get_data('{PRE}purchase','','*',$join);
		 //print_r(json_encode($template)); die;

		 $this->load->view('template',$template);
	}
	public function add_new_purchase_order()
	{
	     $template['page'] = 'Purchase/add_new_purchase';
		 $template['title'] = 'Purchase Orders';
		 $template['products'] =$this->basic->get_data('{PRE}products','','*');
		 $template['vendor'] =$this->basic->get_data('{PRE}vendor','','*');
		 

		/*$hashSequence = 'gtKFFx|shivamguptatesting12345678|10.0|oxygenconcentrator|shivam|shivamgupta1430@gmail.com|||||||||||eCwWELxi';
		$hash=strtolower(hash('sha512', $hashSequence));

		 print_r($hash); die;*/

		 if($_POST)
		 {
		 	 $temp_data2['payable_amount'] = 0;
		     $data = $this->basic->get_post_data();
		     $data1= array_slice($data,2);
			 $temp_data['vendor_id'] = $data['vendor_id'];
			 $temp_data['date'] = date('Y-m-d');
			 $temp_data['payment_status'] = $data['payment_method'];
			 $temp_data['purchase_status'] = $data['purchase_status'];
			 $purchase_id = $this->basic->insert_data_id('{PRE}purchase',$temp_data);

			$temp_data3=$temp_data;
			$temp_data = array();
			$temp_data3['payable_amount']=0;
		     for($i = 1; $i < $data['option_counts'];++$i)
		     {
		       	$temp_data['purchase_id'] = $purchase_id;
		        $temp_data['product_id'] = $data['item_id'.$i];
		        $temp_data['cost'] = $data['cost'.$i];
		        $temp_data['selling_price']= $data['selling_price'.$i];
		        $temp_data['quantity'] = $data['quantity'.$i];
		       	$temp_data3['payable_amount'] =$temp_data3['payable_amount'] + ($temp_data['quantity']*$temp_data['cost']);
		        $this->basic->insert_data('{PRE}purchase_details',$temp_data);
		        $cost_price_data['product_id']	= $temp_data['product_id'];
		        $cost_price_data['selling_price'] =	$temp_data['selling_price'];
		        $cost_price_data['purchase_price'] =	$temp_data['cost'];
		        $this->basic->set_update_cost_and_selling_price('{PRE}product_price',$cost_price_data);
		        
		        if($data['purchase_status']!='pending')
		        {
		        	$inventory_data=array();
				    $inventory_data['type']='in';
				    $inventory_data['date']	=date('Y-m-d');
				    $inventory_data['purchase_id']= $temp_data['purchase_id'];
				    $inventory_data['quantity']=$temp_data['quantity'];
				    $inventory_data['cost_price']	=$temp_data['cost'];
				    $inventory_data['sales_price'] =$temp_data['selling_price'];
				    $inventory_data['total_cost']	=$inventory_data['quantity']*$inventory_data['cost_price'];
				    $inventory_data['total_sales'] =$inventory_data['quantity']*$inventory_data['sales_price'];
				   	$inventory_data['product_id'] =$temp_data['product_id'];
				   	$inventory_data['purchase_status'] =$data['purchase_status'];
				    $this->basic->insert_data('{PRE}inventory',$inventory_data);

		        }
		        
		     }
		   
		   if($data['purchase_status']!='pending')
		   {
		   		if($data['payment_method']==0)
			     {
			     	$this->basic->update_data('{PRE}purchase',array('purchase_id'=>$purchase_id),$temp_data3);
			     }
			     else
			     {
			     	$temp_data3['paid_amount'] = $temp_data3['payable_amount'];
			     	$this->basic->update_data('{PRE}purchase',array('purchase_id'=>$purchase_id),$temp_data3);
			     	$paid_table['purchase_id'] = $purchase_id;
			     	$paid_table['date'] = date('Y-m-d');
			     	$paid_table['vendor_id'] = $data['vendor_id'];
			     	$paid_table['paid_amount'] = $temp_data3['payable_amount'];
			     	$this->basic->insert_data('{PRE}paid',$paid_table);
			     }
			     $debt_data=array();
			     $debt_data['date'] = date('Y-m-d');
			     $debt_data['vendor_id']= $data['vendor_id'];
			     $debt_data['payable']= $temp_data3['payable_amount'];
			     $debt_data['purchase_id'] = $purchase_id;

			     if($data['payment_method']==0)
			     {
			     	//credit
			     	//$debt_data['payable']= $debt_data['total_amount'];
			     }
			     else
			     {
				     	//cash
			     	$debt_data['paid']= $debt_data['payable'];
			     }
			     $this->basic->insert_data('{PRE}debts',$debt_data);
		   }
		     
		     $this->session->set_flashdata('message', array('message'=>"Added Succussfully",'class' => 'success'));
		  		redirect('Purchase_ctrl/', 'refresh');
		 }
		 $this->load->view('template',$template);
	}

	public function add_vendor_popup()
	{
	    $this->load->view('Purchase/add_vendor_popup');
	}
	public function add_vendor()
	{
		     $data = $this->basic->get_post_data();
		     $data['vendor_id'] = $this->basic->insert_data_id('{PRE}vendor',$data);
		     print_r(json_encode($data));
	}
	public function paid_payment()
	{
		$template['page'] = 'Purchase/view_paid';
		$template['title'] = 'Paid Amount';
		$join = array('{PRE}vendor'=>'{PRE}paid.vendor_id = {PRE}vendor.vendor_id,inner');
		$template['data'] = $this->basic->get_data('{PRE}paid', '', '{PRE}paid.*,{PRE}vendor.*', $join);
		
//		print_r(json_encode($template['data'])); die;
		$this->load->view('template',$template);
	}
	public function add_new_payment()
	{
		$template['page'] = 'Purchase/add_paid';
		$template['title'] = 'Add Payment';
	 	$template['data'] = $this->basic->get_data('{PRE}vendor', '', '{PRE}vendor.vendor_id,{PRE}vendor.vendor_name');
		if($_POST)
		{
		    $data = $this->basic->get_post_data();
		    $data_temp['vendor_id']=$data['client_id'];
			$data_temp['date'] = date('Y-m-d');		    
			$data_temp['paid_amount'] = $data['received'];
			$data_temp['payable_f']=-1;
			
		    $insert_id = $this->basic->insert_data_id('{PRE}paid',$data_temp);
		    $this->session->set_flashdata('message', array('message'=>"Added Succussfully",'class' => 'success'));
		  		redirect('Purchase_ctrl/', 'refresh');
		}
		$this->load->view('template', $template);
	}
	public function get_vendor_details()
	{
		$res=$this->input->post('id');
		$where=array('vendor_id'=>$res);
		$template['shipping_details'] = $this->basic->get_data('{PRE}vendor', $where, '*');
		$where=array('vendor_id'=>$res);
		$template['total_purchase']= $this->basic->get_sum_of_sales('{PRE}purchase', $where, 'payable_amount');
		$template['total_paid']= $this->basic->get_sum_of_sales('{PRE}paid', $where, 'paid_amount');
		print_r(json_encode($template)); 
	}
	public function view_invoice($purchase_id, $vendor_id, $payment_status)
	{

		$where['where']=array('vendor_id'=>$vendor_id);
		$template['shipping_details'] = $this->basic->get_data('{PRE}vendor', $where, '*');
		$template['invoice_id'] = 123;
		$template['products']= $this->basic->join_for_purchase_data($purchase_id, $vendor_id);
		$template['logo'] = $this->Settings_model->settings_viewings();
		$template['payment_type']=$payment_status;
		$where1=array('vendor_id' => $vendor_id);
		$total_amount = $this->basic->get_sum_of_sales('{PRE}purchase', $where1, 'payable_amount');// - $this->basic->get_sum('{PRE}sales', $where);
		$where2=array('vendor_id' => $vendor_id);
		$received_amount = $this->basic->get_sum_of_sales('{PRE}paid', $where2, 'paid_amount');
		$template['net_balance_to_pay']=$total_amount[0]->payable_amount-$received_amount[0]->paid_amount;	
		$this->load->view('Pdf/subs_for_sale',$template);

	}
	public function view_challan($purchase_id, $vendor_id, $payment_status)
	{
		$where['where'] = array('vendor_id'=>$vendor_id);
		$template['shipping_details'] = $this->basic->get_data('{PRE}vendor', $where, '*');
		$template['invoice_id'] = 123;
		$template['products'] = $this->basic->get_challan_products($purchase_id);
		$template['payment_type'] = $payment_status;
		$template['logo'] = $this->Settings_model->settings_viewings();
		//print_r(json_encode($template)); die;
		//print_r(json_encode($template)); die;
		$this->load->view('Pdf/challan', $template);
	}
	public function edit_purchase($purchase_id, $vendor_id, $payment_status)
	{	
		
		$where['where'] =array('vendor_id'=>$vendor_id);
		$template['vendor'] =$this->basic->get_data('{PRE}vendor', $where, '*');
		$template['products'] =$this->basic->get_data('{PRE}products','','*');
		$template['page']='Purchase/edit_purchase';
		$template['purchase_id'] = $purchase_id;
		$this->load->view('template',$template);
		
		if($_POST)
		{
		     $data = $this->basic->get_post_data();	
		    // print_r($data); die;
		     if($data['purchase_status']=='pending')
		     {
		     	//pending
		     	try
		     	{
		     		 $this->basic->delete_rows_edit_purchase($data['purchase_id']);
		     		 
		     		 for($i = 1; $i < $data['option_counts'];++$i)
				     {
						$purchase_details_data=array();
						$purchase_details_data['product_id'] = $data['item_id'.$i];
						$purchase_details_data['quantity'] = $data['quantity'.$i];
						$purchase_details_data['cost'] = $data['cost'.$i];
						$purchase_details_data['selling_price'] = $data['selling_price'.$i];
						$purchase_details_data['purchase_id'] = $data['purchase_id'];
					    $this->basic->insert_data('b2b_purchase_details',$purchase_details_data);
				     }
		     	}
		     	catch(Exception $e)
		     	{
		     		var_dump($e->getMessage()); 
		     	}



		     }
		     else 
		     {
		     	//ordered now
		     	try 
		     	{
					

		     		$this->basic->delete_rows_edit_purchase($data['purchase_id']);
		     		 $temp_data3['payable_amount']=0;



		     		 for($i = 1; $i < $data['option_counts'];++$i)
				     {
						$purchase_details_data=array();
						$purchase_details_data['product_id'] = $data['item_id'.$i];
						$purchase_details_data['quantity'] = $data['quantity'.$i];
						$purchase_details_data['cost'] = $data['cost'.$i];
						$purchase_details_data['selling_price'] = $data['selling_price'.$i];
						$purchase_details_data['purchase_id'] = $data['purchase_id'];
					    $temp_data3['payable_amount'] =$temp_data3['payable_amount'] + ($purchase_details_data['quantity']*$purchase_details_data['cost']);
					    $this->basic->insert_data('b2b_purchase_details',$purchase_details_data);

					    //put data in inventory table ;

					    $inventory_table_data=array();
					    $inventory_table_data['type']='in';
					    $inventory_table_data['purchase_id'] = $data['purchase_id'];
					    $inventory_table_data['date'] = date('Y-m-d');
					    $inventory_table_data['sales_price']= $data['selling_price'.$i];
					    $inventory_table_data['quantity']=$data['quantity'.$i];
					    $inventory_table_data['total_sales']=$data['quantity'.$i]* $data['selling_price'.$i];
					    $inventory_table_data['cost_price']=$data['cost'.$i];
					    $inventory_table_data['purchase_status']='order';
					    $inventory_table_data['total_cost']= $data['cost'.$i]*$data['quantity'.$i];
					    $inventory_table_data['product_id']= $data['item_id'.$i];

					    $this->basic->insert_data('b2b_inventory', $inventory_table_data);
				     }
				     if($data['payment_method']==0)
				     {
				     	$this->basic->update_data('{PRE}purchase',array('purchase_id'=>$purchase_id),$temp_data3);
				     }
				     else
				     {
				     	$temp_data3['paid_amount'] = $temp_data3['payable_amount'];
				     	$this->basic->update_data('{PRE}purchase',array('purchase_id'=>$purchase_id),$temp_data3);
				     	$paid_table['purchase_id'] = $purchase_id;
				     	$paid_table['date'] = date('Y-m-d');
				     	$paid_table['vendor_id'] = $data['vendor_id'];
				     	$paid_table['paid_amount'] = $temp_data3['payable_amount'];
				     	$this->basic->insert_data('{PRE}paid',$paid_table);
				     }
				     $debt_data=array();
				     $debt_data['date'] = date('Y-m-d');
				     $debt_data['vendor_id']= $data['vendor_id'];
				     $debt_data['payable']= $temp_data3['payable_amount'];
				     $debt_data['purchase_id'] = $purchase_id;

				     if($data['payment_method']==0)
				     {
				     	//credit
				     	//$debt_data['payable']= $debt_data['total_amount'];
				     }
				     else
				     {
					     	//cash
				     	$debt_data['paid']= $debt_data['payable'];
				     }
				     $this->basic->insert_data('{PRE}debts',$debt_data);

				     $pur_id=$data['purchase_id'];
			     	 $this->basic->update_purchase_data($pur_id);
		     	} 
		     	catch (Exception $e) 
		     	{
		     		
		     	}
		     }
		     $this->session->set_flashdata('message', array('message'=>"Added Succussfully",'class' => 'success'));
		  		redirect('Purchase_ctrl/', 'refresh');
		}
	}
	public function get_selected_products()
	{
		
		$purchase_id= $this->input->post('id');
		$data=$this->basic->get_editable_products($purchase_id);
		print_r(json_encode($data)); die;

	}
}
?>