<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://example.com
 * @since      2.0.0
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 */

defined( 'ABSPATH' ) || exit;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      2.0.0
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Deactivator {

	/**
	 * Run during plugin deactivation.
	 *
	 * This method is called when the plugin is deactivated.
	 *
	 * @since    2.0.0
	 */
	public static function deactivate() {
		// Add any deactivation tasks here
		Boilerplate_Utils::log( 'Boilerplate Plugin deactivated' );
	}
}