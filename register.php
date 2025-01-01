<?php
include 'db.php';
session_start();

if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
    $result = mysqli_query($conn, $query);
    if($result){
        // echo "User registered successfully";
        header("Location: login.php");
    }else{
        // echo "Failed to register user";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AaharYog</title>
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
            </ul>
            <button class="mobile-menu-btn" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </button>
        </nav>
    </header>

    <div class="auth-container-signup">
        <div class="auth-box">
            <div class="auth-form">
                <h2>Register here..</h2>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter here" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Enter here" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="********" required>
                    </div>
                    <button type="submit" class="auth-button">Register</button>
                </form>
                <p class="auth-switch">
                    Already have an account? <a href="login.php">Login</a>
                </p>
            </div>
            <div class="auth-image">
                <div class="meditation-image">
                    <img src="images/yog.jpg" alt="Meditation Image">
                </div>
            </div>
        </div>
    </div>

    <script src="js/aahar.js"></script>
    <script src="js/style.js"></script>
    
</body>
</html>