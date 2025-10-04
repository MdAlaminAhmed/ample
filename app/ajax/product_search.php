<?php
require_once '../init.php';

if (isset($_POST['search_products'])) {
    $search_term = trim($_POST['search_term']);

    if (empty($search_term)) {
        echo json_encode([]);
        exit;
    }

    // Search products by name, barcode, or SKU (prioritize products with images)
    $sql = "SELECT * FROM products 
            WHERE (product_name LIKE :search 
            OR product_id LIKE :search 
            OR sku LIKE :search 
            OR brand_name LIKE :search)
            AND quantity > 0
            ORDER BY CASE WHEN product_image IS NOT NULL AND product_image != '' THEN 0 ELSE 1 END,
                     product_name ASC
            LIMIT 10";

    try {
        $stmt = $pdo->prepare($sql);
        $search_param = '%' . $search_term . '%';
        $stmt->bindParam(':search', $search_param, PDO::PARAM_STR);
        $stmt->execute();

        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            // Use the image path directly from database, fallback to no-image.png if empty
            $product_img = !empty($row->product_image) ? $row->product_image : 'assets/images/no-image.png';

            // Debug: log image path (remove this line after testing)
            // error_log("Product: " . $row->product_name . " - Image: " . $product_img);

            $products[] = [
                'id' => $row->id,
                'product_name' => $row->product_name,
                'brand_name' => $row->brand_name ?? '',
                'product_code' => $row->product_id,
                'sku' => $row->sku ?? '',
                'quantity' => $row->quantity,
                'sell_price' => $row->sell_price,
                'product_image' => $product_img
            ];
        }

        echo json_encode($products);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }

    exit;
}
