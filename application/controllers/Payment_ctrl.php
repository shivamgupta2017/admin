<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_ctrl extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('basic');
			if(!$this->session->userdata('logged_in_adminw1')) { 
			redirect(base_url());
		}
	}
	
	public function index(){
		 $template['page'] = 'Payment/payments';
		  $template['title'] = 'View Payments';
		    $join = array(
		                'orders'=>'payments.order_id = orders.id,inner',
		                'users'=>'orders.user_id = users.user_id,inner',
		                );
		  $where['where'] = array('orders.status'=>3);
		   $template['data'] = $this->basic->get_data('payments',$where,'payments.*,users.*',$join);
		    $this->load->view('template',$template);
	}
	public function complete_order($id){
	    $data = array('payment_status'=>2);
	    $where = array('order_id'=>$id);
    	$result = $this->basic->update_data('{PRE}payments',$where,$data);    
    	$this->session->set_flashdata('message',array('message'=>'Updated Successfully','class'=>"success"));
    	redirect('Payment_ctrl','refresh');
	}
  public function edit_payment($id,$order_id=''){
     $template['page'] = 'Payment/edit_payment';
      $template['title'] = 'Edit Products';
       if($_POST){
           $where = array('payment_id'=>$id);
           $data = $this->basic->get_post_data();
           if($data['action'] == 'cash'){
              unset($data['action']);
              $data['payment_status'] = 2;
              $data['mode'] = 1;
              $data['paid_date'] = date('Y-m-d');
              $result = $this->basic->update_data('payments',$where,$data);
              $this->session->set_flashdata('message',array('message'=>'Updated Successfully','class'=>"success"));
           }
           elseif($data['action'] == 'cheque'){
              unset($data['action']);
              $data['payment_status'] = 1;
              $data['mode'] = 2;
              $data['paid_date'] = date('Y-m-d');
              $result = $this->basic->update_data('payments',$where,$data);
              $this->session->set_flashdata('message',array('message'=>'Updated Successfully','class'=>"success"));
           }
           elseif($data['action'] == 'online'){
              unset($data['action']);
              $data['payment_status'] = 1;
              $data['paid_date'] = date('Y-m-d');
              $data['mode'] = 3;
              $result = $this->basic->update_data('payments',$where,$data);
              $this->session->set_flashdata('message',array('message'=>'Updated Successfully','class'=>"success"));
           }
           elseif($data['action'] == 'swipe'){
              unset($data['action']);
              $data['payment_status'] = 2;
              $data['mode'] = 4;
              $data['paid_date'] = date('Y-m-d');
              $result = $this->basic->update_data('payments',$where,$data);
              $this->session->set_flashdata('message',array('message'=>'Updated Successfully','class'=>"success"));
           }else{
                $this->session->set_flashdata('message',array('message'=>'Unable to update','class'=>"danger"));
           }
        redirect('Payment_ctrl','refresh');
       $invoice_id = $this->basic->generate_invoice($order_id);
       $join = array('{PRE}orders'=>'{PRE}orders.user_id = {PRE}users.user_id,inner');
       $where['where'] = array('order_id'=>$order_id);
       $data = array();
       $data = $this->basic->get_data('{PRE}users',array('id'=>$id),'*',$join);
       $link = base_url().'assets/pdfs/invoice/INV-000'.$invoice_id.".pdf";
       $this->basic->update_data('{PRE}payments',$where['where'],array('invoice_link'=>$link));
       $this->basic->update_data('{PRE}invoice',array('id'=>$invoice_id),array('invoice_link'=>$link));
       $result = $this->basic->update_data('{PRE}orders',array('id'=>$order_id),array('link'=>$link));
            $data['message'] = "Your Invoice is Generated Check it Here.";
             $data['first_name'] = $data[0]->first_name;
              $data['last_name'] = $data[0]->last_name;
               $data['device_id'] = $data[0]->player_id;
                $data['link'] = $link;
                 create_notification($data);
       }
 
       $this->load->view('template',$template);
  }
  public function add_payment(){
    $template['page'] = 'Payment/add_payments';
    $this->load->view('template',$template);
    if($_POST){
      $data = $this->basic->get_post_data();
      $client_id = $data['client_id'];
      $vendor_id = $data['vendor_id']; 
      if($client_id !=0){
        $data['received_amount'] = $data['paid_amount'];
        unset($data['vendor_id'],$data['client_id'],$data['paid_amount']);
        $where = array('client_id'=>$client_id);
        $this->basic->update_data('{PRE}sales',$where,$data);
      }if($vendor_id !=0){
        unset($data['vendor_id'],$data['client_id']);
        $where = array('vendor_id'=>$vendor_id);
        $this->basic->update_data('{PRE}purchase',$where,$data);
      }
    }
      // $data = array('payment_status'=>2);
      // $where = array('order_id'=>$id);
      // $result = $this->basic->update_data('{PRE}payments',$where,$data);    
      // $this->session->set_flashdata('message',array('message'=>'Updated Successfully','class'=>"success"));
      // redirect('Payment_ctrl','refresh');
  }

  public function get_client(){
    $join = array('{PRE}sales'=>'{PRE}users.user_id = {PRE}sales.client_id,inner');
    $data = $this->basic->get_data('{PRE}users','','users.*',$join);
    print_r(json_encode($data));
  }
  public function get_vendor(){
     $data = $this->basic->get_data('{PRE}vendor','','*');
     print_r(json_encode($data));
  }
}
?>