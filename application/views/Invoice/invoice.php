<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- left column -->
         <div class="col-md-12">
            <?php
               if($this->session->flashdata('message')) {
               $message = $this->session->flashdata('message');
               ?>
            <div class="alert alert-<?php echo $message['class']; ?>">
               <button class="close" data-dismiss="alert" type="button">×</button>
               <?php echo $message['message']; ?>
            </div>
            <?php
               }
               ?>
         </div>
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="box">
              <div class="box-header">
                  <ol class="breadcrumb">
                    <li><a href="#"><i aria-hidden="true"></i>Home</a></li>
                    <li class="active">Create Invoice</li>
                    <!--<a href="<?php echo base_url(); ?>Product_ctrl/add_products" style="float:right;color:white;"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>-->
                </ol>
                </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="import" method="post"  data-parsley-validate="" id="my_form" class="validate" enctype="multipart/form-data">
			   
                  <div class="box-body">
                  <div class="col-md-12">
                     <div class="col-md-6">
                        <!--<div class="form-group has-feedback">-->
                        <!--   <label for="exampleInputEmail1">Title</label>-->
                        <!--    <input type="text" class="form-control required" data-parsley-trigger="change"	-->
                        <!--    data-parsley-minlength="2" data-parsley-pattern="^[a-zA-Z0-9,.\  \/]+$" required="" name="title"  placeholder="Type Title">-->
                        <!--   <span class="glyphicon  form-control-feedback"></span>-->
                        <!--</div>         -->
						 <div class="form-group">
						   <label for="exampleInputEmail1">Select Customer Name</label>
                          <select class="form-control" name="user_name" id="user_name">
                           <?php foreach($users as $temp){?>
                                 <option value="<?php echo $temp->user_id.'&'.$temp->first_name.$temp->last_name;?>"><?php echo ucfirst($temp->first_name).' '.ucfirst($temp->last_name);?></option>
                                <?php } ?>
                            </select> 
                        </div> 
                        <div id="shipping_address1">
                             <label for="exampleInputEmail1">Select Shipping Address</label>
                          <select class="form-control" name="shipping_address" id="shipping_address">
                                </select> 
                                <br><br>
                        </div>
                        <div>
                            <select class="form-control" name="csv_type">
                                 <option value="">Select</option>
                                <option value="0">Billing</option>
                                 <option value="1">Subscription</option>
                                  <option value="2">Challan</option>
                            </select>
                        </div>
                         <br>
                        <input type="file" name="file" id="file" style="border:1px solid black">
                        <br>
                        <label for="exampleInputEmail1">CSV Format Must be (Item Name,Quantity,Weight,Unit,Price,Tax)</label>
                        <br><br>
