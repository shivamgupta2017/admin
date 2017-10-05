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
                    <li class="active">View Order Details</li>
                    <!--<a href="<?php echo base_url(); ?>Product_ctrl/add_products" style="float:right;color:white;"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>-->
                </ol>
                </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="send_notification" method="post"  data-parsley-validate="" class="validate" enctype="multipart/form-data">
			   
                  <div class="box-body">
                  <div class="col-md-12">
                     <div class="col-md-6">
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-pattern="^[a-zA-Z0-9,.\  \/]+$" required="" name="title"  placeholder="Type Title">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>         
						 <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Message</label>
                            <textarea type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-pattern="^[a-zA-Z0-9,.\  \/]+$" required="" name="message"  placeholder="Type Message"></textarea>
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Select Large Icon(512x256 min) (1024x512 max)</label>
                            <input type="file" class="form-control" id ='large_icon' name="large_icon">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Select Big_icon(512x256 min) (1024x512 max)</label>
                            <input type="file" class="form-control" id ='big_icon' name="big_icon">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
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
<script>

</script>