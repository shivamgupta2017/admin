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
                    <li class="active">View Invoice</li>
                    <a href="<?php echo base_url(); ?>Invoice/create_invoice" style="float:right;color:white;"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>
                </ol>
                </div><br><br>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                          <th class="hidden">ID</th>
                           <th>Date</th>
						   <th>User Name</th>
						   <th>Invoice Id</th>
						   <th>Due Date</th>
                           <th style="width:400px;">Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $temp) {	
                           ?>
                        <tr>
                           <td class="hidden"><?php echo $temp->product_id; ?></td>
                           <td class="center"><?php echo $temp->created_date;?></td>						   
						   <td class="center"><?php echo ucfirst($temp->first_name).' '.ucfirst($temp->last_name); ?></td>
                           <td class="center"><?php echo 'INV-000'.$temp->id?></td>	  
                           <td class="center"><?php echo $temp->invoice_due_date?></td>	                            
                           	<td><a class="btn btn-sm bg-olive" href="<?php echo $temp->invoice_link?>">
                              <i class="fa fa-fw fa-eye"></i> View </a>	 </td>	
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
						 <th class="hidden">ID</th>
                           <th>Date</th>
						   <th>User Name</th>
						   <th>Invoice Id</th>
						   <th>Due Date</th>
                           <th style="width:400px;">Action</th>
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
