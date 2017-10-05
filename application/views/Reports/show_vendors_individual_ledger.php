<div class="content-wrapper">
   <!-- Content Header (Page header) -->
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

      </div>

         <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                  <ol class="breadcrumb">
                    <li><a href="#"><i aria-hidden="true"></i>Home</a></li>
                    <li><a href="#"><i aria-hidden="true"></i>View Reports</a></li>
                    <li class="active">Vendors Ledger</li>
                    
                  </ol>
              </div>

                <br>
                <div id="client_info"></div>

                <div class="col-md-2" id="client_selector">
                       <div class="form-group" >
                          <label>Select Vendor</label>
                              <select class="form-control selectpicker" required="" id="client_id"  data-live-search="true" style="width: 30%;" name="client_id">
                                  <option value=''>Select Vendor</option>
                                    <?php
                                        foreach($vendor as $temp)
                                        {
                                    ?>
                                          <option value="<?php echo $temp->vendor_id;?>"><?php echo $temp->vendor_name;?></option>
                                          <?php 
                                        }
                                          ?> 
                              </select>
                        </div>
                </div>
                 <div class="box-body">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Method</th>
                          <th>Amount</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                      <tbody id="table_show">


                      </tbody>  
                    </table>
                  </div>





                 </div>
          </div>
        </div>
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
              url:'select_vendor_for_ledger',
              data:{'id':client_id},
              success:function(data)
              {
                console.log(data);
                data=JSON.parse(data);
                $('#client_selector').hide();
                $('#client_info').empty();
                $('#client_info').append('<table width="100%" border="1px" cellspacing="0" cellpadding="5px"><tr><td bgcolor="#1874a0"><strong style="color:#FFF;">Client Info</strong></td></tr><tr><td><p><strong>'+''+data.shipping_details[0].vendor_name+''+'</strong><br/>Mob # :'+data.shipping_details[0].mobile+'</span><br/>Address: <span>'+data.shipping_details[0].address+'  '+data.shipping_details[0].city+'</span><span id="balance" value='+(data.payable[0].payable_amount-data.paid[0].paid_amount)+' style="text-align:right; background-color:#CCC; font-weight:bold; padding:2px; width:80%; float:right;">Total Payable: '+(data.payable[0].payable_amount-data.paid[0].paid_amount)+'</span></p></td></tr></table>');
                
                $('#table_show').empty();
                var total=0;
                $.each(data.data, function(i, item)
                {

                      var data_append='';
                      data_append='<tr><td class="center">'+item.date+'</td>';
                      if(item.payable_amount>0)
                      {
                        //payble

                        total=total+parseInt(item.payable_amount);
                        data_append=data_append+'<td class="center">Purchase Invoice</td>';
                        data_append=data_append+'data<td class="center">'+item.payable_amount+'</td><td class="center">'+total+'</td></tr>';
                      }
                      else
                      {
                        //paid
                        total=total-parseInt(item.paid_amount);
                        data_append=data_append+'<td class="center">Paid Invoice</td>';
                        data_append=data_append+'data<td class="center">'+item.paid_amount+'</td><td class="center">'+total+'</td></tr>';

                      }

                      
                        $('#table_show').append(data_append);

                });
              }
          });
        }




      });

    })
</script>