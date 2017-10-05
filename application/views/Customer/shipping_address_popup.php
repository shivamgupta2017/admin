		<div class="row">
            <div class="col-md-6">
              <div class="box box-primary">
				<div class="box-header with-border">
         <h3 class="box-title">Add Shipping Address</h3>
         <div class="box-tools pull-right">
             
            <button class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
            <i class="fa fa-minus"></i>
            </button>
         </div>
      </div>
                <div class="box-body">
                    <form role="form" action=<?php echo base_url()."Customer_ctrl/add_shipping_address"?> method="post" data-parsley-validate="" enctype="multipart/form-data">
                    <input type="text" name="user_id" hidden readonly value="<?php echo $customer_details;?>">
                    <label for="exampleInputEmail1">Shipping Address 1</label>
                    <input type="text" class="form-control required" name="shipping_address_1">
                      <label for="exampleInputEmail1">Shipping Address 2</label>
                    <input type="text" class="form-control required" required="" name="shipping_address_2">
                      <label for="exampleInputEmail1">Shipping Zip</label>
                    <input type="text" class="form-control required" data-parsley-pattern="^[0-9\  \/]+$" data-parsley-maxlength="6" name="shipping_zip">
                      <label for="exampleInputEmail1">Shipping Phone</label>
                    <input type="text" class="form-control required" data-parsley-maxlength="10" data-parsley-minlength="10" name="shipping_phone">
                  <!--<dl>                             -->
                    <!--<dt>First Name</dt>-->
                    <!--<dd><?php echo $data->first_name; ?></dd>-->
                    <!--<dt>Last Name</dt>-->
                    <!--<dd><?php echo $data->last_name; ?></dd>                 -->
                     <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>    
                  <!--</dl>-->
                  </form>
                </div>
                <!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- ./col -->
            
        
          </div>  
			
		
		 
		  