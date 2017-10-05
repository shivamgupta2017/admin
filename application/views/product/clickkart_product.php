<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Add Product Details
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class=""></i>Home</a></li>
         <li><a href="<?php echo base_url(); ?>Home_ctrl/view_product">Product Details</a></li>
         <li class="active">Add Product</li>
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
                  <h3 class="box-title">Product Details</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="" id="my_form" method="post" data-parsley-validate="" enctype="multipart/form-data">

                  <div class="box-body">
                     <div class="col-md-6">
					  
					  <div class="form-group ">
									<label class="control-label" for="shopimage">Select Images (Image Size should be 200x200)</label>
									<input type="file" class="form-control" name="image" size="20" />
                                    </div>
									<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9.,()\  \-\/]+$" required="" name="product_name"  placeholder="Product Name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        
                        <div class="form-group">
                            <label>CGST + SGST</label>
                            <select class="form-control select3" style="width: 100%;" name="tax_type" id="tax_type" >
                              <option value=''>Select Tax type</option>
                              <option value="0%">0%</option>                            
                              <option value="5%">5%</option>                            
                              <option value="12%">12%</option>
                              <option value="18%">18%</option>
                              <option value="28%">28%</option>

                            </select>                
                      </div>
                      
						<div class="form-group">
                          <label>Unit</label>
                          <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                          <option value=''>Select</option>
                   <?php
                  foreach($unit as $units){
                   ?>
                   <option value="<?php echo $units->unit_product_id.'&'.$units->unit;?>"><?php echo $units->unit;?></option>
                      <?php
                   }
                   ?> 
                          </select>
                          </div>  
                           <div class="form-group has-feedback" id="input_quatity">
                             <label for="exampleInputEmail1">Sales Price Per Unit</label>
                              <input type="text" required="" class="form-control" id="sales_price" name="selling_price" placeholder="Enter Price">
                               <label for="exampleInputEmail1">Purchase Price Per Unit</label>
                              <input type="text" required="" class="form-control" id="purchase_price" name="purchase_price" placeholder="Enter Price">
                             <label for="exampleInputEmail1">Weight</label>
                              <input type="text" required="" class="form-control" id="weight" name="weight"  placeholder="Enter Weight">
                               <!-- <label for="exampleInputEmail1">Max Quantity</label>
                              <input type="text" required="" class="form-control" id="max_quantity" name="max_quantity"  placeholder="Enter quantity"> -->
                            </div>
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Details</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"   name="details"  placeholder="Product Description">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
					    <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>             
                        </div>   
                          
				    
                        
            
               </form>
            </div>
			<script>
			$(document).ready(function()
      {
			  

			})
		

</script>
            <!-- /.box -->
         </div>
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>

