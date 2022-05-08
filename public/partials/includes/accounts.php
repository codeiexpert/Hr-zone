<?php

$user_data = get_userdata(get_current_user_id());
$user_meta = get_user_meta(get_current_user_id());

?>
<div class="wrapper">
    <?php
require(plugin_dir_path(__FILE__) . '/templates/sidebar.php');
?>
    <div class="content-page pt-4 pb-3">
        <div class="content">
            <div class="navbar-custom h-auto">
                <div id="top-bar">
                    <?php
                    require(plugin_dir_path(__FILE__) . '/templates/header.php');
                    ?>
                </div>
                <ul class="nav nav-tabs nav-bordered ">
                    <li class="nav-item ">
                        <a href="candidate.html" data-bs-toggle="tab " aria-expanded="false " class="nav-link active">
                            <i class="dripicons-user-group me-1 "></i>
                            <span class="d-none d-md-block "> My Account</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="row pt-5 mt-2 mx-0">
                <div class="col-md-11 m-auto">
                    <form action="" id="gp-edit-account" method="post">
                        <div class="form-group">
                            <label class="form-label" for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                value="<?php echo $user_meta['first_name'][0]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label pt-1" for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                value="<?php echo $user_meta['last_name'][0]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label pt-1" for="username">Username</label>
                            <input type="text" class="form-control" aria-describedby="usernameHelp" id="username"
                                value="<?php echo $user_data->data->user_login; ?>" disabled>
                            <small id="usernameHelp" class="form-text text-muted">Username Cannot be modified!</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label pt-1" for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email"
                                value="<?php echo $user_data->data->user_email; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label pt-1" for="lname">Display Name</label>
                            <input type="text" class="form-control" name="d_name"
                                value="<?php echo $user_data->data->display_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label pt-1" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Leave empty if don't want to change password">
                        </div>
                        <div class="form-group">
                            <label class="form-label pt-1" for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        <input type='submit' name='submit' value='Update' class='btn btn-outline-primary my-2'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('success')) {
        jQuery.iaoAlert({
            msg: urlParams.get('success'),
            type: "success",
            fadeOnHover: true,
            roundedCorner: true,
            zIndex: '9999999999',
            mode: "dark",
        });
        var uri = window.location.href.toString();
        if (uri.indexOf("&") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("&"));
            window.history.replaceState({}, document.title, clean_uri);
        }
    }

    if (urlParams.has('error')) {
        jQuery.iaoAlert({
            msg: urlParams.get('error'),
            type: "error",
            fadeOnHover: true,
            roundedCorner: true,
            zIndex: '9999999999',
            mode: "dark",
        });
        var uri = window.location.href.toString();
        if (uri.indexOf("&") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("&"));
            window.history.replaceState({}, document.title, clean_uri);
        }
    }
</script>