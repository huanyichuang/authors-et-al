<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://huanyichuang.com/
 * @since             1.0.0
 * @package           Authors_Et_Al
 *
 * @wordpress-plugin
 * Plugin Name:       Authors et al
 * Plugin URI:        https://huanyichuang.com/
 * Description:       This plugin will enable you to select multiple authors for the single posts.
 * Version:           0.5.0
 * Author:            Eric Chuang
 * Author URI:        https://huanyichuang.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       authors-et-al
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
define( 'AUTHORS_ET_AL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-authors-et-al-activator.php
 */
function activate_authors_et_al() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-authors-et-al-activator.php';
	Authors_Et_Al_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-authors-et-al-deactivator.php
 */
function deactivate_authors_et_al() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-authors-et-al-deactivator.php';
	Authors_Et_Al_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_authors_et_al' );
register_deactivation_hook( __FILE__, 'deactivate_authors_et_al' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-authors-et-al.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_authors_et_al() {

	$plugin = new Authors_Et_Al();
	$plugin->run();

}
run_authors_et_al();
