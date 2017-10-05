<?php
//header("Access-Control-Allow-Origin: *");
class Application_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                date_default_timezone_set('Asia/Kolkata');
        }
 

  //to fetch zipcode
  function get_zip($data){ 
     
    $this->db->select('city_name,postal_code');
    $this->db->from('city');
    $this->db->where('postal_code',$data);
    $result = $this->db->get()->result();
    // return $data;

    
    return $result;
  }  
/*
function is_email_exists($data){ 
      
   
         $this->db->where('email',$data['email']);
             $query = $this->db->get('customer_registration');
              if ($query->num_rows() > 0)
            { // check if user exist or not
          
            return true;
            }
      
          return false;
  }
  */
 //to add zipcode
  function customer_registration($data){ 
     $this->db->where('email',$data['email']);
             $query = $this->db->get('customer_registration');
              if ($query->num_rows() > 0){ // check if user exist or not
              return 0;
              }else{
                   $data['password'] = sha1($data['password']);
                //   $data['unique_id']= md5(mt_rand(100000,999999));
                  $result = $this->db->insert('customer_registration', $data);
                  $insert_id = $this->db->insert_id();
                  if($result){

                              
                      $sess_array = array();
                      $sess_array = array(
                                        'id' =>$insert_id,
                                        // 'unique_id' =>  $data['unique_id'],
                                        'email' =>$data['email'],
                                        'first_name'=>$data['first_name'],
                                        // 'zip'=>$data['zip'],
                                        'address_status'=>0
                                      );                                     
                      $this->session->set_userdata('user_values',$sess_array);
                      return 1;
              }
     }
  //  return($data);
  }

public function customer_login($data) 
  {           
              $this->db->select('id,first_name,last_name,email,phone,customer_status');
              $this->db->from('customer_registration');
              $array = array("email" => $data['email'],"password"=>sha1($data['password']));
              $this->db->where($array);
              $result = $this->db->get()->row();
              //print_r($query_value);
              // exit();
              $temp_data['device_id'] = $data['device_id'];
              $this->db->where('id',$result->id)->update('customer_registration',$temp_data);
                      return $result;
	
}
/*
 function shopper_registration($data){ 

             $this->db->where('username',$data['username']);
             $query = $this->db->get('shopper');
              if ($query->num_rows() > 0){ // check if user exist or not
              return 0;
              }else{
                   
                  $data['status']=1;
                  $data['unique_key']= md5(mt_rand(100000,999999));
                  $result = $this->db->insert('shopper', $data);
                  echo $insert_id = $this->db->insert_id();
                  if($result){

                              
                      $sess_array = array();
                      $sess_array = array(
                                        'id' =>$insert_id,
                                        'unique_key' =>  $data['unique_key'],
                                        'username' =>$data['username'],
                                        'store_name' =>$data['store_name'],
                                        'zip'=>$data['zip']
                                        
                                      );                                     
                      $this->session->set_userdata('store_values',$sess_array);
                      return $insert_id;
              }
     }
  //  return($data);
  }



//function called from function send_mail

      function send_mail2($from,$name,$mail,$sub, $msg) 
      {
      $config['protocol'] = 'smtp'; 
      $config['smtp_host'] = 'mail.tchwr.in'; // 
      $config['smtp_user'] = 'no-reply@tchwr.in'; 
      $config['smtp_pass'] = 'Golden@reply';
      $config['smtp_port'] = 25; 
      $config['mailtype'] = 'html'; 
      $this->email->initialize($config); 
      $this->email->from($from, $name); 
      $this->email->to($mail); 
      $this->email->subject($sub); 
      $this->email->message($msg); 
      $this->email->send(); 
      //echo $this->email->print_debugger();
    }  


  function mail_send() 
     {          
          
          $session=$this->session->userdata('store_values');
          $this->db->where('id', $session['id']);
          $query = $this->db->get('shopper');
          $result = $query->row(); 
          $unique_key  =$result->unique_key;       


      $from = 'no-reply@tchwr.in';
      $email=$result->username;
      $msg ="success";
      $subject = 'Request Approved'; 
      $urls= base_url().'Home/set_password/'.$unique_key; 
      $name='Clickkart'; 
      $mailTemplate='<div style="width:660px; height:230px; margin:0 auto; background:#874da3; 
        padding:20px 20px 20px 20px; font-family: Century Gothic,Verdana,Geneva,sans-serif; 
        border:solid #c79e13 1px;"> <div style="width:100%; float:left; padding:0 0 10px 0;"> 
        

        </div> 
        <div style="background:#fff; float:left; width:96.3%; border-top-right-radius: 8px; 
        border-top-left-radius: 8px; padding:15px 12px 0 12px; "> <div style="width:100%; 
        padding:10px 0 10px 0; float:left; color:#666261; font-size:14px;"> 
        Hi , thanks for registering with Clickkart.</div> 
        <div style="width:100%; float:left; padding:20px 0 20px 0; border-bottom:solid #cdcdcd 1px; 
        border-top:solid #cdcdcd 1px;"> <div style="width:30%; float:left; font-size:17px;"> Your Activation Link# '.$urls.'</div> 
        <div style="width:30%; float:left;"> </div> 
        </div> 
        </div> 
       
        
        
      <div style="width:100%; float:left;"> 
       
        </div> 
        
        </div>';
     
  //$this->email->send();
      $this->send_mail2($from,$name,$email,$subject,$mailTemplate);
 echo $this->email->print_debugger();
      echo $urls;
  }

/*set password for the store*/

  function add_password($data){
      
     // $session=$this->session->userdata('store_values');
    $this->db->where('unique_key', $data['unique_key']);
    $query = $this->db->get('shopper');
    if($query->num_rows()>0){
      if($data['password']==$data['confirm_password']){  
            $this->db->where('unique_key', $data['unique_key']);
      $data['password'] = md5($data['password']);
      $data['confirm_password'] = md5($data['confirm_password']);
            $result = $this->db->update('shopper',$data);
          // return $result;
          $status=1;
        }else
        {
          $status=0;
        }

    } else {
        $status=2;
    }

          
        
        $message = array('status' => $status);
        return $message;
           
  }

  function set_password($data){
    $this->db->where('unique_id', $data['unique_key']);
    $query = $this->db->get('customer_registration');
    if($query->num_rows()>0){
      if($data['password']==$data['confirm_password']){  
            $this->db->where('unique_id', $data['unique_key']);
      $rs['password'] = $data['password'];       
      $result = $this->db->update('customer_registration',$rs);
          // return $result;
          $status=1;
        }else
        {
          $status=0;
        }

    } else {
        $status=2;
    }

          
        
        $message = array('status' => $status);
        return $message;
  }

  function reset_key($key){
      $this->db->set('unique_key', '""', FALSE);
      $this->db->where('unique_key', $key);
      $this->db->update('shopper');
  }

//   function forgot_password($email){
//     $query = $this->db->query("SELECT * FROM customer_registration WHERE email='$email'")->row();



