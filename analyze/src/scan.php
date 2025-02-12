<?php
// filepath: /barcode-scanner-project/barcode-scanner-project/src/scan.php

// session_start();
// if(!isset($_SESSION['username'])){
//     header('location:login.html');
//     exit;
// }

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $barcode = $data['barcode'] ?? '';

    if (!$barcode) {
        echo json_encode(['status' => 'error', 'message' => 'Barcode is required']);
        exit;
    }

    $apiUrl = "https://world.openfoodfacts.org/api/v0/product/$barcode.json";
    $response = file_get_contents($apiUrl);
    $productData = json_decode($response, true);

    if (isset($productData['status']) && $productData['status'] === 1) {
        $product = $productData['product'];
        $result = [
            'status' => 'success',
            'product_name' => $product['product_name'] ?? 'Unknown',
            'brand' => $product['brands'] ?? 'Unknown',
            'ingredients' => $product['ingredients_text'] ?? 'Not specified',
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