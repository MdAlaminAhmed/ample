// Multiple Member Selection and Deletion
$(document).ready(function() {
    // Update DataTable initialization to include checkbox column
    var table = $('#empTable').DataTable({
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        ajax: {
            url: "app/ajax/member_data.php"
        },
        columns: [
            { data: "checkbox", orderable: false }, // Checkbox column
            { data: "member_id" },
            { data: "name" },
            { data: "company" },
            { data: "address" },
            { data: "con_num" },
            { data: "total_buy" },
            { data: "total_paid" },
            { data: "total_due" },
            { data: "action" }
        ]
    });

    // Select All checkbox
    $(document).on('change', '#selectAll', function() {
        $('.member-checkbox').prop('checked', $(this).prop('checked'));
        updateDeleteButton();
    });

    // Individual checkboxes
    $(document).on('change', '.member-checkbox', function() {
        if ($('.member-checkbox:checked').length === $('.member-checkbox').length) {
            $('#selectAll').prop('checked', true);
        } else {
            $('#selectAll').prop('checked', false);
        }
        updateDeleteButton();
    });

    // Enable/disable delete button based on selections
    function updateDeleteButton() {
        if ($('.member-checkbox:checked').length > 0) {
            $('#deleteSelected').prop('disabled', false);
        } else {
            $('#deleteSelected').prop('disabled', true);
        }
    }

    // Delete selected members
    $(document).on('click', '#deleteSelected', function(e) {
        e.preventDefault();
        
        var selectedIds = [];
        $('.member-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });
        
        if (selectedIds.length === 0) {
            alert('No customers selected');
            return;
        }
        
        if (confirm('Are you sure you want to delete the selected customers?')) {
            $.ajax({
                url: 'app/action/delete_multiple_members.php',
                method: 'POST',
                data: { member_ids: selectedIds },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Deleted ' + response.deleted + ' customers. Failed to delete ' + response.failed + ' customers (they may have payment records).');
                        table.ajax.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('Server error occurred. Please try again.');
                }
            });
        }
    });
});