//     if(count($query)>0){
//       $unique_id = md5(mt_rand(100000,999999));
//       $this->db->where('email',$email)->update('customer_registration',array('unique_id'=> $data['unique_id']=$unique_id));
//       return $this->forgot_mail($email);
//     } else {
//       return 0;
//     }
//   }
/*
  function forgot_mail($email){

$setting = getSettings();


    $this->db->where('email', $email);
    $query = $this->db->get('customer_registration');
    $result = $query->row(); 
    $unique_id  =$result->unique_id;  

    $this->load->library('email');
            $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => $setting->smtp_host,
                    'smtp_port' => 587,
                    'smtp_user' => $setting->smtp_username, // change it to yours
                    'smtp_pass' => $setting->smtp_password, // change it to yours
                    'smtp_timeout'=>20,
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
                  );

             $this->email->initialize($config);// add this line

            $subject = 'Forgot Password Request'; 
            $urls= base_url().'Home/password_reset/'.$unique_id; 
            $name=$setting->title;
            $mailTemplate='<div style="width:660px; height:230px; margin:0 auto; background:#874da3; 
              padding:20px 20px 20px 20px; font-family: Century Gothic,Verdana,Geneva,sans-serif; 
              border:solid #c79e13 1px;"> <div style="width:100%; float:left; padding:0 0 10px 0;"> 
              

              </div> 
              <div style="background:#fff; float:left; width:96.3%; border-top-right-radius: 8px; 
              border-top-left-radius: 8px; padding:15px 12px 0 12px; "> <div style="width:100%; 
              padding:10px 0 10px 0; float:left; color:#666261; font-size:14px;"> 
              Hi , thanks for registering with Clickkart.</div> 
              <div style="width:100%; float:left; padding:20px 0 20px 0; border-bottom:solid #cdcdcd 1px; 
              border-top:solid #cdcdcd 1px;"> <div style="width:100%; float:left; font-size:17px;"> Your Password Reset Link# '.$urls.'</div> 
              <div style="width:30%; float:left;"> </div> 
              </div> 
              </div> 
             
              
              
            <div style="width:100%; float:left;"> 
             
              </div> 
              
              </div>';

              //$this->email->set_newline("\r\n");
              $this->email->from($setting->admin_email, $name);
              $this->email->to($result->email);
              $this->email->subject($subject);
              $this->email->message($mailTemplate);  
              echo $this->email->send();
  }
   
  */ 
  function forgotpassword($email){      
         $email=$email['email'];               
         $this->db->where('email',$email);
         $query=$this->db->get('customer_registration');		
         $query=$query->row();
		 $settings = $this->db->select('*')->from('settings')->get()->row();
         if($query)
         {         
          $first_name=$query->first_name;
          $from_email=$settings->admin_email;
          $this->load->helper('string');
        //   $rand_pwd= random_string('alnum', 8);
        //   $password=array('password'=>($rand_pwd));                 
        //   $this->db->where('email',$email);
           $this->load->helper('string');
          $rand_pwd= uniqid(random_string('alnum', 8));
          $unique_key=array('unique_key'=>($rand_pwd));                 
          $this->db->where('email',$email);
          $query=$this->db->update('customer_registration',$unique_key);
              if($query)
              {
		//return $result;
				   $configs = array(
						'protocol'=>'smtp',
						'smtp_host'=>$settings->smtp_host,
						'smtp_user'=>$settings->smtp_username,
						'smtp_pass'=>$settings->smtp_password,
						'smtp_port'=>'465'
						);             
                $this->load->library('email',$configs);
			    //$this->email->initialize($configs);
                $this->email->from($from_email, $first_name);
                $this->email->to($email);
                $this->email->subject('Forget Password');
                $this->email->message('Click on link to set New Password'."\n".'http://www.minbazaar.com/subs/admin/login_admin/forget_password/'.$unique_key['unique_key']);
                $this->email->send();        
                  return "EmailSend";
                }
          }
          else
          {
              return "EmailNotExist";
          }

         

    } 
/*
    public function default_store(){
      $rs = $this->db->query('SELECT postal_code as zip FROM `city` WHERE city_status = 1 ORDER BY id ASC LIMIT 0,1')->row();
      return $rs->zip;
    }

    public function default_login($data){
      $this->db->where('social_id',$data['social_id']);           
      $query=$this->db->get('customer_registration');
      $query_value=$query->row();
      $sess_array = array();
                      $sess_array = array(
                      'id' =>$query_value->id,
                      'unique_id' =>  $query_value->unique_id,
                      'email' =>$query_value->email,
                      'first_name'=>$query_value->first_name,
                      'zip'=>$query_value->zip,
                      'address_status'=>$query_value->address_status
                    );                                     
     $this->session->set_userdata('user_values',$sess_array);
     $this->session->set_userdata('store_id',$query_value->store_id);
     return $status=1;
    }


    function social_registration($data){ 

     $this->db->where('social_id',$data['social_id']);
             $query = $this->db->get('customer_registration');
              if ($query->num_rows() > 0){ // check if user exist or not
              return 0;
              }else{
                   
                  $data['unique_id']= md5(mt_rand(100000,999999));
                  $result = $this->db->insert('customer_registration', $data);
                  $insert_id = $this->db->insert_id();
                  $data = $this->db->where('id',$insert_id)->get('customer_registration')->row_array();
                  if($result){

                              
                      $sess_array = array();
                      $sess_array = array(
                                        'id' =>$insert_id,
                                        'unique_id' =>  $data['unique_id'],
                                        'email' =>$data['email'],
                                        'first_name'=>$data['first_name'],
                                        'zip'=>$data['zip'],
                                        'address_status'=>0
                                      );                                     
                      $this->session->set_userdata('user_values',$sess_array);
                      return 1;
              }
     }
  //  return($data);
  }


*/
function get_categories(){
    $temp_result = $this->db->select('category.*')->from('category')->get()->result();
    foreach($temp_result as $index => $temp_data){
        $temp_data1 = $this->db->select('COUNT(id) as count')->from('products')->where('category_id',$temp_data->id)->get()->row();
        if($temp_data1-> count > 0){
            $result[$index] = $temp_data;
        }
    }
    return $result;
}
function get_products($cat_id){
    $this->db->select('products.id,products.image,products.product_name,products.category_id,products.date,products.details,products.ingredients,products.warnings,products.directives,products.product_status,products.unit');
    $this->db->from('products');
    $this->db->where('products.category_id',$cat_id);
    $this->db->where('products.is_deleted !=',1);
    $result = $this->db->get()->result();
    foreach($result as $index=>$products){
        
            $this->db->select('unit_product_mapping.weight,unit_product_mapping.price,unit_of_product.unit,unit_product_mapping.tbl_id as unit_id,unit_of_product.basic_weight,unit_product_mapping.max_limit');
            $this->db->from('unit_product_mapping');
            $this->db->join('unit_of_product','unit_product_mapping.unit_id = unit_of_product.tbl_id','INNER');
            $this->db->where('unit_product_mapping.product_id',$products->id);
            $result1 = $this->db->get()->result();
        $result[$index]->unit_data = $result1;
        
    }
    return $result;
}

function get_package_product($pack_id){
    
  $result['products'] =  
  $this->db->select("products.product_name,products.image")
      ->from('package_products')
        ->where('package_products.package_id',$pack_id)
          ->join('products','products.id=package_products.item_id')->get()->result();

  $result['package_size'] = $this->db->select('package_size.*')->from('package_size')->join('package_and_sizes','package_size.id = package_and_sizes.size_id')->where('package_and_sizes.package_id',$pack_id)->get()->result();
    return $result;
    
}

function get_customer_address($customer_id,$address_id = '',$is_subscription = ''){
    if(empty($address_id)){
        if($is_subscription){
             $result = $this->db->select("addaddress.*")->from('addaddress')->where(array('addaddress.user_id'=>$customer_id))->order_by('addaddress.id','desc')->get()->result();
        }else{
            $result = $this->db->select("*")->from('addaddress')->where(array('user_id'=>$customer_id))->order_by('addaddress.id','desc')->get()->result();
        }
    
    }
    else{
    $result = $this->db->select("*")->from('addaddress')->where('id',$address_id)->order_by('addaddress.id','desc')->get()->result();
    }
    return $result;
    
}

function get_subscribed_packages($customer_id){
    
    $result = $this->db->select('cust_subscription.id as subscription_id,package.id as package_id,package.package_name,package_size.id as package_size_id,package_size.size_name')->from('cust_subscription')->join('package','cust_subscription.package_id = package.id','inner')->join('package_size','cust_subscription.package_size_id = package_size.id','inner')->where('cust_subscription.cust_id',$customer_id['cust_id'])->get()->result();
   return $result;
    
}

function post_address($customer_address){
    
    // $this->db->where('user_id', $customer_address['user_id']);
    // $query = $this->db->get('addaddress');
    // if($query->num_rows()>0){
    //   $this->db->where('user_id',$customer_address['user_id']);
    //   $result = $this->db->update('addaddress',$customer_address);
    // }else if($query->num_rows()==0){
        $query = $this->db->where('user_id',$customer_address['user_id'])->get('addaddress');
        if($query->num_rows() > 0){
            $customer_address['is_verified'] = 0;
         $result = $this->db->where('user_id',$customer_address['user_id'])->update('addaddress',$customer_address);   
        }
        else{
            $result = $this->db->insert('addaddress',$customer_address);
        }
    // }else{
    //     $result =0;
    // }
    return $result;
    
}

function get_cust_subs($cust_data){
    
    // $month_end_date = Date('Y-m-t');
    // $month_start_date = Date('Y-m-1');
    $array = array('cust_id'=>$cust_data['cust_id'],'current_status !='=>4);
    $result['products'] = $this->db->select('cust_subscription.id as sub_id,cust_subscription.*,addaddress.*,unit_of_product.unit,products.product_name,products.image,unit_product_mapping.weight,unit_of_product.basic_weight')->from('cust_subscription')->join('unit_product_mapping','cust_subscription.unit_mapping_id = unit_product_mapping.tbl_id')->join('products','cust_subscription.product_id = products.id')->join('unit_of_product','unit_product_mapping.unit_id = unit_of_product.tbl_id')->join('addaddress','cust_subscription.delivery_add_id = addaddress.id')->where($array)->get()->result();
    $result['package'] = $this->db->select('cust_subscription.*,cust_subscription.id as sub_id,addaddress.*,package_size.*,package.package_name,package.image as package_image')->from('cust_subscription')->join('addaddress','cust_subscription.delivery_add_id = addaddress.id')->join('package','cust_subscription.package_id = package.id')->join('package_size','cust_subscription.package_size_id = package_size.id')->where($array)->get()->result();
    return $result;
    
}

