<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Add Category Details
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i>Home</a></li>
         <li><a href="<?php echo base_url(); ?>Home_ctrl/view_category">Category Details</a></li>
         <li class="active">Add Categorys</li>
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
                  <h3 class="box-title">Add Category Details</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="" method="post"  data-parsley-validate="" class="validate" enctype="multipart/form-data">

                  <div class="box-body">
                     <div class="col-md-6">
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Category Name</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" name="category_name"  placeholder="Category Name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>         
						
					 
				
					
						
						  <div class="form-group ">
									<label class="control-label" for="shopimage">Select Images</label>
									<input type="file"  name="image" size="20" />
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

