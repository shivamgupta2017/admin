      <header class="main-header">
        <!-- Logo -->
       <a href="<?php echo base_url();?>/Dashboard_ctrl" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="hidden-xs"><?php $title = $this->session->userdata('title1');echo $title['title'];
		 //print_r($title);
		 ?></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
				
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">				          
                  <img src="<?php echo  $this->session->userdata('profile_pic1'); ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs">
                    <?php $a=$this->session->userdata('logged_in_adminw1');
					
                    echo $a['username'];?>
                  </span>
                </a>
				
				
			<?php
			//var_dump($this->session->userdata('profile_pics'));
			//exit();
			?>
                  <ul class="dropdown-menu">
                  <!-- User image --> 
                  <li class="user-header">
                      <img src="<?php echo $this->session->userdata('profile_pic1'); ?>" class="img-circle" alt="User Image">
					  <!--<img src="<?php //echo  $this->session->userdata('profile_pic'); ?>" class="user-image" alt="User Image">-->
                  </li>				  
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                   <li class="user-footer">
                   
    
						
					<div class="pull-left">
					<?php 
					//$profile_link = ($this->session->userdata('admin') == 1) ? base_url()."Profile_ctrl/admin_profile" : base_url()."Shopper_profile/view_shopper_profile";
					
					//$profile_link = ($this->session->userdata('admin') == 1) ? base_url()."Profile_ctrl/admin_profile" : base_url()."User_Profile_ctrl/view_user_profile" : base_url()."Shopper_profile/view_shopper_profile";
					if($this->session->userdata('admin1') == 1) 
					{
					    $profile_link =  base_url()."Profile_ctrl/admin_profile"; 
                    }
                    else if($this->session->userdata('admin1') == 2) 
				    {
                        $profile_link =  base_url()."Shopper_profile/view_shopper_profile";
				    }
                    else if($this->session->userdata('admin1') > 2)
				    {   
					   $profile_link = base_url()."User_profile_ctrl/view_user_profile";
                    }
					?>
                    
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
					 </div>
						

                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>
        </nav>
       
      </header>
