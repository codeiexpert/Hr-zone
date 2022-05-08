<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://localhost
 * @since      1.0.0
 *
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/admin
 * @author     Expert Coder Singh <codeiexpert82@gmail.com>
 */
class Custom_Gp_Save_Form_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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
	
		// wp_enqueue_style( 'jquery-style', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-gp-save-form-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'iao-alert', plugin_dir_url( __FILE__ ) . 'css/iao-alert.min.css', array(), $this->version, 'all' );

	

		// wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );
			
	
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-gp-save-form-admin.js', array( 'jquery' ), $this->version, false );
		// wp_enqueue_script( 'google-jquery-ui', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.min.js', $this->version, false );
		wp_enqueue_script( 'iao-alert-min', plugin_dir_url( __FILE__ ) . 'js/iao-alert.jquery.min.js', $this->version, false );
		
		$user_meta= get_userdata(get_current_user_id());
		$user_role = isset($user_meta->roles[0]) ? $user_meta->roles[0] : $user_meta->roles[1];
		$selected_forms = get_option('hr_selected_forms');
		global $hr_role;
		wp_localize_script($this->plugin_name, 'WW_ADMIN_AJAX_OBJECT', array('admin_url' => admin_url(), 'ajax_url' => admin_url('admin-ajax.php'), 'user_role' => $user_role, 'global_hr_role' => $hr_role, 'selected_forms' => $selected_forms));
		wp_localize_script($this->plugin_name, 'SITE_URL', array( 'main' => get_option('siteurl') ));

	}

