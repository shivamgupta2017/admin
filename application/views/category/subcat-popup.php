
<style>
#layoutsss {
    -ms-transform: rotate(20deg); /* IE 9 */
    -webkit-transform: rotate(20deg); /* Safari */
    transform: rotate(270deg); /* Standard syntax */
}
@media (min-width: 768px) {
.col-sm-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: 992px) {
    .col-md-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: 1200px) {
    .col-lg-15 {
        width: 20%;
        float: left;
    }
}
.col-md-20 {
					width:20%;
					float:left;
					min-height: 1px;
    				padding-left: 15px;
   					padding-right: 15px;
    				position: relative;
				}
				.col-md-40 {
					width:40%;
					float:left;
					min-height: 1px;
    				padding-left: 15px;
   					padding-right: 15px;
    				position: relative;
				}
				.nopadding {
					padding:0px !important;
				}
</style>

		<div class="row">
         <!-- ./col -->
            
            <div class="col-md-6">
              <div class="box box-primary">
                <button class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse" style="float:right;">
            <i class="fa fa-minus" ></i>
            </button>                
                <div class="box-body">
                  <dl>
                    <dt>SubCategory Name</dt>
                    <dd><?php echo $data->sub_cat_name; ?></dd>
					<dt>Category Name</dt>
                    <dd><?php echo $data->category_name; ?></dd>
                   
                  </dl>
                </div><!-- /.box-body -->	  
	  
	  
          
              </div><!-- /.box -->
			  
            </div><!-- ./col -->
			 <div class="col-md-6">
              <div class="box box-primary">
                 <button class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse" style="float:right;">
            <i class="fa fa-minus" ></i>
            </button>               
                <div class="box-body">
                  <dl>
                   
					<dt>SubCategory Image</dt>
                    <dd><img src="<?php echo base_url().$data->image ?>" width="200px"></td></dd>
                   
                  </dl>
                </div><!-- /.box-body -->	  
	  
	  
          
              </div><!-- /.box -->
			  
            </div><!-- ./col -->

			
			
          </div>  
		 
		
		
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> 
  <script src="<?php echo base_url();?>assets/js/app-test.js"></script>
		  