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
            <form action="aahar.php">
        <!-- <div class="search-bar">
          
            <input type="text" placeholder="Search" name="search">
            <button class="scan-btn" type="submit">
                <i class="fa-solid fa-qrcode"></i>
            </button>
            
        </div> -->
        </form>
            <div class="user-profile">
                <span><?php echo $username; ?></span>
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
      
    </nav>

    <div class="content">
       

        <main class="main-content">
            <div class="banner">
                <h1>Protin Bar</h1>
                <img src="images/protein_bar .jpg" alt="Protein Bar" class="banner-img">
            </div>

            <div class="product-grid">
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Cacks & Bakes</h3>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=200&h=200&fit=crop" alt="Biscuits">
                    <h3>Biscuits</h3>
                </div><div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Wafers</h3>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=200&h=200&fit=crop" alt="Biscuits">
                    <h3>Breakfast & Spreads</h3>
                </div><div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Chocolates & Desserts</h3>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=200&h=200&fit=crop" alt="Biscuits">
                    <h3>Biscuits</h3>
                </div><div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Cold Drinks & Juices</h3>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=200&h=200&fit=crop" alt="Biscuits">
                    <h3>Dry Fruits Oil & Masalas</h3>
                </div><div class="product-card">
                    <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=200&h=200&fit=crop" alt="Wafers & Namkeen">
                    <h3>Tea Coffee & more</h3>
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