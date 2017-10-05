<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>-->
<!--<script type="application/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
<!--<div id="content">-->
<button onclick="forprint()" style="position:fixed; top:10px; right:10px ">print</button>
<html>
    
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/invoice.css">
		<script src="<?php echo base_url();?>assets/js/invoice.js"></script>
	</head>
	
	<body>
	   <!--<?php echo ($data['bill']->payment_status == 0 )?"<div class='corner-ribbon top-left sticky red shadow'>Unpaid</div>":"<div class='corner-ribbon top-left sticky orange shadow'>Paid</div>"?>-->
		<header style="margin-bottom:0px; padding-bottom:0px; <?php if(count($data['billing_details'])<26){echo " margin-top:50px";}else{echo "margin-top:0px";} ?>">
		
			<address style="float:right; text-align:right">
				<p style="font-weight:bold">My India Kart Pvt Ltd</p><br>
				<p>34, Ratanlok Colony, Scheme No 53</p>
				<p> Vijay Nagar</p> 
				<p> Indore 452001</p>
				<p>India</p>
				<p>GSTIN: 23AAKCM8439J1Z2</p>
			</address>
			<span style="float:left"><img height="100" alt="" src="<?php echo base_url()?>uploads/logos/invoice_logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
		    
		    
		    
		    <div style="width: 100%; height: 3px; border-bottom: 3px solid #ddd; text-align: center">
                <span style="font-size: 15px; background-color: white;">
                        &nbsp;&nbsp;INVOICE&nbsp;&nbsp; <!--Padding is optional-->
                </span>
    </div>
    <br>

<div >Product: <?php echo $data['bill']->product_name;?> <?php if($data['is_package']) echo '('.$data['bill']->size_name.')';?></div>
    <br>
		    
				<div style="width:50%; float:left; font-size:12px; line-height:20px">
				<div style="">Bill To</div>
				<div style="font-size:13px; font-weight:bold;"><?php echo ucfirst($data['bill']->first_name).' '.ucfirst($data['bill']->last_name);?></div>
				<div><?php echo ucfirst($data['bill']->phone);?></div>
				<div><?php echo ucfirst($data['bill']->email);?></div>
				<div><?php echo ucfirst($data['bill']->address);?><br><?php echo ucfirst($data['bill']->apartment);?></div>
				<div><?php echo ucfirst($data['bill']->zip);?></div>
		    </div>
			
	        
			<table class="meta" style="font-size:12px; line-height:25px; float:right; border-collapse: collapse; border:none;">
				<tr >
					<th style="border:none; font-weight:bold; background-color:white; padding:0px;"><span>Invoice #</span></th>
					<td style="border:none;  background-color:white; padding:0px"><span><?php echo $data['bill']->billing_id;?></span></td>
				</tr>
				<tr>
					<th style="border:none; font-weight:bold; background-color:white; padding:0px"><span>Date</span></th>
					<td style="border:none;  background-color:white; padding:0px"><span ><?php echo date('Y-m-d');?></span></td>
				</tr>
				<tr>
					<th style="border:none; font-weight:bold; background-color:white; padding:0px"><span>Status</span></th>
					<td style="border:none;  background-color:white; padding:0px"><span ><?php echo ($data['bill']->payment_status == 0)?"Unpaid":"Paid";?></span></td>
				</tr>
				<tr>
					<th style="border:none;  font-weight:bold; background-color:white; padding:0px"><span >Amount Due</span></th>
					<td style="border:none;  background-color:white; padding:0px"><span id="prefix">&#8377;</span><span><?php echo $data['bill']->amount;?></span></td>
				</tr>
			</table>
		
		
			<table class="inventory" style="line-height:17px; font-size:13px" >
				<thead>
					<tr>
					    <th style="border-radius:0px; font-weight:bold;padding:0px; border-left:2px solid #aaa; background-color:#ddd; width:40px"><span>#</span></th>
					    <th style="border-radius:0px; font-weight:bold;padding:0px; border-left:2px solid #aaa; background-color:#ddd"><span>Date</span></th>
						  <th style="border-radius:0px;font-weight:bold;padding:0px; border-left:2px solid #aaa; background-color:#ddd; width:80px; text-align:center"><span >Price (<?php if($data['bill']->is_inclusive){echo "Including Tax";}else{echo "Excluding Tax";}?>)</span></th>
						   <th style="border-radius:0px; font-weight:bold;padding:0px; border-left:2px solid #aaa; background-color:#ddd"><span>Tax</span></th>
						    <th style="border-radius:0px; font-weight:bold; padding:0px; border-left:2px solid #aaa; background-color:#ddd"><span >Weight/qty</span></th>
						     <th style="border-radius:0px; font-weight:bold; padding:0px; border-left:2px solid #aaa; background-color:#ddd"><span>Total Price</span></th>
					</tr>
				</thead>
				<tbody>
				    <?php $i = 0; $k=1;foreach($data['billing_details'] as $key=>$temp_data){?>
					<tr >
					    <td style="border-radius:0px; padding:0px;  text-align:center"><?php echo $k; ?></td>
					    <td  style="border-radius:0px; padding:0px;  padding-left:10px; text-align:center">
					        <span><?php echo date('d-M-Y',strtotime($temp_data->date));?></span>
					    </td>
						<td  style="border-radius:0px; padding:0px; padding-left:10px; text-align:center">
						    &#8377; <span id="prefix" ><?php echo $temp_data->price;?></span>
					    </td>
						<td  style="border-radius:0px; padding:0px;  padding-left:10px; text-align:center">
						  <?php if($data['bill']->is_inclusive){ ?>
                                <div style="display:inline-block">
						         <?php echo $data['bill']->tax_rate.'% ('.$data['bill']->tax_name.') &#8377; ';?>
						    </div>
						    <span>
						        <?php echo number_format(($temp_data->price*2/(100+$data['bill']->tax_rate)), 2, '.', '');?>
						    </span>
						    <span style="display:none">
						        0
						    </span>
						  <?php } else{ ?>
						  						    <div style="display:inline-block">
						         <?php echo $data['bill']->tax_rate.'% ('.$data['bill']->tax_name.') &#8377; ';?>
						    </div>
						    <span><?php echo ($temp_data->price*$data['bill']->tax_rate/100);?></span>
						    
						    
						  
						          					    
						   
						  <?}?>
						
						</td>
						<td  style="border-radius:0px; padding:0px; padding-left:10px; text-align:center">
						    <span><?php echo $temp_data->extra_qty + $temp_data->qty.' '.$data['unit']->unit;?> </span> <?php if($data['is_package']){ echo "<span style='display:none'>1</span>";
						    }?>
						</td>
					    <td  style="border-radius:0px; font-weight:bold;padding:0px; padding-left:10px;text-align:right; padding-right:10px;">
					        <span><?php echo $temp_data->price * ($temp_data->extra_qty + $temp_data->qty);?></span></td>
					</tr>
					<?php $i=$i+$temp_data->price * ($temp_data->extra_qty + $temp_data->qty); $k++;}?>
									   
				</tbody>
				
			</table>
			<div style="font-size:12px;">Thanks for choosing MINBazaar.</div>
	<!--		<a class="add">+</a>-->
			<table class="balance" style="border:none;">
				<tr style="border:none; border-bottom:2px solid #aaa;">
					<td style="border:none;"><span>Sub Total</span></td>
					<td  style="border:none; padding:5px 5px;"><span data-prefix>₹</span><span><?php echo $i;?></span></td>
				</tr>
				<tr style="border:none; border-bottom:2px solid #aaa;">
					<td  style="border:none; font-weight:bold"><span>Total</span></td>
					<td  style="border:none;"><span data-prefix>₹</span><span>0.00</span></td>
				</tr>
				<tr style="border:none; border-bottom:2px solid #aaa;">
					
					<td  style="border:none; font-weight:bold"><span>Balance Due</span></td>
					<td  style="border:none;"><span data-prefix>₹</span><span><?php echo $i;?></span></td>
				</tr>
			</table><br><br><br>
		<div style="font-size:12px; font-weight:bold">Terms & Conditions</div><br>
