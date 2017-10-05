	<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        View SubCategory Details
      </h1>
          <br><div> 
<a href="<?php echo base_url(); ?>Home_ctrl/add_sub_category"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>
    </div>

      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-bars"></i>Home</a></li>
         <li><a href="<?php echo base_url(); ?>Home_ctrl/view_subcategory">SubCategory Details</a></li>
         <li class="active">View SubCategory Details</li>
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
                  <h3 class="box-title">View SubCategory Details</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                          <th class="hidden">ID</th>
                           <th>Sub Category Name</th>
						   <th>Category Name</th>					                                                                                 
                           <th width="200px;">Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                       <?php
                           foreach($data as $sub) {	
						   $image=$sub->image;
                           ?>
                        <tr>
                           <td class="hidden"><?php echo $sub->id; ?></td>
                           <td class="center"><?php echo $sub->sub_cat_name; ?></td>
						         <td class="center"><?php echo $sub->category_name; ?></td>
                           <td class="center">	                                                   		  
                             <a class="btn btn-sm bg-olive show-subcatgetdetails" href="javascript:void(0);" data-id="<?php echo $sub->id; ?>">
                              <i class="fa fa-fw fa-eye"></i> View </a>	
                              <a class="btn btn-sm btn-primary" href="<?php echo site_url('Home_ctrl/edit_subcat/'.$sub->id); ?>">
                              <i class="fa fa-fw fa-edit"></i>Edit</a>
                              <a class="btn btn-sm btn-danger" href="<?php echo site_url('Home_ctrl/delete_subcat/'.$sub->id); ?>" onClick="return doconfirm()">
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
                           <th>Sub Category Name</th>
						   <th>Category Name</th>
						    
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
<div class="modal fade modal-wide" id="popup-subcatgetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">View Subcategory Details</h4>
         </div>
         <div class="modal-subcatbody">
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
