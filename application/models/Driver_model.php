 <?php
//header("Access-Control-Allow-Origin: *");
class Driver_model extends CI_Model {

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
                   
                  $data['unique_id']= md5(mt_rand(100000,999999));
                  $result = $this->db->insert('customer_registration', $data);
                  $insert_id = $this->db->insert_id();
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

public function driver_login($data) 
  {         
              $this->db->select('id,first_name,last_name,user_name,phone');
              $this->db->from('driver_user');
              $array = array("user_name" => $data['email'],"password"=>$data['password']);
              $this->db->where($array);
              $result = $this->db->get()->row();
              //print_r($query_value);
              // exit();
            
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
          $rand_pwd= random_string('alnum', 8);
          $password=array('password'=>($rand_pwd));                 
          $this->db->where('email',$email);
          $query=$this->db->update('customer_registration',$password);
              if($query)
              {
		//return $result;
				   $configs = array(
						'protocol'=>'smtp',
						'smtp_host'=>$settings->smtp_host,
						'smtp_user'=>$settings->smtp_username,
						'smtp_pass'=>$settings->smtp_password,
						'smtp_port'=>'587'
						);             
                $this->load->library('email');
			    $this->email->initialize($configs);
                $this->email->from($from_email, $first_name);
                $this->email->to($email);
                $this->email->subject('Forget Password');
                $this->email->message('New Password is '.$rand_pwd.' ');
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
function get_products($cat_id){
    $this->db->select('products.id,products.image,products.product_name,products.category_id,products.date,products.details,products.ingredients,products.warnings,products.directives,products.product_status,products.unit');
    $this->db->from('products');
    $this->db->where('products.category_id',$cat_id);
    $this->db->where('products.is_deleted !=',1);
    $result = $this->db->get()->result();
    foreach($result as $index=>$products){
        
            $this->db->select('unit_product_mapping.weight,unit_product_mapping.price,unit_of_product.unit,unit_product_mapping.tbl_id as unit_id,unit_of_product.basic_weight');
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

  $result['package_size'] = $this->db->select('*')->from('package_size')->where('package_id',$pack_id)->get()->result();
    return $result;
    
}

function get_customer_address($customer_id,$address_id=''){
    if(empty($address_id)){
     $result = $this->db->select("*")->from('addaddress')->where('user_id',$customer_id)->get()->result();
    }
    else{
    $result = $this->db->select("*")->from('addaddress')->where('id',$address_id)->get()->result();
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
        
    $result = $this->db->insert('addaddress',$customer_address);
    // }else{
    //     $result =0;
    // }
    return $result;
    
}

function get_cust_subs($cust_data){
    
    // $month_end_date = Date('Y-m-t');
    // $month_start_date = Date('Y-m-1');
    $array = array('cust_id'=>$cust_data['cust_id']);
    $result = $this->db->select('cust_subscription.*,products.image,products.product_name')->from('cust_subscription')->join('products','cust_subscription.product_id = products.id')->where($array)->get()->result();
    return $result;
    
}

function get_single_subs_data($cust_data){
    
    $array = array('cust_id'=>$cust_data['cust_id'],'subscription_id'=>$cust_data['sub_id'],'product_id'=>$cust_data['product_id']);
    $result['product'] = $this->db->select('cust_subscription.*,products.image,products.product_name,unit_product_mapping.*,unit_of_product.unit')->from('cust_subscription')->join('products','cust_subscription.product_id = products.id')->join('unit_product_mapping','cust_subscription.unit_mapping_id = unit_product_mapping.tbl_id')->join('unit_of_product','unit_product_mapping.unit_id = unit_of_product.tbl_id')->where(array('cust_subscription.cust_id'=>$cust_data['cust_id'],'cust_subscription.product_id'=>$cust_data['product_id'],'cust_subscription.unit_mapping_id' => $cust_data['unit_mapping_id']))->get()->result();
    $result['product_detail'] = $this->db->select('subs_used_data.*')->from('subs_used_data')->where($array)->get()->result();
    return $result;
    
}

function add_extra_quantity($data){
  
    $temp_data = $this->db->select('delivery_end_timing')->from('settings')->get()->row();
    if($temp_data->delivery_end_timing >= date("H:i:s", strtotime(date('G:i:s')))){
      $data1 = array('extra_qty'=>$data['extra_qty']);
    $array = array('cust_id'=>$data['cust_id'],'id'=>$data['id']);
    $this->db->where($array);
    $result['response'] = $this->db->update('subs_used_data',$data1);
    $result['time'] = $temp_data->delivery_end_timing;
    }
    else{
        $result['response'] = 0;
        $result['time'] = $temp_data->delivery_end_timing;
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
   for($i=0;$i<count($data['product_data']);$i++){
        $data2['product_id'] = $data['product_data'][$i]['product_id'] ;
        $data2['unit_id'] = $data['product_data'][$i]['unit_id'] ;
        $data2['basic_weight'] = $data['product_data'][$i]['basic_weight'] ;
        $data2['quantity'] = $data['product_data'][$i]['quantity'] ;
        $data2['cust_id'] = $data['cust_id'] ;
        $data2['subscription_id'] = $data['product_data'][$i]['subscription_id'] ;
        $data2['total_weight'] = $data['product_data'][$i]['total_weight'] ;
         $result = $this->db->insert('next_day_needs',$data2);
    }
    //  }
     
    // else{
    //     $result['response'] = "You can't place order after 6pm, Continue if u want to place same order for Day After Tommorow";
    //     $result['time'] = $temp_data->delivery_end_timing;
    // }
        return $result;
}

function pause_single_subscription($data,$action){
 $current_date = date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))));
    if($action == 'pause'){
        $array = array('current_status' => 1);
         $this->db->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['subs_id'],'date >' => $current_date));
          $this->db->update('subs_used_data',array('status'=>2));
    }
    else if($action == 'restart'){
        $array = array('current_status' => 0);
         $this->db->where(array('cust_id'=>$data['cust_id'],'subscription_id'=>$data['subs_id'],'date >' => $current_date));
    $this->db->update('subs_used_data',array('status'=>0));
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
    }else if($action == 'restart'){
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
      if(strtotime($temp_data1->delivery_date) > strtotime($current_date)){
      $temp_data = $this->db->select('delivery_end_timing')->from('settings')->get()->row();
       if(strtotime($temp_data1->delivery_date) == strtotime('+1 day',strtotime(date('Y-m-d')))){
    if($temp_data->delivery_end_timing >= date("H:i:s", strtotime(date('G:i:s')))){
        
    }
   
    else{
      $check->order_date = date('Y-m-d');
      $result['status'] = $this->db->insert('orders',$check);
      $id = $this->db->insert_id();
      $temp_data2 = json_decode($data['order_products'],true);
     
    foreach($temp_data2 as $products){
        
        $data1['order_id'] = $id;
        $data1['delivery_date'] = $temp_data1->delivery_date;
        $data1['product_id'] = $products['product_id'];
        $data1['quantity'] = $products['quantity'];
        $data1['weight'] = $products['weight'];
        $data1['basic_weight'] = $products['basic_weight'];
        $data1['price'] = $products['price'];
        $data1['unit'] = $products['unit'];
        $this->db->insert('order_products',$data1);
    }
     return $result;
    }
       }
    else{
        $result['status'] = 2;
        $result['response'] = "You can't place order after ".$temp_data->delivery_end_timing.", Continue if u want to place same order for ".date('Y-m-d',strtotime('+2 day',strtotime(date('Y-m-d'))));
        $result['date'] = date('Y-m-d',strtotime('+2 day',strtotime(date('Y-m-d'))));
         return $result;
    }
      }
      else{
        $result['status'] = 2;
        $result['response'] = "You can't place order for ".$temp_data1->delivery_date.", Continue if u want to place same order for ".date('Y-m-d',strtotime('+2 day',strtotime(date('Y-m-d'))));
        $result['date'] = date('Y-m-d',strtotime('+2 day',strtotime(date('Y-m-d'))));
        return $result;
      }
}

function get_orders($data){
    $result['order_details'] = $this->db->select('*')->from('orders')->where('cust_id',$data['cust_id'])->order_by('id','desc')->get()->result();
    
    foreach($result['order_details'] as $index => $details){
    
        $result['order_details'][$index]->order_products = $this->db->select('order_products.*,products.product_name,products.image')->
        from('order_products')->
        join('products','order_products.product_id = products.id')->order_by('order_id','desc')->
        where('order_id',$details->id)->get()->result();
    }
    return $result;
}
function get_cart_price($data){
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
        
            $this->db->select('unit_product_mapping.weight,unit_product_mapping.price,unit_of_product.unit,unit_product_mapping.tbl_id as unit_id,unit_of_product.basic_weight');
            $this->db->from('unit_product_mapping');
            $this->db->join('unit_of_product','unit_product_mapping.unit_id = unit_of_product.tbl_id','INNER');
            $this->db->where('unit_product_mapping.product_id',$products->id);
            $result1 = $this->db->get()->result();
        $result[$index]->unit_data = $result1;
    }
    return $result;
}

