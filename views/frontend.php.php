<?php

$path = '/';
if(isset($_GET['path'])){
    $path = $_GET['path'];
}


if($path == '/'){
    if(is_user_logged_in()){
        require( plugin_dir_path( __FILE__ ) . 'includes/display-hr.php');
    }else{
        wp_safe_redirect(site_url().'/hr-zone/?path=login', 301);
        exit;
    }
    
}else if($path == 'candidates'){
    if(is_user_logged_in()){
        require( plugin_dir_path( __FILE__ ) . 'includes/schedule-interview.php');
    }else{
        wp_safe_redirect(site_url().'/hr-zone/?path=login', 301);
        exit;
    }
}else if($path == 'interview-details'){
    if(is_user_logged_in()){
        require( plugin_dir_path( __FILE__ ) . 'includes/interview-details-page.php');
    }else{
        wp_safe_redirect(site_url().'/hr-zone/?path=login', 301);
        exit;
    }    
}else if($path == 'settings'){
    if(is_user_logged_in()){
        require( plugin_dir_path( __FILE__ ) . 'includes/settings.php');
    }else{
        wp_safe_redirect(site_url().'/hr-zone/?path=login', 301);
        exit;
    }        
}else if($path == 'email-templates'){
    if(is_user_logged_in()){
        require( plugin_dir_path( __FILE__ ) . 'includes/emailTemplates.php');
    }else{
        wp_safe_redirect(site_url().'/hr-zone/?path=login', 301);
        exit;
    }  
    
}else if($path == 'my-account'){
    if(is_user_logged_in()){
        require( plugin_dir_path( __FILE__ ) . 'includes/accounts.php');
    }else{
        wp_safe_redirect(site_url().'/hr-zone/?path=login', 301);
        exit;
    }  
    
}else if($path == 'login'){
    if(is_user_logged_in()){
        wp_safe_redirect(site_url().'/hr-zone/', 301);
        exit;
    }else{
        require( plugin_dir_path( __FILE__ ) . 'includes/login.php');
    }    
}
?>
<script>

function showHideModal(id){
    jQuery(id).modal('toggle');
	}
jQuery('body').attr('data-layout-config', '{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}');
jQuery('body').attr('data-leftbar-theme', 'dark');
</script>
<!-- <script>
    // Client ID and API key from the Developer Console
    var CLIENT_ID = '1083753859155-fqa09lptq7t405ic6ripcuo2eqa8m9m7.apps.googleusercontent.com';
    var CLIENT_SECRET = '-tAut7x-U-s6HDyad19oekDt';
    var API_KEY = 'AIzaSyAcmRe25TYS2KoIjpVbPg_ZR3PaN3iXcQE';
    // Array of API discovery doc URLs for APIs used by the quickstart
    var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

    // Authorization scopes required by the API; multiple scopes can be
    // included, separated by spaces.
    var SCOPES = "profile email https://www.googleapis.com/auth/calendar";

    /**
     *  On load, called to load the auth2 library and API client library.
     */
    function init() {
        setTimeout(function () {
            gapi.load('auth2', function () {
                auth2 = gapi.auth2.init({
                    client_id: CLIENT_ID,
                    scope: SCOPES,
                    response_type: 'code',
                    access_type: 'offline'
                });

                jQuery(document).on('touchstart click', '#authorize_button', function (e) {
                    e.preventDefault();
                    auth2.grantOfflineAccess({
                        'redirect_uri': 'postmessage',
                        'prompt': 'consent'
                    }).then(onSignIn);
                });
            });

        }, 100);
    }

    function onSignIn(authResult) {
        // console.log(authResult);
        if (authResult['code']) {
            jQuery('#authorize_button').html('Authorizing...');
            jQuery('#authorize_button').addClass('disabled');
            jQuery.ajax({
                url: "https://accounts.google.com/o/oauth2/token",
                type: 'POST',
                data: {
                    code: authResult['code'],
                    client_id: CLIENT_ID,
                    client_secret: CLIENT_SECRET,
                    redirect_uri: 'postmessage',
                    grant_type: 'authorization_code'
                },
                dataType: 'JSON',
                success: function (authData) {
                    if (authData.access_token) {
                        setTimeout(function () {
                            var profile = gapi.auth2.getAuthInstance().currentUser.get()
                                .getBasicProfile();

                            jQuery.ajax({
                                url: WW_AJAX_OBJECT.ajax_url,
                                type: 'POST',
                                data: {
                                    action: "WW_SaveToken_Action",
                                    name: profile.getName(),
                                    email: profile.getEmail(),
                                    avatar: profile.getImageUrl(),
                                    access_token: authData.access_token,
                                    refresh_token: authData.refresh_token,
                                    expires_in: authData.expires_in,
                                    type: 'signIn',
                                },
                                dataType: 'JSON',
                                success: function (data) {
                                    jQuery('#authorize_button').html('ReAuthorize');
                                    jQuery('#authorize_button').removeClass('disabled');
                                    window.location.reload();
                                }
                            });
                        }, 500);
                    }
                }
            });
        }
    }
</script>
<script type="text/javascript" src="https://apis.google.com/js/platform.js?onload=init" async></script> -->
<?php
if( isset($_GET['ex']) && $_GET['ex'] == 'permission_denied'):  
?>
<script>

jQuery( document ).ready(function() {
        jQuery.iaoAlert({
            msg: "<strong>Permission Denied</strong>",
            type: "error",
            fadeOnHover: true,
            roundedCorner: true,
            zIndex: '9999999999',
            mode: "dark",
        });
        var uri = window.location.href.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
});

</script>
<?php
endif;
?>


