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


        
        // Extract product details
        $nutritionScore = $product['nutriments']['nutrition-score-fr'] ?? null;
        $isHealthy = ($nutritionScore !== null && $nutritionScore <= 5) ? 'Yes' : 'No';

        $result = [
            'status' => 'success',
            'product_name' => $product['product_name'] ?? 'Unknown',
            'brand' => $product['brands'] ?? 'Unknown',
            'ingredients' => $product['ingredients_text'] ?? 'Not specified',
            'nutrition' => isset($product['nutriments']['energy-kcal']) ? $product['nutriments']['energy-kcal'] . ' kcal' : 'Not available',
            'allergens' => $product['allergens'] ?? 'None specified',
            'packaging' => $product['packaging'] ?? 'Not specified',
            'countries' => $product['countries'] ?? 'Unknown',
            'labels' => $product['labels'] ?? 'Not specified',
            'categories' => $product['categories'] ?? 'Not specified',
            'is_healthy' => $isHealthy,
            'quantity' => $product['quantity'] ?? 'Not specified',
            'barcode' => $product['code'] ?? 'Not specified',
            'brands_text' => $product['brands_text'] ?? 'Not specified',
            'ingredients_text' => $product['ingredients_text'] ?? 'Not specified',
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barcode Scanner with Open Food Facts</title>
  <link rel="stylesheet" href="scan.css">
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
    img {
      width: 100px;
      height: 100px;
    }
    /* Base Styles */
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
    color: #333;
  }
  
  h1 {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
  }
  
  /* Start Scan Button */
  #start-scan {
    display: block;
    width: 100%;
    max-width: 200px;
    margin: 0 auto;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
  }
  
  #start-scan:hover {
    background-color: #45a049;
  }
  
  /* Scanner Container */
  #scanner-container {
    display: none;
    width: 100%;
    max-width: 500px;
    margin: 20px auto;
    border: 2px solid #ddd;
    position: relative;
  }
  
  video {
    width: 100%;
    border-radius: 5px;
  }
  
  /* Result Card */
  #result-card {
    display: none;
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
  
  #result-card h2 {
    text-align: center;
    font-size: 20px;
  }
  
  .label {
    font-weight: bold;
    color: #333;
  }
  
  #product-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
    margin-top: 10px;
  }
  
  a {
    color: #007BFF;
    text-decoration: none;
  }
  
  a:hover {
    text-decoration: underline;
  }
  
  /* Card Layout */
  p {
    margin: 10px 0;
    font-size: 14px;
  }
  
  span {
    color: #555;
  }
  
  /* Responsive Layout */
  @media (max-width: 768px) {
    h1 {
      font-size: 20px;
    }
  
    #start-scan {
      width: 80%;
    }
  
    #scanner-container {
      width: 90%;
    }
  
    #result-card {
      width: 90%;
      padding: 15px;
    }
  
    #product-image {
      width: 80px;
      height: 80px;
    }
  
    .label, span {
      font-size: 14px;
    }
  
    p {
      font-size: 12px;
    }
  }
  
  @media (max-width: 480px) {
    h1 {
      font-size: 18px;
    }
  
    #start-scan {
      width: 100%;
      padding: 12px 20px;
      font-size: 18px;
    }
  
    #scanner-container {
      width: 100%;
    }
  
    #result-card {
      width: 100%;
      padding: 10px;
    }
  
    #product-image {
      width: 70px;
      height: 70px;
    }
  
    .label, span {
      font-size: 13px;
    }
  
    p {
      font-size: 11px;
    }
  }
  
  @media (min-width: 1024px) {
    h1 {
      font-size: 28px;
    }
  
    #start-scan {
      width: 200px;
    }
  
    #scanner-container {
      width: 500px;
    }
  
    #result-card {
      width: 151vh;
      padding: 20px;
    }
  
    #product-image {
      width: 100px;
      height: 100px;
    }
  
    .label, span {
      font-size: 16px;
    }
  
    p {
      font-size: 14px;
    }
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
    <p><span class="label">Allergens:</span> <span id="product-allergens"></span></p>
    <p><span class="label">Packaging:</span> <span id="product-packaging"></span></p>
    <p><span class="label">Countries:</span> <span id="product-countries"></span></p>
    <p><span class="label">Labels:</span> <span id="product-labels"></span></p>
    <p><span class="label">Categories:</span> <span id="product-categories"></span></p>
    <p><span class="label">Good for Health:</span> <span id="product-health"></span></p>
    <p><span class="label">Quantity:</span> <span id="product-quantity"></span></p>
    <p><span class="label">Barcode:</span> <span id="product-barcode"></span></p>
    <p><span class="label">Brands Text:</span> <span id="product-brands-text"></span></p>
    <p><span class="label">Ingredients Text:</span> <span id="product-ingredients-text"></span></p>
    <p><span class="label">Image:</span> <img id="product-image" alt="Product Image"></p>
    <p><span class="label">Product URL:</span> <a id="product-url" href="#" target="_blank">Link</a></p>
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
          document.getElementById('product-allergens').textContent = data.allergens || 'N/A';
          document.getElementById('product-packaging').textContent = data.packaging || 'N/A';
          document.getElementById('product-countries').textContent = data.countries || 'N/A';
          document.getElementById('product-labels').textContent = data.labels || 'N/A';
          document.getElementById('product-categories').textContent = data.categories || 'N/A';
          document.getElementById('product-health').textContent = data.is_healthy || 'N/A';
          document.getElementById('product-quantity').textContent = data.quantity || 'N/A';
          document.getElementById('product-barcode').textContent = data.barcode || 'N/A';
          document.getElementById('product-brands-text').textContent = data.brands_text || 'N/A';
          document.getElementById('product-ingredients-text').textContent = data.ingredients_text || 'N/A';
          document.getElementById('product-image').src = data.image_url || '';
          document.getElementById('product-url').href = data.url || '#';
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
