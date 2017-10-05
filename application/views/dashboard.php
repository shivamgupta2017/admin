<?php  
     $menu = $this->session->userdata('admin1');
?> 
<body class="skin-red sidebar-mini  pace-done">
<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
          <?php
                       if( $menu==1  )
                        {
                       ?>	
       <a href="<?php echo base_url(); ?>Sales_ctrl"> <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-cart-arrow-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"></span>
              <span class="info-box-number" style="color:#444 !important;">Sales</span>
            </div>
            <!-- /.info-box-content -->
            <span class="info-box-number" style="margin-left:100px;color:#444 !important;"> <?php echo $totals['orders'];?></span>
          </div>
          <!-- /.info-box -->
        </div></a>
          <?php } ?>
        <!-- /.col -->
          <?php
                       if( $menu==1  )
                        {
                       ?>	
         <a href="<?php echo base_url(); ?>Customer_ctrl"><div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"></span>
              <span class="info-box-number" style="color:#444 !important;">Clients</span>
            </div>
            <!-- /.info-box-content -->
            <span class="info-box-number" style="margin-left:100px;color:#444 !important;"> <?php echo $totals['customers'];?></span>
          </div>
          <!-- /.info-box -->
             </div></a>
          <?php } ?>
        <!-- /.col -->

        <!-- fix for small devices only -->
       

         <a href="<?php echo base_url(); ?>Product_ctrl/view_product"><div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"></span>
              <span class="info-box-number" style="color:#444 !important;">Products</span>
            </div>
            <!-- /.info-box-content -->
           <span class="info-box-number" style="margin-left:100px;color:#444 !important;"><?php echo $totals['products'];?></span>
          </div>
          <!-- /.info-box -->
             </div></a>
        <!-- /.col -->

        <a href="<?php echo base_url();?>Vendor_ctrl/view_vendors"> 
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-file-text"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number" style="color:#444 !important;">Vendors</span>
              </div>
              <span class="info-box-number" style="margin-left:100px;color:#444 !important;"><?php echo $totals['vendors'];?></span>
            </div>
          </div>
        </a>


      <a href="<?php echo base_url(); ?>reports_ctrl"> 
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-clipboard"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number" style="color:#444 !important;">Reports</span>
              </div>
            </div>
          </div>
        </a>
      </div>


      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Reports</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12"> 
                    <div class="box-header with-border">
                    <h3 class="box-title">Recent Orders</h3></div>
               <!--     <?php foreach($orders as $temp){ ?>-->
               <!--    <a href="http://localhost/Files/orders/view_order/506">-->
               <!--   <ul>-->
               <!--      <li>-->
               <!--         <div class="ale-list"> <i class="fa fa-list-ol"> </i></div>-->
               <!--      </li>-->
               <!--     <li><div class="box-header with-border">-->
               <!--     <h3 class="box-title"><?php echo ucfirst($temp->first_name).' '.($temp->last_name);?></h3></div></li>-->
               <!--   </ul>-->
               <!--</a>-->
               <!--  <?php }?>-->
                </div>
              <!--  <div class="col-md-6"> -->
              <!--      <div class="box-header with-border">-->
              <!--      <h3 class="box-title">Recent Subscriptions</h3></div>-->
              <!--      <?php foreach($subscriptions as $temp){ ?>-->
              <!--<a href="http://localhost/Files/orders/view_order/506">-->
              <!--    <ul>-->
              <!--       <li>-->
              <!--          <div class="ale-list"> <i class="fa fa-list-ol"> </i></div>-->
              <!--       </li>-->
              <!--       <li><div class="box-header with-border">-->
              <!--      <h3 class="box-title"><?php echo ucfirst($temp->first_name).' '.($temp->last_name);?></h3></div></li>-->
                   
              <!--    </ul>-->
              <!-- </a>-->
              <!--<?php }?>-->
              <!-- </div>-->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <!--<div class="box-footer">-->
            <!--  <div class="row">-->
            <!--    <div class="col-sm-3 col-xs-6">-->
            <!--      <div class="description-block border-right">-->
            <!--        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>-->
            <!--        <h5 class="description-header">$35,210.43</h5>-->
            <!--        <span class="description-text">TOTAL REVENUE</span>-->
            <!--      </div>-->
                  <!-- /.description-block -->
            <!--    </div>-->
                <!-- /.col -->
            <!--    <div class="col-sm-3 col-xs-6">-->
            <!--      <div class="description-block border-right">-->
            <!--        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>-->
            <!--        <h5 class="description-header">$10,390.90</h5>-->
            <!--        <span class="description-text">TOTAL COST</span>-->
            <!--      </div>-->
                  <!-- /.description-block -->
            <!--    </div>-->
                <!-- /.col -->
            <!--    <div class="col-sm-3 col-xs-6">-->
            <!--      <div class="description-block border-right">-->
            <!--        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>-->
            <!--        <h5 class="description-header">$24,813.53</h5>-->
            <!--        <span class="description-text">TOTAL PROFIT</span>-->
            <!--      </div>-->
                  <!-- /.description-block -->
            <!--    </div>-->
                <!-- /.col -->
            <!--    <div class="col-sm-3 col-xs-6">-->
            <!--      <div class="description-block">-->
            <!--        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>-->
            <!--        <h5 class="description-header">1200</h5>-->
            <!--        <span class="description-text">GOAL COMPLETIONS</span>-->
            <!--      </div>-->
                  <!-- /.description-block -->
            <!--    </div>-->
            <!--  </div>-->
              <!-- /.row -->
            <!--</div>-->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <!--<div class="row">-->
        <!-- Left col -->
      <!--  <div class="col-md-8">-->
          <!-- MAP & BOX PANE -->
 
          <!-- /.box -->
      <!--    <div class="row">-->
      <!--      <div class="col-md-6">-->
              <!-- DIRECT CHAT -->

              <!--/.direct-chat -->
      <!--      </div>-->
            <!-- /.col -->

           
            <!-- /.col -->
      <!--    </div>-->
          <!-- /.row -->


     
      <!--  </div>-->
        <!-- /.col -->

       
        <!-- /.col -->
  <!--    </div>-->
      <!-- /.row -->
  <!--  </section>-->
    <!-- /.content -->
  <!--</div>-->
  <!-- /.content-wrapper -->

  

  <!-- Control Sidebar -->
  <!--<aside class="control-sidebar control-sidebar-dark">-->
    <!-- Create the tabs -->
  <!--  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">-->
  <!--    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>-->
  <!--    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>-->
  <!--  </ul>-->
    <!-- Tab panes -->
  <!--  <div class="tab-content">-->
      <!-- Home tab content -->
  <!--    <div class="tab-pane" id="control-sidebar-home-tab">-->
  <!--      <h3 class="control-sidebar-heading">Recent Activity</h3>-->
  <!--      <ul class="control-sidebar-menu">-->
  <!--        <li>-->
  <!--          <a href="javascript:void(0)">-->
  <!--            <i class="menu-icon fa fa-birthday-cake bg-red"></i>-->

  <!--            <div class="menu-info">-->
  <!--              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>-->

  <!--              <p>Will be 23 on April 24th</p>-->
  <!--            </div>-->
  <!--          </a>-->
  <!--        </li>-->
  <!--        <li>-->
  <!--          <a href="javascript:void(0)">-->
  <!--            <i class="menu-icon fa fa-user bg-yellow"></i>-->

  <!--            <div class="menu-info">-->
  <!--              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>-->

  <!--              <p>New phone +1(800)555-1234</p>-->
  <!--            </div>-->
  <!--          </a>-->
  <!--        </li>-->
  <!--        <li>-->
  <!--          <a href="javascript:void(0)">-->
  <!--            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>-->

  <!--            <div class="menu-info">-->
  <!--              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>-->

  <!--              <p>nora@example.com</p>-->
  <!--            </div>-->
  <!--          </a>-->
  <!--        </li>-->
  <!--        <li>-->
  <!--          <a href="javascript:void(0)">-->
  <!--            <i class="menu-icon fa fa-file-code-o bg-green"></i>-->

  <!--            <div class="menu-info">-->
  <!--              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>-->

  <!--              <p>Execution time 5 seconds</p>-->
  <!--            </div>-->
  <!--          </a>-->
  <!--        </li>-->
  <!--      </ul>-->
        <!-- /.control-sidebar-menu -->

  <!--      <h3 class="control-sidebar-heading">Tasks Progress</h3>-->
  <!--      <ul class="control-sidebar-menu">-->
  <!--        <li>-->
  <!--          <a href="javascript:void(0)">-->
  <!--            <h4 class="control-sidebar-subheading">-->
  <!--              Custom Template Design-->
  <!--              <span class="label label-danger pull-right">70%</span>-->
  <!--            </h4>-->

  <!--            <div class="progress progress-xxs">-->
  <!--              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>-->
  <!--            </div>-->
  <!--          </a>-->
  <!--        </li>-->
  <!--        <li>-->
  <!--          <a href="javascript:void(0)">-->
  <!--            <h4 class="control-sidebar-subheading">-->
  <!--              Update Resume-->
  <!--              <span class="label label-success pull-right">95%</span>-->
  <!--            </h4>-->

  <!--            <div class="progress progress-xxs">-->
  <!--              <div class="progress-bar progress-bar-success" style="width: 95%"></div>-->
  <!--            </div>-->
  <!--          </a>-->
  <!--        </li>-->
  <!--        <li>-->
  <!--          <a href="javascript:void(0)">-->
  <!--            <h4 class="control-sidebar-subheading">-->
  <!--              Laravel Integration-->
  <!--              <span class="label label-warning pull-right">50%</span>-->
  <!--            </h4>-->

  <!--            <div class="progress progress-xxs">-->
  <!--              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>-->
  <!--            </div>-->
  <!--          </a>-->
  <!--        </li>-->
  <!--        <li>-->
  <!--          <a href="javascript:void(0)">-->
  <!--            <h4 class="control-sidebar-subheading">-->
  <!--              Back End Framework-->
  <!--              <span class="label label-primary pull-right">68%</span>-->
  <!--            </h4>-->

  <!--            <div class="progress progress-xxs">-->
  <!--              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>-->
  <!--            </div>-->
  <!--          </a>-->
  <!--        </li>-->
  <!--      </ul>-->
        <!-- /.control-sidebar-menu -->

  <!--    </div>-->
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
  <!--    <div class="tab-pane" id="control-sidebar-settings-tab">-->
  <!--      <form method="post">-->
  <!--        <h3 class="control-sidebar-heading">General Settings</h3>-->

  <!--        <div class="form-group">-->
  <!--          <label class="control-sidebar-subheading">-->
  <!--            Report panel usage-->
  <!--            <input type="checkbox" class="pull-right" checked>-->
  <!--          </label>-->

  <!--          <p>-->
  <!--            Some information about this general settings option-->
  <!--          </p>-->
  <!--        </div>-->
          <!-- /.form-group -->

  <!--        <div class="form-group">-->
  <!--          <label class="control-sidebar-subheading">-->
  <!--            Allow mail redirect-->
  <!--            <input type="checkbox" class="pull-right" checked>-->
  <!--          </label>-->

  <!--          <p>-->
  <!--            Other sets of options are available-->
  <!--          </p>-->
  <!--        </div>-->
          <!-- /.form-group -->

  <!--        <div class="form-group">-->
  <!--          <label class="control-sidebar-subheading">-->
  <!--            Expose author name in posts-->
  <!--            <input type="checkbox" class="pull-right" checked>-->
  <!--          </label>-->

  <!--          <p>-->
  <!--            Allow the user to show his name in blog posts-->
  <!--          </p>-->
  <!--        </div>-->
          <!-- /.form-group -->

  <!--        <h3 class="control-sidebar-heading">Chat Settings</h3>-->

  <!--        <div class="form-group">-->
  <!--          <label class="control-sidebar-subheading">-->
  <!--            Show me as online-->
  <!--            <input type="checkbox" class="pull-right" checked>-->
  <!--          </label>-->
  <!--        </div>-->
          <!-- /.form-group -->

  <!--        <div class="form-group">-->
  <!--          <label class="control-sidebar-subheading">-->
  <!--            Turn off notifications-->
  <!--            <input type="checkbox" class="pull-right">-->
  <!--          </label>-->
  <!--        </div>-->
          <!-- /.form-group -->

  <!--        <div class="form-group">-->
  <!--          <label class="control-sidebar-subheading">-->
  <!--            Delete chat history-->
  <!--            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>-->
  <!--          </label>-->
  <!--        </div>-->
          <!-- /.form-group -->
  <!--      </form>-->
  <!--    </div>-->
      <!-- /.tab-pane -->
  <!--  </div>-->
  <!--</aside>-->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->


