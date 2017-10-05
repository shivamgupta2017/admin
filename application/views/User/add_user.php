<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Add user Details
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>Home</a></li>
         <li><a href="#">user Details</a></li>
         <li class="active">Add user</li>
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
                  <h3 class="box-title">Add user Details</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="" method="post"  data-parsley-validate="" class="validate" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="col-md-6">
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">username</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" 
							name="username"  placeholder="username">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
						
						<!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">First Name</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" name="first_name"  placeholder="First Name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>  -->
					

                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Phone Numebr</label>
                            <input type="phone_number" class="form-control required" data-parsley-trigger="keyup" data-parsley-type="digits" 
							data-parsley-minlength="10" data-parsley-maxlength="15" data-parsley-pattern="^[0-9 \/]+$" required=""  name="phone_number"  placeholder="phone_number">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 						
                        
						
					
					  <!--  <div class="form-group col-md-4">
                       <label>Display Picture</label>
                       <input name="profile_pic" type="file" accept="image/*" class="required">
                       </div> -->
					   
			
							<div class="form-group">
                        <label>Select Store</label>
					<select class="form-control select2 js-example-basic-multiple" style="width: 100%;" name="store_id" id="store_name">
								   <?php
									  $arry_select = explode(",", $data->store_id);
									  foreach($store_result as $store){
								   ?>
			            <option value="<?php echo $store->id;?>"<?php if (in_array($store->id, $arry_select))
					    echo 'selected';  ?> ><?php echo $store->store_name;?></option>			  
								   <?php
								   }
								   ?>
                            </select>
                        </div>	
				
						
						
					  <div class="form-group" id="hidden_div">
                      <label>Role Name</label>
                      <select class="form-control select2 js-example-basic-multiple"  style="width: 100%;" id="role_name" name="user_role" required>
							   <?php
								foreach($role_result as $rolestore){
							   ?>
                     <option value="<?php echo $rolestore->id;?>"><?php echo $rolestore->role_name;?></option>
							   <?php
							   }
							   ?>
                       </select>
                       </div>
					   
					   
					   
					           
                </div> 
				
				
				<div class="col-md-6">
				
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Password</label>
                            <input type="text" class="form-control required"  data-parsley-trigger="change"	
                            data-parsley-minlength="6" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required="" name="password"  placeholder="Password">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
						
						
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">email</label>
                            <input type="email" class="form-control required"  name="email"  placeholder="email">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 
						
						<div class="form-group col-md-4">
                       <label>Display Picture</label>
                       <input name="profile_pic" type="file" accept="image/*" class="required">
                       </div>
					   
					   		
						
						
						
						<!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" name="last_name"  placeholder="Last Name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>  -->

                        <!-- <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Address</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" name="address"  placeholder="Address">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div> 		 -->				
						 

					<!-- 	<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Phone Number</label>
                            <input type="text" class="form-control required" data-parsley-trigger="keyup" data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="15" data-parsley-pattern="^[0-9 \/]+$" required=""  name="phone_number"  placeholder="Phone Number">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
 -->


						
						
						
	
						
					             
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

