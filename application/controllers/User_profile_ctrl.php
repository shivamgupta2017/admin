<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile_ctrl extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		 date_default_timezone_set("Asia/Kolkata");
		 $this->load->model('User_profile_model');
		
		 if(!$this->session->userdata('logged_in_adminw')) { 
			redirect(base_url());
		 }

		
    }       
	
	
  //Change Password
  
	  public function change_profile_password(){
				
							$template['page'] = 'user_details/user_profile_view';
							$template['page_title'] = "View profile";					
		                    $id = $this->session->userdata('logged_in_adminw')['id'];
							
							
							            if(isset($_POST) and !empty($_POST)) {
										if(isset($_POST['reset_pwdd'])) {
							            $data = $_POST;
							
						//	array_walk($data, "remove_html");
							
							if($data['n_password'] !== $data['c_password']) {
								$this->session->set_flashdata('message', array('message' => 'Password doesn\'t match', 'title' => 'Error !', 'class' => 'danger'));
								redirect(base_url().'User_profile_ctrl/view_user_profile');
							}
							else {
							unset($data['c_password']);						
							$result = $this->User_profile_model->update_user_password($data, $id);
							if($result) {
								if($result === "notexist") {
									$this->session->set_flashdata('message', array('message' => 'Invalid Password', 'title' => 'Warning !', 'class' => 'warning'));
									redirect(base_url().'User_profile_ctrl/view_user_profile');
								}
								else {
									$this->session->set_flashdata('message', array('message' => 'Password updated successfully', 'title' => 'Success !', 'class' => 'success'));
									redirect(base_url().'User_profile_ctrl/view_user_profile');
								}
							}
							else {
								$this->session->set_flashdata('message', array('message' => 'Sorry, Error Occurred', 'title' => 'Error !', 'class' => 'danger'));
								redirect(base_url().'User_profile_ctrl/view_user_profile');
							}
					
				}
			}
		}
		$this->load->view('template', $template);
	 }
	
	
  //PROFILE VIEW
	      
	  public function view_user_profile() {
					
					        $template['page'] = 'user_details/user_profile_view';
							$template['page_title'] = "View profile";					
		                    $id = $this->session->userdata('logged_in_adminw')['id'];
							
				      if($_POST) {
			          $data = $_POST;

					    if(isset($_FILES['profile_pic'])) {  
						$config = set_upload_userprofilepic('assets/uploads/profile_pic/store');
						$this->load->library('upload');
						
						$new_name = time()."_".$_FILES["profile_pic"]['name'];
						$config['file_name'] = $new_name;

						$this->upload->initialize($config);

						if ( ! $this->upload->do_upload('profile_pic')) {
								unset($data['profile_pic']);
							}
							else {
								$upload_data = $this->upload->data();
								//$data['username'] = $this->session->userdata('logged_in_adminw')['username'];			
								$data['profile_picture'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
								if($id == $this->session->userdata('logged_in_adminw')['id']) {
									$this->session->set_userdata('profile_pic',$data['profile_picture']);
								}
	
								
							}
						      $result = $this->User_profile_model->update_user_profile($data, $id);
							  $this->session->set_flashdata('message',array('message' => 'Edit View Profile Updated successfully','class' => 'success'));
							
						
						}
						 

						//redirect(base_url().'Profile_details/view_profile');
					}
					    $template['data'] = $this->User_profile_model->get_single_profile_details($id);
						$this->load->view('template', $template);
				
	 }
	 
}
?>