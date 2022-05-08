<?php
if (!isset($_GET['id']) || $_GET['id'] == '') {
    die();
}

global $wpdb;
$j = 1;
$message = "";

$scheduledInterviewID = $_GET['id'];

$scheduledInterviewTable = $wpdb->prefix . "scheduled_interviews";
$scheduledInterviewTableSql = $wpdb->get_results("SELECT * FROM $scheduledInterviewTable WHERE id = " . $scheduledInterviewID);

//historydata
$entryId = $scheduledInterviewTableSql[0]->entryId;
$scheduledInterviewHistoryTable = $wpdb->prefix."scheduled_interviews_history";
$scheduledInterviewHistorySql = $wpdb->get_results("SELECT * FROM $scheduledInterviewHistoryTable WHERE entryId = $entryId  ORDER BY created_at DESC");

//new scheduled events
$entryId = $scheduledInterviewTableSql[0]->entryId;
$rescheduledInterviewTable = $wpdb->prefix."rescheduled_interviews";
$rescheduledInterviewSql = $wpdb->get_results("SELECT * FROM $rescheduledInterviewTable WHERE entryId = $entryId  ORDER BY created_at ASC");



$table_status = $wpdb->prefix.'interview_status';
$selectStatusSql = $wpdb->get_results("SELECT * FROM $table_status");

$allStatusArray = [];
foreach ($selectStatusSql as $list) {
    $allStatusArray[$list->id] = $list->status;
}

$table_stages = $wpdb->prefix.'interview_states';
$selectStagesSql = $wpdb->get_results("SELECT * FROM $table_stages");

$allStagesArray = [];
foreach ($selectStagesSql as $list) {
    $allStagesArray[$list->id] = $list->states;
}

$table_posts = $wpdb->prefix.'hr_zone_posts';
$selectPostsSql = $wpdb->get_results("SELECT * FROM $table_posts");

$allPostsArray = [];
foreach ($selectPostsSql as $list) {
    $allPostsArray[$list->id] = $list->name;
}
$user_data = array();
$entry = GFAPI::get_entry($scheduledInterviewTableSql[0]->entryId);
$form_data = GFAPI::get_form($entry['form_id']);
$user_data['form_name'] = $form_data['title'];
$user_data['entryId'] = $entry['id'];
foreach ($form_data['fields'] as $key => $field) {
    if ($field['cssClass'] == 'email') {
        $user_data['email'] = $entry[$field['id']];
    }
    if ($field['label'] == 'First Name' || $field['label'] == 'Name') {
        $user_data['fname'] = $entry[$field['id']];
    }
    if ($field['label'] == 'Middle Name') {
        $user_data['mname'] = $entry[$field['id']];
    }
    if ($field['label'] == 'Last Name') {
        $user_data['lname'] = $entry[$field['id']];
    }

    if ($field['label'] == 'Phone') {
        $user_data['phone'] = $entry[$field['id']];
    }

    if ($field['label'] == 'Mobile') {
        $user_data['mobile'] = $entry[$field['id']];
    }
}

$i = 1;
?>
<style>
    h2.hr-box-head {
        border: solid 1px #ccc;
        display: block;
        height: 30px;
        margin: 0px;
        padding: 10px;
        line-height: 30px;
    }

    .form-label {
        font-weight: bold;
    }

    .flex-item {
        flex: 1 1 auto;
    }

    .wp-list-histroy {
        background: #dedcdc85;
        padding: 15px;
        border-radius: 4px;
    }

    tr.divide td {
        border-bottom: 1px solid #c3c4c7;
    }

    .user-info-section,
    .row.scheduled-in,
    .stg-stat-update {
        border: 1px solid #d4cece;
    }
    .sta-stg-up	 .form-label{
		margin-bottom: 0;
	}
</style>
<div class="wrapper">
    <?php
