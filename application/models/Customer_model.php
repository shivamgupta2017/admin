<?php 

class Customer_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
// view customer details	
	 public function get_customer_details(){
		 $query = $this->db->select('{PRE}customer_registration.*')->join('{PRE}addaddress','{PRE}customer_registration.id = {PRE}addaddress.user_id')->where('customer_status','1')->get('{PRE}customer_registration');
		 $result = $query->result();
		 return $result;

	 }	 
	 	
//delete customer	 
	 public function delete_customer($id,$data1){
		  $this->db->where('id',$id);
				 $result = $this->db->update('{PRE}customer_registration',$data1);
				 return $result;
		 
		 
	 }
//popup customer details	 
	 public function view_popup_customerdetails($id){
		  
		 $this->db->where('id', $id);
		 $query = $this->db->get('{PRE}customer_registration');
		 $result = $query->row();
		 return $result;

	 }

// view order details	
	 public function get_order_details(){
		 $result = $this->db->select('{PRE}orders.*,{PRE}addaddress.address,{PRE}addaddress.zip,{PRE}addaddress.mobno')->from('{PRE}orders')->join('{PRE}addaddress','{PRE}orders.delivery_add_id = {PRE}addaddress.id')->order_by('{PRE}orders.id','DESC')->get()->result();
		 return $result;

	 }	 
	 	
//delete order	 
	 public function delete_order($id,$data1){
		  $this->db->where('id',$id);
				 $result = $this->db->update('{PRE}order',$data1);
				 return $result;
		 
		 
	 }
