	<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
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
         <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
               <div class="box-header">
                  <ol class="breadcrumb">
                    <li><a href="#"><i></i>Home</a></li>
                    <li><a href="#">customer Details</a></li>
                    <li class="active">View customer Details</li>
                    <a href="<?php echo base_url(); ?>Customer_ctrl/create_customer" style="float:right;color:white;"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>
                </ol>
            </div><br><br>
               <!-- /.box-header -->
               

               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                         
						   <th class="hidden">ID</th>
                     <th>Client Name</th>						
						   <th>Business Title</th>
						   <th>Address</th>
						   <th>Phone</th>
						   <th>Email</th>
						   <th>GSTIN NO</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $customer) 
                           {	
						                  // $image=$customer->image;
						  
                           ?>
                        <tr>
                     <td class="hidden"><?php echo $customer->user_id; ?></td>
                     <td class="center"><?php echo $customer->client_name; ?></td>						   
						   <td class="center"><?php echo $customer->business_title; ?></td>						 
						   <td class="center"><?php echo ($customer->address.' ,'.$customer->city.' ,'.$customer->zipcode);?></td>
                     <td class="center"><?php echo $customer->phone; ?></td>
						   <td class="center"><?php echo $customer->email; ?></td> 
                     <td class="center"><?php echo $customer->GSTIN_NO; ?></td> 
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
						<th class="hidden">ID</th>
                           <th>First Name</th>						
						   <th>Last Name</th>
						   <th>Email</th>
						   <th>Phone</th>
						    <th>Status</th>
						 
						   
						   <th width="200px;">Action</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>

<div class="modal fade modal-wide" id="popup-customergetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">View customer Details</h4>
         </div>
         <div class="modal-customerbody">
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
