<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
   }
   

	  
	 function settings_viewings()
	 {
		 
		  $query = $this->db->query(" SELECT * FROM `{PRE}settings` order by id DESC ")->row();
		  
		  return $query ;
	 }
	 
	/* public function get_single_settings($id){
		
		  
		       $query = $this->db->where('id',$id);
			   $query = $this->db->get('settings');
			   $result = $query->row();
			   return $result;  
	 }	
	 */
	 public function update_settings($data)
	 {

	 	
	 	unset($data['fb_redirect']);
	 	unset($data['google_redirect']);


		           //$this->db->where('id', $id);
				   $result = $this->db->update('{PRE}settings', $data); 
				   return $result;
	 }
	 
  
   }
  ?>