function post_cust_subs($data,$action=''){
    $response = $this->db->where(array('is_verified'=>2,'addaddress.id'=>$data['delivery_add_id']))->get('addaddress');
      if($response->num_rows() <= 0){
           $result['status'] = 1;
      $result['response'] = "You need to Verify Your Self First,then you will receive your subscription".'<br>'.'Our Person will contect you shortly';
      }else{
          $result['status'] = 3;
      $result['response'] = "Added Succefully";
      }
      $current_date = date('Y-m-d');
      if(strtotime($data['start_date']) > strtotime('+1 day',strtotime(date('Y-m-d')))){   //Thik karna hain <(>)
     if($action != "package"){
            
          if($data['custom_date'] == 0){ 
                $data1['start_date']  = strtotime($data['start_date']);
                 $data['end_date'] = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
                  $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                    $this->db->insert('cust_subscription',$data);
                     $id = $this->db->insert_id();
                     $price = $this->db->select('price')->from('unit_product_mapping')->where('tbl_id',$data['unit_mapping_id'])->get()->row();
				 while($data1['start_date'] <= $data1['end_date'])
	        	{	
	              $data2['price'] = $price->price;
	       	       $data2['qty'] = $data['quantity'];
	       	        $data2['cust_id'] = $data['cust_id'];
	       	         $data2['product_id'] = $data['product_id'];
	       	          $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	       $data2['subscription_id'] = $id;
			            $this->db->insert('subs_used_data',$data2);
    			         $data1['start_date'] = strtotime('+1 day', $data1['start_date']); // increment for loop
				 }
			
             return $result;
          }
        //   else if($data['custom_date'] == 1){
             
        //       $temp_date =  json_decode($data['start_date'],true);
        //       $len_array = sizeof($temp_date);
        //         $data['end_date'] =   $temp_date[$len_array-1];
        //          $data['start_date']  = $temp_date[0];
        //           $this->db->insert('cust_subscription',$data);
        //             $id = $this->db->insert_id();
        //              $i = 0;
        //         $price = $this->db->select('price')->from('unit_product_mapping')->where('tbl_id',$data['unit_mapping_id'])->get()->row();
        //       while($i <  $len_array){
        //           $data2['price'] = $price->price;
	       //	        $data2['qty'] = $data['quantity'];
        //              $data2['cust_id'] = $data['cust_id'];
	       //	          $data2['product_id'] = $data['product_id'];
	       //	           $data2['date'] = $temp_date[$i];
	       // 	        $data2['subscription_id'] = $id;
	       // 	         $i++;
			     //         $this->db->insert('subs_used_data',$data2);
        //       }
        //       $result['status'] = 1;
        //     $result['response'] ="Added Succefully";
        //      return $result;
        //   }
           else{
              
               $data1['start_date']  = strtotime($data['start_date']);
               $data['end_date']    = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
               $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                    $this->db->insert('cust_subscription',$data);
                    $id = $this->db->insert_id();
                    $price = $this->db->select('price')->from('unit_product_mapping')->where('tbl_id',$data['unit_mapping_id'])->get()->row();
				 while($data1['start_date'] <= $data1['end_date'])
	        	{	
	        	         $data2['price'] = $price->price;
	       	             $data2['qty'] = $data['quantity'];
	       	             $data2['cust_id'] = $data['cust_id'];
	       	             $data2['product_id'] = $data['product_id'];
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	         $data2['subscription_id'] = $id;
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
    			         $data1['start_date'] = strtotime('+'.$data['custom_date'].' day', $data1['start_date']); // increment for loop
    			         $this->db->insert('subs_used_data',$data2);
				 }
				 $this->db->where('cust_subscription.id',$id);
				 $data3['end_date'] = date('Y-m-d',strtotime('-'.$data['custom_date'].' day',$data1['start_date']));
				 $this->db->update('cust_subscription',$data3);
				 
             return $result;
            }
        }                                                                                                                                   /*Package*/
        else{
            if($data['custom_date'] == 0){ 
                $data1['start_date']  = strtotime($data['start_date']);
                 $data['end_date'] = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
                  $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                    $temp_data2 = $this->db->select('weight_in_kg')->from('package_size')->where(array('id'=>$data['package_size_id'],'package_id'=>$data['package_id']))->get()->row();
                     $data['total_weight'] = 1000 * $temp_data2->weight_in_kg;
                      $data['remaining_weight'] = $data['total_weight'];
                   $this->db->insert('cust_subscription',$data);
                     $id = $this->db->insert_id();
                      while($data1['start_date'] <= $data1['end_date'])
	        	{	
                     $data2['price'] = 0;
	       	             $data2['weight'] = 0;
	       	             $data2['cust_id'] = $data['cust_id'];
	       	             $data2['package_id'] = $data['package_id'];
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	         $data2['subscription_id'] = $id;
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']); 
	       	             $this->db->insert('package_used_data',$data2);
    			         $data1['start_date'] = strtotime('+1 day', $data1['start_date']); // increment for loop
	        	}
	        
             return $result;
    			        
          }
        //   else if($data['custom_date'] == 1){
             
        //       $temp_date =  json_decode($data['start_date'],true);
        //       $len_array = sizeof($temp_date);
        //         $data['end_date'] =   $temp_date[$len_array-1];
        //          $data['start_date']  = $temp_date[0];
        //           $this->db->insert('cust_subscription',$data);
        //             $id = $this->db->insert_id();
        //              $i = 0;
        //       while($i <  $len_array){
        //           $data2['price'] = 6;
	       //	        $data2['weight'] = 12;
        //              $data2['cust_id'] = $data['cust_id'];
	       //	          $data2['package_id'] = $data['package_id'];
	       //	           $data2['date'] = $temp_date[$i];
	       // 	        $data2['subscription_id'] = $id;
	       // 	         $i++;
			     //         $this->db->insert('package_used_data',$data2);
        //       }
        //       $result['status'] = 1;
        //     $result['response'] ="Added Succefully";
        //      return $result;
              
        //   }
           else{
               $data1['start_date']  = strtotime($data['start_date']);
               $data['end_date']    = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
               $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                   $temp_data2 = $this->db->select('weight_in_kg')->from('package_size')->where(array('id'=>$data['package_size_id'],'package_id'=>$data['package_id']))->get()->row();
                 $data['total_weight'] = 1000 * $temp_data2->weight_in_kg;
                 $data['remaining_weight'] = $data['total_weight'];
                 $this->db->insert('cust_subscription',$data);
                    $id = $this->db->insert_id();
				 while($data1['start_date'] <= $data1['end_date'])
	        	{	
	        	         $data2['price'] = 0;
	       	             $data2['weight'] =0;
	       	             $data2['cust_id'] = $data['cust_id'];
	       	             $data2['package_id'] = $data['package_id'];
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	         $data2['subscription_id'] = $id;
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
    			         $data1['start_date'] = strtotime('+'.$data['custom_date'].' day', $data1['start_date']); // increment for loop
    			         
    			         $this->db->insert('package_used_data',$data2);
				 }
				 $this->db->where('cust_subscription.id',$id);
				 $data3['end_date'] = date('Y-m-d',strtotime('-'.$data['custom_date'].' day',$data1['start_date']));
				 $this->db->update('cust_subscription',$data3);
				
             return $result;
            }
        }
      }
    else{
        
          $temp_data = $this->db->select('delivery_end_timing')->from('settings')->get()->row();
          
      if(strtotime($data['start_date']) == strtotime('+1 day',strtotime(date('Y-m-d')))){
          
         if($temp_data->delivery_end_timing >= date("H:i:s", strtotime(date('G:i:s')))){
     if($action != "package"){
            
          if($data['custom_date'] == 0){ 
                $data1['start_date']  = strtotime($data['start_date']);
                 $data['end_date'] = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
                  $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                    $this->db->insert('cust_subscription',$data);
                     $id = $this->db->insert_id();
                     $price = $this->db->select('price')->from('unit_product_mapping')->where('tbl_id',$data['unit_mapping_id'])->get()->row();
				 while($data1['start_date'] <= $data1['end_date'])
	        	{	
	              $data2['price'] = $price->price;
	       	       $data2['qty'] = $data['quantity'];
	       	        $data2['cust_id'] = $data['cust_id'];
	       	         $data2['product_id'] = $data['product_id'];
	       	          $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	       $data2['subscription_id'] = $id;
			            $this->db->insert('subs_used_data',$data2);
    			         $data1['start_date'] = strtotime('+1 day', $data1['start_date']); // increment for loop
				 }
				 
             return $result;
          }
        //   else if($data['custom_date'] == 1){
             
        //       $temp_date =  json_decode($data['start_date'],true);
        //       $len_array = sizeof($temp_date);
        //         $data['end_date'] =   $temp_date[$len_array-1];
        //          $data['start_date']  = $temp_date[0];
        //           $this->db->insert('cust_subscription',$data);
        //             $id = $this->db->insert_id();
        //              $i = 0;
        //         $price = $this->db->select('price')->from('unit_product_mapping')->where('tbl_id',$data['unit_mapping_id'])->get()->row();
        //       while($i <  $len_array){
        //           $data2['price'] = $price->price;
	       //	        $data2['qty'] = $data['quantity'];
        //              $data2['cust_id'] = $data['cust_id'];
	       //	          $data2['product_id'] = $data['product_id'];
	       //	           $data2['date'] = $temp_date[$i];
	       // 	        $data2['subscription_id'] = $id;
	       // 	         $i++;
			     //         $this->db->insert('subs_used_data',$data2);
        //       }
        //       $result['status'] = 1;
        //     $result['response'] ="Added Succefully";
        //      return $result;
        //   }
           else{
              
               $data1['start_date']  = strtotime($data['start_date']);
               $data['end_date']    = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
               $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                 $this->db->insert('cust_subscription',$data);
                    $id = $this->db->insert_id();
                    $price = $this->db->select('price')->from('unit_product_mapping')->where('tbl_id',$data['unit_mapping_id'])->get()->row();
				 while($data1['start_date'] <= $data1['end_date'])
	        	{	
	        	         $data2['price'] = $price->price;
	       	             $data2['qty'] = $data['quantity'];
	       	             $data2['cust_id'] = $data['cust_id'];
	       	             $data2['product_id'] = $data['product_id'];
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	         $data2['subscription_id'] = $id;
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
    			         $data1['start_date'] = strtotime('+'.$data['custom_date'].' day', $data1['start_date']); // increment for loop
    			         
    			         $this->db->insert('subs_used_data',$data2);
				 }
				 $this->db->where('cust_subscription.id',$id);
				 $data3['end_date'] = date('Y-m-d',strtotime('-'.$data['custom_date'].' day',$data1['start_date']));
				 $this->db->update('cust_subscription',$data3);
				 
                 return $result;
            }
        }                                                                                                                                       /*Package*/
        else{
           if($data['custom_date'] == 0){ 
                $data1['start_date']  = strtotime($data['start_date']);
                 $data['end_date'] = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
                  $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                   $temp_data2 = $this->db->select('weight_in_kg')->from('package_size')->where(array('id'=>$data['package_size_id'],'package_id'=>$data['package_id']))->get()->row();
                  $data['total_weight'] = 1000 * $temp_data2->weight_in_kg;
                 $data['remaining_weight'] = $data['total_weight'];
                    $this->db->insert('cust_subscription',$data);
                     $id = $this->db->insert_id();
                      while($data1['start_date'] <= $data1['end_date'])
	        	{	
                     $data2['price'] = 0;
	       	             $data2['weight'] = 0;
	       	             $data2['cust_id'] = $data['cust_id'];
	       	             $data2['package_id'] = $data['package_id'];
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	         $data2['subscription_id'] = $id;
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']); 
	       	             $this->db->insert('package_used_data',$data2);
    			         $data1['start_date'] = strtotime('+1 day', $data1['start_date']); // increment for loop
	        	}
    			        
                          return $result;
          }
        //   else if($data['custom_date'] == 1){
             
        //       $temp_date =  json_decode($data['start_date'],true);
        //       $len_array = sizeof($temp_date);
        //         $data['end_date'] =   $temp_date[$len_array-1];
        //          $data['start_date']  = $temp_date[0];
        //           $result =  $this->db->insert('cust_subscription',$data);
        //             $id = $this->db->insert_id();
        //              $i = 0;
        //       while($i <  $len_array){
        //           $data2['price'] = 6;
	       //	        $data2['weight'] = 12;
        //              $data2['cust_id'] = $data['cust_id'];
	       //	          $data2['package_id'] = $data['package_id'];
	       //	           $data2['date'] = $temp_date[$i];
	       // 	        $data2['subscription_id'] = $id;
	       // 	         $i++;
			     //         $this->db->insert('package_used_data',$data2);
        //       }
        //       $result['status'] = 1;
        //     $result['response'] ="Added Succefully";
        //     return $result;
        //   }
           else{
                  $data1['start_date']  = strtotime($data['start_date']);
                  $data['end_date']    = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
                  $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                   $temp_data2 = $this->db->select('weight_in_kg')->from('package_size')->where(array('id'=>$data['package_size_id'],'package_id'=>$data['package_id']))->get()->row();
                  $data['total_weight'] = 1000 * $temp_data2->weight_in_kg;
                  $data['remaining_weight'] = $data['total_weight'];
                  $this->db->insert('cust_subscription',$data);
                 
                  $id = $this->db->insert_id();
                  $price = 0;
				 while($data1['start_date'] <= $data1['end_date'])
	        	{	
	        	         $data2['price'] = 0;
	       	             $data2['weight'] = 0;
	       	             $data2['cust_id'] = $data['cust_id'];
	       	             $data2['package_id'] = $data['package_id'];
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	         $data2['subscription_id'] = $id;
	       	             $data2['date'] = date('Y-m-d',$data1['start_date']);
    			         $data1['start_date'] = strtotime('+'.$data['custom_date'].' day', $data1['start_date']); // increment for loop
    			         $this->db->insert('package_used_data',$data2);
				 }
				 $this->db->where('cust_subscription.id',$id);
				 $data3['end_date'] = date('Y-m-d',strtotime('-'.$data['custom_date'].' day',$data1['start_date']));
				 $this->db->update('cust_subscription',$data3);
				
                 return $result;
            }
        }
         }
         else{
                $result['status'] = 2;
                $result['response'] = "You can't Subscribe after ".$temp_data->delivery_end_timing.", Continue if u want to Start same Subscription from ".date('d M, l',strtotime('+2 day',strtotime(date('Y-m-d'))));
                $result['date'] = date('Y-m-d',strtotime('+2 day',strtotime(date('Y-m-d'))));
                return $result;
            }
   
    }
    else{
        
         if($temp_data->delivery_end_timing >= date("H:i:s", strtotime(date('G:i:s')))){
             $result['status'] = 2;
             $result['response'] = "You can't place order for this day, Continue if u want to place same order for ".date('d M, l',strtotime('+1 day',strtotime(date('Y-m-d'))));
             $result['date'] = date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))));
          }else{
             $result['status'] = 2;
             $result['response'] = "You can't place order for this day, Continue if u want to place same order for ".date('d M, l',strtotime('+2 day',strtotime(date('Y-m-d'))));
             $result['date'] = date('Y-m-d',strtotime('+2 day',strtotime(date('Y-m-d'))));
          }
         return $result;
         
    }
  }
 
}

