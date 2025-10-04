// Initialize Select2 dropdowns properly
$(document).ready(function () {
    // Reset any global Select2 templating that might have been set
    if ($.fn.select2.defaults) {
        $.fn.select2.defaults.set('templateResult', null);
        $.fn.select2.defaults.set('templateSelection', null);
    }

    // Initialize all Select2 dropdowns with standard formatting (excluding customer_name which is handled in footer)
    $('.select2:not(#customer_name):not(.product-search)').each(function () {
        var $this = $(this);

        // Skip if already initialized
        if ($this.hasClass('select2-hidden-accessible')) return;

        // Default initialization for regular dropdowns
        if (!$this.hasClass('pid')) {
            $this.select2();
        }
    });

    // Special initialization for product dropdowns with images
    $('.pid').each(function () {
        var $this = $(this);

        // Skip if already initialized
        if ($this.hasClass('select2-hidden-accessible')) return;

        $this.select2({
            templateResult: formatProductDropdown,
            templateSelection: formatProductSelection
        });
    });

    // Product formatting functions
    function formatProductDropdown(product) {
        if (!product.id) {
            return product.text;
        }

        // Only show images for product selectors with data-image attribute
        if ($(product.element).data('image')) {
            var imageUrl = $(product.element).data('image');
            var $product = $(
                '<span><img src="' + imageUrl + '" class="product-img-select" /> ' + product.text + '</span>'
            );
            return $product;
        }

        return product.text;
    }

    function formatProductSelection(product) {
        if (!product.id) {
            return product.text;
        }

        // Only show images for product selectors with data-image attribute
        if ($(product.element).data('image')) {
            var imageUrl = $(product.element).data('image');
            var $product = $(
                '<span><img src="' + imageUrl + '" class="product-img-selected" /> ' + product.text + '</span>'
            );
            return $product;
        }

        return product.text;
    }

    // Initialize any select2 elements that get added dynamically later
    $(document).on('DOMNodeInserted', '.select2:not(.select2-hidden-accessible)', function () {
        var $this = $(this);

        setTimeout(function () {
            if ($this.hasClass('select2-hidden-accessible')) return;

            if ($this.hasClass('pid')) {
                $this.select2({
                    templateResult: formatProductDropdown,
                    templateSelection: formatProductSelection
                });
            } else {
                $this.select2();
            }
        }, 100);
    });
});