<div style="font-size:12px;">You are requested to make the payment withing 3 days of the receipt of the invoice.</div>
		</article>
	</body>
	</html>
	<script>
		function forprint()
		{
			if (!window.print)
			{
				return
			}
			window.print()
		}
	</script>
<!--</html>-->
<!--</div>-->
<!--<a href="javascript:demoFromHTML()" class="button">Run Code</a>-->
<!--<script type="text/javascript">-->
<!--    function demoFromHTML() {-->
<!--        var pdf = new jsPDF('p', 'pt', 'letter');-->
<!--        // source can be HTML-formatted string, or a reference-->
<!--        // to an actual DOM element from which the text will be scraped.-->
<!--         var source = $('#content')[0];-->
<!--        // we support special element handlers. Register them with jQuery-style -->
<!--        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)-->
<!--        // There is no support for any other type of selectors -->
<!--        // (class, of compound) at this time.-->
<!--        specialElementHandlers = {-->
<!--            // element with id of "bypass" - jQuery style selector-->
<!--            '#bypassme': function (element, renderer) {-->
<!--                // true = "handled elsewhere, bypass text extraction"-->
<!--                return true-->
<!--            }-->
<!--        };-->
<!--        margins = {-->
<!--            top: 80,-->
<!--            bottom: 60,-->
<!--            left: 40,-->
<!--            width: 522-->
<!--        };-->
<!--        // all coords and widths are in jsPDF instance's declared units-->
<!--        // 'inches' in this case-->
<!--        pdf.fromHTML(-->
<!--            source, // HTML string or DOM elem ref.-->
<!--            margins.left, // x coord-->
<!--            margins.top, { // y coord-->
<!--                'width': margins.width, // max width of content on PDF-->
<!--                'elementHandlers': specialElementHandlers-->
<!--            },-->

<!--            function (dispose) {-->
<!--                // dispose: object with X, Y of the last line add to the PDF -->
<!--                //          this allow the insertion of new lines after html-->
<!--                pdf.save('Test.pdf');-->
<!--            }, margins-->
<!--        );-->
<!--    }-->
<!--</script>-->