function get_single_subs_data($cust_data){
    $start_date = date('Y-m-1');
    $end_date = date('Y-m-t');
    $array = array('cust_id'=>$cust_data['cust_id'],'subscription_id'=>$cust_data['sub_id'],'date <='=>$end_date,'date >='=>$start_date);    /*thik Karna Hain */
    $array1 = array('cust_id'=>$cust_data['cust_id'],'subscription_id'=>$cust_data['sub_id']);
    $result['product'] = $this->db->select('cust_subscription.*,products.image,products.product_name,unit_product_mapping.*,unit_of_product.unit')->from('cust_subscription')->join('products','cust_subscription.product_id = products.id')->join('unit_product_mapping','cust_subscription.unit_mapping_id = unit_product_mapping.tbl_id')->join('unit_of_product','unit_product_mapping.unit_id = unit_of_product.tbl_id')->where(array('cust_subscription.cust_id'=>$cust_data['cust_id'],'cust_subscription.id'=>$cust_data['sub_id'],'cust_subscription.unit_mapping_id' => $cust_data['unit_mapping_id']))->get()->result();
    $result['product_detail'] = $this->db->select('subs_used_data.*')->from('subs_used_data')->where($array1)->get()->result();
    foreach($result['product'] as $index=>$temp_data){
       $result['product'][$index]->total_used_data = $this->db->select('SUM(extra_qty)+SUM(qty) as total_used_data ,SUM(total_price) as total_price')->from('subs_used_data')->where(array('cust_id'=>$cust_data['cust_id'],'subscription_id'=>$cust_data['sub_id'],'status'=>1,'date <='=>$end_date,'date >='=>$start_date))->get()->result();/*Thik karna hain*/
      // $result['product'][$index]->total_used_data = $this->db->select('SUM(extra_qty)+SUM(qty) as total_used_data ,SUM(total_price) as total_price')->from('subs_used_data')->where(array('cust_id'=>$cust_data['cust_id'],'subscription_id'=>$cust_data['sub_id'],'status'=>1))->get()->result();
    }
    return $result;
    
}

