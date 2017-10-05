<?php 

class Category_model extends CI_Model {
	
	public function _consruct()
	{
		parent::_construct();
 	}
	//add category 
	public function  category_add1($data)
	{
		 
		$result = $this->db->insert('{PRE}category', $data);
		return $result;
    }
	//view category 
	function get_category_details()
	{
				 $query = $this->db->where('category_status','1');
				 
				 $menu = $this->session->userdata('admin');
							if($menu!='1')
							{						
								$user = $this->session->userdata('id');
								$this->db->where('created_by', $user);
							}
				 $query = $this->db->get('{PRE}category');
				 $result = $query->result();
				 return $result;
	}
	
	public function editget_category_id($id)
	{
				 $query = $this->db->where('id',$id);
				 $query = $this->db->get('{PRE}category');
				 $result = $query->row();
				 return $result;
	}
	 // edit category
	 public function edit_category($data, $id)
	 {
		 
				 $this->db->where('id',$id);
				 $result = $this->db->update('{PRE}category',$data);
				 return Success;			 
	 }
	 //delete category
	  public function delete_category($id,$data1)
	  {
		 
				 $this->db->where('id',$id);
				 $result = $this->db->update('{PRE}category',$data1);
				 $this->db->where('category_id',$id);
				 $result1 = $this->db->delete('{PRE}sub_category');
				 return $result;
		 
		 
	  }
	 //popup categorys
	 function get_catpopupdetails($id)
	  {
	
				$this->db->select('*'); 			
                $this->db->from('{PRE}category');              				
                $this->db->where('id',$id); 
                $query = $this->db->get();			
			    $result = $query->row();	
			    return $result;				
	  }
	 //add sub category
	 function add_subcat($data)
	 {
		 
			  $result = $this->db->insert('{PRE}sub_category', $data);
		      return $result;
     }
	 
	 public function get_categorydetails() 
	 {
		              
				 $query = $this->db->where('category_status','0');	 
				$query = $this->db->get('{PRE}category');
			    $result = $query->result();
			    return $result; 				
	 }
	 //view sub category
	 public function get_sub_categorydetails() 
	 {
		              
				$this->db->select('sub_category.*, category.category_name');
			    $this->db->from('{PRE}sub_category' );
			    $this->db->join('category', 'sub_category.category_id = category.id','left');
			    //$this->db->join('sub_category', 'products.sub_cat_id = sub_category.id','left');
				$query = $this->db->where('sub_category.sub_cat_status','0');
				$query = $this->db->where('category.category_status','0');
				  
				  $menu = $this->session->userdata('admin');
					if($menu!='1')
				   		{						
						$user = $this->session->userdata('id');
						$this->db->where('sub_category.created_by', $user);
						}
				$query = $this->db->get();	 
				//$query = $this->db->get('products');
			   	$result = $query->result();
			    return $result; 				
	  }
	 //delete subcategory
	 public function delete_subcategory($id,$data1)
	 {
		 
				 $this->db->where('id', $id);
				 $result = $this->db->update('{PRE}sub_category',$data1);
				 return $result;
		 
		 
	 }
	 
	 
	 
	 
	 public function editget_subcat_id($id)
	 {
		 
				 $query = $this->db->where('id',$id);
				 $query = $this->db->get('{PRE}sub_category');
				 $result = $query->row();
				 return $result;
	 }
	//edit sub category 
	 public function edit_subcat($data, $id)
	 {
				 
				 $this->db->where('id',$id);
				 $result = $this->db->update('{PRE}sub_category',$data);
				 return Success;		 
	 }
	  public function get_category1() 
	  {
		
				$query = $this->db->get('{PRE}category');
			    $result = $query->result();
			    return $result; 				
	  }
	 
	 
	 public function get_sub_categorydetails1() 
	 {
		
				$query = $this->db->get('{PRE}category');
			    $result = $query->result();
			    return $result; 				
	 }
	  