function get_today_orders(){
    
      $current_date = date('Y-m-d');
      $result['subscription'] = $this->db->select('cust_subscription.cust_id,cust_subscription.time_slot,cust_subscription.product_id,customer_registration.first_name,customer_registration.last_name,cust_subscription.package_id,cust_subscription.package_size_id,cust_subscription.id as subscription_id,addaddress.address,customer_registration.phone as mobno,addaddress.address,addaddress.apartment,addaddress.zip')->from('cust_subscription')->join('customer_registration','cust_subscription.cust_id = customer_registration.id')->join('addaddress','cust_subscription.delivery_add_id = addaddress.id')->join('subs_used_data','cust_subscription.id = subs_used_data.subscription_id')->where(array('subs_used_data.date'=>$current_date,'subs_used_data.status!='=>2,'subs_used_data.status!='=>1))->get()->result();
      $result['package'] = $this->db->select('cust_subscription.cust_id,cust_subscription.time_slot,cust_subscription.product_id,customer_registration.first_name,customer_registration.last_name,cust_subscription.package_id,cust_subscription.package_size_id,cust_subscription.id as subscription_id,customer_registration.phone as mobno,addaddress.address,addaddress.apartment,addaddress.zip')->from('cust_subscription')->join('customer_registration','cust_subscription.cust_id = customer_registration.id')->join('addaddress','cust_subscription.delivery_add_id = addaddress.id')->join('package_used_data','cust_subscription.id = package_used_data.subscription_id')->where(array('package_used_data.date'=>$current_date,'package_used_data.status!='=>2,'package_used_data.status!='=>1,'package_used_data.is_selected'=>1))->get()->result();
      $result['orders'] = $this->db->select('orders.id as order_id,orders.cust_id,orders.delivery_time,customer_registration.first_name,customer_registration.last_name,addaddress.address,addaddress.mobno')->from('orders')->join('customer_registration','orders.cust_id = customer_registration.id')->join('addaddress','orders.delivery_add_id = addaddress.id')->where(array('orders.delivery_date'=>$current_date,'orders.status !='=>1))->get()->result();
      
      return $result;
	         
}

