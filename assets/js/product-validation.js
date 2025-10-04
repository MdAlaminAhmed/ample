// Product form validation
$(document).ready(function () {
    // Validate numeric inputs to ensure they're positive
    $('input[type="number"]').on('input', function () {
        var value = parseFloat($(this).val());

        // If the value is negative, set it to 0
        if (value < 0) {
            $(this).val(0);
        }
    });

    // Calculate selling price based on buying price and profit margin
    $('#buy_price').on('input', function () {
        var buyPrice = parseFloat($(this).val()) || 0;
        // Default 10% markup if no selling price has been set yet
        if ($('#sell_price').val() === '' && buyPrice > 0) {
            var suggestedPrice = buyPrice * 1.1; // 10% markup
            $('#sell_price').val(suggestedPrice.toFixed(2));
        }
    });

    // Validate form before submission
    $('#addProduct').on('submit', function (e) {
        var isValid = true;
        var errorMessage = '';

        // Required fields
        var productName = $('#product_name').val();
        var brand = $('#brand').val();
        var category = $('#p_catagory').val();
        var source = $('#product_source').val();
        var alertQty = $('#alert_quantity').val();

        if (!productName) {
            errorMessage += 'Product name is required.\n';
            isValid = false;
        }

        if (!brand) {
            errorMessage += 'Brand name is required.\n';
            isValid = false;
        }

        if (!category || category === 'Select a catagory') {
            errorMessage += 'Category is required.\n';
            isValid = false;
        }

        if (!source) {
            errorMessage += 'Product source is required.\n';
            isValid = false;
        }

        if (!alertQty) {
            errorMessage += 'Alert quantity is required.\n';
            isValid = false;
        }

        // Display error if validation fails
        if (!isValid) {
            e.preventDefault();
            $('.addProductError-area').show();
            $('#addProductError').html(errorMessage.replace(/\n/g, '<br>'));
            return false;
        }

        // If all is good, let the form submission continue
        return true;
    });
});