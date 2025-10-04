<?php
require_once '../init.php';
if (isset($_POST)) {
	$id = $_POST['id'];
	$product_name = $_POST['product_name'];
	$brand = $_POST['brand'];
	$p_catagory = $_POST['p_catagory'];

	$p_catagory_name = $obj->find('catagory', 'id', $p_catagory);
	$p_catagory_name = $p_catagory_name->name;

	$product_source = $_POST['product_source'];
	$quantity = $_POST['quantity'];
	$alert_quantity = $_POST['alert_quantity'];
	$selling_price = $_POST['selling_price'];
	$date = date('Y-m-d');
	$existing_image = isset($_POST['existing_image']) ? $_POST['existing_image'] : '';

	// Handle file upload
	$product_image = $existing_image; // Default to existing image
	if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
		$allowed = array('jpg', 'jpeg', 'png', 'gif');
		$filename = $_FILES['product_image']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if (in_array(strtolower($ext), $allowed)) {
			// Get the existing product record to use its product_id
			$existing_product = $obj->find('products', 'id', $id);
			$product_code = $existing_product->product_id;

			$new_filename = 'product_' . $product_code . '.' . $ext;
			$upload_path = $_SERVER['DOCUMENT_ROOT'] . '/ample/assets/images/products/';

			// Create directory if it doesn't exist
			if (!file_exists($upload_path)) {
				mkdir($upload_path, 0777, true);
			}

			if (move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_path . $new_filename)) {
				$product_image = 'assets/images/products/' . $new_filename;
			}
		}
	}

	// prodcut add query 
	$query = array(
		'product_name'	 => $product_name,
		'brand_name'	 => $brand,
		'catagory_id'	 => $p_catagory,
		'catagory_name'	 => $p_catagory_name,
		'product_source' => $product_source,
		'quantity' 		 => $quantity,
		'alert_quanttity' => $alert_quantity,
		'sell_price' 	 => $selling_price,
		'product_image'  => $product_image,
		'last_update_at' => $date,
	);
	$res = $obj->update('products', 'id', $id, $query);
	if ($res) {
		echo "Product edit successfull";
	} else {
		echo "Failed to update product";
	}
}
