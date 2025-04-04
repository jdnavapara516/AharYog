<?php
include '../../db.php';
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.html');
}
$username = $_SESSION['username'];

$category = $_SESSION['username'];
$query = "SELECT * FROM YogaPoses";
$result = mysqli_query($conn, $query);
$yogaposes = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css" />

  <title>Workout Listing</title>
  <style>
    /* Base Styles */
    :root {
      --background: 0 0% 98%;
      --foreground: 222.2 84% 4.9%;
      --card: 0 0% 100%;
      --card-foreground: 222.2 84% 4.9%;
      --primary: 222.2 47.4% 11.2%;
      --ring: 222.2 84% 4.9%;
      --radius: 0.5rem;
    }

    body {
      background-color: #f5f3f0;
      color: #262626;
      font-family: sans-serif;
      -webkit-font-smoothing: antialiased;
      margin: 0;
      padding: 0;
    }

    /* Navigation */
    .navigation {
      background-color: #111423;
      color: #e3d1aa;
      padding: 1rem 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .nav-logo {
      color: #e3d1aa;
      display: flex;
      align-items: center;
    }

    .nav-logo img {
      height: 3rem;
    }

    .nav-logo span {
      color: #e3d1aa;
      margin-left: 0.5rem;
      font-size: 1.5rem;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .nav-link {
      color: #e3d1aa;
      text-decoration: none;
      transition: color 0.3s;
    }

    .nav-link:hover {
      color: #E2B13C;
    }

    .profile-btn {
      background-color: #22C55E;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 9999px;
      border: none;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
    }

    .profile-btn img {
      width: 1.5rem;
      height: 1.5rem;
      border-radius: 50%;
    }

    /* Workout Card Styles */
    .workout-card {
      position: relative;
      background-color: white;
      border-radius: 0.5rem;
      padding: 1.5rem;
      transition: all 0.3s ease;
    }

    .workout-card:hover {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .workout-thumbnail {
      position: relative;
      border-radius: 0.5rem;
      overflow: hidden;
      margin-bottom: 1rem;
      aspect-ratio: 16 / 9;
    }

    .workout-thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .play-button {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: rgba(0, 0, 0, 0.2);
      opacity: 0;
      transition: all 0.3s ease;
    }

    .workout-thumbnail:hover .play-button {
      opacity: 1;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .play-button svg {
      width: 3rem;
      height: 3rem;
      color: white;
      opacity: 0.8;
      transition: transform 0.3s ease;
    }

    .workout-thumbnail:hover .play-button svg {
      transform: scale(1.25);
    }

    .like-button {
      border: 0px;
      background-color: white;
      transition: color 0.3s ease;
    }

    .like-button:hover {
      color: #ef4444;
    }

    .info-button {
      border: 0px;
      background-color: white;
      transition: opacity 0.3s ease;
    }

    .info-button:hover {
      opacity: 0.6;
    }

    .learn-more {
      font-family: Arial, Helvetica, sans-serif;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      margin-top: 1rem;
      font-weight: 1000;
      color: #171717;
      transition: opacity 0.3s ease;
      background: none;
      border: 0;
      font-size: larger;
    }

    .learn-more:hover {
      opacity: 0.7;
    }

    /* Layout Styles */
    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 2rem;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .header h1 {
      font-size: 2.25rem;
      font-weight: bold;
    }

    .filter-button {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      background-color: #f0ebe7;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .filter-button:hover {
      background-color: #e5e0dc;
    }

    .container {
      display: flex;
      gap: 20px;
      padding: 20px;
    }

    .card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: 300px;
      text-align: center;
      padding: 20px;
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px 10px 0 0;
    }

    .card h3 {
      font-size: 1.5em;
      margin: 15px 0;
    }

    .card p {
      font-size: 0.9em;
      color: #555;
      margin: 10px 0;
    }

    .card .icons {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin: 10px 0;
    }

    .card .icons i {
      font-size: 1.2em;
      color: #333;
    }

    .card .learn-more {
      display: block;
      margin-top: 20px;
      font-weight: bold;
      color: #000;
      text-decoration: none;
    }

    .card .learn-more:hover {
      text-decoration: underline;
    }

    @media (max-width: 900px) {
      .container {
        flex-direction: column;
        align-items: center;
      }
    }

    .filter-menu {
      position: absolute;
      right: 0;
      margin-top: 0.5rem;
      width: 12rem;
      background-color: white;
      border-radius: 0.5rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      z-index: 10;
    }

    .filter-menu button {
      width: 100%;
      text-align: left;
      padding: 0.5rem 1rem;
      transition: background-color 0.3s ease;
    }

    .filter-menu button:hover {
      background-color: #f5f5f5;
    }

    .grid {
      display: grid;
      gap: 1.5rem;
      grid-template-columns: repeat(1, 1fr);
    }

    @media (min-width: 768px) {
      .grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (min-width: 1024px) {
      .grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }
  </style>
</head>

<body>
  <!-- Navigation -->
  <nav class="navigation">
    <div class="nav-logo">
      <img src="../Image/Logo.jpg" alt="AaharYog Logo" />
      <span style="font-family: Cormorant Garanond;">AaharYog</span>
    </div>
    <div class="nav-links">
      <a href="#" class="nav-link">HOME</a>
      <a href="#" class="nav-link">SERVICES</a>
      <a href="#" class="nav-link">ABOUT US</a>
      <!-- <button class="profile-btn">
        Lucifer <img src="/profile-placeholder.png" alt="Profile" />
      </button> -->
    </div>
  </nav>
  <h1 style="margin-left: 35px;">Yoga Poses</h1>
  <div class="grid">
    <?php foreach ($yogaposes as $yoga): ?>
      <div class="card" style="margin-left: 35px;">
        <img src="<?php echo htmlspecialchars($yoga['image_url']); ?>" />

        <h2><?php echo htmlspecialchars($yoga['pose_name']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($yoga['description'])); ?></p>
        <a class="learn-more" href="watchvideo.php?pose_id=<?php echo htmlspecialchars($yoga['pose_id']); ?>">
          LEARN MORE
        </a>
      </div>
    <?php endforeach; ?>
  </div>


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