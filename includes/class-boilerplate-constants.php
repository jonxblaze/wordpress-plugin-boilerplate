<?php
/**
 * Plugin Constants
 *
 * Defines all plugin-related constants
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 * @since      2.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Define plugin constants for better maintainability.
 */
class Boilerplate_Constants {

	/**
	 * Plugin version.
	 */
	const VERSION = '2.0.1';

	/**
	 * Plugin name (slug).
	 */
	const PLUGIN_NAME = 'boilerplate-plugin';

	/**
	 * Plugin text domain for translations.
	 */
	const TEXT_DOMAIN = 'boilerplate-plugin';

	/**
	 * Database option name for storing plugin settings.
	 */
	const OPTION_NAME = 'boilerplate_plugin_options';

	/**
	 * Database option name for storing plugin version.
	 */
	const VERSION_OPTION = 'boilerplate_version';

	/**
	 * Plugin directory path.
	 *
	 * @param string $path Optional. Additional path to append.
	 * @return string
	 */
	public static function plugin_dir( $path = '' ) {
		return plugin_dir_path( dirname( __FILE__ ) ) . $path;
	}

	/**
	 * Plugin directory URL.
	 *
	 * @param string $path Optional. Additional path to append.
	 * @return string
	 */
	public static function plugin_url( $path = '' ) {
		return plugin_dir_url( dirname( __FILE__ ) ) . $path;
	}
}
