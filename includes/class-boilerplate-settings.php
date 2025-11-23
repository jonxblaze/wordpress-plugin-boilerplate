<?php
/**
 * Plugin Settings
 *
 * Handles plugin settings and options
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 * @since      2.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin settings and options.
 */
class Boilerplate_Settings {

	/**
	 * Instance of this class.
	 *
	 * @var Boilerplate_Settings
	 */
	private static $instance = null;

	/**
	 * Settings array.
	 *
	 * @var array
	 */
	private $settings = array();

	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct() {
		$this->load_settings();
	}

	/**
	 * Private clone method to prevent cloning of the *Singleton* instance.
	 */
	private function __clone() {}

	/**
	 * Private unserialize method to prevent unserializing of the *Singleton*
	 * instance.
	 */
	public function __wakeup() {}

	/**
	 * Return an instance of this class.
	 *
	 * @return Boilerplate_Settings A single instance of this class.
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Load settings from database.
	 */
	private function load_settings() {
		$saved_settings = get_option( Boilerplate_Constants::OPTION_NAME, array() );
		
		// Sanitize loaded settings
		if ( is_array( $saved_settings ) ) {
			$saved_settings = Boilerplate_Utils::sanitize_array( $saved_settings );
		} else {
			$saved_settings = array();
		}
		
		$this->settings = wp_parse_args( $saved_settings, $this->get_defaults() );
	}

	/**
	 * Get default settings.
	 *
	 * @return array
	 */
	private function get_defaults() {
		return array(
			'version' => Boilerplate_Constants::VERSION,
			'enabled_modules' => array(),
		);
	}

	/**
	 * Get a setting value.
	 *
	 * @param string $key Setting key.
	 * @param mixed  $default Default value if key doesn't exist.
	 * @return mixed
	 */
	public function get( $key, $default = null ) {
		return isset( $this->settings[ $key ] ) ? $this->settings[ $key ] : $default;
	}

	/**
	 * Set a setting value.
	 *
	 * @param string $key Setting key.
	 * @param mixed  $value Setting value.
	 */
	public function set( $key, $value ) {
		$this->settings[ $key ] = $value;
	}

	/**
	 * Save settings to database.
	 */
	public function save() {
		update_option( Boilerplate_Constants::OPTION_NAME, $this->settings );
	}

	/**
	 * Reset settings to defaults.
	 */
	public function reset() {
		$this->settings = $this->get_defaults();
		$this->save();
	}
}
