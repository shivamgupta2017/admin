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
                   <br>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                           <th>User Name</th>												  
						   <th>Order ID</th>
						   <th>Phone</th>
						   <th >Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $order) {	
                           ?>
                        <tr>
                           <td class="center"><?php echo ucwords($order->first_name).ucwords($order->last_name); ?></td>						   					 
						  <td class="center"><?php echo $order->id;?></td>
                          <td class="center"><?php echo $order->phone;?></td>
                          <td class="center">	                         
                           	<a class="btn btn-sm bg-olive show-verifyorder" href="javascript:void(0);" data-id="<?php echo $order->id; ?>">
                              <i class="fa fa-fw fa-eye"></i> View </a>	
                           </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
					 <th>User Name</th>                                     
                     <th>Order ID</th>
                     <th>Phone</th>
                     <th>Action</th>
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

<div class="modal fade modal-wide" id="popup-verifyModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">View Order Verification</h4>
         </div>
         <div class="modal-verifyBody">
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
