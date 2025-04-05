// Wait for the DOM to be fully loaded before executing JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Get references to elements
    const loginButton = document.getElementById('loginButton');
    const navLinks = document.querySelectorAll('.nav-link');
    
    // Add event listener to login button
    loginButton.addEventListener('click', function() {
      alert('Login functionality would be implemented here!');
    });
    
    // Add event listeners to navigation links
    navLinks.forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        
        // Remove active class from all links
        navLinks.forEach(navLink => {
          navLink.classList.remove('active');
        });
        
        // Add active class to clicked link
        this.classList.add('active');
        
        // Get the href attribute
        const href = this.getAttribute('href');
        
        // Simple navigation logic (to be expanded in a real application)
        if (href === '#') {
          console.log('Would navigate to the corresponding page');
        }
      });
    });
    
    // Simple scroll effect for demonstration
    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header');
      if (window.scrollY > 50) {
        header.style.padding = '0.5rem 2rem';
        header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
      } else {
        header.style.padding = '1rem 2rem';
        header.style.boxShadow = 'none';
      }
    });
  });