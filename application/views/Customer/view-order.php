	<?php
   $currency = getSettings()->currency;
   ?>
   <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        View Order Details
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-shopping-cart"></i>Home</a></li>
         <li><a href="#">Order Details</a></li>
         <li class="active">View Order Details</li>
      </ol>
   </section>
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
                  <h3 class="box-title">View Order Details</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                           <th>User Name</th>												  
						   <th>Order ID</th>
						   <th>Delivery Date</th>
						   <th>Delivery Time</th>
						   <th>Address</th>
						   <th>Phone</th>
						   <th>Status</th>
						   <th width="200px;">Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $order) {	
						  // $image=$customer->image;
						  
                           ?>
                        <tr>
                           <td class="center"><?php echo ucwords($order->cust_name); ?></td>						   					 
						  <td class="center"><?php echo $order->id;?></td>
                          <td class="center"><?php echo $order->delivery_date;?></td>
                          <td class="center"><?php echo $order->delivery_time;?></td>
                          <td class="center"><?php echo $order->address;?></td>
                          <td class="center"><?php echo $order->phone;?></td>
                          <td class="center"><?php echo $order->status;?></td>
                           <td class="center">	                         
                           	<a class="btn btn-sm bg-olive show-ordergetdetails" href="javascript:void(0);" data-id="<?php echo $order->id; ?>">
                              <i class="fa fa-fw fa-eye"></i> View </a>	      
                               	<a class="btn btn-sm bg-olive" href="invoice/<?php echo $order->id;?>" >
                              <i class="fa fa-external-link"></i> Invoice </a>	                              
                              <!-- <a class="btn btn-sm btn-danger" href="<?php echo site_url('Customer_ctrl/delete_order/'.$order->id); ?>" onClick="return doconfirm()">
                              <i class="fa fa-fw fa-trash"></i>Delete</a>	 -->						
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
                     <th>Delivery Date</th>
                     <th>Delivery Time</th>
                     <th>Address</th>
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

<div class="modal fade modal-wide" id="popup-ordergetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">View Order Information</h4>
         </div>
         <div class="modal-orderbody">
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
