<?php 

class Help_model extends CI_Model {
	
	public function _consruct()
	{
		parent::_construct();
 	}
	//add Help 
	public function  add_help($data)
	{
		 
		$result = $this->db->insert('{PRE}help', $data);
		return $result;
    }
	//view Help 
	function get_help_details()
	{
				 //$query = $this->db->where('category_status','0');
				 
				/* $menu = $this->session->userdata('admin');
							if($menu!='1')
							{						
								$user = $this->session->userdata('id');
								$this->db->where('created_by', $user);
							}*/
				 $query = $this->db->get('{PRE}help');
				 $result = $query->result();
				 return $result;
	}
	public function edit_help_id($id){
		 
		 $query = $this->db->where('id',$id);
		 $query = $this->db->get('{PRE}help');
		 $result = $query->row();
		 return $result;
	 }
	public function editget_category_id($id)
	{
				 $query = $this->db->where('id',$id);
				 $query = $this->db->get('{PRE}category');
				 $result = $query->row();
				 return $result;
	}
	 // edit Help
	 public function edit_help($data, $id)
	 {
		 
				 $this->db->where('id',$id);
				 $result = $this->db->update('{PRE}help',$data);
				 return Success;			 
	 }
	 //delete Help
	  public function delete_help($id)
	  {
		 
				 $this->db->where('id',$id);
				 $result = $this->db->delete('{PRE}help');
				 return $result;
		 
		 
	  }
	
	 }