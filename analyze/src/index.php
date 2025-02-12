<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scanner Project</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
</head>
<body>
    <header>
        <h1>Barcode Scanner</h1>
    </header>

    <main>
        <div>
            <label for="health-condition">Enter your health condition:</label>
            <input type="text" id="health-condition" placeholder="e.g., diabetes, gluten-free">
        </div>
        <button id="start-scan">Start Scan</button>
        <div id="scanner-container" style="display:none;"></div>
        <div id="result-card" style="display:none;">
            <h2>Product Details</h2>
            <p><span class="label">Name:</span> <span id="product-name"></span></p>
            <p><span class="label">Brand:</span> <span id="product-brand"></span></p>
            <p><span class="label">Rating:</span> <span id="product-rating"></span></p>
            <canvas id="rating-chart" width="400" height="200"></canvas>
        </div>
    </main>

    <footer>
        <nav class="bottom-nav">
            <a href="#"><i data-lucide="home"></i></a>
            <a href="#"><i data-lucide="search"></i></a>
            <a href="scan.php"><i data-lucide="scan-line"></i></a>
            <a href="#"><i data-lucide="list"></i></a>
            <a href="#"><i data-lucide="user"></i></a>
        </nav>
    </footer>

    <script src="assets/js/scripts.js"></script>
</body>
</html>