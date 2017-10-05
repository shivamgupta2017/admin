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
                    <li><a href="#"><i aria-hidden="true"></i>View Reports</a></li>
                    
                  </ol>
              </div>

                <br>
                <br>
             





                      <div class="row">
  <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>Customers and Receiveables</strong>
            </div>
            <div style="padding:0px;" class="panel-body list-group">
                <div class="list-group-item"><a href="reports_ctrl/customer_balance_summary" target="_blank">Customer Balance Summary</a></div>
                <div class="list-group-item"><a href="reports_ctrl/customer_ledger_summary" target="_blank">Customer Balance Ledger</a></div>
            </div>
        </div>
    </div>
    <!--customers and receiveables-->
    
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>Vendor and payables</strong>
            </div>
            <div style="padding:0px;" class="panel-body list-group">
                <div class="list-group-item"><a target="_blank" href="reports_ctrl/vendor_balance_summary">Vendor Balance Summary</a></div>
                <div class="list-group-item"><a href="reports_ctrl/vendor_ledger_summary" target="_blank">Vendor Balance Ledger</a></div>
            </div>
        </div>
    </div>
    <!--customers and receiveables-->

    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>Sale Reports</strong>
            </div>
            <div style="padding:0px;" class="panel-body list-group">
                <div class="list-group-item"><a href="reports_ctrl/profit" target="_blank">Profit</a></div>
            </div>
        </div>
    </div>
    <!--customers and receiveables-->
    
    <!-- <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>Purchase Reports</strong>
            </div>
            <div style="padding:0px;" class="panel-body list-group">
                <div class="list-group-item"><a href="reports/purchase_report.php?data=today" target="_blank">Today's Purchase Report</a></div>
                <div class="list-group-item"><a href="reports/purchase_report.php?data=today" target="_blank">Last 7 Days Report</a></div>
                <div class="list-group-item"><a href="reports/purchase_report.php?data=today" target="_blank">Last 30 Days Report</a></div>
            </div>
        </div>
    </div> -->
    <!--customers and receiveables-->
    
    <!-- <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>Inventory</strong>
            </div>
            <div style="padding:0px;" class="panel-body list-group">
                <div class="list-group-item"><a href="reports/print_stock.php" target="_blank">Stock Report</a></div>
                <div class="list-group-item">For more stock reports look warehouses</div>
            </div>
        </div>
    </div> -->
    <!--customers and receiveables-->


                <!-- <div class="col-md-2">
                       <div class="form-group" >
                          <label>Select Client</label>
                              <select class="form-control selectpicker" required="" id="client_id"  data-live-search="true" style="width: 30%;" name="client_id">
                                  <option value=''>Select Client</option>
                                    <?php
                              //          foreach($client as $temp)
                                        {
                                    ?>
                                          <option value="<?php //echo $temp->user_id;?>"><?php //echo $temp->client_name;?></option>
                                          <?php 
                                        }
                                          ?> 
                              </select>
                        </div> -->
                
                      

                      

                      


                </div>
          </div>
<!--               <button id='add_received_button' type="submit" class="btn btn-primary">Submit</button>
 -->

        </form>

   </section>
</div>
<script type="text/javascript">
    


   $(document).ready(function()
    {

      $("#client_id").on('change', function()
      {
        var client_id=$('#client_id').val();
        
        if(client_id!='')
        {
          $.ajax({
              type:'POST',
              url:'Reports_ctrl/select_client_for_ledger',
              data:{'id':client_id},
              success:function(data)
              {

         

                data=JSON.parse(data);
                 $('#client_info').empty();
                $('#client_info').append('<table width="100%" border="1px" cellspacing="0" cellpadding="5px"><tr><td><strong><center><h3>Client Info</h3></center></strong></td></tr><tr><td><p><strong><center>'+''+data.shipping_details[0].client_name+''+'</center></strong><center>Mob # :'+data.shipping_details[0].mobile_no+'</center></span><center>Address: <span>'+data.shipping_details[0].address+'  '+data.shipping_details[0].city+'</center></span><span id="balance" value='+(data.total[0].receivable_amount-data.received[0].received)+' style="text-align:right; font-weight:bold; padding:2px; width:80%; float:right;">Total Payable: '+(data.total[0].receivable_amount-data.received[0].received)+'</span></p></td></tr></table>');
                $("#input_field").show();

                if(data.total[0].receivable_amount-data.received[0].received<=0)
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