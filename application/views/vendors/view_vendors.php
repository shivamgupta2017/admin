<div class="content-wrapper">
     <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <?php
               if($this->session->flashdata('message')) 
               {
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
                    <li><a href="#"><i></i>Home</a></li>
                    <li><a href="#">Vendor Details</a></li>
                    <li class="active">View Vendor Details</li>
                    <a href="<?php echo base_url(); ?>Vendor_ctrl/create_vendor" style="float:right;color:white;"><button class="btn add-new" type="button"><b><i class="fa fa-fw fa-plus"></i> Add New</b></button></a>
                </ol>
            </div><br><br>


            <div class="box-body">
                  <table id="" class="table table-bordered table-striped datatable">
                     <thead>
                        <tr>
                          <th class="hidden">ID</th>
                             <th>Vendor Name</th>            
                             <th>mobile</th>
                             <th>email</th>
                             <th>Address</th>
                             <th width="200px;">GSTIN NO</th>
                        </tr>
                     </thead> 
                     <tbody>
                        <?php
                           foreach($data as $customer) 
                           {  
                           ?>
                        <tr>
                             <td class="hidden"><?php echo $customer->vendor_id; ?></td>
                             <td class="center"><?php echo $customer->vendor_name; ?></td>               
                             <td class="center"><?php echo $customer->mobile; ?></td>            
                             <td class="center"><?php echo $customer->email; ?></td>
                             <td class="center"><?php echo ($customer->address.' ,'.$customer->city.' ,'.$customer->zipcode);?></td>
                             <td class="center"><?php echo $customer->gstin; ?></td> 
                        </tr>
                          <?php
                             }
                           ?>
                     </tbody>
                     <tfoot>
                        <tr>
                          <th class="hidden">ID</th>
                             <th>Vendor Name</th>            
                             <th>mobile</th>
                             <th>email</th>
                             <th>Address</th>
                             <th width="200px;">GSTIN NO</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>









            </div>
         </div>
      </div>
   </section>
</div>
