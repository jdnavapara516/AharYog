<?php
include '../db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['gender'], $_POST['dob'], $_POST['age'], $_POST['height'], $_POST['weight'], $_POST['health_condition'])) {
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $height = mysqli_real_escape_string($conn, $_POST['height']);
        $weight = mysqli_real_escape_string($conn, $_POST['weight']);
        $health_condition = mysqli_real_escape_string($conn, $_POST['health_condition']);

        // Handle diseases
        $diseases = isset($_POST['diseases']) ? implode(", ", array_map(function ($item) use ($conn) {
            return mysqli_real_escape_string($conn, $item);
        }, $_POST['diseases'])) : '';

        // Add custom disease if provided
        if (!empty($_POST['custom_disease'])) {
            $diseases .= ($diseases ? ", " : "") . mysqli_real_escape_string($conn, $_POST['custom_disease']);
        }

        // Handle goals
        $goals = isset($_POST['goals']) ? implode(", ", array_map(function ($item) use ($conn) {
            return mysqli_real_escape_string($conn, $item);
        }, $_POST['goals'])) : '';

        // Add custom goal if provided
        if (!empty($_POST['custom_goal'])) {
            $goals .= ($goals ? ", " : "") . mysqli_real_escape_string($conn, $_POST['custom_goal']);
        }

        // Prepare and execute the SQL statement
        $sql = "UPDATE users SET gender=?, dob=?, age=?, height=?, weight=?, health_conditions=?, goals=? WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $gender, $dob, $age, $height, $weight, $health_condition, $goals, $username);

        if ($stmt->execute()) {
            echo "<script>alert('User  details updated successfully!'); window.location.href='../Ahar/AharSection.php';</script>";
        } else {
            echo "<script>alert('Failed to update user details: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all required fields.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AaharYog - Health Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body style="background-color: rgb(250, 250, 250);">
    <header class="header">
        <div class="logo">
            <img src="images/Logo.jpg" alt="AaharYog Logo">
            <span>AaharYog</span>
        </div>
        <div class="logo">
            <span> Welcome to AharYog <?php echo htmlspecialchars($username); ?></span>
        </div>
    </header>

    <main>
        <h1 class="main-title">FILL YOUR DETAILS</h1>

        <form id="healthForm" method="POST" action="">
            <div class="form-group">
                <label>GENDER:</label>
                <input type="text" name="gender" placeholder="ENTER YOUR GENDER" required>
            </div>
            <div class="form-group">
                <label>DOB:</label>
                <input type="date" name="dob" required>
            </div>
            <div class="form-group">
                <label>AGE:</label>
                <input name="age" type="number" placeholder="ENTER YOUR AGE" required>
            </div>
            <div class="form-group">
                <label>HEIGHT (cm):</label>
                <input name="height" type="number" placeholder="ENTER YOUR HEIGHT (cm)" required>
            </div>
            <div class="form-group">
                <label>WEIGHT (kg):</label>
                <input type="number" name="weight" placeholder="ENTER YOUR WEIGHT (kg)" required>
            </div>
            <div class="form-group">
                <label>Tell us about your health condition:</label>
                <input type="text" name="health_condition" placeholder="ENTER YOUR HEALTH CONDITION" required>
            </div>

            <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Submit</button>
        </form>
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