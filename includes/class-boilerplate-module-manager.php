<?php
/**
 * Module Manager
 *
 * Handles automatic loading and management of plugin modules
 *
 * @package    Boilerplate_Plugin
 * @subpackage Boilerplate_Plugin/includes
 * @since      2.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles automatic loading and management of plugin modules.
 */
class Boilerplate_Module_Manager {

	/**
	 * Instance of this class.
	 *
	 * @var Boilerplate_Module_Manager
	 */
	private static $instance = null;

	/**
	 * Loaded modules.
	 *
	 * @var array
	 */
	private $modules = array();

	/**
	 * Module directories.
	 *
	 * @var array
	 */
	private $module_directories = array();

	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct() {
		$this->setup_module_directories();
		$this->load_modules();
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
	 * @return Boilerplate_Module_Manager A single instance of this class.
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Setup module directories.
	 */
	private function setup_module_directories() {
		$this->module_directories = array(
			Boilerplate_Constants::plugin_dir( 'modules' ),
		);

		/**
		 * Filter the module directories.
		 *
		 * @since 2.0.0
		 * @param array $directories Array of module directories.
		 */
		$this->module_directories = apply_filters( 'boilerplate_module_directories', $this->module_directories );
	}

	/**
	 * Load all modules from module directories.
	 */
	private function load_modules() {
		$settings = Boilerplate_Settings::instance();
		$enabled_modules = $settings->get( 'enabled_modules', array() );

		foreach ( $this->module_directories as $directory ) {
			if ( ! is_dir( $directory ) ) {
				continue;
			}

			$module_dirs = glob( $directory . '/*', GLOB_ONLYDIR );

			foreach ( $module_dirs as $module_dir ) {
				$module_name = basename( $module_dir );
				$module_file = $module_dir . '/class-boilerplate-module-' . $module_name . '.php';

				// Check if module is enabled in settings
				$is_enabled = in_array( $module_name, $enabled_modules, true );
				
				// If no enabled_modules setting exists yet, enable all modules by default
				if ( empty( $enabled_modules ) ) {
					$is_enabled = true;
				}

				if ( file_exists( $module_file ) && $is_enabled ) {
					$this->load_module( $module_name, $module_file );
				} elseif ( file_exists( $module_file ) && ! $is_enabled ) {
					Boilerplate_Utils::log( sprintf( 'Module disabled: %s', $module_name ), 'info' );
				}
			}
		}
	}

	/**
	 * Load a specific module.
	 *
	 * @param string $module_name Module name.
	 * @param string $module_file Module file path.
	 */
	private function load_module( $module_name, $module_file ) {
		require_once $module_file;

		$class_name = 'Boilerplate_Module_' . $this->sanitize_class_name( $module_name );

		if ( class_exists( $class_name ) ) {
			try {
				$module_instance = new $class_name();
				$this->modules[ $module_name ] = $module_instance;
				Boilerplate_Utils::log( sprintf( 'Module loaded: %s', $module_name ), 'info' );
			} catch ( Exception $e ) {
				Boilerplate_Utils::log( sprintf( 'Failed to load module %s: %s', $module_name, $e->getMessage() ), 'error' );
			}
		} else {
			Boilerplate_Utils::log( sprintf( 'Module class not found: %s', $class_name ), 'error' );
		}
	}

	/**
	 * Sanitize module name for class name.
	 *
	 * @param string $name Module name.
	 * @return string
	 */
	private function sanitize_class_name( $name ) {
		// Convert dashes and underscores to spaces, then ucwords, then remove spaces
		$name = str_replace( array( '-', '_' ), ' ', $name );
		$name = ucwords( $name );
		$name = str_replace( ' ', '', $name );
		return $name;
	}

	/**
	 * Get all loaded modules.
	 *
	 * @return array
	 */
	public function get_modules() {
		return $this->modules;
	}

	/**
	 * Get a specific module.
	 *
	 * @param string $module_name Module name.
	 * @return mixed|null
	 */
	public function get_module( $module_name ) {
		return isset( $this->modules[ $module_name ] ) ? $this->modules[ $module_name ] : null;
	}

	/**
	 * Check if a module is loaded.
	 *
	 * @param string $module_name Module name.
	 * @return bool
	 */
	public function has_module( $module_name ) {
		return isset( $this->modules[ $module_name ] );
	}

	/**
	 * Initialize all modules.
	 */
	public function init_modules() {
		foreach ( $this->modules as $module_name => $module ) {
			if ( method_exists( $module, 'init' ) ) {
				try {
					$module->init();
					Boilerplate_Utils::log( sprintf( 'Module initialized: %s', $module_name ), 'info' );
				} catch ( Exception $e ) {
					Boilerplate_Utils::log( sprintf( 'Failed to initialize module %s: %s', $module_name, $e->getMessage() ), 'error' );
				}
			}
		}
	}
}
