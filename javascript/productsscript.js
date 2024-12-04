// Get all the elements
const priceRange = document.getElementById('priceRange');
const priceRangeValue = document.getElementById('priceRangeValue');
const concentrationSelect = document.getElementById('concentrationSelect');
const sizeSelect = document.getElementById('sizeSelect');
const sortSelect = document.getElementById('sortSelect');
const productList = document.getElementById('productList');

// Update price range display
priceRange.addEventListener('input', () => {
    const minPrice = priceRange.min;
    const maxPrice = priceRange.max;
    const value = priceRange.value;
    priceRangeValue.textContent = `₱${value} - ₱${maxPrice}`;
    filterProducts();
});

// Update product list based on filter
function filterProducts() {
    const price = priceRange.value;
    const concentration = concentrationSelect.value;
    const size = sizeSelect.value;

    const perfumes = document.querySelectorAll('.perfume');
    perfumes.forEach(perfume => {
        const productPrice = parseInt(perfume.getAttribute('data-price'));
        const productConcentration = perfume.getAttribute('data-concentration');
        const productSize = perfume.getAttribute('data-size');

        let show = true;

        // Price filter
        if (productPrice > price) {
            show = false;
        }

        // Concentration filter
        if (concentration !== 'all' && concentration !== productConcentration) {
            show = false;
        }

        // Size filter
        if (size !== 'all' && size !== productSize) {
            show = false;
        }

        if (show) {
            perfume.style.display = 'block';
        } else {
            perfume.style.display = 'none';
        }
    });
}

// Sorting functionality
sortSelect.addEventListener('change', () => {
    const sortBy = sortSelect.value;
    let perfumes = Array.from(document.querySelectorAll('.perfume'));
    switch (sortBy) {
        case 'price-low-high':
            perfumes.sort((a, b) => parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute('data-price')));
            break;
        case 'price-high-low':
            perfumes.sort((a, b) => parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute('data-price')));
            break;
        case 'alphabetical':
            perfumes.sort((a, b) => a.querySelector('h3').innerText.localeCompare(b.querySelector('h3').innerText));
            break;
     
        default:
            break;
    }

    // Reattach sorted perfumes
    perfumes.forEach(perfume => {
        productList.appendChild(perfume);
    });
});

// Initialize the filters
filterProducts();
