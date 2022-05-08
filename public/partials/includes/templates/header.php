<div class="row bg-white m-0 px-2" id="top-bar">
   <div class="col-md-6 col-5 align-items-sm-center d-flex">
      <button class="button-menu-mobile open-left disable-btn d-md-none">
         <i class="mdi mdi-menu"></i>
      </button>
      <a href="<?php echo site_url().'/hr-zone/'?>" class="logo">
         <span class="logo-lg">
            <h4>HR Zone</h4>
         </span>
      </a>
   </div>
   <?php
      $path = '/';
      if(isset($_GET['path'])){
            $path = $_GET['path'];
      }

      if($path != 'login'):
         $current_user = wp_get_current_user();
         $name = $current_user->data->display_name;
   ?>
   <div class="col-md-6 col-7 p-0">
      <ul class="list-unstyled topbar-menu float-end mb-0">
         <li class="top-nav-separator"></li>
         <li class="dropdown notification-list mx-2">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
               role="button" aria-haspopup="false " aria-expanded="false " style="display:flex;align-items: center;"> 
               <h6 class="text-overflow text-dark m-0 fs-5">Welcome <?php echo $name; ?>!</h6>
               
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
               <!-- item-->
               <a href="<?php echo site_url()?>/hr-zone/?path=my-account" class="dropdown-item notify-item">
                  <i class="mdi mdi-account-circle me-1"></i>
                  <span>My Account</span>
               </a>
               <!-- item-->
               <a href="<?php echo wp_logout_url(site_url().'/hr-zone/?path=login'); ?>"
                  class="dropdown-item notify-item ">
                  <i class="mdi mdi-logout me-1 "></i>
                  <span>Logout</span>
               </a>
            </div>
         </li>
      </ul>
   </div>
   <?php
      endif;
   ?>
</div>