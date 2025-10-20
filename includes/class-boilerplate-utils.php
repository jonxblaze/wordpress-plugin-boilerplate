<?php
/**
 * Plugin Utilities
 *
 * Common utility functions for the plugin
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 * @since      2.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Common utility functions for the plugin.
 */
class Boilerplate_Utils {

	/**
	 * Check if current page is admin.
	 *
	 * @return bool
	 */
	public static function is_admin() {
		return is_admin();
	}

	/**
	 * Check if current page is AJAX request.
	 *
	 * @return bool
	 */
	public static function is_ajax() {
		return defined( 'DOING_AJAX' ) && DOING_AJAX;
	}

	/**
	 * Check if doing cron.
	 *
	 * @return bool
	 */
	public static function is_cron() {
		return defined( 'DOING_CRON' ) && DOING_CRON;
	}

	/**
	 * Check if in WordPress loop.
	 *
	 * @return bool
	 */
	public static function in_loop() {
		return in_the_loop();
	}

	/**
	 * Get plugin basename.
	 *
	 * @return string
	 */
	public static function plugin_basename() {
		return plugin_basename( dirname( dirname( __FILE__ ) ) . '/boilerplate-plugin.php' );
	}

	/**
	 * Log a message to WordPress error log.
	 *
	 * @param string $message Message to log.
	 * @param string $level Log level (info, warning, error).
	 */
	public static function log( $message, $level = 'info' ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$log_message = sprintf(
				'[%s] Boilerplate Plugin: %s',
				strtoupper( $level ),
				$message
			);
			error_log( $log_message );
		}
	}

	/**
	 * Sanitize multi-dimensional array.
	 *
	 * @param array $data Data to sanitize.
	 * @return array
	 */
	public static function sanitize_array( $data ) {
		if ( ! is_array( $data ) ) {
			return sanitize_text_field( $data );
		}

		foreach ( $data as $key => $value ) {
			if ( is_array( $value ) ) {
				$data[ $key ] = self::sanitize_array( $value );
			} else {
				$data[ $key ] = sanitize_text_field( $value );
			}
		}

		return $data;
	}
}