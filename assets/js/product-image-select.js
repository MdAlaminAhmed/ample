// Custom formatting for product selection with images
function formatProductSelection(data) {
    if (!data.id) {
        return data.text;
    }
    var $option = $(data.element);
    var imageUrl = $option.data('image');

    if (!imageUrl) {
        return data.text;
    }

    var $result = $(
        '<span><img src="' + imageUrl + '" class="product-select-img" /> ' + data.text + '</span>'
    );
    return $result;
}

// Initialize select2 with custom formatting for product images
$(document).ready(function () {
    // Add CSS for product images in select2
    $('<style>')
        .prop('type', 'text/css')
        .html('.product-select-img { height: 30px; width: auto; margin-right: 10px; }')
        .appendTo('head');

    // Apply custom formatting to product dropdowns
    $('.pid').select2({
        templateResult: formatProductSelection,
        escapeMarkup: function (m) { return m; }
    });
});