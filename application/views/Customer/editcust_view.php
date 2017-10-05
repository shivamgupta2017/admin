<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Edit Customer
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class=""></i>Home</a></li>
         <li class="active"> Edit Customer</li>
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
                  <h3 class="box-title"> Edit Customer</h3>
                  <div col-md-6 style="float:right"><a class="btn btn-sm bg-olive show-customerShip" href="javascript:void(0);" data-id="<?php echo $this->uri->segment(3);?>">
                              <i class="fa fa-fw fa-eye"></i> Add New Shipping Address </a></div>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
                <form role="form" action="" method="post" data-parsley-validate="" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="col-md-6">
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">First Name </label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" name="first_name" value="<?php echo $data[0]->first_name;?>" placeholder="First Name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Last Name </label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" name="last_name" value="<?php echo $data[0]->last_name;?>" placeholder="Last Name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Company</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" name="company" value="<?php echo $data[0]->company;?>" placeholder="Company">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div><div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change" value="<?php echo $data[0]->email;?>" data-parsley-type="email"
                            data-parsley-minlength="2"  required="" name="email"  placeholder="Email">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Phone</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change" data-parsley-pattern="^[0-9\  \/]+$"
                            data-parsley-minlength="10" data-parsley-maxlength="10" value="<?php echo $data[0]->phone;?>" required="" name="phone"  placeholder="Phone">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Address</label>
                            <textarea class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" id="address" name="address" ><?php echo $data[0]->address;?></textarea>
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Address2</label>
                            <textarea class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" id="address2" name="address2" ><?php echo $data[0]->address2;?></textarea>
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">GSTIN NO</label>
                            <input class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2"  required="" id="GSTIN_NO" name="GSTIN_NO" value="<?php echo $data[0]->GSTIN_NO;?>" placeholder="GSTIN NO">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Zipcode</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change" value="<?php echo $data[0]->zipcode;?>" data-parsley-pattern="^[0-9\  \/]+$"
                            data-parsley-minlength="2"  required="" id="zipcode" name="zipcode"  placeholder="Zipcode">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" data-parsley-trigger="change"  
                            data-parsley-minlength="2" id="password" name="password"  placeholder="Password">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Password confirm</label>
                            <input type="password" class="form-control" data-parsley-trigger="change"  
                            data-parsley-equalto="#password"
                            data-parsley-minlength="2" name="password_confirm"  placeholder="Password confirm">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                      <!--    <div id="shipping_address" name="shipping_address">-->
                      <!--  <div class="form-group has-feedback">-->
                      <!--     <label for="exampleInputEmail1">Shipping Address</label>-->
                      <!--      <input type="text" class="form-control" data-parsley-trigger="change" -->
                      <!--      data-parsley-minlength="2"  name="shipping_address_1" value="<?php echo $shipping_address[0]->shipping_address_1;?>" placeholder="Shipping Address">-->
                      <!--     <span class="glyphicon  form-control-feedback"></span>-->
                      <!--  </div>-->
                      <!--  <div class="form-group has-feedback">-->
                      <!--     <label for="exampleInputEmail1">Shipping Address2</label>-->
                      <!--      <input type="text" class="form-control" data-parsley-trigger="change" -->
                      <!--      data-parsley-minlength="2"   name="shipping_address_2" value="<?php echo $shipping_address[0]->shipping_address_2;?>" placeholder="Shipping Aparment">-->
                      <!--     <span class="glyphicon  form-control-feedback"></span>-->
                      <!--  </div>-->
                      <!--  <div class="form-group has-feedback">-->
                      <!--     <label for="exampleInputEmail1">Shipping Zipcode</label>-->
                      <!--      <input type="text" class="form-control" data-parsley-trigger="change" data-parsley-pattern="^[0-9\  \/]+$" -->
                      <!--      d-->
                      <!--      data-parsley-maxlength="6"  value="<?php echo $shipping_address[0]->shipping_zip;?>" name="shipping_zip"  placeholder="Shipping Zipcode">-->
                      <!--     <span class="glyphicon  form-control-feedback"></span>-->
                      <!--  </div>-->
                      <!--  <div class="form-group has-feedback">-->
                      <!--     <label for="exampleInputEmail1">Shipping Phone</label>-->
                      <!--      <input type="text" class="form-control" data-parsley-trigger="change" data-parsley-pattern="^[0-9\  \/]+$" -->
                      <!--      value="<?php echo $shipping_address[0]->shipping_phone;?>"-->
                      <!--      data-parsley-maxlength="10" data-parsley-minlength="10" name="shipping_phone"  placeholder="Shipping Phone">-->
                      <!--     <span class="glyphicon  form-control-feedback"></span>-->
                      <!--  </div>-->
                      <!--</div>-->
                        <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>             
                        </div>  
                         <div class="col-md-6">
                          <table class="table table-bordered" id="first">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Shipping Add1</th>
                           <th>Shipping Add2</th>
                            <th>Shipping Zip</th>
                            <th>Shipping Phone</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i=1;foreach($shipping_address as $temp){?>
                          <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $temp->shipping_address_1;?></td>
                              <td><?php echo $temp->shipping_address_2;?></td>
                              <td><?php echo $temp->shipping_zip;?></td>
                              <td><?php echo $temp->shipping_phone;?></td>
                          </tr>
                          <?php ++$i;}?>
                          </tbody>
                            </table>
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

<div class="modal fade modal-wide" id="popup-customership" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">View customer Details</h4>
         </div>
         <div class="modal-customershipbody">
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
<script>
    $(document).ready(function(){
         $('#check_box').change(function(){
    if( $(this).is(':checked') ) {$('#shipping_address').hide();}else{$('#shipping_address').show();}
});
    })
   

    
</script>