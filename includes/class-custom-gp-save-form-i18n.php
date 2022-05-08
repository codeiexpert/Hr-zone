<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://localhost
 * @since      1.0.0
 *
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Custom_Gp_Save_Form
 * @subpackage Custom_Gp_Save_Form/includes
 * @author     Expert Coder Singh <codeiexpert82@gmail.com>
 */
class Custom_Gp_Save_Form_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'custom-gp-save-form',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
