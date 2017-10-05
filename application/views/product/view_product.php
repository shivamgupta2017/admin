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
                    <li class="active">View Product Details</li>
                    <a href="<?php echo base_url(); ?>Product_ctrl/add_products" style="float:right;color:white;"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i>Add New</b></button></a>
                </ol>
                </div><br><br>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                          <th class="hidden">ID</th>
                           <th>Product Name</th>
						   
						<!--    <th>Category</th>
						   <th>Sub Category</th> -->
						   <!--<th>Price</th>-->
						  <!--  <th>Unit</th> -->
						   <th>Details</th>
						  <!--  <th>Ingredients</th>
                           <th>Warnings</th> -->
						                                                                    
                           <th style="width:400px;">Action</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $pro) 
                           {	
						                  $image=$pro->product_image;
                           ?>
                        <tr>
                           <td class="hidden"><?php echo $pro->product_id; ?></td>
                           <td class="center"><?php echo $pro->product_name; ?></td>						   
						<!--    <td class="center"><?php echo $pro->category_name; ?></td>
						   <td class="center"><?php echo $pro->sub_cat_name; ?></td> -->
						   <!--<td class="center"><?php echo $pro->price; ?></td>-->
                      <!--      <td class="center"><?php echo $pro->unit; ?></td> -->
						   <td class="center"><?php echo $pro->product_description; ?></td>
                       <!--     <td class="center"><?php echo $pro->ingredients; ?></td> -->
						 <!--   <td class="center"><?php echo $pro->warnings; ?></td> -->
                                           
                           <td class="center">	                         
                           	<a class="btn btn-sm bg-olive show-progetdetails" href="javascript:void(0);" data-id="<?php echo $pro->product_id; ?>">
                              <i class="fa fa-fw fa-eye"></i> View </a>	 
                              <a class="btn btn-sm btn-primary" href="<?php echo site_url('Product_ctrl/edit_pro/'.$pro->product_id); ?>">
                              <i class="fa fa-fw fa-edit"></i>Edit</a>
                             
                              <a class="btn btn-sm btn-danger" href="<?php echo site_url('Product_ctrl/delete_pro/'.$pro->product_id.'/'.$pro->is_deleted); ?>" onClick="return doconfirm()">
                              <i class="fa fa-fw fa-trash"></i><?php if($pro->is_deleted)
                      				{
                      					echo "Retrive";
                      				}
                      				else	
                      				{
                      				echo "Delete";	
                      				}?></a>
                             
                           </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
						<th class="hidden">ID</th>
                           <th>Product Name</th>						
						  
						   <th>Details</th>
						 
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