function get_single_package_data($cust_data){
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-t');
    $result['package'] = $this->db->select('cust_subscription.*,cust_subscription.id as subscription_id,package.*,package_size.*')->from('cust_subscription')->join('package','cust_subscription.package_id = package.id')->join('package_size','cust_subscription.package_size_id = package_size.id')->where(array('cust_subscription.id'=>$cust_data['subscription_id'],'cust_subscription.cust_id'=>$cust_data['cust_id'],'cust_subscription.package_id'=>$cust_data['package_id'],'cust_subscription.package_size_id'=>$cust_data['package_size_id']))->get()->result();
    foreach($result['package'] as $temp_data){
        $temp_data = $this->db->select('package_used_data.*')->from('package_used_data')->where(array('subscription_id' => $temp_data->subscription_id,'cust_id'=>$cust_data['cust_id'],'date <='=>$start_date,'date <='=>$end_date))->get()->result();
        $result['total_weight'] = $this->db->select('SUM(price) as total_price,SUM(weight) as total_weight')->from('package_used_data')->where(array('subscription_id' => $cust_data['subscription_id'],'status'=>1))->get()->result();
        $i=0;
        foreach($temp_data as $index=>$temp_data2){
            $date = date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))));
             if($temp_data2->date <=$date){
                 $result['package_product'][$i] = $temp_data2;
                    $i++;
            }
            else{
           
            }
        }
    }
    return $result;
    
}

function add_extra_quantity($data){
    
        $temp_data = $this->db->select('date')->from('subs_used_data')->where('id',$data['id'])->get()->row();
          $temp_data1 = $this->db->select('delivery_end_timing')->from('settings')->get()->row();
  if($temp_data->date > date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))))){
      
        $data1 = array('extra_qty'=>$data['extra_qty']);
        $array = array('cust_id'=>$data['cust_id'],'id'=>$data['id']);
        $this->db->where($array);
        $result['response'] = $this->db->update('subs_used_data',$data1);
        $result['time'] = $temp_data1->delivery_end_timing;
  }
  else{
      if($temp_data->date == date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))))){
    if($temp_data1->delivery_end_timing >= date("H:i:s", strtotime(date('G:i:s')))){
        $data1 = array('extra_qty'=>$data['extra_qty']);
        $array = array('cust_id'=>$data['cust_id'],'id'=>$data['id']);
        $this->db->where($array);
        $result['response'] = $this->db->update('subs_used_data',$data1);
        $result['time'] = $temp_data1->delivery_end_timing;
       }
       else{
        $result['response'] = 0;
        $result['time'] = $temp_data1->delivery_end_timing;
    }
      }
    else{
        $result['response'] = 2;
        $result['time'] = $temp_data1->delivery_end_timing;
    }
  }
    return $result;
    
}

function get_next_day_selection($data){
    
    $array = array('next_day_selection.package_id'=>$data['package_id'],'next_day_selection.size_id'=>$data['size_id']);
    $array1 = array('package_id'=>$data['package_id'],'id'=>$data['size_id']);
    $array2 = array('package.id'=>$data['package_id']);
    //$query = $this->db->query("SELECT `package_size`.*, `next_day_selection`.`product_id`,`products`.* FROM `products`,`next_day_selection` JOIN `package_size` ON `next_day_selection`.`size_id` = `package_size`.`id` WHERE `next_day_selection`.`package_id` = '1' AND `next_day_selection`.`size_id` = '1' AND `products`.`id` = `next_day_selection`.`product_id`");
    $result['size_data'] = $this->db->select('package_size.*')->from('package_size')->where($array1)->get()->result();
    $result['package_data'] = $this->db->select('package.*')->from('package')->where($array2)->get()->result();
    $result['product_data'] = $this->db->select('products.*')->from('products')->join('next_day_selection','products.id = next_day_selection.product_id')->where($array)->get()->result();
    foreach($result['product_data'] as $index=>$products){
        
            $this->db->select('unit_product_mapping.weight,unit_product_mapping.price,unit_of_product.unit,unit_of_product.tbl_id as unit_id,unit_of_product.basic_weight');
            $this->db->from('unit_product_mapping');
            $this->db->join('unit_of_product','unit_product_mapping.unit_id = unit_of_product.tbl_id','INNER');
            $this->db->where('unit_product_mapping.product_id',$products->id);
            $result1 = $this->db->get()->result();
            $result['product_data'][$index]->unit_data = $result1;
        
    }
    return $result;
    
}

function post_next_day_needs($data){
    // $temp_data = $this->db->select('delivery_end_timing')->from('settings')->get()->row();
    //  if($temp_data->delivery_end_timing >= date("H:i:s", strtotime(date('G:i:s')))){
     $data['product_data'] = json_decode($data['product_data'],true);
     $data3['weight'] = 0;
    // $total_weight = $this->db->select('SUM(weight) as weight')->from('package_used_data')->where(array('subscription_id'=> $data['product_data'][0]['subscription_id'],'cust_id'=>$data['cust_id'],'status'=>1,'is_selected'=>1))->get()->row();
     $temp = 0;
   for($i = 0 ; $i < count($data['product_data']) ; $i++){
        $data2['product_id'] = $data['product_data'][$i]['product_id'] ;
        $data2['unit_id'] = $data['product_data'][$i]['unit_id'] ;
        $data2['basic_weight'] = $data['product_data'][$i]['basic_weight'] ;
        $data2['quantity'] = $data['product_data'][$i]['quantity'] ;
        $data2['cust_id'] = $data['cust_id'] ;
        $data2['package_id'] = $data['product_data'][$i]['package_id'];
        $data2['package_size_id'] = $data['product_data'][$i]['package_size_id'];
        $data2['subscription_id'] = $data['product_data'][$i]['subscription_id'] ;
        $data2['used_id'] = $data['used_id'];
        $data3['weight'] = $data['product_data'][$i]['total_weight']+$data3['weight'];
        $data2['total_weight'] = $data['product_data'][$i]['total_weight'];
        $temp = $data['product_data'][$i]['total_weight']+$temp;
        $result[0] = $this->db->insert('next_day_needs',$data2);
        if($i+2 > count($data['product_data'])){
            $total_weight = $this->db->select('remaining_weight')->from('cust_subscription')->where(array('id'=> $data['product_data'][0]['subscription_id'],'cust_id'=>$data['cust_id']))->get()->row();
            if($temp <= $total_weight->remaining_weight){
                 $temp1['remaining_weight'] = $total_weight->remaining_weight - $data3['weight'];
                 $temp_result = $this->db->select('price,weight_in_kg')->from('package_size')->where('id',$data2['package_size_id'])->get()->result();
                 $data3['price'] = ($data3['weight']*$temp_result[0]->price)/(1000*$temp_result[0]->weight_in_kg);
                 $data3['is_selected'] = 1;
                 $this->db->where('id',$data['used_id'])->update('package_used_data',$data3);
            }
            else{
                for($i = 0 ; $i < count($data['product_data']) ; $i++){
                    $this->db->where(array('subscription_id'=> $data['product_data'][$i]['subscription_id'],'cust_id'=>$data['cust_id'],'product_id'=>$data['product_data'][$i]['product_id']))->delete('next_day_needs');
                }
                $result[0] = 0;
                $result[1] = $total_weight ;
            }
            //  if($i+2 > count($data['product_data'])){
            // $total_weight = $this->db->select('remaining_weight')->from('cust_subscription')->where(array('id'=> $data['product_data'][0]['subscription_id'],'cust_id'=>$data['cust_id']))->get()->row();
            // if($temp <= $total_weight->remaining_weight){
            //     $temp1['remaining_weight'] = $total_weight->remaining_weight - $data3['weight'];
            //      $result[0] = $this->db->insert('next_day_needs',$data2);
            //      $this->db->where(array('id'=> $data['product_data'][0]['subscription_id'],'cust_id'=>$data['cust_id']))->update('cust_subscription',$temp1);
            //      $temp_result = $this->db->select('price,weight_in_kg')->from('package_size')->where('id',$data2['package_size_id'])->get()->result();
            //      $data3['price'] = ($data3['weight']*$temp_result[0]->price)/(1000*$temp_result[0]->weight_in_kg);
            //      $data3['is_selected'] = 1;
            //      $this->db->where('id',$data['used_id'])->update('package_used_data',$data3);
            // }
            // else{
            //     $result[0] = 0;
            //     $result[1] = $total_weight ;
            // }
        }
    }
   
    //  }
     
    // else{
    //     $result['response'] = "You can't place order after 6pm, Continue if u want to place same order for Day After Tommorow";
    //     $result['time'] = $temp_data->delivery_end_timing;
    // }
   
  
        return $result;
}

