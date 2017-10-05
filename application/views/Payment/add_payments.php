<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Add New Purchase Order
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class=""></i>Home</a></li>
         <li><a href="<?php echo base_url(); ?>Home_ctrl/">Add New Purchase Order</a></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- left column -->
         <div class="col-md-12">
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
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-warning">
               <!-- /.box-header -->
               <!-- form start -->
                <!-- <input type="text" id="vendor_id" hidden readonly name="vendor_id"> -->
                  <div class="box-body">
                     <div class="col-md-6">
                       <div class="form-group">
                        <form action="" method="post">
                          <label>Select Method</label>
                          <select class="form-control" style="width: 100%;" id="type">
                          <option value=''>Select Method</option>
                          <option value='1'>Payment</option>
                          <option value='0'>Receiving</option>
                          </select>
                          </div>  
                        <div class="form-group" hidden id="client">
                          <label>Select Client</label>
                          <select class="form-control"  style="width: 100%;" id="client_id" name="client_id">
                          <option value=''>Select Client</option>
                          </select>
                          </div> 

                        <div class="form-group" hidden id="vendor">
                          <label>Select Vendor</label>
                          <select class="form-control" style="width: 100%;" id="vendor_id" name="vendor_id">
                          <option value=''>Select Vendor</option>
                          </select>
                          </div>  
                        </div> 
                        <div class="col-md-6" hidden id="my_form">
                     
                      <table border="0" cellpadding="5">
            <tbody><tr>
                            <th>Date:</th>
                            <td width="270"><input type="text" class="form-control" readonly="readonly" value="<?php echo date('Y-m-d');?>" name="date" id="date"><br></td>        
                         </tr>
                    <tr>
                            <th>Method</th>
                            <td><input type="text" class="form-control" placeholder="Receiving Method" required="required" name="payment_type"><br></td>        
                        </tr>
                    <tr>
                            <th>Ref#:</th>
                            <td><input type="text" class="form-control" placeholder="Reference Number" name="ref_no"><br></td>                    
                       </tr>
                        <tr>
                            <th>Amount:</th>
                            <td><input type="text" class="form-control" placeholder="Amount Received" required="required" name="paid_amount"><br></td>       
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <td>
                            <input type="submit" class="btn btn-primary" value="Add Receiving"><br></td>
                        </tr>    
                        </tbody></table>
                        </form>
            </div>  
                        </div> 
                        
<script>
      $(document).ready(function(){
        $('#vendor_id,#client_id').on('change',function(){
            $('#my_form').show();
        })
      $('#type').on('change',function(){
        var type = $('#type').val();
        if(type == 0){
          $.ajax({
            url : "get_client",
            method : "POST",
            data : "",
            success:function(data){
              $('#client').show();
              $('#vendor').hide();
              $('#client_id').html('');
              $('#my_form').hide();
             var data = JSON.parse(data);
            $("#client_id").append("<option>Select</option>");             
            for(var i=0;i<data.length;i++){
                $("#client_id").append("<option value="+data[i].user_id+">"+data[i].first_name+"</option>");
            }
            }
          })
        }
        if(type == 1){
          $.ajax({
            url : "get_vendor",
            method : "POST",
            data : "",
            success:function(data1){
              $('#vendor').show();
              $('#client').hide();
              $('#vendor_id').html('');
              $('#my_form').hide();
               var data1 = JSON.parse(data1);
               $("#vendor_id").append("<option>Select</option>");
            for(var i=0;i<data1.length;i++){

               $("#vendor_id").append("<option value="+data1[i].vendor_id+">"+data1[i].vendor_name+"</option>");
             }
            }
          })
        }
      })
      })
</script>
            <!-- /.box -->
         </div>
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>