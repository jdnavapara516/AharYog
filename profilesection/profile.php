<?php
    include '../db.php';
    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: login.html');
        exit();
    }

    $username = $_SESSION['username'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['gender'], $_POST['dob'], $_POST['height'], $_POST['weight'])){
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $dob = mysqli_real_escape_string($conn, $_POST['dob']);
            $height = mysqli_real_escape_string($conn, $_POST['height']);
            $weight = mysqli_real_escape_string($conn, $_POST['weight']);

            $sql = "UPDATE users SET gender = '$gender', dob = '$dob', height = '$height', weight = '$weight' WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('User registered successfully!'); window.location.href='Ahar/AharSection.php';</script>";
                exit();
            } else {
                echo "<script>alert('Failed to register user!');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AaharYog - Health Form</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
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

    <div class="form-container">
      <form id="personalInfoForm" class="form-page active" method="POST" action="">
        <div class="form-group">
          <label>GENDER:</label>
          <input type="text" name="gender" placeholder="ENTER YOUR GENDER" required>
        </div>
        <div class="form-group">
          <label>DOB:</label>
          <input type="date" name="dob" required>
        </div>
        <div class="form-group">
          <label>HEIGHT:</label>
          <input name="height" type="number" placeholder="ENTER YOUR HEIGHT (cm)" required>
        </div>
        <div class="form-group">
          <label>WEIGHT:</label>
          <input type="number" name="weight" placeholder="ENTER YOUR WEIGHT (kg)" required>
        </div>
        <button type="submit">Next</button>
      </form>

      <!-- Disease Selection Form -->
      <form id="diseaseForm" class="form-page">
        <h2>"PLEASE SELECT THE DISEASES YOU HAVE (IF ANY):"</h2>
        <div class="button-grid">
          <button type="button" class="selection-btn">BLOOD PRESSURE</button>
          <button type="button" class="selection-btn">DIABETES</button>
          <button type="button" class="selection-btn">MENTAL HEALTH ISSUE</button>
          <button type="button" class="selection-btn">DIGESTIVE DISORDERS</button>
          <button type="button" class="selection-btn">ACIDITY</button>
          <button type="button" class="selection-btn">ASTHMA</button>
          <button type="button" class="selection-btn">OBESITY</button>
          <button type="button" class="selection-btn custom-input">OTHER</button>
          <button type="button" class="selection-btn">NONE</button>
        </div>
        <div id="customDiseaseInput" class="custom-input-field">
          <input type="text" placeholder="Enter your condition">
          <button type="button" class="add-btn">Add</button>
        </div>
      </form>

      <!-- Goals Selection Form -->
      <form id="goalsForm" class="form-page">
        <h2>SELECT YOUR GOALS(IF YOU WANT):</h2>
        <div class="button-grid">
          <button type="button" class="selection-btn">WEIGHT LOSS</button>
          <button type="button" class="selection-btn">SUGAR CONTROL</button>
          <button type="button" class="selection-btn">MUSCLE GAIN</button>
          <button type="button" class="selection-btn">BETTER SLEEP</button>
          <button type="button" class="selection-btn">STRESS MANAGEMENT</button>
          <button type="button" class="selection-btn">BETTER DIGESTION</button>
          <button type="button" class="selection-btn">INCREASED ENERGY</button>
          <button type="button" class="selection-btn custom-input">OTHER</button>
          <button type="button" class="selection-btn">NONE</button>
        </div>
        <div id="customGoalInput" class="custom-input-field">
          <input type="text" placeholder="Enter your goal">
          <button type="button" class="add-btn">Add</button>
        </div>
      </form>

      <div class="navigation-buttons">
        <button id="prevBtn" class="nav-btn" style="display: none;">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 18-6-6 6-6"/>
          </svg>
          PREVIOUS
        </button>
        <button id="nextBtn" class="nav-btn">
          NEXT
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6"/>
          </svg>
        </button>
      </div>
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
