<?php
// @ini_set( 'display_errors', 1 );
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://localhost
 * @since      1.0.0
 *
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/public
 * @author     Expert Coder Singh <codeiexpert82@gmail.com>
 */
class Custom_Gp_Save_Form_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Gp_Save_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Gp_Save_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if(is_page('hr-zone')){
			// wp_enqueue_style( 'jquery-style', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-gp-save-form-public.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'fancybox', plugin_dir_url( __FILE__ ) . 'css/fancybox.min.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'iao-alert', plugin_dir_url( __FILE__ ) . 'css/iao-alert.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'datetimepicker', plugin_dir_url( __FILE__ ) . 'css/jquery.datetimepicker.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'icons', plugin_dir_url( __FILE__ ) . 'css/icons.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'app', plugin_dir_url( __FILE__ ) . 'css/app.min.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'datatable-style', plugin_dir_url( __FILE__ ) . 'css/dataTable/dataTables.bootstrap5.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'datatable-responsive-style', plugin_dir_url( __FILE__ ) . 'css/dataTable/responsive.bootstrap5.min.css', array(), $this->version, 'all' );

			
		}
		
		}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Gp_Save_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Gp_Save_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		

		if(is_page('hr-zone')){		
			
		
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-gp-save-form-public.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'datatable-public-1', plugin_dir_url( __FILE__ ) . 'js/dataTable/bootstrap.bundle.min.js', $this->version, false );
			wp_enqueue_script( 'moment-min-public', plugin_dir_url( __FILE__ ) . 'js/moment.min.js', $this->version, false );
		
			
			// wp_enqueue_script( 'google-jquery-ui-public', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.min.js', $this->version, false );save
			wp_enqueue_script( 'iao-alert-min-public', plugin_dir_url( __FILE__ ) . 'js/iao-alert.jquery.min.js', $this->version, false );
			wp_enqueue_script( 'datetimepicker-min-public', plugin_dir_url( __FILE__ ) . 'js/jquery.datetimepicker.full.min.js', $this->version, false );
			wp_enqueue_script( 'sweet-alert', plugin_dir_url( __FILE__ ) . 'js/sweet-alert.min.js', $this->version, false );

			wp_enqueue_script( 'fancybox-min-public', plugin_dir_url( __FILE__ ) . 'js/fancybox.umd.js', $this->version, false );	
			wp_enqueue_script( 'datatable-public-2', plugin_dir_url( __FILE__ ) . 'js/dataTable/jquery.dataTables.min.js', $this->version, false );	
			wp_enqueue_script( 'datatable-public-3', plugin_dir_url( __FILE__ ) . 'js/dataTable/dataTables.bootstrap5.min.js', $this->version, false );	
			wp_enqueue_script( 'datatable-public-4', plugin_dir_url( __FILE__ ) . 'js/dataTable/dataTables.responsive.min.js', $this->version, false );	
			wp_enqueue_script( 'datatable-public-5', plugin_dir_url( __FILE__ ) . 'js/dataTable/responsive.bootstrap5.min.js', $this->version, false );		
			wp_enqueue_script( 'validate', plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', $this->version, false );		
			wp_enqueue_script( 'additional-methods', plugin_dir_url( __FILE__ ) . 'js/additional-methods.min.js', $this->version, false );		
			
		}
		
		
		

		wp_localize_script($this->plugin_name, 'WW_AJAX_OBJECT', array('admin_url' => admin_url(), 'ajax_url' => admin_url('admin-ajax.php')));

	}

	// public function Custom_gp_save_form_shortcode(){

	// 	ob_start();
	// 	include_once 'partials/custom-gp-save-form-public-display.php';
	// 	$ret = ob_get_contents();
	// 	ob_end_clean();
	// 	return $ret;
		
	// }
	
	
