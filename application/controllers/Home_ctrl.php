
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_ctrl extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('zoho_invoice');
		date_default_timezone_set("Asia/Kolkata");
		
		    $this->load->model('Category_model');
		    $this->load->model('Package_model');
			if(!$this->session->userdata('logged_in_adminw1')) { 
			redirect(base_url());
		}
	}

	
	//display home page
function view_home()
   {
			 
				  $template['page'] = 'Login/clickkart_home';
				  $template['page_title'] = 'Home';
				  $this->load->view('template',$template);
		 
   }
	  //add new category
	  
 function add_category()
	{
		  
		           $template['page'] = 'category/clickkart_category';
			       $template['page_title'] = 'category';
                   $sessid=$this->session->userdata('logged_in_adminw');
				   //$userid=$userdetails['id'];	
				   
		   
						 if($_POST) 
						  {
							  
						      $data = $_POST;
				 
				 	 
							  $config = set_upload_optionscategory('uploads/categories');
						      //$this->load->library('upload');
						
						      $new_name = time()."_".$_FILES["image"]['name'];
						      $config['file_name'] = $new_name;

							  $this->upload->initialize($config);
								
								if ( ! $this->upload->do_upload('image')) 
								  {
									
									$this->session->set_flashdata('message', array('message' => "Display Picture : ".$this->upload->display_errors(), 'title' => 'Error !', 'class' => 'danger'));
									
								  }
				  else 
				  {
					
				   $upload_data = $this->upload->data();
				   $data['image'] = "categories/".$upload_data['file_name']; 
			
			       $data['created_by']=$sessid['created_user'];
				   $result = $this->Category_model->category_add1($data);
				  
				          if($result) 
				          {
						/* Set success message */
						  $this->session->set_flashdata('message',array('message' => 'Add Category Details successfully','class' => 'success'));
					      }
					      else 
						  {
						/* Set error message */
						  $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));  
		                  }
				  }	
				 redirect(base_url().'Home_ctrl/view_category'); 
				 }
		         $this->load->view('template',$template);
		 
	  
	}
	  
  function view_category()
    {
		 
			  $template['page'] = 'category/view_category';
		      $template['page_title'] = 'category';
			  //var_dump($template); exit;
			  $template['data'] = $this->Category_model->get_category_details();		  
			  $this->load->view('template',$template);
		
	  }
	  
	//edit category
	
  function edit_cat()
    {
			  $template['page'] = 'category/editcat_view';
			  $template['title'] = 'Edit category';
			  $userdetails=$this->session->userdata('logged_in_adminw'); 
		      $userid=$userdetails['id'];
			  $id = $this->uri->segment(3);
			  $template['data'] = $this->Category_model->editget_category_id($id);
			  if(!empty($template['data'])){
		         
				  if($_POST)
				  { 
						  $data = $_POST;					 					 
						  $data['user_id']=$userid;							   
						 
						  
			//upload image			  
						  	 
						  $config = set_upload_optionscategory('uploads/categories');
					     
					
					      $new_name = time()."_".$_FILES["image"]['name'];
					      $config['file_name'] = $new_name;

						  $this->upload->initialize($config);
								
								if ( ! $this->upload->do_upload('image')) 
								  {
									
									$this->session->set_flashdata('message', array('message' => "Display Picture : ".$this->upload->display_errors(), 'title' => 'Error !', 'class' => 'danger'));
									
								  }
							   else 
								  {
									
								  $upload_data = $this->upload->data();
								  $data['image'] = "categories/".$upload_data['file_name']; 
							      }
		 
			  
			           $result = $this->Category_model->edit_category($data, $id);				 
				       redirect(base_url().'Home_ctrl/view_category');
				  }
		         }
				 else{
					  $this->session->set_flashdata('message', array('message' => "You don't have permission to access.",'class' => 'danger'));	
			          redirect(base_url().'Home_ctrl/view_category');
				 }
			
			 	$this->load->view('template',$template);	  
	  
     }
	  //delete category
