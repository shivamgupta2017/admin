 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Concern_ctrl extends CI_Controller {

	public function __construct() {
	parent::__construct();
		
	date_default_timezone_set("Asia/Kolkata");
			 $this->load->model('basic');
		   	 $this->load->database();
		   	 $this->load->library('form_validation');
			if(!$this->session->userdata('logged_in_adminw1')) { 
			redirect(base_url());
		}
    }
// view customer details	  
function index(){
	  		$template['data'] = $this->basic->get_data('{PRE}complaints','','*');
	  		$template['page'] = 'Concern/view_concern';
	  		$template['page_title'] = 'View Concern';
	  		$this->load->view('template',$template);
	  }
	  
	function concern_popup(){
	        $id = $this->basic->get_post_data();
	    	$template['data'] = $this->basic->get_data('{PRE}complaints',array('where'=>array('order_id'=>$id['userdetails'])),'*');
	  		$this->load->view('Concern/view_concern_popup',$template);
	}
}	 
?>