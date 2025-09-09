<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/public
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Plugin_Public {

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
	 * @param    string    $plugin_name    The name of the plugin.
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
	 * Register the stylesheets for the public-facing side of the site.
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
			plugin_dir_url( __FILE__ ) . 'css/boilerplate-plugin-public.css', 
			array(), 
			$this->version, 
			'all' 
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
			plugin_dir_url( __FILE__ ) . 'js/boilerplate-plugin-public.js', 
			array( 'jquery' ), 
			$this->version, 
			false 
		);
	}

	/**
	 * Register the shortcode for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		/**
		 * Register the [boilerplate_hello] shortcode with WordPress.
		 * 
		 * The Boilerplate_Plugin_Loader will register this function with the 
		 * 'init' hook when the plugin is loaded.
		 */
		add_shortcode( 'boilerplate_hello', array( $this, 'hello_world_shortcode' ) );
	}

	/**
	 * Display a "Hello World" message via shortcode.
	 *
	 * @since    1.0.0
	 * @param    array     $atts       Shortcode attributes
	 * @param    string    $content    Shortcode content
	 * @return   string                HTML output
	 */
	public function hello_world_shortcode( 
		$atts, 
		$content = null 
	) {
		/**
		 * This is a simple example function that returns a "Hello World" message
		 * when the [boilerplate_hello] shortcode is used.
		 *
		 * The Boilerplate_Plugin_Loader will register this function with the 
		 * 'init' hook when the plugin is loaded.
		 */
		// Parse shortcode attributes
		$atts = shortcode_atts( 
			array(
				'name' => 'World',
			), 
			$atts, 
			'boilerplate_hello' 
		);

		// Sanitize the name attribute
		$name = sanitize_text_field( $atts['name'] );

		// Return the HTML output
		return '<div class="boilerplate-hello"><p>Hello ' . 
			esc_html( $name ) . 
			'! This is a sample shortcode from the Boilerplate Plugin.</p></div>';
	}

}