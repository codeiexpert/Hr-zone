<?php

    global $wpdb;

    
    // status
    $table_name = $wpdb->prefix."interview_status";
    $selectStatus = $wpdb->get_results("SELECT * FROM $table_name");

    // stages

    $table_name2 = $wpdb->prefix."interview_states";
    $selectStates = $wpdb->get_results("SELECT * FROM $table_name2");

    //posts
    $table_name3 = $wpdb->prefix."hr_zone_posts";
    $selectPosts = $wpdb->get_results("SELECT * FROM $table_name3");

?>
<style>
	.reschedule-interview {
		font-size: 14px;
		width: 100%;
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

	.inside {
		padding-top: 60px;
	}

	.pages td {
		text-align: center !important;
		padding: 4px !important;
	}

	.settings-tab .inner-content {
		border: 1px solid #d4cece;
		margin: 6px;
		padding: 10px;
		border-radius: 4px;
	}
	.settings-heading {
		border-bottom: 1px solid #ccc;
		border-top: 1px solid #ccc;
	}
</style>
<div class="wrapper">
	<?php
require(plugin_dir_path(__FILE__) . '/templates/sidebar.php');
?>
	<div class="content-page pt-4 pb-3">
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
						<div class="col-xl-12 col-lg-12">
							<div class="row">
								<div class="col-lg-9 px-1 col-md-8">
									<nav aria-label="breadcrumb" class="col-lg-9">
										<ol class="breadcrumb m-0 border-0">
											<li class="breadcrumb-item"><a href="javascript:;">Settings</a></li>
										</ol>
									</nav>									
								</div>
								<div class="col-md-12 px-0">
									<ul
										class="nav nav-tabs nav-bordered  position-fixed w-100 bg-white shadow border-0">
										<li class="nav-item">
											<a href="#hr" data-bs-toggle="tab" aria-expanded="false"
												class="nav-link active">
												<i class="mdi mdi-home-variant d-md-none d-block"></i>
												<span class="d-none d-md-block">HR</span>
											</a>
										</li>
									</ul>									
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="row mt-xl-5 mb-xl-0 my-5 pt-5 mx-0 px-3">
				<div class="col-xl-12  tab-content mt-3">
					<div class="tab-pane active show" id="hr">						
						<div class="row">
							<div class="col-md-12 settings-tab p-0">
								<div class="inner-content" id="status-settings">
									<div class="row m-0">
										<div class="heading py-2 d-flex">
											<div class="left flex-item">
												<h4 class="text-info">Interview Status<i
														class="uil uil-lock-open-alt text-success me-1"></i></h4>
											</div>
											<div class="right">
												<button class="btn btn-outline-primary add-status-button"
													onClick="showHideModal('#addStatusModal')"><i
														class="fa fa-plus-circle" aria-hidden="true"></i> Add
													Status</button>
											</div>
										</div>
									</div>
									<div class="row m-0 py-3 settings-heading">
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>#</label></div>
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>Status</label></div>
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>Action</label></div>
									</div>
									<?php
                                            if (!empty($selectStatus)) {
                                                $i = 1;
                                                foreach ($selectStatus as $list) {
                                                    ?>
									<div class="row m-0 status-content">
										<div class="col-md-4 col-sm-4 col-4 text-center py-2"><?php echo $i++; ?></div>
										<div class="col-md-4 col-sm-4 col-4 text-center py-2">
											<?php echo $list->status; ?></div>
										<div class="col-md-4 col-sm-4 col-4 text-center py-2">
											<button type="submit" name="delete_status"
												data-id="<?php echo $list->id; ?>"
												class="btn btn-danger btn-sm delete-setting" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete <?php echo $list->status; ?> Status"><i class="uil uil-trash-alt"
													aria-hidden="true"></i></button>
										</div>
									</div>
									<?php
                                                }
                                            }
                                        ?>
								</div>
							</div>
							<div class="col-md-12 settings-tab p-0">
								<div class="inner-content" id="posts-settings">
									<div class="row m-0">
										<div class="heading py-2 d-flex">
											<div class="left flex-item">
												<h4 class="text-info">Interview Post<i
														class="uil uil-lock-open-alt text-success me-1"></i></h4>
											</div>
											<div class="right">
												<button class="btn btn-outline-primary add-posts-button"
													onClick="showHideModal('#addPostModal')"><i
														class="fa fa-plus-circle" aria-hidden="true"></i> Add
													Post</button>
											</div>
										</div>
									</div>
									<div class="row m-0 py-3 settings-heading">
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>#</label></div>
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>Posts</label></div>
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>Action</label></div>
									</div>
									<?php
                                                if (!empty($selectPosts)) {
                                                    $i = 1;
                                                    foreach ($selectPosts as $list) {
                                                        ?>
									<div class="row m-0 posts-content">
										<div class="col-md-4 col-sm-4 col-4 text-center py-2"><?php echo $i++; ?></div>
										<div class="col-md-4 col-sm-4 col-4 text-center py-2"><?php echo $list->name; ?>
										</div>
										<div class="col-md-4 col-sm-4 col-4 text-center py-2">
											<button type="submit" name="delete_post" data-id="<?php echo $list->id; ?>"
												class="btn btn-danger delete-setting" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete <?php echo $list->name; ?> Post"><i class="uil uil-trash-alt"
													aria-hidden="true"></i></button>
										</div>
									</div>
									<?php
                                                    }
                                                }
                                            ?>
								</div>
							</div>
							<div class="col-md-12 settings-tab p-0">
								<div class="inner-content" id="stages-settings">
									<div class="row m-0">
										<div class="heading py-2 d-flex">
											<div class="left flex-item">
												<h4 class="text-info">Interview Stages<i
														class="uil uil-lock-open-alt text-success me-1"></i> </h4>
											</div>
											<div class="right">
												<button class="btn btn-outline-primary add-states-button"
													onClick="showHideModal('#addStageModal')"><i
														class="fa fa-plus-circle" aria-hidden="true"></i> Add
													Stage</button>
											</div>
										</div>
									</div>
									<div class="row m-0 py-3  settings-heading">
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>#</label></div>
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>Stages</label></div>
										<div class="col-md-4 col-sm-4 col-4 text-center"><label>Action</label></div>
									</div>
									<?php
                                                if (!empty($selectStates)) {
                                                    $i = 1;
                                                    foreach ($selectStates as $list) {
                                                        ?>
									<div class="row m-0 stages-content">
										<div class="col-md-4 col-sm-4 col-4 text-center py-2"><?php echo $i++; ?></div>
										<div class="col-md-4 col-sm-4 col-4 text-center py-2">
											<?php echo $list->states; ?></div>
										<div class="col-md-4 col-sm-4 col-4 text-center py-2">
											<button type="submit" name="delete_stage" data-id="<?php echo $list->id; ?>"
												class="btn btn-danger delete-setting" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete <?php echo $list->states; ?> Stage"><i class="uil uil-trash-alt"
													aria-hidden="true"></i></button>
										</div>
									</div>
									<?php
                                                    }
                                                }
                                            ?>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function () {

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


	});
</script>