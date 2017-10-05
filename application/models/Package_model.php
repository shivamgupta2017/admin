<?php 

class Package_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
 	public function get_package($id=''){
		 if($id==''){
		$this->db->select('*');
		$this->db->from('{PRE}package');
		$query = $this->db->get();
		$result = $query->result(); 
				 return $result;
		 }
		 else{
		 	$this->db->select('*');
		$this->db->from('{PRE}package');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row(); 
				 return $result;
		 }
		 
	 }
	 public function get_products($id){
	 	$this->db->select('{PRE}package_products.*,{PRE}package_products.is_deleted as deleted,{PRE}package_products.product_status as status,{PRE}products.*');
	 	$this->db->from('{PRE}package_products');
	 	$this->db->where('{PRE}package_id',$id);
	 	$this->db->join('{PRE}products','{PRE}package_products.item_id = {PRE}products.id');
	 	$query = $this->db->get();
	 	$result = $query->result();
	 	return $result;

	 }
	 public function active_deactive($id) 
	 {          
	           $this->db->select('product_status');
	           $this->db->from('{PRE}products');
	           $query = $this->db->where('id',$id);
	           $status = $query->get()->row();
	          if($status->product_status=='1'){$data['product_status']='0';$result = 'deactived';}else{$data['product_status']='1';$result = 'actived';}
		        $this->db->where('id',$id);
			    $this->db->update('{PRE}products',$data);
			    return $result; 				
	 }
	 public function check_duplicate($package_id,$product_id){
	 	$this->db->select('*');
	 	$this->db->from('{PRE}package_products');
	 	$array = array('package_id'=>$package_id,'item_id'=>$product_id);
	 	$this->db->where($array);
	 	$query = $this->db->get()->result();
	 	if($query){
	 		return 0;
	 	}else{
	 		return 1;
	 	}
	 }
	 public function get_sizes($id='',$size_id=''){
	 	if($id=='' && $size_id==''){
	 	$this->db->select('*');
	 	$this->db->from('{PRE}package_size');
	 	$result = $this->db->get()->result();
	 	return $result;
	}
		else if($size_id==''){
		$this->db->select('size_id,{PRE}package_size.size_name');
	 	$this->db->from('{PRE}package_and_sizes');
	 	$this->db->join('{PRE}package_size','{PRE}package_and_sizes.size_id = {PRE}package_size.id');
	 	$this->db->where('{PRE}package_and_sizes.package_id',$id);
	 	$result = $this->db->get()->result();
	 	return $result;

		}
		else if($id!='' && $size_id!=''){
			$this->db->select('product_id');
	 		$this->db->from('{PRE}next_day_selection');
	 		$array = array('package_id'=>$id,'size_id'=>$size_id);
	 		$this->db->where($array);
	 		$result = $this->db->get()->result();
	 		return $result;

		}
	 }
	 public function get_daily_needs($action=''){
	     if($action == "package"){
	         $result = $this->db->select('DISTINCT({PRE}next_day_needs.product_id),{PRE}next_day_needs.quantity,{PRE}products.product_name,{PRE}products.image,{PRE}customer_registration.first_name,{PRE}customer_registration.last_name,{PRE}unit_of_product.*')->from('{PRE}next_day_needs')->join('{PRE}products','{PRE}next_day_needs.product_id = {PRE}products.id')->join('{PRE}unit_of_product','{PRE}next_day_needs.unit_id = {PRE}unit_of_product.tbl_id')->join('{PRE}customer_registration','{PRE}next_day_needs.cust_id = {PRE}customer_registration.id')->get()->result();
	         foreach($result as $index => $data){
	        $result[$index]->total_weight= $this->db->select('SUM(total_weight) as total_weight')->from('{PRE}next_day_needs')->where('product_id',$data->product_id)->get()->row();
	        }
	 	    return $result;
	     }
	    else if($action == 'subscription'){
	        $next_date = date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))));
	         $result = $this->db->select('DISTINCT({PRE}subs_used_data.product_id),{PRE}products.product_name,{PRE}products.image,{PRE}cust_subscription.unit_mapping_id')->from('{PRE}subs_used_data')->join('{PRE}cust_subscription','{PRE}subs_used_data.subscription_id = {PRE}cust_subscription.id')->join('{PRE}customer_registration','{PRE}subs_used_data.cust_id = {PRE}customer_registration.id')->join('{PRE}products','{PRE}subs_used_data.product_id = {PRE}products.id')->where('{PRE}subs_used_data.date',$next_date)->get()->result();
	    	 foreach($result as $index => $data ){
	    	     $result[$index]->total_quantity = $this->db->select('SUM(qty)as qty,{PRE}subs_used_data.price,SUM(extra_qty) as extra_qty')->from('{PRE}subs_used_data')->where(array('date'=>$next_date,'product_id'=>$data->product_id))->get()->row();
	    	     $result[$index]->basic_weight = $this->db->select('{PRE}unit_of_product.basic_weight,{PRE}unit_product_mapping.weight')->from('{PRE}unit_of_product')->join('{PRE}unit_product_mapping','{PRE}unit_of_product.tbl_id = {PRE}unit_product_mapping.unit_id')->where('{PRE}unit_product_mapping.tbl_id',$data->unit_mapping_id)->get()->row();
	    	 }
	    	return $result;
	     }
	    else if($action == 'orders'){
	          $next_date = date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))));
	         $result = $this->db->select('DISTINCT({PRE}order_products.product_id),{PRE}order_products.unit,{PRE}products.product_name,{PRE}products.image')->from('{PRE}order_products')->join('{PRE}products','{PRE}order_products.product_id = {PRE}products.id')->where('{PRE}order_products.delivery_date',$next_date)->get()->result();
	        	foreach($result as $index => $temp){
	        	    $result[$index]->total_weight = $this->db->select('(SUM({PRE}order_products.weight)*{PRE}order_products.basic_weight) as total_weight')->from('{PRE}order_products')->where(array('product_id'=>$temp->product_id,'delivery_date'=>$next_date))->get()->row();
	        	}
	    	return $result;
	    }
	     
	 }
	 public function selected_tax($id){
	     return $this->db->select('tax_id')->from('{PRE}package')->where('id',$id)->get()->row();
	 }
	}
	 ?>