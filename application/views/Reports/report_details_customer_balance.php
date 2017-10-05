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
						   <th width="200">Client title</th> 
						   <th width="200">Balance</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                        $total=0;
                           foreach($data as $pro) 
                           {	
                           ?>
                        <tr>
                             <td class="center"><?php echo $pro->client_name; ?></td>
              						   <td class="center"><?php echo ($pro->receivable_amount-$pro->received); ?></td>
                            <?php $total+=$pro->receivable_amount-$pro->received; ?>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
						   <th width="200">Client Title</th>
               <th width="200">Balance</th> 
						    
                        </tr>
                     </tfoot>
                  </table>
                  
               </div>
               <div class="row">
                 <div width="200" class="col-md-10">
                  <div>
                    <span class="pull-right">
                      <h3><strong>Balance :<?php echo ($total); ?></strong></h3>
                    </span>
                  </div>
                  </div>
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
