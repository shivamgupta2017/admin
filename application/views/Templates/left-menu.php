<?php  
     $menu = $this->session->userdata('admin1');
?>  
  <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
	      <div class="user-panel">
            <div class="pull-left image">
              <img  style="border:1px solid #aaa;"src="<?php echo $this->session->userdata('profile_pic1'); ?>" class="user-image left-sid" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('logged_in_adminw1')['username']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
		        <ul class="sidebar-menu"> 
			     <!-- <li class="nav-header">Main Menu</li>-->
                        <!--<li><a class="ajax-link" href="<?php //echo base_url(); ?>dashboard"><i class="glyphicon glyphicon-dashboard"></i><span> Dashboard</span></a> </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-user"></i><span> Manage Users</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="<?php //echo base_url(); ?>users/add">Add Users</a></li>
                                <li><a href="<?php //echo base_url(); ?>users/view">View Users</a></li>
                            </ul>
                        </li>
                       
						
                        <li>
                            <a href="<?php //echo base_url(); ?>shop/gallery"><i class="glyphicon glyphicon-picture"></i><span> Manage Package</span></a>
                        </li>-->
                        <?php
						$menus = user_menu();
						//var_dump($menus);
						$super_admin = $this->session->userdata('admin1');
						if($super_admin == 1) {
						  foreach($menus as $menu) {
							//echo $menu['name']."<br>";
							if($menu['super_admin']) {
							$menu_class = ($menu['submenu']) ? "accordion" : "rootmenu";
							?>
							<li class="<?php echo $menu_class; ?>">
							  <a href="<?php echo base_url().$menu['url']; ?>">
								<i class="<?php echo $menu['icon']; ?>"></i> <span><?php echo $menu['name']; ?></span>
							  </a>
							  <?php
							  if($menu['submenu']) {
							  ?>
								<ul class="nav nav-pills nav-stacked">
								  <?php
									$submenu = json_decode($menu['submenu_items']);
									//var_dump($menu['submenu_items']);
									foreach($submenu as $sub_menu) {
									  ?>
									  <li>
										<a href="<?php echo base_url().$sub_menu->url; ?>">
										  <?php echo $sub_menu->name; ?>
										</a>
									  </li>
									  <?php
									}
								  ?>
								</ul>
							  <?php
							  }
							}
							  ?>
							</li>
                            
							<?php
						  }
						  ?>
                          <!--<li class="rootmenu">-->
                          <!--      <a href="<?php echo base_url(); ?>roles/index">-->
                          <!--          <i class="fa fa-rub" aria-hidden="true"></i><span>Roles</span>-->
                          <!--      </a>-->
                          <!--  </li>-->
                            <!--<li class="rootmenu">
                                <a href="<?php echo base_url(); ?>websiteinfo">
                                    <i class="glyphicon glyphicon-cog"></i> <span>Website Info</span>
                                </a>
                            </li>-->
                           <?php
						}
						else {
						  $role = $this->session->userdata('logged_in_adminw1')['user_type'];
						  $user_caps = get_capabilities($role);
						  foreach($menus as $menu) {
							$menu_class = ($menu['submenu']) ? "accordion" : "rootmenu";
							if(array_intersect($user_caps, $menu['capabilities']) or in_array("basic_cap", $menu['capabilities'])) {
							?>
							<li class="<?php echo $menu_class; ?>">
							  <a href="<?php echo base_url().$menu['url']; ?>">
								<i class="fa fa-arrows-alt<?php echo $menu['icon']; ?>"></i> <span><?php echo $menu['name']; ?></span>
								
							  </a>
							  <?php
							  if($menu['submenu']) {
							  ?>
								<ul class="nav nav-pills nav-stacked">
								  <?php
									$submenu = json_decode($menu['submenu_items']);
									foreach($submenu as $sub_menu) {							
									  if(in_array($sub_menu->cap, $user_caps)) {  
									  ?>
									  <li>
										<a href="<?php echo base_url().$sub_menu->url; ?>">
										  <?php echo $sub_menu->name; ?>
										</a>
									  </li>
									  <?php
									}
									}
								  ?>
								</ul>
							  <?php
							  }
							  ?>
							</li>
							<?php
							}
						  }
						}
					  ?>
					  <!--<li class="rootmenu">-->
       <!--                         <a href="<?php echo base_url(); ?>Help_ctrl/view_help">-->
       <!--                             <i class="fa fa-arrows-alt"></i> <span>Help</span>-->
       <!--                         </a>-->
       <!--                     </li>-->
			</ul>
		  


        </section>
    <!-- /.sidebar -->
</aside>