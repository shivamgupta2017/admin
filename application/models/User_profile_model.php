<?php 

class User_profile_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	
		  function update_user_password($data, $id) {
		
				$this->db->select("count(*) as count");
				$this->db->where("password",$data['password']);
				$this->db->where("id",$id);
				$this->db->from("user");
				$count = $this->db->get()->row();
					//var_dump($count);
				if($count->count == 0) {
					return "notexist";
				}
				else {
					
					$update_data['password'] = $data['n_password'];
					$update_data['confirm_password'] = $data['n_password'];
					$this->db->where('id', $id);
					$result = $this->db->update('user', $update_data); 
			   
					if($result) {
						return true;
					}
					else {
						return false;
					}
				}
			}
			 function get_single_profile_details($id) {
		  
		  
					$query = $this->db->where('id', $id);
					$query = $this->db->get('user');	
					$result = $query->row();
					return $result;
					
	      }
			
		   
			
	       function update_user_profile($data, $id) {

						/*$this->db->select("count(*) as count");
						$this->db->where("username",$data['username']);						
						$this->db->where("id !=",$id);
						$this->db->from("user");
						$count = $this->db->get()->row();
						if($count->count > 0) {
							return "exist";
						}
						else {

									$this->db->where('id', $id);
									$result = $this->db->update('user', $data); 									
						
							
							if($result) {
								return true;
							}
							else {
								return false;
							}
						}*/

						$this->db->select("count(*) as count");
						$this->db->where("username",$data['username']);
						
						$this->db->where("id !=",$id);
						$this->db->from("user");
						$count = $this->db->get()->row();
						if($count->count > 0) {
							return "exist";
						}
						else {

									$this->db->where('id', $id);
									$result = $this->db->update('user', $data); 									
							if($result) {
								return true;
							}
							else {
								return false;
							}
						}
             }
}
?>