<?php

include 'db.php';

session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row){
        $_SESSION['username'] = $row['username'];
     
      
        header('Location: HomePage/Homepage.php');
    }else{
        echo "Invalid username or password";
    }
   
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AaharYog</title>
    <link rel="stylesheet" href="css/aahar.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <div class="heart-logo">
                    <div class="logo-placeholder">
                        <img src="images/aharlogo.jpg" alt="logo">
                    </div>
                </div>
                <span>AaharYog</span>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">HOME</a></li>
                <li><a href="#">SERVICES</a></li>
                <li><a href="#">ABOUT US</a></li>
            </ul>
            <button class="mobile-menu-btn" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </button>
        </nav>
    </header>

    <div class="auth-container">
        <div class="auth-box">
            <div class="auth-image">
                <div class="meditation-image">
                    <img src="images/yog.jpg" alt="meditation">
                </div>
            </div>
            <div class="auth-form">
                <h2>Welcome Back</h2>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Enter here" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="********" required>
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>
                    <button type="submit" class="auth-button">Login</button>
                </form>
                <p class="auth-switch">
                    Doesn't have account? <a href="register.php">Register</a>
                </p>
            </div>
        </div>
    </div>
    <script src="js/aahar.js"></script>
    <script src="js/style.js"></script>
    
</body>
</html>