//HR_ZONE_FUNCTIONS_START

	//Deque Unnecessary Style

	// public function project_dequeue_unnecessary_styles() {
	// 	if (is_page('hr-zone')) {
	// 		if (!isset($_GET['path']) || ( isset($_GET['path']) && $_GET['path'] != 'login')) {
	// 			//FullStyle.css
	// 			wp_dequeue_style('theme-styles');
	// 			wp_deregister_style('theme-styles');
	// 			//ThemeOption.css
	// 			wp_dequeue_style('theme-options');
	// 			wp_deregister_style('theme-options');
	// 			//Style.css
	// 			wp_dequeue_style('mk-style');
	// 			wp_deregister_style('mk-style');
	// 			//core style.css
	// 			wp_dequeue_style('core-styles');
	// 			wp_deregister_style('core-styles');

	// 			//enque editor css
	// 			wp_enqueue_style('editor', '/wp-includes/css/editor.min.css',false,'all');	
	// 			wp_enqueue_style('media-view-hr', '/wp-includes/css/media-views.min.css',false,'all');			
					
	// 		}
	// 	}
	// 	//enqueue admin bar css
	// 	wp_enqueue_style('admin-min-bar', '/wp-includes/css/admin-bar.min.css', false, 'all');
	// 	wp_enqueue_style('dashicon', '/wp-includes/css/dashicons.min.css',false,'all');
	// }
	// public function project_dequeue_unnecessary_scripts() {
	// 	if (is_page('hr-zone')) {
	// 		wp_dequeue_script( 'ubermenu' );
	// 		wp_deregister_script( 'ubermenu' );

	// 		wp_dequeue_script( 'core-scripts' );
	// 		wp_deregister_script( 'core-scripts' );

	// 		wp_dequeue_script( 'components-full' );
	// 		wp_deregister_script( 'components-full' );

	// 		wp_dequeue_script( 'smoothscroll' );
	// 		wp_deregister_script( 'smoothscroll' );
	// 	}
	
	// }

	public function hrZoneFunction() { 
	  //Public
	
	  if(is_page('hr-zone')){    
		global $wpdb; 
		  if(isset($_GET['path']) && $_GET['path'] == 'interview-details' ){
			
			$path = $_GET['path'];
			$id = $_GET['id'];
			$table = $wpdb->prefix . "scheduled_interviews";
			$scheduledInterviewTableSql = $wpdb->get_results("SELECT * FROM $table WHERE id = " . $id );
			$table_stages = $wpdb->prefix.'interview_states';
			$selectStagesSql = $wpdb->get_results( "SELECT * FROM $table_stages");        
			$table_status = $wpdb->prefix.'interview_status';
			$selectStatusSql = $wpdb->get_results( "SELECT * FROM $table_status");
		  }
			if(isset($_GET['path']) && $_GET['path'] == 'interview-details'):
				include_once 'partials/includes/templates/modals/changeStatusStage.php';
			endif;
			if(isset($_GET['path']) && $_GET['path'] == 'settings'):
				include_once 'partials/includes/templates/modals/settings.php';
			endif;
			if((isset($_GET['path']) && $_GET['path'] == 'interview-details') || !isset($_GET['path'])):
				include_once 'partials/includes/templates/modals/scheduleInterview.php';
			endif;
	  }
	}
	
	//REMOVE ADMIN BAR
	public function remove_admin_bar() {
	
	if(is_page('hr-zone') || is_singular( 'jobs_post' ) || is_page( 'career' )){  
		show_admin_bar(false);
	}

	}
	//GLOBAL HR

	public function globalValues() {
		global $hr_role;
		$hr_role = 'subscriber';
	}

	//Change Default WP Editor to HTML

	public function change_wp_default_editor() {
		if ( is_page('hr-zone')  && (isset($_GET['path']) && $_GET['path'] == 'interview-details' || !isset($_GET['path']))) {
			$r = 'html';
		} else {
		$r = 'tinymce';
		}

		return $r;
	}

	//Redirect user

	public function custom_login_redirect( $redirect_to, $request, $user ) {
		//is there a user to check?
		global $user;
		global $hr_role;
		if ( isset( $user->roles ) && is_array( $user->roles ) ) {
	
			if ( in_array( $hr_role, $user->roles ) ) {
				// redirect them to the default place
				
				$url = site_url()."/hr-zone/";
				return $url;
			} else {
				return  $redirect_to;
			}
		} else {
			return $redirect_to;
		}
	}


	public function pre_submission_filter($form){

		$current_form_Id = $form['id']; 
		$selected_forms = get_option('hr_selected_forms');
		
		$email_data = array();
		$email_data['form'] = $form['title'];
		if(in_array($current_form_Id, $selected_forms)){	
	
		foreach ( $form['fields'] as $index => $field ) {
	
			if($field->label == 'Email'){
				$email_data['email'] = $_POST['input_'.$field->id.''];
			}
	
			if($field->label == 'First Name'){
				$fname = $_POST['input_'.$field->id];
			}
			if($field->label == 'Middle Name'){
				$mname = $_POST['input_'.$field->id];
			}
			if($field->label == 'Last Name'){
				$lname = $_POST['input_'.$field->id];
			}
			if($field->label == 'Name'){
				$email_data['name'] = $_POST['input_'.$field->id];
			}
			
			if(isset($fname) && isset($lanme)){
				if(isset($mname)){
					$full_name = $fname.' '.$mname.' '.$lname;
					$email_data['name'] = $full_name;
				}else{
					$full_name = $fname.' '.$lname;
					$email_data['name'] = $full_name;
				}
			}
	
		}
		
		global $hr_role;
		$args = array(
			'role'    => $hr_role,
			'orderby' => 'user_nicename',
			'order'   => 'ASC'
		);
		$users = get_users( $args );	
		
		foreach ($users as $hr){
			$content = '<div style="padding: 20px 20px">';
			$content .= '<div style="text-align:left;">';	
			$content .= 'Dear <b>'.$hr->display_name.'</b>,<br>';
			$content .= '</div><br>';
			$content .= '<div style="text-align:left">';	
			$content .= 'We would like to acknowledge you that we have recieved a new application for the post of <b>'.$email_data['form'].'</b>.<br>';
			$content .= 'Thank you for your patience';
			$content .= '</div><br>';
			$content .= '<div style="text-align:left">';	
			$content .= '<div>';
			$content .= '<b><u>Application details</u></b>';
			$content .= '</div><br>';	
			$content .= '<div>';
			$content .= '<b>Application name : </b>'.$email_data['name'];
			$content .= '</div>';	
			$content .= '<div>';
			$content .= '<b>Application post : </b>'.$email_data['form'];
			$content .= '</div>';
			$content .= '</div><br>';
			$content .= '<div class="content-item">';	
			$content .= '<p style="margin:0 !important;"><b>Thanks & Regards</b></p>';
			$content .= '<p style="margin:0 !important;"><b>HR Department</b></p>';
			$content .= '<p style="margin:0 !important;"><b>Rudra Innovative Software Pvt. Ltd.</b></p>';
			$content .= '</div>';
			$content .= '</div>';
	
			$to = $hr->user_email;
			$subject = $email_data['form']."- New Entry";
			$body = $this->emailHeadFoot($content);
			$headers = array('Content-Type: text/html; charset=UTF-8');
			// print_r($body);die;
			wp_mail( $to, $subject, $body, $headers );
		}
		return $form;
		}else{
			return $form;
		}
	
	}
	
	// public function custom_validation($validation_result){

	// 	// print_r($validation_result);die;

		
		
	// 	// print_r($field_data);die;
	// }
