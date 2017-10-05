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
                    <li>View Reports</li>
                    <li class="active">Customer Balance</li>
                    
                  </ol>
                </div><br><br>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
						   <th width="200">Vendor title</th> 
               <th width="200">Currently Payable</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $pro) {	
                           ?>
                        <tr>
                             <td class="center"><?php echo $pro->vendor_name; ?></td>
              						   <td class="center"><?php echo ($pro->payable_amount-$pro->paid_amount); ?></td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
						   <th width="200">Vendor Title</th>
						   <th width="200">Currently Payable</th> 
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
