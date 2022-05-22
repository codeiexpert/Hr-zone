<?php

    global $wpdb;
    
    $table_name = $wpdb->prefix."scheduled_interviews";
    $selectSql = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");
    
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
    




?>

<style>
   #hr-zone-schedule-admin-table_length select {
      width: 60px !important;
   }

   .hr-sm-3 {
      width: 32%;
      float: left;
   }

   #hr-zone-schedule-admin-table_filter input {
      background: #fff;
   }
</style>
<div class="wrapper">
   <?php
require(plugin_dir_path(__FILE__) . '/templates/sidebar.php');
?>
   <div class="content-page">
      <!-- Start Content-->
      <div class="content">
         <div class="navbar-custom">
            <div id="top-bar">
               <?php
                     require(plugin_dir_path(__FILE__) . '/templates/header.php');
                     ?>
            </div>
         </div>
         <ul class="nav nav-tabs nav-bordered ">
            <li class="nav-item ">
               <a href="javascript:;" data-bs-toggle="tab " aria-expanded="false " class="nav-link active">
                  <i class="dripicons-user-group me-1 "></i>
                  <span class="d-none d-md-block ">Scheduled Interviews</span>
               </a>
            </li>

         </ul>
      </div>
      <div class="page-title-box ">
         <div class="tab-pane show active" id="dash">
            <div class="row m-0 pt-2 pb-3">

               <!--content start-->
               <div class="px-3 mt-n1 scheduled-int-details pt-3" >
                     <table id="hr-zone-schedule-admin-table" class="table table-condensed">
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Post</th>
                              <th>Timing</th>
                              <th>Interviewer</th>
                              <th>Status</th>
                              <th>Stage</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                                 if (!empty($selectSql)) {
                                     foreach ($selectSql as $list) {
                                         ?>
                                      
                           <tr>
                              <td><?php echo $list->name; ?></td>
                              <td><?php echo $list->email; ?></td>
                              <td><?php if (isset($allPostsArray[$list->post])) {
                                             echo $allPostsArray[$list->post];
                                         } else {
                                             echo "Deleted Post";
                                         } ?></td>
                              <td>
                              <?php if (isset($list->interview_datetime)) {
                                       echo $list->interview_datetime;
                                    } else {
                                       echo "-";
                                    } 
                                    ?>
                              </td>
                              <td>
                              <?php if (isset($list->interviewer)) {
                                       $the_user = get_user_by('id', $list->interviewer);
                                       echo $the_user->display_name;
                                    } else {
                                       echo "-";
                                    } 
                                    ?>
                              </td>
                              <td><?php if (isset($allStatusArray[$list->status])) {
                                             echo $allStatusArray[$list->status];
                                         } else {
                                             echo "Deleted Status";
                                         } ?></td>
                              <td>
                                 <?php  $rejection_arr = ['offer-rejected','rejected', 'withdrawn'];
                                 if(isset($allStatusArray[$list->status]) && $allStatusArray[$list->status]){
                                    if(in_array($allStatusArray[$list->status], $rejection_arr)){
                                       if (isset($allStagesArray[$list->stage])) {
                                          echo $allStagesArray[$list->stage];
                                      } else {
                                          echo "-";
                                      }
                                    }else{
                                       if (isset($allStagesArray[$list->stage])) {
                                          echo $allStagesArray[$list->stage];
                                      } else {
                                          echo "Deleted Stage";
                                      }
                                    }
                                 }
                                 ?></td>
                              <td>
                              <a href="<?php echo site_url()?>/hr-zone/?path=interview-details&id=<?php echo $list->id; ?>"
                                    class='btn btn-outline-primary'>Details</a>
                                    
                                    </td>
                           </tr>
                           <?php
                                     }
                                 }
                              ?>
                        </tbody>
                     </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<script type="text/javascript">
   jQuery(document).ready(function () {
      if(jQuery('#hr-zone-schedule-admin-table').length > 0){
         jQuery('#hr-zone-schedule-admin-table').DataTable({
            responsive: true,
            columnDefs: [{
                  responsivePriority: 1,
                  targets: 0
               },
               {
                  responsivePriority: 2,
                  targets: -1
               },
               { "orderable": false, "targets": [-1] }
            ]            
         });
      jQuery('#hr-zone-schedule-admin-table_length label').contents().filter((_, el) => el.nodeType === 3).remove();
      jQuery('#hr-zone-schedule-admin-table_length label').prepend(' Show Entries ');
      // jQuery('#hr-zone-schedule-admin-table_filter label').contents().filter((_, el) => el.nodeType === 3).remove();
      // jQuery('#hr-zone-schedule-admin-table_filter').prepend(
      //    '<label style="float: left;" class="mx-1">Search</label><br>');
         
      }

   });
</script>