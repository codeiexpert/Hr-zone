<?php
require(plugin_dir_path(__FILE__) . '/templates/header.php');
   
if ($_POST) {
    global $wpdb;
   
    //We shall SQL escape all inputs
    $username = $wpdb->escape($_REQUEST['username']);
    $password = $wpdb->escape($_REQUEST['password']);
    $remember = isset( $_REQUEST['rememberme']) ? $wpdb->escape($_REQUEST['rememberme']) : '';
    // print_r($_REQUEST);die;
   
    if ($remember) {
        $remember = "true";
    } else {
        $remember = "false";
    }
   
    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    $login_data['remember'] = $remember;
   
    $user_verify = wp_signon($login_data, false);
    if (is_wp_error($user_verify)) {
        echo "<div class='row m-0'><div class='col-md-4 m-auto'><div class='alert alert-danger text-center'>Invalid login details <span style='float:right' onclick=removeElement(this)>X</span></div></div></div>";
    // Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.
    } else {
        global $hr_role;
        $user_role = $user_verify->roles;
        // print_r(site_url());die;
        if (in_array($hr_role, $user_role)) {
            wp_safe_redirect(site_url() ."/hr-zone/", 301);
        } else {
            wp_safe_redirect(site_url()."/", 301);
        }
        exit();
    }
} else {
   
    // No login details entered - you should probably add some more user feedback here, but this does the bare minimum
   
    //echo "Invalid login details";
}
 ?>
<div class="row m-0">
    <form id="login1" name="form" action="" method="post">
        <h3 class="text-center">HR LOGIN</h3>
        <div class="col-md-4 hr-login-form m-auto py-3">
            <div class="form-group py-1">
                <input id="username" type="text" class="form-control" placeholder="Username" name="username">
            </div>
            <div class="form-group py-1">
                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
            </div>
            <div class="form-group py-1">
                <input id="remember_me" type="checkbox" class="form-check-input" name="rememberme">
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>
            <div class="form-group py-1">
                <input id="submit" class="btn btn-outline-primary" type="submit" name="submit" value="Login">
            </div>
        </div>
    </form>
</div>
<script>
    function removeElement(ele) {

        jQuery(ele).parent().remove();
    }
</script>