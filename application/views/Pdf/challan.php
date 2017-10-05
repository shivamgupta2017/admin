<?php
$this->load->library('Fpdf');
$billing=[ucfirst($shipping_details[0]->vendor_name), $shipping_details[0]->address, $shipping_details[0]->city, $shipping_details[0]->zipcode, $shipping_details[0]->email, $shipping_details[0]->mobile];
$invoice=['INV-000'.$invoice_id,date('Y-m-d'),'Due on Receipt',''];
$header = array('#', 'Item', 'Weight', 'Qty','Price','Amount');
$data=[];
foreach($products as $index=>$temp_products)
{

	array_push($data,array($temp_products->product_name, $temp_products->quantity, $temp_products->unit_name , $temp_products->weight, $temp_products->cost ,$temp_products->unit_name)); //[ ProductName, Qty, weight, unit, price,tax,isInclusive]

}


$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->Header2($billing, $logo);
$total=$pdf->ChallanTable($header,$data);
//echo "<script>alert(".$m.");</script>";


// $pdf->Ln('5');
// $pdf->Cell(30,5,'Thanks for choosing Minbazaar',0,0,'B',false);
// $pdf->Cell(80,5,'',0,0,'B',false);
// $pdf->Cell(40,5,'Sub Total',0,0,'R',false);
// $pdf->Cell(40,5,$total,0,0,'R',false);
// $pdf->Ln(5);
// $pdf->Cell(110,5,'',0,0,'T',false);
// $pdf->Cell(80,5,'','T');
// $pdf->Ln(1);

// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(110,5,'',0,0,'T',false);
// $pdf->Cell(40,5,'Total',0,0,'R',false);
// $pdf->Cell(40,5,'1200',0,0,'R',false);
// $pdf->Ln('5');

// $pdf->Cell(110,5,'',0,0,'T',false);
// $pdf->Cell(80,5,'','T');
// $pdf->Ln(1);

// $pdf->SetFont('Arial','B',10);
// $pdf->Cell(110,5,'',0,0,'B',false);
// $pdf->Cell(40,5,'Balance Due',0,0,'R',false);
// $pdf->Cell(40,5,'1200',0,0,'R',false);
// $pdf->Ln('5');

// $pdf->Cell(110,5,'',0,0,'T',false);
// $pdf->Cell(80,5,'','T');
// $pdf->Ln(1);
// $pdf->SetFont('Arial','B',9);
$pdf->Ln(0);
/*$pdf->Cell(30,5,'Terms & Conditions',0,0,'B',false);*/
$pdf->SetFont('Arial','',9);
$pdf->Ln('5');
/*$pdf->Cell(30,5,'You are requested to make the payment withing 3 days of the receipt of the invoice.',0,0,'B',false);*/
// $pdf->Output();
// $pdf->Output('docs.pdf','F');

$pdf->Output();
// header("location:mizan/mizan.pdf");

?>
