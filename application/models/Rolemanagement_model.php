<?php 

class Rolemanagement_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	    function get_table_where( $select_data, $where_data,$table)
			  {
					
					$this->db->select($select_data);
					if($where_data!=0){
					$this->db->where($where_data);
					}
					$query  = $this->db->get($table);  //--- Table name = User
					$result = $query->result_array(); 
					return $result;	
			   }


      function  view_permission($id)
			  {
					  $select_data = "*"; 
						if($id!=0){
						$where_data = array(	// ----------------Array for check data exist ot not
							'role_id'     => $id
						);
						}else{
							$where_data = '';
						}
						
						$table = "ot_role_permission";  //------------ Select table
						$result = $this->get_table_where( $select_data,$where_data, $table );
						
						 // check if user exist or not
						return $result;
						
			 }  
			 
	  function  num_rows($id)
			   {
					 $select_data = "*"; 
						if($id!=0){
						$where_data = array(	// ----------------Array for check data exist ot not
							'role_id'     => $id
						);
						}else{
							$where_data = '';
						}
						
						$table = "ot_role_permission";  //------------ Select table
						$results = $this->get_table_where( $select_data,$where_data, $table );
						
						 // check if user exist or not
					
							return count($results);
						
			   } 
			   
	     function view_roles()
			   {
				 $select_data = "*"; 
						
							$where_data = '';
						
						
						$table = "ot_role";  //------------ Select table
						$result = $this->get_table_where( $select_data,$where_data, $table );
						
						 // check if user exist or not
				
							return $result;
						
			   }
			   
			   
	     function add_roles($data){
		
					$result = $this->db->insert('ot_role',$data);
					return $result;  
		 }
		 
		 
		 function delete_table($table, $where_data){
	                 $this->db->delete($table, $where_data); 
         }
		 

	     function delete_role($data){
			 
				   $id = $data['rolename'];
				   $table = 'ot_role';
				   $where_data = array( 'r_id' => $id );
				   $this->delete_table($table, $where_data);
			   }
	      
		  
		    function updaterole($data)
				 {
					
					$role =$data['role_id'];
				
				$role_permission = $data['page_id'];
				$selects =$this->db->query("select * from ot_role_permission where role_id ='$role' "); 
				$result = $selects->row(); 
				if(count($result) == 0) {
					$user_countries = array(
			'role_id' => $role,
			'page_id' => $role_permission

			);
					if( $this->db->insert('ot_role_permission',$user_countries)){
						echo 1;
					}else{
						echo 2;
					}
				} else{
					
					
					
				 $this->db->where('role_id',$role);
				 
				 if($this->db->update('ot_role_permission',$data)){
				
					echo 3;
				}else{
					echo 4;
				}
					 
				}

			}
			   
}			   
?>