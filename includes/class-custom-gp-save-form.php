<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://localhost
 * @since      1.0.0
 *
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/includes
 * @author     RudraInnovative <codeiexpert82@gmail.com>
 */
class Custom_Gp_Save_Form {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Custom_Gp_Save_Form_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'CUSTOM_GP_SAVE_FORM_VERSION' ) ) {
			$this->version = CUSTOM_GP_SAVE_FORM_VERSION;
		} else {
			$this->version = '1.0.1111';
		}
		$this->plugin_name = 'custom-gp-save-form';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Custom_Gp_Save_Form_Loader. Orchestrates the hooks of the plugin.
	 * - Custom_Gp_Save_Form_i18n. Defines internationalization functionality.
	 * - Custom_Gp_Save_Form_Admin. Defines all hooks for the admin area.
	 * - Custom_Gp_Save_Form_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-custom-gp-save-form-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-custom-gp-save-form-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-custom-gp-save-form-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-custom-gp-save-form-public.php';

		$this->loader = new Custom_Gp_Save_Form_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Custom_Gp_Save_Form_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Custom_Gp_Save_Form_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Custom_Gp_Save_Form_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_ajax_WW_SaveSelectedHR_Action',  $plugin_admin, 'ajax_SaveSelectedHR_callback' );

		//HR ZONE FUNCTIONS

		//Actions
		$this->loader->add_action( 'admin_menu',$plugin_admin,  'gravity_hr_customiztion_menu' );
		$this->loader->add_action( 'admin_head',$plugin_admin, 'hrZoneFunction', 20 );
		$this->loader->add_action( 'load-edit.php',$plugin_admin, 'gp_trashed_redirect');

		//Filters
		$this->loader->add_filter( 'redirect_post_location',$plugin_admin, 'custom_redirect_post_location' );
		$this->loader->add_filter( 'gform_admin_pre_render',$plugin_admin, 'hide_form' );
		$this->loader->add_filter( 'gform_form_post_get_meta',$plugin_admin, 'gp_add_repeater_fields' );
		$this->loader->add_filter( 'wp_mail_from_name',$plugin_admin, 'wpb_sender_name' );
		$this->loader->add_filter( 'wp_mail_from',$plugin_admin, 'wpb_sender_email' );
		$this->loader->add_filter( 'gform_form_update_meta',$plugin_admin, 'gp_save_remove_my_field', 10, 3 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Custom_Gp_Save_Form_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		//HR-Zone Action 

		// ACtions 
		// $this->loader->add_action( 'wp_print_styles',$plugin_public, 'project_dequeue_unnecessary_styles' );
		// $this->loader->add_action( 'wp_print_scripts',$plugin_public, 'project_dequeue_unnecessary_scripts' );
		$this->loader->add_action( 'wp_head',$plugin_public, 'hrZoneFunction', 20 );
		$this->loader->add_action('wp',$plugin_public, 'remove_admin_bar');
		$this->loader->add_action( 'after_setup_theme',$plugin_public, 'globalValues' );

		//Filters
		
		$this->loader->add_filter( 'wp_default_editor',$plugin_public, 'change_wp_default_editor');
		$this->loader->add_filter( 'login_redirect',$plugin_public, 'custom_login_redirect', 99, 3 );	
		$this->loader->add_filter( 'gform_pre_submission_filter',$plugin_public, 'pre_submission_filter', 10, 1 );
		// $this->loader->add_filter( 'gform_validation',$plugin_public, 'custom_validation');
		// $this->loader->remove_action( 'wp_print_styles', $plugin_admin, 'remove_uncessary_stylesheets' );

		//privilaged


		$this->loader->add_action( 'wp_ajax_WW_ShowSelectedFormData_Action',  $plugin_public, 'ajax_ShowSelectedFormData_callback' );
		$this->loader->add_action( 'wp_ajax_WW_SaveEvent_ID_Action',  $plugin_public, 'ajax_SaveEvent_ID_callback' );
		$this->loader->add_action( 'wp_ajax_WW_SaveEmailTemplate_Action',  $plugin_public, 'ajax_SaveEmailTemplate_callback' );
		$this->loader->add_action( 'wp_ajax_WW_GetEmailTemplate_Action',  $plugin_public, 'ajax_GetEmailTemplate_callback' );
        $this->loader->add_action( 'wp_ajax_WW_SaveStatusStage_Action',  $plugin_public, 'ajax_SaveStatusStage_callback' );
		//no_privilaged

		$this->loader->add_action( 'wp_ajax_nopriv_WW_ShowSelectedFormData_Action',  $plugin_public, 'ajax_ShowSelectedFormData_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_SaveEvent_ID_Action',  $plugin_public, 'ajax_SaveEvent_ID_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_SaveEmailTemplate_Action',  $plugin_public, 'ajax_SaveEmailTemplate_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_GetEmailTemplate_Action',  $plugin_public, 'ajax_GetEmailTemplate_callback' );
        $this->loader->add_action( 'wp_ajax_nopriv_WW_SaveStatusStage_Action',  $plugin_public, 'ajax_SaveStatusStage_callback' );
		
		//Save Refresh Token

		$this->loader->add_action( 'wp_ajax_WW_SaveToken_Action',  $plugin_public, 'ajax_SaveToken_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_SaveToken_Action',  $plugin_public, 'ajax_SaveToken_Action_callback' );

		//Settings Save

		$this->loader->add_action( 'wp_ajax_WW_SaveSettings_Action',  $plugin_public, 'ajax_SaveSettings_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_SaveSettings_Action',  $plugin_public, 'ajax_SaveSettings_Action_callback' );

		//Settings Delete

		$this->loader->add_action( 'wp_ajax_WW_DeleteSettings_Action',  $plugin_public, 'ajax_DeleteSettings_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_DeleteSettings_Action',  $plugin_public, 'ajax_DeleteSettings_Action_callback' );

		//Create Form Link

		$this->loader->add_action( 'wp_ajax_WW_createForm_Action',  $plugin_public, 'ajax_createForm_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_createForm_Action',  $plugin_public, 'ajax_createForm_Action_callback' );

		//Edit Account Details

		$this->loader->add_action( 'wp_ajax_WW_editAccount_Action',  $plugin_public, 'ajax_editAccount_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_editAccount_Action',  $plugin_public, 'ajax_editAccount_Action_callback' );
		
		//Edit Account Details

		$this->loader->add_action( 'wp_ajax_WW_ShowJobPostData_Action',  $plugin_public, 'ajax_ShowJobPostData_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_ShowJobPostData_Action',  $plugin_public, 'ajax_ShowJobPostData_Action_callback' );


		//Change Unread Status 

		$this->loader->add_action( 'wp_ajax_WW_ReadInterview_Action',  $plugin_public, 'ajax_ReadInterview_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_ReadInterview_Action',  $plugin_public, 'ajax_ReadInterview_Action_callback' );
		
		//Send Mail

		$this->loader->add_action( 'wp_ajax_WW_SendMail_Action',  $plugin_public, 'ajax_SendMail_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_SendMail_Action',  $plugin_public, 'ajax_SendMail_Action_callback' );
		

		//Send Mail

		$this->loader->add_action( 'wp_ajax_WW_SendMail_Action',  $plugin_public, 'ajax_SendMail_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_SendMail_Action',  $plugin_public, 'ajax_SendMail_Action_callback' );
		
		//Send Mail

		$this->loader->add_action( 'wp_ajax_WW_SaveRating_Action',  $plugin_public, 'ajax_SaveRating_Action_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_WW_SaveRating_Action',  $plugin_public, 'ajax_SaveRating_Action_callback' );
		
		// add_shortcode('Custom_gp_save_form_shortcode', array( $plugin_public, 'Custom_gp_save_form_shortcode'));
		add_shortcode('Custom_gp_show_hr_zone_shortcode', array( $plugin_public, 'Custom_gp_show_hr_zone_shortcode'));
		
	}	

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Custom_Gp_Save_Form_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}