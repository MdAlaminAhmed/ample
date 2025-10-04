// Enhanced addNewRow function to work with product search
function addNewRow() {
    $.ajax({
        url: "app/ajax/addNewRow.php",
        method: "POST",
        data: { getOrderItem: 1 },
        success: function (data) {
            $("#invoiceItem").append(data);

            // Update serial numbers
            var i = 0;
            $(".si_number").each(function () {
                $(this).html(++i);
            });

            // Don't initialize select2 for product search as we're using our custom search
            // Initialize select2 for other dropdowns only
            $(".select2:not(.product-search)").select2();
        }
    });
}

// Enhanced product selection handling
$(document).ready(function () {
    // Replace the add new row button functionality
    $("#addNewRowBtn").off('click').on("click", function (e) {
        e.preventDefault();
        addNewRow();
    });
    // Validate order quantity to prevent invalid entries
    $(document).on("input", ".oqty", function () {
        var $this = $(this);
        var $row = $this.closest('tr');
        var availableQty = parseInt($row.find(".qaty").val()) || 0;
        var orderQty = parseInt($this.val()) || 0;

        if (orderQty < 0) {
            $this.val(0);
            orderQty = 0;
            alert("Quantity cannot be negative");
        }

        if (orderQty > availableQty) {
            // Visual feedback
            $this.addClass('is-invalid');

            // Show warning but allow entry
            $row.find(".quantity-warning").remove();
            $row.find(".oqty").after('<div class="quantity-warning text-danger small">Exceeds available quantity (' + availableQty + ')</div>');
        } else {
            // Remove warning if quantity is valid
            $this.removeClass('is-invalid');
            $row.find(".quantity-warning").remove();
        }

        // Update total price
        var price = parseFloat($row.find(".price").val()) || 0;
        $row.find(".tprice").val((price * orderQty).toFixed(2));

        // Update subtotal
        updateSubtotal();
    });

    // Function to update subtotal
    function updateSubtotal() {
        var subtotal = 0;
        $('.tprice').each(function () {
            subtotal += parseFloat($(this).val()) || 0;
        });

        $("#subtotal").val(subtotal.toFixed(2));

        // Update net total
        var discount = parseFloat($("#s_discount_amount").val()) || 0;
        var prevDue = parseFloat($("#prev_due").val()) || 0;
        var netTotal = subtotal - discount + prevDue;
        $("#netTotal").val(netTotal.toFixed(2));

        // Update due bill based on paid amount
        var paidBill = parseFloat($("#paidBill").val()) || 0;
        $("#dueBill").val((netTotal - paidBill).toFixed(2));
    }

    // Add validation before form submission
    $("#sellBtn").on("click", function (e) {
        e.preventDefault();

        var formValid = true;
        var errorMessage = "";

        // Check for quantity errors
        $('.oqty').each(function () {
            var $row = $(this).closest('tr');
            var availableQty = parseInt($row.find(".qaty").val()) || 0;
            var orderQty = parseInt($(this).val()) || 0;
            var productName = $row.find(".pro_name").val();

            if (orderQty > availableQty) {
                formValid = false;
                errorMessage += "Not enough quantity for " + productName + " (Available: " + availableQty + ", Ordered: " + orderQty + ")\n";
            }
        });

        if (!formValid) {
            alert("Please fix the following errors before submitting:\n\n" + errorMessage);
            return;
        }

        // Continue with original form submission logic
        var customer_name = $("#customer_name").val();
        var payMethode = $("#payMethode").val();

        if (customer_name != null && payMethode != null) {
            $.ajax({
                url: "app/action/sell.php",
                method: "POST",
                data: $("#sellForm").serialize(),
                success: function (data) {
                    var invoice_id = data;
                    if (!isNaN(invoice_id)) {
                        window.location.href = "index.php?page=view_sell&&view_id=" + invoice_id;
                    } else {
                        alert("Failed to make sell: " + data);
                    }
                }
            });
        } else {
            alert("You missed some required fields");
        }
    });
});