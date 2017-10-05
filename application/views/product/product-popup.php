<table class="table table-bordered" >
  <tbody> 
  <tr>
   <td style="width:50%">
      <h1><?php echo $data[0]->product_name;?><br></h1>
        <div style="width:100%;height:170px;margin:0 auto; background-size:contain; background-image:url(<?php echo base_url()."assets/uploads/product/".$data[0]->product_image;?>); background-position:center; background-repeat:no-repeat"></div><br>
        Details: <?php echo $data[0]->product_description;?><br>
        Total Tax :<?php echo $data[0]->tax;?>
  </td>
  <td>
      <table class="table">
          <tr><td colspan="4">Unit Details</td></tr>
          <tr>
              <th>Weight</th><th>Selling Price</th><th>Purchase Price</th><th>Max limit</th>
          </tr>
          <tr>
              <td>
                <?php echo $data[0]->weight.' '.$data[0]->unit_name;?>
                
              </td>
              <td>
                <?php echo $data[0]->selling_price;?>
                  
                </td>
                <td>
                  <?php echo $data[0]->purchase_price;?>
                    
                  </td>
                  <td>
                    <?php echo $data[0]->max_limit;?>
                      
                    </td>
          </tr>
      </table>
  </td>
  </tr>
  </tbody>
</table>