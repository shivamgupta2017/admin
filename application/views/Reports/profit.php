<?php try
{ ?>
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
         <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                  <ol class="breadcrumb">
                    <li><a href="#"><i aria-hidden="true"></i>Home</a></li>
                    <li><a href="#"><i aria-hidden="true">Reports</a></i></li>
                    <li class="active">Profit</li>
                    
                  </ol>
                </div><br><br>
               <!-- /.box-header -->
               <div class="box-body">
                    <div class="container">
                            <div class='col-sm-2 col-md-2'>
                                <div class="form-group">
                                    <div class="input-group">
                                      <input readonly="" id="datepicker" type="text" name="date1">
                                      <label class="input-group-addon btn" name=date1" for="date">
                                         <span class="fa fa-calendar"></span>
                                      </label>
                                    </div>
                                </div>
                            </div>

                              <div class="col-sm-1 col-md-1" style="margin-left: 5%;">
                                TO
                              </div>  
                                <div class='col-sm-2 col-md-2'>
                                  <div class="form-group">
                                      <div class="input-group">
                                        <input readonly="" id="datepickers" type="text" name="date2">
                                        <label  class="input-group-addon btn" name=date2" for="date">
                                           <span class="fa fa-calendar"></span>
                                        </label>
                                      </div>
                                  </div>
                                </div>
                                <div class='col-sm-2 col-md-2'>
                                  <span style="float:right;color:white;"><button id="button_id" class="btn btn-success" type="button"><b> GO...</b></button></span>
                                </div>
                </div>
                
                <div class="col-md-4 col-sm-4" id="profit_id" hidden style="color: white;">
                  <div class="small-box padding1010" style="background-color: #fa603d!important;">
                    <h4 class="bold">Profit/Loss</h4>
                    <i class="icon fa fa-star"></i>
                    <h4 class="bold" value="" id="ts">Total Sales : </h4>
                    <h4 class="bold" value="" id="tp">Total Purchase : </h4>
                    <h5 class="bold" value="" id="profit">Profit : </h5>
                    
                  </div>
                        




               </div>
               
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>
<?php 
}
catch(Exception $e)
{


}


 ?>

    <script>
   $(function () {
    $('#datepicker').datepicker({
      autoclose: true
    });
  });
    </script>


 <script type="text/javascript">
   $(function () {
    $('#datepickers').datepicker({
      autoclose: true
    });
  });

   $('#button_id').click(function()
   {
      
      var date1=  $('#datepicker').val();
      var date2=  $('#datepickers').val();

//      console.log('date 1:'+date1+'date2 :'+date2);
      if(date1==''  ||  date2=='')
      {
        //error
      }
      else
      {
        var date=
        {
          date1: date1,
          date2: date2
        };
        console.log(date);
        $.ajax({
              type:'POST',
              url:'date_selected',
              data: date,
              success:function(data)
              {
                data=JSON.parse(data);
                var ts=data.data.total_sales;
                var tp=data.data.total_purchase;
                $('#ts').append(ts);
                $('#tp').append(tp);
                $('#profit').append(ts-tp);
                $('#profit_id').show();    
              }
      })
    }


  })
 </script>

    

 