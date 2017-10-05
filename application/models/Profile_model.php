<?php 

class Profile_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	 ////Update Password	
	      function update_admin_passwords($data, $id) {
		
				$this->db->select("count(*) as count");
				$this->db->where("password",$data['password']);
				$this->db->where("id",$id);
				$this->db->from("admin");
				$count = $this->db->get()->row();
					//var_dump($count);
				if($count->count == 0) {
					return "notexist";
				}
				else {
					
					$update_data['password'] = $data['n_password'];
					$this->db->where('id', $id);
					$result = $this->db->update('admin', $update_data); 
			   
					if($result) {
						return true;
					}
					else {
						return false;
					}
				}
			}
			
			
		  function get_admin_profile_details($id) {
	
				/*$this->db->select("*");
				$this->db->where('id', $id);
				$this->db->from("admin");
				$query = $this->db->get();
				$result = $query->row();

				return $result;*/
				
				$this->db->select("admin.*,");
				$this->db->where('admin.id', $id);
				$this->db->from("admin");
				$query = $this->db->get();
				$result = $query->row();

				return $result;
        }  
		
		

          function update_admin_profile($data, $id) {
		
						$this->db->select("count(*) as count");
						//$this->db->where("username",$data['username']);
						$this->db->where("id !=",$id);
						$this->db->from("admin");
						$count = $this->db->get()->row();
						if($count->count > 0) {
							return "exist";
						}
						else {

							$this->db->where('id', $id);
							$result = $this->db->update('admin', $data); 
					   
							if($result) {
							return true;
						}
						else {
							return false;
						}
						}	   	
           }		
     
}	