<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_ctrl extends CI_Controller 
{
	public function __construct(){
		parent:: __construct();	
	
	      date_default_timezone_set("Asia/Kolkata");
		  
		  $this->load->model('Settings_model');		  
		  $this->load->library('image_lib');
		  $this->load->library('session');
		  if(!$this->session->userdata('logged_in_adminw1')) 
		  { 
			redirect(base_url());
		  }
	}
   //Add Settings 
    public function view_settings()
	  {

		       $template['page'] = 'Settings/add-settings';
		       $template['page_title'] = 'Add Settings';
			   
			   $id = $this->session->userdata('logged_in_adminw')['id'];

				if($_POST)
				{
							$data = $_POST;
						unset($data['submit']); 
						if(isset($_FILES['logo'])) 
						{  
							$config = set_upload_logo('assets/uploads/logo');
							$this->load->library('upload');
							$new_name = time()."_".$_FILES["logo"]['name'];
							
							$config['file_name'] = $new_name;
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('logo')) 
							{
									unset($data['logo']);
							}
							else 
							{
									$upload_data = $this->upload->data();
									//$data['logo'] = $config['upload_path']."/".$upload_data['file_name'];					
									$data['logo'] = base_url().$config['upload_path']."/".$upload_data['file_name'];	
							}
						}
						if(isset($_FILES['invoice_logo']))
						{
							$config = set_upload_logo('assets/uploads/logo');
							$this->load->library('upload');
							$new_name = time()."_".$_FILES["invoice_logo"]['name'];
							$config['file_name'] = $new_name;
							$this->upload->initialize($config);
							
							if ( ! $this->upload->do_upload('invoice_logo')) 
							{
									unset($data['invoice_logo']);
							}
							else 
							{
									$upload_data = $this->upload->data();
									$data['invoice_logo'] = base_url().$config['upload_path']."/".$upload_data['file_name'];	
									
							}

						}
						if(isset($_FILES['favicon'])) 
						{
							$config = set_upload_favicono('assets/uploads/logo');
							$this->load->library('upload');
							$new_name = time()."_".$_FILES["favicon"]['name'];
							$config['file_name'] = $new_name;
							$this->upload->initialize($config);

							if ( ! $this->upload->do_upload('favicon')) 
							{
								unset($data['favicon']);
							}
							else 
							{
								$upload_data = $this->upload->data();
								//$data['favicon'] = $config['upload_path']."/".$upload_data['file_name'];
								$data['favicon'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
							}
						}



						/* Save category details */
						$result = $this->Settings_model->update_settings($data);
						if($result) 
						{
							/* Set success message */
							$resulttitle = $this->Settings_model->settings_viewings();
							$sess_arrays = array(
							'title' => $resulttitle->title
							);
						 	    $this->session->set_userdata('title1', $sess_arrays);
							    $this->session->set_userdata('id1',$resulttitle->user_id);
							    $this->session->set_userdata('profile_pic1',$resulttitle->logo);

							 $this->session->set_flashdata('message',array('message' => 'Add Settings Details Updated successfully','class' => 'success'));
						}
						else 
						{
							/* Set error message */
							 $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));  
						}


						



				}

					//check here man
					
		    			 



		    			 $template['result'] = $this->Settings_model->settings_viewings(); 
				  		 $this->load->view('template',$template);
				//redirect(base_url().'Business_information/add_Businessinformation');
		    } 

		    public function page_open(){

		    	$path = str_replace('\admin','',APPPATH);
				$path = $path.'config\facebook.php';

								/*<?php
				$config['appId']   = '384079871940470';
				$config['secret']  = '66357561d36deca472870c19c2ce96cd';
				?>*/

				$txt = '<?php ';
				$txt .='$config["appId"] = "384079871940470";'."\r\n";
				$txt .='$config["secret"] = "66357561d36deca472870c19c2ce96cd";'."\r\n";
				$txt .=' ?>';


				$myfile = fopen($path, "w") or die("Unable to open file!");
				echo fgets($myfile);
				//$txt = "ertertertert";
				fwrite($myfile, $txt);
				
				fclose($myfile);


		    }
		
}