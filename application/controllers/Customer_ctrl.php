 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_ctrl extends CI_Controller {

	public function __construct() {
	parent::__construct();
		
	date_default_timezone_set("Asia/Kolkata");
			 $this->load->model('basic');
		   	 $this->load->database();
		   	 $this->load->library('form_validation');
			if(!$this->session->userdata('logged_in_adminw1')) 
			{
				redirect(base_url());
			}
    }
// view customer details	  
function index()
{
	  		$template['data'] = $this->basic->get_data('{PRE}users', '','*');
	  		$template['page'] = 'Customer/view-customer';
	  		$template['page_title'] = 'View Customer';
	  		//print_r($template); die;
	  		$this->load->view('template',$template);
	  }
	public function create_customer(){
		  
		  $template['page'] = 'Customer/create_customer';
		  $template['title'] = 'Create Customer';
		  $this->load->view('template',$template);
		  
		  if($_POST)
		  {

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[{PRE}users'.'.email]');
		  if ($this->form_validation->run() == TRUE)
		  {
//		  		$temp_data =  $this->basic->count_row('{PRE}users','','user_id');
		  	 /*if($temp_data[0]['total_rows'] == 0)
		  	 {
		  		    $data['user_type'] = 1;
		  	 }*/
		  		$data = $this->basic->get_post_data();
		  		
		  		$result = $this->basic->insert_data_id('{PRE}users',$data);
		  		$temp['user_id'] = $result;
		  		if($result!=0)
		  		{
		  			$this->session->set_flashdata('message', array('message'=>"Customer Created Successfully",'class' => 'success'));
			  		redirect('Customer_ctrl', 'refresh');
		  		}
		  		else
		  		{
		  			$this->session->set_flashdata('message', array('message'=>validation_errors(),'class' => 'danger'));
			  		redirect('Customer_ctrl/create_customer', 'refresh');
		  		}
		      
		  	}
		  	else
		  	{
		  		$this->session->set_flashdata('message', array('message'=>validation_errors(),'class' => 'danger'));
		  		redirect('Customer_ctrl/create_customer', 'refresh');
		  	}
		  }
	  }
	  
	  public function view_customer()
	  {
	 	$data = $this->basic->get_post_data();
	 	$where['where'] = array('user_id'=>$data['customer_details']);
	    $result['billing_address'] = $this->basic->get_data('{PRE}users',$where,'*');
	    $result['shipping_address'] = $this->basic->get_data('{PRE}shipping_addresses',$where,'*');
	   	$this->load->view('Customer/view-customer-popup',$result);
 	  }
    public function update_customer($id='',$action=''){
        if($action == 0){
            $where = array('user_id'=>$id);
            $this->basic->update_data('{PRE}users',$where,array('active'=>1));
            $this->session->set_flashdata('message', array('message'=>'Activated Successfully','class' => 'success'));
		  	redirect('Customer_ctrl', 'refresh');
        }
        else{
            $where = array('user_id'=>$id);
            $this->basic->update_data('{PRE}users',$where,array('active'=>0));
            $this->session->set_flashdata('message', array('message'=>'Deactivated Successfully','class' => 'success'));
		  	redirect('Customer_ctrl', 'refresh');
        }
    }
    public function edit_cust_view($id){
        $where['where'] = array('user_id'=>$id);
        if($_POST){
            $data = $this->basic->get_post_data();
		  		         $temp['user_id'] = $id;
		  		          $temp['shipping_address_1'] = $data['shipping_address_1'];
		  		           $temp['shipping_address_2'] = $data['shipping_address_2'];
		  		            $temp['shipping_zip'] = $data['shipping_zip'];
		  		             $temp['shipping_phone'] = $data['shipping_phone'];
		  		              unset($data['shipping_address_1'],$data['shipping_address_2'],$data['shipping_zip'],$data['shipping_phone']);
		  		$data['user_type'] = 0;
		  		$data['username'] = $data['first_name'].$data['last_name'];
		  		$data['password'] = sha1($data['password']);
		  		unset($data['password_confirm']);
		  		$result = $this->basic->update_data('{PRE}users',$where['where'],$data);
		  		$this->basic->update_data('{PRE}shipping_addresses',$where['where'],$temp);
		  		if($result){
		  			$this->session->set_flashdata('message', array('message'=>"Customer Updated Successfully",'class' => 'success'));
		  		    redirect('Customer_ctrl', 'refresh');
		  		}
        }
 //	$where['where'] = array('user_id'=>$id);
    $template['data'] = $this->basic->get_data('{PRE}users',$where,'*');
    $template['shipping_address'] = $this->basic->get_data('{PRE}shipping_addresses',$where,'*','','','','shipping_add_id');
    $template['page'] = "Customer/editcust_view";
   	$this->load->view('template',$template);
    }
    public function shipping_popup(){
        $data = $this->basic->get_post_data();
        $this->load->view('Customer/shipping_address_popup',$data);
    }
    public function add_shipping_address(){
        $data = $this->basic->get_post_data();
        $result = $this->basic->insert_data('shipping_addresses',$data);
        if($result){
            $this->session->set_flashdata('message', array('message'=>"Shipping Address Added Successfully",'class' => 'success'));
            redirect('Customer_ctrl/edit_cust_view/'.$data['user_id'],'refresh');
        }
        else{
             $this->session->set_flashdata('message', array('message'=>"Unable to  Update",'class' => 'danger'));
             redirect('Customer_ctrl/edit_cust_view/'.$data['user_id'],'refresh');
        }
    }
}	 
?>