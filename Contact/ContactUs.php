<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AaharYog - Contact Us</title>
    <link rel="stylesheet" href="styles.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="aaharyog-container">
        <!-- Header Section -->
        <header class="header">
            <div class="logo-container">
                <img src="/Home, Contact, About/Contact/Images/Logo.jpg" alt="AaharYog Logo" class="logo">
                <span class="logo-text">AaharYog</span>
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="/Home, Contact, About/Home Page/index.html" class="nav-link">HOME</a></li>
                    <li><a href="/Home, Contact, About/Contact/index.html" class="nav-link" style="font-weight: bolder; color:green">SERVICES</a></li>
                    <li><a href="/Home, Contact, About/About/index.html" class="nav-link">ABOUT US</a></li>
                </ul>
            </nav>
            <button class="login-button">LOGIN</button>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <section class="contact-section">
                <h2 class="services-title">SERVICES OR CONTACT:</h2>

                <div class="problem-container">
                    <div class="problem-image-container">
                        <img class="problem-image " src="/Home, Contact, About/Contact/Images/our-services-2.jpg">
                    </div>
                    <div class="problem-text">
                        <h1 class="problem-title">Any<br>Problem?</h1>
                        <p class="contact-us">Then Contact US...</p>

                        <div class="contact-details">
                            <p class="contact-phone">+91 0123456789</p>
                            <p class="contact-phone">+91 1234567890</p>
                            <p class="contact-email">aaharyog2025@gmail.com</p>
                            <p class="contact-email">aaharyog2025@outlook.com</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form-container">
                    <h3 class="contact-form-title">Contact:</h3>

                    <form id="contactForm" class="contact-form">
                        <div class="form-row">
                            <input type="text" id="firstName" placeholder="FIRST NAME" class="form-input">
                            <input type="text" id="lastName" placeholder="LAST NAME" class="form-input">
                        </div>
                        <input type="email" id="email" placeholder="EMAIL ADDRESS" class="form-input full-width">
                        <textarea id="message" placeholder="MESSAGE" class="form-textarea"></textarea>

                        <div class="form-submit">
                            <button type="submit" class="send-button">Send <span class="send-icon">➚</span></button>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="/Home, Contact, About/Contact/Images/Logo.jpg" alt="AaharYog Logo" class="footer-logo-img">
                    <div class="footer-logo-text">
                        <span class="logo-name">AaharYog</span>
                        <span class="logo-tagline">"WHAT YOU EAT, SHAPES YOU"</span>
                    </div>
                </div>

                <div class="footer-info">
                    <p class="footer-name">ANAND</p>
                    <p class="footer-student">STUDENT OF<br>CHAROTAR UNIVERSITY OF<br>SCIENCE AND
                        TECHNOLOGY<br>(CHARUSAT)</p>
                </div>

                <div class="footer-contact">
                    <p class="footer-phone">+91 0123456789</p>
                    <p class="footer-email">AAHARYOG2025@GMAIL.COM</p>
                    <div class="footer-social">
                        <a href="#" class="social-icon facebook-icon"></a>
                        <a href="#" class="social-icon instagram-icon"></a>
                        <a href="#" class="social-icon twitter-icon"></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="script.js"></script>
</body>

</html>