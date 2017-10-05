<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_ctrl extends CI_Controller{

 public function __construct(){
 	parent::__construct();
 	$this->load->model('basic');
 	$this->load->database();
    $this->load->helper('notification');
 }
 
 public function index(){
 	$select = '{PRE}orders.*,{PRE}users.zipcode,{PRE}users.address,{PRE}users.first_name,{PRE}users.last_name';
 	$join = array('{PRE}users' => '{PRE}orders.user_id = {PRE}users.user_id,inner');
 	$template['data'] = $this->basic->get_data('{PRE}orders','',$select,$join,'','','{PRE}orders.id desc');
 	$template['page'] = "Order/view_order";
 	$template['page_title'] = 'View Order';
 	$this->load->view('template',$template);
 }
 
 public function view_order(){
 	$data = $this->basic->get_post_data();
 	$where['where'] = array('{PRE}order_products.order_id'=>$data['orderdetails']);
    $join = array('{PRE}product_details'=>'{PRE}order_products.product_id = {PRE}product_details.product_id,inner');
    $result['data'] = $this->basic->get_data('{PRE}order_products',$where,'*',$join);
    $this->load->view('Order/view-order-popup',$result);
 }
 
  public function update_order_popup(){
 	$data = $this->basic->get_post_data();
 	$where['where'] = array('{PRE}update_order.order_id'=>$data['orderdetails']);
    $join = array(
      '{PRE}product_details'=>'{PRE}update_order.product_id = {PRE}product_details.product_id,inner','{PRE}unit_of_product'=>'{PRE}update_order.unit_mapping_id = {PRE}unit_of_product.unit_product_id,inner');
    $result['data'] = $this->basic->get_data('{PRE}update_order',$where,'{PRE}update_order.*,{PRE}unit_of_product.unit,{PRE}product_details.image',$join);
    $this->load->view('Order/view_update_order_popup',$result);
 }
 public function update_order($id='',$action=''){
 	if($action == 0){
 		  $this->basic->update_data('{PRE}orders',array('id'=>$id),array('status'=>1,'order_status'=>'Out for Delivery'));
 		  $this->session->set_flashdata('message',array('message'=>"Updated Successfully",'class'=>'success'));
          $data['challan_id']  = date('h:i:s');
          $this->basic->generate_challan($id,$data['challan_id']);
          $link['link'] = base_url().'assets/pdfs/challans/Challan-000'.$data['challan_id'].'.pdf';
          $this->basic->update_data('{PRE}orders',array('id'=>$id),$link);
          $this->load->helper('notification');
          $user_data = $this->basic->get_data("{PRE}orders",array('where'=>array('id'=>$id)),'user_id');
          $temp_data = $this->basic->get_data('{PRE}users',array('where'=>array('user_id'=>$user_data[0]->user_id)));
           $data2['message'] = "Your challan is ready.Click Here To View";
            $data2['first_name'] =  $temp_data[0]->first_name;
             $data2['last_name'] =  $temp_data[0]->last_name;
              $data2['device_id'] = $temp_data[0]->player_id;
               $data2['url'] = base_url().'assets/pdfs/challans/Challan-000'.$data['challan_id'].'.pdf';
                create_notification($data2);
 		             redirect(base_url().'Order_ctrl');
 	}
 }
 
 public function view_update_requests(){
    $join = array('{PRE}orders'=>'{PRE}update_order.order_id = {PRE}orders.id,inner','{PRE}users'=>'{PRE}orders.user_id = {PRE}users.user_id,inner');
    $template['data'] = $this->basic->get_data('{PRE}update_order','','DISTINCT({PRE}orders.id),{PRE}users.first_name,{PRE}users.last_name,{PRE}users.phone',$join);
 	$template['page'] = "Order/view_update_order";
 	$template['page_title'] = 'View Order';
 	$this->load->view('template',$template);
 }
 public function accept_update($id){
     $where['where'] = array('order_id'=>$id);
     $temp_data = $this->basic->get_data('{PRE}update_order',$where,'*');
     foreach($temp_data as $index=>$temp_var1){
         $where1['where'] = array('unit_product_id'=>$temp_var1->unit_mapping_id);
          $unit = $this->basic->get_data('{PRE}unit_of_product',$where1,'unit');
           $temp_data[$index]->product_unit = $unit[0]->unit;
            $temp_data[$index]->price = $temp_data[$index]->price;
             unset($temp_data[$index]->unit_mapping_id,$temp_data[$index]->product_unit_mapping_id);
     }
     $this->basic->delete_data('{PRE}update_order',array('order_id'=>$id));
     $order_products = $this->basic->get_data('{PRE}order_products',$where,'*');
     foreach($order_products as $temp5){
         unset($temp5->id);
         $this->basic->insert_data('{PRE}update_order_history',$temp5);
     }
     $this->basic->delete_data('{PRE}order_products',array('order_id'=>$id));
     foreach($temp_data as $temp5){
            unset($temp5->id);
            $this->basic->insert_data('{PRE}order_products',$temp5);
     }
                  $this->session->set_flashdata('message', array('message' => "Order Updated Succefully", 'title' => 'Sucess !', 'class' => 'Success'));
                   redirect(base_url().'Order_ctrl/view_update_requests');
 }

 public function admin_verification(){
    $where['where'] = array('status'=>2);
    $join = array('{PRE}users'=>'{PRE}orders.user_id = {PRE}users.user_id,inner');
    $template['data'] = $this->basic->get_data('{PRE}orders',$where,'*',$join);
    $template['page'] = "Order/view_verification_order";
    $template['page_title'] = 'View Order';
    $this->load->view('template',$template);
 }
    public function verification(){
        $data = $this->basic->get_post_data();
        $join = array('product_details'=>'order_products.product_id = product_details.product_id,inner');
        $where['where'] = array('order_id'=>$data['customer_details']);
        $result['data'] = $this->basic->get_data('{PRE}order_products',$where,'*',$join);
        $this->load->view('Order/verification_popup',$result);
    }

    public function create_challan(){
        $data = $this->basic->get_post_data();
        foreach($data as $temp_data){
            $temp['is_verified'] = 2;
            $datas = explode('&',$temp_data);
            $order_id = $datas[1];
            $result = $this->basic->update_data('{PRE}order_products',array('product_id'=>$datas[0]),$temp);
            $this->basic->update_data('{PRE}orders',array('id'=>$order_id),array('status'=>3));
        }
     $time_stamp = date('h:i:s');
     $this->basic->generate_challan($order_id,$time_stamp);
     $link['link'] = base_url().'assets/pdfs/challans/Challan-000'.$time_stamp.'.pdf';
         $this->basic->update_data('{PRE}orders',array('id'=>$order_id),$link);
          $user_data = $this->basic->get_data("{PRE}orders",array('where'=>array('id'=>$order_id)),'user_id');
           $temp_data = $this->basic->get_data('{PRE}users',array('where'=>array('user_id'=>$user_data[0]->user_id)));
            $data2['message'] = "Your Challan is Ready.Click to Check Your Challan";
             $data2['first_name'] =  $temp_data[0]->first_name;
              $data2['last_name'] =  $temp_data[0]->last_name;
               $data2['device_id'] = $temp_data[0]->player_id;
                $data2['url'] = $link['link'];
                 create_notification($data2);
                  redirect(base_url().'Order_ctrl/admin_verification');
    }
 public function create_invoice()
 {

      $data = $this->basic->get_post_data();

        foreach($data as $temp_data)
        {
            $temp['is_verified'] = 2;
            $datas = explode('&',$temp_data);
            $id = $datas[1];
            $result = $this->basic->update_data('{PRE}order_products',array('product_id'=>$datas[0],'size'=>$datas[2]),$temp);
        }
   
       $this->basic->update_data('{PRE}orders',array('id'=>$id),array('status'=>3));
       $invoice_id = $this->basic->generate_invoice($id);
       $join = array('{PRE}orders'=>'{PRE}orders.user_id = {PRE}users.user_id,inner');
       $where['where'] = array('order_id'=>$id);
       $data = array();
       $user_data = $this->basic->get_data("{PRE}orders",array('where'=>array('id'=>$id)),'user_id');
       $temp_data = $this->basic->get_data('{PRE}users',array('where'=>array('user_id'=>$user_data[0]->user_id)));
       $link = base_url().'assets/pdfs/invoice/INV-000'.$invoice_id.".pdf";
       $this->basic->update_data('{PRE}payments',$where['where'],array('invoice_link'=>$link));
       $this->basic->update_data('{PRE}invoice',array('id'=>$invoice_id),array('invoice_link'=>$link,'created_date'=>date('Y-m-d'),'invoice_date'=>date('Y-m-d'),'invoice_due_date'=>date('Y-m-d',strtotime('+'.$temp_data[0]->due_days.' days',strtotime(date('Y-m-d'))))));
       $result = $this->basic->update_data('{PRE}orders',array('id'=>$id),array('link'=>$link));
            $data['message'] = "Your Invoice is Generated Check it Here.";
             $data['first_name'] = $temp_data[0]->first_name;
              $data['last_name'] = $temp_data[0]->last_name;
               $data['device_id'] = $temp_data[0]->player_id;
                $data['url'] = $link;
                 create_notification($data);
                  redirect(base_url().'Order_ctrl/admin_verification');
 }
}
?>