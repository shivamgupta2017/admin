
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help_ctrl extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set("Asia/Kolkata");
		
		    $this->load->model('Help_model');
			if(!$this->session->userdata('logged_in_adminw')) { 
			redirect(base_url());
		}
	}

	
	//display Help page
function view_help()
   {
			 
				  $template['page'] = 'help/view_help';
				  $template['page_title'] = 'help';
				   $template['help'] = $this->Help_model->get_help_details();	
				  $this->load->view('template',$template);
		 
   }
	  //add new Help
	  
 function add_help(){
		  
		           $template['page'] = 'help/help';
			       $template['page_title'] = 'help';
                   $sessid=$this->session->userdata('logged_in_adminw');
				   //$userid=$userdetails['id'];	
				   
		   
						 if($_POST) 
						  {
							  
						      $data = $_POST;
				 
				 	 
				         $result = $this->Help_model->add_help($data);
				  
				          if($result) 
				          {
						/* Set success message */
						  $this->session->set_flashdata('message',array('message' => 'Add Help Details successfully','class' => 'success'));
					      }
					      else 
						  {
						/* Set error message */
						  $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));  
		                  }
								 redirect(base_url().'Help_ctrl/view_help'); 
				 }
		         $this->load->view('template',$template);
		 
	  
	}
	  
 
	  
	//edit Help
	
  function edit_help()
    {
			  $template['page'] = 'help/edit_help';
			  $template['title'] = 'Edit help';
			 // $userdetails=$this->session->userdata('logged_in_adminw'); 
			  $id = $this->uri->segment(3);
		
		         
				  $template['data'] = $this->Help_model->edit_help_id($id);

		  if($_POST){ 
			  $data = $_POST;
			  $result = $this->Help_model->edit_help($data, $id);
			  if($result)
			  {
				   $this->session->set_flashdata('message',array('message' => 'Edit City Updated Successfully','class' => 'success'));
				   redirect(base_url().'Help_ctrl/view_help');
			  }	
             else
			  {
				 $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));
				 redirect(base_url().'Help_ctrl/view_help');
			  }				 
			}	
			 $this->load->view('template',$template);  
	  
     }
	  //delete Help
function delete_help()
    {
		  
				 
				  $id = $this->uri->segment(3);		   
				  $result = $this->Help_model->delete_help($id);
				  $this->session->set_flashdata('message', array('message' => 'Deleted Successfully','class' => 'success'));
				  redirect(base_url().'Help_ctrl/view_help');
	 }
	
 }