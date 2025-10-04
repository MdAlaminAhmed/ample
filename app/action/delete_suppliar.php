<?php 
require '../init.php';

if (isset($_POST['delete_data'])) {
	$delete_id = $_POST['delete_id'];
	
	try {
		// Check if supplier exists before deletion
		$stmt = $pdo->prepare("SELECT COUNT(*) FROM suppliar WHERE id = :id");
		$stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		
		if ($count > 0) {
			// Direct deletion using PDO instead of Objects class
			$stmt = $pdo->prepare("DELETE FROM suppliar WHERE id = :id");
			$stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
			$result = $stmt->execute();
			
			if ($result) {
				echo "true";
			} else {
				echo "Failed to delete supplier";
			}
		} else {
			echo "Supplier not found";
		}
	} catch (Exception $e) {
		echo "Error: " . $e->getMessage();
	}
	
}
