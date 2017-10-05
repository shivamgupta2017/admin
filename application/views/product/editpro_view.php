<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Edit Product Details
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-fw fa-barcode"></i>Home</a></li>
         <li><a href="#">Product Details</a></li>
         <li class="active">Edit Product</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- left column -->
         <div class="col-md-12">
            <?php
               if($this->session->flashdata('message')) 
               {
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
                  <h3 class="box-title">Edit Product Details</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="" method="post" class="validate" enctype="multipart/form-data">

                  <div class="box-body">
                     <div class="col-md-6">
					 <img src="<?php echo base_url()."assets/uploads/product/".$data[0]->product_image ?>" width="200px"></a>
					  <div class="form-group ">
									<label class="control-label" for="shopimage">Select Images</label>
									<input type="file"  name="image" size="20" />
                                    </div>
									<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" name="product_name"  value="<?php echo $data[0]->product_name; ?>">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                       
					  	<!-- <div class="form-group">
                          <label>CGST + SGST</label>
                           <input type="text" class="form-control" id="total_tax" name="total_tax" value="<?php //echo $data[0]->tax;?>">
                      </div> -->

                       <!--  <label for="exampleInputEmail1">Selected cgst</label>
                        <input type="text" readonly class="form-control" id="rate"  value="<?php //echo $data[0]->tax;?>%"> -->



                       <div class="form-group">
                            <label>CGST + SGST</label>
                                <select class="form-control select3" style="width: 100%;" name="total_tax" id="total_tax" >
                                  <option value=''>Select Tax type</option>
                                    <option selected="selected" value="5%">5%</option>                            
                                    <option value="10%">10%</option>                            
                                    <option value="15%">15%</option>
                                </select>                
                        </div>

                         
                        <!-- <label for="exampleInputEmail1">Selected Unit</label>
                        <input type="hidden" readonly class="form-control" id="unit" name="unit" value="$data[0]->unit_id.'&'.$data[0]->unit_name;?>"> 

                        <?php //echo $data[0]->unit_name ?> -->



				            	   <div class="form-group">
                          <label>Unit</label>
                          <select class="form-control select2 required" name= "unit" style="width: 100%;" id="unit">
                          <option value=''>Select unit type</option>
                          <option selected="selected" value="<?php echo $data[0]->unit_id.'&'.$data[0]->unit_name;?>">
                             <?php echo $data[0]->unit_name;  ?>
                             <?php
                          foreach($unit as $units)
                          {

                            if($units->unit_product_id!=$data[0]->unit_id)
                            {
                           ?>

                                 <option value="<?php echo $units->unit_product_id.'&'.$units->unit;?>">
                                    <?php echo $units->unit;?>
                                 </option>

                              <?php
                            }
                           }
                           ?> 
                          </select>
                          </div>  
                         



                           <div class="form-group has-feedback" id="input_quatity">
                            <label for="exampleInputEmail1">Purchase price</label>
                            <input type="text" class="form-control" name="purchase_price" id="selling_price" value="<?php echo $data[0]->purchase_price;?>" placeholder="Enter purchase Price">
                           <label for="exampleInputEmail1">Selling Price Per Unit</label>
                            <input type="text" class="form-control" name="selling_price" id="selling_price" value="<?php echo $data[0]->selling_price;?>" placeholder="Enter selling Price">
                           <label for="exampleInputEmail1">Weight</label>
                            <input type="text" class="form-control" name="weight" id="weight" value="<?php echo $data[0]->weight ?>" placeholder="Enter Weight">
                             <label for="exampleInputEmail1">Max Quantity</label>
                            <input type="text" class="form-control" name="max_limit" id="max_quantity" value="<?php echo $data[0]->max_limit ?>" placeholder="Enter quantity">
                        </div>    
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Details</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required="" name="product_description"  value="<?php echo $data[0]->product_description; ?>">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
					    <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>             
                        </div>                   
            
            <!-- <input type="hidden" name="option_count" id="option_count" value="<?php if(isset($item_options) && count($item_options)>0) echo count($item_options)//+1; else echo "1";?>">
				    <input type="hidden" name="option_counts" id="option_counts"> -->
               </form>
            </div>
			<script>

			
      
</script>
            <!-- /.box -->
         </div>
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>

