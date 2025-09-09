<?php
/**
 * Plugin Name:       Boilerplate Plugin
 * Plugin URI:        https://example.com/plugins/boilerplate-plugin/
 * Description:       A clean, reusable boilerplate for WordPress plugins following best practices.
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Your Name
 * Author URI:        https://example.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       boilerplate-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'BOILERPLATE_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-boilerplate-plugin-activator.php
 */
function activate_boilerplate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boilerplate-plugin-activator.php';
	Boilerplate_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-boilerplate-plugin-deactivator.php
 */
function deactivate_boilerplate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boilerplate-plugin-deactivator.php';
	Boilerplate_Plugin_Deactivator::deactivate();
}

// Register activation and deactivation hooks
register_activation_hook( 
	__FILE__, 
	'activate_boilerplate_plugin' 
);

register_deactivation_hook( 
	__FILE__, 
	'deactivate_boilerplate_plugin' 
);

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-boilerplate-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_boilerplate_plugin() {
	$plugin = new Boilerplate_Plugin();
	$plugin->run();
}

// Initialize the plugin
run_boilerplate_plugin();