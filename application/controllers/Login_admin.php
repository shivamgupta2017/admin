	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_admin extends CI_Controller {



	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('AdminLogin_model');
		$this->load->model('Settings_model');
		$this->load->library('session');
		if($this->session->userdata('logged_in_adminw1')) 
		{
			redirect(base_url().'Dashboard_ctrl/dashboard');
		}
 	}
	public function index()
	{
		    $this->load->view('login-form');	                        
	}

	
	public function login()
	{

		$template['page_title'] = "Login";
		    if(isset($_POST)) 
		    {
				$this->load->library('form_validation');
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
	                  
					if($this->form_validation->run() == TRUE) 
					{
						
						redirect(base_url().'Dashboard_ctrl/dashboard');
					}
					else 
				     {
				     	 $this->session->set_flashdata('unerror','Please Enter Valid UserName And Password!');
			     		redirect(base_url().'Login_admin');
				     }
		    }
	 }
	public function check_database($password) 
	{
			$username = $this->input->post('username');
			$result = $this->AdminLogin_model->login($username, sha1($password));
			
			//print_r(json_encode($result)); die;

			if($result) 
			   {
			       if($result->user_type == 1)
			       {
				         $user=$result->user_id;
					     $user="admin";
					     $sess_array = array();
				         $sess_array = array(
						'id' => $result->user_id,
						'username' => $result->username,
						'user_type' => $result->user_type,
				        'created_user' =>$user,
				        );
					  
			                $resulttitle = $this->Settings_model->settings_viewings();
							$sess_arrays = array(
							'title' => $resulttitle->title
							);
							
							
							
							
						 $this->session->set_userdata('title1', $sess_arrays);
					     $this->session->set_userdata('logged_in_adminw1',$sess_array);
					     $this->session->set_userdata('admin1',$result->user_type);
						 $this->session->set_userdata('id1',$result->user_id);
						 $this->session->set_userdata('profile_pic1',$result->settings->logo);
					     return TRUE;
						 
		   		 }
		    else{
		        $this->session->set_flashdata('unerror','You dont have permission to login!');
			     redirect(base_url().'Login_admin');
		    } 
			       
			   }
		    else 
		     {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		     }
	 }
	 function forget_password($unique_key=''){
	     
	     if($_POST){
	         $data = $this->input->post();
	         $data['unique_key'] = 0;
	         unset($data['conform_password']);
	         $data['password'] = sha1($data['password']);
	        $result = $this->db->where('id',$data['id'])->update('{PRE}customer_registration',$data);
	        }
	     $query = $this->db->select('id')->from('{PRE}customer_registration')->where('unique_key',$unique_key)->get()->row();
	     if(!empty($query)){
	     $this->load->view('forget_password',$query);
	 }else{
	     $query['id']='';
	     $this->load->view('forget_password',$query);
	 }
	 }

}
