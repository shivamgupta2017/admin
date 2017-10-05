 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_ctrl extends CI_Controller {

	public function __construct() {
	parent::__construct();
		
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('User_model');
		
		if(!$this->session->userdata('logged_in_adminw')) { 
			redirect(base_url());
		}
		 else {
			  $menu = $this->session->userdata('admin');
			  if( $menu!=1  ) {
				 $this->session->set_flashdata('message', array('message' => "You don't have permission to access user page.",'class' => 'danger'));
				 redirect(base_url().'User_ctrl/view_userdetails');
			 }
		}

    }
	
//////////////////////////////////////////////////////
//////////**********ViEW USER DETAILS**********///////
	  public function view_user_details(){
		  
		  $template['page'] = 'User/view-user';
		  $template['title'] = 'View User';
		  $template['data'] = $this->User_model->get_user_details();
		  $this->load->view('template',$template);
	  }
	  
//////////////////////////////////////////////////////
//////////**********ADD USER**********////////////////
	  
	  public function add_user_details(){
		  
		  $template['page'] = 'User/add_user';
		  $template['title'] = 'Add User';
		  $sessid=$this->session->userdata('logged_in_adminw');		
 
		  if($_POST){
			  $data = $_POST;
			  			
			  array_walk($data, "remove_html");
			  
			//$config = set_upload_agent('assets/uploads/img');
			    $data['created_by']=$sessid['created_user'];	
				if(isset($_FILES['profile_pic'])) {
           


										
			$config = set_upload_agent('assets/uploads/img');
			$this->load->library('upload');
			
			$new_name = time()."_".$_FILES["profile_pic"]['name'];
			$config['file_name'] = $new_name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('profile_pic')) {
					unset($data['profile_pic']);
					$this->session->set_flashdata('message', array('message' => "Display Picture : ".$this->upload->display_errors(), 'title' => 'Error !', 'class' => 'danger'));
				}
				else {
					$upload_data = $this->upload->data();
					$data['profile_picture'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
				}
			}
			  
			 $result = $this->User_model->add_user($data);
			
			
			 if($result)
			 {
				  $this->session->set_flashdata('message',array('message' => 'Add Agent Details successfully','class' => 'success'));
			 }
			 else
			 {
				 $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));
			 }			 
		    
		  }
			 $template['store_result'] = $this->User_model->get_store();
			 $template['role_result'] = $this->User_model->get_rolevalues();
			 $this->load->view('template',$template);
			  
	  }
//////////////////////////////////////////////////////
//////////**********EDIT USER**********/////////////// 
	 public function edit_user_details(){
		  
		  $template['page'] = 'User/edit-user';
		  $template['page_title'] = 'Edit User';
		  $id = $this->uri->segment(3);
		  $template['data'] = $this->User_model->editget_user_id($id);
		  if(!empty($template['data'])){
		  
		  if($_POST){
			  $data = $_POST;
			  
			 // array_walk($data, "remove_html");

			  unset($data['submit']);

			if(isset($_FILES['profile_pic'])) {  
			$config = set_upload_edituser('assets/uploads/img');
			$this->load->library('upload');
			
			$new_name = time()."_".$_FILES["profile_pic"]['name'];
			$config['file_name'] = $new_name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('profile_pic')) {
					unset($data['profile_pic']);
				}
				else {
					$upload_data = $this->upload->data();
					$data['profile_picture'] = $config['upload_path']."/".$upload_data['file_name']; 
				}
			}
	
			  
			      $result = $this->User_model->edit_user($data, $id);
				  $this->session->set_flashdata('message',array('message' => 'Edit User Details successfully','class' => 'success'));
                  redirect(base_url().'User_ctrl/view_user_details');
                                 
			 }
		  }
		  else{
			   $this->session->set_flashdata('message', array('message' => "You don't have permission to access.",'class' => 'danger'));	
			   redirect(base_url().'User_ctrl/view_user_details');
                                 
		  }
		 
			  $template['store_result'] = $this->User_model->get_store();
			  $template['role_result'] = $this->User_model->get_rolevalues();
			  // $template['result'] = $this->User_model->get_bustypeid();		  
			  $this->load->view('template',$template);	  
	  }  
//delete user	  
	  public function user_delete(){
		  
		  $data1 = array(
				  "user_status" => '0'
							 );
		  
		  $id = $this->uri->segment(3);
		  $result = $this->User_model->delete_user($id,$data1);
		  $this->session->set_flashdata('message', array('message' => 'Deleted Successfully','class' => 'success'));
		  redirect(base_url().'User_ctrl/view_user_details');
	  }
//popup user	  
	  public function view_userpopup(){

		  
		  $id=$_POST['userdetails'];
		  $template['data'] = $this->User_model->view_popup_userdetails($id);
		  $this->load->view('User/view-user-popup',$template);
	  }
	 
// view customer details	  
	public function view_customer_details(){
		  
		  $template['page'] = 'Customer/view-customer';
		  $template['title'] = 'View Customer';
		  $template['data'] = $this->User_model->get_customer_details();
		  $this->load->view('template',$template);
	  }
	  
	 public function forgotpassword(){
	     $template['page'] = 'User/forget_password';
		  $this->load->view('template',$template);
	     $unique_key = $this->input->get('unique_key');
	     $result = $this->db->where('unique_key',$unique_key)->get('customer_registration');
	   if($result->num_rows() > 0){
	       $response = "Password Saved Succefully";
	   }else{
	       $response = "Unable To Save Password";
	   }
	     
	 }
}	 
?>