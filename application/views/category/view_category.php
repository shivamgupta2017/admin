	<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        View Category Details </h1><br>
    <div>
    <a href="<?php echo base_url(); ?>Home_ctrl/add_category"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>
    </div>


      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i>Home</a></li>
         <li><a href="#">Category Details</a></li>
         <li class="active">View Category Details</li>
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
                  <h3 class="box-title">View Category Details</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                          <th class="hidden">ID</th>
                           <th>Name</th>
						   <td>Image</td>

                           <th width="200px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           foreach($data as $cat) {
						   $image=$cat->image;
                           ?>
                        <tr>
                           <td class="hidden"><?php echo $cat->id; ?></td>
                           <td class="center"><?php echo $cat->category_name; ?></td>
                           <td class="center"><img src="<?php echo base_url()."uploads/".$image ?>" width="100px"height="100px"></td>

                           <td class="center">
                           	<a class="btn btn-sm bg-olive show-catgetdetails"  href="javascript:void(0);"  data-id="<?php echo $cat->id; ?>">
                              <i class="fa fa-fw fa-eye"></i> View </a>
                              <a class="btn btn-sm btn-primary" href="<?php echo site_url('Home_ctrl/edit_cat/'.$cat->id); ?>">
                              <i class="fa fa-fw fa-edit"></i>Edit</a>
                              <a class="btn btn-sm btn-danger" href="<?php echo site_url('Home_ctrl/delete_cat/'.$cat->id); ?>" onClick="return doconfirm()">
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
                           <th>Name</th>
						   <td>Image</td>
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
