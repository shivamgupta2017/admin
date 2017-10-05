<table class="table table-bordered" style="text-align: left">
  <tbody> 
    <td colspan="5">
      <table class="table">
        <tbody>
        <tr>
          <th>Name</th>
          <th>Company</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Email</th>
        </tr>
        <?php
        if($billing_address != NULL){
        foreach ($billing_address as $rs) { ?>
        <tr>     
          <td><?php echo ucfirst($rs->first_name).' '.ucfirst($rs->last_name); ?></td>
          <td><?php echo $rs->company; ?></td>
          <td><?php echo $rs->address; ?></td>
          <td><?php echo $rs->phone;?></td>
           <td><?php echo $rs->email?></td>
        </tr>
        <?php 
        
        } }else{?><td>No Products In this Order</td><?php } ?>
        </tbody>
      </table>
    </td>
  </tr>
  </tbody>
</table>

<h3 style="margin-left:20px">Shipping Addresses</h3>
<table class="table table-bordered" style="text-align: left">
  <tbody> 
    <td colspan="5">
      <table class="table">
        <tbody>
        <tr>
          <th>Address1</th>
          <th>Address2</th>
          <th>Zipcode</th>
          <th>Phone</th>
        </tr>
        <?php
        if($shipping_address != NULL){
        foreach ($shipping_address as $rs) { ?>
        <tr>     
          <td><?php echo $rs->shipping_address_1; ?></td>
          <td><?php echo $rs->shipping_address_2; ?></td>
          <td><?php echo $rs->shipping_zip;?></td>
           <td><?php echo $rs->shipping_phone?></td>
        </tr>
        <?php 
        
        } }else{?><td>No Products In this Order</td><?php } ?>
        </tbody>
      </table>
    </td>
  </tr>
  </tbody>
</table>