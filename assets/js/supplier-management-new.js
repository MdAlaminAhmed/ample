$(document).ready(function() {
    // First, check for and handle existing DataTable
    if ($.fn.DataTable.isDataTable('#suppliarTable')) {
        // Just use the existing instance
        var suppliarTable = $('#suppliarTable').DataTable();
        console.log("Using existing DataTable instance");
        return; // Exit early since we already have a table
    }
    
    // Initialize the DataTable properly
    var suppliarTable = $('#suppliarTable').DataTable({
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        ajax: {
            url: "app/ajax/suppliar_data.php",
            error: function(xhr, error, thrown) {
                console.error('DataTables error:', error, thrown);
                console.error('Response:', xhr.responseText);
            }
        },
        columns: [
            { data: 'checkbox', orderable: false, searchable: false },
            { data: 'suppliar_id' },
            { data: 'name' },
            { data: 'company' },
            { data: 'address' },
            { data: 'con_num' },
            { data: 'total_buy' },
            { data: 'total_paid' },
            { data: 'total_due' },
            { data: 'action' }
        ]
    });
    
    // Select all checkboxes
    $('#selectAll').on('click', function() {
        $('.suppliarCheckbox').prop('checked', this.checked);
        updateDeleteButton();
    });

    // Update delete button visibility based on selected checkboxes
    function updateDeleteButton() {
        if ($('.suppliarCheckbox:checked').length > 0) {
            $('#deleteSelected').show();
        } else {
            $('#deleteSelected').hide();
        }
    }

    // Handle individual checkbox clicks
    $(document).on('click', '.suppliarCheckbox', function() {
        if ($('.suppliarCheckbox:checked').length === $('.suppliarCheckbox').length) {
            $('#selectAll').prop('checked', true);
        } else {
            $('#selectAll').prop('checked', false);
        }
        updateDeleteButton();
    });

    // Handle delete selected button click
    $('#deleteSelected').on('click', function() {
        if (confirm('Are you sure you want to delete the selected suppliers?')) {
            var suppliarIds = [];
            
            $('.suppliarCheckbox:checked').each(function() {
                suppliarIds.push($(this).val());
            });
            
            if (suppliarIds.length > 0) {
                $.ajax({
                    url: 'app/action/delete_multiple_suppliars.php',
                    type: 'POST',
                    data: { suppliar_ids: suppliarIds },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            if (response.failed > 0) {
                                alert('Deleted ' + response.deleted + ' suppliers. Could not delete ' + response.failed + ' suppliers (they may have payment records).');
                            } else {
                                alert('Successfully deleted ' + response.deleted + ' suppliers.');
                            }
                            suppliarTable.ajax.reload();
                            $('#selectAll').prop('checked', false);
                            updateDeleteButton();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred while processing your request.');
                    }
                });
            }
        }
    });

    // Existing individual supplier delete button - using class instead of ID
    $(document).on('click', '.suppliarDelete_btn', function() {
        var delete_id = $(this).data('id');
        console.log('Delete clicked for supplier ID:', delete_id);
        
        var r = confirm("Are you sure you want to delete this supplier?");
        
        if (r == true) {
            console.log('Sending delete request for ID:', delete_id);
            
            $.ajax({
                url: "app/action/delete_suppliar.php",
                type: "POST",
                data: { delete_data: 1, delete_id: delete_id },
                success: function(data) {
                    console.log('Delete response:', data);
                    
                    if ($.trim(data) == "true") {
                        alert("Supplier deleted successfully.");
                        suppliarTable.ajax.reload();
                    } else {
                        alert("Error: " + data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('An error occurred while processing your request: ' + error);
                }
            });
        }
    });
});