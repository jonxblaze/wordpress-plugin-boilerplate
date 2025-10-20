<?php
/**
 * Plugin Upgrade Handler
 *
 * Handles plugin upgrades and version migrations
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 * @since      2.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin upgrades and version migrations.
 */
class Boilerplate_Upgrade {

	/**
	 * Check if upgrade is needed and perform if necessary.
	 */
	public static function maybe_upgrade() {
		$saved_version = get_option( Boilerplate_Constants::VERSION_OPTION, '1.0.0' );
		$current_version = Boilerplate_Constants::VERSION;

		if ( version_compare( $saved_version, $current_version, '<' ) ) {
			self::perform_upgrade( $saved_version, $current_version );
			update_option( Boilerplate_Constants::VERSION_OPTION, $current_version );
		}
	}

	/**
	 * Perform the upgrade process.
	 *
	 * @param string $old_version Previous version.
	 * @param string $new_version New version.
	 */
	private static function perform_upgrade( $old_version, $new_version ) {
		// Log the upgrade
		error_log( sprintf(
			'Boilerplate Plugin: Upgrading from %s to %s',
			$old_version,
			$new_version
		) );

		// Handle specific version upgrades
		if ( version_compare( $old_version, '2.0.0', '<' ) ) {
			self::upgrade_to_200();
		}

		// Add more version-specific upgrade functions as needed
	}

	/**
	 * Upgrade routine for version 2.0.0.
	 */
	private static function upgrade_to_200() {
		// Perform upgrade steps for version 2.0.0
		// Example: update database schema, migrate settings, etc.
	}
}