function get_next_day_needs($data){
    $result = $this->db->select('next_day_needs.*,products.product_name,products.image as product_image,package.package_name,package_size.size_name,package_size.image,package.image as package_image')->from('next_day_needs')->join('package','next_day_needs.package_id = package.id')->join('products','next_day_needs.product_id = products.id')->join('package_size','next_day_needs.package_size_id = package_size.id')->where(array('next_day_needs.used_id'=> $data['used_id'],'next_day_needs.cust_id'=>$data['cust_id']))->get()->result();   
    return $result;
}

function pause_single_subscription($data,$action){
 $current_date = date('Y-m-d');
    if($action == 'pause'){
        $array = array('current_status' => 1);
         $this->db->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['subs_id'],'date >' => $current_date));/*change 'date >' => $current_date*/
          $this->db->update('subs_used_data',array('status'=>2));
    }
    else if($action == 'restart'){
        $array = array('current_status' => 0);
         $this->db->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['subs_id'],'date >' => $current_date));/*change 'date >' => $current_date*/
    $this->db->update('subs_used_data',array('status'=>0));
    }
    $array1 = array('id' => $data['subs_id'],'cust_id' => $data['cust_id']);
     $array2 = array('cust_id'=>$data['cust_id']);
      $this->db->where($array1);
       $result = $this->db->update('cust_subscription',$array);
        return $result;
}

function pause_single_package($data,$action){
 $current_date = date('Y-m-d');
    if($action == 'pause'){
        $array = array('current_status' => 1);
         $this->db->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['subs_id'],'date >' => $current_date));/*change 'date >' => $current_date*/
          $this->db->update('package_used_data',array('status'=>2));
    }
    else if($action == 'restart'){
        $array = array('current_status' => 0);
         $this->db->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['subs_id'],'date >' => $current_date));/*change 'date >' => $current_date*/
    $this->db->update('package_used_data',array('status'=>0));
    }
    $array1 = array('id' => $data['subs_id'],'cust_id' => $data['cust_id']);
     $array2 = array('cust_id'=>$data['cust_id']);
      $this->db->where($array1);
       $result = $this->db->update('cust_subscription',$array);
        return $result;
}
function pause_all_the_subscription($data,$action){
    
  if($action == 'pause'){
        $array = array('current_status' => 1);
    }
    else if($action == 'restart'){
        $array = array('current_status' => 0);
    }
    $array1 = array('cust_id' => $data['cust_id']);
    $this->db->where($array1);
    $result = $this->db->update('cust_subscription',$array);
    return $result;
}

function create_order($data){ 
   
      $check = json_decode($data['order_details']);
      $temp_data1=$check;
      $current_date = date('Y-m-d');
      if(strtotime($temp_data1->delivery_date) > strtotime('+1 day',strtotime(date('Y-m-d')))){
        $this->db->insert('orders',$check);
        $result['status'] =1;
        $result['response'] = "Ordered Successfully";
       $result['order_id'] = $this->db->insert_id();
        $temp_data2 = json_decode($data['order_products'],true);
     
        foreach($temp_data2 as $products){
            $data1['order_id'] = $result['order_id'];
            $data1['delivery_date'] = $temp_data1->delivery_date;
            $data1['product_id'] = $products['product_id'];
            $data1['quantity'] = $products['quantity'];
            $data1['weight'] = $products['weight'];
            $data1['basic_weight'] = $products['basic_weight'];
            $data1['price'] = $products['price'];
            $data1['unit'] = $products['unit'];
            $this->db->insert('order_products',$data1);
        }
        // $data2['cust_id'] = $this->db->select('contect_id')->from('customer_registration')->where('id',$check['cust_id'])->get()->row();
        // foreach($temp_data2 as $index=>$products){
        //         $data2['data'][$index]['item_id']= $this->db->select('item_id')->from('products')->where('id',$products['product_id'])->get()->row();
        //         $data2['data'][$index]['quantity'] = $products['quantity'];
        //         $data2['data'][$index]['price'] = $products['price'];
        //      }
        //       $this->load->library('zoho_invoice');
        //         $response['invoice_id'] = $this->zoho_invoice->createInvoice($data2);
        //      $this->db->where('id',$result['order_id'])->update('orders',$response);
            return $result;
      }
    else{
          $temp_data = $this->db->select('delivery_end_timing')->from('settings')->get()->row();
      if(strtotime($temp_data1->delivery_date) == strtotime('+1 day',strtotime(date('Y-m-d')))){
         if($temp_data->delivery_end_timing >= date("H:i:s", strtotime(date('G:i:s')))){
            $this->db->insert('orders',$check);
             $result['status'] =1;
             $result['response'] = "Ordered Succefully";
             $result['order_id'] = $this->db->insert_id();
             $temp_data2 = json_decode($data['order_products'],true);
              foreach($temp_data2 as $products){
               $data1['order_id'] = $result['order_id'];
                $data1['delivery_date'] = $temp_data1->delivery_date;
                $data1['product_id'] = $products['product_id'];
                $data1['quantity'] = $products['quantity'];
                $data1['weight'] = $products['weight'];
                $data1['basic_weight'] = $products['basic_weight'];
                $data1['price'] = $products['price'];
                $data1['unit'] = $products['unit'];
               $this->db->insert('order_products',$data1);
             }
            //  $data2['cust_id'] = $this->db->select('contect_id')->from('customer_registration')->where('id',$check->cust_id)->get()->row();
            //  foreach($temp_data2 as $index=>$products){
            //     $data2['data'][$index]['item_id']= $this->db->select('item_id')->from('products')->where('id',$products['product_id'])->get()->row();
            //     $data2['data'][$index]['quantity'] = $products['quantity'];
            //     $data2['data'][$index]['price'] = $products['price'];
            //  }
            //   $this->load->library('zoho_invoice');
            //     $this->zoho_invoice->createInvoice($data2);
             //$this->db->where('id',$result['order_id'])->update('billing');
            return $result;
        }
         else{
            $result['status'] = 2;
            $result['response'] = "You can't place order after ".$temp_data->delivery_end_timing."for tomorrow, Continue if u want to place same order for ".date('d M, l',strtotime('+2 day',strtotime(date('Y-m-d'))));
            $result['date'] = date('Y-m-d',strtotime('+2 day',strtotime(date('Y-m-d'))));
            return $result;
            
            }
    }
    else{
          if($temp_data->delivery_end_timing >= date("H:i:s", strtotime(date('G:i:s')))){
         $result['status'] = 2;
         $result['response'] = "You can't place order for this day, Continue if u want to place same order for ".date('d M, l',strtotime('+1 day',strtotime(date('Y-m-d'))));
         $result['date'] = date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))));
          }else{
             $result['status'] = 2;
         $result['response'] = "You can't place order for this day, Continue if u want to place same order for ".date('d M, l',strtotime('+2 day',strtotime(date('Y-m-d'))));
         $result['date'] = date('Y-m-d',strtotime('+2 day',strtotime(date('Y-m-d'))));
          }
         return $result;
    }
      
  }
}

function get_orders($data){
    $result['order_details'] = $this->db->select('orders.*,orders.id as order_id, addaddress.*')->from('orders')->join('addaddress','orders.delivery_add_id =  addaddress.id')->where('cust_id',$data['cust_id'])->order_by('orders.id','desc')->get()->result();
    foreach($result['order_details'] as $index => $details){
        $result['order_details'][$index]->order_products = $this->db->select('order_products.*,products.product_name,products.image')->
        from('order_products')->
        join('products','order_products.product_id = products.id')->order_by('order_id','desc')->
        where('order_id',$details->order_id)->get()->result();
    }
    return $result;
}

function get_single_order($data){
   $result['order_details'] = $this->db->select('orders.*,orders.id as order_id, addaddress.*')->from('orders')->join('addaddress','orders.delivery_add_id =  addaddress.id')->where('orders.id',$data['order_id'])->get()->result();
    foreach($result['order_details'] as $index => $details){
        $result['order_details'][$index]->order_products = $this->db->select('order_products.*,products.product_name,products.image')->
        from('order_products')->
        join('products','order_products.product_id = products.id')->order_by('order_id','desc')->
        where('order_id',$details->order_id)->get()->result();
    }
    return $result;
}

