# Refactored Boilerplate Plugin
An improved, maintainable boilerplate for WordPress plugins following best practices.

## Description

The Refactored Boilerplate Plugin is a modern, well-structured starting point for building WordPress plugins. It follows WordPress coding standards and best practices, featuring:

- **Improved architecture**: Better separation of concerns with dedicated classes
- **Configuration management**: Centralized settings and constants system
- **Upgrade handling**: Built-in version upgrade management
- **Error logging**: Proper logging for debugging and monitoring
- **Internationalization support**: Ready for translation
- **Activation and deactivation hooks**: Proper plugin lifecycle management
- **Enqueueing of admin and public styles/scripts**: Proper asset handling
- **Example shortcode** (`[boilerplate_hello]`): For public use
- **Settings page**: With example configuration options
- **Admin notice example**: Demonstrating admin area features

## Installation

1. Upload the plugin files to the `/wp-content/plugins/boilerplate-plugin` directory, or install via the WordPress plugins screen.
2. Activate the plugin through the 'Plugins' screen in WordPress.

## Usage

This plugin is intended as a foundation for your own WordPress plugins. To use it:

1. Copy the plugin directory and rename it to match your plugin's name.
2. Rename all files and classes to match your plugin's name.
3. Update the plugin header information in the main plugin file.
4. Customize the functionality as needed (add features, hooks, etc).

### Features

- **Shortcode Example:** Use `[boilerplate_hello name="YourName"]` to display a "Hello World" message on the front end.
- **Settings Page:** Accessible via Settings > Boilerplate Plugin in the admin area.
- **Admin Notice Example:** Displays a sample notice on the plugins admin page.
- **Hooks:** Easily register new actions and filters using the loader class.
- **Internationalization:** Ready for translation via the `/languages` directory.
- **Upgrade Management:** Automatic handling of version upgrades to ensure smooth transitions.

### Architecture

The refactored version includes several improvements over the basic boilerplate:

1. **Constants Management**: All plugin constants in `class-boilerplate-constants.php`
2. **Settings System**: Robust settings management via `class-boilerplate-settings.php`
3. **Upgrade Handler**: Automatic version upgrade handling via `class-boilerplate-upgrade.php`
4. **Utilities**: Common functions via `class-boilerplate-utils.php`
5. **Enhanced Loader**: Improved hook management supporting shortcodes as well as actions/filters
6. **Settings Page**: Built-in WordPress settings page with example configuration

## File Structure

```
boilerplate-plugin/
├── boilerplate-plugin.php — Main plugin file
├── README.md
├── .gitignore
├── admin/ — Admin-specific classes, CSS, JS
│   ├── class-boilerplate-admin.php
│   ├── css/
│   │   └── boilerplate-plugin-admin.css
│   └── js/
│       └── boilerplate-plugin-admin.js
├── includes/ — Core classes
│   ├── class-boilerplate-plugin.php — Main plugin class
│   ├── class-boilerplate-constants.php — Plugin constants
│   ├── class-boilerplate-settings.php — Settings management
│   ├── class-boilerplate-upgrade.php — Upgrade handling
│   ├── class-boilerplate-utils.php — Utility functions
│   ├── class-boilerplate-loader.php — Hook loader
│   ├── class-boilerplate-i18n.php — Internationalization
│   ├── class-boilerplate-activator.php — Plugin activation
│   └── class-boilerplate-deactivator.php — Plugin deactivation
├── languages/ — Translation files
└── public/ — Public-facing classes, CSS, JS
    ├── class-boilerplate-public.php
    ├── css/
    │   └── boilerplate-plugin-public.css
    └── js/
        └── boilerplate-plugin-public.js
```

## Changelog

### 2.0.0
* Complete refactoring for better maintainability
* Added centralized configuration system
* Implemented settings management
* Added upgrade management system
* Improved error logging
* Added WordPress settings page
* Enhanced file organization

### 1.0.0
* Initial release

## Frequently Asked Questions

### How do I customize this plugin for my own needs?

1. Rename the plugin directory
2. Rename all files and classes
3. Update the plugin header information
4. Modify/add functionality as needed
5. Update text domain references

### Does this plugin include any database functionality?

No, this boilerplate does not include any database functionality. You can add your own database operations as needed.

### How do I add my own functionality?

Add your own features by:
- Adding new methods to the admin and public classes
- Registering new hooks in the loader
- Creating new classes as needed
- Following the existing patterns for consistency

## Contributing

Contributions are welcome! Please submit a Pull Request.

### How to Contribute

1. Fork the repository and create your branch from `main`.
2. Make your changes, following WordPress coding standards.
3. Test your changes to ensure they do not break existing functionality.
4. Submit a Pull Request with a clear description of your changes.

### Submitting Issues

If you find a bug or have a feature request, please open an issue and provide as much detail as possible, including steps to reproduce, expected behavior, and screenshots if applicable.

## License

GPL-2.0+