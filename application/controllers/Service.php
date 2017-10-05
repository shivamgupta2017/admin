<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
include(APPPATH.'libraries/REST_Controller.php');
class Service extends REST_Controller{

function __construct()
    {
        parent::__construct();
       $this->load->model('basic');
       $this->load->database();
       $this->load->library('form_validation');
       $this->load->helper('notification');
       $this->load->helper('email');
       date_default_timezone_set('Asia/Kolkata');
 }
 
function serviceResponse($data=array(),$response,$status=0)
     {
            $data = array('data'=>$data);
            $response = array('message'=>$response,'status'=>$status);
            $result = array();
            array_push($result,$data);
            array_push($result,array('response'=>$response));
            $this->response(json_decode(json_encode ($result), true), 200); 
     }  
     
function create_message($data){
    if(!empty($data)){
        $status = 1;
        $message = "Request Executed Successfully";
    }
    else{
        $status = 0;
        $message = "Unable to Executed Request";
    }
    $this->serviceResponse($data,$message,$status);
}

  public function get_products_post(){
     $where['where'] = array('{PRE}products.is_deleted'=>'0');
     $result = $this->basic->get_data('{PRE}products',$where,'*');
     $this->create_message($result);
  }
  
  public function get_product_details_post(){
     $data = $this->basic->get_file_content();
     $where['where'] = array('{PRE}product_details.product_id' => $data['product_id'],'{PRE}product_details.is_deleted'=>0);
     $join = array("unit_product_mapping" => "{PRE}unit_of_product.unit_product_id = {PRE}unit_product_mapping.unit_id,inner");
     $result['product_details'] = $this->basic->get_data('{PRE}product_details',$where,'{PRE}product_details.*');
     $where['where'] = array('{PRE}unit_product_mapping.product_id'=>$data['product_id']);
     $result['unit_details'] = $this->basic->get_data('{PRE}unit_of_product',$where,'{PRE}unit_of_product.*,{PRE}unit_product_mapping.*',$join);
     $this->create_message($result);
  }
  public function store_kyc_request_post()
  {
      $data = $this->basic->get_file_content();
      $result = $this->basic->insert_data('{PRE}kyc_requests',$data);
      $this->create_message($result);
  }
  public function create_order_post(){
     $data = $this->basic->get_file_content();
     $user_id = $data['user_id'];
     $temp['user_id'] = $data['user_id'];
     $temp['order_date'] = date('Y-m-d');
     $temp['order_status'] = "Pending";
     $temp['delivery_date'] = $data['delivery_date'];
     $temp['is_express'] = $data['is_express'];
     $temp['selected_address_id'] = $data['selected_address_id'];
     $data['order_id'] = $this->basic->insert_data_id('{PRE}orders',$temp);
     if($data['is_express']){
         web_push();
     }else{
          web_push1();
     }
     foreach($data['order_products'] as $index=>$temp3)
     {
     $where['where']=array('{PRE}product_details.product_id'=>$temp3['product_id'],'{PRE}unit_product_mapping.unit_product_mapping_id'=>$temp3['unit_mapping_id']);
     $join=array('{PRE}unit_product_mapping'=>'{PRE}product_details.product_id = {PRE}unit_product_mapping.product_id,inner',
                    '{PRE}unit_of_product'=>'{PRE}unit_product_mapping.unit_id = {PRE}unit_of_product.unit_product_id,inner');
      $select = '{PRE}product_details.*,{PRE}unit_of_product.*,{PRE}unit_product_mapping.price,{PRE}unit_product_mapping.weight';
      $temp_data = $this->basic->get_data('{PRE}product_details',$where,$select,$join);
      $temp3['name'] = $temp_data[0]->product_name;
      $temp3['order_id'] = $data['order_id'];
      $temp3['price'] = $temp_data[0]->price;
      $temp3['total_price'] = $temp_data[0]->price*$temp3['quantity'];
      $temp3['size'] = $temp_data[0]->weight;
      unset($data['user_id'],$data['delivery_date'],$temp3['unit_mapping_id']);
      $temp4['data'][$index] = $temp3;
      $this->basic->insert_data('{PRE}order_products',$temp3);
    }
    if($data['order_id']){
                 $user_details = $this->basic->get_data('{PRE}users',array('where'=>array('user_id'=>$user_id)),'email');
                   $message = $this->load->view('Templates/email',$temp4,true);
                    $mail_data = array('first_name'=>'Minbazaar','email'=>$user_details[0]->email,'message'=>$message,'subject'=>'Order Confirmation');
                     send_mail($mail_data);
                     $user_data = $this->basic->get_data("{PRE}orders",array('where'=>array('id'=>$data['order_id'])),'user_id');
                       $temp_data = $this->basic->get_data('{PRE}users',array('where'=>array('user_id'=>$user_data[0]->user_id)));
                        // $data2['message'] = "Order confirmation";
                        //  $data2['first_name'] =  $temp_data[0]->first_name;
                        //   $data2['last_name'] =  $temp_data[0]->last_name;
                        //   $data2['device_id'] = $temp_data[0]->player_id;
                        //     $data2['link'] = '';
                        //      create_notification($data2);
     }
     $this->create_message($data['order_id']);
  }
  
