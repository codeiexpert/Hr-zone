<?php

/**
 * Fired during plugin activation
 *
 * @link       http://localhost
 * @since      1.0.0
 *
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/includes
 * @author     Expert Coder <codeiexpert82@gmail.com>
 */
class Custom_Gp_Save_Form_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {	
			

			global $wpdb;

			//Google Sign In Table

            $table_name = $wpdb->prefix . 'gsign_in_status';            
            if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
                $sql = "CREATE TABLE " . $table_name . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,					
					`user_id` int(11) NOT NULL,
					`email` varchar(255) NOT NULL,
					`username` varchar(255)	NOT NULL,
					`avatar` varchar(255) NOT NULL,
					`access_token` varchar(255)	NOT NULL,
					`refresh_token` varchar(255) NOT NULL,
					`timezone` varchar(255)	NOT NULL,	
					`expires_in` varchar(255) NOT NULL,					
					PRIMARY KEY id (id)
					);";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);                
            }

			// HR ZONE POSTS TABLE

            $table_name = $wpdb->prefix . 'hr_zone_posts';            
            if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
                $sql = "CREATE TABLE " . $table_name . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,					
					`name` varchar(255) NOT NULL,
					PRIMARY KEY id (id)
					);";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);                
            }

			// Interview Stages Table

             $table_name = $wpdb->prefix . 'interview_states';            
            if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
                $sql = "CREATE TABLE " . $table_name . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,					
					`states` varchar(255) NOT NULL,
					PRIMARY KEY id (id)
					);";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);                
            }

			// Interview Status Table

			$table_name = $wpdb->prefix . 'interview_status';            
            if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
                $sql = "CREATE TABLE " . $table_name . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,					
					`status` varchar(255) NOT NULL,
					PRIMARY KEY id (id)

					);";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);                
            }

			//Rescheduled Interviews Table

            $table_name = $wpdb->prefix . 'rescheduled_interviews';            
            if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
                $sql = "CREATE TABLE " . $table_name . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,					
					`userId` int(11) NOT NULL,
					`entryId` int(11) NOT NULL,
					`eventId` varchar(255) NULL,					
					`name` varchar(255) NULL,
					`email` varchar(255) NULL,
					`post` varchar(255) NULL,
					`interviewer` varchar(255) NULL,
					`interview_datetime` varchar(255) NULL,
					`interview_hours_mins` varchar(255) NULL,
					`interview_type` varchar(255) NULL,
					`location` varchar(255) NULL,
					`stage` varchar(255) NULL,
					`status` varchar(255) NULL,
					`reason` varchar(255) NULL,
					`comments` varchar(255) NULL,
					`created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
					`updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
					PRIMARY KEY id (id)

					);";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);                
            }

			//Scheduled Interviews Table

            $table_name = $wpdb->prefix . 'scheduled_interviews';            
            if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
                $sql = "CREATE TABLE " . $table_name . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,					
					`userId` int(11) NOT NULL,
					`entryId` int(11) NOT NULL,
					`eventId` varchar(255) NULL,					
					`name` varchar(255) NULL,
					`email` varchar(255) NULL,
					`post` varchar(255) NULL,
					`interviewer` varchar(255) NULL,
					`interview_datetime` varchar(255) NULL,
					`interview_hours_mins` varchar(255) NULL,
					`interview_type` varchar(255) NULL,
					`location` varchar(255) NULL,
					`stage` varchar(255) NULL,
					`status` varchar(255) NULL,
					`reason` varchar(255) NULL,
					`is_read` int(11) DEFAULT '0',
					`comments` varchar(255) NULL,
					`created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
					`updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
					PRIMARY KEY id (id)

					);";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);                
            }

			//Scheduled Interviews Table
			
			$table_name = $wpdb->prefix . 'scheduled_interviews_history';            
            if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
                $sql = "CREATE TABLE " . $table_name . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,					
					`userId` int(11) NOT NULL,
					`entryId` int(11) NOT NULL,
					`value` int(11),
					`remark` varchar(255) NULL,	
					`reason` varchar(255) NULL,	
					`created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
					`updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
					PRIMARY KEY id (id)

					);";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);                
            }

		// }else{
		// 	wp_die( __('Sorry, but this plugin requires the Gravity form Plugin to be installed and active.') );
		// }
	}

}
