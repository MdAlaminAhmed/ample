<?php 
require '../init.php';

if (isset($_POST['member_ids']) && !empty($_POST['member_ids'])) {
    $member_ids = $_POST['member_ids'];
    $deleted = 0;
    $failed = 0;
    
    // Process each member ID
    foreach ($member_ids as $id) {
        // Check if member has any related payment records
        $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM sell_payment WHERE customer_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['count'] > 0) {
            // Skip this member and count as failed
            $failed++;
        } else {
            // Delete the member (customer_balance will be deleted automatically due to ON DELETE CASCADE)
            $stmt = $pdo->prepare("DELETE FROM member WHERE id = :id");
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
        'message' => 'No members selected'
    ));
}
?>