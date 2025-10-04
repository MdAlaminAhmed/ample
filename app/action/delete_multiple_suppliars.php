<?php 
require '../init.php';

if (isset($_POST['suppliar_ids']) && !empty($_POST['suppliar_ids'])) {
    $suppliar_ids = $_POST['suppliar_ids'];
    $deleted = 0;
    $failed = 0;
    
    // Process each supplier ID
    foreach ($suppliar_ids as $id) {
        // Check if supplier has any related payment records
        $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM purchase_payment WHERE suppliar_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['count'] > 0) {
            // Skip this supplier and count as failed
            $failed++;
        } else {
            // Delete the supplier (suppliar_balance will be deleted automatically due to ON DELETE CASCADE)
            $stmt = $pdo->prepare("DELETE FROM suppliar WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            
            if ($result && $stmt->rowCount() > 0) {
                $deleted++;
            } else {
                $failed++;
            }
        }
    }
    
    $response = array(
        'status' => 'success',
        'deleted' => $deleted,
        'failed' => $failed
    );
    
    echo json_encode($response);
} else {
    echo json_encode(array(
        'status' => 'error',
        'message' => 'No suppliers selected'
    ));
}
?>