  public function login_post(){
     $data = $this->basic->get_file_content();
     $select = array('email','first_name','last_name','user_id', 'is_pass_changed');
     $where = array('email' => $data['email'],'password' => sha1($data['password']),'active'=>1);
     $result = $this->basic->is_unique_id('{PRE}users',$where,'',$select);
     if($result){
     $where = array('user_id'=>$result->user_id);     
     $temp['player_id'] = $data['player_id'];
     $this->basic->update_data('{PRE}users',$where,$temp);
     }
     
     $this->create_message($result);
  }
  
  public function get_orders_post(){
    $data = $this->basic->get_file_content();
    $where['where'] = array('user_id'=>$data['user_id']);
    $result = $this->basic->get_data('{PRE}orders',$where,'*','','','','id desc');
    $join = array('orders'=>'update_order_history.order_id = orders.id,inner');
    $check = $this->basic->get_data('{PRE}update_order_history',array('orders.user_id'=>$data['user_id']),'*',$join);
    if(!empty($check)){$result[0]->is_updated = 1;}
     $this->create_message($result);
  }
  

  public function get_order_details_post(){
    $data = $this->basic->get_file_content();
    $where['where'] = array('order_id'=>$data['order_id'],'is_verified !='=>1);
    $result = $this->basic->get_data('{PRE}order_products',$where,'*');
    $this->create_message($result);
  }
  
  public function update_order_post()
  {
      $data = $this->basic->get_file_content();
      foreach($data['product_details'] as $temp)
      {
            $temp['order_id'] = $data['order_id'];
            $result = $this->basic->insert_data('{PRE}update_order',$temp);
      }
      $this->create_message($result);
  }
  
