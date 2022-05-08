 <!-- Add Post modal -->
 <div class="modal hide fade settings-form" id="addPostModal" tabindex="-1"  data-bs-backdrop="static" aria-labelledby="addPostModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPostModalLabel">Add New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>									

                <form method="post" class="settings-save">
                    <div class="modal-body">                
                        <p>
                            <input type="text" name="post" value="" placeholder="Post" class="form-control settings-val" autocomplete = "off" required/>
                        </p>           
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="save_posts" class="btn btn-outline-primary" value="Save">
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Add Stage modal -->
        <div class="modal hide fade settings-form" id="addStageModal" tabindex="-1"  data-bs-backdrop="static" aria-labelledby="addStageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStageModalLabel">Add New Stage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>									

                <form method="post" class="settings-save">
                    <div class="modal-body">                
                        <p>
                            <input type="text" name="stage" value="" placeholder="Stage" class="form-control settings-val" autocomplete = "off" required/>
                        </p>           
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="save_stage" class="btn btn-outline-primary" value="Save">
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!-- Add Status modal -->
        <div class="modal hide fade settings-form" id="addStatusModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="addStatusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStatusLabel">Add New Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>									

                <form method="post" class="settings-save">
                    <div class="modal-body">                
                        <p>
                            <input type="text" name="status" value="" placeholder="status" class="form-control settings-val" autocomplete = "off" required/>
                        </p>           
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="save_status" class="btn btn-outline-primary" value="Save">
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Google Login Status modal -->
       <div class="modal hide fade check-google-login" id="checkGoogleStatus" tabindex="-1" data-bs-backdrop="static" aria-labelledby="checkGoogleStatusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-info modal-title" id="checkGoogleStatusLabel">Google Login Status<i class="uil uil-lock-open-alt text-success me-1"></i> </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        $table_name = $wpdb->prefix."gsign_in_status";
                        $checkLoginStatus = $wpdb->get_results("SELECT * FROM $table_name");
                        if (!empty($checkLoginStatus)):
                    ?>
                    <div class="user-info">
                        <div class="inner-content d-flex">
                            <div class="user_avatar pb-2">
                                <img src="<?php echo $checkLoginStatus[0]->avatar;?>"
                                    alt="profile_img">
                            </div>
                            <div class="info-inner px-2">
                                <div class="user_name pb-2">
                                    <label>Name: </label>
                                    <span><?php echo $checkLoginStatus[0]->username;?></span>
                                </div>
                                <div class="user_email pb-2">
                                    <label>Email: </label>
                                    <span><?php echo $checkLoginStatus[0]->email;?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            else:
                    ?>
                        <p class="text-center">Please login your google account to sync with google calendar</p>
                    <?php
                        endif;
                    ?>        
                </div>
                <div class="modal-footer">
                    
                    <?php
                        if (!empty($checkLoginStatus)):                            
                    ?>
                        <div class="user_signout">
                            <button class="btn btn-outline-primary" id="authorize_button"><i
                                    class="fa fa-refresh" aria-hidden="true"></i>
                                ReAuthorize</button>
                        </div>
                    <?php
                        else:
                    ?>
                        <button class="btn btn-outline-primary" id="authorize_button"><i class="fa fa-refresh" aria-hidden="true"></i> Authorize</button>
                    <?php
                        endif;
                    ?>       
                </div>
                </div>
            </div>
        </div>