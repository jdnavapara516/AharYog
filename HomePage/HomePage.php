<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.html');
}
$username = $_SESSION['username'];
// $email = $_SESSION['email'];

?>








<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/svg+xml" href="/vite.svg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AaharYog - What You Eat, Shapes You</title>
  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <div id="app">
    <!-- Header/Navigation -->
    <!-- <header>
      <div class="logo-container">
        <img src="images/Logo.jpg" alt="AaharYog Logo" class="logo">
        <h1 class="logo-text">AaharYog</h1>
      </div>
      <nav>
        <ul>
          <li><a href="../Contact/ContactUs.php" style="font-weight:bolder;"> CONTACT US</a></li>
          <li><a href="">SERVICES</a></li>
          <li><a href="../About/AboutUs.php">ABOUT US</a></li>
        </ul>
      </nav> -->
    <nav class="navigation">
      <div class="nav-logo">
        <img src="Images/Logo.jpg" alt="AaharYog Logo" />
        <span>AaharYog</span>
      </div>
      <div class="nav-links">
        <a href="../Contact/ContactUs.php" class="nav-link">CONTACT US</a>
        <a href="" class="nav-link">SERVICES</a>
        <a href="../About/AboutUs.php" class="nav-link">ABOUT US</a>
        <!-- <button class="profile-btn">
           <img src="/Yog/profile-placeholder.png" alt="Profile" /> 
        </button> -->
      </div>
    </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
        <div class="hero-logo">
          <img src="Images/Logo without background.png" alt="AaharYog Logo" class="large-logo">
          <h2 class="hero-title">AaharYog</h2>
        </div>
        <p class="hero-tagline">"WHAT YOU EAT, SHAPES YOU."</p>
      </div>
    </section>

    <!-- Features Section -->
    <section class="features">
      <a href="../Ahar/AharSection.php">
        <div class="feature-card-1">
          <div class="feature-icon">
            <img src="Images/aahar.png" alt="Aahar Icon" class="feature-img">
          </div>

          <h3 class="feature-title">Aahar</h3>

        </div>
      </a>
      <a href="../Yog/Page 1/yogsection.php">
        <div class="feature-card">
          <div class="feature-icon">
            <img src="Images/Yoga.png" alt="Yog Icon" class="feature-img">
          </div>
          <h3 class="feature-title">Yog</h3>
        </div>
      </a>
    </section>

    <!-- Footer -->
    <footer>
      <div class="footer-content">
        <div class="footer-logo">
          <img src="Images/Logo.jpg" alt="AaharYog Logo" class="logo">
          <h1 class="logo-text">AaharYog</h1>
          <p class="footer-tagline">"WHAT YOU EAT, SHAPES YOU."</p>
        </div>

        <div class="footer-info">
          <h4>ANAND</h4>
          <p>STUDENT OF<br>
            CHAROTAR UNIVERSITY OF<br>
            SCIENCE AND TECHNOLOGY<br>
            (CHARUSAT)</p>
        </div>

        <div class="footer-contact">
          <p>+91 0123456789</p>
          <p>AAHARYOG2025@GMAIL.COM</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
      </div>
      <div class="copyright">
        <p>©</p>
      </div>
    </footer>
  </div>
  <script type="module" src="/main.js"></script>
</body>

</html>