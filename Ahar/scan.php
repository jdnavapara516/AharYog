<?php
//CONNECT DATABASE
include '../db.php';
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

  // FIRST CHECK ITEAM IS IN DATABASE OR NOT if item exist then fetch all data from database and start session add item data in to seesion and redirect to details.php page
  $stmt = $conn->prepare("SELECT * FROM item WHERE Barcode = ?");
  $stmt->bind_param("s", $barcode);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if item exists
  if ($result->num_rows > 0) {
    $item = $result->fetch_assoc();
    session_start();
    $_SESSION['item_data'] = $item;

    echo json_encode(['status' => 'success', 'redirect' => 'details.php']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Item not found']);
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
  <!-- <link rel="stylesheet" href="scan-style.css"> -->

  <!-- <link rel="stylesheet" href="styles.css"> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .container {
      padding: 20px;
    }


    .product-info {
      display: flex;
      justify-content: space-between;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .product-info img {
      width: 150px;
      height: auto;
      border-radius: 10px;
    }

    .product-details {
      flex-grow: 1;
      margin-left: 20px;
    }

    .product-details h2 {
      margin: 0;
      font-size: 18px;
    }

    .rating {
      display: flex;
      align-items: center;
      margin-top: 10px;
    }

    .rating .score {
      background-color: #ffcc00;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 16px;
      font-weight: bold;
      margin-right: 10px;
    }

    .rating .status {
      font-size: 16px;
      color: #ff3300;
    }

    .grade {
      display: flex;
      align-items: center;
      margin-top: 10px;
    }

    .grade .label {
      font-size: 16px;
      font-weight: bold;
      margin-right: 10px;
    }

    .grade .value {
      background-color: #33cc33;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 16px;
      font-weight: bold;
    }

    .alert-card {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .alert-card .alert {
      display: flex;
      align-items: center;
    }

    .alert-card .alert i {
      font-size: 24px;
      color: #ff3300;
      margin-right: 10px;
    }

    .alert-card .alert h3 {
      margin: 0;
      font-size: 18px;
      color: #ff3300;
    }

    .alert-card .alert-details {
      margin-top: 10px;
    }

    .alert-card .alert-details .item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .alert-card .alert-details .item i {
      font-size: 18px;
      margin-right: 10px;
    }

    .alert-card .alert-details .item .status {
      font-size: 16px;
      color: #ff3300;
    }

    .alert-card .alert-details .item .status.occasionally {
      color: #ff9900;
    }

    .section {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .section h3 {
      margin: 0;
      font-size: 18px;
      display: flex;
      align-items: center;
    }

    .section h3 i {
      font-size: 24px;
      margin-right: 10px;
    }

    .section .tabs {
      display: flex;
      margin-top: 10px;
    }

    .section .tabs .tab {
      flex: 1;
      text-align: center;
      padding: 10px;
      cursor: pointer;
      border-radius: 5px;
    }

    .section .tabs .tab.active {
      background-color: #ffcc00;
    }

    .section .content {
      margin-top: 20px;
    }

    .section .content .item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .section .content .item i {
      font-size: 18px;
      margin-right: 10px;
    }

    .section .content .item .status {
      font-size: 16px;
      color: #ff3300;
    }

    .section .content .item .status.good {
      color: #33cc33;
    }

    .section .content .item .status.neutral {
      color: #ffcc00;
    }

    .section .content .item .status.bad {
      color: #ff3300;
    }
  </style>




</head>

<body>
  <div class="con" style="display: flex; justify-content: center; flex-direction : column; padding-left: 50vh;   ">
    <h1 style="padding-left : 150px">Barcode Scanner</h1>
    <div id="scanner-container"></div>
  </div>
  <div class="con" style="display: flex; justify-content: center; flex-direction : column;   ">
    <div id="result-card">
      <h2 style="font-size: 2rem; color: #2c3e50; text-align: center; margin-top: 30px; padding-bottom: 15px; border-bottom: 2px solid #e1e1e1; width: 50%; margin-left: auto; margin-right: auto;">Product Details</h2>

      <div style="width: 93%; margin: 20px auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Name:</span> <span id="product-name" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Brand:</span> <span id="product-brand" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Ingredients:</span> <span id="product-ingredients" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Nutritional Info:</span> <span id="product-nutrition" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Allergens:</span> <span id="product-allergens" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Packaging:</span> <span id="product-packaging" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Countries:</span> <span id="product-countries" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Labels:</span> <span id="product-labels" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Categories:</span> <span id="product-categories" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Quantity:</span> <span id="product-quantity" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Barcode:</span> <span id="product-barcode" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Brands Text:</span> <span id="product-brands-text" style="font-weight: normal; color: #7f8c8d;"></span>
        </p>
        <p style="font-size: 1rem; line-height: 1.6; color: #555; margin: 10px 0;">
          <span class="label" style="font-weight: bold; color: #2c3e50; margin-right: 10px;">Product URL:</span>
          <a id="product-url" href="#" target="_blank" style="color: #2980b9; text-decoration: none; font-weight: bold;">Link</a>
        </p>
      </div>

    </div>
  </div>




  <div class="container">
    <div class="product-info">
      <p><span class="label"></span> <img id="product-image" alt="Product Image"></p>
      <div class="product-details">
        <h2>
          <p><span class="label">Name :</span> <span id="product-name"></span></p>

        </h2>
        <div class="rating">
          <div class="score">

            <?php
            // $grade = rateFoodByIngredients($ingredientsText);
            function rateFoodByIngredients($ingredientsText)
            {
              // Define ingredient categories
              $healthyIngredients = ['wheat flour', 'cocoa powder', 'vanilla flavor'];
              $unhealthyIngredients = ['sugar', 'palm oil', 'fructose syrup', 'corn starch', 'salt'];
              $additives = ['ins500', 'ins503', 'ins322']; // Common food additives

              // Convert input to lowercase for case-insensitive matching
              $ingredientsText = strtolower($ingredientsText);

              // Split ingredients by comma
              $ingredients = explode(',', $ingredientsText);

              // Initialize scores
              $healthyScore = 0;
              $unhealthyScore = 0;
              $additiveScore = 0;

              // Check each ingredient
              foreach ($ingredients as $ingredient) {
                $ingredient = trim($ingredient);

                // Check for healthy ingredients
                foreach ($healthyIngredients as $healthy) {
                  if (strpos($ingredient, $healthy) !== false) {
                    $healthyScore += 2;
                  }
                }

                // Check for unhealthy ingredients
                foreach ($unhealthyIngredients as $unhealthy) {
                  if (strpos($ingredient, $unhealthy) !== false) {
                    $unhealthyScore += 2;
                  }
                }

                // Check for additives
                foreach ($additives as $additive) {
                  if (strpos($ingredient, $additive) !== false) {
                    $additiveScore += 1;
                  }
                }
              }

              // Calculate final score
              $finalScore = $healthyScore - ($unhealthyScore + $additiveScore);

              // Normalize score to 1-5 rating scale
              $maxScore = 10;  // Maximum possible score
              $normalizedRating = round(((($finalScore + $maxScore) / (2 * $maxScore)) * 4) + 1, 1);

              // Ensure rating stays between 1 and 5
              $rating = max(1, min(5, $normalizedRating));

              return $rating;
            }

            // Example Usage
            $ingredientsText = "Ingredients Text: <span id='product-ingredients-text'></span>";

            $rating = rateFoodByIngredients($ingredientsText);
            echo  $rating;



            ?>


          </div>
          <div class="status">
            Out of 5 Poor
          </div>
        </div>
        <div class="grade">
          <div class="label">
            Grade:

          </div>
          <div class="value">

            <?php
            $rating = rateFoodByIngredients($ingredientsText);
            function gradeFoodByIngredients($ingredientsText)
            {
              // Define ingredient categories
              $healthyIngredients = ['wheat flour', 'cocoa powder', 'vanilla flavor'];
              $unhealthyIngredients = ['sugar', 'palm oil', 'fructose syrup', 'corn starch', 'salt'];
              $additives = ['ins500', 'ins503', 'ins322']; // Common food additives

              // Convert input to lowercase for case-insensitive matching
              $ingredientsText = strtolower($ingredientsText);

              // Split ingredients by comma
              $ingredients = explode(',', $ingredientsText);

              // Initialize scores
              $healthyScore = 0;
              $unhealthyScore = 0;
              $additiveScore = 0;

              // Check each ingredient
              foreach ($ingredients as $ingredient) {
                $ingredient = trim($ingredient);

                // Check for healthy ingredients
                foreach ($healthyIngredients as $healthy) {
                  if (strpos($ingredient, $healthy) !== false) {
                    $healthyScore += 5;
                  }
                }

                // Check for unhealthy ingredients
                foreach ($unhealthyIngredients as $unhealthy) {
                  if (strpos($ingredient, $unhealthy) !== false) {
                    $unhealthyScore += 5;
                  }
                }

                // Check for additives
                foreach ($additives as $additive) {
                  if (strpos($ingredient, $additive) !== false) {
                    $additiveScore += 3;
                  }
                }
              }

              // Calculate final score
              $finalScore = $healthyScore - ($unhealthyScore + $additiveScore);
              $maxScore = 15; // Maximum possible score

              // Normalize score to 0-100
              $normalizedScore = (($finalScore + $maxScore) / (2 * $maxScore)) * 100;

              // Assign grade
              if ($normalizedScore >= 90) return 'A';
              elseif ($normalizedScore >= 75) return 'B';
              elseif ($normalizedScore >= 50) return 'C';
              elseif ($normalizedScore >= 30) return 'D';
              else return 'F';
            }

            // Example Usage
            $ingredientsText = "Ingredients Text: <span id='product-ingredients-text'></span>";
            $grade = gradeFoodByIngredients($ingredientsText);
            echo $grade;



            ?>


          </div>
        </div>
        <div class="grade">
          <div class="label">
            Good for Health:
          </div>
          <div class="value">
            <?php
            if ($rating >= 4) {
              echo "<span class='status good'>Yes</span>";
            } elseif ($rating >= 2) {
              echo "<span class='status neutral'>Occasionally</span>";
            } else {
              echo "<span class='status bad'>No</span>";
            }
            ?> <p><span class="label"></span> <span id="product-health"></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="alert-card">
      <div class="alert">
        <i class="fas fa-exclamation-triangle">
        </i>
        <h3>
          Allergens
        </h3>
      </div>
      <div class="alert-details">
        <div class="item">
          <div>
            <i class="fas fa-lock">
            </i>
            <p><span class="label"></span> <span id="product-allergens"></span></p>



            <!-- allergens -->
            <?php
            $allergens = explode(',', $product['allergens'] ?? 'None specified');
            foreach ($allergens as $allergen) {
              echo "<li>" . ucfirst($allergen) . "</li>";
            }
            ?>

          </div>

        </div>
      </div>
    </div>
    <div class="section">
      <h3>
        <i class="fas fa-info-circle">
        </i>
        What Concerns Us
      </h3>
      <div class="tabs">
        <div class="tab active">
          Per 100 g
        </div>
        <!-- <div class="tab">
                    Per 50 g
                </div> -->
      </div>
      <div class="content">
        <div class="item">
          <div>
            <i class="fas fa-lock">
            </i>
            <p><span class="label">Categories:</span> <span id="product-categories"></span></p>

            <p><span class="label">Nutritional Info:</span> <span id="product-nutrition"></span></p>
            <p><span class="label">Ingredients:</span> <span id="product-ingredients"></span></p>
            <p><span class="label"></span> <span id="product-ingredients-text"></span></p>
            <!-- ingredients -->
            <?php
            $ingredientsText = explode(',', $product['ingredients_text'] ?? 'Not specified');
            foreach ($ingredientsText as $ingredient) {
              echo "<li>" . ucfirst($ingredient) . "</li>";
            }
            ?>


          </div>
        </div>
























        <script>
          const scannerContainer = document.getElementById('scanner-container');
          const resultCard = document.getElementById('result-card');

          window.onload = () => {
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
            }, function(err) {
              if (err) {
                console.error("Error initializing Quagga:", err);
                return;
              }
              Quagga.start();
            });

            Quagga.onDetected(function(result) {
              const barcode = result.codeResult.code;
              console.log("Detected barcode:", barcode);
              Quagga.stop();
              scannerContainer.style.display = 'none';
              fetchProductDetails(barcode);
            });
          };

          function fetchProductDetails(barcode) {
            fetch('', { // The same PHP file handles this request
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                  barcode
                }),
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