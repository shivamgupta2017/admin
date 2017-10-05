<?php 

class Store_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	//add city 
	public function  add_city($data){
		
		
	    $result = $this->db->insert('city', $data);
		return $result;
     }
	//view city 
	 function get_city_details(){
		 $query = $this->db->where('city_status','0');
		  $menu = $this->session->userdata('admin');
					if($menu!='1'){						
						$user = $this->session->userdata('id');
						$this->db->where('created_by', $user);
					}
		 $query = $this->db->get('city');
		 $result = $query->result();
		 return $result;
	}
	
	public function editget_city_id($id){
		 
		 $query = $this->db->where('id',$id);
		 $query = $this->db->get('city');
		 $result = $query->row();
		 return $result;
	 }
	 //edit city
	 public function edit_city($data, $id){
		 
		 $this->db->where('id',$id);
		 $result = $this->db->update('city',$data);
		 return Success;		 
	 }
	 //delete city
	  public function delete_city($id,$data1){
		 
		 $this->db->where('id', $id);
		 $result = $this->db->update('city',$data1);
		 return $result;
		 
		 
	 }
			 //popup city
	 function get_citypopupdetails($id){
	
				$this->db->select('*'); 			
                $this->db->from('city');              				
                $this->db->where('id',$id); 
                $query = $this->db->get();			
			    $result = $query->row();	
			    return $result;				
	         }
	 //add store
	 function add_store($data){
			   $array = $data['city_id'];			   
               $city = implode(",", $array);
               $data['city_id']=$city;
			   $result = $this->db->insert('store', $data);
			 // echo $this->db->last_query();
			 // die();
		return $result;
     } 
	//view store
	
	public function get_store_details() {
		              
					 
				$this->db->select('store.*, city.city_name');
			     $this->db->from('store' );
			     $this->db->join('city', 'store.city_id = city.id','left'); 
				 $query = $this->db->where('store.store_status','0');
				   $menu = $this->session->userdata('admin');
					if($menu!='1'){						
						$user = $this->session->userdata('id');
						$this->db->where('store.created_by', $user);
					}
				 $query = $this->db->get();	 
			    $result = $query->result();
			    return $result; 							
	
	}  
	//delete store
 public function delete_store($id,$data1){
		 
		 $this->db->where('id', $id);
		 $result = $this->db->update('store',$data1);
				 return $result;
		 
		 
	 }	 
	 public function get_storedetails() {
		              
					 
				$query = $this->db->get('city');
			    $result = $query->result();
			    return $result; 				
	 }
	 
	 public function editget_store_id($id){
		 
		 $query = $this->db->where('id',$id);
		 $query = $this->db->get('store');
		 $result = $query->row();
		 return $result;
	 }
	 //edit store
	 public function edit_store($data, $id){
		    $array = $data['city_id'];
			  // var_dump($data);
			   //exit();
               $city = implode(",", $array);
               $data['city_id']=$city;
		    
			   $this->db->where('id',$id);
		 $result = $this->db->update('store',$data);
			   return $result;
		 
		 
	 }
	 		 //popup store
	 function get_storepopupdetails($id){
	
				$this->db->select('store.*, city.city_name');
			     $this->db->from('store' );
			     $this->db->join('city', 'store.city_id = city.id','left');               				
                $this->db->where('store.id',$id); 
                $query = $this->db->get();			
			    $result = $query->row();	
			    return $result;				
	         }
	 }