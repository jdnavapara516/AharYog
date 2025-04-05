// Sample product data
const products = [
    {
        id: 1,
        name: "Cadbury Chocobakes Choc Filled Cookies",
        image: "image/Filled_biscuit.png",  // Fixed path
        category: "filled",
        grade: "A",
        isFavorite: false
    },
    {
        id: 2,
        name: "Butter Cookies",
        image: "https://placehold.co/200x200",
        category: "decorated",
        grade: "B",
        isFavorite: false
    },
    {
        id: 3,
        name: "Digestive Biscuits",
        image: "https://placehold.co/200x200",
        category: "digestive",
        grade: "C",
        isFavorite: false
    }
];

// State management
let currentCategory = "filled";
let activeFilters = new Set();
let favorites = new Set();

// DOM Elements
const productsGrid = document.getElementById("products-grid");
const categoryButtons = document.querySelectorAll(".category");
const filterButton = document.querySelector(".filter-button");
const filterMenu = document.querySelector(".filter-menu");
const filterCheckboxes = document.querySelectorAll('.filter-section input[type="checkbox"]');
const filterCount = document.getElementById("filter-count");

// Function to create product cards
function createProductCard(product) {
    const card = document.createElement("div");
    card.className = "product-card";

    card.innerHTML = `
        <img src="${product.image}" alt="${product.name}">
        <button class="favorite ${product.isFavorite ? 'active' : ''}">
            ${product.isFavorite ? '♥' : '♡'}
        </button>
        <div class="product-info">
            <h3>${product.name}</h3>
            <div class="health-meter">
                <span class="grade grade-a ${product.grade === 'A' ? 'active' : ''}">A</span>
                <span class="grade grade-b ${product.grade === 'B' ? 'active' : ''}">B</span>
                <span class="grade grade-c ${product.grade === 'C' ? 'active' : ''}">C</span>
                <span class="grade grade-d ${product.grade === 'D' ? 'active' : ''}">D</span>
            </div>
            <button class="more-button">More</button>
        </div>
    `;

    // Favorite Button Event Listener
    const favoriteBtn = card.querySelector(".favorite");
    favoriteBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        product.isFavorite = !product.isFavorite;
        if (product.isFavorite) {
            favorites.add(product.id);
            favoriteBtn.textContent = "♥";
        } else {
            favorites.delete(product.id);
            favoriteBtn.textContent = "♡";
        }
        favoriteBtn.classList.toggle("active");
    });

    return card;
}

// Function to filter and display products
function filterProducts() {
    const filteredProducts = products.filter(product => {
        const categoryMatch = product.category === currentCategory;
        const gradeMatch = activeFilters.size === 0 || activeFilters.has(product.grade);
        return categoryMatch && gradeMatch;
    });

    // Clear and update the grid
    productsGrid.innerHTML = "";
    filteredProducts.forEach(product => {
        productsGrid.appendChild(createProductCard(product));
    });
}

// Category Selection Event Listener
categoryButtons.forEach(category => {
    category.addEventListener("click", () => {
        categoryButtons.forEach(c => c.classList.remove("active"));
        category.classList.add("active");
        currentCategory = category.dataset.category;
        filterProducts();
    });
});

// Toggle Filter Menu
filterButton.addEventListener("click", (e) => {
    e.stopPropagation();
    filterMenu.classList.toggle("active");
});

// Checkbox Filter Event Listeners
filterCheckboxes.forEach(checkbox => {
    checkbox.addEventListener("change", () => {
        if (checkbox.checked) {
            activeFilters.add(checkbox.value);
        } else {
            activeFilters.delete(checkbox.value);
        }
        filterCount.textContent = activeFilters.size;
        filterProducts();
    });
});

// Close Filter Menu When Clicking Outside
document.addEventListener("click", (e) => {
    if (!filterButton.contains(e.target) && !filterMenu.contains(e.target)) {
        filterMenu.classList.remove("active");
    }
});

// Initialize Page
filterProducts();
