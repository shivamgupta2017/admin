<?php 

class Roles_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}

/*--------------------------------------
***** Update Role details *****
--------------------------------------*/
	function get_roles() {
		
		$this->db->where("id > ",0);
		return $this->db->get("roles")->result();
	}

/*--------------------------------------
***** Get single Role details *****
--------------------------------------*/
	function get_single_role($id) {
		
		$this->db->where('id', $id);
		$query = $this->db->get('roles');
		$result = $query->row();
		
		return $result;
		
	}

/*--------------------------------------
***** Save single Role details *****
--------------------------------------*/
	function update_roles($data, $id) {
			
	   $this->db->where('id', $id);
	   $result = $this->db->update('roles', $data); 
	   
	   return $result;
	}
	
	function add_rolename($data){
	  
         $result = $this->db->insert('roles', $data);
         return $result;		 
	}

}