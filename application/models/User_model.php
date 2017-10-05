<?php 

class User_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
// view user details	
	 public function get_user_details(){
		 
		         $this->db->select('user.*, shopper.store_name');
			     $this->db->from('{PRE}user' );
			     $this->db->join('{PRE}shopper', '{PRE}shopper.id = {PRE}user.store_id','left');
			     $this->db->group_by("{PRE}user.id");
				 $query = $this->db->where('user_status','1'); 
				 
				 $query = $this->db->get();
			     $result = $query->result();
			     return $result;

	 }
	 
	 function get_rolevalues()
	 {
		        $query = $this->db->get('{PRE}roles');
		  	    $result = $query->result();
			    return $result; 
	 }
//add user	 
	 public function add_user($data){
		 $data['password'] = md5($data['password']);
		 $result = $this->db->insert('{PRE}user', $data);
		 return $result;
	 }
//edit user	 
	 	public function editget_user_id($id){
		 $query = $this->db->where('id',$id);
		 $query = $this->db->get('{PRE}user');
		 $result = $query->row();
		 return $result;
	 }

	 public function edit_user($data, $id){
		 
	     $this->db->where('id',$id);
		 $result = $this->db->update('{PRE}user',$data);
		 return $result; 
	 }
	
//delete user	 
	 public function delete_user($id,$data1){
		 
		 $this->db->where('id',$id);
				 $result = $this->db->update('{PRE}user',$data1);
				 return $result;
		 
		 
	 }
//popup user details	 
	 public function view_popup_userdetails($id){
		  
		
		         $this->db->select('user.*, shopper.store_name');
			     $this->db->from('{PRE}user' );
			     $this->db->join('{PRE}shopper', '{PRE}shopper.id = {PRE}user.store_id','left');
			     $this->db->group_by("{PRE}user.id");
				 $this->db->where('{PRE}user.id', $id);
				 
				 $query = $this->db->get();
			     $result = $query->row();
			     return $result;
	 }
		 
	public function get_store() {
		              			 
				$query = $this->db->get('{PRE}shopper');
			    $result = $query->result();
			    return $result; 				
	 } 
}
?>
	