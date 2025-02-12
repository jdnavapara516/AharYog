<?php
// filepath: /barcode-scanner-project/barcode-scanner-project/src/fetch_product.php

// Handle POST request from the scan.php file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Read POST data
    $data = json_decode(file_get_contents('php://input'), true);
    $barcode = $data['barcode'] ?? '';

    // Check if barcode is provided
    if (!$barcode) {
        echo json_encode(['status' => 'error', 'message' => 'Barcode is required']);
        exit;
    }

    // Fetch data from Open Food Facts API
    $apiUrl = "https://world.openfoodfacts.org/api/v0/product/$barcode.json";
    $response = file_get_contents($apiUrl);
    $productData = json_decode($response, true);

    // Check if the product exists
    if (isset($productData['status']) && $productData['status'] === 1) {
        $product = $productData['product'];

        // Extract relevant product details
        $result = [
            'status' => 'success',
            'product_name' => $product['product_name'] ?? 'Unknown',
            'brand' => $product['brands'] ?? 'Unknown',
            'ingredients' => $product['ingredients_text'] ?? 'Not specified',
            'nutrition' => $product['nutriments'] ?? [],
            'allergens' => $product['allergens'] ?? 'None specified',
            'image_url' => $product['image_url'] ?? 'Not specified',
            'url' => $product['url'] ?? 'Not specified'
        ];
    } else {
        $result = ['status' => 'error', 'message' => 'Product not found'];
    }

    echo json_encode($result);
    exit;
}
?>