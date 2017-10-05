<div class="content-wrapper">
     <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
     href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <h1>
            Settings
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-wrench" aria-hidden="true"></i>Home</a></li>
            <li><a href="#">Settings</a></li>
            <li class="active">Change Settings</li>
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
            <div class="col-md-12 container-fluid">
              <!-- general form elements -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Settings</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <form role="form" action="" method="post" data-parsley-validate="" class="validate" enctype="multipart/form-data">
				 <div class="box-body">
				 <div class="col-md-6">
                        
                                    <div class="form-group">
                                    <label class="intrate">Title</label>
                                    <input class="form-control required regcom" type="text" name="title" data-parsley-trigger="keyup" required="" id="smtp_username" value="<?php echo $result->title; ?>">
                                    </div>
										
									
									                  <div class="form-group">
                                    <label  class="intrate">Country</label>
                                    <input 	class="form-control regcom required" type="text" name="country" data-parsley-trigger="keyup" required="" id="country" value="<?php echo $result->country; ?>" >
                                    </div>  

                                    <div class="form-group">
                                    <label  class="intrate">GSTIN No</label>
                                    <input  class="form-control regcom required" type="text" name="gstin" data-parsley-trigger="keyup" required="" id="gstin" value="<?php echo $result->gstin; ?>" >
                                    </div> 
                                    
                                    <div class="form-group">
                                    <label  class="intrate">Store Address</label>
                                    <input  class="form-control regcom required" type="text" name="store_address" data-parsley-trigger="keyup" required="" id="store_address" value="<?php echo $result->store_address; ?>" >
                                    </div>
                                    
                                     <div class="form-group">
                                    <label  class="intrate">Store Contact No</label>
                                    <input  class="form-control regcom required" type="text" name="store_contact_no" data-parsley-trigger="keyup" required="" id="store_address" value="<?php echo $result->store_contact_no; ?>" >
                                    </div>

                                    <div class="form-group">
                                    <label  class="intrate">Store Pincode</label>
                                    <input  class="form-control regcom required" type="text" name="store_pincode" data-parsley-trigger="keyup" required="" id="store_address" value="<?php echo $result->store_pincode; ?>" >
                                    </div>

                                    <div class="form-group">
                                    <label  class="intrate">TIN</label>
                                    <input  class="form-control regcom required" type="text" name="TIN" data-parsley-trigger="keyup" required="" id="store_address" value="<?php echo $result->TIN; ?>" >
                                    </div>
                                    




                     <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save" id="taxiadd">                      
                     </div>
                  </div>
				  
				        <div class="col-md-6">
						          
						            								          
								    
									
									<!-- <div class="form-group">
                                    <label  class="intrate">Measurements</label>
                                    <input 	class="form-control regcom required" type="text" name="measurements" data-parsley-trigger="keyup" required="" id="measurements" value="<?php echo $result->measurements; ?>" >
                                    </div> -->
									
									<div class="form-group">
                                    <label  class="intrate">Currency</label>
                                    <input 	class="form-control regcom required" type="text" name="currency" data-parsley-trigger="keyup" required="" id="currency" value="<?php echo $result->currency; ?>" >
                                    </div>
									
									
									<div class="form-group">
                                    <label  class="intrate">Currency Symbol</label>
                                    <input 	class="form-control regcom required" type="text" name="currency_symbol" data-parsley-trigger="keyup" required="" id="currency_symbol" value="<?php echo $result->currency_symbol; ?>" >
                                    </div>
									
						           <div class="form-group has-feedback">
    								   <label for="exampleInputEmail1">Logo</label>
    								   <input name="logo" class="" accept="image/*" type="file">
    								   <img src="<?php echo $result->logo; ?>" width="100px" height="100px" alt="Picture Not Found"/>
								       </div>

                       <div class="form-group has-feedback">
                       <label for="exampleInputEmail1">Invoice Logo</label>
                       <input name="invoice_logo" class="" accept="image/*" type="file">
                       <img src="<?php echo $result->invoice_logo; ?>" width="100px" height="100px" alt="Picture Not Found"/>
                       </div>

								   
    								   <div class="form-group has-feedback">
    								   <label for="exampleInputEmail1">Favicon</label>
    								   <input name="favicon" type="file" class="">
    								   <img src="<?php echo $result->favicon; ?>" width="25px" height="25px" alt="Picture Not Found"/>
    								   </div>							 		 
		                   </div>
		                
			<html>
  <head>
   
  </head>
  <body>
   
    <!-- <script type="text/javascript"
     src="<?php /*echo*/ base_url();?>assets/js/bootstrap-datetimepicker.min.js">
    </script> -->

    <!-- <script type="text/javascript">
      $('#datetimepicker').datetimepicker({
        pickDate: false
      });
    </script> -->
  </body>
<html>
             </div><!-- /.box-body -->
  
                </form>
              </div><!-- /.box -->
            </div>
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
