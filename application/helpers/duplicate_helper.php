<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if ( ! function_exists('check_duplicate'))
	{
  function check_duplicate($id,$tbl_name='',$extra_param='',$extra_where='',$etr_where_pa='',$product_type='',$product_id=''){
	  $CI	=&	get_instance();
		$CI->load->database();
	$CI->db->select('*');
	$CI->db->from($tbl_name);
	$CI->db->where($id,$extra_param);
	$CI->db->where($extra_where,$etr_where_pa);
	if($product_type!=''){
	$CI->db->where($product_type,$product_id);
    }
	$result = $CI->db->get()->num_rows();
	if($result>0){
		return 0;
	}
	else{
		return 1;
	}
	}
}
?>