<!------------------------------------------------------------------------------editbymizan--------------------------------------------------------------------------->
                        <div>
                               <div class="col-md-6">
                                        Invoice Date
                                        <input type="date" class="form-control" name="invoice_date"  >
                               </div>
                                <div class="col-md-6">
                                        Due Date
                                        <input type="date" class="form-control" name="due_date" > 
                                </div>
                                
                        </div>
                        <br><br><br>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------->

                        <br>
                         <button type="submit" class="btn btn-primary">+ Generate Invoice</button>
         <!--               <div class="form-group">-->
						   <!--<label for="exampleInputEmail1">Select Invoice</label>-->
         <!--                 <select class="form-control" name="invoice" id="invoice">-->
         <!--                     <option value=''>Select</option>-->
         <!--                  <?php foreach($invoice as $temp){?>-->
         <!--                        <option value="<?php echo $temp->id;?>"><?php echo "INV-000".$temp->id;?></option>-->
         <!--                       <?php } ?>-->
         <!--                   </select> -->
         <!--               </div> -->
         <!--                <div class="form-group has-feedback">-->
						   <!--<label for="exampleInputEmail1">Select Product</label>-->
         <!--                 <select class="form-control" id="product">-->
         <!--                     <option value=''>Select</option>-->
         <!--                  <?php foreach($product as $temp){?>-->
         <!--                        <option value="<?php echo $temp->product_id.'&'.$temp->product_name;?>"><?php echo $temp->product_name;?></option>-->
         <!--                       <?php } ?>-->
         <!--                       </select> -->
         <!--               </div> -->
               
                        <!--<div id='details'>-->
                        <!--    <input type="text" class="hidden" id="price">-->
                        <!--    <label for="exampleInputEmail1">Weight</label>-->
                        <!--    <select class="form-control" id="weights">-->
                        <!--    </select>-->
                        <!--    <label for="exampleInputEmail1">Quantity</label>-->
                        <!--    <input type="text" class="form-control" id="quantity"  placeholder="Enter quantity">-->
                        <!--</div>-->
                         <!--<button type="button" id="add" class="btn btn-primary" >ADD</button>-->
                  </div>
        <!--          <div class="col-md-6" style='float:right'>-->
        <!--            <input type="hidden" name="option_count" id="option_count" value="<?php if(isset($item_options) && count($item_options)>0) echo count($item_options)+1; else echo "1";?>">-->
				    <!--<input type="hidden" name="option_counts" id="option_counts">-->
        <!--                  <table class="table table-bordered" style="width:100px" id="first">-->
        <!--              <thead>-->
        <!--                <tr>-->
        <!--                  <th>#</th>-->
        <!--                  <th>Product Name</th>-->
        <!--                   <th>Price</th>-->
        <!--                    <th>Quantity</th>-->
        <!--                     <th>Weight</th>-->
        <!--                </tr>-->
        <!--              </thead>-->
        <!--              <tbody>-->
                          
        <!--                  </tbody>-->
        <!--                    </table>-->
        <!--            </div>-->
        <!--              <div class="col-md-6" style='float:right'>-->
        <!--            <input type="hidden" name="option_count1" id="option_count1" value="<?php if(isset($item_options) && count($item_options)>0) echo count($item_options)+1; else echo "1";?>">-->
				    <!--<input type="hidden" name="option_counts1" id="option_counts1">-->
        <!--                  <table class="table table-bordered" style="width:100px" id="second">-->
        <!--              <thead>-->
        <!--                <tr>-->
        <!--                  <th>#</th>-->
        <!--                  <th>Product Name</th>-->
        <!--                   <th>Price</th>-->
        <!--                    <th>Quantity</th>-->
        <!--                     <th>Weight</th>-->
        <!--                </tr>-->
        <!--              </thead>-->
        <!--              <tbody>-->
                          
        <!--                  </tbody>-->
        <!--                    </table>-->
        <!--            </div>-->
       
                  </div>
                  </div>
               </form>
          
            <!-- /.box -->
         </div>
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>

<script>
$('#my_form').on('submit',function(){
    var address = $('#shipping_address').val();
			        if(address ==''){
			            alertify.error("Please Select Shipping Address");
			        }
})
 $('#shipping_address1').hide();
 $('#second').hide();