//ADMIN FUNCTIONS START


	//CUSTOM HR ZONE MENU

	public function gravity_hr_customiztion_menu() {
		global $current_user;
		if(in_array('administrator', $current_user->roles)){
			add_submenu_page("options-general.php", "HrZone Admin Config", "HrZone Admin Config", 'administrator', "hr-zone-admin-menu", array($this, 'GP_Hr_ZoneAdmin'));
		}
	}	


	//HR ZONE ADMIN FUNCTIONS START

	public function GP_Hr_ZoneAdmin(){
		ob_start();
		include_once 'partials/custom-gp-save-form-admin-display-admin-menu.php';
		$ret = ob_get_contents();
		return $ret;
		ob_end_clean();
	}

	// Function to change email address
	public function wpb_sender_email( $original_email_address ) {
		return 'hr@rudrainnovatives.com';
	}
	
	// Function to change sender name
	public function wpb_sender_name( $original_email_from ) {
		return 'HR RUDRA';
	}

	function hrZoneFunction() { 
		if(isset($_GET['page']) && ($_GET['page'] == 'gf_edit_forms')){
			if(isset($_GET['type']) && $_GET['type'] == 'hr'){
				echo '<style>
					#adminmenumain, #wpadminbar, .notice, #gform-form-toolbar__menu{
						display: none;
					}
					#gform-form-switcher-control {
						border: none;
					}
					
					#gform-form-switcher-control i {
						display: none;
						pointer-events: none;
					}
					
					#gform-form-switcher-control span {
						font-weight: bold; 
						font-size:1.3em
					}                
					.gform-dropdown {
						pointer-events: none;
					}
					#wpcontent{
						margin-left: 0;
					}
					
					.custom-gp-form-data {
						margin-left: 30px;
					}
					#gform-form-toolbar{
						width: 100%;
					} 
					#gform-form-toolbar article {
						pointer-events: none;
					}
				</style>';
			}
		}
		global $pagenow;
		if($pagenow == 'post.php' || $pagenow == 'post-new.php'){
			if(((isset($_GET['post']) && $_GET['post'] != '') &&  ( isset($_GET['action'])  && $_GET['action'] != '' )) || (isset($_GET['post_type']) && $_GET['post_type'] == 'jobs_post') ){
				if(isset($_GET['type']) && $_GET['type'] == 'hr'){
					echo '<style>
						#adminmenumain, #wpadminbar, #show-settings-link, #gform-form-toolbar__menu, #setting-error-tgmpa, .notice, #add_gform, .wp-switch-editor.switch-html, .wpb_switch-to-composer{
							display: none !important;
						}
					
						#wpcontent{
							margin-left: 0;
						}
						
						.custom-gp-form-data {
							margin-left: 30px;
						}
						#gform-form-toolbar{
							width: 100%;
						} 
						#gform-form-toolbar article {
							pointer-events: none;
						}
						html.wp-toolbar{
							padding-top: 0 !important;
						}
						.vc_subnav-fixed{
							top:0 !important;
							padding-left: 0 !important;
						}
					</style>';
				}
			}
		}
	  
	}

	public function gp_trashed_redirect(){
		$screen = get_current_screen();
		$user = wp_get_current_user();
		if('edit-jobs_post' == $screen->id){
			if( isset($_GET['trashed']) &&  intval($_GET['trashed']) > 0){
				if($user->roles[0] == 'hr'){
					$redirect = site_url("hr-zone?post_trashed=1'");
					wp_redirect($redirect);
					exit();
				}				
			}
		}
	}
	
	

	//CUSTOM POST REDIRECTION

	public function custom_redirect_post_location( $location ) { 
		$user = wp_get_current_user();
		$type = '';
	
		$url = parse_url($_POST['_wp_http_referer']);
		parse_str($url['query'], $path);
		
		if(isset($path['type']) && $path['type'] == 'hr'){
			$type = $path['type'];
		}
		$post_add_upd = 'update';
		if(isset($path['post_add'])){
			$post_add_upd = 'add';
		}

		if ( 'jobs_post' == get_post_type() && $type == 'hr' && $user->roles[0] == 'hr') {
		
			if (isset($_POST['save']) || isset($_POST['publish'])) {
				
				if($post_add_upd == 'add'){
					$location = site_url("hr-zone?post_added=1");
				}else{
					$location = site_url("hr-zone?post_updated=1");
				}
				
				
			}
		} 
		return $location;
	} 

	//HIDE NON SELECTED HR FORM 

	public function hide_form( $form ) {

		global $current_user;
		global $hr_role;
		$user_role = $current_user->roles[0];
	
		if($user_role == $hr_role){
			$form_id = $form['fields'][0]->formId;
			$selected_forms = get_option('hr_selected_forms');
		  
			if(in_array($form_id, $selected_forms)){
				return $form;
			}else{
				wp_redirect(site_url()."/hr-zone/?ex=permission_denied", 301);
				exit;
			}
			
		}else{
			return $form;
		}
		   
	}

	 //GRAVITY FORM REPEATER FUNCTIONS

	public function gp_add_repeater_fields( $form ) {
		if(isset($_GET['page'] ) && $_GET['page'] != 'gf_edit_forms' && isset($form['cssClass']) && $form['cssClass'] != 'custom-duplicacy-form'){
			$edu_form_field = array();
			$emp_form_field = array();
			$edu_indexs = array(); 
			$emp_indexs = array(); 
			$n_index_edu = 0;
			$n_index_emp = 0;
			foreach ( $form['fields'] as $index => $field ) {
				
				$class = explode(' ', $field->cssClass);
			
				if(in_array('gp-save-education-content', $class)){
					$n_index_edu = $index; 
				} 
	
				if(in_array('gp-save-employer-content', $class)){
					$n_index_emp = $index; 
				} 
				
				if( in_array('gp-save-education-fields', $class)){
					
					$edu_form_field['fields'][$index] = $field;
					// if($field->label == 'Currently pursuing'){
					//     $edu_form_field['fields'][$index]['label'] = 'Current Status';
					// }
					$indexs[] = $index;
				}
	
				if( in_array('gp-save-employer-fields', $class)){
					
					$emp_form_field['fields'][$index] = $field;
					// if($field->label == 'I currently work here'){
					//     $emp_form_field['fields'][$index]['label'] = 'Current Status';
					// }
					$indexs[] = $index;
				}
				
			}
			$education_repeater = GF_Fields::create( array(
				'type'       => 'repeater',
				'label'            => 'Education',
				'addButtonText'    => '+ Add education', // Optional
				'removeButtonText' => '- Remove education', // Optional
				'maxItems'         => 8, // Optional
				'id'         => 1000,
				'formId'     => $form['id'],
				'cssClass'     => 'education-reapeater-field',
				'pageNumber' => 1
				// Ensure this is correct
			) );
	
			$employer_repeater = GF_Fields::create( array(
				'type'       => 'repeater',
				'label'            => 'Employer',
				'addButtonText'    => '+ Add employer', // Optional
				'removeButtonText' => '- Remove employer', // Optional
				'maxItems'         => 8, // Optional
				'id'         => 2000,
				'formId'     => $form['id'],
				'cssClass'     => 'employer-reapeater-field',
				'pageNumber' => 1
				// Ensure this is corect
			) );
	
			$education_repeater->fields = $edu_form_field['fields'];
			$employer_repeater->fields = $emp_form_field['fields'];
			foreach( $indexs as $i){
				unset($form['fields'][$i]);	
			}
			
			if($education_repeater['fields'] != ''){
			 $form['fields'][$n_index_edu] = $education_repeater;
			}
			if($employer_repeater['fields'] != ''){
				$form['fields'][$n_index_emp] = $employer_repeater;
			}
		}
		return $form;
	}


	//Gravity Form Update Meta
	public function gp_save_remove_my_field( $form_meta, $form_id, $meta_name ) {
	
		if ( $meta_name == 'display_meta' ) {
			// Remove the Repeater field: ID 1000
			$form_meta['fields'] = wp_list_filter( $form_meta['fields'], array( 'id' => 1000 ), 'NOT' );
		}
	
		return $form_meta;
	}

//ADMIN FUNCTIONS END




	public function ajax_SaveSelectedHR_callback(){
		if(isset($_POST['selected_forms'])){
			
		
			if($_POST['selected_forms'][0] == 0){
				$data = '';
			}else{
				$data = $_POST['selected_forms'];
			}
			$updated = update_option('hr_selected_forms', $data, true);
			$return = array(
				'message'  => 'Selected forms are saved successfully',
				'success' => true
			);
				
			wp_send_json($return);
		}
	}


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


}