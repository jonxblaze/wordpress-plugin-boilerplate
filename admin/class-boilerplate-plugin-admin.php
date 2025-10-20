<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://example.com
 * @since      2.0.0
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/admin
 */

defined( 'ABSPATH' ) || exit;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and handles all admin-related operations.
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/admin
 * @author     Your Name <email@example.com>
 */
class Boilerplate_Admin {

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
	 * @param    string              $plugin_name The name of this plugin.
	 * @param    string              $version     The version of this plugin.
	 * @param    Boilerplate_Settings $settings    Plugin settings.
	 */
	public function __construct( $plugin_name, $version, $settings ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->settings    = $settings;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			$this->plugin_name . '-admin',
			Boilerplate_Constants::plugin_url( 'admin/css/boilerplate-plugin-admin.css' ),
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			$this->plugin_name . '-admin',
			Boilerplate_Constants::plugin_url( 'admin/js/boilerplate-plugin-admin.js' ),
			array( 'jquery' ),
			$this->version,
			true
		);
	}

	/**
	 * Add admin menu items.
	 *
	 * @since    2.0.0
	 */
	public function add_admin_menu() {
		add_options_page(
			'Boilerplate Plugin Settings',
			'Boilerplate Plugin',
			'manage_options',
			'boilerplate-plugin',
			array( $this, 'display_admin_page' )
		);
	}

	/**
	 * Display the admin page.
	 *
	 * @since    2.0.0
	 */
	public function display_admin_page() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'boilerplate_settings' );
				do_settings_sections( 'boilerplate-plugin' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Initialize settings.
	 *
	 * @since    2.0.0
	 */
	public function init_settings() {
		register_setting( 'boilerplate_settings', Boilerplate_Constants::OPTION_NAME );

		add_settings_section(
			'boilerplate_main_settings',
			'Main Settings',
			array( $this, 'settings_section_callback' ),
			'boilerplate-plugin'
		);

		add_settings_field(
			'example_setting',
			'Example Setting',
			array( $this, 'example_setting_callback' ),
			'boilerplate-plugin',
			'boilerplate_main_settings'
		);
	}

	/**
	 * Settings section callback.
	 *
	 * @since    2.0.0
	 */
	public function settings_section_callback() {
		echo '<p>Configure your Boilerplate Plugin settings here.</p>';
	}

	/**
	 * Example setting field callback.
	 *
	 * @since    2.0.0
	 */
	public function example_setting_callback() {
		$settings = $this->settings->get( 'example_setting', 'default_value' );
		?>
		<input type="text" name="<?php echo esc_attr( Boilerplate_Constants::OPTION_NAME ); ?>[example_setting]" 
			   value="<?php echo esc_attr( $settings ); ?>" 
			   class="regular-text" />
		<p class="description">An example setting field.</p>
		<?php
	}

	/**
	 * Display a "Hello World" message in the admin area.
	 *
	 * @since    2.0.0
	 */
	public function admin_notices() {
		// Only show the notice on the plugins page
		$screen = get_current_screen();
		if ( $screen && strpos( $screen->id, 'plugins' ) !== false ) {
			?>
			<div class="notice notice-info is-dismissible">
				<p><?php esc_html_e( 'Hello World! This is a sample notice from the Boilerplate Plugin.', 'boilerplate-plugin' ); ?></p>
			</div>
			<?php
		}
	}
}