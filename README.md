# Boilerplate Plugin
A clean, reusable boilerplate for WordPress plugins following best practices.

## Description

Boilerplate Plugin is a lightweight, well-structured starting point for building WordPress plugins. It follows WordPress coding standards and best practices, providing:

- Proper file organization (separates admin and public code)
- Internationalization support (ready for translation)
- Activation and deactivation hooks
- Enqueueing of admin and public styles/scripts
- Example shortcode ([boilerplate_hello]) for public use
- Example admin notice

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
- **Admin Notice Example:** Displays a sample notice on the plugins admin page.
- **Hooks:** Easily register new actions and filters using the loader class.
- **Internationalization:** Ready for translation via the `/languages` directory.

## File Structure

- `boilerplate-plugin.php` — Main plugin file
- `includes/` — Core classes (loader, activator, deactivator, i18n)
- `admin/` — Admin-specific classes, CSS, JS
- `public/` — Public-facing classes, CSS, JS
- `languages/` — Translation files

## Changelog

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