//popup order details	 
	 public function view_popup_orderdetails($id){
		  
		 $this->db->where('id', $id);
		 $query = $this->db->get('{PRE}order');
		 $result = $query->row();
		 return $result;

	 }	

    function invoice($id){
        $result['order'] = $this->db->select('{PRE}orders.*,{PRE}addaddress.address,{PRE}customer_registration.email')->from('{PRE}orders')->join('{PRE}customer_registration','{PRE}orders.cust_id = {PRE}customer_registration.id')->join('{PRE}addaddress','{PRE}orders.delivery_add_id = {PRE}addaddress.id')->where(array('{PRE}orders.id'=>$id))->get()->result();
		  $result['order_products'] = $this->db->select('order_products.*,products.product_name,products.image,tax.rate')->from('order_products')->join('products','order_products.product_id = products.id')->join('tax','products.tax_id = tax.tax_id')->where(array('order_products.order_id'=>$id))->get()->result();
		   return $result;
    }
    function bill_invoice($id){
        $action = $this->db->join('{PRE}billing','{PRE}cust_subscription.id = {PRE}billing.subscription_id')->where('{PRE}billing.billing_id',$id)->get('{PRE}cust_subscription')->row();
        if($action->product_id){
        $result['bill'] = $this->db->select('{PRE}billing.*,{PRE}cust_subscription.unit_mapping_id,{PRE}cust_subscription.product_id,{PRE}addaddress.apartment,{PRE}addaddress.address,{PRE}addaddress.zip,{PRE}customer_registration.due_amount,{PRE}customer_registration.email,{PRE}customer_registration.first_name,{PRE}customer_registration.due_amount,{PRE}customer_registration.last_name,{PRE}customer_registration.phone,{PRE}products.product_name,{PRE}tax.rate as tax_rate,{PRE}products.is_inclusive,{PRE}tax.name as tax_name')->from('{PRE}billing')->join('{PRE}customer_registration','{PRE}billing.cust_id = {PRE}customer_registration.id')->join('{PRE}cust_subscription','{PRE}billing.subscription_id = {PRE}cust_subscription.id')->join('{PRE}addaddress','{PRE}cust_subscription.delivery_add_id = {PRE}addaddress.id')->join('{PRE}products','{PRE}cust_subscription.product_id = {PRE}products.id')->join('{PRE}tax','{PRE}products.tax_id = {PRE}tax.tax_id')->where(array('{PRE}billing.billing_id'=>$id))->get()->row();
		      
		      $result['is_package'] = 0;
		      $start_date = date('Y-m-01',strtotime($result['bill']->month_bill));
		      $end_date = date('Y-m-t',strtotime($start_date));
		        $result['unit'] = $this->db->select('{PRE}unit_of_product.unit')->from('{PRE}unit_product_mapping')->join('{PRE}unit_of_product','{PRE}unit_product_mapping.unit_id = {PRE}unit_of_product.tbl_id')->where('{PRE}unit_product_mapping.tbl_id',$result['bill']->unit_mapping_id)->get()->row();
		        $result['billing_details'] = $this->db->select('{PRE}subs_used_data.*')->from('{PRE}subs_used_data')->where(array('{PRE}subs_used_data.subscription_id'=>$result['bill']->subscription_id,'status'=>1,'{PRE}subs_used_data.date >'=>$start_date,'{PRE}subs_used_data.date <='=>$end_date))->get()->result();
		   }
		   else{
		        $result['bill'] = $this->db->select('{PRE}billing.*,{PRE}cust_subscription.unit_mapping_id,{PRE}package.package_name as product_name,{PRE}addaddress.apartment,{PRE}addaddress.address,{PRE}addaddress.zip,{PRE}customer_registration.due_amount,{PRE}customer_registration.email,{PRE}customer_registration.first_name,{PRE}customer_registration.last_name,{PRE}customer_registration.phone,{PRE}tax.rate as tax_rate,{PRE}tax.name as tax_name,{PRE}package.tax_id,{PRE}package.is_inclusive,{PRE}package_size.size_name')->from('{PRE}billing')->join('{PRE}customer_registration','{PRE}billing.cust_id = {PRE}customer_registration.id')->join('{PRE}cust_subscription','{PRE}billing.subscription_id = {PRE}cust_subscription.id')->join('{PRE}package_size','{PRE}cust_subscription.package_size_id = {PRE}package_size.id')->join('{PRE}package','{PRE}cust_subscription.package_id = {PRE}package.id')->join('{PRE}addaddress','{PRE}cust_subscription.delivery_add_id = {PRE}addaddress.id')->join('{PRE}tax','{PRE}package.tax_id = {PRE}tax.tax_id')->where(array('{PRE}billing.billing_id'=>$id))->get()->row();
		        $result['is_package'] = 1;
		        $start_date = date('Y-m-01',strtotime($result['bill']->month_bill));
		        $end_date = date('Y-m-t',strtotime($start_date));
		        $result['billing_details'] = $this->db->select('{PRE}package_used_data.*,{PRE}package_used_data.weight as qty')->from('{PRE}package_used_data')->join('{PRE}package','{PRE}package_used_data.package_id = {PRE}package.id')->where(array('{PRE}package_used_data.subscription_id'=>$result['bill']->subscription_id,'{PRE}package_used_data.status'=>1,'{PRE}package_used_data.date >'=>$start_date,'{PRE}package_used_data.date <='=>$end_date))->get()->result();
		        $result['unit'] = (object)array();
		        $result['unit']->unit = "g";
		  foreach($result['billing_details'] as $index=>$temp){
		      $result['billing_details'][$index]->extra_qty = 0;
		  }
		 
		   }
		   return $result;
		  
    }
	function view_booking_info($id){
    return $this->db->query("SELECT {PRE}products.image,{PRE}products.product_name,{PRE}order_products.price,{PRE}order_products.quantity,{PRE}order_products.weight,{PRE}order_products.unit FROM `{PRE}order_products` INNER JOIN {PRE}products ON {PRE}order_products.product_id = {PRE}products.id WHERE {PRE}order_products.order_id =".$id)->result();
  }

  function view_book_data($id){
    return $this->db->where('id',$id)->get('{PRE}bookingdetails')->row();
  } 

}
?>
	