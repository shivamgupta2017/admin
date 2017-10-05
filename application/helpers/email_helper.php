<?php 
function send_mail($data){
     $ci=& get_instance();
     $ci->load->database(); 
     $settings = $ci->db->select('*')->from('settings')->get()->row();
				   $configs = array(
						'protocol'=>'smtp',
						'smtp_host'=>$settings->smtp_host,
						'smtp_user'=>$settings->smtp_username,
						'smtp_pass'=>$settings->smtp_password,
						'smtp_port'=>'465'
						);             
                $ci->load->library('email',$configs);
			    //$this->email->initialize($configs);
                $ci->email->from($settings->admin_email, $data['first_name']);
                $ci->email->to($data['email']);
                $ci->email->subject($data['subject']);
                $ci->email->message($data['message']);
                $ci->email->set_mailtype("html");
                $ci->email->send(); 
}
?>