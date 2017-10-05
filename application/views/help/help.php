<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Add Help
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-arrows-alt"></i>Home</a></li>
         <li><a href="<?php echo base_url(); ?>Help_ctrl/view_help">Help Details</a></li>
         <li class="active">Add Help</li>
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
                  <h3 class="box-title">Add Help Details</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="" method="post" data-parsley-validate="" class="validate" enctype="multipart/form-data">

                  <div class="box-body">
                     <div class="col-md-6">
                         <div class="form-group">
                          <label>Select Type</label>
                     <select class="form-control select2 required"  style="width: 100%;" id="test" name="department" onchange="showDiv(this)">
                          
                           <option value="">Select</option>
                           <option value="product">Product</option>
                           <option value="sales">Sales</option>
                           <option value="delivery">Delivery</option>
                           <option value="user">User</option>
                           
                            </select>
                     </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Question</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required="" name="question"  placeholder="Question">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Answer</label>
                            <textarea class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required="" name="answer"  placeholder="Answer"></textarea>
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

