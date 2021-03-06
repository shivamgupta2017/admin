	<?php
   $currency = getSettings()->currency;
   ?>
   <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        View Bills
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-shopping-cart"></i>Home</a></li>
         <li><a href="#"> View Bills</a></li>
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
                  <h3 class="box-title"> View Bills</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                           <th>User Name</th>												  
						   <!--<th>Order ID</th>-->
						   <th>Amount</th>
						   <!--<th>Payment S</th>-->
						   <!--<th>Address</th>-->
						   <th>Last Due Amount</th>
						   <th>Advance Paid</th>
						   <th>Due Date</th>
						   <th>Month Bill</th>
						   <th>Status</th>
						   <th>Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $temp_data) {	
						  // $image=$customer->image;
						  
                           ?>
                        <tr>
                           <td class="center"><?php echo ucwords($temp_data->first_name).' '.ucwords($temp_data->last_name); ?></td>						   					 
						     <td class="center"><?php echo $temp_data->amount;?></td>
						  <td class="center">
						            
						                <?php if($temp_data->due_amount > 0)
						                        echo $temp_data->due_amount;
						                     else
						                        echo '0.00';
						              ?>
						  </td>
						  <td class="center">
						            
						                <?php if($temp_data->due_amount < 0)
						                        echo $temp_data->due_amount*(-1);
						                     else
						                        echo '0.00';
						              ?>
						  </td>
						  
                        
                          <td class="center"><?php echo $temp_data->due_date;?></td>
                          <td class="center"><?php echo $temp_data->month_bill;?></td>
                           <td class="center"><?php echo ($temp_data->payment_status == 0)? "Unpaid" : "Paid"?></td>
                           <td class="center">	                         
                           	<!--<a class="btn btn-sm bg-olive show-ordergetdetails" href="javascript:void(0);" data-id="<?php echo $temp_data->billing_id; ?>">-->
                            <!--  <i class="fa fa-fw fa-eye"></i> View </a>	      -->
                               	<a class="btn btn-sm bg-olive" href="bill_invoice/<?php echo $temp_data->billing_id;?>" >
                              <i class="fa fa-external-link"></i> Invoice </a>	                              
                           </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
					 <th>User Name</th>												  
						   <!--<th>Order ID</th>-->
						   <th>Amount</th>
						   <!--<th>Payment S</th>-->
						   <!--<th>Address</th>-->
						   <th>Last Due Amount</th>
						   <th>Advance Paid</th>
						   <th>Due Date</th>
						   <th>Month Bill</th>
						   <th>Status</th>
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