function get_today_orders_details($action='',$sec_action='',$data='',$subscription_id =''){

    $current_date = date('Y-m-d');
    if($action == 'subscription'){
       if($sec_action == 'package'){
           $result['package_products'] = $this->db->select('next_day_needs.*,products.product_name,products.image')->from('next_day_needs')->join('products','next_day_needs.product_id = products.id')->where(array('next_day_needs.package_id'=>$data,'next_day_needs.subscription_id'=>$subscription_id))->get()->result(); 
            $result['subscription_id'] = $subscription_id;
            return $result;
       }
       else if($sec_action == 'product'){
            $result['package_products'] = $this->db->select('unit_product_mapping.weight,unit_product_mapping.tbl_id as unit_mapping_id,products.product_name,products.image,(SUM(extra_qty)+SUM(qty)) as quantity,subs_used_data.id ,subs_used_data.subscription_id,products.id as product_id')->from('subs_used_data')->join('cust_subscription','subs_used_data.subscription_id = cust_subscription.id')->join('unit_product_mapping','cust_subscription.unit_mapping_id = unit_product_mapping.tbl_id')->join('products','subs_used_data.product_id = products.id')->where(array('subs_used_data.date'=>$current_date,'subs_used_data.subscription_id'=>$data,'subs_used_data.status != '=>2,'subs_used_data.status!='=>1))->get()->result(); 
            return $result;
       }
    }
    else if($action == 'orders'){
        $data = $this->uri->segment(4);
        $current_date = date('Y-m-d');
        $result['package_products'] = $this->db->select('order_products.*,products.id as product_id,products.product_name,products.image')->from('order_products')->join('products','order_products.product_id = products.id')->join('orders','order_products.order_id = orders.id')->where(array('order_products.order_id'=>$data,'orders.status !='=>1))->get()->result();
       return $result;
    }
}

