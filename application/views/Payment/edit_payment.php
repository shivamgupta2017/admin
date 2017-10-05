<div class="content-wrapper">
   <!-- Content Header (Page header) -->
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
               <div class="box-header">
                  <ol class="breadcrumb">
                    <li><a href="#"><i aria-hidden="true"></i>Home</a></li>
                    <li class="active">Edit Payments</li>
                </ol>
                </div><br><br>
               <!-- /.box-header -->
               <!-- form start -->
			        <div class="box-body">
                     <div class="col-md-6">
					   <div class="form-group ">
					    <label for="exampleInputEmail1">Select Income Type</label>
				          <select class="form-control select2 required" required style="width: 100%;" id="action" name="action">
				             <option value="cash">Cash</option>
				              <option value="cheque">Cheque</option>
				               <option value="online">Online</option>
				                <option value="swipe">Swipe</option>
				         </select>
                      </div>
                    </div><br><br><br>
                    
                    <div class="col-md-12" hidden id='cash'>
                          <form role="form" action="" method="post" class="validate" enctype="multipart/form-data">
                       <!--<div class="form-group has-feedback">-->
                       <!--    <label for="exampleInputEmail1">Amount To Be Paid:1232131rs</label>-->
                       <!--    <span class="glyphicon  form-control-feedback"></span>-->
                       <!-- </div> -->
                        <input hidden type="text" id="action" name="action" value="cash">
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Receiver</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="receiver_name"  placeholder="receiver_name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Amount</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[0-9.\  \/]+$" required=""  name="received_amount"  placeholder="Amount">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Details</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="details"  placeholder="details">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <button class="btn btn-danger" type="sumbit">Submit</button>
                        </form>
                    </div>
                    
                     <div class="col-md-12" hidden id='cheque'>
                           <form role="form" action="" method="post" class="validate" enctype="multipart/form-data">
                               <input hidden type="text" id="action" name="action" value="cheque">
                       <!--<div class="form-group has-feedback">-->
                       <!--    <label for="exampleInputEmail1">Amount To Be Paid:1232131rs</label>-->
                       <!--    <span class="glyphicon  form-control-feedback"></span>-->
                       <!-- </div> -->
                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Cheque Number</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="cheque_number"  placeholder="cheque_number">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Bank Name</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="cheque_of_bank"  placeholder="cheque_of_bank">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Cheque Date</label>
                           <input type="text" class="form-control required" data-date-format='yyyy-mm-dd' id='cheque_date' name="cheque_date">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Amount</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[0-9.\  \/]+$" required=""  name="received_amount"  placeholder="Amount">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Receiver</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="receiver_name"  placeholder="receiver_name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Details</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="details"  placeholder="details">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <button class="btn btn-danger" type="sumbit">Submit</button>
                        </form>
                    </div>
                    
                     <div class="col-md-12" hidden id='online'>
                           <form role="form" action="" method="post" class="validate" enctype="multipart/form-data">
                               <input hidden type="text" id="action" name="action" value="online">
                       <!--<div class="form-group has-feedback">-->
                       <!--    <label for="exampleInputEmail1">Amount To Be Paid:1232131rs</label>-->
                       <!--    <span class="glyphicon  form-control-feedback"></span>-->
                       <!-- </div> -->
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Transaction Id</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="transaction_id"  placeholder="transaction_id">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Amount</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[0-9.\  \/]+$" required=""  name="received_amount"  placeholder="Amount">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Details</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="details"  placeholder="details">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <button class="btn btn-danger" type="sumbit">Submit</button>
                        </form>
                    </div>
                     <div class="col-md-12" hidden id='swipe'>
                           <form role="form" action="" method="post" class="validate" enctype="multipart/form-data">
                               <input hidden type="text" id="action" name="action" value="swipe">
                       <!--<div class="form-group has-feedback">-->
                       <!--    <label for="exampleInputEmail1">Amount To Be Paid:1232131rs</label>-->
                       <!--    <span class="glyphicon  form-control-feedback"></span>-->
                       <!-- </div> -->
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Receiver</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="receiver_name"  placeholder="receiver_name">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                         <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Amount</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[0-9.\  \/]+$" required=""  name="received_amount"  placeholder="Amount">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Details</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2"  data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required=""  name="details"  placeholder="details">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <button class="btn btn-danger" type="sumbit">Submit</button>
                        </form>
                    </div>
                    
                 </div>
               </form>
            </div>
            <!-- /.box -->
         </div>
         <script type="text/javascript">
         $(document).ready(function(){
             $(function() 
 {   $( "#cheque_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val(); });
              $('#cash').show();
             $('#action').on('change',function(){
                var action = $('#action').val();
                if(action =='cash'){
                   $('#cash').show();
                    $('#cheque').hide();
                     $('#online').hide();
                      $('#swipe').hide();
                }
                else if(action == 'cheque'){
                       $('#cheque').show();
                        $('#cash').hide();
                         $('#online').hide();
                          $('#swipe').hide();
                }
                else if(action == 'online'){
                       $('#online').show();
                        $('#cheque').hide();
                         $('#cash').hide();
                          $('#swipe').hide();
                }else if(action == 'swipe'){
                       $('#swipe').show();
                        $('#online').hide();
                         $('#cheque').hide();
                          $('#cash').hide();
                }
             });
             
         });
             
         </script>
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>

