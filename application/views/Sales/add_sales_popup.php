		<div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
				<div class="box-header with-border">
         <h3 class="box-title"></h3>
         <div class="box-tools pull-right">
             
            <button class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
            <i class="fa fa-minus"></i>
            </button>
         </div>
      </div>
            <form id="add-vendor">
                <div class="box-body">
                    <!--<form role="form" action=<?php echo base_url()."Purchase_ctrl/add_vendor"?> method="post" data-parsley-validate="" enctype="multipart/form-data">-->
                 <div class="col-md-6">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control required" required="" name="vendor_name">
                     <br>
                      <label for="exampleInputEmail1">Mobile</label>
                    <input type="text" class="form-control required" required="" name="mobile">
                     <br>
                      <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control required" required="" name="address">
                     <br>
                      <label for="exampleInputEmail1">State</label>
                    <input type="text" class="form-control required"  required="" name="state">
                     <br>
                      <label for="exampleInputEmail1">Country</label>
                    <input type="text" class="form-control required"  required="" name="country">
                     <br>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">Contect Person</label>
                    <input type="text" class="form-control required"  required="" name="contect_person">
                     <br>
                      <label for="exampleInputEmail1">Phone</label>
                    <input type="text" class="form-control required"  required="" required="" name="phone">
                     <br>
                      <label for="exampleInputEmail1">City</label>
                    <input type="text" class="form-control required"  required="" name="city">
                     <br>
                      <label for="exampleInputEmail1">Zipcode</label>
                    <input type="text" class="form-control required"  required="" name="zipcode">
                     <br>
                     <label for="exampleInputEmail1">Provider Of</label>
                    <input type="text" class="form-control required"  required="" name="provider_of">
                     <br>
                </div>
                     <button type="submit"  class="mybtn btn-submit"><i class="fa fa-check"></i>Save</button>
                  <!--</dl>-->
                </div>
             </form>
                <!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- ./col -->
          </div>  
		 <script>
$('#add-vendor').on('submit',function(){  
    var data = $(this).serialize();
$.ajax({
method : "POST",
url : "<?php echo base_url()."Purchase_ctrl/add_vendor"?>",
data : $(this).serialize(),
beforeSend : function(){
$(".block-ui").css('display','block'); 
},success : function(data){ 
    data = JSON.parse(data);
if(data != ''){  
     $('#vendor').append($('<option>', {
    text: data.vendor_name,
    value:data.vendor_id
}));
     $('#popup-addvendor').modal('hide');
}else{
alert('Unable to Add Vendor');
$(".block-ui").css('display','none');
}   
}});    
return false;
});
		 </script>
		  