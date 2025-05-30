

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AaharYog - Wellness Platform</title>
    <link rel="stylesheet" href="css/aahar.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <div class="heart-logo">
                    <div class="logo-placeholder">
                        <img src="images/aharlogo.jpg" alt="Logo">
                    </div>
                </div>
                <span>AaharYog</span>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">HOME</a></li>
                <li><a href="#">SERVICES</a></li>
                <li><a href="#">ABOUT US</a></li>
                <li><a href="login.php" class="nav-button">Login</a></li>
            </ul>
            <button class="mobile-menu-btn" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </button>
        </nav>
        <div class="nav-overlay" onclick="toggleMenu()"></div>
    </header>

    <main class="hero">
        <div class="hero-content">
            <div class="brand">
                <img src="images/aharlogo.jpg" alt="AaharYog Logo" class="main-logo">
                <h1>AaharYog</h1>
            </div>
            <p>COMFORT FOOD MADE WITH PLANT-BASED<br>INGREDIENTS AND LOTS OF LOVE</p>
            
            <div class="cta-buttons">
                <a href="aahar.php" class="cta-card">
                    <img src="images/ahar.jpg" alt="Aahar" class="card-image">
                    <span>Aahar</span>   
                </a>
                <a href="yog.html" class="cta-card">
                    <img src="images/yog.jpg" alt="Yog" class="card-image">
                    <span>Yog</span>
                </a>
            </div>
        </div>
    </main>

    <div class="social-links">
        <a href="#" class="social-icon facebook"></a>
        <a href="#" class="social-icon instagram"></a>
        <a href="#" class="social-icon twitter"></a>
    </div>

    <script src="js/aahar.js"></script>
    <script src="js/style.js"></script>
    
</body>
</html>