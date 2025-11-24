<?php
/**
 * Example Module
 *
 * A sample module demonstrating how to create custom modules for the Boilerplate Plugin
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/modules/example-module
 * @since      2.0.0
 * @description Example module demonstrating hooks, filters, shortcodes, and admin functionality
 */

defined( 'ABSPATH' ) || exit;

/**
 * Example Module class.
 *
 * This is a sample module that demonstrates how to create custom modules
 * for the Boilerplate Plugin. Modules are automatically loaded and initialized.
 *
 * @since      2.0.0
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/modules/example-module
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Module_ExampleModule {

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
		$this->name    = 'example-module';
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
		// Add your initialization code here
		$this->register_hooks();
		$this->register_shortcodes();
	}

	/**
	 * Register WordPress hooks.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function register_hooks() {
		// Example: Add an action hook
		add_action( 'wp_head', array( $this, 'add_custom_meta' ) );
		
		// Example: Add a filter hook
		add_filter( 'the_content', array( $this, 'modify_content' ) );
		
		// Example: Add admin hooks
		if ( is_admin() ) {
			add_action( 'admin_init', array( $this, 'admin_init' ) );
		}
	}

	/**
	 * Register shortcodes.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function register_shortcodes() {
		// Example: Register a shortcode
		add_shortcode( 'example_module', array( $this, 'example_shortcode' ) );
	}

	/**
	 * Add custom meta to the head section.
	 *
	 * @since    2.0.0
	 */
	public function add_custom_meta() {
		// Check if this module is currently enabled before adding meta
		$settings = Boilerplate_Settings::instance();
		$enabled_modules = $settings->get( 'enabled_modules', array() );

		// If this module is not in the enabled modules list, don't output anything
		if ( ! in_array( 'example-module', $enabled_modules, true ) ) {
			return; // Module is disabled, don't output anything
		}

		echo '<meta name="example-module" content="This is from the example module" />' . "\n";
	}

	/**
	 * Modify post content.
	 *
	 * @since    2.0.0
	 * @param    string $content The post content.
	 * @return   string Modified post content.
	 */
	public function modify_content( $content ) {
		// Check if this module is currently enabled before modifying content
		$settings = Boilerplate_Settings::instance();
		$enabled_modules = $settings->get( 'enabled_modules', array() );

		// If this module is not in the enabled modules list, return content unchanged
		if ( ! in_array( 'example-module', $enabled_modules, true ) ) {
			return $content; // Module is disabled, return content unchanged
		}

		// Only modify content on single posts
		if ( is_single() ) {
			$custom_text = '<p><em>This content was modified by the Example Module.</em></p>';
			$content = $custom_text . $content;
		}

		return $content;
	}

	/**
	 * Admin initialization.
	 *
	 * @since    2.0.0
	 */
	public function admin_init() {
		// Add admin-specific functionality here
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
	}

	/**
	 * Display admin notice.
	 *
	 * @since    2.0.0
	 */
	public function admin_notice() {
		?>
		<div class="notice notice-info">
			<p><?php esc_html_e( 'Example Module is active!', 'boilerplate-plugin' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Example shortcode callback.
	 *
	 * @since    2.0.0
	 * @param    array  $atts    Shortcode attributes.
	 * @param    string $content Shortcode content.
	 * @return   string Shortcode output.
	 */
	public function example_shortcode( $atts, $content = null ) {
		// Check if this module is currently enabled before processing the shortcode
		$settings = Boilerplate_Settings::instance();
		$enabled_modules = $settings->get( 'enabled_modules', array() );

		// If this module is not in the enabled modules list, return empty string
		if ( ! in_array( 'example-module', $enabled_modules, true ) ) {
			return ''; // Module is disabled, don't output anything
		}

		$atts = shortcode_atts( array(
			'title' => 'Example Module',
			'class' => 'example-module',
		), $atts, 'example_module' );

		ob_start();
		?>
		<div class="<?php echo esc_attr( $atts['class'] ); ?>">
			<h3><?php echo esc_html( $atts['title'] ); ?></h3>
			<?php if ( $content ) : ?>
				<div class="content">
					<?php echo wp_kses_post( $content ); ?>
				</div>
			<?php endif; ?>
			<p><small>Powered by Example Module</small></p>
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

	/**
	 * Cleanup the module - remove any registered hooks, shortcodes, etc.
	 *
	 * @since    2.0.0
	 */
	public function cleanup() {
		// WordPress doesn't provide methods to remove registered hooks/shortcodes
		// Perform any other cleanup tasks here if needed
	}
}
