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

         <form role="form" action="" id="my_form" method="post" data-parsley-validate="" enctype="multipart/form-data">

         <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                  <ol class="breadcrumb">
                    <li><a href="#"><i aria-hidden="true"></i>Home</a></li>
                    <li><a href="#"><i aria-hidden="true"></i>View Sales</a></li>
                    <li class="active">Add Received</li>
                    
                  </ol>
              </div>

                <br>
                <br>
                <div class="col-md-4">
                       <div class="form-group" >
                          <label>Select Vendor</label>
                              <select class="form-control selectpicker" required="" id="client_id"  data-live-search="true" style="width: 30%;" name="client_id">
                                  <option value=''>Select Client</option>
                                    <?php
                                        foreach($data as $temp)
                                        {
                                    ?>
                                          <option value="<?php echo $temp->vendor_id;?>"><?php echo $temp->vendor_name;?></option>
                                          <?php 
                                        }
                                          ?> 
                              </select>
                        </div>
                
                      

                      

                      <div id="client_info">
                                
                      </div>

                       <div id='input_field' class="form-group has-feedback" style="display: none;">
                            <label for="exampleInputEmail1">Enter Amount</label>
                              <input type="tel" class="form-control required" data-parsley-trigger="change" 
                                      data-parsley-minlength="1" name="received" id="amount_paid" >
                      </div>

                </div>
                        
                          
 
            
          </div>

              <button id='add_received_button' type="submit" class="btn btn-primary">Submit</button>

        </form>

   </section>
</div>
<script type="text/javascript">
    


   $(document).ready(function()
    {


      

      $("#client_id").on('change', function()
      {
        var vendor_id=$('#client_id').val();
        

        if(vendor_id!='')
        {
          $.ajax({
              type:'POST',
              url:'get_vendor_details',
              data:{'id':vendor_id},
              success:function(data)
              {
                data=JSON.parse(data);
                $('#client_info').empty();
                $('#client_info').append('<table width="100%" border="1px" cellspacing="0" cellpadding="5px"><tr><td bgcolor="#1874a0"><strong style="color:#FFF;">vendor Info</strong></td></tr><tr><td><p><strong>'+''+data.shipping_details[0].vendor_name+''+'</strong><br/>Mob # :'+data.shipping_details[0].mobile+'</span><br/>Address: <span>'+data.shipping_details[0].address+'  '+data.shipping_details[0].city+'</span><span id="balance" value='+(data.total_purchase[0].payable_amount-data.total_paid[0].paid_amount)+' style="text-align:right; background-color:#CCC; font-weight:bold; padding:2px; width:80%; float:right;">Total Payable: '+(data.total_purchase[0].payable_amount-data.total_paid[0].paid_amount)+'</span></p></td></tr></table>');

                $("#input_field").show();

                if(data.total_purchase[0].payable_amount-data.total_paid[0].paid_amount<=0)
                {
                   $('#add_received_button').prop("disabled",true);
                }
                else
                {
                  $('#add_received_button').prop("disabled",false);
                }

              }
          });
        }




      });

    })
</script>