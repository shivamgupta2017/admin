<table class="table table-bordered" style="text-align: left">
  <tbody> 
    <td colspan="5">
      <table class="table">
        <tbody>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Price</th>
          <th>Qty</th>
           <th>Weight</th>
        </tr>
        <?php
        if($products != NULL){
        foreach ($products as $rs) { ?>
        <tr>     
          <td><image style="width:100px;height:100px" src="<?php echo base_url().$rs->image; ?>"></td>
          <td><?php echo $rs->product_name; ?></td>
          <td><?php echo $rs->price; ?></td>
          <td><?php echo $rs->quantity;?></td>
           <td><?php echo $rs->weight." ".$rs->unit?></td>
        </tr>
        <?php 
        
        } }else{?><td>No Products In this Order</td><?php } ?>
        </tbody>
      </table>
    </td>
  </tr>
  </tbody>
</table>