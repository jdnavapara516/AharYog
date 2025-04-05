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
    <title>AaharYog - Protein Bar</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
</head>

<style>
    /* .slider {
        height: 100px;
    } */

    /* .slider img {
        height: 100%;
        object-fit: cover;
    } */
</style>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="images/Logo.jpg" alt="AaharYog Logo">
            <span>AaharYog</span>
        </div>

        <div class="logo">
            <span> Welcome to AharYog <?php echo $username; ?></span>
        </div>
    </header>

    <section class="slider">
        <button class="slider-btn prev"><</button>
        <div class="slider-image">
            <img src="https://images.unsplash.com/photo-1590080875515-8a3a8dc5735e?auto=format&fit=crop&w=1200&q=80" alt="Protein Bar">
            <h1 class="slider-title">Protein Bar</h1>
        </div>
        <button class="slider-btn next">></button>
    </section>

    <!-- Quotes Section -->
    <section class="quotes">
        <div class="plate-image">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=300&q=80" alt="Healthy Plate">
        </div>
        <div class="quotes-list">
            <p>"Make your own medicine and you won't need medicine anymore."</p>
            <p>"Fresh air/Drink lemon water. Vegetables are always the answer to your diseases."</p>
            <p>"A diet that makes you sick do avoid not is not a diet that you should follow."</p>
            <p>"Good natural good diet."</p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products">
        <div class="products-grid">
            <!-- Row 1 -->
            <div class="product-item" onclick="window.location.href='item/item.php?category=Chips'">
                <img src="images/wafer.jpg" alt="Chips">
                <span>Chips</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Namkeen'">
                <img src="images/namkeen.png" alt="Namkeen">
                <span>Namkeen</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Biscuit'">
                <img src="images/biskut.jpg" alt="Biscuit">
                <span>Biscuit</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Chocolates'">
                <img src="https://images.unsplash.com/photo-1606312619070-d48b4c652a52?auto=format&fit=crop&w=300&q=80" alt="Chocolates">
                <span>Chocolates</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Noodles'">
                <img src="images/noodles.jpg" alt="Chips">
                <span>Noodles</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Cakes'">
                <img src="images/cakes.jpeg" alt="Namkeen">
                <span>Cakes</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=BreakFast'">
                <img src="images/breakfast.png" alt="Biscuit">
                <span>BreakFast</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Juice'">
                <img src="images/juice.jpg" alt="Chocolates">
                <span>Juice</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Burger'">
                <img src="images/burger.jpg" alt="Chips">
                <span>Burger</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Pizza'">
                <img src="images/pizza.jpg" alt="Namkeen">
                <span>Pizza</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Drinkes'">
                <img src="images/drinks.jpg" alt="Biscuit">
                <span>Drinkes</span>
            </div>
            <div class="product-item" onclick="window.location.href='item/item.php?category=Pasta'">
                <img src="images/pasta.jpg" alt="Chocolates">
                <span>Pasta</span>
            </div>
        </div>
    </section>

    <footer>
      
        <nav class="bottom-nav">
            <a href="#">Home<i style="color: antiquewhite;" data-lucide="home"></i></a>
            <a href="../Yog/Page 1/yogsection.php">Yog<i data-lucide="Yog"></i></a>
            <a href="scan.php">Scan<i data-lucide="scan-line"></i></a>
            <a href="../bmrsection/bmr.php">Bmr<i data-lucide="list"></i></a>
            <a href="../profilesection/user.php">User<i data-lucide="user"></i></a>
        </nav>
        
    </footer>

    <script>
        
       
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    
   
</body>

</html>
