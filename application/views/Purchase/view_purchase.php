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
                    <li class="active">View Product Details</li>
                    <div style="float:right;">
                      <a href="<?php echo base_url();?>Purchase_ctrl/add_new_purchase_order" style="color:white;"><button style="width: auto;" class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>
                      <a href="<?php echo base_url(); ?>Purchase_ctrl/paid_payment" style=" color:white;"><button style="width: auto;" class="btn add-new" type="button"><b>Paid Payment</b></button></a>
                    </div>
                </ol>
                </div><br><br>
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                            <tr>
                           <th>Date</th>
                           <th>Vendor Title</th> 
                           <th>Contact</th>
                           <th>Payment Type</th>
                           <th>Payable</th>
                           <th>Paid</th>
                           <th>Purchase Status</th>
                           <th>Action</th>


                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $pro) { 
                           ?>
                        <tr>
                           <td class="center"><?php echo $pro->date; ?></td>
                           <!-- <td class="center"><?php //echo $pro->agent; ?></td> -->              
                           <td class="center"><?php echo $pro->vendor_name; ?></td>
                           <td class="center"><?php echo $pro->mobile; ?></td> 
               
               <?php if($pro->payment_status==0)
               {  

               ?> 
               <td class="center">Credit</td>
               <?php 
               }
               else
               {
                ?>
               <td class="center">Cash Paid</td>
               <?php  
               } 
               ?>
               <td class="center"><?php echo $pro->payable_amount; ?>               
               <td class="center"><?php echo $pro->paid_amount; ?>               
               <!-- shivam --> 
               <td class="center">
                <?php echo $pro->purchase_status ?>
                </td>            
               <td class="center">                           
                  
                  <?php 
                  if($pro->purchase_status=='pending')
                  {


                    ?>
                    <a class="btn btn-sm bg-olive show-progetdetails" href="<?php echo site_url('Purchase_ctrl/edit_purchase/'.$pro->purchase_id.'/'.$pro->vendor_id.'/'.$pro->payment_status); ?> ">
                              Edit</a>
                  <?php 
                  } ?>
                  
                    <?php 
                    if($pro->purchase_status!='pending')
                    {
                    ?>
                      <a class="btn btn-sm bg-olive show-progetdetails" href="<?php echo site_url('Purchase_ctrl/view_invoice/'.$pro->purchase_id.'/'.$pro->vendor_id.'/'.$pro->payment_status); ?> " target="_blank">
                              View Invoice</a>
                    <?php 
                    } 
                    else
                    {
                      ?>
                      <a class="btn btn-sm bg-olive show-progetdetails" href="<?php echo site_url('Purchase_ctrl/view_challan/'.$pro->purchase_id.'/'.$pro->vendor_id.'/'.$pro->payment_status); ?> " target="_blank">
                             View Challan</a>
                    <?php          
                    }
                    ?>
                   
                  

                </td>

               </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>Date</th>
               <th>Vendor Title</th> 
               <th>Contace</th>
               <th>Payment Type</th>
               <th>Payable</th> 
               <th>Paid</th>
               <th>Purchase Status</th>
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