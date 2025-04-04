<?php
// Start the session
session_start();

// Check if the category is set in the query string
if (!isset($_GET['category'])) {
    header('location:error.php');
    exit();
}
$category = $_GET['category'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AaharYog - <?php echo htmlspecialchars($category); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(255, 255, 255);
        }


        .product-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 250px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-card h2 {
            font-size: 18px;
            margin: 10px 0;
        }

        .rating {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin: 10px 0;
        }

        .rating span {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            color: white;
            font-weight: bold;
        }

        .highlighted {
            border: 2px solid black;
            /* Makes it stand out */
            transform: scale(1.2);
            /* Slightly enlarges the highlighted grade */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            /* Adds a shadow */
        }

        .A {
            background-color: #4caf50;
        }

        .B {
            background-color: #ffeb3b;
        }

        .C {
            background-color: #ff9800;
        }

        .D {
            background-color: #f44336;
        }

        @media (max-width: 768px) {
            .product-grid {
                flex-direction: column;
                align-items: center;
            }
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

    <div class="main-content">
        <h1 style="text-align: center;"><?php echo htmlspecialchars($category); ?></h1>

        <div class="product-grid">

            <?php
            // Include the database connection
            include '../../db.php';
            $category = $conn->real_escape_string($category);

            // Query to fetch products based on category
            $query = "SELECT name, grade, photo, barcode FROM item WHERE category = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                // Convert BLOB image to base64
                // $photo = !empty($row['photo']) ? 'data:image/jpeg;base64,' . base64_encode($row['photo']) : 'default.jpg';
            ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($row['photo']); ?>" />
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                    <div class="rating">
                        <span class="A <?php echo ($row['grade'] == 'A') ? 'highlighted' : ''; ?>">A</span>
                        <span class="B <?php echo ($row['grade'] == 'B') ? 'highlighted' : ''; ?>">B</span>
                        <span class="C <?php echo ($row['grade'] == 'C') ? 'highlighted' : ''; ?>">C</span>
                        <span class="D <?php echo ($row['grade'] == 'D') ? 'highlighted' : ''; ?>">D</span>
                    </div>

                    <a style="color:#1a1a2e; text-decoration: none; display: block; ;"
                        class="more"
                        href="details.php?name=<?php echo urlencode($row['name']); ?>">
                        More
                    </a>

                </div>


            <?php } ?>

        </div>
    </div>
</body>

</html>