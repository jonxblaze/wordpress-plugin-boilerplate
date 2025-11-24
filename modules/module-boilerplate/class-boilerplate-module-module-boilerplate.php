<?php
/**
 * Module Boilerplate
 *
 * A starter template for creating new modules for the Boilerplate Plugin
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/modules/module-boilerplate
 * @since      2.0.0
 * @description A starter template for creating new modules for the Boilerplate Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Module Boilerplate class.
 *
 * This is a starter template module that demonstrates how to create custom modules
 * for the Boilerplate Plugin. Copy this file to create your own modules.
 *
 * @since      2.0.0
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/modules/module-boilerplate
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Module_ModuleBoilerplate {

	/**
	 * Module name.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $name    The name of this module.
	 */
	protected $name;

	/**
	 * Module version.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $version    The current version of this module.
	 */
	protected $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 */
	public function __construct() {
		$this->name    = 'module-boilerplate';
		$this->version = '1.0.0';
	}

	/**
	 * Initialize the module.
	 *
	 * This method is called automatically by the module manager when the module is enabled.
	 * Add your hooks, filters, shortcodes, and initialization code here.
	 *
	 * @since    2.0.0
	 */
	public function init() {
		// Register your module's functionality when the module is initialized
		$this->register_hooks();
		$this->register_shortcodes();

	}

	/**
	 * Register WordPress hooks for this module.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function register_hooks() {
		// Example: Add an action hook
		// add_action( 'wp_head', array( $this, 'add_custom_meta' ) );

		// Example: Add a filter hook
		// add_filter( 'the_content', array( $this, 'modify_content' ) );

		// Example: Add admin hooks (only if in admin area)
		// if ( is_admin() ) {
		//     add_action( 'admin_init', array( $this, 'admin_init' ) );
		// }
	}

	/**
	 * Register shortcodes for this module.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function register_shortcodes() {
		// Example: Register a shortcode
		// add_shortcode( 'your_shortcode', array( $this, 'your_shortcode_callback' ) );
	}

	/*
	 * ============= EXAMPLE CALLBACK METHODS =============
	 * Uncomment and customize these methods as needed for your module
	 */

	/**
	 * Example: Add custom meta to the head section.
	 *
	 * @since    2.0.0
	 */
	// public function add_custom_meta() {
	//     // Check if module is enabled before executing functionality
	//     if ( ! $this->is_module_enabled() ) {
	//         return;
	//     }
	//
	//     echo '<meta name="your-module" content="This is from your custom module" />' . "\n";
	// }

	/**
	 * Example: Modify post content.
	 *
	 * @since    2.0.0
	 * @param    string $content The post content.
	 * @return   string Modified post content.
	 */
	// public function modify_content( $content ) {
	//     // Check if module is enabled before executing functionality
	//     if ( ! $this->is_module_enabled() ) {
	//         return $content; // Return content unchanged if module is disabled
	//     }
	//
	//     // Only modify content on single posts
	//     if ( is_single() ) {
	//         $custom_text = '<p><em>This content was modified by your custom module.</em></p>';
	//         $content = $custom_text . $content;
	//     }
	//
	//     return $content;
	// }

	/**
	 * Example: Admin initialization.
	 *
	 * @since    2.0.0
	 */
	// public function admin_init() {
	//     // Check if module is enabled before executing functionality
	//     if ( ! $this->is_module_enabled() ) {
	//         return;
	//     }
	//
	//     // Add admin-specific functionality here
	//     add_action( 'admin_notices', array( $this, 'admin_notice' ) );
	// }

	/**
	 * Example: Display admin notice.
	 *
	 * @since    2.0.0
	 */
	// public function admin_notice() {
	//     // Check if module is enabled before executing functionality
	//     if ( ! $this->is_module_enabled() ) {
	//         return;
	//     }
	//
	//     // Output admin notice
	//     echo '<div class="notice notice-info">';
	//     echo '<p>' . esc_html__( 'Your custom module is active!', 'boilerplate-plugin' ) . '</p>';
	//     echo '</div>';
	// }

	/**
	 * Example: Sample shortcode callback.
	 *
	 * @since    2.0.0
	 * @param    array  $atts    Shortcode attributes.
	 * @param    string $content Shortcode content.
	 * @return   string Shortcode output.
	 */
	// public function your_shortcode_callback( $atts, $content = null ) {
	//     // Check if module is enabled before executing functionality
	//     if ( ! $this->is_module_enabled() ) {
	//         return ''; // Return empty string if module is disabled
	//     }
	//
	//     $atts = shortcode_atts( array(
	//         'title' => 'Your Module',
	//         'class' => 'your-module-class',
	//     ), $atts, 'your_shortcode' );
	//
	//     $output = '<div class="' . esc_attr( $atts['class'] ) . '">';
	//     $output .= '<h3>' . esc_html( $atts['title'] ) . '</h3>';
	//     if ( $content ) {
	//         $output .= '<div class="content">' . wp_kses_post( $content ) . '</div>';
	//     }
	//     $output .= '<p><small>Powered by Your Module</small></p>';
	//     $output .= '</div>';
	//
	//     return $output;
	// }

	/**
	 * Check if this module is currently enabled.
	 *
	 * This method should be called in all module functionality to ensure
	 * the module is enabled before executing any code.
	 *
	 * @since     2.0.0
	 * @return    bool True if module is enabled, false otherwise.
	 */
	public function is_module_enabled() {
		$settings = Boilerplate_Settings::instance();
		$enabled_modules = $settings->get( 'enabled_modules', array() );

		return in_array( $this->name, $enabled_modules, true );
	}

	/**
	 * Cleanup the module - remove any registered hooks, shortcodes, etc.
	 *
	 * This method is called when the module is disabled.
	 *
	 * @since    2.0.0
	 */
	public function cleanup() {
		// Perform any cleanup tasks when the module is disabled
		// Note: WordPress doesn't provide methods to remove registered hooks/shortcodes,
		// but you can perform other cleanup tasks here
	}

	/**
	 * Get module name.
	 *
	 * @since     2.0.0
	 * @return    string    The name of the module.
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Get module version.
	 *
	 * @since     2.0.0
	 * @return    string    The version number of the module.
	 */
	public function get_version() {
		return $this->version;
	}
}