<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.html');
}
$username = $_SESSION['username'];
// $email = $_SESSION['email'];

if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMR Calculator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link> -->

    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> -->
</head>

<body class="bg-gray-100 font-roboto">
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <a href="../Ahar/AharSection.php"> <img src="images/Logo.jpg" alt="AaharYog Logo"></a>
            <span>AaharYog</span>
        </div>

        <div class="logo">

            <span> Welcome to BMR Section <?php echo $username; ?></span>
        </div>


    </header>

    <main class="container mx-auto mt-10 p-4 bg-white shadow-md rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-center">Calculate Your Basal Metabolic Rate (BMR)</h2>
        <form id="bmr-form" class="space-y-4">
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="flex-1">
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" id="age" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter your age">
                </div>
                <div class="flex-1">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="flex-1">
                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                    <input type="number" id="weight" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter your weight in kg">
                </div>
                <div class="flex-1">
                    <label for="height" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                    <input type="number" id="height" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter your height in cm">
                </div>
            </div>
            <div class="text-center">
                <button style="background-color: green;" type="button" onclick="calculateBMR()" class="mt-4 px-6 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700">Calculate BMR</button>
            </div>
        </form>
        <div id="bmr-result" class="mt-6 text-center text-xl font-bold text-gray-700"></div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
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
        </div>
        <!-- <nav class="bottom-nav">
            <a href="#"><i data-lucide="home"></i></a>
            <a href="#"><i data-lucide="search"></i></a>
            <a href="scan.php"><i data-lucide="scan-line"></i></a>
            <a href="#"><i data-lucide="list"></i></a>
            <a href="../profilesection/user.php"><i data-lucide="user"></i></a>
        </nav> -->
    </footer>


    <script>
        function calculateBMR() {
            const age = document.getElementById('age').value;
            const gender = document.getElementById('gender').value;
            const weight = document.getElementById('weight').value;
            const height = document.getElementById('height').value;

            let bmr;

            if (gender === 'male') {
                bmr = 88.362 + (13.397 * weight) + (4.799 * height) - (5.677 * age);
            } else {
                bmr = 447.593 + (9.247 * weight) + (3.098 * height) - (4.330 * age);
            }

            document.getElementById('bmr-result').innerText = `Your BMR is ${bmr.toFixed(2)} calories/day`;
        }
    </script>
</body>

</html>