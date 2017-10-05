<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Edit User Details
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-asterisk" aria-hidden="true"></i>Home</a></li>
         <li><a href="#">User Details</a></li>
         <li class="active">User Bus</li>
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
                  <h3 class="box-title">Edit User Details</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" action="" method="post" data-parsley-validate="" class="validate" enctype="multipart/form-data">
                  <div class="box-body">                 
                     <div class="col-md-6">								
						
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">username</label>
                            <input type="text" class="form-control required" value="<?php echo $data->username; ?>" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" name="username"  placeholder="username">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
						

						 <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Phone Numebr</label>
                            <input type="phone_number" class="form-control required" data-parsley-trigger="keyup" data-parsley-type="digits" 
							data-parsley-minlength="10" data-parsley-maxlength="15" data-parsley-pattern="^[0-9 \/]+$" required="" value="<?php echo $data->phone_number; ?>"  name="phone_number">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 	

                     <div class="form-group" id="hidden_div">
                    <label>Select Store</label>
                    <select class="form-control select2 required"  style="width: 100%;" id="bus_name" name="store_id">
                   <?php
                    foreach($store_result as $store){
                   ?>
                   <option value="<?php echo $store->id;?>"><?php echo $store->store_name;?></option>
                   <?php
                   }
                   ?>
                    </select>
                    </div>
					
					
					<div class="form-group" id="hidden_div">
                      <label>Role Name</label>
                      <select class="form-control select2 required"  style="width: 100%;" id="role_name" name="user_type">
							   <?php
								foreach($role_result as $rolestore){
							   ?>
                     <option value="<?php echo $rolestore->id;?>"><?php echo $rolestore->role_name;?></option>
							   <?php
							   }
							   ?>
                       </select>
                       </div>
						
                        
						
						
					<!-- 	<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">email</label>
                            <input type="email" class="form-control required"  value="<?php echo $data->email; ?>"  name="email"  placeholder="email">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
                        
						
					   
					   <div class="form-group col-md-4">
					   <label>Display Picture</label>
					   <input name="profile_pic" accept="image/*" type="file" class="">
					   <img src="<?php echo base_url().$data->profile_picture; ?>" width="100px" height="100px" alt="Picture Not Found"/>
					   </div> -->
					   
                  <!-- /.box-body -->
				   </div>
				   <div class="col-md-6">
				   
						
						
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">email</label>
                            <input type="email" class="form-control required" value="<?php echo $data->email; ?>"  name="email"  placeholder="email">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
						
						
						
				
						
						
						
						      <!--<div class="form-group has-feedback">  
							   <label>Display Picture</label>
							   <div class="form-control ">
							   <input name="profile_pic" accept="image/*" class="required" type="file">
							   </div>
							   <div>
							   <img src="<?php //echo  base_url().$this->session->userdata('profile_pic'); ?>" width="100px" height="100px" alt="Picture Not Found"/>
							   </div>
							   </div>-->
							   
							   
						   <div class="form-group col-md-4">
						   <label>Display Picture</label>
						   <input name="profile_picture" accept="image/*" type="file">
						   <img src="<?php echo $data->profile_picture; ?>" width="100px" height="100px" alt="Picture Not Found"/>
						   </div>
						
						
						
	
				   </div>
				   
				  </div>
				  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
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

