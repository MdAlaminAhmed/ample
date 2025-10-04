// This file will be used to debug DataTables issues
$(document).ready(function() {
    // Print DataTable initialization parameters to console
    console.log("Starting supplier table debugging");
    
    // Add error handler for AJAX requests
    $(document).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
        console.error("AJAX Error:", thrownError);
        console.error("Status:", jqXHR.status);
        console.error("Response:", jqXHR.responseText);
        console.error("URL:", ajaxSettings.url);
    });
    
    // Track DataTables AJAX requests
    var oldAjax = $.ajax;
    $.ajax = function(settings) {
        if (settings.url && settings.url.includes('suppliar_data.php')) {
            console.log("DataTables requesting supplier data:", settings);
            settings.complete = function(xhr, status) {
                console.log("DataTables supplier data response:", xhr.responseText.substring(0, 500) + "...");
            };
        }
        return oldAjax.apply(this, arguments);
    };
});