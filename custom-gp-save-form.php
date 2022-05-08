<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://localhost
 * @since             1.0.0
 * @package           Custom_Gp_Save_Form
 *
 * @wordpress-plugin
 * Plugin Name:       Custom GP Save Form
 * Plugin URI:        
 * Description:       Use this shortcode <strong>[Custom_gp_show_hr_zone_shortcode]</strong>, also use '<strong>hr-zone</strong>' page as page permalink.
 * Version:           1.1.11111
 * Author:            Expert Coder
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-gp-save-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CUSTOM_GP_SAVE_FORM_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-gp-save-form-activator.php
 */
function activate_custom_gp_save_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-gp-save-form-activator.php';
	Custom_Gp_Save_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-gp-save-form-deactivator.php
 */
function deactivate_custom_gp_save_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-gp-save-form-deactivator.php';
	Custom_Gp_Save_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_gp_save_form' );
register_deactivation_hook( __FILE__, 'deactivate_custom_gp_save_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-gp-save-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_gp_save_form() {

	$plugin = new Custom_Gp_Save_Form();
	$plugin->run();

}
run_custom_gp_save_form();










