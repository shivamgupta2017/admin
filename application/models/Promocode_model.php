<?php 

class Promocode_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	//add Promocode
	public function  add_promocode($data){
		
		
		 
			  $result = $this->db->insert('promocode', $data);
		      return $result;
     }
	// view promocode 
	 function get_promocode_details(){
		 $query = $this->db->where('promocode_status','0');
		  $menu = $this->session->userdata('admin');
					if($menu!='1'){						
						$user = $this->session->userdata('id');
						$this->db->where('created_by', $user);
					}
		 $query = $this->db->get('promocode');
		 $result = $query->result();
		 return $result;
	}
	
	public function editget_promocode_id($id){
		 
		 $query = $this->db->where('id',$id);
		 $query = $this->db->get('promocode');
		 $result = $query->row();
		 return $result;
	 }
	 //edit promocode
	 public function edit_promocode($data, $id){
		 
		 $this->db->where('id',$id);
		 $result = $this->db->update('promocode',$data);
		 return Success;		 
	 }
	//delete promocode 
	  public function delete_promocode($id,$data1){
		 
		 $this->db->where('id', $id);
		 $result = $this->db->update('promocode',$data1);
         return $result;
		 
		 
	 }
	
	 
	 public function get_categorydetails() {
		              
					 
				$query = $this->db->get('category');
			    $result = $query->result();
			    return $result; 				
	 }
	 
	 
		 //popup promocode
	 function get_promopopupdetails($id){
	
				$this->db->select('*'); 			
                $this->db->from('promocode');              				
                $this->db->where('id',$id); 
                $query = $this->db->get();			
			    $result = $query->row();	
			    return $result;				
	         }
	 
	 }