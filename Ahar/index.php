<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.html');
    }
    $username = $_SESSION['username'];
    // $email = $_SESSION['email'];
  
    if(isset($_POST['search'])){
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
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="images/Logo.jpg"alt="AaharYog Logo">
            <span>AaharYog</span>
        </div>
       
        <div class="logo">
           
            <span> Welcome to AharYog <?php echo $username; ?></span>
        </div>
            
       
    </header>

    <!-- Slider Section -->
    <section class="slider">
        <button class="slider-btn prev">&lt;</button>
        <div class="slider-image">
            <img src="https://images.unsplash.com/photo-1590080875515-8a3a8dc5735e?auto=format&fit=crop&w=1200&q=80" alt="Protein Bar">
            <h1 class="slider-title">Protien Bar</h1>
        </div>
        <button class="slider-btn next">&gt;</button>
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
            <div class="product-item">
                <img src="images/wafer.jpg" alt="Chips">
                <span>Chips</span>
            </div>
            <div class="product-item">
                <img src="images/namkeen.png" alt="Namkeen">
                <span>Namkeen</span>
            </div>
            <div class="product-item">
                <img src="images/biskut.jpg" alt="Biscuit">
                <span>Biscuit</span>
            </div>
            <div class="product-item">
                <img src="https://images.unsplash.com/photo-1606312619070-d48b4c652a52?auto=format&fit=crop&w=300&q=80" alt="Chocolates">
                <span>Chocolates</span>
            </div>
            <div class="product-item">
                <img src="images/noodles.jpg" alt="Chips">
                <span>Noodles</span>
            </div>
            <div class="product-item">
                <img src="images/cakes.jpeg" alt="Namkeen">
                <span>Cakes</span>
            </div>
            <div class="product-item">
                <img src="images/breakfast.png" alt="Biscuit">
                <span>BreakFast</span>
            </div>
            <div class="product-item">
                <img src="images/juice.jpg" alt="Chocolates">
                <span>Juice</span>
            </div>
            <div class="product-item">
                <img src="images/burger.jpg" alt="Chips">
                <span>Burger</span>
            </div>
            <div class="product-item">
                <img src="images/pizza.jpg" alt="Namkeen">
                <span>Pizza</span>
            </div>
            <div class="product-item">
                <img src="images/drinks.jpg" alt="Biscuit">
                <span>Drinkes</span>
            </div>
            <div class="product-item">
                <img src="images/pasta.jpg" alt="Chocolates">
                <span>Pasta</span>
            </div>
            <!-- Repeat similar structure for other rows -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <!-- <div class="footer-content">
            <div class="footer-logo">
                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=100&q=80" alt="AaharYog Logo">
                <p>STAY FIT, STAY HAPPY</p>
            </div>
            <div class="footer-contact">
                <p>ANAND</p>
                <p>STUDENT OF</p>
                <p>COMPUTER SCIENCE</p>
                <p>CONTACT: +91 0123456789</p>
            </div>
            <div class="footer-social">
                <a href="#"><i data-lucide="facebook"></i></a>
                <a href="#"><i data-lucide="instagram"></i></a>
                <a href="#"><i data-lucide="twitter"></i></a>
            </div>
        </div> -->
        <nav class="bottom-nav">
            <a href="#"><i data-lucide="home"></i></a>
            <a href="#"><i data-lucide="search"></i></a>
            <a href="scan.php"><i data-lucide="scan-line"></i></a>
            <a href="#"><i data-lucide="list"></i></a>
            <a href="#"><i data-lucide="user"></i></a>
        </nav>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>