<?php
// Handle POST request from the JavaScript barcode fetch
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
        $result = [
            'status' => 'success',
            'product_name' => $product['product_name'] ?? 'Unknown',
            'brand' => $product['brands'] ?? 'Unknown',
            'ingredients' => $product['ingredients_text'] ?? 'Not specified',
            'nutrition' => isset($product['nutriments']['energy-kcal']) ? $product['nutriments']['energy-kcal'] . ' kcal' : 'Not available',
        ];
    } else {
        $result = ['status' => 'error', 'message' => 'Product not found'];
    }

    echo json_encode($result);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barcode Scanner with Open Food Facts</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    #scanner-container {
      display: none;
      width: 100%;
      max-width: 500px;
      margin: auto;
      border: 2px solid #ddd;
      position: relative;
    }
    video {
      width: 100%;
    }
    #result-card {
      display: none;
      margin-top: 20px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background: #f9f9f9;
    }
    .label {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Barcode Scanner</h1>
  <button id="start-scan">Start Scan</button>
  <div id="scanner-container"></div>
  <div id="result-card">
    <h2>Product Details</h2>
    <p><span class="label">Name:</span> <span id="product-name"></span></p>
    <p><span class="label">Brand:</span> <span id="product-brand"></span></p>
    <p><span class="label">Ingredients:</span> <span id="product-ingredients"></span></p>
    <p><span class="label">Nutritional Info:</span> <span id="product-nutrition"></span></p>
  </div>

  <script>
    const scannerContainer = document.getElementById('scanner-container');
    const startScanButton = document.getElementById('start-scan');
    const resultCard = document.getElementById('result-card');

    startScanButton.addEventListener('click', () => {
      scannerContainer.style.display = 'block';
      resultCard.style.display = 'none';
      Quagga.init({
        inputStream: {
          name: "Live",
          type: "LiveStream",
          target: scannerContainer,
        },
        decoder: {
          readers: ["ean_reader"], // EAN barcodes (used in food packaging)
        },
      }, function (err) {
        if (err) {
          console.error("Error initializing Quagga:", err);
          return;
        }
        Quagga.start();
      });

      Quagga.onDetected(function (result) {
        const barcode = result.codeResult.code;
        console.log("Detected barcode:", barcode);
        Quagga.stop();
        scannerContainer.style.display = 'none';
        fetchProductDetails(barcode);
      });
    });

    function fetchProductDetails(barcode) {
      fetch('', { // The same PHP file handles this request
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ barcode }),
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          document.getElementById('product-name').textContent = data.product_name || 'N/A';
          document.getElementById('product-brand').textContent = data.brand || 'N/A';
          document.getElementById('product-ingredients').textContent = data.ingredients || 'N/A';
          document.getElementById('product-nutrition').textContent = data.nutrition || 'N/A';
          resultCard.style.display = 'block';
        } else {
          alert('Product not found!');
        }
      })
      .catch(err => console.error("Error fetching product details:", err));
    }
  </script>
</body>
</html>
