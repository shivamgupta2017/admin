<?php 
$this->load->library('Fpdf');
$this->load->database();
$billing=[ucfirst($shipping_details[0]->client_name),$shipping_details[0]->address, $shipping_details[0]->city, $shipping_details[0]->zipcode,'GSTIN:'.$shipping_details[0]->GSTIN_NO, $shipping_details[0]->email, $shipping_details[0]->mobile_no, $net_balance];




// $invoice=['INV-000'.$invoice_id,date('31/07/2017'),'Due on Receipt',date('15/09/2017')]; editbymizan -----
$invoice=['INV-000'.$invoice_id,date('Y-m-d'),'Due on Receipt',date('Y-m-d'), $payment_type]; //editbymizan+++++



$header = array('#', 'Item', 'Quantity', 'Unit Price','CGST','SGST','Amount');
$data=[];

foreach($products as $index=>$temp_products)
{
	array_push($data,array($temp_products->product_name, $temp_products->quantity, 1, $temp_products->unit_name,$temp_products->sales_price, $temp_products->tax, '')); //[ ProductName, Qty, weight, unit, price,tax,isInclusive]
}


$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->Header1($logo);
$pdf->BillingDetails($billing,$invoice);
$total=$pdf->ImprovedTable($header,$data, 0);
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
$pdf->Output();
// $this->session->set_flashdata('message', array('message'=>"Invoice Created Successfully",'class' => 'success'));
 //redirect(base_url().'Invoice/view_invoice');
// $link['invoice_link'] = base_url()."assets/pdfs/invoice/INV-000".$products[0]->order_id.".pdf";
// $this->db->where('order_id',$products[0]->order_id);
// $this->db->update('payments',$link);
//header("Location :".base_url()."assets/pdfs/".$products[0]->order_id.".pdf");
?>