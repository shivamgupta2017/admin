<?php 
function create_notification($data){
 $content = array(
		    'en'=>$data['message']
			);
	        $heading = array("en"=>'Hey!!!!.. '.ucfirst($data['first_name']).' '.ucfirst($data['last_name']));
		$fields = array(
		    'app_id' => "93c7e511-bea9-41fe-93e5-6226c84c3619",
		     'headings'=> $heading,
		      'include_player_ids' => array($data['device_id']),
		       'url' => $data['url'],
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
}
function web_push(){
    $content = array(
		    'en'=>"New Express Order is Placed"
			);
	$heading = array("en"=>'New Order');
	   // }
	   // else if($action == "custom"){
// 	        $device_id = $this->input->post('device_id');
// 	        $result = $this->db->select('customer_registration.*')->from('customer_registration')->where('device_id',$device_id)->get()->result();
// 	        $content = array(
// 	        'en'=> $result->first_name.$result->last_name.'This is simple'
// 			);
	    //}
		$fields = array(
		    "included_segments"=> ["admin"],
		    'app_id' => "ee4c8c07-d217-48f5-863d-3d088121a959",
		    'headings'=> $heading,
		    'url' => "http://minbazaar.com/admin/Order_ctrl",
			'contents' => $content
		);
		$fields = json_encode($fields);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
		'Authorization: Basic MmZhZjEyNGItNjU2MS00MjY2LTg5OTMtMzRlMmI2Y2Y3MzM1'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);
		curl_close($ch);
}
function web_push1(){
    $content = array(
		    'en'=>"New Order is Placed"
			);
	$heading = array("en"=>'New Order');
	   // }
	   // else if($action == "custom"){
// 	        $device_id = $this->input->post('device_id');
// 	        $result = $this->db->select('customer_registration.*')->from('customer_registration')->where('device_id',$device_id)->get()->result();
// 	        $content = array(
// 	        'en'=> $result->first_name.$result->last_name.'This is simple'
// 			);
	    //}
		$fields = array(
		    "included_segments"=> ["admin"],
		    'app_id' => "ee4c8c07-d217-48f5-863d-3d088121a959",
		    'headings'=> $heading,
		    'url' => "http://minbazaar.com/admin/Order_ctrl",
			'contents' => $content
		);
		$fields = json_encode($fields);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
		'Authorization: Basic MmZhZjEyNGItNjU2MS00MjY2LTg5OTMtMzRlMmI2Y2Y3MzM1'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);
		curl_close($ch);
}
?>