function get_cart_price($data){
    $data = json_decode($data['product']);
    foreach($data as $index){
        $result[$index] = $this->db->select("unit_product_mapping.price")->from("unit_product_mapping")->where("unit_product_mapping.tbl_id",$index)->get()->row();
    }
    return $result;
}

function search($term){
  
    $this->db->select('products.id,products.image,products.product_name,products.category_id,products.date,products.details,products.ingredients,products.warnings,products.directives,products.product_status,products.unit');
    $this->db->from('products');
    $this->db->like('product_name',$term['search']);
    $this->db->where('products.is_deleted !=',1);
    $result = $this->db->get()->result();
    foreach($result as $index=>$products){
            $this->db->select('unit_product_mapping.weight,unit_product_mapping.price,unit_product_mapping.max_limit,unit_of_product.unit,unit_product_mapping.tbl_id as unit_id,unit_of_product.basic_weight');
            $this->db->from('unit_product_mapping');
            $this->db->join('unit_of_product','unit_product_mapping.unit_id = unit_of_product.tbl_id','INNER');
            $this->db->where('unit_product_mapping.product_id',$products->id);
            $result1 = $this->db->get()->result();
            $result[$index]->unit_data = $result1;
    }
    return $result;
}
function check_subscription_alert(){
    $data = $this->input->get('cust_id');
    $result = $this->db->where(array('cust_subscription.end_date'=>date('Y-m-d'),'cust_subscription.cust_id'=>$data))->or_where('cust_subscription.end_date',date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d')))))->get('cust_subscription');
    if($result->num_rows() > 0){
        $temp_data = $this->db->select('cust_subscription.*')->from('cust_subscription')->where(array('cust_subscription.end_date'=>date('Y-m-d'),'cust_subscription.cust_id'=>$data))->or_where('cust_subscription.end_date',date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d')))))->get()->result();
        foreach($temp_data as $index=>$temporary_data){
            if($temporary_data->product_id != 0){
                $temp_data1[$index]['product_name'] = $this->db->select('products.*')->from('products')->where('id',$temporary_data->product_id)->get()->result();
            }
            else if($temporary_data['package'] != 0 ){
                 $temp_data1[$index]['package_name'] = $this->db->select('package.name')->from('package')->where('id',$temporary_data->package_id)->get()->result();
        }
     }
    }
    else{
        $temp_data1 = 'No Product Found';
    }
    return $temp_data1;
}

function billing($data,$action = '',$action1=''){
  
    if($action == 'schedular'){
        $end_date = date('Y-m-t');
        $start_date = date('Y-m-01');
        $temp = $this->db->select('cust_subscription.product_id,cust_subscription.cust_id,cust_subscription.id as subscription_id,customer_registration.device_id,customer_registration.first_name,customer_registration.last_name')->from('cust_subscription')->join('customer_registration','cust_subscription.cust_id = customer_registration.id')->where(array('cust_subscription.end_date'=>$end_date))->get()->result();
        foreach($temp as $index => $temp_data){
            if($temp_data->product_id != 0 ){
           $temp_result = $this->db->select('SUM(total_price) as amount,(SUM(extra_qty)+SUM(qty)) as quantity,price')->from('subs_used_data')->where(array('cust_id'=>$temp_data->cust_id,'subscription_id'=>$temp_data->subscription_id,'status'=>1,'subs_used_data.date >='=>$start_date,'subs_used_data.date <='=>$end_date))->get()->row();
           $temp_data1['cust_id'] = $temp[0]->cust_id;
           $temp_data1['subscription_id'] = $temp_data->subscription_id;
           $temp_data1['amount'] = $temp_result->amount;
           $temp_data1['month_bill'] = date('F');
           $temp_data1['due_date'] = date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d'))));
           $result = $this->db->insert('billing',$temp_data1);
           $bill_id = $this->db->insert_id();
           $data = $this->db->select('cust_subscription.product_id,cust_subscription.quantity,cust_subscription.custom_date,subs_used_data.date,cust_subscription.unit_mapping_id')->from('subs_used_data')->join('cust_subscription','subs_used_data.subscription_id = cust_subscription.id')->where(array('subs_used_data.cust_id'=>$temp_data->cust_id,'subs_used_data.subscription_id'=>$temp_data->subscription_id))->order_by('subs_used_data.date','desc')->get()->row();
           $data1['start_date']  = strtotime('+'.$data->custom_date.' day',strtotime($data->date));
                $data->start_date = date('Y-m-d',strtotime('+'.$data->custom_date.' day',strtotime($data->date)));
                 $data->end_date = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
                  $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                    unset($data->date);
                    $data->payment_type = 0;
                    $data->payment_status = 0;
                    $data->payment_mode = 0;
                    $this->db->where('id',$temp_data->subscription_id)->update('cust_subscription',$data);
                     
                    $price = $this->db->select('price')->from('unit_product_mapping')->where('tbl_id',$data->unit_mapping_id)->get()->row();
                     if($data->custom_date == 0){
                         $data->custom_date = 1;
                     }
				 while($data1['start_date'] <= $data1['end_date'])
	        	{	
	              $data2['price'] = $price->price;
	       	       $data2['qty'] = $data->quantity;
	       	        $data2['cust_id'] = $temp_data->cust_id;
	       	         $data2['product_id'] = $data->product_id;
	       	          $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	       $data2['subscription_id'] = $temp_data->subscription_id;
			            $this->db->insert('subs_used_data',$data2);
    			         $data1['start_date'] = strtotime('+'.$data->custom_date.' day', $data1['start_date']); // increment for loop
				 }
            }else{
                 $start_date = date('Y-m-1');
        $end_date = date('Y-m-t');
        $temp_result = $this->db->select('SUM(price) as amount')->from('package_used_data')->where(array('cust_id'=>$temp_data->cust_id,'subscription_id'=>$temp_data->subscription_id,'status'=>1,'package_used_data.date >='=>$start_date,'package_used_data.date <='=>$end_date))->get()->row();
           $temp_data1['cust_id'] = $temp[0]->cust_id;
           $temp_data1['subscription_id'] = $temp_data->subscription_id;
           $temp_data1['amount'] = $temp_result->amount;
           $temp_data1['month_bill'] = date('F');
           $temp_data1['due_date'] = date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d'))));
            $result = $this->db->insert('billing',$temp_data1);
           $bill_id = $this->db->insert_id();
         $data = $this->db->select('cust_subscription.total_weight,cust_subscription.package_id,cust_subscription.package_size_id,cust_subscription.quantity,cust_subscription.custom_date,package_used_data.date')->from('package_used_data')->join('cust_subscription','package_used_data.subscription_id = cust_subscription.id')->where(array('package_used_data.cust_id'=>$temp_data->cust_id,'package_used_data.subscription_id'=>$temp_data->subscription_id))->order_by('package_used_data.date','desc')->get()->row();
          $data1['start_date']  = strtotime('+'.$data->custom_date.' day',strtotime($data->date));
                $data->start_date = date('Y-m-d',strtotime('+'.$data->custom_date.' day',strtotime($data->date)));
                 $data->end_date = date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date']))));
                  $data1['end_date']    = strtotime('+3 day',strtotime(date('Y-m-t',$data1['start_date'])));
                    unset($data->date);
                    $data->remaining_weight = $data->total_weight;
                    $data->payment_type = 0;
                    $data->payment_status = 0;
                    $data->payment_mode = 0;
                    $this->db->where('id',$temp_data->subscription_id)->update('cust_subscription',$data);
                     
                     if($data->custom_date == 0){
                         $data->custom_date = 1;
                     }
				 while($data1['start_date'] <= $data1['end_date'])
	        	{	
	              $data2['price'] = 0;
	       	       $data2['weight'] = 0;
	       	        $data2['cust_id'] = $temp_data->cust_id;
	       	          $data2['date'] = date('Y-m-d',$data1['start_date']);
	        	       $data2['subscription_id'] = $temp_data->subscription_id;
			            $this->db->insert('package_used_data',$data2);
    			         $data1['start_date'] = strtotime('+'.$data->custom_date.' day', $data1['start_date']); // increment for loop
				 }
        
            }
            $data = array();
           $this->load->helper('notification');
            $data['message'] = "Your Bill is Generated Check it Here.";
             $data['first_name'] = $temp_data->first_name;
              $data['last_name'] = $temp_data->last_name;
               $data['device_id'] = $temp[0]->device_id;
                $data['state'] = "app.bill";
                 create_notification($data);
        //   $temp_data1['cust_id'] = $temp[0]->contect_id;
        //   $temp_data1['amount'] = $temp_result->price;
        //   $temp_data1['customer_name'] = ucfirst($temp[0]->first_name).' '.ucfirst($temp[0]->last_name);
        //   $temp_data1['salesperson_name'] = "Mohit Yadav";
        //   $temp_data1['quantity'] = $temp_result->quantity;
        //   $response['invoice_id'] = $this->zoho_invoice->createInvoice($temp_data1);
        //   $this->db->where('billing_id',$bill_id)->update('billing',$response);
        }
        
       header("Location: ".base_url()."Customer_ctrl/view_bills");
      // return $result;
    }
    elseif($action == 'customer'){
        if($action1 == 'package'){
        $start_date = date('Y-m-1');
        $end_date = date('Y-m-t');
        $temp_data['due_date'] = date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d'))));
        $temp_data['subscription_id'] = $data['sub_id'];
        $temp_data['cust_id'] = $data['cust_id'];
        $temp_data['month_bill'] = date('F');
        $amount = $this->db->select('SUM(price) as amount')->from('package_used_data')->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['sub_id'],'status'=>1,'is_selected'=>1,'date >='=>$start_date,'date<='=>$end_date))->get()->row();
        //$amount = $this->db->select('SUM(total_price) as amount')->from('subs_used_data')->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['sub_id'],'status'=>1,'date >='=>$start_date,'date<='=>$end_date))->get()->row();
       $temp_date2['current_status'] = 4;
         $result = $this->db->where(array('cust_id'=>$data['cust_id'],'id'=>$data['sub_id']))->update('cust_subscription',$temp_date2);
        if(!empty($amount)){
            $temp_data['amount'] = $amount->amount;
        $result = $this->db->insert('billing',$temp_data);
        }
        
        return $result;
        }
        
        else if($action1 == ''){
        $start_date = date('Y-m-1');
        $end_date = date('Y-m-t');
        $temp_data['due_date'] = date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d'))));
        $temp_data['subscription_id'] = $data['sub_id'];
        $temp_data['cust_id'] = $data['cust_id'];
        $temp_data['month_bill'] = date('F');
        //$amount = $this->db->select('SUM(total_price) as amount')->from('subs_used_data')->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['sub_id'],'status'=>1))->get()->row();
        $amount = $this->db->select('SUM(total_price) as amount')->from('subs_used_data')->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['sub_id'],'status'=>1,'date >='=>$start_date,'date<='=>$end_date))->get()->row();
        $temp_data['amount'] = $amount->amount;
        $temp_date2['current_status'] = 4;
        $this->db->where(array('cust_id'=>$data['cust_id'],'id'=>$data['sub_id']))->update('cust_subscription',$temp_date2);
        $result = $this->db->insert('billing',$temp_data);
        return $result;
    }
        
    }
}
function show_bill($data){
    $result = $this->db->select('DISTINCT(cust_subscription.id) as subscription_id,customer_registration.first_name,customer_registration.due_amount,cust_subscription.*,customer_registration.last_name,billing.*,addaddress.address,addaddress.apartment')->from('billing')->join('cust_subscription','billing.subscription_id = cust_subscription.id')->join('addaddress','cust_subscription.delivery_add_id = addaddress.id')->join('customer_registration','billing.cust_id = customer_registration.id')->where(array('billing.cust_id'=>$data['cust_id']))->order_by('cust_subscription.id','desc')->get()->result();
    if(isset($result[0]->id)){
        foreach($result as $index=>$temp){
       // $result[$index]->total_quantity = $this->db->select('(SUM(extra_qty)+SUM(qty)) as total_quantity')->from('subs_used_data')->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$temp->subscription-id))->get()->result();
        if($temp->package_id != 0){
             $result[$index]->product = $this->db->select('package.package_name as product_name,package.image')->from('package')->where('package.id',$temp->package_id)->get()->result(); 
         }
         else if($temp->product_id != 0){
            $result[$index]->product = $this->db->select('products.product_name,products.image')->from('products')->where('products.id',$temp->product_id)->get()->result();
        }
        }
    }
    else{
        $result = '';
    }
   return $result;
}

