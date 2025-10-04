<?php
// Direct test for supplier deletion - access this at http://localhost/ample/test_delete_supplier.php?id=ID
require_once 'app/init.php';

echo "<h2>Supplier Deletion Test</h2>";

// Get supplier ID from URL parameter
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo "<p>Please provide a valid supplier ID in the URL parameter, e.g. ?id=2</p>";
    
    // List available suppliers
    $stmt = $pdo->query("SELECT id, suppliar_id, name FROM suppliar ORDER BY id");
    echo "<h3>Available Suppliers:</h3>";
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>ID: {$row['id']} - {$row['name']} ({$row['suppliar_id']}) - 
              <a href='test_delete_supplier.php?id={$row['id']}&action=delete'>Delete</a></li>";
    }
    echo "</ul>";
    exit;
}

// Process deletion if action is specified
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    try {
        // Check if supplier exists
        $stmt = $pdo->prepare("SELECT id, name FROM suppliar WHERE id = ?");
        $stmt->execute([$id]);
        $supplier = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($supplier) {
            // Check if supplier has payment records
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM purchase_payment WHERE suppliar_id = ?");
            $stmt->execute([$id]);
            $paymentCount = $stmt->fetchColumn();
            
            echo "<p>Supplier: {$supplier['name']} (ID: {$supplier['id']})</p>";
            echo "<p>Payment records found: $paymentCount</p>";
            
            // Direct deletion using PDO
            $stmt = $pdo->prepare("DELETE FROM suppliar WHERE id = ?");
            $result = $stmt->execute([$id]);
            
            if ($result) {
                $rowCount = $stmt->rowCount();
                echo "<p style='color:green'>Deletion result: Success ($rowCount rows affected)</p>";
            } else {
                echo "<p style='color:red'>Deletion result: Failed</p>";
            }
        } else {
            echo "<p style='color:red'>Supplier not found with ID: $id</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
    }
    
    echo "<p><a href='test_delete_supplier.php'>Back to supplier list</a></p>";
} else {
    // Show supplier details
    $stmt = $pdo->prepare("SELECT * FROM suppliar WHERE id = ?");
    $stmt->execute([$id]);
    $supplier = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($supplier) {
        echo "<h3>Supplier Details:</h3>";
        echo "<table border='1' cellpadding='5'>";
        foreach ($supplier as $key => $value) {
            echo "<tr><th>$key</th><td>$value</td></tr>";
        }
        echo "</table>";
        
        echo "<p style='margin-top: 20px;'>";
        echo "<a href='test_delete_supplier.php?id={$supplier['id']}&action=delete' 
              onclick='return confirm(\"Are you sure you want to delete this supplier?\")' 
              style='background: #dc3545; color: white; padding: 5px 10px; text-decoration: none;'>
              Delete This Supplier</a>";
        echo " <a href='test_delete_supplier.php' style='margin-left: 10px;'>Cancel</a>";
        echo "</p>";
    } else {
        echo "<p style='color:red'>Supplier not found with ID: $id</p>";
        echo "<p><a href='test_delete_supplier.php'>Back to supplier list</a></p>";
    }
}