<?php
include '../db.php'; // Include your database connection file
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

$username = $_SESSION['username'];

// Fetch user details from the database
$sql = "SELECT gender, dob, age, height, weight, health_conditions, goals FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('User  not found.'); window.location.href='login.html';</script>";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    .main-title {
        text-align: center;
        margin: 20px 0;
    }

    .profile-container {
        background: white;
        padding: 20px;
        margin: 20px auto;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }

    .profile-container h2 {
        margin-top: 0;
    }

    .edit-button {
        display: inline-block;
        /* margin-left: 34vh; */
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .edit-button:hover {
        background-color: #45a049;
    }
</style>

<body style="background-color:rgb(237, 237, 237); ">
    <header class=" header">
    <div class="logo">
        <img src="images/Logo.jpg" alt="AaharYog Logo">
        <span>AaharYog</span>
    </div>
    <div class="logo">
        <span>Welcome, <?php echo htmlspecialchars($username); ?></span>
    </div>
    </header>

    <main>
        <h1 class="main-title">User Profile</h1>
        <div class="profile-container">
            <h2>Details</h2>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
            <p><strong>Height:</strong> <?php echo htmlspecialchars($user['height']); ?> cm</p>
            <p><strong>Weight:</strong> <?php echo htmlspecialchars($user['weight']); ?> kg</p>
            <p><strong>Health Conditions:</strong> <?php echo htmlspecialchars($user['health_conditions']); ?></p>
            <p><strong>Goals:</strong> <?php echo htmlspecialchars($user['goals']); ?></p>
            <a href="edit_profile.php" class="edit-button">Edit Profile</a>

        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <div class="logo">
                    <img src="images/Logo.jpg" alt="AaharYog Logo">
                    <span>AaharYog</span>
                </div>
                <p>"WHAT YOU EAT SHAPES YOU"</p>
            </div>
            <div class="footer-info">
                <p>ANAND</p>
                <p>STUDENT OF CHARUSAT</p>
            </div>
            <div class="footer-contact">
                <p>+91 0123456789</p>
                <p>AAHARYOG2023@GMAIL.COM</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>