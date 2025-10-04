<?php
// Direct database test - access this at http://localhost/ample/test_supplier.php
require_once 'app/init.php';

echo "<h2>Supplier Database Test</h2>";

try {
    // Test 1: Count suppliers
    $stmt = $pdo->query("SELECT COUNT(*) FROM suppliar");
    $count = $stmt->fetchColumn();
    echo "<p>Total suppliers in database: $count</p>";
    
    if ($count > 0) {
        // Test 2: List suppliers
        echo "<h3>First 10 suppliers:</h3>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Supplier ID</th><th>Name</th><th>Company</th></tr>";
        
        $stmt = $pdo->query("SELECT id, suppliar_id, name, company FROM suppliar LIMIT 10");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['suppliar_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['company']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Test 3: Check suppliar_balance table
        echo "<h3>Supplier Balance Table Check:</h3>";
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM suppliar_balance");
            $count = $stmt->fetchColumn();
            echo "<p>Total records in supplier_balance: $count</p>";
            
            $stmt = $pdo->query("SELECT * FROM suppliar_balance LIMIT 5");
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>ID</th><th>Supplier ID</th><th>Due Balance</th><th>Created At</th></tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['sup_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['due_balance']) . "</td>";
                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
        } catch (Exception $e) {
            echo "<p style='color:red'>Error checking supplier_balance table: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>No suppliers found in database!</p>";
    }
} catch (Exception $e) {
    echo "<p style='color:red'>Database error: " . $e->getMessage() . "</p>";
}
?>

<h2>Test the DataTable AJAX Request Directly</h2>
<p>Click the button below to test the AJAX request directly:</p>
<button id="testAjax">Test AJAX</button>
<pre id="result" style="border: 1px solid #ccc; padding: 10px; margin-top: 10px; max-height: 300px; overflow: auto;"></pre>

<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#testAjax').on('click', function() {
        var data = {
            draw: 1,
            start: 0,
            length: 10,
            order: [{column: 1, dir: 'asc'}],
            columns: [
                {data: 'checkbox'},
                {data: 'suppliar_id'},
                {data: 'name'},
                {data: 'company'},
                {data: 'address'},
                {data: 'con_num'},
                {data: 'total_buy'},
                {data: 'total_paid'},
                {data: 'total_due'},
                {data: 'action'}
            ],
            search: {value: ''}
        };
        
        $.ajax({
            url: 'app/ajax/suppliar_data.php',
            type: 'POST',
            data: data,
            success: function(response) {
                $('#result').html(JSON.stringify(response, null, 2));
            },
            error: function(xhr, status, error) {
                $('#result').html('Error: ' + error + '<br>Response: ' + xhr.responseText);
            }
        });
    });
});
</script>