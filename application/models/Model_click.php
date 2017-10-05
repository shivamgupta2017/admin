<?php
class Model_click extends CI_Model {

        public function __construct()
        {
                parent::__construct();
        }
 

//user login  
  function login($data){
       
        $email=$data->email;
        $password=$data->password;
                 
         $this->db->where('email',$email);
         $this->db->where('password',$password);
         $query=$this->db->get('customer_registration');
         $query=$query->row();

         return $query;
     
  } 
  
 //user registration
  
      function user_registration($data) {

		$data['password']=md5($data['password']);
		$result = $this->db->insert('customer_registration', $data);
		return $result;
	}
    
	
	function loginuser1($username, $password) {
			   
			 
			                 $this->db->where('username',$username);					 
							 $this->db->where('password',$password);							 
							 $query=$this->db->get('admin');
							 $query_value=$query->row();

							        if ($query -> num_rows() == 1) {
									return $query_value;
								    }
}
}