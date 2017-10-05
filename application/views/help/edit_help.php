<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Edit Help
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-arrows-alt"></i>Home</a></li>
         <li><a href="#">Help Details</a></li>
         <li class="active">Edit Help</li>
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
                  <h3 class="box-title">Edit Help Details</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="" method="post"  data-parsley-validate="" class="validate" enctype="multipart/form-data">

                  <div class="box-body">
                     <div class="col-md-6">
                        <div class="form-group">
                        <label>Department</label><br>
                      <select class="form-control select2 required"  style="width: 100%;" id="test" name="department" onchange="showDiv(this)">
                            <option value="product"<?php if ($data->department=="product") {echo "selected"; }?>>Products</option>
                             <option value="sales" <?php if ($data->department=="sales") {echo "selected"; }?>>Sales</option>
                             <option value="delivary" <?php if ($data->department=="delivary") {echo "selected"; }?>>Delivary</option>
                             <option value="user" <?php if ($data->department=="user") {echo "selected"; }?>>User</option>
                            
                        </select>    
                    </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Question</label>
                            <textarea class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required="" name="question"> <?php echo $data->question; ?></textarea>
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>   

                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Question</label>
                            <textarea class="form-control required" data-parsley-trigger="change"  
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required="" name="answer"> <?php echo $data->answer; ?></textarea>
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

