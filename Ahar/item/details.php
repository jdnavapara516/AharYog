<?php
// Include database connection
include '../../db.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.html');
}
$username = $_SESSION['username'];
// $email = $_SESSION['email'];


// Check if barcode is provided
if (isset($_GET['name'])) {
    $name = $_GET['name']; // Sanitize input

    // Prepare SQL query to fetch item details
    $sql = "SELECT * FROM Item WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if item exists
    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();


        $name = $item['Name'];
        $brand = $item['Brand'];
        $rating = $item['Rating'];
        $alert = $item['Alert'];
        $ingredients = $item['Ingredients'];
        $nutritional_info = json_decode($item['nutritional_info'], true);
        $allergens = $item['Allergens'];
        $goodForHealth = $item['GoodForHealth'];
        $barcode = $item['Barcode'];
        $category = $item['Category'];
        $grade = $item['Grade'];
        $photo = $item['photo'];



        // Extract nutritional information details
        $processing_level = $nutritional_info['Processing Level'] ?? '';
        $additives = $nutritional_info['Additives'] ?? 0;
        $energy = $nutritional_info['Energy'] ?? 0;
        $total_sugars = $nutritional_info['Total Sugars'] ?? 0;
        $total_fat = $nutritional_info['Total Fat'] ?? 0;
        $saturated_fat = $nutritional_info['Saturated Fat'] ?? 0;
        $trans_fat = $nutritional_info['Trans Fat'] ?? 0;
        $cholesterol = $nutritional_info['Cholesterol'] ?? 0;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Item not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No barcode provided']);
}



?>

<html>

<head>
    <title>
        Food Information
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">
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
    <header class="header">
        <div class="logo">
            <img src="image/Logo.jpg" alt="Logo">
            <h2 style="font-family: Cormorant Garanond; font-size: 1.5rem;  font-weight: 600; color: #e3d1aa;">AaharYog</h2>
        </div>
        <div class="logo">
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
    </header>


    <div class="container">
        <div class="product-info">
            <img src="<?php echo htmlspecialchars($photo); ?>" alt="Product Photo" />
            <div class="product-details">
                <h2>
                    <?php echo $name; ?>
                </h2>
                <div class="rating">
                    <div class="score">
                        <?php echo $rating; ?>
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
                        <?php echo $grade; ?>
                    </div>
                </div>
                <div class="grade">
                    <div class="label">
                        Good for Health:
                    </div>
                    <div class="value">
                        <?php echo $goodForHealth; ?>
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
                        <?php echo $alert ?>
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
                        <?php echo $processing_level; ?>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <i class="fas fa-lock">
                        </i>
                        Additives
                    </div>
                    <div class="status neutral">
                        <?php echo $additives; ?>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <i class="fas fa-lock">
                        </i>
                        Energy
                    </div>
                    <div class="status bad">
                        <?php echo $energy; ?>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <i class="fas fa-lock">
                        </i>
                        Total Sugars
                    </div>
                    <div class="status bad">
                        <?php echo $total_sugars; ?>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <i class="fas fa-lock">
                        </i>
                        Total Fat
                    </div>
                    <div class="status bad">
                        <?php echo $total_fat; ?>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <i class="fas fa-lock">
                        </i>
                        Saturated Fat
                    </div>
                    <div class="status bad">
                        <?php echo $saturated_fat; ?>
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
                            <?php echo $trans_fat; ?>
                        </div>
                    </div>
                    <div class="item">
                        <div>
                            <i class="fas fa-lock">
                            </i>
                            Cholestrol
                        </div>
                        <div class="status good">
                            <?php echo $cholesterol; ?>
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
</body>

</html>