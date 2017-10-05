<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Zoho_invoice{

	public function __construct() {
        
        // Paste this URL to browser https://accounts.zoho.com/apiauthtoken/nb/create?SCOPE=ZohoInvoice/invoiceapi&EMAIL_ID=[ZohoID/EmailID]&PASSWORD=[Password] to get Auth token
        $_SESSION['authtoken'] = 'b45332fd06e8be90c6832dcb57c25ea3';
        // Paste this URL to browser https://invoice.zoho.com/api/v3/organizations?authtoken=[AUTHTOKEN] to get organization id
        $_SESSION['organization_id'] = 647546640;
        // Sales person name
        $data['sales_person'] = 'Ravi';
	}
	public function get_all_invoice( $type = 'pdf'){
	     $fields = array('accept' => $type);
        $response = $this->sendRequest("invoices/", $fields, 'GET');
        print_r($response['invoice']);die;
        return $response->invoice;
	}
    public function getInvoice($invoiceId, $type = 'pdf') {
        // RM: Get invoice
        $fields = array('accept' => $type);
        $response = $this->sendRequest("invoices/".$invoiceId, $fields, 'GET');
        return $response->invoice->invoice_url;
    }
    public function create_item($data){
       $temp = explode('&',$data['unit']);
       $data['unit'] = strtoupper($temp[1]);
        $fields = array(
            "name"=> $data['product_name'],
            "description"=> $data['details'],
            "unit"=> $data['unit'],
            "status"=> "active",
            "rate" => $data['final_price'],
            "product_type"=> "goods"
        );
    
         $response = $this->sendRequest("items/", $fields, 'POST');
         return $response->item->item_id;
    }
    public function markInvoiceAsSent($invoiceId) {
        // RM: Set invoice
        return $this->sendRequest("invoices/{$invoiceId}/status/sent", array(), 'POST');
    }
    public function payInvoice() {
        $fields = array(
        "customer_id" => 664360000000065025,
        'invoices' => array(0 => array("invoice_id" => 664360000000076011, 'amount_applied' => 20)),
        'payment_mode' => 'paypal',
        'date' => date('Y-m-d'),
        'amount' => 120,
        'exchange_rate' => 1,
        //         "customer_id" => $customerId,
        // 'invoices' => array(0 => array("invoice_id" => $invoiceId, 'amount_applied' => $this->data['invoice_data']['c_users_invoices_amount'])),
        // 'payment_mode' => 'paypal',
        // 'date' => date('Y-m-d', strtotime($this->data['invoice_data']['c_users_invoices_created'])),
        // 'amount' => $this->data['invoice_data']['c_users_invoices_amount'],
        // 'exchange_rate' => 1,
        );
        return $this->sendRequest("customerpayments", $fields, 'POST');
    }
    public function createInvoice($data) {
        
        $fields = array(
        'customer_id' => $data['cust_id']->contect_id,
        'payment_terms' => 1,
        'due_date' => date('Y-m-d'),
        'salesperson_name' => "Mohit Yadav",
         'line_items'=>array()
         );
        foreach($data['data'] as $temp){
        $field1 = array();
        $field1['item_id']=$temp['item_id']->item_id;
        $field1['quantity']=$temp['quantity'];
        $field1['rate']=$temp['price'];
        array_push($fields['line_items'],$field1);
        unset($field1);
        };
       // "contact_name"=> "Mrs. Babita Hardia"
        //);
        //};
       
        // $fields = array(
        // 'customer_id' => $customerId,
        // 'date' => date('Y-m-d', strtotime($this->data['invoice_data']['c_users_invoices_created'])),
        // 'payment_terms' => 1,
        // 'due_date' => date('Y-m-d', strtotime($this->data['invoice_data']['c_users_invoices_created'])),
        // 'salesperson_name' => $this->data['sales_person'],
        // 'line_items' => array(0 => array(
        // 'name' => $this->data['invoice_data']['storitev'],
        // 'quantity' => 1,
        // 'rate' => $this->data['invoice_data']['s_prices_price'],
        // "tax_name" => 'GST',
        // 'tax_type' => 'tax',
        // 'tax_percentage' => '10',
        // 'tax_id' => '545360000000039001',
        // )),
        // "payment_made" => $this->data['invoice_data']['c_users_invoices_amount'],
        // "payment_options" => array("payment_gateways" => array(0 => array('gateway_name' => 'paypal'))),
        // "gateway_name" => "paypal",
        // "exchange_rate" => 1.00,
        // );
        $response = $this->sendRequest('invoices', $fields, 'POST');
        return $response->invoice->invoice_id;
    }
    public function getContactIdOrCreateContact($data) {
        // RM: Go trough contact
        // $contactId = false;
        // if (is_array($response->contacts)) {
        //     foreach($response->contacts as $contact) {
        //         if ($contact->email == $this->data['invoice_data']['user_data']['c_users_email']) {
        //             $contactId = $contact->contact_id;
        //         }
        //     }
        // }
        // // RM: If contact is false, create new contact
        // if ($contactId === false) {
            // $fields = array(
            // 'contact_name' => $this->data['invoice_data']['user_data']['c_users_name'].' '.$this->data['invoice_data']['user_data']['c_users_lastname'],
            // 'email' => $this->data['invoice_data']['user_data']['c_users_email'],
            // );
            // // RM: Is company?
            // if( $this->data['invoice_data']['c_users_invoices_company'] == 1 ) {
            //     $fields['company_name'] = $this->data['invoice_data']['c_users_invoices_company_name'];
            //     $fields['billing_address'] = array(
            //     'address' => $this->data['invoice_data']['c_users_invoices_company_street'],
            //     "city" => $this->data['invoice_data']['c_users_invoices_post'][0],
            //     "zip" => $this->data['invoice_data']['c_users_invoices_post'][1],
            //     "country" => $this->data['invoice_data']['user_data']['c_countries_foreignname'],
            //     );
            //     /* Custom fields not configured for contacts. */
            //     /*
            //     if (!empty($this->data['invoice_data']['c_users_invoices_taxid'])) {
            //     $fields['custom_fields'][0] = array(
            //     'index' => 1,
            //     "value" => $this->data['invoice_data']['c_users_invoices_taxid'],
            //     "label" => "VAT ID"
            //     );
            //     }*/
            // } else {
            //     $fields['billing_address'] = array(
            //     'address' => $this->data['invoice_data']['c_users_invoices_street'],
            //     "city" => $this->data['invoice_data']['c_users_invoices_post'][0],
            //     "zip" =>  $this->data['invoice_data']['c_users_invoices_post'][1],
            //     "country" => $this->data['invoice_data']['user_data']['c_countries_foreignname'],
            //     );
            // }
            // // RM: Add contact persons
            // $fields['contact_persons'][0] = array(
            // "first_name" => $this->data['invoice_data']['user_data']['c_users_name'],
            // "last_name" => $this->data['invoice_data']['user_data']['c_users_lastname'],
            // "email" => $this->data['invoice_data']['user_data']['c_users_email'],
            // "mobile" => $this->data['invoice_data']['user_data']['c_users_fullphone'],
            // "is_primary_contact" => true,
            // );
            $fields = array(
            'contact_name' => ucfirst($data['first_name']).ucfirst($data['last_name']),
            'email' => $data['email'],
            "mobile" => $data['phone'],
            );
                $fields['billing_address'] = array(
                'address' => $data['address'],
                "city" => "Indore",
                "zip" =>  "452001",
                "country" => "India",
                );
                $fields['shipping_address'] = array(
                'address' => $data['address'],
                "city" => "Indore",
                "zip" =>  "452001",
                "country" => "India",
                );
          // }
            // RM: Add contact persons
            $fields['contact_persons'][0] = array(
            "first_name" => ucfirst($data['first_name']),
            "last_name" => ucfirst($data['last_name']),
            "email" => $data['email'],
            "mobile" => $data['phone'],
            "is_primary_contact" => true,
            );
            $response = $this->sendRequest('contacts', $fields, 'POST');
            if (is_object($response->contact)) {
                $contactId = $response->contact->contact_id;
            }
   // }
        return $contactId;
    }
    public function urlencode_array($array) {
        foreach($array as $key => $row) {
            if (is_array($row)) {
                $array[$key] = $this->urlencode_array($row);
            } else {
                if (!is_bool($row)) {
                    $array[$key] = urlencode($row);
                }
            }
        }
        return $array;
    }
    /**
	 * Sends the actual request to the REST webservice
	 */
    public function sendRequest($url, $data, $type = 'POST') {
        $authtoken = $_SESSION['authtoken'];
        $organization_id = $_SESSION['organization_id'];
        $jsonData = json_encode($this->urlencode_array($data));
        if ($type == 'POST') {
            $ch = curl_init("https://invoice.zoho.com/api/v3/{$url}?authtoken={$authtoken}&organization_id={$organization_id}&JSONString={$jsonData}");
           // print_r("https://invoice.zoho.com/api/v3/{$url}?authtoken={$authtoken}&organization_id={$organization_id}");die;
            curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);// Turn off the server and peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//Set to return data to string ($response)
            curl_setopt($ch, CURLOPT_POST, TRUE);//Regular post
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json") );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        } else {
            $ch = curl_init("https://invoice.zoho.com/api/v3/{$url}?authtoken={$authtoken}&organization_id={$organization_id}");
           // print_r("https://invoice.zoho.com/api/v3/{$url}?authtoken={$authtoken}&organization_id={$organization_id}&JSONString={$jsonData}");die;
            curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);// Turn off the server and peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//Set to return data to string ($response)
            curl_setopt($ch, CURLOPT_POST, FALSE);//Regular post
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded") );
        }
        $result = curl_exec($ch);
        $result = json_decode($result);
        
        // RM: IS not object, is not code 0?
        if (is_object($result) === false || $result->code != 0) {
            throw new AppException('Error creating estimate/invoice - '.print_r($result, true));
        }
        return $result;
    }
}
?>