<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_ctrl extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set("Asia/Kolkata");
			 $this->load->model('basic');
		   	 $this->load->database();
			if(!$this->session->userdata('logged_in_adminw1')) { 
			redirect(base_url());
		}
	}

function add_products()
{

 				if($_POST)
 				{
 					  $data = $this->basic->get_post_data();
					  $config = set_upload_options_product('assets/uploads/product');
				      $new_name = time()."_".$_FILES["image"]['name'];
				      $config['file_name'] = $new_name;
				      $data['image'] = $new_name;
					  $this->upload->initialize($config);
							 if(empty($_FILES['image']['name'])){
				                 $data['image'] = '1501061396_default.png';
							 }
							 else
							 {
							     if ( ! $this->upload->do_upload('image')) 
							 {
								$this->session->set_flashdata('message', array('message' => "Display Picture : ".$this->upload->display_errors(), 'title' => 'Error !', 'class' => 'danger'));
							  }
							 }
							 $temp['product_name'] = $data['product_name'];
							 $temp['product_image'] = $data['image'];
							 $temp['product_description'] = $data['details'];
					  		 $this->basic->insert_data('{PRE}products',$temp);
					  		 $data['product_id'] = $this->db->insert_id();
				             $data2 = array();
				             $data2['purchase_price']=$data['purchase_price'];
				             $data2['selling_price']=$data['selling_price'];
				             $data2['tax']=$data['tax_type'];
				             $data2['weight']=$data['weight'];
				             $data2['product_id']=$data['product_id'];
				             $data2['unit_name']=explode("&",$data['unit'])[1];
				             $data2['unit_id'] = explode("&", $data['unit'])[0];
				             //$data2['max_limit'] = $data['max_quantity'];
	   					     $result = $this->db->insert('{PRE}product_price',$data2);
 							if($result)
							{	
									$this->session->set_flashdata('message',array('message' => 'Add Products Details successfully','class' => 'success'));
									redirect('Product_ctrl/add_products/', 'refresh');
							}
							else
							{
									$this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));
									redirect('Product_ctrl/add_products', 'refresh');
							}	
				}
 				 		  $template['unit'] = $this->basic->get_data('{PRE}unit_of_product','','*');
 						  $template['tax'] = $this->basic->get_data('{PRE}tax','','*');
	 				 	  $template['page'] = 'product/clickkart_product';
			          	  $template['page_title'] = 'category';
                       	  $userdetails=$this->session->userdata('logged_in_adminw'); 
				          $this->load->view('template',$template);
 }
 	public function view_product()
 	{	


 						$template['data'] = $this->basic->get_data('{PRE}products','','*');
	 					$template['page'] = 'product/view_product';
			          	$template['page_title'] = 'category';
			          	//print_r(json_encode($template['data'])); die;

				        $this->load->view('template',$template);
 	}
 	public function view_product_popup()
 	{
 				  	$data = $this->basic->get_post_data();
 				   	$where['where'] = array('{PRE}products.product_id'=>$data['prodetails']);
 				    $join = array('{PRE}product_price'=>'{PRE}products.product_id = {PRE}product_price.product_id,inner');
 					$template['data'] = $this->basic->get_data('{PRE}products',$where,'{PRE}product_price.*, {PRE}products.*', $join);
	 				$template['page'] = 'product/view_product';
			        $template['page_title'] = 'category';
				    $this->load->view('product/product-popup',$template);
 	}
 	function delete_pro()
    {
				  $data1 = array(
						  "is_deleted" => '1'
									 );
				  $id = $this->uri->segment(3);
				  $is_deleted=	$this->uri->segment(4);
				  if($is_deleted==0)
				  {
				  	$result = $this->basic->set_deleted('{PRE}products',array('product_id'=>$id));
				  }
				  else
				  {
				  	$result = $this->basic->retrieve_deleted('{PRE}products',array('product_id'=>$id));
				  	
				  }
				 
				  $this->session->set_flashdata('message', array('message' => 'Deleted Successfully','class' => 'success'));
				  redirect(base_url().'Product_ctrl/view_product');
   }
// edit product

 function edit_pro()
  {





				  $template['page'] = 'product/editpro_view';
				  $template['title'] = 'Edit products';  
			      $id = $this->uri->segment(3);
			      $template['unit'] = $this->basic->get_data('{PRE}unit_of_product','','*');
      			  $join = array('{PRE}product_price'=>'{PRE}product_price.product_id = {PRE}products.product_id,inner');
			      $template['data'] = $this->basic->get_data('{PRE}products',array('where'=>array('{PRE}products.product_id'=>$id)), '*', $join);

			      //print_r(json_encode($template)); die;


		   	      if(!empty($template['data']))
		   	      {
					if($_POST)
					{

 						$data = $this->basic->get_post_data();
						



 					//	$data1= array_slice($data,5);
					  	//$data= array_slice($data,0,4);

					  	$config = set_upload_options_product('assets/uploads/product');
							

							if(! empty($_FILES["image"]['name']))
							{
						      	$new_name = time()."_".$_FILES["image"]['name'];
						      	$config['file_name'] = $new_name;
						      	$data['image'] = $new_name;
							  	$this->upload->initialize($config);
								$this->upload->do_upload('image');
							}



							 $temp['product_name'] = $data['product_name'];
							 $where = array('product_id'=>$id);
					  		 $this->basic->update_data('{PRE}products',$where,$temp);
					  		 $removed = array_shift($data);
					  		 $data['tax']= $data['total_tax'];
					  		 $temp=explode('&',$data['unit']);
					  		 $data['unit_id']=$temp[0];
					  		 $data['unit_name']=$temp[1];
					  		 unset($data['total_tax']);
					  		 unset($data['unit']);
					  		 unset($data['product_description']);
					  		 $where = array('product_id'=>$id);
					  		 $result=$this->basic->update_data('{PRE}product_price',$where,$data);
			                 $data2 = array();
 							if($result)
							{
									$this->session->set_flashdata('message',array('message' => 'Add Products Details successfully','class' => 'success'));
							}
							else
							{
									$this->session->set_flashdata('message', array('message' => 'Error','class' => 'error'));
							}	
					}
				  }
				  else
				  {
					   $this->session->set_flashdata('message', array('message' => "You don't have permission to access.",'class' => 'danger'));	
			           redirect(base_url().'Home_ctrl/edit_pro/'.$id);
				  }
			$this->load->view('template',$template);		   		   	  
  }
  public function selected_unit(){
      $param = $this->basic->get_post_data();
      $join = array('{PRE}unit_of_product'=>'{PRE}unit_product_mapping.unit_id = {PRE}unit_of_product.unit_product_id,inner');
      $data = $this->basic->get_data('{PRE}unit_product_mapping',array('where'=>array('product_id'=>$param['id'])),'*',$join);
      print_r(json_encode($data));
  }
 } 

 ?>