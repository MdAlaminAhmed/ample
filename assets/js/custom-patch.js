// Patch for custom.js to prevent it from initializing the customer table
$(document).ready(function() {
    // Store the original initialization if we need it
    if (typeof window.originalEmpTableInit === 'undefined') {
        window.originalEmpTableInit = $.fn.DataTable.isDataTable;
    }

    // Override the DataTable.isDataTable method for #empTable
    $.fn.DataTable.isDataTable = function(table) {
        if (table === '#empTable' || $(table).attr('id') === 'empTable') {
            // Always return true for #empTable to prevent re-initialization
            return true;
        }
        // For other tables, use the original method
        return window.originalEmpTableInit.apply(this, arguments);
    };
});