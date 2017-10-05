<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

class Application extends CI_Controller 
{
	public function __construct() {
        parent::__construct();
		check_installer();
      	$this->load->model('Application_model');
        $this->load->library('email'); 
}


	public function index() {	
			print_r("sdfds");
    	}

	public function check_zip() 
	{
		$p=json_decode(file_get_contents("php://input"));
		print_r($p);die;
		$data['zip']=$p->zip;
		//print_r($data);
		//if($data){
	        	$result1 = $this->Application_model->get_zip($data);
	        	print json_encode($result1) ;
		//}      

	}


 /*   public function customer_registration(){
 		if($_POST){					
			$data = $_POST;
	    		$result = $this->home->customer_registration($data);
        		echo ($result) ;
		}  
    }*/

/******************************************************Customer Login*******************************************************/
public function customer_login(){
  	
	$p=json_decode(file_get_contents("php://input"));
	$data['email']=$p->email;
	$data['password']=$p->password;
	//print_r($p);
	if($data){
					
		//$data = $_POST;
	    	$result = $this->Application_model->customer_login($data);
        	print json_encode($result) ;
       
	}
}
/******************************************************customer Login End ***************************************************/


}
