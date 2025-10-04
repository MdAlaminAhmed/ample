<?php
require_once '../init.php';
if (isset($_POST['getSellSingleInfo'])) {
	$id = $_POST['id'];
	$res = $obj->find('products', 'id', $id);

	// Set default image if product has no image
	if (empty($res->product_image)) {
		$res->product_image = 'assets/images/no-image.png';
	}

	echo json_encode($res);
}
