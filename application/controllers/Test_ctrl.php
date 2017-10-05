<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_ctrl extends CI_Controller {


  function __construct(){
    parent::__construct();
    $this->load->model('basic');
    $this->load->database();
}
public function index(){
    $template['title'] = "View Invoice";
    $template['data'] = $this->basic->get_data('{PRE}invoice','','{PRE}invoice.*');
    $template['page']  = "Invoice/view_invoice";
    $this->load->view('template',$template);
}
public function create_invoice(){
    $template['title'] = "Create Invoice";
    $template['users'] = $this->basic->get_data('{PRE}users','','*');
    $template['product'] = $this->basic->get_data('{PRE}products','','*');
    // $template['invoice'] = $this->basic->get_data('{PRE}invoice','','*');
    $template['page']  = "Invoice/invoice";
    $this->load->view('template',$template);
}
function get_address(){
    $id = $this->basic->get_post_data();
    $where['where'] = array('user_id'=>$id['id']);
    $result = $this->basic->get_data('{PRE}shipping_addresses',$where,'*');
    print_r(json_encode($result));
}

// function generate_invoice(){
//   $data = $this->basic->get_post_data();
//   $user_details = explode('&',$data['user_name']);
//   $where['where']= array('{PRE}users.user_id'=>$user_details[0],'{PRE}shipping_addresses.shipping_add_id'=>$data['shipping_address']);
//   $join = array('{PRE}shipping_addresses'=>'{PRE}users.user_id = {PRE}shipping_addresses.user_id,inner');
//   $temp['user_details'] = $this->basic->get_data('{PRE}users',$where,'{PRE}users.first_name,{PRE}users.last_name,{PRE}users.email,{PRE}users.GSTIN_NO,{PRE}shipping_addresses.*',$join);
//   unset($temp['user_details'][0]->is_verified);
//   $temp['GSTIN_NO'] = $temp['user_details'][0]->GSTIN_NO;
//   unset($temp['user_details']->GSTIN_NO);
//   $temp['user_details'][0]->created_date = date('Y-m-d');
//   $temp['invoice_id'] = $this->basic->insert_data_id('invoice',$temp['user_details'][0]);
//   $temp1['invoice_link'] = base_url().'assets/pdfs/invoice/INV-000'.$temp['invoice_id'].'.pdf';
//   $this->basic->update_data('invoice',array('id'=>$temp['invoice_id']),$temp1);
//   for($i=1;$i<$data['option_counts'];++$i){
//       $unit = explode(' ',$data['weight'.$i]);
//       $where['where'] = array('product_id'=>$data['product_id'.$i]);
//       //$tax = $this->basic->get_data('tax_product_mapping',$where,'SUM(rate) as total_rate');
//       $tax = $this->basic->get_data('{PRE}product_details',$where,'total_tax');
//     $temp['products'][$i]['name'] = $data['product_name'.$i];
//     $temp['products'][$i]['quantity'] = $data['quantity'.$i];
//     $temp['products'][$i]['size'] = $unit[0];
//     $temp['products'][$i]['product_unit'] = $unit[1];
//     $temp['products'][$i]['price'] = $data['price'.$i];
//     $temp['products'][$i]['rate'] = $tax[0]->total_tax;
//     $temp['products'][$i]['product_id'] = $data['product_id'.$i];
//     $temp['products'][$i]['cust_id'] = $user_details[0];
//     $temp['products'][$i]['invoice_id'] = $temp['invoice_id'];
//     $this->basic->insert_data('{PRE}invoice_details',$temp['products'][$i]);
//   }
//   $temp['billing_address'] = $this->basic->get_data('{PRE}users',array('where'=>array('users.user_id'=>$user_details[0])),'{PRE}users.*');
// //   $this->load->view('Pdf/pdf',$temp);
//     $this->session->set_flashdata('message', array('message' => "Invoice Created Succeefully",'class' => 'success'));	
//     redirect(base_url().'Invoice/create_invoice');
// }
    public function generate_pdf(){
        $invoice_id = $this->basic->get_post_data();
        $where['where'] = array('invoice_id'=>$invoice_id);
        $template['user_details'] = $this->basic->get_data('{PRE}invoice',$where,'{PRE}invoice.*,{PRE}invoice_details.*',$join);
        $template['products']  = $this->basic->get_data('{PRE}invoice',$where,'{PRE}invoice.*,{PRE}invoice_details.*',$join);
        $this->load->view('template',$template);
    }
function generate_invoice(){
  $data = $this->basic->get_post_data();
  $user_details = explode('&',$data['user_name']);
  $where['where']= array('{PRE}users.user_id'=>$user_details[0],'{PRE}shipping_addresses.shipping_add_id'=>$data['shipping_address']);
  $join = array('{PRE}shipping_addresses'=>'{PRE}users.user_id = {PRE}shipping_addresses.user_id,inner');
  $temp['user_details'] = $this->basic->get_data('{PRE}users',$where,'{PRE}users.first_name,{PRE}users.last_name,{PRE}users.email,{PRE}users.GSTIN_NO,{PRE}shipping_addresses.*',$join);
  unset($temp['user_details'][0]->is_verified);
  $temp['GSTIN_NO'] = $temp['user_details'][0]->GSTIN_NO;
  unset($temp['user_details']->GSTIN_NO);
  $temp['user_details'][0]->created_date = date('Y-m-d');
  $temp['invoice_id'] = $this->basic->insert_data_id('invoice',$temp['user_details'][0]);
  $temp1['invoice_link'] = base_url().'assets/pdfs/invoice/INV-000'.$temp['invoice_id'].'.pdf';
  $this->basic->update_data('invoice',array('id'=>$temp['invoice_id']),$temp1);
  for($i=1;$i<$data['option_counts'];++$i){
      $unit = explode(' ',$data['weight'.$i]);
      $where['where'] = array('product_id'=>$data['product_id'.$i]);
      //$tax = $this->basic->get_data('tax_product_mapping',$where,'SUM(rate) as total_rate');
      $tax = $this->basic->get_data('{PRE}product_details',$where,'total_tax');
    $temp['products'][$i]['name'] = $data['product_name'.$i];
    $temp['products'][$i]['quantity'] = $data['quantity'.$i];
    $temp['products'][$i]['size'] = $unit[0];
    $temp['products'][$i]['product_unit'] = $unit[1];
    $temp['products'][$i]['price'] = $data['price'.$i];
    $temp['products'][$i]['rate'] = $tax[0]->total_tax;
    $temp['products'][$i]['product_id'] = $data['product_id'.$i];
    $temp['products'][$i]['cust_id'] = $user_details[0];
    $temp['products'][$i]['invoice_id'] = $temp['invoice_id'];
    $this->basic->insert_data('{PRE}invoice_details',$temp['products'][$i]);
  }
  $temp['billing_address'] = $this->basic->get_data('{PRE}users',array('where'=>array('users.user_id'=>$user_details[0])),'{PRE}users.*');
  $this->load->view('Pdf/pdf',$temp);
    $this->session->set_flashdata('message', array('message' => "Invoice Created Succeefully",'class' => 'success'));	
    redirect(base_url().'Invoice/create_invoice');
}
function get_weights(){
    $id = $this->basic->get_post_data();
    $where['where'] = array('{PRE}unit_product_mapping.product_id'=>$id['product_id']);
    $join = array('{PRE}unit_of_product'=>'{PRE}unit_product_mapping.unit_id = {PRE}unit_of_product.unit_product_id,inner');
    //$result =  $this->basic->get_data('unit_product_mapping',$where,'unit_product_mapping.*,unit_of_product.*',$join);
    print_r(json_encode($this->basic->get_data('{PRE}unit_product_mapping',$where,'{PRE}unit_product_mapping.*,{PRE}unit_of_product.*',$join)));
}
// function get_invoice(){
//         $invoice_id = $this->basic->get_post_data();
//         // $join = array('{PRE}invoice_details'=>'{PRE}invoice.id = {PRE}invoice_details.invoice_id,inner');
//         $where['where'] = array('invoice_id'=>$invoice_id['invoice_id']);
//         $template = $this->basic->get_data('{PRE}invoice_details',$where,'{PRE}invoice_details.*');
//         print_r(json_encode($template));
// }

function view_invoice(){
    $template['data'] = $this->basic->get_data('invoice','','*','','','','id desc');
    $template['title'] = "View Invoice";
    $template['page']  = "Invoice/view_invoice";
    $this->load->view('template',$template);
}
public function import(){
      $details = $this->basic->get_post_data();
      
      $user_id = explode('&',$details['user_name']);
      //-----------------------------------------------------------------------editedbymizan-------------------------------------------------------------------------------------------------------
      
      $temp['invoice_date']=$details['invoice_date'];
      $temp['due_date']=$details['due_date'];

      //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      $where['where'] = array('{PRE}shipping_addresses.shipping_add_id'=>$details['shipping_address']);
      $join = array('{PRE}users'=>'{PRE}shipping_addresses.user_id = users.user_id,inner');
      $temp['shipping_details'] = $this->basic->get_data('{PRE}shipping_addresses',$where,'{PRE}shipping_addresses.*,{PRE}users.*',$join);
      $where['where'] = array('user_id'=>$user_id[0]);
      $temp['invoice_details'] = $this->basic->get_data('{PRE}shipping_addresses',$where,'shipping_addresses.*');
      $temp['invoice_details'][0]->created_date = date('Y-m-d');
      $temp['invoice_details'][0]->email = $temp['shipping_details'][0]->email;
      $temp['invoice_details'][0]->email = $temp['shipping_details'][0]->GSTIN_NO;
       $temp['invoice_details'][0]->first_name = $temp['shipping_details'][0]->first_name;
        $temp['invoice_details'][0]->last_name = $temp['shipping_details'][0]->last_name;
      unset($temp['invoice_details'][0]->is_verified);
      //$temp['invoice_id'] = $this->basic->insert_data_id('invoice',$temp['invoice_details'][0]);
       //$temp1['invoice_link'] = base_url().'assets/pdfs/invoice/INV-000'.$temp['invoice_id'].'.pdf';
       // $this->basic->update_data('invoice',array('id'=>$temp['invoice_id']),$temp1);
       $temp['invoice_id'] = 12;
      $filename=$_FILES["file"]["tmp_name"];
      if($_FILES["file"]["size"] > 0)
        {
            if($details['csv_type'] == 0){
          $file = fopen($filename, "r");$i=1;
           while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
           {
                  $temp['products'][$i]= array(
                      'name' => $importdata[0],
                      'quantity' =>$importdata[1],
                      'product_unit' => $importdata[3],
                      'price' => $importdata[4],
                      'size' => $importdata[2],
                      'rate'=>$importdata[5],
                      'invoice_id'=>$temp['invoice_id'],
                      'cust_id'=>$user_id[0],
                      );
                      $this->basic->insert_data('invoice_details',$temp['products'][$i]);
                      $i++;
           }    
          fclose($file);
       $this->load->view('Pdf/pdf',$temp);
        }
        else if($details['csv_type'] == 1){
       $file = fopen($filename, "r");$i=1;
           while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
           {
                  $temp['products'][$i]= array(
                      'date'=>$importdata[6],
                      'name' => $importdata[0],
                      'quantity' =>$importdata[1],
                      'product_unit' => $importdata[3],
                      'price' => $importdata[4],
                      'size' => $importdata[2],
                      'rate'=>$importdata[5],
                      'invoice_id'=>$temp['invoice_id'],
                      'cust_id'=>$user_id[0],
                      );
                    //   $this->basic->insert_data('invoice_details',$temp['products'][$i]);
                      $i++;
           }    
          fclose($file);
       $this->load->view('Pdf/subs',$temp);
    }
    else if($details['csv_type'] == 2){
       $file = fopen($filename, "r");$i=1;
           while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
           {
                  $temp['products'][$i]= array(
                      'name' => $importdata[0],
                      'quantity' =>$importdata[1],
                      'product_unit' => $importdata[3],
                      'price' => $importdata[4],
                      'size' => $importdata[2],
                      'rate'=>$importdata[5],
                      'invoice_id'=>$temp['invoice_id'],
                      'cust_id'=>$user_id[0],
                      );
                    //   $this->basic->insert_data('invoice_details',$temp['products'][$i]);
                      $i++;
           }    
          fclose($file);
       $this->load->view('Pdf/challan',$temp);
    }
}
if(!empty($temp)){
   $this->session->set_flashdata('message', array('message' => "Document Created Succeefully",'class' => 'success'));	
    redirect(base_url().'Invoice/create_invoice');
}
else{
     $this->session->set_flashdata('message', array('message' => "Unable to create Document",'class' => 'success'));	
    redirect(base_url().'Invoice/create_invoice');
}
}
// public function import2(){
//       $details = $this->basic->get_post_data();
//       $user_id = explode('&',$details['user_name']);
//       $where['where'] = array('{PRE}shipping_addresses.shipping_add_id'=>$details['shipping_address']);
//       $join = array('{PRE}users'=>'{PRE}shipping_addresses.user_id = users.user_id,inner');
//       $temp['shipping_details'] = $this->basic->get_data('{PRE}shipping_addresses',$where,'{PRE}shipping_addresses.*,{PRE}users.*',$join);
//       $where['where'] = array('user_id'=>$user_id[0]);
//       $temp['invoice_details'] = $this->basic->get_data('{PRE}shipping_addresses',$where,'shipping_addresses.*');
//       $temp['invoice_details'][0]->created_date = date('Y-m-d');
//       $temp['invoice_details'][0]->email = $temp['shipping_details'][0]->email;
//       $temp['invoice_details'][0]->email = $temp['shipping_details'][0]->GSTIN_NO;
//       $temp['invoice_details'][0]->first_name = $temp['shipping_details'][0]->first_name;
//         $temp['invoice_details'][0]->last_name = $temp['shipping_details'][0]->last_name;
//       unset($temp['invoice_details'][0]->is_verified);
//       $temp['invoice_id'] = $this->basic->insert_data_id('invoice',$temp['invoice_details'][0]);
//       $temp1['invoice_link'] = base_url().'assets/pdfs/invoice/INV-000'.$temp['invoice_id'].'.pdf';
//         $this->basic->update_data('invoice',array('id'=>$temp['invoice_id']),$temp1);
//       $filename=$_FILES["file"]["tmp_name"];
//       if($_FILES["file"]["size"] > 0)
//         {
//           $file = fopen($filename, "r");$i=1;
//           while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
//           {
//                   $temp['products'][$i]= array(
//                       'date'=>$importdata[6],
//                       'name' => $importdata[0],
//                       'quantity' =>$importdata[1],
//                       'product_unit' => $importdata[3],
//                       'price' => $importdata[4],
//                       'size' => $importdata[2],
//                       'rate'=>$importdata[5],
//                       'invoice_id'=>$temp['invoice_id'],
//                       'cust_id'=>$user_id[0],
//                       );
//                     //   $this->basic->insert_data('invoice_details',$temp['products'][$i]);
//                       $i++;
//           }    
//           fclose($file);
//       $this->load->view('Pdf/subs',$temp);
  
// 
// }
}
?>