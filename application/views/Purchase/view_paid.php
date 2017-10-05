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
                    <li >View Purchase</li>
                    <li class="active">View paid payment</li>
                    
                    <div style="float: right;">
                    <a href="<?php echo base_url();?>Purchase_ctrl/add_new_payment" style="color:white;">
                      <button class="btn add-new" type="button">
                        <b>Add New</b>
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
               <th>Client</th> 
               <th>Amount Received</th> 
						   <!-- <th>Amount</th> -->
                
						   <!-- <th>Received</th> -->
               <!-- <th>Action</th> -->
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $pro) 
                           {	  
                           ?>
                        <tr>
                           <td class="center"><?php echo $pro->paid_id; ?></td>
                           <td class="center"><?php echo $pro->date; ?></td>
                           <!-- <td class="center"><?php echo $pro->method; ?></td> -->
            						   <td class="center"><?php echo $pro->vendor_name; ?></td>
            						   <td class="center"><?php echo $pro->paid_amount; ?></td>
                           

                           <!-- <td class="center"> -->	                         
                           	<!--<a class="btn btn-sm bg-olive show-progetdetails" href="javascript:void(0);" data-id="<?php //echo $pro->product_id; ?>">-->
                            <!--  <i class="fa fa-fw fa-eye"></i> View </a>	 -->
                            <!-- <a class="btn btn-sm btn-success" href="<?php //echo site_url('Product_ctrl/edit_pro/'.$pro->sales_id); ?>">
                            <i class="fa fa-fw fa-eye"></i>View</a> -->
                            <!-- <a class="btn btn-sm btn-danger" href="<?php //echo site_url('Product_ctrl/edit_pro/'.$pro->sales_id); ?>">
                            <i class="fa fa-fw fa-edit"></i>Delete</a> -->
                           <!-- </td> -->
                        
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
               <th>ID</th>        
               <th>Date</th>
               <th>Client</th>
               <th>Amount recived</th>
						   <!-- <th>amount</th> --> 
               <!-- <th>Items</th>
               <th>Type</th>
						   <th>Action</th> -->
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

