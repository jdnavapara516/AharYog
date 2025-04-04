<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}
$username = $_SESSION['username'];

// Database connection details using PDO
$host = "localhost";
$dbname = "aharyog";
$db_username = "root";
$db_password = "050106";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error mode
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

// Get the pose_id from the URL
$pose_id = isset($_GET['pose_id']) ? $_GET['pose_id'] : null;

if ($pose_id) {
    // Prepare SQL query to get the pose details from the database
    $stmt = $pdo->prepare('SELECT * FROM yogaposes WHERE pose_id = :pose_id');
    $stmt->bindParam(':pose_id', $pose_id, PDO::PARAM_INT);
    $stmt->execute();
    $pose = $stmt->fetch(PDO::FETCH_ASSOC);

    // If pose doesn't exist
    if (!$pose) {
        echo 'Pose not found.';
        exit();
    }
} else {
    echo 'No pose ID specified.';
    exit();
}
?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Yoga Video Streaming</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
</head>

<style>
    /* General container and layout */
    .container {
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    /* Main content area styling */
    main {
        padding-top: 2rem;
        padding-bottom: 4rem;
    }

    /* Styling the card container */
    .bg-white {
        background-color: #ffffff;
    }

    .shadow-md {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rounded-lg {
        border-radius: 0.5rem;
    }

    .overflow-hidden {
        overflow: hidden;
    }

    /* Video iframe styling */
    .relative {
        position: relative;
    }

    .pb-56 {
        padding-bottom: 56.25%;
        /* Aspect ratio 16:9 */
    }

    iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    /* Pose Details */
    .p-6 {
        padding: 1.5rem;
    }

    .text-2xl {
        font-size: 1.5rem;
    }

    .font-bold {
        font-weight: 700;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .text-gray-700 {
        color: #4a4a4a;
    }

    /* Title of the Pose */
    h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #333333;
        margin-bottom: 1rem;
    }

    /* Instructor Info */
    .instructor-info {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .instructor-info img {
        border-radius: 50%;
        margin-right: 1rem;
    }

    .instructor-info h3 {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333333;
    }

    .instructor-info p {
        font-size: 0.875rem;
        color: #666666;
    }

    /* Section for Benefits and Contraindications */
    .mt-4 {
        margin-top: 1rem;
    }

    .text-xl {
        font-size: 1.25rem;
    }

    .font-semibold {
        font-weight: 600;
    }

    .mb-2 {
        margin-bottom: 0.5rem;
    }

    .text-gray-700 {
        color: #4a4a4a;
        font-size: 1rem;
    }

    /* Duration Section */
    h3 {
        color: #333333;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {

        /* Adjustments for mobile views */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        iframe {
            max-width: 100%;
            height: auto;
        }

        h2 {
            font-size: 1.25rem;
        }

        .text-xl {
            font-size: 1.125rem;
        }

        .font-semibold {
            font-weight: 500;
        }
    }
</style>

<body class="bg-gray-100 font-roboto">

    <!-- Navigation -->
    <nav class="navigation">
        <div class="nav-logo">
            <img src="../Image/Logo.jpg" alt="AaharYog Logo" />
            <span style="font-family: Cormorant Garanond;">AaharYog</span>
        </div>
        <div class="nav-links" style="font-size: 16px;">
            <p style="font-size:25px ; font-family: Cormorant Garanond;"> Stay fit <?php echo $username; ?> </p>
        </div>
    </nav>

    <main class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Display Pose Video -->
            <!-- <iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" class="absolute top-0 left-0 w-full h-full" frameborder="0" src="<?php echo htmlspecialchars($pose['video_url']); ?>" title="Yoga Pose Video"></iframe> -->

            <div class="v" style="display: flex; justify-content: center; align-items: center; height: 63vh;">
                <video src="../video/<?php echo $pose['pose_name']; ?>.mp4" controls style="width: 80%; max-width: 800px; height: auto; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    Your browser does not support the video tag.
                </video>
            </div>





            <!-- Pose Details -->
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">
                    <?php echo htmlspecialchars($pose['pose_name']); ?>
                </h2>
                <p class="text-gray-700 mb-4">
                    <?php echo htmlspecialchars($pose['description']); ?>
                </p>

                <!-- Instructor Info -->


                <!-- Pose Benefits -->
                <div class="mt-4">
                    <h3 class="text-xl font-semibold mb-2">Benefits</h3>
                    <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($pose['benefits']); ?></p>
                </div>

                <!-- Contraindications -->
                <div class="mt-4">
                    <h3 class="text-xl font-semibold mb-2">Contraindications</h3>
                    <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($pose['contraindications']); ?></p>
                </div>

                <!-- Duration -->
                <div class="mt-4">
                    <h3 class="text-xl font-semibold mb-2">Duration</h3>
                    <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($pose['duration']); ?> minutes</p>
                </div>
            </div>
        </div>
    </main>


    <!-- Footer -->
    <footer class="footer" style="margin-top: 20px;">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="../Image/Logo.jpg" alt="AaharYog Logo" />
                <span>AaharYog</span>
                <p>"WHAT YOU EAT, SHAPES YOU"</p>
            </div>
            <div class="footer-info">
                <p class="name">ANAND</p>
                <p>STUDENT OF</p>
                <p>CHAROTAR UNIVERSITY OF</p>
                <p>SCIENCE AND TECHNOLOGY</p>
                <p>(CHARUSAT)</p>
            </div>
            <div class="footer-contact">
                <p>+91 0123456789</p>
                <p>AAHARYOG2025@GMAIL.COM</p>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <svg viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="#" class="social-link">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                        </svg>
                    </a>
                    <a href="#" class="social-link">
                        <svg viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>



</body>

</html>
</body>

</html>