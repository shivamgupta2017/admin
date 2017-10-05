<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Create Customer
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class=""></i>Home</a></li>
         <li class="active"> Create Customer</li>
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
                  <h3 class="box-title"> Create Customer</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
                <form role="form" action="" method="post" data-parsley-validate="" enctype="multipart/form-data">

                  <div class="box-body">
                     <div class="col-md-6">
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Full Name </label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" name="client_name"  placeholder="Client Full Name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Business Title</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" name="business_title"  placeholder="Business Title">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Mobile</label>
                            <input type="tel" class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="10" data-parsley-maxlength="10" required="" name="mobile_no" placeholder="Mobile No">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div><div class="form-group has-feedback">

                           <label for="exampleInputEmail1">Phone</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change" data-parsley-pattern="^[0-9\  \/]+$"
                            data-parsley-minlength="10" data-parsley-maxlength="10" required="" name="phone"  placeholder="Phone">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Address</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"
                            data-parsley-minlength="10" required="" name="address"  placeholder="Address">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Email</label>
                            <input class="form-control required" data-parsley-type="email" data-parsley-email-message="must be a valid email address" data-parsley-trigger="change"  
                            data-parsley-minlength="2" required="" id="email" name="email"  placeholder="Email">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">City</label>
                            <input class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" id="city" name="city"  placeholder="City">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>

                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">State</label>
                            <input class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" id="state" name="state"  placeholder="State">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Zipcode</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"  data-parsley-pattern="^[0-9\  \/]+$"
                            data-parsley-minlength="6" data-parsley-maxlength="10"   required="" id="zipcode" name="zipcode"  placeholder="Zipcode">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">GSTIN No</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"  data-parsley-pattern="^[0-9\  \/]+$"
                            data-parsley-minlength="6" data-parsley-maxlength="15"   required="" id="gstin" name="GSTIN_NO"  placeholder="GSTIN No">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>


                        

                        <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" id="password" name="password"  placeholder="Password">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> -->

                        <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Password confirm</label>
                            <input type="password" class="form-control required" data-parsley-trigger="change"  
                            data-parsley-equalto="#password"
                            data-parsley-minlength="2"  required="" name="password_confirm"  placeholder="Password confirm">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> -->

                        <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Is Shipping Address Same as Billing Address</label>
                           <input type="checkbox" id="check_box" name="check_box">
                        </div> -->
<!-- 
                          <div id="shipping_address" name="shipping_address"> -->
                          <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Shipping Address</label>
                            <input type="text" class="form-control" data-parsley-trigger="change" 
                            data-parsley-minlength="2"  name="shipping_address_1"  placeholder="Shipping Address">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
 -->                        <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Shipping Address2</label>
                            <input type="text" class="form-control" data-parsley-trigger="change" 
                            data-parsley-minlength="2"   name="shipping_address_2"  placeholder="Shipping Aparment">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> -->

                        <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Shipping Zipcode</label>
                            <input type="text" class="form-control" data-parsley-trigger="change" data-parsley-pattern="^[0-9\  \/]+$" 
                            d
                            data-parsley-minlength="2"   name="shipping_zip"  placeholder="Shipping Zipcode">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> -->

                        <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Shipping Phone</label>
                            <input type="text" class="form-control" data-parsley-trigger="change" data-parsley-pattern="^[0-9\  \/]+$" 
                            
                            data-parsley-maxlength="10" data-parsley-minlength="10" name="shipping_phone"  placeholder="Shipping Phone">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> -->

                      <!-- </div> -->
                        <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>             
                        </div>   
                         
            
               </form>
            </div>
            <!-- /.box -->
         </div>
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>

<!-- <script>
    $(document).ready(function()
    {
         $('#check_box').change(function(){
    if( $(this).is(':checked') ) {$('#shipping_address').hide();}else{$('#shipping_address').show();}
});
    })
   

    
    
</script> -->