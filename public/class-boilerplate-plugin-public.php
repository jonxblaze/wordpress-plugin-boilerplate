<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://example.com
 * @since      2.0.0
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/public
 */

defined( 'ABSPATH' ) || exit;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and handles all public-facing operations.
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/public
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Settings instance.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      Boilerplate_Settings    $settings    Plugin settings.
	 */
	private $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param    string              $plugin_name The name of the plugin.
	 * @param    string              $version     The version of this plugin.
	 * @param    Boilerplate_Settings $settings    Plugin settings.
	 */
	public function __construct( $plugin_name, $version, $settings ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->settings    = $settings;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			$this->plugin_name . '-public',
			Boilerplate_Constants::plugin_url( 'public/css/boilerplate-plugin-public.css' ),
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			$this->plugin_name . '-public',
			Boilerplate_Constants::plugin_url( 'public/js/boilerplate-plugin-public.js' ),
			array( 'jquery' ),
			$this->version,
			true
		);
	}

	/**
	 * Register shortcodes.
	 *
	 * @since    2.0.0
	 */
	public function register_shortcodes() {
		// Add your shortcode registrations here
		// Example: add_shortcode( 'your_shortcode', array( $this, 'your_shortcode_function' ) );
	}

	/**
	 * Initialize public functionality.
	 *
	 * @since    2.0.0
	 */
	public function init() {
		// Add any initialization code that needs to run on 'init' hook
	}
}