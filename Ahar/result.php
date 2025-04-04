<?php
session_start(); // Start the session

// Check if product data is available in the session
$productData = $_SESSION['product_data'] ?? null;

// Clear the session data after retrieving it
unset($_SESSION['product_data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Result</title>
  <link rel="stylesheet" href="result.css">
</head>

<body>
  <h1>Product Details</h1>

  <?php if ($product_data['status'] === 'success'): ?>
    <div id="product-details">
      <p><strong>Name:</strong> <?php echo htmlspecialchars($productData['product_name']); ?></p>
      <p><strong>Brand:</strong> <?php echo htmlspecialchars($productData['brand']); ?></p>
      <p><strong>Ingredients:</strong> <?php echo htmlspecialchars($productData['ingredients']); ?></p>
      <p><strong>Nutritional Info:</strong> <?php echo htmlspecialchars($productData['nutrition']); ?></p>
      <p><strong>Allergens:</strong> <?php echo htmlspecialchars($productData['allergens']); ?></p>
      <p><strong>Packaging:</strong> <?php echo htmlspecialchars($productData['packaging']); ?></p>
      <p><strong>Countries:</strong> <?php echo htmlspecialchars($productData['countries']); ?></p>
      <p><strong>Labels:</strong> <?php echo htmlspecialchars($productData['labels']); ?></p>
      <p><strong>Categories:</strong> <?php echo htmlspecialchars($productData['categories']); ?></p>
      <p><strong>Good for Health:</strong> <?php echo htmlspecialchars($productData['is_healthy']); ?></p>
      <p><strong>Quantity:</strong> <?php echo htmlspecialchars($productData['quantity']); ?></p>
      <p><strong>Barcode:</strong> <?php echo htmlspecialchars($productData['barcode']); ?></p>
      <p><strong>Brands Text:</strong> <?php echo htmlspecialchars($productData['brands_text']); ?></p>
      <p><strong>Ingredients Text:</strong> <?php echo htmlspecialchars($productData['ingredients_text']); ?></p>
      <p><strong>Image:</strong> <img src="<?php echo htmlspecialchars($productData['image_url']); ?>" alt="Product Image"></p>
      <p><strong>Product URL:</strong> <a href="<?php echo htmlspecialchars($productData['url']); ?>" target="_blank">Link</a></p>
    </div>
  <?php else: ?>
    <p>Product not found or an error occurred.</p>
  <?php endif; ?>





















  

</body>

</html>
