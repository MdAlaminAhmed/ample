<?php
require_once '../init.php';


if (isset($_POST)) {
	$product_name = $_POST['product_name'];
	$product_code = "P" . time();
	$brand = $_POST['brand'];
	$p_catagory = $_POST['p_catagory'];
	// find catagory name 
	$p_catagory_name = $obj->find('catagory', 'id', $p_catagory);
	$p_catagory_name = $p_catagory_name->name;

	$product_source = $_POST['product_source'];
	$sku = $_POST['sku'];
	$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0; // Set default quantity to 0 if not provided
	$alert_quantity = $_POST['alert_quantity'];
	$buy_price = isset($_POST['buy_price']) ? $_POST['buy_price'] : null;
	$sell_price = isset($_POST['sell_price']) ? $_POST['sell_price'] : null;
	$user_id = $_SESSION['user_id'];

	// Handle file upload
	$product_image = '';
	if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
		$allowed = array('jpg', 'jpeg', 'png', 'gif');
		$filename = $_FILES['product_image']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if (in_array(strtolower($ext), $allowed)) {
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


	if (!empty($product_name) && !empty($brand) && !empty($p_catagory) && !empty($product_source) && !empty($alert_quantity)) {
		// prodcut add query 
		$query = array(
			'product_name'	 => $product_name,
			'product_id'	 => $product_code,
			'brand_name'	 => $brand,
			'catagory_id'	 => $p_catagory,
			'catagory_name'	 => $p_catagory_name,
			'product_source' => $product_source,
			'sku' 			 => $sku,
			'quantity'       => $quantity,    // Add quantity field
			'alert_quanttity' => $alert_quantity,
			'buy_price'      => $buy_price,   // Add buying price field
			'sell_price'     => $sell_price,  // Add selling price field
			'added_by' 		 => $user_id,
			'product_image'  => $product_image
		);
		$res = $obj->create('products', $query);
		if ($res) {
			echo "yes";
		} else {
			echo "Failed to add product";
		}
	} else {
		echo "Please filled out all required field";
	}
}
