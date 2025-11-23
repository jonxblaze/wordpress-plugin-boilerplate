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
		register_setting( 
			'boilerplate_settings', 
			Boilerplate_Constants::OPTION_NAME,
			array(
				'sanitize_callback' => array( $this, 'sanitize_settings' )
			)
		);

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

		// Module Management Section
		add_settings_section(
			'boilerplate_module_settings',
			'Module Management',
			array( $this, 'module_settings_section_callback' ),
			'boilerplate-plugin'
		);

		add_settings_field(
			'enabled_modules',
			'Enabled Modules',
			array( $this, 'enabled_modules_callback' ),
			'boilerplate-plugin',
			'boilerplate_module_settings'
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
	 * Module settings section callback.
	 *
	 * @since    2.0.0
	 */
	public function module_settings_section_callback() {
		echo '<p>Enable or disable plugin modules. Disabled modules will not be loaded.</p>';
	}

	/**
	 * Enabled modules callback.
	 *
	 * @since    2.0.0
	 */
	public function enabled_modules_callback() {
		$enabled_modules = $this->settings->get( 'enabled_modules', array() );
		$module_manager = Boilerplate_Module_Manager::instance();
		$available_modules = $this->get_available_modules();
		
		if ( empty( $available_modules ) ) {
			echo '<p>No modules found in the modules directory.</p>';
			return;
		}
		
		foreach ( $available_modules as $module_name => $module_info ) {
			$is_enabled = in_array( $module_name, $enabled_modules, true );
			$is_loaded = $module_manager->has_module( $module_name );
			$status_class = $is_loaded ? 'module-status-loaded' : 'module-status-disabled';
			$status_text = $is_loaded ? '✓ Loaded' : '✗ Disabled';
			?>
			<div class="module-checkbox-wrapper">
				<label>
					<input type="checkbox" 
						   name="<?php echo esc_attr( Boilerplate_Constants::OPTION_NAME ); ?>[enabled_modules][]" 
						   value="<?php echo esc_attr( $module_name ); ?>" 
						   <?php checked( $is_enabled ); ?> />
					<strong><?php echo esc_html( $module_info['name'] ); ?></strong>
					<span class="module-status <?php echo esc_attr( $status_class ); ?>"><?php echo esc_html( $status_text ); ?></span>
				</label>
				<?php if ( ! empty( $module_info['description'] ) ) : ?>
					<p class="description"><?php echo esc_html( $module_info['description'] ); ?></p>
				<?php endif; ?>
			</div>
			<?php
		}
	}

	/**
	 * Get available modules from the modules directory.
	 *
	 * @since    2.0.0
	 * @return   array
	 */
	private function get_available_modules() {
		$modules = array();
		$modules_dir = Boilerplate_Constants::plugin_dir( 'modules' );
		
		if ( ! is_dir( $modules_dir ) ) {
			return $modules;
		}
		
		$module_dirs = glob( $modules_dir . '/*', GLOB_ONLYDIR );
		
		foreach ( $module_dirs as $module_dir ) {
			$module_name = basename( $module_dir );
			$module_file = $module_dir . '/class-boilerplate-module-' . $module_name . '.php';
			
			if ( file_exists( $module_file ) ) {
				$modules[ $module_name ] = array(
					'name' => $this->format_module_name( $module_name ),
					'description' => $this->get_module_description( $module_file ),
				);
			}
		}
		
		return $modules;
	}

	/**
	 * Format module name for display.
	 *
	 * @since    2.0.0
	 * @param    string $module_name Module directory name.
	 * @return   string
	 */
	private function format_module_name( $module_name ) {
		// Convert dashes and underscores to spaces, then capitalize
		$name = str_replace( array( '-', '_' ), ' ', $module_name );
		return ucwords( $name );
	}

	/**
	 * Get module description from file header.
	 *
	 * @since    2.0.0
	 * @param    string $module_file Module file path.
	 * @return   string
	 */
	private function get_module_description( $module_file ) {
		$default_headers = array(
			'description' => 'Description',
		);
		
		$file_data = get_file_data( $module_file, $default_headers );
		return $file_data['description'] ?? '';
	}

	/**
	 * Sanitize settings before saving.
	 *
	 * @since    2.0.0
	 * @param    array $input The settings input.
	 * @return   array Sanitized settings.
	 */
	public function sanitize_settings( $input ) {
		$sanitized_input = array();
		
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				if ( 'enabled_modules' === $key && is_array( $value ) ) {
					// Sanitize each module name in the enabled_modules array
					$sanitized_input[ $key ] = array_map( 'sanitize_text_field', $value );
				} else {
					$sanitized_input[ $key ] = sanitize_text_field( $value );
				}
			}
		}
		
		return $sanitized_input;
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
