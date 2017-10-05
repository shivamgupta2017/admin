	<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        View Help Details </h1><br>
    <div> 
    <a href="<?php echo base_url(); ?>Help_ctrl/add_help"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>
    </div>

     
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-arrows-alt"></i>Home</a></li>
         <li><a href="#">Help Details</a></li>
         <li class="active">View Help Details</li>
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
                  <h3 class="box-title">View Help Details</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                          <th class="hidden">ID</th>
                           <th>Department</th>
						         <td>Question</td>
                           <td>Answer</td>                                                                                                       
                           <th width="200px;">Action</th>
                         </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($help as $helps) {	
						   
                           ?>
                        <tr>
                           <td class="hidden"><?php echo $helps->id; ?></td>
                           <td class="center"><?php echo $helps->department; ?></td>
                           <td class="center"><?php echo $helps->question; ?></td>
                           <td class="center"><?php echo $helps->answer; ?></td>
                                
                           <td class="center">	                         
                           	
                              <a class="btn btn-sm btn-primary" href="<?php echo site_url('Help_ctrl/edit_help/'.$helps->id); ?>">
                              <i class="fa fa-fw fa-edit"></i>Edit</a>
                              <a class="btn btn-sm btn-danger" href="<?php echo site_url('Help_ctrl/delete_help/'.$helps->id); ?>" onClick="return doconfirm()">
                              <i class="fa fa-fw fa-trash"></i>Delete</a>							
                           </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                       <tr>
                          <th class="hidden">ID</th>
                           <th>Department</th>
                           <td>Question</td>
                           <td>Answer</td>                                                                                                       
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
<div class="modal fade modal-wide" id="popup-catModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">View Category Details</h4>			
         </div>
         <div class="modal-catbody">	 
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