$('#user_name').on('change',function(){
    var user_id = $('#user_name').val();
    $('#shipping_address').html('');
    $.ajax({
        url: "get_address",
        data: {'id':user_id},
        method: 'POST',
        success:function(data){
            var data = JSON.parse(data);
             $('<option value="" selected>Select</option>').appendTo('#shipping_address');
            for(var i=0;i<data.length;i++){
           $('<option value='+data[i].shipping_add_id+'>').html(data[i].shipping_address_1+' '+data[i].shipping_address_2+' '+data[i].shipping_zip+' '+data[i].shipping_phone+"</option>"
        ).appendTo('#shipping_address');
        
            }
            $('#shipping_address1').show();
        }
    })
    
})
$('#invoice').on('change',function(){
    var invoice_id = $('#invoice').val();
    $('#second').html('');
    $.ajax({
        url: "get_invoice",
        data: {'invoice_id':invoice_id},
        method: 'POST',
        success:function(data){
            var data = JSON.parse(data);
            for(var i=0;i<data.length;i++){
       var cnt=$("#option_count1").val();
  	   var ncnt = cnt;
  	   var sno = cnt;
               $('#first tr').last().after('<tr style="background-color:#4a4f56;"><th scope="row" style="color:white">'+sno+'</th><td><input style="width:200px;background-color:#e7e7e7;text-align:center" hidden type="text" readonly name="product_id'+ncnt+'" id="product_id'+ncnt+'" value="'+data[i].name+'"></td><td><input style="width:200px;background-color:#e7e7e7;text-align:center" type="text" readonly name="product_name'+ncnt+'" id="product_name'+ncnt+'" value="'+data[i].quantity+'"></td><td><input type="text" readonly value="'+data[i].product_unit+'" name="price'+ncnt+'" id="price'+ncnt+'"></td><td><input type="text" readonly value="'+data[i].price+'" name="quantity'+ncnt+'" id="quantity'+ncnt+'"></td><td><input type="text" readonly value="'+data[i].name+'" name="weight'+ncnt+'" id="weight'+ncnt+'"></td></tr>');
  		cnt=++cnt;
  	   $("#option_count1").val(cnt);
  	   $("#option_counts1").val(cnt); 
            }
                    }
    })
})
			  var check_array =[];
			    $('#add').on('click',function(){
			        var select = $('#product').val().split('&');
			        var quantity = $('#quantity').val();
			        var price = $('#price').val();
			        var weight = $('#weights').val();
			        if(select[0] ==''){
			            alertify.error("Please Select Valid Option");
			        }
			        else if(in_array(select[0],weight,check_array)){
  	                    alertify.error("Already Exist");
                    }
                    else{
                    check_array.push(select[0],weight);
			       var cnt=$("#option_count").val();
  	   var ncnt = cnt;
  	   var sno = cnt;
  		
  	    	   $('#first tr').last().after('<tr style="background-color:#4a4f56;"><th scope="row" style="color:white">'+sno+'</th><td><input style="width:200px;background-color:#e7e7e7;text-align:center" hidden type="text" readonly name="product_id'+ncnt+'" id="product_id'+ncnt+'" value="'+select[0]+'"></td><td><input style="width:200px;background-color:#e7e7e7;text-align:center" type="text" readonly name="product_name'+ncnt+'" id="product_name'+ncnt+'" value="'+select[1]+'"></td><td><input type="text" readonly value="'+price+'" name="price'+ncnt+'" id="price'+ncnt+'"></td><td><input type="text" readonly value="'+quantity+'" name="quantity'+ncnt+'" id="quantity'+ncnt+'"></td><td><input type="text" readonly value="'+weight+'" name="weight'+ncnt+'" id="weight'+ncnt+'"></td></tr>');
  		
  		cnt=++cnt;
  	   $("#option_count").val(cnt);
  	   $("#option_counts").val(cnt);
                    }
			    })
			function in_array(search,search1, array)
  {
	  for (i = 0; i < array.length; i++)
	  {
		if(array[i] ==search || array[i] == search1)
		{
			return true;
		}
	  }
	  return false;
  }
  $('#details').hide();
  $('#product').on('change',function(){
      var product = $('#product').val().split('&');
      $('#weights').html('');
      $.ajax({
        url: "get_weights",
        data: {'product_id':product[0]},
        method: 'POST',
        success:function(data){
            var data = JSON.parse(data);
            $("#weights").append("<option>Select</option>");
            for(var i=0;i<data.length;i++){
           $('<option>').html(
        data[i].weight+' '+data[i].unit+' '+data[i].price+"</option>"
        ).appendTo('#weights');
            }
        }
    })
    $('#details').show();
  })
  $('#weights').on('change',function(){
     var price = $('#weights').val().split(' ');
     $('#price').val(price[2]);
  })
</script>