function delete_cat()
    {
		  
				  $data1 = array(
						  "category_status" => '1'
									 );
						  $id = $this->uri->segment(3);		   
				  $result = $this->Category_model->delete_category($id,$data1);
				  $this->session->set_flashdata('message', array('message' => 'Deleted Successfully','class' => 'success'));
				  redirect(base_url().'Home_ctrl/view_category');
	 }
	//popup category  
 public function catdetails_view()
     {
		
		           $id=$_POST['getcatdetails'];
		           $template['data'] = $this->Category_model->get_catpopupdetails($id);
		           $this->load->view('category/cat-popup',$template);
			 
     } 
	  //add sub category
 public function add_sub_category()
	 {
		  
		 		   $template['page'] = 'category/clickkart_subcategory';
			       $template['page_title'] = 'subcategory';
                   $sessid=$this->session->userdata('logged_in_adminw');
				  //$userid=$userdetails['id'];	
					  if($_POST) 
					    {
							  
						  $data = $_POST;										 
						  $config = set_upload_options_subcategory('uploads/subcategory');
					      $new_name = time()."_".$_FILES["image"]['name'];
					      $config['file_name'] = $new_name;
						  $this->upload->initialize($config);				
								if ( ! $this->upload->do_upload('image')) 
								  {
									
									$this->session->set_flashdata('message', array('message' => "Display Picture : ".$this->upload->display_errors(), 'title' => 'Error !', 'class' => 'danger'));
									
								  }
								  else 
								  {
									
								  $upload_data = $this->upload->data();
								  $data['image'] = $config['upload_path']."/".$upload_data['file_name']; 
							      $data['created_by']=$sessid['created_user'];
							      $result = $this->Category_model->add_subcat($data);
										 if($result)
										 {
											  $this->session->set_flashdata('message',array('message' => 'Add Subcategory Details successfully','class' => 'success'));
										 }
										 else
										 {
											 $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));
										 }			 
				
				  			  
				 
				  				  }         
		  						  redirect(base_url().'Home_ctrl/add_sub_category');
	  }
								   $template['catresult'] = $this->Category_model->get_categorydetails();
								   $template['sub_catresult'] = $this->Category_model->get_sub_categorydetails();
								   $this->load->view('template',$template);
	  

}

//view subcategory

function view_subcategory()
   {
		 
				  $template['page'] = 'category/view_subcategory';
				  $template['page_title'] = 'subcategory';
				  //var_dump($template); exit;
				  $template['data'] = $this->Category_model->get_sub_categorydetails();
				  $this->load->view('template',$template);
				  //$this->load->view('view_employ');	
   }
// delete subcategory
function delete_subcat()
   {
				  $data1 = array(
						  "sub_cat_status" => '1'
									 );
				  $id = $this->uri->segment(3);
				  $result = $this->Category_model->delete_subcategory($id,$data1);
				  $this->session->set_flashdata('message', array('message' => 'Deleted Successfully','class' => 'success'));
				  redirect(base_url().'Home_ctrl/view_subcategory');
   }
	  
//edit subcategory
 function edit_subcat()
 {
				  $template['page'] = 'category/editsubcat_view';
				  $template['title'] = 'Edit subcategory';
				  $userdetails=$this->session->userdata('logged_in_adminw'); 
			      $userid=$userdetails['id'];
				  
				  $id = $this->uri->segment(3);
				  $template['data'] = $this->Category_model->editget_subcat_id($id);
		          if(!empty($template['data'])){
         
						  if($_POST)
						  {
							 $data = $_POST;			 
							 $data['user_id']=$userid;	
						     $data['user_id']=$userid;	
								  
					//upload image			  
								 			 
							$config = set_upload_options_subcategory('uploads/subcategory');
							      //$this->load->library('upload');
							
						    $new_name = time()."_".$_FILES["image"]['name'];
							$config['file_name'] = $new_name;
						    $this->upload->initialize($config);
								
								 if ( ! $this->upload->do_upload('image')) 
								  {
									
									$this->session->set_flashdata('message', array('message' => "Display Picture : ".$this->upload->display_errors(), 'title' => 'Error !', 'class' => 'danger'));
									
								  }
								  else
								   {
									
								  $upload_data = $this->upload->data();
								  $data['image'] = "categories/".$upload_data['file_name']; 
								   }
		  
			  
			 	  $result = $this->Category_model->edit_subcat($data, $id);				 
				  redirect(base_url().'Home_ctrl/view_subcategory');
			
		   }
				  }
				  else{
					   $this->session->set_flashdata('message', array('message' => "You don't have permission to access.",'class' => 'danger'));	
			           redirect(base_url().'Home_ctrl/view_subcategory');
				  }
				
				 $template['result'] = $this->Category_model->get_category1(); 
	             // $template['result1'] = $this->Category_model->get_sub_category();
			     $template['sub_catresult'] = $this->Category_model->get_sub_categorydetails();
				 $this->load->view('template',$template);			   	  
	  
   }
