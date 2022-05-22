<?php
$interviewer_email_template = get_option('gp_interviewer_email_template');
$hr_email_template = get_option('gp_hr_email_template');
// print_r($hr_email_template);die;
$email_template = get_option('gp_email_template');
?>
<style>
    .abbreviations {
        border: 1px solid #d9d9db;
        border-radius: 4px;
    }
</style>
<div class="wrapper">
    <?php
require( plugin_dir_path( __FILE__ ) . '/templates/sidebar.php');
?>
    <div class="content-page">
        <!-- Start Content-->
        <div class="content">
            <div class="navbar-custom">
                <div id="top-bar">
                    <?php
                     require( plugin_dir_path( __FILE__ ) . '/templates/header.php');
                     ?>
                </div>
                <ul class="nav nav-tabs nav-bordered ">
                    <li class="nav-item ">
                        <a href="javascript:;" data-bs-toggle="tab " aria-expanded="false " class="nav-link active">
                            <i class="dripicons-user-group me-1 "></i>
                            <span class="d-none d-md-block ">Email Templates</span>
                        </a>
                    </li>

                </ul>
                <div class="col-md-12 px-0">
                    <ul class="nav nav-tabs nav-bordered  position-fixed w-100 bg-white shadow border-0">
                        <li class="nav-item">
                            <a href="#hr" data-bs-toggle="tab" aria-expanded="false" data-target="1"
                                class="nav-link active select-email-template">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">HR</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#candidate" data-bs-toggle="tab" aria-expanded="true" data-target="2"
                                class="nav-link select-email-template">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block"> Candidate</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#interviewer" data-bs-toggle="tab" aria-expanded="true" data-target="3"
                                class="nav-link select-email-template">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block"> Interviewer</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-title-box tab-content pt-3 pb-5" style="overflow: hidden;">
                <div class="tab-pane show active" id="hr">
                    <div class="gp-save-email-template-content pt-5 px-4 pe-0">
                        <label class="form-label">Subject <span class="required">*</span></label>
                        <div class="gp-save-editor">
                            <?php 
                                if($hr_email_template != ''){
                                    $subject = $hr_email_template['subject'];
                                }else{
                                    $subject = 'Interview with {{username}} for {{interview_for}} - {{interview_stage}} has been scheduled';
                                }
                            ?>
                            <input type="text" class="email-subject-hr form-control my-1" value="<?php echo $subject; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <label class="px-4 pe-0 form-label">Content</label>
                            <div class="gp-save-editor px-4 pe-0">
                                <!-- <textarea class="gp-email-composer"></textarea> -->
                                <?php 
                                $content  = file_get_contents( plugin_dir_path( __FILE__ ) . 'templates/emails/hr/hr.php');

                                if($hr_email_template != ''){
                                    $content = $hr_email_template['content'];
                                }
                                
                                $editor_id = 'gp-save-hr-form-editor';            
                                $settings = array(
                                    'editor_height' => 425, // In pixels, takes precedence and has no default value
                                    'textarea_rows' => 20,  // Has no visible effect if editor_height is set, default is 20
                                );
                                
                                wp_editor( $content, $editor_id,$settings);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-5 p-3">
                            <div class="abbreviations text-dark me-4 p-3">
                                <div class="row">
                                    <p class="py-2 fs-4 m-0"> <strong>Helpers</strong></p>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Hr name </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{hr_name}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>WebConference Url </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{webconference_url}} <small class="text-secondary">this will be shown only if selected online interview</small>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Stage of interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_stage}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Type of Interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_type}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Interview applied for </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_for}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Timings of interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_timing}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Location of interview </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_location}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Interview with </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{username}}
                                    </div>
                                </div>                                
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="tab-pane" id="candidate">
                    <div class="gp-save-email-template-content px-4 pe-0 pt-5">
                        <label class="form-label">Subject <span class="required">*</span></label>
                        <div class="gp-save-editor">
                            <?php 
                                if($email_template != ''){
                                    $subject = $email_template['subject'];
                                }else{
                                    $subject = 'Interview with {{username}} for {{interview_for}} - {{interview_stage}} has been scheduled';
                                }
                            ?>
                            <input type="text" class="email-subject form-control my-1" value="<?php echo $subject; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <label class="px-4 pe-0 form-label">Content</label>
                            <div class="gp-save-editor px-4 pe-0">
                                <!-- <textarea class="gp-email-composer"></textarea> -->
                                <?php 
                                $content  = file_get_contents( plugin_dir_path( __FILE__ ) . 'templates/emails/candidate/candidate.php');
                                        
                                if($email_template != ''){
                                    $content = $email_template['content'];
                                }

                                $editor_id = 'gp-save-form-editor';            
                                $settings = array(
                                    'editor_height' => 425, // In pixels, takes precedence and has no default value
                                    'textarea_rows' => 20,  // Has no visible effect if editor_height is set, default is 20
                                );
                                
                                wp_editor( $content, $editor_id,$settings);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-5 p-3">
                            <div class="abbreviations text-dark me-4 p-3">
                                <div class="row">
                                    <p class="py-2 fs-4 m-0"> <strong>Helpers</strong></p>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Candidate Name </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{username}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>WebConference Url </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{webconference_url}} <small class="text-secondary">this will be shown only if selected online interview</small>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Stage of interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_stage}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Type of Interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_type}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Interview applied for </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_for}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Timings of interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_timing}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Location of interview </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_location}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Additional Comments </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{additional_comments}}
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="interviewer">
                    <div class="gp-save-email-template-content px-4 pe-0 pt-5">
                        <label class="form-label">Subject <span class="required">*</span></label>
                        <div class="gp-save-editor">
                            <?php 
                                if($interviewer_email_template != ''){
                                    $subject = $interviewer_email_template['subject'];
                                }else{
                                    $subject = 'Interview with {{username}} for {{interview_for}} - {{interview_stage}} has been scheduled';
                                }
                            ?>
                            <input type="text" class="email-subject-interviewer form-control my-1" value="<?php echo $subject;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <label class="px-4 pe-0 form-label">Content</label>
                            <div class="gp-save-editor px-4 pe-0">
                                <!-- <textarea class="gp-email-composer"></textarea> -->
                                <?php 
                                $content  = file_get_contents( plugin_dir_path( __FILE__ ) . 'templates/emails/interviewer/interviewer.php');

                                if($interviewer_email_template != ''){
                                    $content = $interviewer_email_template['content'];
                                }
                                $editor_id = 'gp-save-interviewer-form-editor';
                                $settings = array(
                                    'editor_height' => 425, // In pixels, takes precedence and has no default value
                                    'textarea_rows' => 20,  // Has no visible effect if editor_height is set, default is 20
                                );
                                
                                wp_editor($content, $editor_id,$settings);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-5 p-3">
                            <div class="abbreviations text-dark me-4 p-3">
                                <div class="row">
                                    <p class="py-2 fs-4 m-0"> <strong>Helpers</strong></p>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Interviewer name </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interviewer}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>WebConference Url </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{webconference_url}} <small class="text-secondary">this will be shown only if selected online interview</small>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Stage of interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_stage}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Type of Interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_type}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Interview applied for </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_for}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Timings of interview </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_timing}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Location of interview </strong>
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{interview_location}}
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        <strong>Interview with </strong> 
                                    </div>
                                    <div class="col-md-6 fs-5 py-2">
                                        {{username}}
                                    </div>
                                </div>                                
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="gp-save-email-content-submit px-4 pe-0">
                    <div class="save-email-temp">
                        <button class="email-sub-btn btn btn-outline-primary end" data-value="1">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
