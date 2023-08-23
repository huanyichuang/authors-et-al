<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://huanyichuang.com/
 * @since      1.0.0
 *
 * @package    Authors_Et_Al
 * @subpackage Authors_Et_Al/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Authors_Et_Al
 * @subpackage Authors_Et_Al/includes
 * @author     Eric Chuang <huanyi.chuang@gmail.com>
 */
class Authors_Et_Al_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'authors-et-al',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