//popup subcategory  
 public function subcatdetails_view()
   {
		
	           $id=$_POST['subcatdetails'];
	           $template['data'] = $this->Category_model->get_subcatpopupdetails($id);
	           $this->load->view('category/subcat-popup',$template);
		 
   } 
//to add products
 function add_products()
   {
	 			   $template['page'] = 'product/clickkart_product';
			       $template['page_title'] = 'category';
                   $sessid=$this->session->userdata('logged_in_adminw'); 
				    //$userid=$userdetails['id'];
					   if($_POST)
					    {
					  $data = $_POST;
					 $data1= array_slice($data,8);
					  $data= array_slice($data,0,7);
				
		              //$data[0]['final_price'] = $data['price'] - $data[0]['discount_amount'];
		//upload image			  
					  $config = set_upload_options_product('assets/uploads/products');
				      //$this->load->library('upload');
				
				      $new_name = time()."_".$_FILES["image"]['name'];
				      $config['file_name'] = $new_name;

					  $this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image')) 
							  {
								
								$this->session->set_flashdata('message', array('message' => "Display Picture : ".$this->upload->display_errors(), 'title' => 'Error !', 'class' => 'danger'));
								
							  }
							  else 
							  {
								
							  $upload_data = $this->upload->data();
							  $data['image'] = $config['upload_path']."/".$upload_data['file_name']; 
						  	  $data['created_by']= $sessid['created_user'];
						  	  $data['final_price'] = $data1['price'.'1'];
						  	  $data['item_id'] = $this->zoho_invoice->create_item($data);
						 	  $this->Category_model->add_product($data);
						 	  $id = $this->db->insert_id();
				              $data2 = array();
						 	  for ($i = 1; $i < $data1['option_count']; $i++) {
					                $data2['product_id'] = $id; 
 				            	    $data2['unit_id']      = $data1['option_id' . $i];
					                $data2['price']          = $data1['price' . $i];
					                $data2['weight']          = $data1['weight' . $i];
					                $data2['max_limit']          = $data1['max_quantity' . $i];
					                $result = $this->db->insert('{PRE}unit_product_mapping',$data2);
				            }
						 	  
						 	  
									 if($result)
									 {
										  $this->session->set_flashdata('message',array('message' => 'Add Products Details successfully','class' => 'success'));
									 }
									 else
									 {
										 $this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));
									 }			 
				 
				               }         
		 redirect(base_url().'Home_ctrl/add_products');
	  }
							   $template['catresult'] = $this->Category_model->get_categorydetails();
							   $template['tax'] = $this->Category_model->get_tax();
							   $template['unit'] = $this->Category_model->get_unit();
							   $template['sub_catresult'] = $this->Category_model->get_sub_category($template['catresult'][0]->id);
							   $template['discount'] = $this->Category_model->get_discount();
							   $this->load->view('template',$template);
 }


 //Add Select Box Ralated Values Get in sub category 
 public function add_categorydetailsget()
	 { 	  
			          if($_POST)
			          {		  
					  $data = $_POST;			  
					  //array_walk($data, "remove_html");
					  
					  $id=$_POST['value'];
					  $result = $this->Category_model->get_sub_category($id);
					  $template['results'] = '';
					  		foreach($result as $sub_cat)
					         {  
						        $template['results'] .= '<option value="'.$sub_cat->id.'">'. $sub_cat->sub_cat_name.' </option>';
					         }							
							 echo $template['results'];
	          			}
	  }
 
 //view all products
  function view_product()
    {
				 
				 $template['page'] = 'product/view_product';
				 $template['page_title'] = 'products';
				 $template['data'] = $this->Category_model->get_product_details();
				 $this->load->view('template',$template);
					
	}
	  
