<?php
// Test script for supplier data
require_once '../init.php';

header('Content-Type: application/json');

try {
    // Try to fetch some records
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM suppliar");
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Fetch a sample record
    $stmt = $pdo->prepare("SELECT * FROM suppliar LIMIT 1");
    $stmt->execute();
    $sample = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'count' => $count['count'],
        'sample' => $sample,
        'message' => 'Database connection successful'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'message' => 'Database connection failed'
    ]);
}
?>