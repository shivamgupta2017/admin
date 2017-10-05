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
            <div class="box">
              <div class="box-header">
                  <ol class="breadcrumb">
                    <li><a href="#"><i aria-hidden="true"></i>Home</a></li>
                    <li class="active">View Sales</li>
                    <div style="float: right;">
                    <a href="<?php echo base_url();?>Sales_ctrl/add_new_sales" style="color:white;">
                      <button class="btn add-new" type="button">
                        <b><i class="fa fa-fw fa-plus"></i>Add New</b>
                      </button></a>

                      <a href="<?php echo base_url();?>Sales_ctrl/view_receiving" style="color:white;">
                      <button class="btn add-new" type="button">
                        <b>Received</b>
                      </button></a>

                    <!-- <a href="<?php /*echo*/ //base_url(); ?>Payment_ctrl/add_payment" style="color:white;">
                      <button  class="btn add-new" style="width: auto;" type="button">
                        <b>
                          <i class="fa fa-fw fa-plus"></i> Add Payment </b>
                      </button>
                    </a> -->

                    <div>
                </ol>
                </div><br><br>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
               <th>ID</th>         
               <th>Date</th>
						   <th width="200">Client title</th> 
						   <th>Payment Type</th>
               <th>Receivable amount</th>
               <th>Received amount</th> 
               <th>Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $pro) {	
                           ?>
                        <tr>
               <td class="center"><?php echo $pro->sales_id; ?></td>
               <td class="center"><?php echo $pro->date; ?></td>
						   <td class="center"><?php echo $pro->business_title; ?></td>
               <?php if($pro->payment_type==1)
               {
                ?>
                   <td class="center">Cash</td>
                <?php 
               }
               else
               {
               ?>
                  <td class="center">Credit</td>
               <?php 
                }
                ?>
               <td class="center"><?php echo $pro->receivable_amount; ?></td>
               <td class="center"><?php echo $pro->received_amount; ?></td>
                           <td class="center">	                         
                           	<a class="btn btn-sm bg-olive show-progetdetails" href="<?php echo site_url('Sales_ctrl/view_invoice/'.$pro->sales_id.'/'.$pro->client_id.'/'.$pro->payment_type); ?> " target="_blank">
                              View Invoice</a>

                            <!-- <a class="btn btn-sm btn-success" href="<?php //echo site_url('Product_ctrl/edit_pro/'.$pro->sales_id); ?>">
                            <i class="fa fa-fw fa-eye"></i>View</a> -->
                            <!-- <a class="btn btn-sm btn-danger" href="<?php //echo site_url('Product_ctrl/edit_pro/'.$pro->sales_id); ?>">
                            <i class="fa fa-fw fa-edit"></i>Delete</a> -->
                           </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
               <th>ID</th>        
               <th>Date</th>
						   <th>Client Title</th>
						   <th>Payment Type</th> 
						   <th>Receivable amount</th>
               <th>Received amount</th> 
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

<div class="modal fade modal-wide" id="popup-purchase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           
         </div>
         <div class="modal-purchasebody">
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