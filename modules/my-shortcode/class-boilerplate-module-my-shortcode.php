<?php
/**
 * My Shortcode Module
 *
 * A module that provides a shortcode to display "Hello World"
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/modules/my-shortcode
 * @since      2.0.0
 * @description A module that provides a [hello_world] shortcode to display "Hello World"
 * @author     Your Name
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Shortcode Module class.
 *
 * This module provides a shortcode to display "Hello World".
 *
 * @since      2.0.0
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/modules/my-shortcode
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Module_MyShortcode {

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
		$this->name    = 'my-shortcode';
		$this->version = '1.0.0';
	}

	/**
	 * Initialize the module.
	 *
	 * This method is called automatically by the module manager.
	 * Add your hooks, filters, and initialization code here.
	 *
	 * @since    2.0.0
	 */
	public function init() {
		// Register the shortcode when the module is initialized
		$this->register_shortcodes();
	}

	/**
	 * Register shortcodes.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function register_shortcodes() {
		// Register the hello world shortcode
		add_shortcode( 'hello_world', array( $this, 'hello_world_shortcode' ) );
		add_shortcode( 'boilerplate_hello', array( $this, 'hello_world_shortcode' ) );
	}

	/**
	 * Cleanup the module - remove any registered hooks, shortcodes, etc.
	 *
	 * @since    2.0.0
	 */
	public function cleanup() {
		// Note: WordPress core doesn't provide remove_shortcode, so shortcodes will remain
		// registered for the remainder of this request. On subsequent requests, the module
		// won't be loaded if it's disabled, so the shortcode won't be registered.
	}

	/**
	 * Hello World shortcode callback.
	 *
	 * @since    2.0.0
	 * @param    array  $atts    Shortcode attributes.
	 * @param    string $content Shortcode content.
	 * @return   string Shortcode output.
	 */
	public function hello_world_shortcode( $atts = array(), $content = null ) {
		// Check if this module is currently enabled before processing the shortcode
		$settings = Boilerplate_Settings::instance();
		$enabled_modules = $settings->get( 'enabled_modules', array() );

		// If this module is not in the enabled modules list, return empty string
		if ( ! in_array( 'my-shortcode', $enabled_modules, true ) ) {
			return ''; // Module is disabled, don't output anything
		}

		// Parse attributes with defaults
		$atts = shortcode_atts( array(
			'class' => 'boilerplate-hello',
			'message' => 'Hello World!',
		), $atts, 'hello_world' );

		// Sanitize the message
		$message = sanitize_text_field( $atts['message'] );

		// Build the output HTML
		ob_start();
		?>
		<div class="<?php echo esc_attr( $atts['class'] ); ?>">
			<p><?php echo esc_html( $message ); ?></p>
		</div>
		<?php
		return ob_get_clean();
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