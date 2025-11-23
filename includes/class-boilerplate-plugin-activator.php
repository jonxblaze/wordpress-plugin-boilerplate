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
		update_option( Boilerplate_Constants::VERSION_OPTION, Boilerplate_Constants::VERSION );
		
		// Initialize default settings
		$defaults = array(
			'version' => Boilerplate_Constants::VERSION,
		);
		add_option( Boilerplate_Constants::OPTION_NAME, $defaults );
		
		// Add any other activation tasks here
		Boilerplate_Utils::log( 'Boilerplate Plugin activated successfully' );
	}
}
