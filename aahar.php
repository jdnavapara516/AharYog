<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.html');
}
$username = $_SESSION['username'];
// $email = $_SESSION['email'];

if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aahar - AaharYog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/aahar.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <nav class="navbar">
        <div class="logo-profile">
            <div class="logo">
                <img src="images/aharlogo.jpg" alt="AaharYog" class="logo-img">
                <span>AaharYog</span>
            </div>
            <!-- <form action="aahar.php" method="POST">
                <div class="search-bar">
                    <input type="text" placeholder="Search" name="search">
                    <button class="scan-btn" type="submit">
                        <i class="fa-solid fa-qrcode"></i>
                    </button>
                </div>
            </form> -->
            <!-- <form action="scan.php" method="POST" id="barcode-form">
                <input type="hidden" name="barcode" id="barcode-input">
                <button class="scan-btn" type="button" id="barcode-button">
                    <i class="fa-solid fa-qrcode"></i>
                </button>
            </form> -->
            <div class="user-profile">
                <span><?php echo $username; ?></span>
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </nav>

    <div class="content">
        <main class="main-content">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="product-grid">
                <div class="product-card">
                    <img src="images/cakes.jpg" alt="Wafers & Namkeen">
                    <h3>Cacks & Bakes</h3>
                </div>
                <div class="product-card">
                    <img src="images/biskut.jpg" alt="Biscuits">
                    <h3>Biscuits</h3>
                </div>
                <div class="product-card">
                    <img src="images/wafer.jpg" alt="Wafers & Namkeen">
                    <h3>Wafers</h3>
                </div>
                <div class="product-card">
                    <img src="images/breakfast.png" alt="Biscuits">
                    <h3>Breakfast & Spreads</h3>
                </div>
                <div class="product-card">
                    <img src="images/chocolate.jpg" alt="Wafers & Namkeen">
                    <h3>Chocolates & Desserts</h3>
                </div>
                <div class="product-card">
                    <img src="images/maggi.jpg" alt="Biscuits">
                    <h3>Noodels</h3>
                </div>
                <div class="product-card">
                    <img src="images/cold drinks.jpg" alt="Wafers & Namkeen">
                    <h3>Cold Drinks & Juices</h3>
                </div>

                <div class="product-card">
                    <img src="images/oil.jpg" alt="Biscuits">
                    <h3>Dry Fruits Oil & Masalas</h3>
                </div>
                <div class="product-card">
                    <img src="images/coffe.jpg" alt="Wafers & Namkeen">
                    <h3>Tea Coffee & more</h3>
                </div>

            </div>
            <div style="height: 100px"></div>
        </main>
    </div>

    <nav class="bottom-nav">
        <button class="nav-btn">
            <a href="home.php"><i class="fa-solid fa-house"></i></a>
        </button>
        <button class="nav-btn">
            <i class="fa-brands fa-searchengin fa-solid"></i> </button>

        <button class="nav-btn">

            <a href="scan.php"><i class="fa-solid fa-qrcode"></i> </a> </button>
        <button class="nav-btn">
            <i class="fa-solid fa-file"></i> </button>
        <button class="nav-btn">
            <i class="fa-solid fa-user"></i> </button>
    </nav>

    <script src="js/aahar.js"></script>
    <script src="js/style.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

</body>

</html>