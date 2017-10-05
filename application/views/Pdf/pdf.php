<?php 
$this->load->library('Fpdf');
$this->load->database();
$billing=[ucfirst($shipping_details[0]->first_name).' '.ucfirst($shipping_details[0]->last_name),$shipping_details[0]->address, $shipping_details[0]->address2, $shipping_details[0]->zipcode,'GSTIN:'.$shipping_details[0]->GSTIN_NO, $shipping_details[0]->email, $shipping_details[0]->phone];



if(!empty($shipping_details[0]->shipping_address_1))
{
	$billing1=[$shipping_details[0]->shipping_address_1, $shipping_details[0]->shipping_address_2, $shipping_details[0]->shipping_zip, 'GSTIN:'.$shipping_details[0]->GSTIN_NO,$shipping_details[0]->email, $shipping_details[0]->shipping_phone];
}
else{
$billing1 = $billing;
}
$invoice=['INV-000'.$invoice_id,date($invoice_date),'Due on Receipt',date($due_date),$express_charges];
$header = array('#', 'Item', 'Quantity', 'Unit Price','CGST','SGST','Amount');
$data=[];
foreach($products as $index=>$temp_products)
{
	array_push($data,array($temp_products['name'], $temp_products['quantity'],$temp_products['size'], $temp_products['product_unit'],$temp_products['price'],$temp_products['rate'],'')); //[ ProductName, Qty, weight, unit, price,tax,isInclusive]
}

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->Header1();


$pdf->BillingDetails($billing,$invoice);
$pdf->BillingDetails1($billing1);
$total=$pdf->ImprovedTable($header,$data,$express_charges);
//echo "<script>alert(".$m.");</script>";

// $pdf->Cell(110,5,'',0,0,'T',false);
// $pdf->Cell(80,5,'','T');
// $pdf->Ln(1);
// $pdf->SetFont('Arial','B',9);
// $pdf->Ln(0);
// $pdf->Cell(30,5,'Terms & Conditions',0,0,'B',false);
// $pdf->SetFont('Arial','',9);
// $pdf->Ln('5');
// $pdf->Cell(30,5,'You are requested to make the payment withing 3 days of the receipt of the invoice.',0,0,'B',false);

//$pdf->Output();
$pdf->Output($_SERVER['DOCUMENT_ROOT'].'/admin/assets/pdfs/invoice/INV-000'.$invoice_id.'.pdf','F');
// $this->session->set_flashdata('message', array('message'=>"Invoice Created Successfully",'class' => 'success'));
 //redirect(base_url().'Invoice/create_invoice');
// $link['invoice_link'] = base_url()."assets/pdfs/invoice/INV-000".$products[0]->order_id.".pdf";
// $this->db->where('order_id',$products[0]->order_id);
// $this->db->update('payments',$link);
//header("Location :".base_url()."assets/pdfs/".$products[0]->order_id.".pdf");
?>