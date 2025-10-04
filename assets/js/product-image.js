// Handle product image upload functionality
$(document).ready(function () {
    // Include the custom CSS for Select2
    if ($('head link[href*="select2-custom.css"]').length === 0) {
        $('head').append('<link rel="stylesheet" href="assets/css/select2-custom.css">');
    }

    // Handle product image upload with FormData
    $("#addProduct").submit(function (e) {
        e.preventDefault();
        var product_name = $("#product_name").val();
        var brand = $("#brand").val();
        var p_catagory = $("#p_catagory").val();

        if (product_name != "" && brand != "" && p_catagory != null) {
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "app/action/add_product.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if ($.trim(data) == "yes") {
                        $(".addProductError-area").show();
                        $("#addProductError").html("Product added successfully");
                        $("#addProduct")[0].reset();
                        // Give feedback about successful upload
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $(".addProductError-area").show();
                        $("#addProductError").html(data);
                    }
                }
            });
        } else {
            $(".addProductError-area").show();
            $("#addProductError").html("Please fill out all required fields");
        }
    });
});