require(plugin_dir_path(__FILE__) . '/templates/sidebar.php');
?>
    <div class="content-page pt-4">
        <!-- Start Content-->
        <div class="content">
            <div class="navbar-custom h-auto">
                <div id="top-bar">
                    <?php
                require(plugin_dir_path(__FILE__) . '/templates/header.php');
                ?>
                </div>
                <div class="page-header">
                    <div class="row w-100 bd-gray-100 border-top border-bottom mx-0">
                        <div class="col-xl-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-9 px-1 col-md-8">
                                    <nav aria-label="breadcrumb" class="col-lg-9">
                                        <ol class="breadcrumb m-0 border-0">
                                            <li class="breadcrumb-item"><a
                                                    href="<?php echo site_url().'/hr-zone?path=candidates'; ?>">Scheduled
                                                    Interviews</a></li>
                                            <li class="breadcrumb-item active semi-bold text-info" aria-current="page">
                                                Edit</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-3 py-2 text-end">
                            <button type="button" class="btn btn-outline-primary reschedule-interview"
                                data-entry='<?php echo json_encode($user_data); ?>' >Schedule
                                Another Interview</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-xl-5 mb-xl-0 my-5 mx-0 px-2 py-3 mb-3">
                <?php foreach ($scheduledInterviewTableSql as $scheduledInterview): ?>
                <div class="postbox ">
                    <input type="hidden" class="entryDetail" value="<?php echo $scheduledInterviewID; ?>">
                    <div class="inside">
                        <!-- User Information Table -->
                        <div class="user-information">
                            <div class="heading-section">
                                <h4 class="text-info">User Information <i
                                        class="uil uil-lock-open-alt text-success me-1"></i>
                            </div>
                            <div class="row user-info-section m-0 py-3 px-2">
                                <div class="col-md-4 py-1">
                                    <div class="user-name">
                                        <label class="form-label text-info">Name</label>
                                        <p class="text-secondary m-0"><?php echo $scheduledInterview->name; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="user-email">
                                        <label class="form-label text-info">Email</label>
                                        <p class="text-secondary m-0"><?php echo $scheduledInterview->email; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="user-post">
                                        <label class="form-label text-info">Post</label>
                                        <p class="text-secondary m-0">
                                            <?php if (isset($allPostsArray[$scheduledInterview->post])) {
                    echo $allPostsArray[$scheduledInterview->post];
                } else {
                    echo "Deleted Post";
                } ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="user-pb-at">
                                        <label class="form-label text-info">Published at</label>
                                        <p class="text-secondary m-0">
                                            <?php echo date("m D Y, h:i a", strtotime($scheduledInterview->created_at)); ?>
                                        </p>
                                    </div>
                                </div>     
                                <div class="col-md-4 py-1">
                                    <div class="user-stage">
                                        <label for="gp-change-stage" class="form-label text-info">Stage</label>
                                        <p class="text-secondary m-0">
                                        <?php
                                        $rejection_arr = ['offer-rejected','rejected', 'withdrawn'];
                                            if (in_array(strtolower($allStatusArray[$scheduledInterview->status]), $rejection_arr))  {

                                                echo ucfirst($allStatusArray[$scheduledInterview->status]);

                                            }else {
                                                if(isset($allStagesArray[$scheduledInterview->stage])) {
                                                    echo ucfirst($allStagesArray[$scheduledInterview->stage]);
                                                }   
                                            ?>
                                            <a href="javascript:;" id="gp-change-stage" class="gp-change-stage"
                                                onClick="showHideModal('#changeStageModal')" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Change Stage"><i
                                                    class="uil uil-edit-alt" aria-hidden="true"></i></a>

                                            <?php   
                                            }                          
                                        ?>
                                            
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="user-status">
                                        <label for="gp-change-status" class="form-label text-info">Status</label>
                                        <p class="text-secondary m-0">
                                            <?php if (isset($allStatusArray[$scheduledInterview->status])) {
                    echo ucfirst($allStatusArray[$scheduledInterview->status]);
                }?>
                                            <a href="javascript:;" id="gp-change-status" class="gp-change-status"
                                                onClick="showHideModal('#changeStatusModal')" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Change Status"><i
                                                    class="uil uil-edit-alt" aria-hidden="true"></i>
                                            </a>
                                        </p>
                                        <?php if ((trim($scheduledInterview->reason) != '') && ($allStatusArray[$scheduledInterview->status] == 'rejected' || $allStatusArray[$scheduledInterview->status] == 'withdrawn' || $allStatusArray[$scheduledInterview->status] == 'offer-rejected')): ?>
                                        <small> <strong class="text-info">Reason: </strong> <span class="text-secondary main-reason"><?php echo $scheduledInterview->reason; ?></span></small>
                                        <?php endif; ?>
                                    </div>
                                </div>                                                        
                            </div>
                        </div>

                        <!-- Scheduled Interviews Table -->
                        <div class="scheduled-interviews pt-3">
                            <div class="scheduled-in-header">
                                <h4 class="text-info">Scheduled Information <i
                                        class="uil uil-lock-open-alt text-success me-1"></i> </h4>
                            </div>

                            <?php
                    foreach ($rescheduledInterviewSql as $rescheduled):
                ?>
                            <div class="row scheduled-in interview<?php echo $rescheduled->id; ?> m-0 py-3 px-2 mb-3">
                                <div class="interview-head">
                                    <h4 class="text-info mb-3">Interview #<?php echo $j; ?></h4>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-dt">
                                        <label class="form-label text-info">Interview date & time</label>
                                        <p class="text-secondary m-0">
                                            <?php echo date("m D Y, h:i a", strtotime($rescheduled->interview_datetime)); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-duration">
                                        <label class="form-label text-info">Interview duration</label>
                                        <p class="text-secondary m-0">
                                        
                                        <?php 
                                        if(!empty($rescheduled->interview_hours_mins) ){
                                            echo $rescheduled->interview_hours_mins; 
                                        }else{
                                            echo "-";
                                        }
                                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-stage">
                                        <label class="form-label text-info">Interview stage</label>
                                        <p class="text-secondary m-0">
                                        <?php
                                        $rejection_arr = ['offer-rejected','rejected', 'withdrawn'];
                                            if (in_array(strtolower($allStatusArray[$rescheduled->status]), $rejection_arr))  {

                                                echo ucfirst($allStatusArray[$rescheduled->status]);

                                            }else {
                                                if (isset($allStagesArray[$rescheduled->stage])) {
                                                    echo ucfirst($allStagesArray[$rescheduled->stage]);
                                                } else {
                                                    echo "Deleted Stage";
                                                }  
                                            }                          
                                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-type">
                                        <label class="form-label text-info">Interview type</label>
                                        <p class="text-secondary m-0">
                                        <?php 
                                        if(isset($rescheduled->interview_type)){
                                            echo $rescheduled->interview_type; 
                                        }else{
                                            echo "-";
                                        }
                                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-location">
                                        <label class="form-label text-info">Interview location</label>
                                        <p class="text-secondary m-0">
                                        <?php 
                                        if(isset($rescheduled->location)){
                                            echo $rescheduled->location; 
                                        }else{
                                            echo "-";
                                        }
                                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-status">
                                        <label class="form-label text-info">Interview status</label>
                                        <p class="text-secondary m-0">
                                            <?php if (isset($allStatusArray[$rescheduled->status])) {
                    echo ucfirst($allStatusArray[$rescheduled->status]);
                } else {
                    echo "Deleted Status";
                } ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-type">
                                        <label class="form-label text-info">Interviewer</label>
                                        <p class="text-secondary m-0">
                                            <?php
                                if ($rescheduled->interviewer > 0) {
                                    $the_user = get_user_by('id', $rescheduled->interviewer);
                                    if ($the_user) {
                                        echo $the_user->display_name;
                                    }else{
                                        echo 'Deleted User';
                                    }
                                }
                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-location">
                                        <label class="form-label text-info">Scheduled By</label>
                                        <p class="text-secondary m-0">
                                            <?php
                            if ($rescheduled->userId > 0) {
                                $the_user = get_user_by('id', $rescheduled->userId);
                                if ($the_user) {
                                    echo ucfirst($the_user->display_name);
                                }else{
                                    echo 'Deleted User';
                                }
                            }
                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 py-1">
                                    <div class="int-status">
                                        <label class="form-label text-info">Published at</label>
                                        <p class="text-secondary m-0">
                                            <?php echo date("m D Y, h:i a", strtotime($rescheduled->created_at)); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                    $j++;
                    endforeach;
                ?>

                        </div>


                        <!-- Status-Stage-Table -->
                        <div class="sta-stg-up pt-3">
                            <div class="history-heading">
                                <h4 class="text-info">
                                    Status/Stage Updates <i class="uil uil-lock-open-alt text-success me-1"></i>
                                </h4>
                            </div>

                            <?php
                    if (!empty($scheduledInterviewHistorySql)):
                     
                    foreach ($scheduledInterviewHistorySql as $history):
                        
                    if ($history->remark == 'Changed Status'):
                ?>
                            <div class="row m-0 stg-stat-update px-2 py-1 mb-2">
                                <div class="col-md-4">
                                    <div class="changed-sts">
                                        <label class="form-label text-info">Changed Status</label>
                                        <p class="text-secondary m-0">
                                            <?php if (isset($allStatusArray[$history->value])) {
                                                echo ucfirst($allStatusArray[$history->value]);
                                            } else {
                                                echo "Deleted Status";
                                            } ?>
                                        </p>
                                        <?php if ((trim($history->reason) != '') && ($allStatusArray[$history->value] == 'rejected' || $allStatusArray[$history->value] == 'withdrawn' || $allStatusArray[$history->value] == 'offer-rejected')): ?>
                                        <small><strong class="text-info">Reason: </strong> <span class="text-secondary"><?php echo $history->reason; ?> </span></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="changed-by">
                                        <label class="form-label text-info">Changed By</label>
                                        <p class="text-secondary m-0">
                                            <?php
                                            if ($history->userId > 0) {
                                                    $the_user = get_user_by('id', $history->userId);
                                                    if ($the_user) {
                                                        echo ucfirst($the_user->display_name);
                                                    }else{
                                                        echo 'Deleted User';
                                                    }
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="changed-on">
                                        <label class="form-label text-info">Changed On</label>
                                        <p class="text-secondary m-0">
                                            <?php echo date("m D Y, h:i a", strtotime($history->created_at)); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php elseif ($history->remark == 'Changed Stage'): ?>
                            <div class="row m-0 stg-stat-update px-2 py-1 mb-2">
                                <div class="col-md-4">
                                    <div class="changed-stage">
                                        <label class="form-label text-info">Changed Stage</label>
                                        <p class="text-secondary m-0">
                                            <?php if (isset($allStagesArray[$history->value])) {
                                    echo $allStagesArray[$history->value];
                                } else {
                                    echo "Deleted Stage";
                                } ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="changed-by">
                                        <label class="form-label text-info">Changed By</label>
                                        <p class="text-secondary m-0">
                                            <?php if ($history->userId > 0) {
                                                $the_user = get_user_by('id', $history->userId);
                                                if ($the_user) {
                                                    echo ucfirst($the_user->display_name);
                                                }else{
                                                    echo 'Deleted User';
                                                }
                                            }
                                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="changed-on">
                                        <label class="form-label text-info">Changed On</label>
                                        <p class="text-secondary m-0">
                                            <?php echo date("m D Y, h:i a", strtotime($history->created_at)); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach;
                    else:
                ?>
                            <div class="col-md-12">
                                <div class="no-history-d">
                                    <p class="text-secondary m-0" style="text-align: center">No History Available</p>
                                </div>
                            </div>
                            <?php endif ?>

                        </div>
                    </div>
                </div>
                <?php
            $i++;
            endforeach;
        ?>
            </div>
        </div>
    </div>
</div>
<script>
    // jQuery( document ).ready(function() {
    //     $('.current').remove();
    // 	jQuery('.gp-change-status').on('click', function() {
    // 		jQuery('#changeStatusModal').show();
    // 	});
    // 	jQuery('.gp-change-stage').on('click', function() {
    // 		jQuery('#changeStageModal').show();
    // 	});

    // 	jQuery('a.close-reveal-modal').on('click', function() {
    // 		jQuery('#changeStageModal').hide();
    // 		jQuery('#changeStatusModal').hide();
    // 	});



    // });
</script>