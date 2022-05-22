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
.table-custom{
display: none;
}
.loader{
   position: absolute;
    right: 1%;
    top: 21%;
}
.hyperlink p {
   color: #717982;
}
.gp-hr-form-dropdown::after{
   display: none !important;
}
.gp-hr-form-menu{
   min-width: 100%;
}
</style>

<div class="wrapper">
<?php
require(plugin_dir_path(__FILE__) . 'templates/sidebar.php');
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
      <li class="nav-item">
         <a href="#dash" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
            <i class="dripicons-user-group me-1"></i>
            <span class="d-none d-md-block ">Candidates</span>
         </a>
      </li>
      <!-- <li class="nav-item">
         <a href="#job-post" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
            <i class="dripicons-user-group me-1 "></i>
            <span class="d-none d-md-block ">Job Posting</span>
         </a>
      </li> -->
   </ul>
</div>
<div class="page-title-box tab-content pt-3">
   <div class="tab-pane show active" id="dash">
      <div class="row m-0 pt-2 pb-3">
         <div class="page-sort px-3">
            <div class="row pb-3">
               <div class="col-md-9" style="position:relative;">
                  <label for="gp-form-select-hr" class="form-label">Select Form</label>
                  <div class="btn-group  w-100">
                     <input type="hidden" id="selected-form-id" value="">
                  <a class="form-control dropdown-toggle form-control gp-hr-form-dropdown" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                     Select Form to show data
                  </a>
                  <ul class="dropdown-menu  gp-hr-form-menu">
                  <?php
                              $selected_form_id = '';
                              $selected_forms = get_option('hr_selected_forms');
                              if (isset($selected_forms) && $selected_forms != '') {
                                 $j=0; 
                              ?>
                              <?php
                                 foreach ($selected_forms as $form) {
                                       $form_data = GFAPI::get_form($form);
                                       if ($form_data['is_active'] != 0 && $form_data['is_trash'] == 0) {
                                          $form_id = $form_data['id'];
                                          if ($j == 0) {
                                             $selected_form_id = $form_id;
                                          }
                                          
                                          $entry_count = GFAPI::count_entries( $form_id );
                                          $entries = GFAPI::get_entries( $form_id );

                                          $read_data = get_option('entry_read_status');
					                           $read_count = 0;
                                          $unread_count = 0;

                                          foreach($entries as $entry){
                                             if(isset($read_data[$entry['id']])){
                                                $read_count++;                                                
                                             }else{
                                                $unread_count++;
                                             }
                                          }
                                          $label = $form_data['title']; 
                                          ?>
                                          <li data-value="<?php echo $form_id; ?>" class="gp-form-select-hr"><button class="dropdown-item" type="button"><?php echo $label; ?> <span class="float-end px-3"><span class="badge bg-danger badge-<?php echo $form_id; ?>-1">Total Unread Entries: <span><?php echo $unread_count ?></span></span> <span class="badge bg-success badge-<?php echo $form_id; ?>-2">Total Read Entries: <span><?php echo $read_count ?></span></span> <span class="badge bg-info badge-<?php echo $form_id; ?>-3">Total Entries: <span><?php echo $entry_count ?></span></span></span></button></li>
                              <?php
                                    }
                                    $j++;
                                 }
                              } else {
                                    ?>
                        <li>No Form Has Been Assigned</li>
                     <?php
                              }
                              ?>
                  </ul>
                  </div>
               </div>
               <div class="col-md-3 hr-form-select px-0 text-center gp-edit-form-sec d-flex align-items-md-end gap-2 position-relative">
                  <?php if (isset($selected_forms) && $selected_forms != '') { ?>
                  <a href="javascript:;" data-href="<?php echo home_url() ?>/wp-admin/admin.php?page=gf_edit_forms" class="btn btn-outline-primary px-3 gp-edit-form"> <i class="uil uil-file-upload-alt"
                        aria-hidden="true"></i> Edit Form </a>
                  <?php } ?>
                  <?php
                     $forms = GFAPI::get_forms();
                     $form_id = 0;
                     foreach ($forms as $form):
                        if (isset($form['cssClass']) && $form['cssClass'] == 'custom-duplicacy-form'):
                           $form_id = $form['id'];
                        endif;
                     endforeach;

                     if ($form_id != 0):
                  ?>
                  <a href="javascript:;" class="gp-create-form btn btn-outline-primary px-3"><i class="uil uil-file-edit-alt"
                        aria-hidden="true"></i> Create Form</a>
                  <?php
                     endif;
                  ?>
               </div>
            </div>
            <!--content start-->
            <div class="mt-1">
               <div class="table-custom">
                  <table id="hr-selected-form-table" class="table table-condensed w-100">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                        <tr>
                           <th scope="col">#</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- <div class="tab-pane" id="job-post">
      <div class="row m-0 pt-2 pb-3">
         <div class="page-sort px-3">
            <div class="row">
               <div class="mt-1">
                  <div class="table-custom">
                     <a target="_blank" href="<?php echo site_url().'/wp-admin/post-new.php?post_type=jobs_post&type=hr&post_add=1'?>"
                        class="gp-create-jobpost btn btn-outline-primary mb-3"><i class="uil uil-envelope-edit"
                           aria-hidden="true"></i> Create Job Post</a>
                     <a target="_blank" href="<?php echo site_url().'/career/'?>"
                        class="gp-create-jobpost btn btn-outline-primary mb-3 float-end "><i class="uil uil-presentation-check"
                           aria-hidden="true"></i> Check All Job Post Here</a>
                     <table id="hr-job-post-table" class="table table-condensed w-100">
                        <thead>
                           <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Title</th>
                              <th scope="col">Post Author</th>
                              <th scope="col">Post Date</th>
                              <th scope="col">Post Status</th>
                              <th scope="col">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Title</th>
                              <th scope="col">Post Author</th>
                              <th scope="col">Post Date</th>
                              <th scope="col">Post Status</th>
                              <th scope="col">Action</th>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->
</div>

<?php
if( isset($_GET['post_trashed']) || isset($_GET['post_added']) || isset($_GET['post_updated']) ):  
   $type = 'success';
   if($_GET['post_trashed'] != ''){
      $msg = 'Post moved to trash successfully.';
      $type = 'error';
   }else if($_GET['post_added'] != ''){
      $msg = 'Post added successfully.';
   }else if($_GET['post_updated'] != ''){
      $msg = 'Post updated successfully.';
   }
?>
<script>

jQuery( document ).ready(function() {
        jQuery.iaoAlert({
            msg: '<strong><?php echo $msg; ?><strong>',
            type: "<?php echo $type; ?>",
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
<script>
   jQuery(document).ready(function () {

      
      //Open selecte tba on page refresh
      jQuery("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
         var id = jQuery(e.target).attr("href").substr(1);
         localStorage.setItem('selectedTab', id);
         jQuery('#hr-selected-form-table').DataTable().columns.adjust().responsive.recalc();
         jQuery('#hr-job-post-table').DataTable().columns.adjust().responsive.recalc();
      });
      // on load of the page: switch to the currently selected tab
      var selectedTab = localStorage.getItem('selectedTab');
      jQuery('.nav-tabs a[href="#' + selectedTab + '"]').tab('show');

   })
</script>