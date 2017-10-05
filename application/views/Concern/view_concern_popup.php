	<div class="row">
            <div class="col-md-6">
              <div class="box box-primary">
				<div class="box-header with-border">
         <h3 class="box-title">View Concern Details</h3>
         <div class="box-tools pull-right">
            <button class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
            <i class="fa fa-minus"></i>
            </button>
         </div>
      </div>
                <div class="box-body">
              <table class="table">
        <tbody>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Qty</th>
           <th>Weight</th>
        </tr>
        <?php
        if($data != NULL){
        foreach ($data as $rs) { ?>
        <tr>     
          <td><?php echo $rs->name; ?></td>
          <td><?php echo $rs->email; ?></td>
          <td><?php echo $rs->phone;?></td>
          <td><?php echo $rs->message;?></td>
        </tr>
        <?php 
        
          } 
        }else{?><td>No Products In this Order</td><?php } ?>
        </tbody>
      </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- ./col -->
        <div class="col-md-6">
                <div class="box-body">
                  <dl>
					<dt>Document Image</dt>
                    <dd><img style="width:300px"<?php $image = explode('?',$rs->image_link);?> src="<?php echo $image[0]; ?>"></dd>
                  </dl>
               </div>
        </div>
          </div>  