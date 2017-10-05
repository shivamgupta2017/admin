<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
include(APPPATH.'libraries/REST_Controller.php');
class Other_service extends REST_Controller{

public function __construct()
    {
       parent::__construct();
       $this->load->model('basic');
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

function get_orders_post(){
    $subs_db = $this->load->database('another_db',true);
    $data = $subs_db->select('*')->get('orders')->result();
    $this->create_message($data);
}

function get_subscription_post(){
    $subs_db = $this->load->database('another_db',true);
    $data = $subs_db->select('*')->get('cust_subscription')->result();
    $this->create_message($data);
}

function get_subscription_details_post(){
    $data = $this->basic->get_post_data();
    $subs_db = $this->load->database('another_db',true);
    $data = $subs_db->select('*')->from('subs_used_data')->join('cust_subscription','subs_used_data.subscription_id = cust_subscription.id')->where('subs_used_data.subscription_id',$data['subscription_id'])->get()->result();
    $this->create_message($data);
}

function get_purchase_post(){
    $join = array('{PRE}purchase_products'=>'{PRE}purchase.id = {PRE}purchase_products.purchase_id,inner');
    $result = $this->basic->get_data('{PRE}purchase','','{PRE}purchase.*,{PRE}purchase_products.*',$join);
    $this->create_message($result);
}


function get_sales_post(){
    $join = array('{PRE}sales_products'=>'{PRE}sales.sales_id = {PRE}sales_products.sales_id,inner');
    $result = $this->basic->get_data('{PRE}sales','','{PRE}sales.*,{PRE}sales_products.*',$join);
    $this->create_message($result);
}

function get_total_post(){
    $join = array('{PRE}purchase_products'=>'{PRE}purchase.id = {PRE}purchase_products.purchase_id');
    $result = $this->basic->get_data('{PRE}purchase','','{PRE}purchase.*,{PRE}purchase_products.*',$join);
    $this->create_message($result);
}

}
?>