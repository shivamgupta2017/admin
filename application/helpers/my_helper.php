<?php 
defined('BASEPATH') OR exit('No direct Access Allowed');
 
 function get_data_helper($table,$where='',$select='',$join='',$limit='',$start='',$order_by='',$group_by='',$num_rows=1,$single_value=1) 
  {
       $ci = &get_instance();
       $ci->load->model('basic'); 
       $results=$ci->basic->get_data($table,$where,$select,$join,$limit,$start,$order_by,$group_by,$num_rows);
     
       if($single_value==1) return $results[0];
       else return $results;
  }
 function date_formating($date) 
  {
       return date('d/m/Y',strtotime($date));
  }

?>