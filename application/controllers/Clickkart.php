<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clickkart extends CI_Controller {

	  public function __construct(){
		parent::__construct();
		
		$this->load->model('model_click');
		

		if($this->session->userdata('logged_in_adminw')) { 
			redirect(base_url().'');
		}
		
	   
		}
		
		
		//registration	
	 public function index(){
		    

		  $template['page'] = 'Login/clickkart_register';
		  $template['title'] = 'Login';
		 
		  
		  if($_POST){
			  $data = $_POST;
			 
			  
			 $result = $this->model_click->user_registration($data);
			 if($result)
			 {
				  $this->session->set_flashdata('message',array('message' => 'Add Customer Details successfully','class' => 'success'));
			
              //redirect(base_url().'Clickkart/update_customer');
			  
			}
			 else
			 {
				 $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));
			 }			 
		    
		  }
		  
			 //$template['result'] = $this->Agent_model->get_bustype_id();
			 $this->load->view('template',$template);
			
			  
	  }
	
	/*function update_customer()
	{
		
		 $template['page'] = 'Login/clickkart_register';
		  $template['title'] = 'Login';
		 
		  
		  if($_POST){
			  $data = $_POST;
			 
			  
			 $result = $this->model_click->user_registration($data);
			 if($result)
			 {
				  $this->session->set_flashdata('message',array('message' => 'Add Customer Details successfully','class' => 'success'));
			 }
			 else
			 {
				 $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));
			 }			 
		    
		  }
		  
			 //$template['result'] = $this->Agent_model->get_bustype_id();
			 $this->load->view('template',$template);
		
		
		
		
	}*/
	
	 function login(){
		
			
		    $template['page_title'] = "Login";
			$template['page'] = 'Login/login-form';
		    
		    if(isset($_POST)) {
			print_r('shivam'); die;

			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
                  
			if($this->form_validation->run() == TRUE) {
				redirect(base_url().'Home_ctrl/view_home');
			}
		    }
		    //$template['page'] = 'Login/clickkart_home';
			$this->load->view('template',$template);
	}
	
	
	
	
	function check_database($password) {
	
	
		
			$username = $this->input->post('username');
	
			$result = $this->model_click->loginuser1($username, md5($password));
	
			
			if($result) {
				$user=$result->id;
				//var_dump($user);
				//exit();
			      
				  
				    $sess_array = array();
			        $sess_array = array(
					'id' => $result->id,
					'email' => $result->email,
					
			        );
				  
				  
				  
				 
				
		     $this->session->set_userdata('logged_in_adminw',$sess_array);
			 //$this->session->set_userdata('admin',$result->user_type);
			 $this->session->set_userdata('id',$user);
			

		     return TRUE;
			 
		     }
		    else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		 }
	}
	
	
	
	
}