function show_billing_details($data){
    $start_date = date('Y-m-01',strtotime(date('M',strtotime($data['month']))));
    $end_date = date('Y-m-t',strtotime(date('M',strtotime($data['month']))));
    $temp_data = $this->db->select('cust_subscription.product_id')->from('cust_subscription')->where(array('cust_id'=>$data['cust_id'],'id'=>$data['subs_id']))->get()->row();
    if($temp_data->product_id != 0){
           $result = $this->db->select('subs_used_data.*,addaddress.address,products.image,products.product_name')->from('subs_used_data')->join('cust_subscription','cust_subscription.id = subs_used_data.subscription_id')->join('addaddress','cust_subscription.delivery_add_id = addaddress.id')->join('products','cust_subscription.product_id = products.id')->where(array('subs_used_data.date >='=>$start_date,'subs_used_data.date <='=>$end_date,'subs_used_data.cust_id'=>$data['cust_id'],'subs_used_data.subscription_id'=>$data['subs_id'],'subs_used_data.status'=>1))->get()->result();
    }
    else{
         $result = $this->db->select('package_used_data.*,package_used_data.weight as qty,addaddress.address')->from('package_used_data')->join('cust_subscription','cust_subscription.id = package_used_data.subscription_id')->join('addaddress','cust_subscription.delivery_add_id = addaddress.id')->where(array('package_used_data.date >='=>$start_date,'package_used_data.date <='=>$end_date,'package_used_data.cust_id'=>$data['cust_id'],'package_used_data.subscription_id'=>$data['subs_id'],'package_used_data.status'=>1))->get()->result();
         foreach($result as $index=>$temp){
             $result[$index]->extra_qty = 0;
         }
    }
    return $result;
}
  
function done_payment($data){
    if($data['payment_status'] == 0){
        $temp['payment_status'] = 0;
    $temp['payment_status_text'] = "Cancelled";
    $this->db->where('id',$data['order_id'])->delete('orders');
    $this->db->where('order_id',$data['order_id'])->delete('order_products');
    }
    else if($data['payment_status'] == 1){

        $data2['cust_id'] = $this->db->select('contect_id')->from('customer_registration')->where('id',$check['cust_id'])->get()->row();
        foreach($temp_data2 as $index=>$products){
                $data2['data'][$index]['item_id']= $this->db->select('item_id')->from('products')->where('id',$products['product_id'])->get()->row();
                $data2['data'][$index]['quantity'] = $products['quantity'];
                $data2['data'][$index]['price'] = $products['price'];
             }
              $this->load->library('zoho_invoice');
                $response['invoice_id'] = $this->zoho_invoice->createInvoice($data2);
        $temp['payment_status'] = 1;
    $temp['payment_status_text'] = "Success";
    }
    else if($data['payment_status'] == 2){
        $temp['payment_status'] = 2;
    $temp['payment_status_text'] = "Failed";
    $this->db->where('id',$data['order_id'])->delete('orders');
    $this->db->where('order_id',$data['order_id'])->delete('order_products');
    }
    $temp['paid_date'] = date('Y-m-d');
    
    $temp['payment_gateway'] = $data['payment_gateway'];
    $temp['transaction_id'] = $data['transaction_id'];
    $result = $this->db->where(array('orders.id'=>$data['order_id']))->update('orders',$temp);
    return $result;
}

function done_billing($data){
    $temp_data['payment_type'] =$data['payment_type'];
    $temp_data['payment_status'] = 1;
    $temp['transaction_id'] = $data['transaction_id'];
    $temp_data2['due_amount'] = 0;
    $this->db->where('id',$data['cust_id'])->update('customer_registration',$temp_data2);
    $temp_data['payment_date'] =date('Y-m-d');
    $temp_data['payment_time'] =date('h:i:s');
    $result = $this->db->where(array('cust_id'=>$data['cust_id'],'payment_status !='=>1))->update('billing',$temp_data);
    return $result;
}
function check_user_verif($data){
    $result = $this->db->where(array('id'=>$data['cust_id'],'is_verified'=>0))->get('customer_registration');
    if($result->num_rows()>0){
        $result = 1;
    }else{
        $result = 0;
    }
    return $result;
}

function upgrade_package($data){
    $data = $this->db->where('id',$data['subs_id'])->get('cust_subscription')->row();
    $temp_data = $this->db->where('id',$data->package_size_id)->get('package_size')->row();
    $result_data = array('remaining_weight'=>($temp_data->weight_in_kg*1000)+$data->remaining_weight);
    $temp = $this->db->where('id',$data->id)->update('cust_subscription',$result_data);
    if($temp){
    $result['status'] = 1;
    $result['message'] = "Your Subscription is Upgraded.You Have Remaining Weight ".$result_data['remaining_weight'];
    }else{
        $result['status'] = 0;
        $result['message'] = "Unable to Upgrade weight";
    }
    return $result;
}
function complaint($data){
    $result = $this->db->insert('complaints',$data);
    return $result;
}

}
