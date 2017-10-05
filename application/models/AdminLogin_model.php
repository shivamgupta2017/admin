<?php 

class AdminLogin_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
 	}
	
	
	public function login($username, $password) {			   
		     //if($_POST['as']=='admin')

			                 $this->db->where('username',$username);					 
							 $this->db->where('password',$password);							 
							 $query=$this->db->get('{PRE}admin');
							 $query_value=$query->row();
							 $query_value->settings = $this->db->get('{PRE}settings')->row();
							    if ($query -> num_rows() == 1) 
							    {
									return $query_value;
								}
             
  //              else
  //              {
							 
		// 				 //$this -> db -> where('user_status', '1');
		// 	          	  $this->db->where('username',$username);					 
		// 			      $this->db->where('password',$password);				 
		// 				  $query=$this->db->get('shopper');
		// 				  $query_value=$query->row();					 				   
		// 						   if ($query -> num_rows() == 1) 
		// 						   {
		// 						   return $query_value;
		// 						   }
								   
		// 						   else
									   
		// 						   	 {
		//   //$this -> db -> where('user_status', '1');
		// 	          	  $this->db->where('username',$username);					 
		// 			      $this->db->where('password',$password);				 
		// 				  $query=$this->db->get('user');
		// 				  $query_value=$query->row();					 				   
		// 						   if ($query -> num_rows() == 1) 
		// 						   {
		// 						   return $query_value;
		// 						   }
	 //            }
													
		// }
					 
     }
	
}