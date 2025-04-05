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
  <link rel="stylesheet" href="scan-style.css">

  <link rel="stylesheet" href="scan.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

</head>

<body>

  <h1>Barcode Scanner</h1>
  <div id="scanner-container"></div>
  <div id="result-card">
    <h2>Product Details</h2>
    <!-- <p><span class="label">Name:</span> <span id="product-name"></span></p> -->
    <p><span class="label">Brand:</span> <span id="product-brand"></span></p>
    <p><span class="label">Ingredients:</span> <span id="product-ingredients"></span></p>
    <p><span class="label">Nutritional Info:</span> <span id="product-nutrition"></span></p>
    <!-- <p><span class="label">Allergens:</span> <span id="product-allergens"></span></p> -->
    <p><span class="label">Packaging:</span> <span id="product-packaging"></span></p>
    <p><span class="label">Countries:</span> <span id="product-countries"></span></p>
    <p><span class="label">Labels:</span> <span id="product-labels"></span></p>
    <p><span class="label">Categories:</span> <span id="product-categories"></span></p>

    <p><span class="label">Quantity:</span> <span id="product-quantity"></span></p>
    <p><span class="label">Barcode:</span> <span id="product-barcode"></span></p>
    <p><span class="label">Brands Text:</span> <span id="product-brands-text"></span></p>
    <p><span class="label">Product URL:</span> <a id="product-url" href="#" target="_blank">Link</a></p>
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
            <p><span class="label"></span> <span id="product-health"></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="alert-card">
      <div class="alert">
        <i class="fas fa-exclamation-triangle">
        </i>
        <h3>
          Alert For You
        </h3>
      </div>
      <div class="alert-details">
        <div class="item">
          <div>
            <i class="fas fa-lock">
            </i>


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
            Processing Level
          </div>
          <div class="status bad">
            <!-- <?php echo $processing_level; ?> -->
          </div>
        </div>
        <div class="item">
          <div>
            <i class="fas fa-lock">
            </i>
            Additives
          </div>
          <div class="status neutral">
            <!-- <?php echo $additives; ?> -->
          </div>
        </div>
        <div class="item">
          <div>
            <i class="fas fa-lock">
            </i>
            Energy
          </div>
          <div class="status bad">
            <!-- <?php echo $energy; ?> -->
          </div>
        </div>
        <div class="item">
          <div>
            <i class="fas fa-lock">
            </i>
            Total Sugars
          </div>
          <div class="status bad">
            <!-- <?php echo $total_sugars; ?> -->
          </div>
        </div>
        <div class="item">
          <div>
            <i class="fas fa-lock">
            </i>
            Total Fat
          </div>
          <div class="status bad">
            <!-- <?php echo $total_fat; ?> -->
          </div>
        </div>
        <div class="item">
          <div>
            <i class="fas fa-lock">
            </i>
            Saturated Fat
          </div>
          <div class="status bad">
            <!-- <?php echo $saturated_fat; ?> -->
          </div>
        </div>
        <div class="content">
          <div class="item">
            <div>
              <i class="fas fa-lock">
              </i>
              Trans Fat
            </div>
            <div class="status good">
              <!-- <?php echo $trans_fat; ?> -->
            </div>
          </div>
          <div class="item">
            <div>
              <i class="fas fa-lock">
              </i>
              Cholestrol
            </div>
            <div class="status good">
              <!-- <?php echo $cholesterol; ?> -->
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="section">
                <h3>
                    <i class="fas fa-smile">
                    </i>
                    What We Like
                </h3>

            </div> -->
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