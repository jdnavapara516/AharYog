// Toggle mobile menu
document.addEventListener('DOMContentLoaded', () => {
    // Search functionality
    const searchInput = document.querySelector('.search-bar input');
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const productCards = document.querySelectorAll('.product-card');
        
        productCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Bottom navigation active state
    const navButtons = document.querySelectorAll('.nav-btn');
    navButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            navButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // Smooth scroll for category clicks
    const categoryImages = document.querySelectorAll('.category-img');
    categoryImages.forEach(img => {
        img.addEventListener('click', () => {
            const productGrid = document.querySelector('.product-grid');
            productGrid.scrollIntoView({ behavior: 'smooth' });
        });
    });
});