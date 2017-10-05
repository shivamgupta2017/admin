<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>-->
<!--<script type="application/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
<!--<div id="content">-->
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/invoice.css">
		<script src="<?php echo base_url();?>assets/js/invoice.js"></script>
	</head>
	<body>
		<header style="margin-bottom:10px; padding-bottom:10px">
			<h1>Invoice</h1>
			<address contenteditable>
				<p>Minbazaar Subscription</p>
				<p>Sheetal Nagar, 425001, 34, Sheetal Nagar, <br> Sceme No 54, Scheme 54 PU4, Indore, Madhya Pradesh 452011</p>
			</address>
			<span><img height="60" alt="" src="<?php echo base_url()?>uploads/logos/invoice_logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
		
			<div style="width:50%; float:left; font-size:14px; line-height:20px">
				<div>Customer Name : <?php echo ucfirst($data['order'][0]->cust_name);?></div>
				<div>Phone : <?php echo ucfirst($data['order'][0]->phone);?></div>
				<div>Email : <?php echo ucfirst($data['order'][0]->email);?></div>
				<div>Address : <?php echo ucfirst($data['order'][0]->address);?><br><?php echo ucfirst($data['order'][0]->apartment);?></div>
		    </div>
			
			<table class="meta" style="margin-bottom:10px; padding-bottom:10px">
				<tr>
					<th><span contenteditable>Invoice #</span></th>
					<td><span contenteditable><?php echo $data['order'][0]->id;?></span></td>
				</tr>
				<tr>
					<th><span contenteditable>Date</span></th>
					<td><span contenteditable><?php echo date('Y-m-d');?></span></td>
				</tr>
				<tr>
				    <?php  $temp_tax=0; $temp_product_total=0;
				        foreach($data['order_products'] as $temp_data)
				        {
				            $temp_product_total = $temp_product_total+($temp_data->price*$temp_data->quantity);
				            $temp_tax = $temp_tax+(($temp_data->rate*$temp_data->price*$temp_data->quantity)/100);
				        }
				    
				    ?>
					<th><span contenteditable>Amount Due</span></th>
					<td><?php echo $temp_product_total+$temp_tax; ?></td>
					
				</tr>
			</table>
			<table class="inventory" >
				<thead>
					<tr>
						<th style="width:250px"><span contenteditable>Item</span></th>
						<!--<th><span contenteditable>Description</span></th>-->
						<th style="width:70px"><span contenteditable>Weight</span></th>
						<th style="width:50px"><span contenteditable>Quantity</span></th>
						<th style="width:50px"><span contenteditable>Price</span></th>
						<th style="width:50px"><span contenteditable>Total Price</span></th>
						<th style="width:50px"><span contenteditable>Tax</span></th>
					</tr>
				</thead>
				<tbody>
				    
				    <?php foreach($data['order_products'] as $temp_data){?>
					<tr>
						<td><a class="cut">-</a><span contenteditable><?php echo $temp_data->product_name;?></span></td>
						<td><span ><?php echo $temp_data->weight;?></span><span><?php echo $temp_data->unit;?></span></td>
						<td><span><?php echo $temp_data->quantity;?></span></td>
						<td><span><?php echo $temp_data->price;?></span></td>
						<td>₹<span><?php echo ($temp_data->price*$temp_data->quantity);?></span></td>
						<td>₹<span><?php echo (($temp_data->rate*$temp_data->price*$temp_data->quantity)/100); ?></span><span></span></td>
					</tr>
					<?php }?>
				</tbody>
				
			</table>
			<hr>
			<!--<a class="add">+</a>-->
			<hr>
			<table class="balance">
				<tr>
				    
					<th><span contenteditable>Total</span></th>
					<td><?php echo $temp_product_total+$temp_tax; ?></td>
				</tr>
				<tr>
					<th><span contenteditable>Amount Paid</span></th>
					<td></td>
				</tr>
				<tr>
					<th><span contenteditable>Balance Due</span></th>
					<td><?php echo $temp_product_total+$temp_tax; ?></td>
				</tr>
			</table>
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
	<a href="javascript:forprint()"><img src="http://www.iconarchive.com/download/i18772/iconshock/real-vista-text/print.ico" style="border:0; align:middle;width:5%"> Click here to Print the Page</a>
<!--</div>-->
<!--<a href="javascript:demoFromHTML()" class="button">Run Code</a>-->
<!--<script type="text/javascript">-->
<!--    function demoFromHTML() {-->
<!--        var pdf = new jsPDF('p', 'pt', 'letter');-->
<!--        // source can be HTML-formatted string, or a reference-->
<!--        // to an actual DOM element from which the text will be scraped.-->
<!--         var source = $('#content').value();-->
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