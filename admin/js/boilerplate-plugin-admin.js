(function($) {
    'use strict';

    /**
     * Boilerplate Plugin Admin JavaScript
     */
    class BoilerplateAdmin {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
            this.setupModuleManagement();
        }

        bindEvents() {
            // Module toggle confirmation
            $(document).on('change', 'input[name*="enabled_modules"]', this.handleModuleToggle.bind(this));
            
            // Settings form submission
            $(document).on('submit', 'form[action*="options.php"]', this.handleFormSubmit.bind(this));
        }

        setupModuleManagement() {
            // Add visual feedback for module status
            this.updateModuleStatuses();
        }

        handleModuleToggle(event) {
            const $checkbox = $(event.target);
            const moduleName = $checkbox.val();
            const isEnabled = $checkbox.is(':checked');
            
            // Update the status display immediately
            const $status = $checkbox.closest('label').find('.module-status');
            if (isEnabled) {
                $status.removeClass('module-status-disabled').addClass('module-status-loaded')
                       .text('✓ Enabled');
            } else {
                $status.removeClass('module-status-loaded').addClass('module-status-disabled')
                       .text('✗ Disabled');
            }

            // Show a brief confirmation message
            this.showModuleStatusMessage(moduleName, isEnabled);
        }

        showModuleStatusMessage(moduleName, isEnabled) {
            // Format module name for display
            const displayName = moduleName.replace(/[-_]/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            const status = isEnabled ? 'enabled' : 'disabled';
            const message = `Module "${displayName}" will be ${status} after saving settings.`;
            
            // Create or update a temporary message
            let $message = $('.boilerplate-module-message');
            if (!$message.length) {
                $message = $('<div class="notice notice-info boilerplate-module-message" style="margin-top: 15px;"></div>');
                $('h1').after($message);
            }
            
            $message.html(`<p>${message}</p>`);
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                $message.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 3000);
        }

        handleFormSubmit(event) {
            // Add loading state to submit button
            const $submitButton = $(event.target).find('#submit');
            const originalText = $submitButton.val();
            
            $submitButton.val('Saving...').prop('disabled', true);
            
            // Re-enable button after a short delay in case of errors
            setTimeout(() => {
                $submitButton.val(originalText).prop('disabled', false);
            }, 3000);
        }

        updateModuleStatuses() {
            // Update all module status displays on page load
            $('input[name*="enabled_modules"]').each(function() {
                const $checkbox = $(this);
                const isEnabled = $checkbox.is(':checked');
                const $status = $checkbox.closest('label').find('.module-status');
                
                if (isEnabled) {
                    $status.removeClass('module-status-disabled').addClass('module-status-loaded')
                           .text('✓ Enabled');
                } else {
                    $status.removeClass('module-status-loaded').addClass('module-status-disabled')
                           .text('✗ Disabled');
                }
            });
        }
    }

    // Initialize when document is ready
    $(document).ready(function() {
        new BoilerplateAdmin();
    });

})(jQuery);
