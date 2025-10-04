// Fix for customer dropdown Select2 initialization issues
$(document).ready(function () {
    // Function to safely initialize customer dropdown
    function initCustomerDropdown() {
        var $customerSelect = $('#customer_name');

        // Check if element exists
        if ($customerSelect.length === 0) {
            console.log('Customer dropdown element not found');
            return;
        }

        // Check for duplicate Select2 containers and remove them
        $customerSelect.siblings('.select2-container').remove();

        // Destroy existing Select2 if it exists
        if ($customerSelect.hasClass('select2-hidden-accessible')) {
            try {
                $customerSelect.select2('destroy');
                console.log('Destroyed existing Select2 initialization');
            } catch (e) {
                console.log('Error destroying Select2:', e);
            }
        }

        // Make sure the original select is visible
        $customerSelect.show();

        // Initialize with proper settings
        try {
            $customerSelect.select2({
                placeholder: "Select a customer",
                allowClear: true,
                width: '100%',
                dropdownParent: $customerSelect.closest('.form-group')
            });

            console.log('Customer dropdown initialized successfully');
        } catch (e) {
            console.error('Error initializing customer dropdown:', e);
        }
    }

    // Clean up any existing Select2 containers first
    $('#customer_name').siblings('.select2-container').remove();

    // Initialize immediately
    initCustomerDropdown();

    // Also initialize after a small delay to handle any timing issues
    setTimeout(function () {
        initCustomerDropdown();
    }, 1000);

    // Reinitialize when page becomes visible (handles back/forward navigation)
    $(document).on('visibilitychange', function () {
        if (!document.hidden) {
            setTimeout(initCustomerDropdown, 100);
        }
    });

    // Handle page focus events
    $(window).on('focus', function () {
        setTimeout(initCustomerDropdown, 100);
    });

    // Debug: Check for multiple Select2 containers periodically
    setInterval(function () {
        var containers = $('#customer_name').siblings('.select2-container');
        if (containers.length > 1) {
            console.log('Found multiple Select2 containers, cleaning up...');
            containers.not(':first').remove();
        }
    }, 2000);
});