	 //popup subcategory
	 function get_subcatpopupdetails($id)
	 {
		 
	      
				       
				 $this->db->select('sub_category.*, category.category_name');
			     $this->db->from('{PRE}sub_category' );
			     $this->db->join('category', 'sub_category.category_id = category.id','left');
			     $this->db->where('sub_category.id',$id);
				 $query = $this->db->get();	 
				//$query = $this->db->get('products');
			     $result = $query->row();
			     return $result; 				
	 } 
	 
	 //add product
	 function add_product($data)
	 {
			     $result = $this->db->insert('{PRE}products', $data);
		         return $result;
     }
	 //view products
	  public function get_product_details() 
	  {
		              
				 $this->db->select('products.*, category.category_name,sub_category.sub_cat_name');
			     $this->db->from('{PRE}products' );
			     $this->db->join('category', 'products.category_id = category.id','left');
			     $this->db->join('sub_category', 'products.sub_cat_id = sub_category.id','left');
			
				 
				  $menu = $this->session->userdata('admin');
						  if($menu!='1')
						    {						
								$user = $this->session->userdata('id');
								$this->db->where('products.created_by', $user);
							}
				 $query = $this->db->get();	 
			     $result = $query->result();
			     return $result; 				
	  }
	 //delete product
	 public function delete_product($id,$data1)
	 {
				 
				 $this->db->where('id', $id);
				 $result = $this->db->update('{PRE}products',$data1);
				 return $result;
				 
		 
	 }
	 public function editget_pro_id($id)
	 {
		 
				 $query = $this->db->where('id',$id);
				 $query = $this->db->get('{PRE}products');
				 $result = $query->row();
				 return $result;
	 }
	 //edit product
	 public function edit_pro($data, $id)
	 {
		 
				 $this->db->where('id',$id);
				 $result = $this->db->update('{PRE}products',$data);
				 return Success;		 
	 }
	  public function get_category()
	 {
		
				$query = $this->db->get('{PRE}category');
			    $result = $query->result();
			    return $result; 				
	 }




	  public function get_sub_category($id)
	 {
		    	
		    	$this->db->where('category_id', $id);
				$query = $this->db->get('{PRE}sub_category');
			    $result = $query->result();
			    return $result; 				
	 }
	 public function get_discount() 
	 {
		
				$query = $this->db->get('{PRE}discount');
			    $result = $query->result();
			    return $result; 				
	 }
	 
	  //popup product
	 function get_propopupdetails($id)
	 {
		 
	      
			     $this->db->select('products.*, category.category_name,sub_category.sub_cat_name');
			     $this->db->from('{PRE}products' );
			     $this->db->join('category', 'products.category_id = category.id','left');
			     $this->db->join('sub_category', 'products.sub_cat_id = sub_category.id','left');
				 $this->db->where('products.id',$id);
				 $query = $this->db->get();	 
				//$query = $this->db->get('products');
			     $result = $query->row();
			     return $result; 			
	         } 
	         public function active_deactive($id) 
	 {          
	           $this->db->select('product_status');
	           $this->db->from('{PRE}products');
	           $query = $this->db->where('id',$id);
	           $status = $query->get()->row();
	          if($status->product_status=='1'){$data['product_status']='0';$result = 'deactived';}else{$data['product_status']='1';$result = 'actived';}
		        $this->db->where('id',$id);
			    $this->db->update('{PRE}products',$data);
			    return $result; 				
	 }
	 public function get_unit($id=''){
	     if($id==''){
	     $this->db->select('*');
	     $this->db->from('{PRE}unit_of_product');
	     }else{
	           $this->db->select('unit');
	           $this->db->from('{PRE}products');
	           $this->db->where('id',$id);
	     }
	     $result = $this->db->get()->result();
	     return $result;
	     
	 }
	 public function get_tax(){
	     return $this->db->select('*')->from('{PRE}tax')->get()->result();
	 }
	 public function selected_tax($id){
	     return $this->db->select('tax_id')->from('{PRE}products')->where('id',$id)->get()->row();
	 }
}