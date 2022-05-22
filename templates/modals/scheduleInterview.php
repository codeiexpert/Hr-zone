<!-- Schedule Interview modal -->
<div class="modal hide fade" id="interviewModalCenter" tabindex="-1"  data-bs-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">                
                        <div class="gp-save-top-content">
                            <div class="row">
                                <div class="col-md-6 non-reject-in">
                                    <div class="hr-date-picker">
                                        <div class="input-group">
                                            <div class="input-label w-100">
                                                <label for="hr-date-pick" id="select-date-label" class="form-label py-2 m-0">Select Date</label>
                                                <input type="text" readonly id="hr-date-pick" class="form-control" value="<?php if(isset($path) && $scheduledInterviewTableSql[0]->interview_datetime){echo $scheduledInterviewTableSql[0]->interview_datetime; }?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-label">
                                            <label for="hr-interview-posts" class="form-label py-2 m-0">Select Interview Post</label>
                                        </div>
                                        <div class="select-field">
                                        <select  id="hr-choose-posts-stage" class="form-control h-auto">
                                            <option value="">Choose Post</option>
                                            <?php 
                                                global $wpdb;
                                                $message = "";

                                                // status
                                                $table_name = $wpdb->prefix."hr_zone_posts";
                                                $selectPosts = $wpdb->get_results("SELECT * FROM $table_name");
                                                if(!empty($selectPosts)) {
                                                    foreach($selectPosts as $list) {
                                                                        ?>
                                            <option value="<?php echo $list->id?>" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->post == $list->id)){echo "selected"; }?>><?php echo $list->name?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 non-reject-in">
                                    <div class="input-label">
                                        <label for="hr-choose-interview-type" id="hr-choose-interview-type-label" class="form-label py-2 m-0">Select Interview Type</label>
                                    </div>
                                    <div class="input-field">
                                        <select  id="hr-choose-interview-type" class="form-control h-auto">
                                                <option value="OnSite" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->interview_type == 'On Site')){echo "selected"; }?> >On Site</option>
                                                <option value="Online" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->interview_type == 'Web conference')){echo "selected"; }?>>Online</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 non-reject-in" id="hr-interview-loc-content">
                                    <div class="input-label">
                                        <label for="hr-interview-location" class="form-label py-2 m-0">Add Interview Location</label>
                                    </div>
                                    <div class="input-field">
                                        <input type="text" id="hr-interview-location" value="Example Software Private Limited" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6" id="hr-interview-webconference-content" style="display:none;">
                                    <div class="input-label">
                                        <label for="hr-interview-webconference" class="form-label py-2 m-0">Add Interview WebConference Url</label>
                                    </div>
                                    <div class="input-field">
                                        <input type="text" id="hr-interview-webconference" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 non-reject-in">
                                    <div class="input-label">
                                        <label for="hr-choose-interview-timing" id="hr-choose-interview-timing-label" class="form-label py-2 m-0">Select Interview Timings</label>
                                    </div>
                                    <div class="select-field">
                                        <select  id="hr-choose-interview-timing" class="form-control h-auto">
                                                <option value="00:15:00" data-prop="15-minutes" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->interview_hours_mins == '15 minutes')){echo "selected"; }?>>15 minutes</option>
                                                <option value="00:30:00" data-prop="30-minutes" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->interview_hours_mins == '30 minutes')){echo "selected"; }?>>30 minutes</option>
                                                <option value="01:00:00" data-prop="1-hour" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->interview_hours_mins == '1 hour')){echo "selected"; }?>>1 hour</option>
                                                <option value="01:30:00" data-prop="1-hour-30-minutes" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->interview_hours_mins == '1 hour 30 minutes')){echo "selected"; }?>>1 hour 30 minutes</option>
                                                <option value="02:00:00" data-prop="2-hours" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->interview_hours_mins == '2 hours')){echo "selected"; }?>>2 hour</option>
                                        </select>
                                    </div>  
                                </div>
                                <div class="col-md-6 non-reject-in">
                                    <div class="input-label">
                                        <label for="hr-interview-stage" class="form-label py-2 m-0">Select Interview Stage</label>
                                    </div>
                                    <div class="select-field">
                                        <select  id="hr-choose-interview-stage" class="form-control h-auto">
                                            <option value="">Choose Stage</option>
                                            <?php 
                                                global $wpdb;
                                                $message = "";

                                                // status
                                                $table_name = $wpdb->prefix."interview_states";
                                                $selectStates = $wpdb->get_results("SELECT * FROM $table_name");
                                                if(!empty($selectStates)) {
                                                    foreach($selectStates as $list) {
                                                                        ?>
                                            <option value="<?php echo $list->id?>" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->stage == $list->id)){echo "selected"; }?>><?php echo ucfirst($list->states) ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-label">
                                        <label for="hr-interview-status" class="form-label py-2 m-0">Select Interview Status</label>
                                    </div>
                                    <div class="select-field">
                                        <select  id="hr-choose-interview-status" class="form-control h-auto">
                                            <option value="">Choose Status</option>
                                            <?php 
                                                global $wpdb;
                                                $message = "";

                                                // status
                                                $table_name = $wpdb->prefix."interview_status";
                                                $selectStatus = $wpdb->get_results("SELECT * FROM $table_name");
                                                if(!empty($selectStatus)) {
                                                    foreach($selectStatus as $list) {
                                                                        ?>
                                            <option value="<?php echo $list->id?>" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->status == $list->id)){echo "selected"; }?>><?php echo ucfirst($list->status) ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-label">
                                        <label for="hr-interview-interviewer" class="form-label py-2 m-0">Select Interviewer</label>
                                    </div>
                                    <div class="input-field">
                                        <select  id="hr-choose-interviewer" class="form-control h-auto">
                                            <option value="">Choose Interviewer</option>
                                        <?php 
                                            $args = array('orderby' => 'display_name');
                                            $wp_user_query = new WP_User_Query($args);
                                            $users = $wp_user_query->get_results();
                                        
                                            if(!empty($users)) {
                                                foreach($users as $user) {
                                                                    ?>
                                        <option value="<?php echo $user->data->ID?>" <?php if(isset($path) && ($scheduledInterviewTableSql[0]->interviewer == $user->data->ID)){echo "selected"; }?>><?php echo ucfirst($user->data->display_name) ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-label">
                                        <label for="gp-additonal-comments" id="comments-label" class="form-label py-2 m-0">Additional Comments</label>
                                    </div>
                                    <div class="gp-save-editor">
                                        <textarea id="gp-additonal-comments" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="interview-btn-sec">
                                        <a href="javascript:;" class=" my-2 btn btn-outline-primary interview-save-btn">Schedule Interview</a>
                                </div>
                            </div>       
                        </div>                                        
                    </div>
                    <div class="gp-submit-email-content px-3" style="display:none;">
                        <div class="mail-subject">
                            <div class="py-2 align-items-center gap-2 float-end" id="notify-sec" style="display:none;">
                                <input class="form-check-input" name="notify" type="checkbox" value="" id="notify-status" >
                                <label class="form-check-label" for="notify-status">
                                    Send notification to candidate
                                </label>
                            </div>  
                            <label for="gp-mail-subject" class="py-2 m-0">Subject <span class="required">*</span></label>
                            <div class="input">
                                <input type="text" id="gp-mail-subject" class="w-100 form-control">
                            </div>
                              
                        </div>	
                        <div class="mail-content">
                            <label class="py-2 m-0">Email Content</label>
                            <?php                    
                                $content  = '';
                                if(isset($path) && ($scheduledInterviewTableSql[0]->comments)){
                                    $content = $scheduledInterviewTableSql[0]->comments; 
                                }
                                $editor_id = 'gp-save-mail-send';           
                                $settings = array('editor_class'=>'send-mail-editor', 'editor_height' => 425 ); 
                                
                                wp_editor( stripslashes($content), $editor_id, $settings );
                            ?>	 
                                    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" my-2 btn btn-outline-primary interview-save-btn">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>    


          <!-- Create Form modal -->
       <div class="modal hide fade create-form-hr" id="createForm" tabindex="-1"  aria-labelledby="createFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFormLabel">Create Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>									

                <form method="post" id="create-form-hr">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="custom-form-title" class="form-label">Form Title</label>
                            <input type="text" name="form_title"  id="custom-form-title" class="form-control custom-form-title" autocomplete = "off" required/>
                        </div>                             
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="save_form_title" class="btn btn-outline-primary" value="Submit">
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!-- Send Mail modal -->
       <div class="modal hide fade" data-bs-backdrop="static" id="send-mail-hr" tabindex="-1"  aria-labelledby="createFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendMailFormLabel">Send Mail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>									

                <form method="post" id="send-mail-hr-form">
                    <div class="modal-body">
                        <div class="form-group py-1">
                            <input type="hidden" name="user-email" id="hr-user-email" value="">
                            <input type="hidden" name="user-name" id="hr-user-name" value="">
                            <input type="hidden" name="hr-user-post" id="hr-user-post" value="">
                            <label for="send-mail-subject" class="form-label">Subject <span class="required">*</span></label>
                            <input type="text" name="mail_subject"  id="hr-user-subject" class="form-control" autocomplete = "off" required/>
                        </div> 
                        <div class="form-group py-1">
                            <label for="send-mail-subject" class="form-label">Message <span class="required">*</span></label>
                            <?php                    
                                $content  = '';
                                $editor_id = 'hr-user-msg';           
                                $settings = array('editor_class'=>'hr-user-msg', 'editor_height' => 425 ); 
                                wp_editor( stripslashes($content), $editor_id, $settings );
                            ?>	  
                        </div>                             
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="send_mail_form" class="btn btn-outline-primary" value="Send Mail">
                    </div>
                </form>
                </div>
            </div>
        </div>

         <!-- Check All Rating Modal -->
       <div class="modal hide fade"  data-bs-backdrop="static" id="all-ratings-table" tabindex="-1"  aria-labelledby="allRatingsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allRatingsLabel">All Ratings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>									
                <div class="modal-body">
                            <table class="table all-ratings-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Ratings</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>                     
                </div>
                </div>
            </div>
        </div>

    <!-- Rating Reason -->
       <div class="modal hide fade" id="rating-reason" tabindex="-1" data-bs-backdrop="static" aria-labelledby="ratingReasonLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingReasonLabel">Reason for rating</h5>
                    <button type="button" class="btn-close close-reason-md" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>									
                <form method="post" id="add-rating-reason">
                    <div class="modal-body">
                        <div class="form-group py-1">
                            <input type="hidden" name="entryId" id="entryId" value="">
                            <input type="hidden" name="rating" id="rating" value="">
                            <label for="reason-for-rating" class="form-label">Reason <span class="required">*</span></label>
                            <input type="text" name="reason-for-rating"  id="reason-for-rating" class="form-control" autocomplete = "off" required/>
                        </div>                                                    
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="Rate" class="btn btn-outline-primary" value="Rate">
                    </div>
                </form>
                </div>
            </div>
        </div>

    