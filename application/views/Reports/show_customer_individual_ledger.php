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
                    <li><a href="#"><i aria-hidden="true"></i>Reports</a></li>
                    <li class="active">Summary</li>
                    
                  </ol>
              </div>

                <br>
                <div id="client_info"></div>

                <div class="col-md-2" id="client_selector">
                       <div class="form-group" >
                          <label>Select Client</label>
                              <select class="form-control selectpicker" required="" id="client_id"  data-live-search="true" style="width: 30%;" name="client_id">
                                  <option value=''>Select Client</option>
                                    <?php
                                        foreach($client as $temp)
                                        {
                                    ?>
                                          <option value="<?php echo $temp->user_id;?>"><?php echo $temp->client_name;?></option>
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
                          <th>Type</th>
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
              url:'select_client_for_ledger',
              data:{'id':client_id},
              success:function(data)
              {
                console.log(data);
                data=JSON.parse(data);
                $('#client_selector').hide();
                $('#client_info').empty();
                $('#client_info').append('<table width="100%" border="1px" cellspacing="0" cellpadding="5px"><tr><td bgcolor="#1874a0"><strong style="color:#FFF;">Client Info</strong></td></tr><tr><td><p><strong>'+''+data.shipping_details[0].client_name+''+'</strong><br/>Mob # :'+data.shipping_details[0].mobile_no+'</span><br/>Address: <span>'+data.shipping_details[0].address+'  '+data.shipping_details[0].city+'</span><span id="balance" value='+(data.total[0].receivable_amount-data.received[0].received)+' style="text-align:right; background-color:#CCC; font-weight:bold; padding:2px; width:80%; float:right;">Total Payable: '+(data.total[0].receivable_amount-data.received[0].received)+'</span></p></td></tr></table>');
                
                $('#table_show').empty();
                var balance=0;
                $.each(data.data, function(i, item)
                {
                    var data_append='';
                    data_append='<tr><td class="center">'+item.date+'</td>';
                    if(item.receivable==0)
                    {
                      //receiving

                      balance-=parseInt(item.received);
                      data_append=data_append+'<td class="center">Receiving</td>';
                      data_append=data_append+'data<td class="center">'+item.received+'</td><td class="center">'+balance+'</td></tr>';
                    }
                    else
                    {
                      //sale
                      balance+=parseInt(item.receivable);
                      data_append=data_append+'<td class="center">Sale Invoice</td>';
                      data_append=data_append+'data<td class="center">'+item.receivable+'</td><td class="center">'+balance+'</td></tr>';
                    }
                      $('#table_show').append(data_append);
                  
                });
              }
          });
        }




      });

    })
</script>