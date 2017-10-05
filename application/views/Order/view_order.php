	<?php
   $currency = getSettings()->currency;
   ?>
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
                    <li><a href="#"><i aria-hidden="true"></i>Home</a></li>
                    <li class="active">View Order Details</li>
                    <!--<a href="<?php echo base_url(); ?>Product_ctrl/add_products" style="float:right;color:white;"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>-->
                </ol>
                </div><br>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                     <th>User Name</th>												  
						   <th>Order ID</th>
						   <th>Address</th>
						   <th>Status</th>
						   <th>Order Type</th>
						   <th>Delivery Date</th>
						   <th >Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $order) {	
						  // $image=$customer->image;
                           ?>
                        <tr>
                           <td class="center"><?php echo ucfirst($order->first_name).' '.ucfirst($order->last_name); ?></td>						   					 
						         <td class="center"><?php echo $order->id;?></td>
                           <td class="center"><?php echo $order->address;?></td>
                          <td class="center"><?php echo $order->order_status;?></td>
                          <td class="center"><?php if($order->is_express){echo "Express";}else{echo "Normal";}?></td>
                          <td class="center"><?php echo $order->delivery_date;?></td>
                        <!--   <td class="center"><?php echo $order->address;?></td>
                          <td class="center"><?php echo $order->phone;?></td>
                          <td class="center"><?php echo $order->status;?></td> -->
                           <td class="center">	                         
                           	<a class="btn btn-sm bg-red show-ordergetdetails" href="javascript:void(0);" data-id="<?php echo $order->id; ?>">
                              <i class="fa fa-fw fa-eye"></i> View </a>	      
                           <?php if(!empty($order->link)){ ?><a style="margin-left: 10px;" target="_blank" class="btn btn-sm bg-black" href="<?php echo $order->link;?>"</a>
                              <i class="fa fa-external-link"></i> <?php if($order->status == 3){echo "Invoice";}else{echo "Challan";}?> </a><?php }?>	
                             <?php 
                           if($order->status ==0){echo "<a style='margin-left: 10px;' class='btn btn-sm bg-red' href='".site_url('Order_ctrl/update_order/'.$order->id.'/'.$order->status)."'>Set Out For Delivery</a>";}
                           else if($order->status ==1 || $order->status ==2){echo "<a style='margin-left: 10px;' class='btn btn-sm bg-blue'>Waiting for Verification</a>";} 
                           else if($order->status ==3 ){echo "<a style='margin-left: 10px;' class='btn btn-sm bg-green'>Delivered</a>";}?>      
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
                     <th>Address</th>
                     <th>Status</th>
                     <th>Order Type</th>
                     <th>Delivery Date</th>
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