function delivery_service($action='',$data=''){
    
    if($action == 'delivery'){
        if($data['type'] == 'package'){
            $temp['status'] = 1;
            $temp['Time'] = date('H:i:s');
      
        $result = $this->db->where(array('package_id'=>$data['package_id'],'subscription_id'=>$data['subscription_id'],'date'=>date('Y-m-d')))->update('package_used_data',$temp);
        $temp_data = $this->db->select('weight')->from('package_used_data')->where(array('package_id'=>$data['package_id'],'subscription_id'=>$data['subscription_id'],'date'=>date('Y-m-d')))->get()->row();
        $temp_weight = $this->db->select('remaining_weight')->from('cust_subscription')->where(array('package_id'=>$data['package_id'],'id'=>$data['subscription_id']))->get()->row();
        $insert['remaining_weight'] =  $temp_weight->remaining_weight - $temp_data->weight ;
        $this->db->where(array('package_id'=>$data['package_id'],'id'=>$data['subscription_id']))->update('cust_subscription',$insert);
        return $result;
        }
        else if($data['type'] == 'subscription'){
        $temp['qty'] = $data['quantity'];
        $temp['status'] = 1;
        $temp['Time'] = date('H:i:s');
        $temp2 = $this->db->select('(SUM(extra_qty)+SUM(qty)) as total_quantity')->from('subs_used_data')->where(array('subscription_id'=>$data['subscription_id'],'id'=>$data['table_id']))->get()->row();
        $temp1= $this->db->select('price')->from('unit_product_mapping')->where('tbl_id',$data['unit_mapping_id'])->get()->row();
        $temp['price'] = $temp1->price;
        $temp['total_price'] = $temp1->price*($temp2->total_quantity+$data['quantity']);
        $result = $this->db->where('id',$data['table_id'])->update('subs_used_data',$temp);
        
        return $result;
        }
        else if($data['type'] == 'order'){
        $temp['status'] = 1;
        $temp['received_time'] = date('H:i:s');
        $result = $this->db->where('id',$data['order_id'])->update('orders',$temp);
        return $result;
        }
    }
    else if($action == 'on_route'){
        
         if(!empty($data['package'])){
            $temp['status'] = 3;
            $temp['Time'] = date('H:i:s');
        $result = $this->db->where(array('date'=>date('Y-m-d'),'subscription_id'=>$data['package']))->update('package_used_data',$temp);
       
        }
        if(!empty($data['subscription'])){
            $temp =array();
             $temp['status'] = 3;
             $temp['Time'] = date('H:i:s');
             $temp_data2 = $this->db->select('product_id')->from('subs_used_data')->where(array('date'=>date('Y-m-d'),'subscription_id'=>$data['subscription']))->get()->row();
        $result = $this->db->where(array('date'=>date('Y-m-d'),'subscription_id'=>$data['subscription']))->update('subs_used_data',$temp);
        
        }
        if(!empty($data['orders'])){
              $temp =array();
        $temp['status'] = '3';
        $temp['received_time'] = date('H:i:s');
            $result = $this->db->where(array('delivery_date'=>date('Y-m-d'),'orders.id'=>$data['orders']))->update('orders',$temp);
       
        }
        return $result;
    }
}

function generate_bill(){
     
     $result = $this->db->select('DISTINCT(billing.cust_id),customer_registration.first_name,customer_registration.last_name')->from('billing')->join('customer_registration','billing.cust_id = customer_registration.id')->where('billing.payment_status!=1')->get()->result();
    foreach($result as $index=>$temp){
      // $result[$index]->address = $this->db->select('addaddress.address')->from('addaddress')->join('cust_subscription','addaddress.id = cust_subscription.delivery_add_id')->where(array('cust_subscription.id'=>$temp->subscription_id))->get()->result();
       $result[$index]->total_amount = $this->db->select('SUM(amount) as total_amount,billing.subscription_id')->from('billing')->where(array('cust_id'=>$temp->cust_id))->get()->result();
       $result[$index]->due_amount = $this->db->select('due_amount')->from('customer_registration')->where('id',$temp->cust_id)->get()->result();
    }
    //$result = $this->db->select('DISTINCT(billing.cust_id),customer_registration.first_name,customer_registration.last_name')->from('billing')->join('addaddress','billing.addaddress_id = addaddress.id')->join('customer_registration','billing.cust_id = customer_registration.id')->get()->result();
   return $result;
    
}

function pay_bill($data){
     $temp_data['payment_type'] = 'cash';
    $temp_data['payment_status'] =1;
    $temp_data2['due_amount'] = $data['due_amount'];
    $temp_data['payment_date'] =date('Y-m-d');
    $temp_data['payment_time'] =date('h:i:s');
     $this->db->where(array('cust_id'=>$data['cust_id']))->update('billing',$temp_data);
     $result = $this->db->where(array('id'=>$data['cust_id']))->update('customer_registration',$temp_data2);
     return $result;
}
function verification(){
    $result = $this->db->select('DISTINCT(cust_subscription.cust_id),customer_registration.phone,customer_registration.email,customer_registration.first_name,customer_registration.last_name')->from('cust_subscription')->join('customer_registration','cust_subscription.cust_id = customer_registration.id ')->join('addaddress','cust_subscription.cust_id = addaddress.user_id')->where('addaddress.is_verified',0)->get()->result();
    foreach($result as $index=>$temp_data)
    $result[$index]->address =$this->db->select('address,id as address_id,apartment,zip')->from('addaddress')->where('user_id',$temp_data->cust_id)->order_by('id','desc')->limit('1')->get()->result();
    return $result;
}


// function update_verification($data){
//     $temp_data = array('is_verified'=>1);
//     $result = $this->db->where('id',$data['cust_id'])->update('customer_registration',$temp_data);

//     return $result;
// }

}
