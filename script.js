function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    const menuBtn = document.querySelector('.mobile-menu-btn');
    const overlay = document.querySelector('.nav-overlay');
    
    navLinks.classList.toggle('active');
    menuBtn.classList.toggle('active');
    overlay.classList.toggle('active');
    
    document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
}