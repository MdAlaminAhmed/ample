// Member DataTable with Checkbox Selection
$(document).ready(function() {
    // Override the existing DataTable initialization by removing it from the custom.js
    if (typeof originalInitDataTable === 'function') {
        // If we have a reference to the original function
        originalInitDataTable = function() {};
    }
    
    // Destroy existing DataTable if it exists
    if ($.fn.DataTable.isDataTable('#empTable')) {
        $('#empTable').DataTable().destroy();
    }
    
    // Initialize DataTable with checkbox column
    var table = $('#empTable').DataTable({
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        ajax: {
            url: "app/ajax/member_data.php"
        },
        columnDefs: [
            { 
                targets: 0, 
                orderable: false,
                className: 'select-checkbox',
                checkboxes: {
                    selectRow: true
                }
            }
        ],
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
            { data: "action", orderable: false }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        order: [[1, 'asc']]
    });
    
    // Select All checkbox functionality
    $('#selectAll').on('click', function() {
        if ($(this).is(':checked')) {
            $('.member-checkbox').prop('checked', true);
        } else {
            $('.member-checkbox').prop('checked', false);
        }
        updateDeleteButton();
    });
    
    // Individual checkboxes
    $(document).on('change', '.member-checkbox', function() {
        updateSelectAllCheckbox();
        updateDeleteButton();
    });
    
    // Update the Select All checkbox state
    function updateSelectAllCheckbox() {
        var totalCheckboxes = $('.member-checkbox').length;
        var checkedCheckboxes = $('.member-checkbox:checked').length;
        
        if (checkedCheckboxes > 0 && checkedCheckboxes === totalCheckboxes) {
            $('#selectAll').prop('checked', true);
        } else {
            $('#selectAll').prop('checked', false);
        }
    }
    
    // Enable/disable Delete Selected button
    function updateDeleteButton() {
        if ($('.member-checkbox:checked').length > 0) {
            $('#deleteSelected').prop('disabled', false);
        } else {
            $('#deleteSelected').prop('disabled', true);
        }
    }
    
    // Delete selected members
    $('#deleteSelected').on('click', function() {
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
                        if (response.failed > 0) {
                            alert('Deleted ' + response.deleted + ' customers. Could not delete ' + response.failed + ' customers (they may have payment records).');
                        } else {
                            alert('Successfully deleted ' + response.deleted + ' customers.');
                        }
                        table.ajax.reload();
                        $('#selectAll').prop('checked', false);
                        updateDeleteButton();
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

    // Fix for selectAll when paging
    table.on('draw', function() {
        updateSelectAllCheckbox();
        updateDeleteButton();
    });
});