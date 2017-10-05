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
          <th>Total Price</th>
        </tr>
        <?php
        if($data != NULL){
            $total_price = 0;
        foreach ($data as $rs) { ?>
        <tr>     
          <td><image style="width:100px;height:100px" src="<?php echo base_url()."assets/uploads/product/".$rs->image; ?>"></td>
          <td><?php echo $rs->name; ?></td>
          <td><?php echo $rs->price; ?></td>
          <td><?php echo $rs->quantity;?></td>
          <td><?php echo $rs->size." ".$rs->unit?></td>
          <td><?php $total_price +=$rs->quantity*$rs->price;echo $rs->quantity*$rs->price;?></td>
        </tr>
        <?php 
        
        } ?>
         <tr>
             <td></td><td></td><td></td><td></td><td>Total</td>
            <td><?php echo $total_price;?></td>
        </tr>
        <?php }else{?><td>No Products In this Order</td><?php } ?>
        </tbody>
      </table>
    </td>
  </tr>
  </tbody>
</table>