//HR_ZONE_FUNCTIONS_END

	public function Custom_gp_show_hr_zone_shortcode(){
		
		$user_meta= get_userdata(get_current_user_id());
		global $hr_role;

		if(in_array("administrator", $user_meta->roles) || in_array( $hr_role, $user_meta->roles) ){
			ob_start();
			include_once 'partials/custom-gp-save-form-public-display.php';
			$ret = ob_get_contents();
			ob_end_clean();
			return $ret;
		}else{
			wp_safe_redirect(site_url());
			exit;
		}
	}

	

	//HR ZONE SHOW 

	public function ajax_ShowSelectedFormData_callback(){
		if(isset($_GET['form_id'])){
			$user_data = array();
			$form_data = GFAPI::get_form( $_GET['form_id'] );
			$paging = array( 'offset' => 0, 'page_size' => 1000 );
			$entries = GFAPI::get_entries( $_GET['form_id'], '', null , $paging);		
			// print_r($form_data);die;
			$user_data['form_name'] = $form_data['title'];
			if($_GET['type'] == 'get_label'){
				$form_fields_labels = array();
				$form_fields_labels[] = '';
				$hide_arr = ['HTML Block', 'CAPTCHA'];
				foreach($form_data['fields'] as $key => $field){
					// print_R($field);

					if($field['label'] != '' && !in_array($field['label'] , $hide_arr) && $field['type'] != 'hidden'){
						
						if($field['type'] == 'fileupload' ){
							$form_fields_labels[] = 'Resume';
						}else{
							$form_fields_labels[] = $field['label'];
						}
					}
				}
				$form_fields_labels[] = 'Rating';
				$form_fields_labels[] = 'Action';
				$return = array(
					'labels'  => $form_fields_labels,
					'success' => true
				);
				 
				wp_send_json($return);

			}else{
			$post_data = array();
			$i = 0;	
			global $wpdb;
			$hide_arr = ['HTML Block', 'CAPTCHA'];
			$old_rating = get_user_meta(get_current_user_id(), 'users_rating', true);
			foreach($entries as $key => $entry){
				// print_r($entry);die;
				$email = '';
			
				if($entry['status'] == 'active'){
					
					$entry_id = $entry['id'];$read_data = get_option('entry_read_status');
					$read_status = 0;
					if($read_data != ''){
						if(isset($read_data[$entry_id])){
							$read_status = $read_data[$entry_id];
						}
					}
					if($read_status == 0){
						$post_data[$i][] = "<span class='d-flex align-items-center read-stats-$entry_id position-relative' data-read-status='0'  data-entry-id='$entry_id' style='gap: 2px;'><small class='rounded-circle  p-1 notification-icon position-absolute'></small></span>";
					}else{
						$post_data[$i][] = "<span class='d-flex align-items-center' data-read-status='1' data-entry-id='$entry_id'></span>";
					}
					foreach($form_data['fields'] as $key => $field){
                        if ($entry) {
							if($field['label'] != '' && !in_array($field['label'] , $hide_arr) && $field['type'] != 'hidden'){
								
								if ($field['cssClass'] == 'email' || $field['label'] == 'Email') {
									if ($entry[$field['id']] != '') {
										$user_data['email'] = $entry[$field['id']];
									} else {
										$user_data['email'] = '-';
									}
								}
								if ($field['label'] == 'First Name' || $field['label'] == 'Name') {
									if ($entry[$field['id']] != '') {
										$user_data['fname'] = $entry[$field['id']];
									} else {
										$user_data['fname'] = '-';
									}
								}
								if ($field['label'] == 'Middle Name') {
									if ($entry[$field['id']] != '') {
										$user_data['mname'] = $entry[$field['id']];
									} else {
										$user_data['mname'] = '-';
									}
								}
								if ($field['label'] == 'Last Name') {
									if ($entry[$field['id']] != '') {
										$user_data['lname'] = $entry[$field['id']];
									} else {
										$user_data['lname'] = '-';
									}
								}

								if ($field['label'] == 'Phone') {
									if ($entry[$field['id']] != '') {
										$user_data['phone'] = $entry[$field['id']];
									} else {
										$user_data['phone'] = '-';
									}
								}

								if ($field['label'] == 'Mobile') {
									if ($entry[$field['id']] != '') {
										$user_data['mobile'] = $entry[$field['id']];
									} else {
										$user_data['mobile'] = '-';
									}
								}
								// if($key == 0){
								// $post_data[$i][] = $entry_id;
								// }
								if ($field['type'] == 'fileupload') {
									$ext_info = pathinfo($entry[$field['id']])['extension'];
									
									if ($ext_info == 'docx' || $ext_info == 'doc') {
										$post_data[$i][] .= '<a data-fancybox data-type="pdf" href="https://view.officeapps.live.com/op/embed.aspx?src='.$entry[$field['id']].'&embedded=true" style="color: #6e6ec9;">View Resume</a>';
									} else {
										$post_data[$i][] .= '<a data-fancybox data-type="pdf" href="'.$entry[$field['id']].'"  style="color: #6e6ec9;">View Resume</a>';
									}
								} else {
									if ($field['type'] == 'list') {
										$unserialized_d = unserialize($entry[$field['id']]);
										// print_r($unserialized_d);die;
										
										$html = '<div class="'.$field['type'].'">';
										if ($unserialized_d != '') {
											foreach ($unserialized_d as $d) {
												$html .= '<p>'.$d.'</p>';
											}
										} else {
											$html .= '<p>No hyperlink added</p>';
										}
										
										$html .= '</div>';
										$post_data[$i][] = $html;
									} elseif ($field['type'] == 'repeater') {
										// $post_data[$i][] =
										$n_html = '';
										$n_html .= '<hr>';
										$n_html .= '<div class="'.$field['type'].'">';
										foreach ($entry[$field['id']] as $index => $repeater) {
											$n_html .= '<div class="repeater-heading">';
											$n_html .= '<p class="text-secondary fs-5 m-0 fw-bold">'.$field['label'].'-'.($index+1).'</p>';
											$n_html .= '</div>';
											$n_html .= '<div class="repeater-outer-section">';
											foreach ($repeater as $key => $value) {
												$field_one = GFAPI::get_field($_GET['form_id'], $key);
												// if($field_one['label'] )
												// print_r($field_one);
												if ($field_one['label'] != '') {
													$field_l = $field_one['label'];
												} else {
													$field_l = '';
												}
												
												$n_html .= '<div class="repeter-fields mt-2">';
												$n_html .= '<span class="text-secondary fs-5 fw-bold">'.$field_l.'</span> <span class="text-secondary fs-5">'.$value.'</span>';
												$n_html .= '</div>';
											}
											$n_html .= '</div>';
										}
										$n_html .= '</div>';
										// die;
										$post_data[$i][] = $n_html;
									} else {
										// print_r($entry);die;
										
										if($entry[$field['id']] != ''){
											if ($entry[$field['id'].'.1']) {
												$post_data[$i][]= '<div>'.$entry[$field['id'].'.1'].'</div>';
											} elseif ($entry[$field['id'].'.2']) {
												$post_data[$i][]= '<div>'.$entry[$field['id'].'.2'].'</div>';
											} elseif ($entry[$field['id'].'.3']) {
												$post_data[$i][]= '<div>'.$entry[$field['id'].'.3'].'</div>';
											} elseif ($entry[$field['id'].'.4']) {
												$post_data[$i][]= '<div>'.$entry[$field['id'].'.4'].'</div>';
											} elseif ($entry[$field['id'].'.5']) {
												$post_data[$i][]= '<div>'.$entry[$field['id'].'.5'].'</div>';
											} elseif ($entry[$field['id'].'.6']) {
												$post_data[$i][]= '<div>'.$entry[$field['id'].'.6'].'</div>';
											} elseif ($entry[$field['id'].'.7']) {
												$post_data[$i][]= '<div>'.$entry[$field['id'].'.7'].'</div>';
											} else {
												$post_data[$i][]= '<div>'.$entry[$field['id']].'</div>';
											}
										}else{
											$post_data[$i][] = '<div>-</div>';
										}
									}
								}
							}
						}
					}
					// print_r($post_data);
					$user_data['entryId'] = $entry['id'];
					$event_ids = get_option('event_ids');
					$rate1 = '';
					$rate2 = '';
					$rate3 = '';
					$rate4 = '';
					$rate5 = '';
					if(isset($old_rating[$entry['id']])){
						if($old_rating[$entry['id']]['rate'] == '1'){
							$rate1 = 'checked=checked';
						}else if($old_rating[$entry['id']]['rate'] == '2'){
							$rate2 = 'checked=checked';
						}else if($old_rating[$entry['id']]['rate'] == '3'){
							$rate3 = 'checked=checked';
						}else if($old_rating[$entry['id']]['rate'] == '4'){
							$rate4 = 'checked=checked';
						}else if($old_rating[$entry['id']]['rate'] == '5'){
							$rate5 = 'checked=checked';
						}
						
					}
					$users = get_users(array(
						'meta_key'     => 'users_rating',
					));
					$all_rating = array();
					foreach($users as $u){
							$u_rate1 = '';
							$u_rate2 = '';
							$u_rate3 = '';
							$u_rate4 = '';
							$u_rate5 = '';
                            $user_rating = get_user_meta($u->ID, 'users_rating', true);
							$all_rating[$u->ID]['ratings'] = $user_rating;
							$all_rating[$u->ID]['name'] = $u->data->display_name;
							$all_rating[$u->ID]['id'] = $u->ID;
					}

					if($all_rating != ''){
						$all_rating_html = "<span class='fs-6 fw-bold show_all_ratings show_all_ratings-".$entry['id']."' data-entry='".$entry['id']."' data-rating='".json_encode($all_rating)."'>check all ratings</span>";
					}else{
						$all_rating_html = '';
					}
					$rating = "<div class='all_ratings_section' style='display: table-caption;'>
							<div class='rate' data-entry=".$entry['id'].">
								<input class='rate-applicant' type='radio' id='star-".$entry['id']."-5' name='rate-".$entry['id']."' value='5' ".$rate5."/>
								<label for='star-".$entry['id']."-5'>5 stars</label>
								<input class='rate-applicant' type='radio' id='star-".$entry['id']."-4' name='rate-".$entry['id']."' value='4' ".$rate4."/>
								<label for='star-".$entry['id']."-4'>4 stars</label>
								<input class='rate-applicant' type='radio' id='star-".$entry['id']."-3' name='rate-".$entry['id']."' value='3' ".$rate3."/>
								<label for='star-".$entry['id']."-3'>3 stars</label>
								<input class='rate-applicant' type='radio' id='star-".$entry['id']."-2' name='rate-".$entry['id']."' value='2' ".$rate2."/>
								<label for='star-".$entry['id']."-2'>2 stars</label>
								<input class='rate-applicant' type='radio' id='star-".$entry['id']."-1' name='rate-".$entry['id']."' value='1' ".$rate1."/>
								<label for='star-".$entry['id']."-1'>1 star</label>
								
							</div>
							<div class='float-start'>
								".$all_rating_html."
							</div>
						</div>";
					$post_data[$i][] = $rating;
					if($event_ids != ''){
						if(isset($event_ids[$entry['id']])){
							$post_data[$i][] = "<div data-bs-toggle='tooltip' data-bs-placement='left' title='Interview Already Scheduled'><a href='javascript:;' data-post='".$user_data['form_name'] ."' data-email='".$user_data['email']."' data-name='".$user_data['fname']." ".$user_data['lname']."' class='btn btn-outline-primary btn-no-image font-600 hr-send-mail' data-bs-toggle='tooltip' data-bs-placement='left' title='Send Mail'> <i class='uil uil-comment-alt-notes'></i> </a> <a href='javascript:;' class='btn btn-outline-primary btn-no-image font- disabled'><i class='uil uil-calendar-slash'><i/></a></div>";
							// $post_data[$i][] = "<a href='javascript:;' class='button button-primary hr-reschedule-interview entry-int-".$entry['id']."' data-eventid='".$event_ids[$entry['id']]."' data-entry='".json_encode($user_data)."'>Reschedule Interview</a>";
						}else{
							$post_data[$i][] = "<a href='javascript:;' data-post='".$user_data['form_name'] ."' data-email='".$user_data['email']."' data-name='".$user_data['fname']." ".$user_data['lname']."' class='btn btn-outline-primary btn-no-image font-600 hr-send-mail' data-bs-toggle='tooltip' data-bs-placement='left' title='Send Mail'> <i class='uil uil-comment-alt-notes'></i> </a> <a href='javascript:;' class='btn btn-outline-primary btn-no-image font-600 hr-schedule-interview entry-int-".$entry['id']."' data-entry='".json_encode($user_data)."' data-bs-toggle='tooltip' data-bs-placement='left'  title='Schedule an interview'><i class='uil uil-calendar-alt'></i></a>";
						}
					}else{
						$post_data[$i][] = "<a href='javascript:;' data-post='".$user_data['form_name'] ."' data-email='".$user_data['email']."' data-name='".$user_data['fname']." ".$user_data['lname']."' class='btn btn-outline-primary btn-no-image font-600 hr-send-mail' data-bs-toggle='tooltip' data-bs-placement='left' title='Send Mail'> <i class='uil uil-comment-alt-notes'></i> </a> <a href='javascript:;' class='btn btn-outline-primary btn-no-image font-600 hr-schedule-interview entry-int-".$entry['id']."' data-entry='".json_encode($user_data)."'  data-bs-toggle='tooltip' data-bs-placement='left' title='Schedule an interview'><i class='uil uil-calendar-alt'></i></a>";
					}
						
					$i++;
				}
			}	
			
			$return = array(
				'data'  => $post_data
			);
			 
			wp_send_json($return);

			
			}
		
		} 
	}	
	public function ajax_SaveEmailTemplate_callback()
	{
		
		$data = array();
		$type =  $_POST['type'];
		$data['subject'] = $_POST['subject'];
		$data['content'] = $_POST['content'];
		if($type == 1){

			update_option('gp_hr_email_template',$data);
			$return = array(
				'success'  => true,
				'message' => 'Email Template Saved Successfully For HR'
			);

		}else if($type == 2){

			update_option('gp_email_template',$data);
			$return = array(
				'success'  => true,
				'message' => 'Email Template Saved Successfully For Candidate'
			);

		}else if($type == 3){

			update_option('gp_interviewer_email_template',$data);
			$return = array(
				'success'  => true,
				'message' => 'Email Template Saved Successfully For InterViewer'
			);

		}
		wp_send_json($return);
		
	}

	public function ajax_GetEmailTemplate_callback()
	{
		
		//send mail template
		global $wpdb;
		$email = $_GET['email'];
		$name = $_GET['full_name'];
		$date = $_GET['date'];
		$location = $_GET['location'];
		$interview_type = $_GET['interview_type'];
		$interview_stage = $_GET['interview_stage'];
		$interview_sts = $_GET['interview_status'];	
		$webconference_url = $_GET['webconference_url'];
		$interviewer = $_GET['interviewer'];
		$comments = $_GET['comments'];
		$interview_post = $_GET['interview_post'];

		$email_template = get_option('gp_email_template');
		if ($email_template == '') {
			$email_template = array();
			$email_template['subject'] = 'Interview with {{username}} for {{interview_for}} - {{interview_stage}} has been scheduled';
			ob_start();
			include_once 'partials/includes/templates/emails/candidate/candidate.php';
			$email_template['content'] = ob_get_contents();
			ob_end_clean();
		}
		
		
		$email_data = array();
		if(isset($interview_stage)){
			$stage_name =  $this->interview_stage($interview_stage);
		}

		if(isset($interview_post)){
			$post_name =  $this->interview_post($interview_post);
		}

		if(isset($interviewer)){
			$result = $this->interviewer($interviewer); 
			$n_interviewer = $result->display_name;
		}

		if(isset($interview_sts)){
			$int_sts = $this->interview_status($interview_sts);
		}
		$rejection_arr = ['offer-rejected','rejected', 'withdrawn'];
		if(in_array($int_sts, $rejection_arr)){
			$email_template = array();
			$email_template['subject'] = 'Interview with {{username}} for {{interview_for}} has been {{interview_status}}';
			ob_start();
			include_once 'partials/includes/templates/emails/candidate/reject.php';
			$email_template['content'] = ob_get_contents();
			ob_end_clean();
		}
		
		$email_data['username'] = $name;
		
		if(!in_array($int_sts, $rejection_arr)){
			$email_data['interview_stage'] = $stage_name;
			$email_data['interview_type'] = $interview_type;
			$email_data['interview_timing'] = date("m D Y, h:i a", strtotime($date));
			if($interview_type == 'Web conference'){
				$email_data['interview_location'] = 'Online';
			}else{
				$email_data['interview_location'] = $location;
			}
			$email_data['interviewer'] = $n_interviewer;
			if ($webconference_url != '') {
				$email_data['webconference_url'] = '<td><b>WebConference Url: </b></td><td>'.$webconference_url.'</td>';
			}else{
				$email_data['webconference_url'] = '';
			}
		}else{
			if($int_sts == 'offer-rejected' || $int_sts == 'rejected'){
				$email_data['interview_status'] = 'rejected';
			}else{
				$email_data['interview_status'] = $int_sts;
			}
		}
		
		$email_data['additional_comments'] = $comments;
		$email_data['interview_for'] = $post_name;
		

		
		
		$data = $this->getContents($email_template['content'], '{{', '}}');
		$sub_data = $this->getContents($email_template['subject'], '{{', '}}');
		$replace_w = array();
		$replace_sub_w = array();
		foreach($data as $key => $d){
			$replace_w['name'][$key] = "{{".$d."}}";
			$replace_w['value'][$key] = $email_data[trim($d)];
		} 
		foreach($sub_data as $key => $d){
			$replace_sub_w['name'][$key] = "{{".$d."}}";
			$replace_sub_w['value'][$key] = $email_data[trim($d)];
		} 
		$new_content = str_replace($replace_w['name'], $replace_w['value'] , $email_template['content']);
		$new_subject = str_replace($replace_sub_w['name'], $replace_sub_w['value'] , $email_template['subject']);
		
		
		$return = array(
			'success'  => true,
			'subject' => $new_subject,
			'content' => $new_content
		);
		
		wp_send_json($return);
		
	}

	public function refresh_token($refresh_token) {

		$client_id = '1083753859155-fqa09lptq7t405ic6ripcuo2eqa8m9m7.apps.googleusercontent.com';
		$client_secret = '-tAut7x-U-s6HDyad19oekDt';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://oauth2.googleapis.com/token");
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'refresh_token'  => $refresh_token,
            'grant_type'    => 'refresh_token',
        ]));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close ($ch);
        $result = json_decode($response);        
        
        return $result->access_token;
	}

	public function CreateCalendarEvent($calendar_id, $data, $event_timezone, $access_token) {
		$url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';

		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_events);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));	
		$result = json_decode(curl_exec($ch), true);
        if (isset($result['id'])) {
            return $result['id'];
        }else{
			return '';
		}
	}
	
	public function ajax_SaveEvent_ID_callback()
	{
		if($_POST){
			global $wpdb;
			$google_signIn_table = $wpdb->prefix.'gsign_in_status';
			$checkLoginStatus = $wpdb->get_results("SELECT * FROM $google_signIn_table");
			$access_token = '';
			if(!empty($checkLoginStatus)){
				$refresh_token = $checkLoginStatus[0]->refresh_token;
				$access_token = $this->refresh_token($refresh_token);	
			}
			// print_r($access_token);die;
			if($access_token != ''){
				$data = array(
					'access_token'=> $access_token
				);
				$wherecondition=array(
					'refresh_token'=> $refresh_token
				);  					               
				$updated = $wpdb->update($google_signIn_table, $data, $wherecondition);
			
			}

			
			// Create Event
			$timezone = $checkLoginStatus[0]->timezone;
			$entry_id = $_POST['entry_id'];
			$email = $_POST['email'];
			$name = $_POST['full_name'];
			$date = $_POST['date'];
			$location = $_POST['location'];
			$interview_type = $_POST['interview_type'];
			$interview_stage = $_POST['interview_stage'];
			$interview_sts = $_POST['interview_status'];	
			$interview_post = $_POST['interview_post'];	
			$comments = $_POST['comments'];
			$email_content = stripslashes($_POST['email_content']);
			$email_subject = $_POST['email_subject'];
			$interviewer = $_POST['interviewer'];
			$webconference_url = $_POST['webconference_url'];
			$duration_arr = $_POST['timings_arr'];
			$notify_sts = $_POST['notfiy_sts'];
			$data = $_POST['data'];
			$type = $_POST['type'];
			// print_r($type);die;
            if ($duration_arr != '') {
                if (isset($duration_arr[2])) {
                    $duration = $duration_arr[0].' '.$duration_arr[1].' '.$duration_arr[2].' '.$duration_arr[3];
                } else {
                    $duration = $duration_arr[0].' '.$duration_arr[1];
                }
            }else{
				$duration = '';
			}
			// print_r($_POST);die;

			if(isset($interview_sts)){
				$int_sts =  $this->interview_status($interview_sts);
			}
			$rejection_arr = ['offer-rejected','rejected', 'withdrawn'];


            if (!in_array($int_sts, $rejection_arr)) {
                $event_id = $this->CreateCalendarEvent('primary', $data, $timezone, $access_token);
				$reason = '';
            }else{
				$reason = $comments;
				$comments = '';
				$event_id = '';
			}
			// die;			
			if($event_id == ''){
				$event_id = 'no event added';
			}	
	
			$table_name = $wpdb->prefix.'scheduled_interviews';
			$table_name2 = $wpdb->prefix.'rescheduled_interviews';
			$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE entryId = $entry_id"); 
			// print_r($type);die;
			
			if(empty($results) && $type == 'schedule'){
			
				$inserted  = $wpdb->insert($table_name, array(
					'entryId' => $entry_id,
					'eventId' => $event_id,
                    'userId' => get_current_user_id(),
					'name' => $name,
					'email' => $email,
					'interview_datetime' => $date,
					'interview_hours_mins' => $duration,
					'interview_type' => $interview_type,
					'post' => $interview_post,
					'location' => $location,
					'interviewer' => $interviewer,
					'stage' => $interview_stage,
					'status' => $interview_sts,
					'reason' => $reason,
					'comments' => $comments,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));

				$inserted = $wpdb->insert($table_name2, array(
					'entryId' => $entry_id,
					'eventId' => $event_id,
                    'userId' => get_current_user_id(),
					'name' => $name,
					'email' => $email,
					'interview_datetime' => $date,
					'interview_hours_mins' => $duration,
					'interview_type' => $interview_type,
					'post' => $interview_post,
					'location' => $location,
					'interviewer' => $interviewer,
					'stage' => $interview_stage,
					'status' => $interview_sts,
					'reason' => $reason,
					'comments' => $comments,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));


			}

            if($type == 'reschedule'){
                
                $inserted = $wpdb->insert($table_name2, array(
					'entryId' => $entry_id,
					'eventId' => $event_id,
                    'userId' => get_current_user_id(),
					'name' => $name,
					'email' => $email,
					'interview_datetime' => $date,
					'interview_hours_mins' => $duration,
					'interview_type' => $interview_type,
					'post' => $interview_post,
					'location' => $location,
					'interviewer' => $interviewer,
					'stage' => $interview_stage,
					'status' => $interview_sts,
					'reason' => $reason,
					'comments' => $comments,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));
            }

			//Save event id in option table

			$property = 'event_ids';
			$data = array();
		
			if(get_option($property) != ''){
				$event_ids = get_option($property);

				foreach($event_ids as $key => $event){
					$data[$key] = $event;
				}			
				$data[$entry_id] = $event_id;
				// print_r($event_ids);die;
				$udpated = update_option($property, $data);

			}else{
				$data[$entry_id] = $event_id;
				$updated = update_option($property, $data);
			}


			if(isset($interviewer)){
				$result = $this->interviewer($interviewer);
				$interviewer_mail = $result->user_email;
				$interviewer_name = $result->display_name;
			}

			if(isset($interview_stage)){
				$stage_name =  $this->interview_stage($interview_stage);
			}

			if(isset($interview_post)){
				$post_name =  $this->interview_post($interview_post);
			}

			$headers = 'Content-type: text/html';
			$rejection_arr = ['offer-rejected','rejected', 'withdrawn'];
			$email_data = array();
			$email_data['username'] = $name;
            if (!in_array($int_sts, $rejection_arr)) {

				$email_data['interview_stage'] = $stage_name;
				$email_data['interview_type'] = $interview_type;
				$email_data['interview_timing'] = date("m D Y, h:i a", strtotime($date));
				if($interview_type != 'Web conference'){
					$email_data['interview_location'] = $location;
				}else{
					$email_data['interview_location'] = 'Online';
				}			
				
				if ($webconference_url != '') {
					$email_data['webconference_url'] = '<td><b>WebConference Url: </b></td><td>'.$webconference_url.'</td>';;
				}else{
					$email_data['webconference_url'] = '';
				}
            }else{
				$email_data['additional_comments'] = $reason;
				
				if($int_sts == 'offer-rejected' || $int_sts == 'rejected'){
					$email_data['interview_status'] = 'rejected';
				}else{
					$email_data['interview_status'] = $int_sts;
				}
			}
			
			$email_data['interviewer'] = $interviewer_name;
			$email_data['interview_for'] = $post_name;			
			$email_data['user_email'] = $email;
			//send mail to candidate
			$email_content_n = $this->emailHeadFoot($email_content);
            if ($notify_sts != false) {
                wp_mail($email, $email_subject, $email_content_n, $headers);
            }
			//send mail to interviewer

				$interviewer_email_template = get_option('gp_interviewer_email_template');

				if ($interviewer_email_template == '') {
					$interviewer_email_template = array();
					$interviewer_email_template['subject'] = 'Interview with {{username}} for {{interview_for}} - {{interview_stage}} has been scheduled';
					ob_start();
					include_once 'partials/includes/templates/emails/interviewer/interviewer.php';
					$interviewer_email_template['content'] = ob_get_contents();
					ob_end_clean();
				}	
				
				if(in_array($int_sts, $rejection_arr)){
					$interviewer_email_template = array();
					$interviewer_email_template['subject'] = 'Interview with {{username}} for {{interview_for}} has been {{interview_status}}';
					ob_start();
					include_once 'partials/includes/templates/emails/interviewer/reject.php';
					$interviewer_email_template['content'] = ob_get_contents();
					ob_end_clean();
				}
							
				$data = $this->getContents($interviewer_email_template['content'], '{{', '}}');
				$sub_data = $this->getContents($interviewer_email_template['subject'], '{{', '}}');
				$replace_w = array();
				$replace_sub_w = array();
				foreach($data as $key => $d){
					$replace_w['name'][$key] = "{{".$d."}}";
					$replace_w['value'][$key] = $email_data[trim($d)];
				} 
				foreach($sub_data as $key => $d){
					$replace_sub_w['name'][$key] = "{{".$d."}}";
					$replace_sub_w['value'][$key] = $email_data[trim($d)];
				} 
				$new_interviewer_content = str_replace($replace_w['name'], $replace_w['value'] , $interviewer_email_template['content']);
				$new_interviewer_subject = str_replace($replace_sub_w['name'], $replace_sub_w['value'] , $interviewer_email_template['subject']);
			
				$email_content_n = $this->emailHeadFoot($new_interviewer_content);
				
				wp_mail($interviewer_mail, $new_interviewer_subject, $email_content_n, $headers );
			


			//send mail to hr

			$hr_email_template = get_option('gp_hr_email_template');

			if ($hr_email_template == '') {
				$hr_email_template = array();
				$hr_email_template['subject'] = 'Interview with {{username}} for {{interview_for}} - {{interview_stage}} has been scheduled';
				ob_start();
				include_once 'partials/includes/templates/emails/hr/hr.php';
				$hr_email_template['content'] = ob_get_contents();
				ob_end_clean();
			}	
			if(in_array($int_sts, $rejection_arr)){
				$hr_email_template = array();
				$hr_email_template['subject'] = 'Interview with {{username}} for {{interview_for}} has been {{interview_status}}';
				ob_start();
				include_once 'partials/includes/templates/emails/hr/reject.php';
				$hr_email_template['content'] = ob_get_contents();
				ob_end_clean();
			}
			global $hr_role;
			$args = array(
				'role'    => $hr_role,
				'orderby' => 'user_nicename',
				'order'   => 'ASC'
			);
			$users = get_users( $args );				
			
			
			// print_r($new_content);
			// die;
			foreach($users as $hr){
				
				$hr_mail = $hr->user_email;
				$hr_name =  $hr->display_name;
				$email_data['hr_name'] = $hr_name;
				$data = $this->getContents($hr_email_template['content'], '{{', '}}');
				$sub_data = $this->getContents($hr_email_template['subject'], '{{', '}}');
				$replace_w = array();
				$replace_sub_w = array();
				foreach($data as $key => $d){
					$replace_w['name'][$key] = "{{".$d."}}";
					$replace_w['value'][$key] = $email_data[trim($d)];
				} 
				foreach($sub_data as $key => $d){
					$replace_sub_w['name'][$key] = "{{".$d."}}";
					$replace_sub_w['value'][$key] = $email_data[trim($d)];
				} 
				$new_hr_content = str_replace($replace_w['name'], $replace_w['value'] , $hr_email_template['content']);
				$new_hr_subject = str_replace($replace_sub_w['name'], $replace_sub_w['value'] , $hr_email_template['subject']);
				$email_content_n = $this->emailHeadFoot($new_hr_content);
				if ($hr_mail != $interviewer_mail) {
					wp_mail($hr_mail, $new_hr_subject, $email_content_n, $headers);
				}
			}
				// 
			$return = array(
				'success'  => true
			);
			
			wp_send_json($return);
		}
	}

	public function emailHeadFoot($content)
	{   
		ob_start();
		include_once 'partials/includes/templates/emails/emailHead.php';
		$email_head = ob_get_contents(); 
		ob_end_clean();	
			

		ob_start();
		include_once 'partials/includes/templates/emails/emailFoot.php';
		$email_foot = ob_get_contents();
		ob_end_clean();

		$main_content = $email_head.'<div class="content">'.$content.'</div>'.$email_foot;
		return $main_content;		
	}


	public function updateHistory($data){
        if($data){
            global $wpdb;
            $scheduledInterviewHistoryTable = $wpdb->prefix."scheduled_interviews_history";
          
            date_default_timezone_set("Asia/calcutta");
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $inserted  = $wpdb->insert($scheduledInterviewHistoryTable, $data);
			return $inserted;
        }
    }

	public function ajax_SaveStatusStage_callback(){
        if($_POST){

            global $wpdb;
            $type = $_POST['type'];
            $id = $_POST['id'];
            $scheduledInterviewTable = $wpdb->prefix."scheduled_interviews";
            $scheduledInterviewTableSql = $wpdb->get_results("SELECT * FROM $scheduledInterviewTable WHERE id = " . $id);
            $entryId = $scheduledInterviewTableSql[0]->entryId;
			$html = '';
			$user = get_userdata(get_current_user_id());
			// print_r($user);die;
			$display_name = $user->data->display_name;
            if($type == 'save_stages') {
                if(isset($_POST['stages'])) {
                    $data = array(
                        'stage'=> $_POST['stages']
                    );
                    $wherecondition=array(
                        'id'=> $id
                    );  

                    if($_POST['stages'] != $scheduledInterviewTableSql[0]->stage){                    
                        $updated = $wpdb->update($scheduledInterviewTable, $data, $wherecondition);
                        $n_data = array();
                        $n_data['entryId'] = $entryId;
                        $n_data['userId'] = get_current_user_id();
                        $n_data['remark'] = 'Changed Stage';
                        $n_data['value'] = $_POST['stages'];
                        $this->updateHistory($n_data);
                    }
					
					$html .= '<div class="row m-0 stg-stat-update p-2 mb-2">
								<div class="col-md-4">
									<label class="form-label text-info">Changed Stage</label>
									<p class="text-secondary m-0">'.$this->interview_stage($_POST['stages']).' </p>         
								</div>
								<div class="col-md-4">
									<label class="form-label text-info">Changed By</label>
									<p class="text-secondary m-0">'.ucfirst($display_name).'</p>           
								</div>
								<div class="col-md-4">
									<label class="form-label text-info">Changed On</label>
									<p class="text-secondary m-0">'.date("m D Y, h:i a", strtotime(date('Y-m-d H:i:s'))).'</p>           
								</div>
							</div>';
					$message = "Stage updated successfully.";
                }
            }else{
                if(isset($_POST['status'])) {
                    if(isset($_POST['reason']) && $_POST['reason'] != ''){
                        $data = array(
                            'reason' => $_POST['reason'],
                            'status'=> $_POST['status']
                        );
                    }else{
                        $data = array(
                            'status'=> $_POST['status']
                        );
                    }   
                    
                    $wherecondition=array(
                        'id'=> $id
                    );

                   
                    if($_POST['status'] != $scheduledInterviewTableSql[0]->status){                    
                        $updated = $wpdb->update($scheduledInterviewTable, $data, $wherecondition);
                        $n_data = array();
                        $n_data['entryId'] = $entryId;
                        $n_data['userId'] = get_current_user_id();
                        $n_data['remark'] = 'Changed Status';
						$n_data['reason'] = $_POST['reason'];
                        $n_data['value'] = $_POST['status'];

                        $this->updateHistory($n_data);
                    }
					$reason = '';
					if($_POST['reason'] != ''){
						$reason = '<small><strong class="text-info">Reason:</strong> <span class="text-secondary">'.$_POST['reason'].'</span></small>';
					}
					$html .= '<div class="row m-0 stg-stat-update p-2 mb-2">
								<div class="col-md-4">
									<label class="form-label text-info">Changed Status</label>
									<p class="text-secondary m-0">'.$this->interview_status($_POST['status']).' </p>         
									'.$reason.'
								</div>
								<div class="col-md-4">
									<label class="form-label text-info">Changed By</label>
									<p class="text-secondary m-0">'.ucfirst($display_name).'</p>           
								</div>
								<div class="col-md-4">
									<label class="form-label text-info">Changed On</label>
									<p class="text-secondary m-0">'.date("m D Y, h:i a", strtotime(date('Y-m-d H:i:s'))).'</p>           
								</div>
							</div>';
                    $message = "Status updated successfully.";
                }
                
            }

            $return = array(
                'success'  => true,
				'html' => $html,
                'message' => $message
            );
            
            wp_send_json($return);
        }
    }

	function getContents($str, $startDelimiter, $endDelimiter) {
		$contents = array();
		$startDelimiterLength = strlen($startDelimiter);
		$endDelimiterLength = strlen($endDelimiter);
		$startFrom = $contentStart = $contentEnd = 0;
		while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
			$contentStart += $startDelimiterLength;
			$contentEnd = strpos($str, $endDelimiter, $contentStart);
			if (false === $contentEnd) {
			break;
			}
			$contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
			$startFrom = $contentEnd + $endDelimiterLength;
		}
		
		return $contents;
	}
	
	
	public function ajax_SaveToken_Action_callback(){
		if(isset($_POST)){
			// print_r($_POST);die;
			$type = $_POST['type'];
			global $wpdb;
			$table_name = $wpdb->prefix.'gsign_in_status';

			if($_POST['type'] == 'signIn'){			

				$user_timezone = $this->GetUserCalendarTimezone($_POST['access_token']);
				$avatar = $_POST['avatar'];	
				$truncated = $wpdb->query("TRUNCATE TABLE ".$table_name."");
				if($truncated){
					$inserted = $wpdb->insert($table_name, array(				
						'user_id' => get_current_user_id(),
						'email' => $_POST['email'],
						'username' => $_POST['name'],
						'avatar' => $avatar,
						'access_token' => $_POST['access_token'],
						'refresh_token' => $_POST['refresh_token'],
						'timezone' => $user_timezone,				
						'expires_in' => $_POST['expires_in']				
					));
				}

				if($inserted){
					$return = array(
						'success'  => true,
						'message' => 'User Data Saved'
					);
				}else{
					$return = array(
						'success'  => false,
						'message' => 'Error'
					);
				}

				
				wp_send_json($return);

			}
		}
	}

	public function GetUserCalendarTimezone($access_token) {
		$url_settings = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';
	
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_settings);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get timezone');

		return $data['value'];
	}
	

	//Save Settings

	public function ajax_SaveSettings_Action_callback()
	{
		if($_POST):
			global $wpdb;
			$save = $_POST['type'];
			$save_val = $_POST['value'];
			$success = '';
			$error = '';
			if($save == 'save_status'):
				$table_name = $wpdb->prefix."interview_status";
				$saved = $wpdb->insert($table_name, array(
					"status" => $save_val
				), array( '%s'));	
				if($saved):
					$success = 'Status Added Succesfully';
				else:
					$error = 'Internal Server Error';
				endif;

			elseif($save == 'save_stage'):

				$table_name = $wpdb->prefix."interview_states";
				$saved = $wpdb->insert($table_name, array(
					"states" => $save_val
				), array( '%s'));
				if($saved):
					$success = 'Stage Added Succesfully';
				else:
					$error = 'Internal Server Error';	
				endif;
				
			elseif($save == 'save_posts'):

				$table_name = $wpdb->prefix."hr_zone_posts";
				$saved = $wpdb->insert($table_name, array(
					"name" => $save_val
				), array( '%s'));
				if($saved):
					$success = 'Post Added Succesfully';
				else:
					$error = 'Internal Server Error';	
				endif;

			endif;		
			$data =array();
			if($success != ''):
				$data['success'] = true;
				$data['message'] = $success;

			elseif($error != ''):
				$data['error'] = true;
				$data['message'] = $error;
			endif;
				$data['id'] = $wpdb->insert_id;
			if($saved):
				$return = $data;
				wp_send_json($return);
			endif;
			
		endif;
	}

	public function ajax_DeleteSettings_Action_callback()
	{
		if($_POST):
			global $wpdb;
			$delete = $_POST['type'];
			$id = $_POST['id'];
			if($delete == 'delete_status'):
				$table_name = $wpdb->prefix."interview_status";
				$deleted = $wpdb->delete( $table_name, array( 'id' => $id ));
				if($deleted):
					$error = 'Status Deleted Succesfully';
				else:
					$error = 'Internal Server Error';
				endif;

			elseif($delete == 'delete_stage'):

				$table_name = $wpdb->prefix."interview_states";
				$deleted = $wpdb->delete( $table_name, array( 'id' => $id ));
				if($deleted):
					$error = 'Stage Deleted Succesfully';
				else:
					$error = 'Internal Server Error';	
				endif;
				
			elseif($delete == 'delete_post'):

				$table_name = $wpdb->prefix."hr_zone_posts";
				$deleted = $wpdb->delete( $table_name, array( 'id' => $id ));
				if($deleted):
					$error = 'Post Deleted Succesfully';
				else:
					$error = 'Internal Server Error';	
				endif;

			endif;		
			$data =array();
			if($error != ''):
				$data['error'] = true;
				$data['message'] = $error;
			endif;
			if($deleted):
				$return = $data;
				wp_send_json($return);
			endif;
			
		endif;
	}
	
	public function ajax_createForm_Action_callback()
	{
		if($_GET):
			$title = '';
			if(isset($_GET['formTitle'])):
				$title = $_GET['formTitle'];
			endif;

			$forms = GFAPI::get_forms();
			$form_id = 0;
			$duplicate_form_arr = '';
			foreach($forms as $form):
				if(isset($form['cssClass'] ) && $form['cssClass'] == 'custom-duplicacy-form'):
					$duplicate_form_arr =  $form;
				endif;
			endforeach;
			$duplicate_form_arr['title'] = $title;
			$duplicate_form_arr['description'] = '';
			$duplicate_form_arr['cssClass'] = strtolower(str_replace(" ","-", $title)).'-form-cls';

			$new_form_id = GFAPI::add_form( $duplicate_form_arr );

			$selected_forms = array();
			$selected_forms = get_option('hr_selected_forms');

			if(!empty($selected_forms)):
					if(!in_array($new_form_id, $selected_forms)):
						$selected_forms[] = (string) $new_form_id;
						update_option('hr_selected_forms', $selected_forms);
					endif;
			else:
				$selected_forms[] = (string) $new_form_id;
				update_option('hr_selected_forms', $selected_forms);
			endif;

			$data = array();
			$data['success'] = true;
			$data['url'] = site_url().'/wp-admin/admin.php?page=gf_edit_forms&id='.$new_form_id.'&isnew=1&type=hr';
			wp_send_json($data);
		endif;
	}


	public function ajax_editAccount_Action_callback()
	{
		if(isset($_POST)):
			$message = '';

				$user_id = get_current_user_id();

				$data = array(
					'ID' => $user_id,
					'first_name' => $_POST['fname'],
					'last_name' => $_POST['lname'],
					'user_email' => $_POST['email'],
					'display_name' => $_POST['d_name']
				); 
				
				if(isset($_POST['password']) && $_POST['password'] != ''):

					if($_POST['confirm_password'] != $_POST['password']):
						$message = "Password Do not match.";
						$return = array();
						$return['error'] = true;
						$return['message'] = $message;
						wp_send_json($return);
						exit;
					endif;
					$data['user_pass'] = $_POST['password'];
				endif;

				$updated = wp_update_user( $data );
				if($updated):
					$message = "User updated successfully.";
					$return = array();
					$return['success'] = true;
					$return['message'] = $message;
					wp_send_json($return);
					exit;
				endif;
				
		endif;
	}
	//job-post Data
	// public function ajax_ShowJobPostData_Action_callback(){
	// 	$post_data = array();
	// 	$args = array(
	// 		'post_type' => 'jobs_post',
	// 		'orderby' => 'ID',
	// 		'order' => 'DESC',
	// 		'posts_per_page' => -1
		
	// 	);
	// 	 $job_post = new WP_Query( $args );
	// 	 $job_posts = $job_post->posts;
	// 	 $i =0;
	// 	 foreach($job_posts as $key => $job):
	// 		$post_data[$key][] = $job->ID;
	// 		$post_data[$key][] = $job->post_title;			
	// 		if($job->post_author):
	// 			$post_data[$key][] = ucfirst($this->interviewer($job->post_author)->display_name);
	// 		endif;
	// 		$post_data[$key][] = $job->post_date;
	// 		$post_data[$key][] = ucfirst($job->post_status);
	// 		if($job->post_status == 'draft'){
	// 			$disabled = 'disabled';
	// 		}else{
	// 			$disabled = '';
	// 		}
	// 		$post_data[$key][] = '<div class="d-flex"><div data-bs-toggle="tooltip" data-bs-placement="left" title="View '.$job->post_title.'"><a class="btn btn-outline-primary '.$disabled.'" target="_blank" href="'.site_url().'/Jobs/'.$job->post_name.'/" ><i class="uil uil-eye"></i></a></div><div class="ms-2" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit '.$job->post_title.'"><a class="btn btn-outline-primary" href="'.site_url().'/wp-admin/post.php?post='.$job->ID.'&action=edit&type=hr"><i class="uil uil-file-edit-alt"></i></a></div>';
	// 	 endforeach;

	// 	 $return = array(
	// 		'data'  => $post_data
	// 	);
		 
	// 	wp_send_json($return);
	// }

	public function interview_status($id){
	    global $wpdb;
	    $table_name = $wpdb->prefix.'interview_status';
	    $status = $wpdb->get_var( "SELECT status FROM $table_name WHERE id = $id"); 	    	    
	    return $status;
	}
	
	public function interview_stage($id){
	    global $wpdb;
	    $table_name = $wpdb->prefix.'interview_states';
	    $stage = $wpdb->get_var( "SELECT states FROM $table_name WHERE id = $id"); 	    	    
	    return $stage;
	}
	
	public function interview_post($id){
	    global $wpdb;
	    $table_name = $wpdb->prefix.'hr_zone_posts';
	    $postname = $wpdb->get_var( "SELECT name FROM $table_name WHERE id = $id"); 	    	    
	    return $postname;
	}

	public function interviewer($id){
	    $the_user = get_user_by( 'id', $id );    	    
	    return $the_user;
	}
	
	public function ajax_ReadInterview_Action_callback()
	{
		if($_POST){
			$readStsArr = array();
			
			if(isset($_POST['entryId']) && $_POST['entryId'] != ''){
				$entryId = $_POST['entryId'];
				$readData = get_option('entry_read_status');
				if($readData != '' && !in_array($entryId , $readData)){
					$readData[$entryId] = 1;
					update_option('entry_read_status', $readData);
				}
				if($readData == ''){
					$readStsArr[$entryId] = 1;
					update_option('entry_read_status', $readStsArr);
				}
			}

			$return = array(
				'success'  => true
			);
			 
			wp_send_json($return);
		}
	}

	public function ajax_SendMail_Action_callback()
	{
		if($_POST){

			if($_POST['subject'] == ''){
				$return = array(
					'error'  => true,
					'msg' => '<strong>Please Add Subject</strong>'
				);
				 
				wp_send_json($return);
				exit();
			}

			if($_POST['msg'] == ''){
				$return = array(
					'error'  => true,
					'msg' => '<strong>Please Add Message</strong>'
				);
				 
				wp_send_json($return);
				exit();
			}
			$content = '<div style="padding: 20px 20px">';
			$content .= '<div style="text-align:left;">';	
			$content .= 'Dear <b>'.$_POST['name'].'</b>,<br>';
			$content .= '</div><br>';
			$content .= '<div style="text-align:left">';	
			$content .= 'We would like to acknowledge you that we have successfully recieved your application for the post of <b>'.$_POST['post'].'</b>.<br>';
			$content .= '<br>'.$_POST['msg'].'<br>';
			$content .= '</div><br>';
			$content .= '<div class="content-item">';	
			$content .= '<p style="margin:0 !important;"><b>Thanks & Regards</b></p>';
			$content .= '<p style="margin:0 !important;"><b>HR Department</b></p>';
			$content .= '<p style="margin:0 !important;"><b>Rudra Innovative Software Pvt. Ltd.</b></p>';
			$content .= '</div>';
			$content .= '</div>';
	
			$to = $_POST['email'];
			$subject = $_POST['subject'];
			$body = $this->emailHeadFoot($content);
			$headers = array('Content-Type: text/html; charset=UTF-8');
			
			wp_mail( $to, $subject, $body, $headers );
			$return = array(
				'success'  => true,
				'msg' => '<strong>Mail has been sent successfully</strong>'
			);
			 
			wp_send_json($return);
		}
	}

	public function ajax_SaveRating_Action_callback()
	{
		if($_POST){

			$entryId = $_POST['entryId'];
			$rating = $_POST['rating'];
			$reason = $_POST['reason'];
			$user_id  = get_current_user_id();

			$old_rating = get_user_meta($user_id, 'users_rating', true);
			if($old_rating != ''){
				$old_rating[$entryId]['rate'] = $rating;
				$old_rating[$entryId]['reason'] = $reason;
				update_user_meta( $user_id, 'users_rating', $old_rating);
			}else{
				add_user_meta( $user_id, 'users_rating', array(
					$entryId => array(
						'rate' => $rating,
						'reason' => $reason
					),
				));
			}

			
			$return = array(
				'success'  => true,
				'msg' => '<strong>Rated successfully</strong>',
				'user_id' => get_current_user_id()
			);
			 
			wp_send_json($return);
		}
	}

	
	
}
