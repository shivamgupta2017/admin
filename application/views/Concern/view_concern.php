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
                </ol>
            </div><br><br>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>     
      						   <th class="hidden">ID</th>
      						   <th>User Name</th>
      						   <!--<th>Email</th>-->
      						   <th>Phone</th>
      						   <th>Order ID</th>
      						   <!--<th>Message</th>-->
      						   <th width="200px;">Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php foreach($data as $customer){ ?>
                        <tr>
                           <td class="hidden"><?php echo $customer->user_id; ?></td>
                           <td class="center"><?php echo $customer->name; ?></td>						   
      						   <!--<td class="center"><?php echo $customer->email; ?></td>						 -->
      						   <td class="center"><?php echo $customer->phone; ?></td>
                           <td class="center"><?php echo $customer->order_id; ?></td>
                           <!--<td class="center"><?php echo $customer->message; ?></td>-->
                           <td class="center">	                         
                              <a class="btn btn-sm bg-olive show-concern" href="javascript:void(0);" data-id="<?php echo $customer->order_id; ?>">
                              <i class="fa fa-fw fa-eye"></i> View </a>
                              <a class="btn btn-sm btn-danger" href="#" onClick="return doconfirm()">
                              <i class="fa fa-fw fa-trash"></i>Delete</a>							
                           </td>
                        </tr>
                              <?php }?>
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

<div class="modal fade modal-wide" id="popup-concern" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">View customer Details</h4>
         </div>
         <div class="modal-concern_body">
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
