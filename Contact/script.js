// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Login button functionality
    const loginButton = document.querySelector('.login-button');
    if (loginButton) {
        loginButton.addEventListener('click', function() {
            alert('Login functionality will be implemented soon!');
        });
    }

    // Contact form submission
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Get form values
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            
            // Basic form validation
            if (!firstName || !lastName || !email || !message) {
                alert('Please fill in all fields');
                return;
            }
            
            // Simple email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return;
            }
            
            // Success message (in a real application, this would send data to a server)
            alert('Thank you for your message! We will get back to you soon.');
            contactForm.reset();
        });
    }

    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Prevent default only if the href is # (placeholder)
            if (this.getAttribute('href') === '#') {
                event.preventDefault();
                alert('This section is coming soon!');
            }
        });
    });
    
    // Social media icons functionality
    const socialIcons = document.querySelectorAll('.social-icon');
    socialIcons.forEach(icon => {
        icon.addEventListener('click', function(event) {
            event.preventDefault();
            
            // Determine which social media was clicked
            if (this.classList.contains('facebook-icon')) {
                alert('Facebook profile coming soon!');
            } else if (this.classList.contains('instagram-icon')) {
                alert('Instagram profile coming soon!');
            } else if (this.classList.contains('twitter-icon')) {
                alert('Twitter profile coming soon!');
            }
        });
    });
});