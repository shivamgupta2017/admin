<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Add Sales
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class=""></i>Home</a></li>
         <li><a href="<?php echo base_url(); ?>Home_ctrl/">Add New Purchase Order</a></li>
      </ol>
   </section>
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
            <div class="box box-warning">
               <div class="box-header with-border">
                  <h3 class="box-title"></h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="" id="my_form" method="post" data-parsley-validate="" enctype="multipart/form-data">
                <input type="text" id="vendor_id" hidden readonly name="vendor_id">
                  <div class="box-body">
                     <div class="col-md-6">
						


            <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Date</label>
                            <input type="text" readonly class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" required="" name="date" id="date"  value="<?php echo date('Y-m-d');?>">
                           <span class="glyphicon  form-control-feedback"></span>
            </div>
                        
                      
                      
                      <div class="form-group">
                          <label>Select Client</label>
                                <select class="form-control selectpicker" data-live-search="true" style="width: 100%;" id="vendor">
                                  <option value=''>Select Client</option>
                                   <?php
                                      foreach($client as $temp)
                                      {
                                       ?>
                                       <option value="<?php echo $temp->user_id;?>"><?php echo $temp->business_title;?></option>
                                          <?php 
                                       }
                                   ?> 
                                </select>
                      </div> 



            <div class="form-group">
                          <label>Select Product</label>
                          <select class="form-control select2 selectpicker" data-live-search="true" style="width: 100%;" id="product_id">
                          <option value=''>Select product</option>
                   <?php
                  foreach($products as $temp){
                   ?>
                   <option value="<?php echo $temp->product_id.'&'.$temp->product_name.'&'.$temp->tax.'&'.$temp->selling_price ?>"><?php echo $temp->product_name;?></option>
                      <?php
                   }
                   ?> 
                          </select>
                          </div>  
                         <div col-md-6 style="float:right"><a class="btn btn-sm bg-olive show-vendorModel" href="javascript:void(0);" data-id="">
                              <i class="fa fa-fw fa-eye"></i> Add New Vendor </a></div>
                               <br>
						             <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Quantity</label>
                            <input type="text" class="form-control" data-parsley-trigger="change"	
                            data-parsley-minlength="1"  id="quantity" placeholder="Quantity">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> -->
                        
                        <div class="box-footer">
                            <button type="button" id="add" class="btn btn-primary" >ADD</button>
                      </div>    
					                      
                        </div>   
                    <input type="hidden" name="option_count" id="option_count" value="<?php if(isset($item_options) && count($item_options)>0) echo count($item_options)+1; else echo "1";?>">
				    <input type="hidden" name="option_counts" id="option_counts">
                        <div class="col-md-6">
                            <div class="col-sm-6">
                              	<div class="well">
                                  	<h4>Grand Total: <span id="grand_total"></span></h4>
                              		  <h5>Payment Method</h5>
                                      <select required name="payment_method" class="form-control">
                                      	<option value=''>Select payment method</option>
                                          <option value=0>Credit</option>
                                          <option value=1>Cash</option>
                                      </select><br>
                              	</div>
                            </div>

                       </div>
                       <div class="box-footer" style="float:right">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                    <table class="table table-bordered" id="first">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Product Name</th>
                           <th>Quantity</th>
                            <th>Selling Price</th>
                             <th>Tax</th>
                              <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                          </tbody>
                            </table>
                        
                        <hr>
               </form>
            </div>
			<script>
			$(document).ready(function()
      {


    		  $('#vendor').on('change',function()
          {
        		var vendor_id =  $('#vendor').val();
   
//            alert('client id :'+vendor_id);
        		$('#vendor_id').val(vendor_id);
    		  


         });
			  var check_array =[];
			  var grand_total=0;
			    
          $('#add').on('click',function()
          {
			        var select = $('#product_id').val().split('&');
             // alert('select :'+select);
              var quantity = 1;//$('#quantity').val();
              var cost = select[3]; 
              total = quantity*cost;
              grand_total = grand_total +total;
			        if((select[0] =='')||(quantity=='')||(quantity<1))
              {
			            alertify.error("Please Select Valid Option");
			        }
			        else if(in_array(select[0],check_array))
              {
  	              alertify.error("Already Exist");
              }
              else
              {
                     check_array.push(select[0]);
			               var cnt=$("#option_count").val();
              	     var ncnt = cnt;
              	     var sno = cnt;
              	     $('#grand_total').html('');
  		               $('#grand_total').append(grand_total);
                	   $('#first tr').last().after('<tr><td><input style="width:40px;text-align:center" type="text" readonly name="item_id'+ncnt+'" id="item_id'+ncnt+'" value="'+select[0]+'"></td><td><input type="text" style="width:100px;" readonly value="'+select[1]+'" name="product_name'+ncnt+'" id="product_name'+ncnt+'"><td><input style="width:50px; text-align:center;" type="number" min=1 required value="'+quantity+'" onchange="change_total('+ncnt+')" name="quantity'+ncnt+'" id="quantity'+ncnt+'"></td><td><input style="width:70px; text-align:center;" onchange="change_total('+ncnt+')" required type="text" value="'+cost+'" name="cost'+ncnt+'" id="cost'+ncnt+'"></td><td><input style="width:70px;  text-align:center;" readonly="" type="text" value="'+select[2]+'%" name="tax'+ncnt+'" id="tax'+ncnt+'"></td><td><input style="width: 70px; text-align:center;" type="text" readonly="" value="'+total+'" id="total'+ncnt+'"></td></tr>');
                            	   cnt=++cnt;
                     $("#option_count").val(cnt);
                     $("#option_counts").val(cnt);
              			 $('#product_id').val('');
              			 $('#cost').val('');
              			 $('#quantity').val('');
              }
			    })
			    function in_array(search, array)
          {
        	  for (i = 0; i < array.length; i++)
        	  {
        		if(array[i] ==search )
        		{
        			return true;
        		}
        	  }
        	  return false;
          }
			})
		


    function change_total(line_no)
    {
      
      var x =document.getElementById("quantity"+line_no).value;
      var y =document.getElementById("cost"+line_no).value;
      var temp= document.getElementById("total"+line_no).value;
      document.getElementById("total"+line_no).value=x*y;
      
      var gt=grand_total.innerHTML-temp+(x*y);
      $('#grand_total').html('');
      $('#grand_total').append(gt);

    }
</script>
            <!-- /.box -->
         </div>
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>
<div class="modal fade modal-wide" id="popup-addvendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Vendor</h4>
         </div>
         <div class="modal-vendorBody">
         </div>
         <div class="business_info">
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
