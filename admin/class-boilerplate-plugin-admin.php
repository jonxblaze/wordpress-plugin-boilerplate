<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/admin
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name    The name of this plugin.
	 * @param    string    $version        The version of this plugin.
	 */
	public function __construct( 
		$plugin_name, 
		$version 
	) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Boilerplate_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Boilerplate_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'css/boilerplate-plugin-admin.css', 
			array(), 
			$this->version, 
			'all' 
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Boilerplate_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Boilerplate_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'js/boilerplate-plugin-admin.js', 
			array( 'jquery' ), 
			$this->version, 
			false 
		);
	}

	/**
	 * Display a "Hello World" message in the admin area.
	 *
	 * @since    1.0.0
	 */
	public function hello_world_notice() {
		/**
		 * This is a simple example function that displays a "Hello World" notice
		 * in the WordPress admin area.
		 *
		 * The Boilerplate_Plugin_Loader will register this function with the 
		 * 'admin_notices' hook when the plugin is loaded.
		 */
		// Only show the notice on the plugins page
		$screen = get_current_screen();
		if ( $screen && $screen->id !== 'plugins' ) {
			return;
		}
		?>
		<div class="notice notice-info is-dismissible">
			<p><?php esc_html_e( 'Hello World! This is a sample function from the Boilerplate Plugin.', 'boilerplate-plugin' ); ?></p>
		</div>
		<?php
	}

}