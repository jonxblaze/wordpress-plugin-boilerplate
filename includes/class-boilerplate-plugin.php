<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://example.com
 * @since      2.0.0
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      2.0.0
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      Boilerplate_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Settings instance.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      Boilerplate_Settings    $settings    Plugin settings.
	 */
	protected $settings;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function __construct() {
		$this->plugin_name = Boilerplate_Constants::PLUGIN_NAME;
		$this->version     = Boilerplate_Constants::VERSION;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Boilerplate_Loader. Orchestrates the hooks of the plugin.
	 * - Boilerplate_i18n. Defines internationalization functionality.
	 * - Boilerplate_Admin. Defines all hooks for the admin area.
	 * - Boilerplate_Public. Defines all hooks for the public side of the site.
	 * - Boilerplate_Settings. Manages plugin settings.
	 * - Boilerplate_Upgrade. Handles plugin upgrades.
	 * - Boilerplate_Utils. Provides utility functions.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		// Include utility classes first
		require_once Boilerplate_Constants::plugin_dir( 'includes/class-boilerplate-constants.php' );
		require_once Boilerplate_Constants::plugin_dir( 'includes/class-boilerplate-utils.php' );
		require_once Boilerplate_Constants::plugin_dir( 'includes/class-boilerplate-settings.php' );
		require_once Boilerplate_Constants::plugin_dir( 'includes/class-boilerplate-upgrade.php' );

		// Include the loader
		require_once Boilerplate_Constants::plugin_dir( 'includes/class-boilerplate-loader.php' );
		$this->loader = new Boilerplate_Loader();

		// Initialize settings
		$this->settings = Boilerplate_Settings::instance();

		// Include internationalization
		require_once Boilerplate_Constants::plugin_dir( 'includes/class-boilerplate-i18n.php' );

		// Include admin and public classes
		require_once Boilerplate_Constants::plugin_dir( 'admin/class-boilerplate-admin.php' );
		require_once Boilerplate_Constants::plugin_dir( 'public/class-boilerplate-public.php' );
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Boilerplate_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Boilerplate_i18n();
		$plugin_i18n->set_domain( Boilerplate_Constants::TEXT_DOMAIN );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Boilerplate_Admin( $this->get_plugin_name(), $this->get_version(), $this->settings );

		// Enqueue styles and scripts
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Admin menu and settings
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'init_settings' );

		// Admin notices
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'admin_notices' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Boilerplate_Public( $this->get_plugin_name(), $this->get_version(), $this->settings );

		// Enqueue styles and scripts
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Register shortcodes
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );
		$this->loader->add_action( 'init', $plugin_public, 'init' );
	}

	/**
	 * Register general hooks that don't fit in admin or public categories.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_hooks() {
		// Handle upgrades on plugin activation/initialization
		$this->loader->add_action( 'plugins_loaded', $this, 'maybe_upgrade' );
	}

	/**
	 * Check if upgrade is needed and perform if necessary.
	 *
	 * @since    2.0.0
	 */
	public function maybe_upgrade() {
		Boilerplate_Upgrade::maybe_upgrade();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    2.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.0.0
	 * @return    Boilerplate_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the settings instance.
	 *
	 * @since     2.0.0
	 * @return    Boilerplate_Settings    The settings instance.
	 */
	public function get_settings() {
		return $this->settings;
	}
}