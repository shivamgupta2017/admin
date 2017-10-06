<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Add New Purchase Order
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
               <button class="close" data-dismiss="alert" type="button">
                ×
               </button>
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
                          <label>Select Vendor</label>
                          <select class="form-control selectpicker" name="vendor_id" data-live-search="true" style="width: 100%;" id="vendor_id">
                          <option selected="selected" value=''>Select Vendor</option>
                               <?php
                              foreach($vendor as $temp){
                               ?>
                               <option value="<?php echo $temp->vendor_id;?>"><?php echo $temp->vendor_name;?></option>
                                  <?php }?> 
                          </select>
                      </div>
						          <div class="form-group selectpicker">
                          <label>Select Product </label>
                          
                          <select class="form-control select2 selectpicker" data-live-search="true" style="width: 100%;" id="product_id">
                          <option value=''>Select Product</option>
                            <?php
                            foreach($products as $temp)
                            {
                            ?>
                                <option value="<?php echo $temp->product_id.'&'.$temp->product_name;?>"><?php echo $temp->product_name;?></option>
                            <?php
                         }
                         ?> 
                          </select>
                      </div>

						            <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Quantity</label>
                            <input type="text" class="form-control" data-parsley-trigger="change"	
                            data-parsley-minlength="1" id="quantity" placeholder="quantity">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> -->
                        
                         <!-- <div class="form-group has-feedback">
                               <label for="exampleInputEmail1">Cost Price</label>
                                <input type="text" class="form-control " data-parsley-trigger="change"	
                                data-parsley-minlength="1" id="cost_price" placeholder="purchase price">
                                <span class="glyphicon  form-control-feedback"></span>
                          </div> -->

                      <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Selling Price</label>
                            <input type="text" class="form-control" data-parsley-trigger="change"  
                            data-parsley-minlength="1" id="selling_price" placeholder="selling price">
                            <span class="glyphicon  form-control-feedback"></span>
                      </div> -->

                      <div class="box-footer">
                          <button type="button" id="add" class="btn btn-primary" >ADD</button>
                      </div>


    					         
              </div>   
                          <div col-md-6 style="float:right; margin-bottom: 10%; margin-top: 2%;"><a class="btn btn-sm bg-olive show-vendorModel" href="javascript:void(0);" data-id="">
                              <i class="fa fa-fw fa-eye"></i> Add New Vendor </a>
                         </div>

                    <input type="hidden" name="option_count" id="option_count" value="<?php if(isset($item_options) && count($item_options)>0) echo count($item_options)+1; else echo "1";?>">
				            <input type="hidden" name="option_counts" id="option_counts">
                        <div class="col-md-6">
                         
                          <div class="form-group col-sm-6">
                            <label>Select Action</label>
                                
                                <select required="" class="form-control selectpicker" name="purchase_status" data-live-search="false" style="width: 100%;" id="">
                                  <option selected="selected" value=''>Select Action</option>
                                  
                                  <option value='pending'>pending</option>
                                  
                                  <option value='order'>Order</option>

                                </select>
                          </div>


                            <div class="col-sm-6">
                              	<div class="well">
                                  	<h4>Grand Total: <span id="grand_total"></span></h4>
                              		<h5>Payment Method</h5>
                                      <select required="" name="payment_method" class="form-control selectpicker">
                                      	<option value=''>Select payment method</option>
                                          <option value=0>Credit</option>
                                          <option value=1>Cash</option>
                                      </select><br>
                              	</div>
                                <div class="box-footer" style="float:right;">
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                           </div>
                         </div>

                    <table class="table table-bordered" id="first" hidden>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th style="width: auto;">Product Name</th>
                           <th>Quantity</th>
                            <th>Cost price</th>
                            <th>Selling price</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                            </table>
                        <hr>
               </form>
            </div>
			<script>

         var check_array =[];

			$(document).ready(function()
      {

		  $('#vendor').on('change',function()
      
      {

    		var vendor_id =  $('#vendor').val();
    		$('#vendor_id').val(vendor_id);
      });

			  /* var check_array =[];*/
			   var grand_total=0;
			    $('#add').on('click',function()
          {


			        var select = $('#product_id').val().split('&');
              var quantity = 1;//$('#quantity').val();
			        var cost = null;//$('#cost_price').val();
              var selling_price=null;//$('#selling_price').val();
			        total = quantity*cost;
			        grand_total = grand_total +total;
              
              if((select[0] ==''))
              {
			            alertify.error("Missing input");
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


              	   $('#first tr').last().after('<tr id="'+ncnt+'"><td><input style="width:40px; text-align:center" type="text" readonly name="item_id'+ncnt+'" id="item_id'+ncnt+'" value="'+select[0]+'"></td><td><input type="text" readonly value="'+select[1]+'" name="product_name'+ncnt+'" id="product_name'+ncnt+'"><td><input required style="width:70px; text-align:center;" type="number" min=1 value="'+quantity+'" name="quantity'+ncnt+'" id="quantity'+ncnt+'"></td><td><input required min=1 style="width:70px; text-align:center;" type="number" value="'+cost+'" name="cost'+ncnt+'" id="cost'+ncnt+'"></td><td><input required min=1 style="width:70px; text-align:center;"  name="selling_price'+ncnt+'" type="number" value="'+selling_price+'" id="selling_price'+ncnt+'"></td><td><button  style="width:70px; text-align: center;" type="button" class="close" aria-label="Close"><span onclick="delete_row('+ncnt+','+select[0]+')" aria-hidden="true">&times;</span></button></td></tr>');
                          	   cnt=++cnt;

              	   $("#option_count").val(cnt);
              	   $("#option_counts").val(cnt);
                   $('#selling_price').val('');
                   $('#cost_price').val('');
      			       $('#quantity').val('');
                   $('#first').show();



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



        function delete_row(ncnt, product_id)
        {

          for (var i = 0; i < check_array.length; i++) 
          {
            if(check_array[i]==product_id){

              check_array.splice(i, 1);
            }
          }

          
          $("#first tr:eq("+ncnt+")").remove();

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
