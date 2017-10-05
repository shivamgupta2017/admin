	<div class="content-wrapper">
   <!-- Content Header (Page header) -->
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
                    <li class="active">View Product Details</li>
                </ol>
                </div><br><br>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
						    <th>Customer Name</th>
						    <th>Order Id</th>
						    <th>Phone</th> 
						    <th>Invoice Id</th>
						    <th>Payment Status</th>
						    <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $pro) {	
                           ?>
                        <tr>
                           <td class="center"><?php echo ucfirst($pro->first_name).' '.ucfirst($pro->last_name); ?></td>
                           <td class="center"><?php echo $pro->order_id; ?></td>				
                           <td class="center"><?php echo $pro->phone; ?></td>						   
            						   <td class="center"><?php echo $pro->invoice_id; ?></td>
            						   <td class="center"><?php if($pro->payment_status == 1){echo "Inprocess";}elseif($pro->payment_status == 2){echo "Completed";}else{echo "Pending";} ?></td> 
            						   <td class="center"><?php echo date('d-m-Y',strtotime($pro->due_date));?></td>
            						   <td class="center">	                         
                            <a style="margin-left: 10px;" class="btn btn-sm bg-red" href="<?php echo base_url();?>Payment_ctrl/edit_payment/<?php echo $pro->payment_id;?>/<?php echo $pro->order_id;?>"</a>
                              <i class="fa fa-pencil"></i> Edit </a>
                              <?php if(!empty($pro->invoice_link)){?>
                             <a style="margin-left: 10px;" target="_blank" class="btn btn-sm bg-black" href="<?php echo $pro->invoice_link;?>"</a>
                              <i class="fa fa-external-link"></i> Invoice </a>	<?php }?>
                               <?php if($pro->payment_status == 1){?>
                             <a style="margin-left: 10px;" onClick="return doconfirm()" class="btn btn-sm bg-green" href="<?php echo base_url();?>Payment_ctrl/complete_order/<?php echo $pro->order_id;?>"</a>
                              <i class="fa fa-share"></i> Complete Order</a><?php }?>
                           </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
						<th>Customer Name</th>
						    <th>Order Id</th>
						   <th>Phone</th> 
						   <th>Invoice Id</th>
						   <th>Payment Status</th>
						  <!--  <th>Unit</th> -->
						   <!--<th>Details</th>-->
						  <!--  <th>Ingredients</th>
                           <th>Warnings</th> -->
						                                                                    
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

<div class="modal fade modal-wide" id="popup-progetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           
         </div>
         <div class="modal-probody">
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
