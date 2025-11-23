# WordPress Plugin Boilerplate

A clean, reusable boilerplate for WordPress plugins following best practices. This boilerplate has been refactored to follow WordPress coding standards and security best practices.

## Features

- **Modern Architecture**: Object-oriented design with proper separation of concerns
- **Security First**: Input validation, sanitization, and proper escaping
- **Internationalization Ready**: Full support for translations
- **Settings Management**: Robust settings system with proper sanitization
- **Upgrade Handling**: Version-based upgrade system
- **Logging**: Built-in debug logging system
- **Admin Interface**: Clean admin interface with proper security
- **Public-facing Features**: Proper asset enqueueing and shortcode support

## Code Quality Improvements

### Security Enhancements
- **Input Sanitization**: All settings are properly sanitized before saving
- **Output Escaping**: All output is properly escaped using WordPress functions
- **Nonce Verification**: Settings forms include proper nonce verification
- **Capability Checks**: Admin pages check for proper user capabilities

### Code Standards
- **WordPress Coding Standards**: Follows WordPress PHP and JavaScript coding standards
- **Proper Documentation**: Comprehensive PHPDoc comments
- **Consistent Naming**: Consistent file and class naming conventions
- **Error Handling**: Proper error logging and handling

### Architecture Improvements
- **Singleton Pattern**: Settings class uses proper singleton pattern
- **Dependency Injection**: Proper dependency management
- **Hook System**: Flexible action and filter hook system
- **Constants Management**: Centralized constants management

## File Structure

```
wordpress-plugin-boilerplate/
├── boilerplate-plugin.php          # Main plugin file
├── README.md                       # This file
├── admin/                          # Admin functionality
│   ├── class-boilerplate-plugin-admin.php
│   ├── css/
│   │   └── boilerplate-plugin-admin.css
│   └── js/
│       └── boilerplate-plugin-admin.js
├── includes/                       # Core plugin classes
│   ├── class-boilerplate-constants.php
│   ├── class-boilerplate-plugin-activator.php
│   ├── class-boilerplate-plugin-deactivator.php
│   ├── class-boilerplate-plugin-i18n.php
│   ├── class-boilerplate-plugin-loader.php
│   ├── class-boilerplate-plugin.php
│   ├── class-boilerplate-settings.php
│   ├── class-boilerplate-upgrade.php
│   ├── class-boilerplate-utils.php
│   └── class-boilerplate-module-manager.php
├── languages/                      # Translation files
│   └── .gitkeep
├── modules/                        # Modular functionality
│   ├── .gitkeep
│   └── example-module/             # Example module
│       └── class-boilerplate-module-example-module.php
└── public/                         # Public-facing functionality
    ├── class-boilerplate-plugin-public.php
    ├── css/
    │   └── boilerplate-plugin-public.css
    └── js/
        └── boilerplate-plugin-public.js
```

## Installation

1. Upload the plugin files to `/wp-content/plugins/boilerplate-plugin`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Configure the plugin settings under Settings > Boilerplate Plugin

## Usage

### For Developers

This boilerplate provides a solid foundation for building WordPress plugins. Key features include:

#### Settings Management
```php
// Get a setting value
$settings = Boilerplate_Settings::instance();
$value = $settings->get( 'example_setting', 'default_value' );

// Set a setting value
$settings->set( 'example_setting', 'new_value' );
$settings->save();
```

#### Hook System
```php
// Add actions
$this->loader->add_action( 'hook_name', $component, 'callback_method', $priority, $accepted_args );

// Add filters  
$this->loader->add_filter( 'filter_name', $component, 'callback_method', $priority, $accepted_args );

// Add shortcodes
$this->loader->add_shortcode( 'shortcode_tag', $component, 'callback_method' );
```

#### Logging
```php
// Log messages (only when WP_DEBUG is true)
Boilerplate_Utils::log( 'Plugin activated successfully', 'info' );
Boilerplate_Utils::log( 'Something went wrong', 'error' );
```

#### Modular Architecture
The plugin now supports a modular architecture where additional functionality can be added through modules.

**Creating a Module:**
1. Create a directory in `/modules/` (e.g., `/modules/custom-function-1/`)
2. Create a class file following the naming convention: `class-boilerplate-module-custom-function-1.php`
3. The class should follow the naming convention: `Boilerplate_Module_CustomFunction1`
4. Implement an `init()` method for module initialization

**Example Module Structure:**
```php
class Boilerplate_Module_CustomFunction1 {
    
    public function __construct() {
        $this->name = 'custom-function-1';
        $this->version = '1.0.0';
    }
    
    public function init() {
        // Register hooks, filters, shortcodes, etc.
        add_action( 'init', array( $this, 'register_shortcodes' ) );
        add_filter( 'the_content', array( $this, 'modify_content' ) );
    }
    
    // Your module methods here...
}
```

**Module Manager:**
```php
// Get module manager instance
$module_manager = Boilerplate_Module_Manager::instance();

// Get all loaded modules
$modules = $module_manager->get_modules();

// Check if a specific module is loaded
if ( $module_manager->has_module( 'custom-function-1' ) ) {
    // Module is available
    $module = $module_manager->get_module( 'custom-function-1' );
}
```

## Security Best Practices Implemented

1. **Input Validation**: All user input is validated and sanitized
2. **Output Escaping**: All output uses proper escaping functions
3. **Nonce Verification**: Forms include WordPress nonce verification
4. **Capability Checks**: Admin functions check user capabilities
5. **SQL Injection Prevention**: Uses WordPress database functions
6. **XSS Prevention**: Proper escaping of all output
7. **CSRF Protection**: Nonce verification on all forms

## WordPress Coding Standards

This plugin follows WordPress coding standards:

- **PHP**: Follows WordPress PHP coding standards
- **JavaScript**: Follows WordPress JavaScript coding standards  
- **CSS**: Follows WordPress CSS coding standards
- **Documentation**: Comprehensive PHPDoc comments
- **Naming**: Consistent naming conventions

## Contributing

When contributing to this boilerplate:

1. Follow WordPress coding standards
2. Add proper PHPDoc comments
3. Include security measures for all user input
4. Test thoroughly before submitting
5. Update documentation as needed

## License

This project is licensed under the GPL v2 or later.

## Changelog

### 2.0.0
- Refactored code following WordPress best practices
- Enhanced security with proper input sanitization
- Improved code documentation
- Fixed file naming inconsistencies
- Added comprehensive logging system
- Improved settings management with proper sanitization callbacks
