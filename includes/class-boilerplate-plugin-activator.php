<?php
/**
 * Fired during plugin activation
 *
 * @link       https://example.com
 * @since      2.0.0
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 */

defined( 'ABSPATH' ) || exit;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.0.0
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Activator {

	/**
	 * Run during plugin activation.
	 *
	 * This method is called when the plugin is activated.
	 *
	 * @since    2.0.0
	 */
	public static function activate() {
		// Set the version on activation
		update_option( 'boilerplate_version', '2.0.0' );
		
		// Initialize default settings
		$defaults = array(
			'version' => '2.0.0',
		);
		add_option( 'boilerplate_settings', $defaults );
		
		// Add any other activation tasks here
		Boilerplate_Utils::log( 'Boilerplate Plugin activated successfully' );
	}
}