  public function store_concern_post()
  {
       if(!empty($_FILES)){$data = $this->basic->get_post_data();
       $image_name = explode('?',$_FILES['file']['name']);
       $data['image_link'] = base_url()."uploads/concerns/".$image_name[0];
       move_uploaded_file($_FILES['file']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/admin/uploads/concerns/".$image_name[0]);
       }
       else{
        $data = $this->basic->get_file_content();
      }
        $temp = $this->basic->get_data('{PRE}users',array('where'=>array('user_id'=>$data['user_id'])),'*');
        $data['phone'] = $temp[0]->phone;
        $data['email'] = $temp[0]->email;
        $data['name']  = $temp[0]->first_name.' '.$temp[0]->last_name;
        $data['order_id'] = $data['selected_order_id'];
        unset($data['selected_order_id']);
        $result = $this->basic->insert_data('{PRE}complaints',$data);
        $this->create_message($result);
  }
  
  public function express_shipping_charges_post()
  {
    $data = $this->basic->get_file_content();
    $query = $this->db->select('{PRE}city.express_shipping_charges')->from('{PRE}city')
    ->join('{PRE}users', '{PRE}users.zipcode = {PRE}city.postal_code', 'inner')
    ->where('{PRE}users.user_id', $data['user_id'])
    ->get()->row();
    $this->create_message($query);
  }
  public function change_user_password_post()
  {
      $data = $this->basic->get_file_content();
      $where = array('password'=>sha1($data['current']));
      $check = $this->basic->is_exist('users',$where,'*');
      if(!empty($check)){
        $query = $this->db->set('password', sha1($data['current']))->set('is_pass_changed','1')->where('user_id',$data['user_id'])->update('{PRE}users');
      }else{
          $query = 0;
      }
      $this->create_message($query);
  }
  
  public function get_pass_changed_status_post()
  {
      $data=$this->basic->get_file_content();
      $query = $this->db->select('is_pass_changed')->from('{PRE}users')->where('{PRE}users.user_id', $data['user_id'])->get()->row();
     $this->create_message($query);
  }
  public function get_local_data_back_post()
  {
      $data=$this->basic->get_file_content();
        $final_result=array();
        foreach ($data as $index=>$row)
        {
            $where['where'] = array('{PRE}product_details.product_id' => $row['product_id'],'{PRE}product_details.is_deleted'=>0);
            $result['product_details'] = $this->basic->get_data('{PRE}product_details',$where,'{PRE}product_details.*');
            $join = array("{PRE}unit_of_product" => "{PRE}unit_product_mapping.unit_id  = {PRE}unit_of_product.unit_product_id,inner");
            $where['where'] = array('{PRE}unit_product_mapping.unit_product_mapping_id'=>$row['unit_product_mapping_id']);
            $temp = $this->basic->get_data('{PRE}unit_product_mapping',$where,'{PRE}unit_product_mapping.*,{PRE}unit_of_product.*',$join);
            $result['product_details'][$index]->unit = $temp[0]; 
            array_push($final_result,$result);
        }
      $this->create_message($final_result);
  }

  public function verify_order_post(){
      $data = $this->basic->get_file_content();
      $id = $data['order_id'];
      foreach(json_decode($data['order_details'],true) as $temp){
           $where = array('order_id'=>$data['order_id'],'product_id'=>$temp['product_id'],'size'=>$temp['size']);
           $result = $this->basic->update_data('{PRE}order_products',$where,array('is_verified'=>1));
      }
      if($data['status'] == 1){
      $where = array('id'=>$data['order_id']);
      $this->basic->update_data('{PRE}orders',$where,array('status'=>2,'order_status'=>'Out for Delivery'));
      $where['where'] = array('order_id'=>$id);
      $temp3['order_id'] = $id;
      $temp2 = $this->basic->get_data('{PRE}payments',$where,'invoice_id,order_id','','','','payment_id desc');
      if(!empty($temp2[0]->order_id)){
        $temp3['invoice_id'] = $temp2[0]->invoice_id;
        $where = array('order_id'=>$temp2[0]->order_id); 
        $this->basic->delete_data('{PRE}payments',$where);
      }else{
          $temp3['invoice_id'] = 1;
      }
      $where['where'] = array('is_verified'=>1,'order_id'=>$id);
      $join = array('{PRE}orders'=>'{PRE}order_products.order_id = {PRE}orders.id,inner');
      $temp2 = $this->basic->get_data('{PRE}order_products',$where,'SUM({PRE}order_products.total_price) as amount,{PRE}orders.is_express',$join);
      if(empty($temp2[0]->amount)){$result = 0;}
      else{
          if($temp2[0]->is_express){
              $where['where'] = array('{PRE}orders.id'=>$id);
              $join = array(
                            '{PRE}orders'=>'{PRE}shipping_addresses.shipping_add_id = {PRE}orders.selected_address_id,inner',
                            '{PRE}city'=>'{PRE}shipping_addresses.shipping_zip = {PRE}city.postal_code,inner'
                            );
              $express_amount = $this->basic->get_data('{PRE}shipping_addresses',$where,'{PRE}city.express_shipping_charges',$join);
          }else{
              $express_amount[0] = new stdClass();
              $express_amount[0]->express_shipping_charges = 0;
          }
          $temp3['amount'] = $temp2[0]->amount + $express_amount[0]->express_shipping_charges;
          $temp3['due_date'] = date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d'))));
          $result = $this->basic->insert_data('{PRE}payments',$temp3);
       }
      }
      $this->create_message($result);
  }
  
  public function get_updated_orders_post(){
      $data = $this->basic->get_file_content();
      $where['where'] = array('order_id'=>$data['order_id']);
      $result = $this->basic->get_data('update_order_history',$where,'*');
      $this->create_message($result);
  }

  public function get_shipping_addresses_post(){
   $data = $this->basic->get_file_content();
    $where['where'] = array('user_id'=>$data['user_id']);
    $result = $this->basic->get_data('{PRE}shipping_addresses',$where,'*');
     $this->create_message($result);
  }

  public function store_shipping_address_post(){
    $data = $this->basic->get_file_content();
     $where = array('postal_code'=>$data['shipping_zip']);
     $check = $this->basic->is_exist('{PRE}city',$where,'postal_code');
     if(!empty($check)){
            $result = $this->basic->insert_data('{PRE}shipping_addresses',$data);
     }
     else{
         $result = 0;
     }
    $this->create_message($result);
  }

  public function get_order_whole_details_post(){
    $data = $this->basic->get_file_content();
    $data['order_details'] = $this->basic->get_data("{PRE}order_products",array('where'=>array('order_id'=>$data['order_id'])),'product_id,size,product_unit');
       foreach($data['order_details'] as $index=>$temp){
            $where['where'] = array('{PRE}product_details.product_id' => $temp->product_id,'{PRE}order_products.size'=>$temp->size,'{PRE}product_details.is_deleted'=>0,'order_id'=>$data['order_id']);
            $join = array('{PRE}order_products'=>'{PRE}product_details.product_id = {PRE}order_products.product_id,inner');
            $result[$index]['product_details'] = $this->basic->get_data('{PRE}product_details',$where,'{PRE}product_details.*,{PRE}order_products.quantity',$join);
            $where['where'] = array('{PRE}order_products.product_id' => $temp->product_id,'{PRE}order_products.size'=>$temp->size,'order_id'=>$data['order_id']);
            $temp1 = $this->basic->get_data('{PRE}order_products',$where,'{PRE}order_products.product_unit as unit,{PRE}order_products.size as weight,{PRE}order_products.price');
            $join = array('{PRE}unit_of_product'=>'{PRE}unit_product_mapping.unit_id = {PRE}unit_of_product.unit_product_id,inner');
            $where['where'] = array('{PRE}unit_of_product.unit'=>$temp->product_unit,'{PRE}unit_product_mapping.weight'=>$temp->size,'{PRE}unit_product_mapping.product_id'=>$temp->product_id);
            $unit_ids = $this->basic->get_data('{PRE}unit_product_mapping',$where,'{PRE}unit_of_product.unit_product_id,{PRE}unit_product_mapping.unit_product_mapping_id',$join);
            $result[$index]['product_details'][0]->unit = $temp1[0];
            $result[$index]['product_details'][0]->unit->unit_product_mapping_id = $unit_ids[0]->unit_product_mapping_id;
            $result[$index]['product_details'][0]->unit->unit_product_id = $unit_ids[0]->unit_product_id;
      }
      $this->create_message($result);
  }
 }
?>