// delete products
function delete_pro()
    {
				  $data1 = array(
						  "is_deleted" => '1'
									 );
				  $id = $this->uri->segment(3);
				  $result = $this->Category_model->delete_product($id,$data1);
				  $this->session->set_flashdata('message', array('message' => 'Deleted Successfully','class' => 'success'));
				  redirect(base_url().'Home_ctrl/view_product');
   }
// edit product

 function edit_pro()
  {
				  $template['page'] = 'product/editpro_view';
				  $template['title'] = 'Edit products';
				  $userdetails=$this->session->userdata('logged_in_adminw'); 
			      $userid=$userdetails['id'];		  
			      $id = $this->uri->segment(3);
			      $template['data'] = $this->Category_model->editget_pro_id($id);
	              $template['result'] = $this->Category_model->get_category(); 
	              $template['tax'] = $this->Category_model->get_tax();
	              $template['selected_tax'] = $this->Category_model->selected_tax($id);
	              $template['unit'] = $this->Category_model->get_unit();
	              $template['selected_unit'] = $this->Category_model->get_unit($id);
	              $template['result1'] = $this->Category_model->get_sub_category($template['data']->category_id);
				  $template['discount'] = $this->Category_model->get_discount();
		   	      if(!empty($template['data'])){
         
					  if($_POST)
					  {
							  $data = $_POST;
					          $data1= array_slice($data,7);
					          $data= array_slice($data,0,7);	
							  $data['user_id']=$userid;					   
				//upload image			  
							  $config = set_upload_options_product('assets/uploads/products');
						      //$this->load->library('upload');
						
						      $new_name = time()."_".$_FILES["image"]['name'];
						      $config['file_name'] = $new_name;

							  $this->upload->initialize($config);
				                    if(!empty($_FILES["image"]['name'])){
									if ( ! $this->upload->do_upload('image')) 
									{
										$this->session->set_flashdata('message', array('message' => "Display Picture : ".$this->upload->display_errors(), 'title' => 'Error !', 'class' => 'danger'));
									  }
									   else
									  {
									    $upload_data = $this->upload->data();
									    $data['image'] = $config['upload_path']."/".$upload_data['file_name']; 
								      }
				                    }
			                         $data2 = array();
						 	  for ($i = 1; $i < $data1['option_count']; $i++) {
 					$data2['unit_id']      = $data1['option_id' . $i];
					$data2['price']          = $data1['price' . $i];
					$data2['weight']          = $data1['weight' . $i];
					$data2['max_limit']          = $data1['max_quantity' . $i];
					$this->db->where(array('product_id'=>$id,'unit_id'=>$data2['unit_id']));
					$temp = $this->db->delete('{PRE}unit_product_mapping');
					    $data2['product_id'] = $id;
					    $result = $this->db->insert('{PRE}unit_product_mapping',$data2);
				}
							      $result = $this->Category_model->edit_pro($data, $id);				 
								  redirect(base_url().'Home_ctrl/edit_pro/'.$id);
			
		               }
				  }
				  else
				  {
					   $this->session->set_flashdata('message', array('message' => "You don't have permission to access.",'class' => 'danger'));	
			           redirect(base_url().'Home_ctrl/edit_pro/'.$id);
				  }
			
			
			$this->load->view('template',$template);		   		   	  
	  
  }
//popup product  
public function prodetails_view()
   {
		
	        $id=$_POST['prodetails'];
	        $template['data'] = $this->Category_model->get_propopupdetails($id);
	        $this->load->view('product/product-popup',$template);
		 
   } 
   public function active_deactive($id)
   {
	         $result = $this->Category_model->active_deactive($id);
	         if($result == 'actived'){
	              $this->session->set_flashdata('message', array('message' => "Succefully Activated",'class' => 'success'));
	              redirect(base_url().'Home_ctrl/view_product');
	         }
	          else if($result == 'deactived'){
	              $this->session->set_flashdata('message', array('message' => "Succefully Deactivated",'class' => 'success'));
	              redirect(base_url().'Home_ctrl/view_product');
	         }
	         else{
	              $this->session->set_flashdata('message', array('message' => "Sorry Unable to perform Operation",'class' => 'danger'));
	        redirect(base_url().'Home_ctrl/view_product');
	         }
   } 
 }
 