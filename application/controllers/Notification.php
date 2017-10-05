<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
 public function send_notification($action =''){
	  //  if($action == 'regular'){
	  $message = $this->input->post('message');
	  $title = $this->input->post('title');
	  	move_uploaded_file($_FILES['large_icon']['tmp_name'],'assets/uploads/notification_image/'."notification_big_".$_FILES['large_icon']['name']);
	  	$small_icon = base_url()."assets/uploads/notification_image/notification_big_".$_FILES['large_icon']['name'];
	  		move_uploaded_file($_FILES['big_icon']['tmp_name'],'assets/uploads/notification_image/'."notification_large_".$_FILES['big_icon']['name']);
	  	$big_icon = base_url()."assets/uploads/notification_image/notification_large_".$_FILES['big_icon']['name'];
		$content = array(
		    'en'=>$message
			);
	        $heading = array("en"=>$title);
	   // }
	   // else if($action == "custom"){
// 	        $device_id = $this->input->post('device_id');
// 	        $result = $this->db->select('customer_registration.*')->from('customer_registration')->where('device_id',$device_id)->get()->result();
// 	        $content = array(
// 	        'en'=> $result->first_name.$result->last_name.'This is simple'
// 			);
	    //}
		$fields = array(
		    "included_segments"=> ["All"],
		    'app_id' => "93c7e511-bea9-41fe-93e5-6226c84c3619",
		    'headings'=> $heading,
		    'large_icon'=>$small_icon,
		    'big_picture'=> $big_icon,
			'contents' => $content
		);
	
		$fields = json_encode($fields);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NzNmM2Y4MDEtZTdmZi00YmYxLWI1OWMtY2E4NjEwZjRmYmU0'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		if(!empty($response)){
		     $this->session->set_flashdata('message', array('message' => "Notification Sent Successfully.",'class' => 'success'));	
		    header("LOCATION :create_notification");
		}
		else{
		      $this->session->set_flashdata('message', array('message' => "Unable to Send Successfully.",'class' => 'danger'));	
		    header("LOCATION :create_notification");
		}
	
	
}
public function create_notification(){
    
          $template['page'] = 'Notification/notification';
		  $template['title'] = 'View Package';
		  $this->load->view('template',$template);
    }
}
?>