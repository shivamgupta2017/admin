<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_ctrl extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		 date_default_timezone_set("Asia/Kolkata");
		 $this->load->model('Profile_model');
		
		 if(!$this->session->userdata('logged_in_adminw')) { 
			redirect(base_url());
		 }
		
    }

/////////////////////////////////////////////////
/////******CHANGE ADMIN PASSWORD*******//////////	
	    public function admin_change_password(){
				
							$template['page'] = 'admin_details/View_profile';
				            $template['page_title'] = "View Admin profile";					
		                    $id = $this->session->userdata('logged_in_adminw')['id'];
           
							
							if(isset($_POST) and !empty($_POST)) {
							if(isset($_POST['reset_pwd'])) {
							$data = $_POST;
							
							array_walk($data, "remove_html");
							
							if($data['n_password'] !== $data['c_password']) {
								$this->session->set_flashdata('message', array('message' => 'Password doesn\'t match', 'title' => 'Error !', 'class' => 'danger'));
								redirect(base_url().'Profile_ctrl/admin_profile');
							}
							else {
							unset($data['c_password']);						
							$result = $this->Profile_model->update_admin_passwords($data, $id);
						    if($result) {
								if($result === "notexist") {
									$this->session->set_flashdata('message', array('message' => 'Invalid Password', 'title' => 'Warning !', 'class' => 'warning'));
									redirect(base_url().'Profile_ctrl/admin_profile');
								}
								else {
									$this->session->set_flashdata('message', array('message' => 'Password updated successfully', 'title' => 'Success !', 'class' => 'success'));
									redirect(base_url().'Profile_ctrl/admin_profile');
								}
							}
							else {
								$this->session->set_flashdata('message', array('message' => 'Sorry, Error Occurred', 'title' => 'Error !', 'class' => 'danger'));
								redirect(base_url().'Profile_ctrl/admin_profile');
							}
					
				}
			}
		}
		$this->load->view('template', $template);
	}

/////////////////////////////////////////////////
/////******ADMIN PROFILE VIEW*******/////////////	 
    public function admin_profile() {
		
				    $template['page'] = 'admin_details/view_profile';
				    $template['page_title'] = "View Admin profile";			
				    $id = $this->session->userdata('logged_in_adminw')['id'];

					
						    if(isset($_FILES['profile_pic'])) {
							$config = set_upload_profilepic('assets/uploads/profile_pic/admin');
						
							$this->load->library('upload');
							
							$new_name = time()."_".$_FILES["profile_pic"]['name'];
							$config['file_name'] = $new_name;

							$this->upload->initialize($config);

							if ( ! $this->upload->do_upload('profile_pic')) {
								unset($data['profile_pic']);
							}
							else {
								$upload_data = $this->upload->data();
								$data['username'] = $this->session->userdata('logged_in_adminw')['username'];
								$data['profile_picture'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
								if($id == $this->session->userdata('logged_in_adminw')['id']) {
									$this->session->set_userdata('profile_pic',$data['profile_picture']);
									
								}
							}
						
							
							$result = $this->Profile_model->update_admin_profile($data, $id);
							}
                            $template['data'] = $this->Profile_model->get_admin_profile_details($id);
						    $this->load->view('template', $template);
	              }
				  
				  
}	
				  
	