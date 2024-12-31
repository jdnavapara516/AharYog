<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.html');
    }
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
  
    

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
                <img src="/images/ahar.jpg" alt="AaharYog" class="logo-img">
                <span>AaharYog</span>
            </div>
            <div class="user-profile">
                <span>Lucifer</span>
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <button class="scan-btn">
                <i class="fa-solid fa-qrcode"></i>
            </button>
        </div>
    </nav>

    <div class="content">
        <!-- <aside class="sidebar">
            <div class="category">
                <img src="https://images.unsplash.com/photo-1578849278619-e73505e9610f?w=200&h=200&fit=crop" alt="Popcorn" class="category-img">
            </div>
        </aside> -->

        <main class="main-content">
            <div class="banner">
                <h1>Protin Bar</h1>
                <img src="protein_bar .jpg" alt="Protein Bar" class="banner-img">
            </div>

            <div class="product-grid">
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Wafers & Namkeen</h3>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=200&h=200&fit=crop" alt="Biscuits">
                    <h3>Biscuits</h3>
                </div><div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Wafers & Namkeen</h3>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=200&h=200&fit=crop" alt="Biscuits">
                    <h3>Biscuits</h3>
                </div><div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Wafers & Namkeen</h3>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=200&h=200&fit=crop" alt="Biscuits">
                    <h3>Biscuits</h3>
                </div><div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Wafers & Namkeen</h3>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=200&h=200&fit=crop" alt="Biscuits">
                    <h3>Biscuits</h3>
                </div><div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Wafers & Namkeen</h3>
                </div>
            </div>
        </main>
    </div>

    <nav class="bottom-nav">
        <button class="nav-btn">
            <a href="home.php"><i class="fa-solid fa-house"></i></a>
        </button>
        <button class="nav-btn">
            <i class="fa-brands fa-searchengin fa-solid"></i>        </button>
        <button class="nav-btn">
            <i class="fa-solid fa-qrcode"></i>        </button>
        <button class="nav-btn">
            <i class="fa-solid fa-file"></i>        </button>
        <button class="nav-btn">
            <i class="fa-solid fa-user"></i>        </button>
    </nav>

    <script src="js/aahar.js"></script>
    <script src="js/style.js"></script>
    
</body>
</html>