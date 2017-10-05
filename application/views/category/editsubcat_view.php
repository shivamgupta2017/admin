<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Edit SubCategory Details
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-bars"></i>Home</a></li>
         <li><a href="#">SubCategory Details</a></li>
         <li class="active">Edit SubCategory</li>
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
                  <h3 class="box-title">Edit SubCategory Details</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
			    <form role="form" action="" method="post"  data-parsley-validate="" class="validate" enctype="multipart/form-data">

                  <div class="box-body">
                     <div class="col-md-6">
					                <img src="<?php echo base_url().$data->image ?>" width="200px"></a>
					                <div class="form-group ">
									<label class="control-label" for="shopimage">Select Images</label>
									<input type="file"  name="image" size="20" />
                                    </div>
									
									<div class="form-group has-feedback">
									   <label for="exampleInputEmail1">SubCategory Name</label>
										<input type="text" class="form-control required" data-parsley-trigger="change"	
										data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" name="sub_cat_name"  value="<?php echo $data->sub_cat_name; ?>">
									   <span class="glyphicon  form-control-feedback"></span>
									</div>         
						
									<div class="form-group">
										  <label>Select Category</label>
											<select class="form-control select2 required"  style="width: 100%;" id="bus_name" name="category_id">
												   <?php
												   if($result) {
													  foreach($result as $categorydetails){
														  $s = ($categorydetails->id == $data->category_id) ? "selected" : "";
														
												   ?>
							        <option <?php echo $s; ?> value="<?php echo $categorydetails->id;?>"><?php echo $categorydetails->category_name; ?></option>
												   <?php
												   }
												   }
												   ?>
											</select>
								    </div>
				
								<div class="form-group">
									<label>Select Type</label><br>
									<select class="form-control select2 required"  style="width: 100%;" id="test" name="type" onchange="showDiv(this)">
										 <option value="parent"<?php if ($data->type=="parent") {echo "selected"; }?>>Parent</option>
										 <option value="child" <?php if ($data->type=="child") {echo "selected"; }?>>Child</option>
									</select>    
                                </div>
								
							<div class="form-group" id="hidden_div" style="display:none;">
                            <label>Select Sub Category</label>
							<select class="form-control select2 required"  style="width: 100%;" id="bus_name" name="parent_id">
								   <?php  if($sub_catresult) {
									  foreach($sub_catresult as $sub_catdetails){
									 $ss = ($sub_catdetails->id == '$data->parent_id') ? "selected" : "";	  
								   ?>
								   <option <?php echo $ss; ?> value="<?php echo $sub_catdetails->id;?>"><?php echo $sub_catdetails->sub_cat_name;?></option>
								   <?php
								   }
								   }
								   ?>
                            </select>
                            </div>
					
<script type="text/javascript">
function showDiv(select){
   if(select.value=='child'){
    document.getElementById('hidden_div').style.display = "block";
   } else{
    document.getElementById('hidden_div').style.display = "none";
   }
} 
</script>
					

						
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

