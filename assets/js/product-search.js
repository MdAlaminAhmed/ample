// Product Search Functionality
$(document).ready(function () {
    let searchTimeout;

    // Handle product search input
    $(document).on('input', '.product-search', function () {
        const searchInput = $(this);
        const searchTerm = searchInput.val().trim();
        const resultsContainer = searchInput.siblings('.product-search-results');
        const hiddenInput = searchInput.siblings('.pid');

        // Clear previous timeout
        clearTimeout(searchTimeout);

        if (searchTerm.length < 2) {
            resultsContainer.hide().empty();
            return;
        }

        // Show loading
        resultsContainer.show().html('<div class="loading">Searching...</div>');

        // Debounce search
        searchTimeout = setTimeout(function () {
            $.ajax({
                url: 'app/ajax/product_search.php',
                method: 'POST',
                data: {
                    search_products: 1,
                    search_term: searchTerm
                },
                dataType: 'json',
                success: function (products) {
                    resultsContainer.empty();

                    // Debug: log the products data to console
                    console.log('Products returned:', products);

                    if (products.length === 0) {
                        resultsContainer.html('<div class="no-results">No products found</div>');
                    } else {
                        let html = '';
                        products.forEach(function (product) {
                            html += `
                                <div class="product-search-item" data-product-id="${product.id}">
                                    <img src="${product.product_image}" alt="${product.product_name}" class="product-image-small" onerror="console.log('Image failed to load:', this.src); this.src='assets/images/no-image.png';">
                                    <div class="product-info">
                                        <div class="product-name">${product.product_name}</div>
                                        <div class="product-details">
                                            ${product.brand_name ? product.brand_name + ' | ' : ''}
                                            Code: ${product.product_code}
                                            ${product.sku ? ' | SKU: ' + product.sku : ''}
                                        </div>
                                        <div class="product-stock">Stock: ${product.quantity} units</div>
                                    </div>
                                    <div class="product-price">৳${parseFloat(product.sell_price).toFixed(2)}</div>
                                </div>
                            `;
                        });
                        resultsContainer.html(html);
                    }
                },
                error: function () {
                    resultsContainer.html('<div class="no-results">Error searching products</div>');
                }
            });
        }, 300);
    });

    // Handle product selection
    $(document).on('click', '.product-search-item', function () {
        const productId = $(this).data('product-id');
        const productName = $(this).find('.product-name').text();
        const productDetails = $(this).find('.product-details').text();
        const row = $(this).closest('tr');

        // Set the hidden input value
        row.find('.pid').val(productId);

        // Update the search input to show selected product
        row.find('.product-search').val(productName + ' - ' + productDetails);

        // Hide results
        $(this).closest('.product-search-results').hide();

        // Load product details into the row
        loadProductDetails(productId, row);
    });

    // Hide search results when clicking outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.product-search-container').length) {
            $('.product-search-results').hide();
        }
    });

    // Function to load product details
    function loadProductDetails(productId, row) {
        $.ajax({
            url: 'app/ajax/single_sell_item.php',
            method: 'POST',
            dataType: 'json',
            data: {
                getSellSingleInfo: 1,
                id: productId
            },
            success: function (product) {
                row.find('.qaty').val(product.quantity);
                row.find('.oqty').val(1);
                row.find('.price').val(product.sell_price);
                row.find('.pro_name').val(product.product_name);
                row.find('.tprice').val(product.sell_price);

                // Trigger calculation
                calculateTotal();
            },
            error: function () {
                alert('Error loading product details');
            }
        });
    }

    // Update the existing change event for pid to work with our new system
    $(document).off('change', '.pid').on('change', '.pid', function (e) {
        e.preventDefault();
        var productId = $(this).val();
        var currentRow = $(this).parent().parent().parent();

        if (productId) {
            loadProductDetails(productId, currentRow);
        }
    });

    // Function to calculate total (reuse existing logic)
    function calculateTotal() {
        var total = 0;
        var netTotal = 0;
        var prevDue = parseInt($('#prev_due').val()) || 0;

        $('.tprice').each(function () {
            total += parseFloat($(this).val()) || 0;
        });

        var discountPercent = parseFloat($('#discount').val()) || 0;
        var discountAmount = (total / 100) * discountPercent;

        $('#s_discount_amount').val(discountAmount);
        netTotal = total - discountAmount + prevDue;

        $('#subtotal').val(total);
        $('#netTotal').val(netTotal);
    }

    // Update total price when quantity changes
    $(document).on('input', '.oqty', function () {
        var row = $(this).closest('tr');
        var quantity = parseFloat($(this).val()) || 0;
        var price = parseFloat(row.find('.price').val()) || 0;
        var totalPrice = quantity * price;

        row.find('.tprice').val(totalPrice.toFixed(2));
        calculateTotal();
    });
});