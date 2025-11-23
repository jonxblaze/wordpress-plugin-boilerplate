<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://example.com
 * @since             2.0.0
 * @package           Boilerplate_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Boilerplate Plugin
 * Plugin URI:        https://example.com/plugins/boilerplate-plugin/
 * Description:       A clean, reusable boilerplate for WordPress plugins following best practices. Version 2.0 includes improved architecture, settings management, and upgrade handling.
 * Version:           2.0.0
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
 * The code that runs during plugin activation.
 * This action is documented in includes/class-boilerplate-activator.php
 */
function activate_boilerplate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boilerplate-activator.php';
	Boilerplate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-boilerplate-deactivator.php
 */
function deactivate_boilerplate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boilerplate-deactivator.php';
	Boilerplate_Deactivator::deactivate();
}

// Register activation and deactivation hooks
register_activation_hook( __FILE__, 'activate_boilerplate_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_boilerplate_plugin' );

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
 * @since    2.0.0
 */
function run_boilerplate_plugin() {
	$plugin = new Boilerplate_Plugin();
	$plugin->run();
}

// Initialize the plugin
run_boilerplate_plugin();
