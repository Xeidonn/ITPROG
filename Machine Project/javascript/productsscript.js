// Get all the elements
const priceRange = document.getElementById('priceRange');
const priceRangeValue = document.getElementById('priceRangeValue');
const concentrationSelect = document.getElementById('concentrationSelect');
const sizeSelect = document.getElementById('sizeSelect');
const sortSelect = document.getElementById('sortSelect');
const productList = document.getElementById('productList');

// Update price range display
priceRange.addEventListener('input', () => {
    const maxPrice = priceRange.max;
    const value = priceRange.value;
    priceRangeValue.textContent = `₱${value} - ₱${maxPrice}`;
    filterProducts(); // Trigger filter update
});

// Update product list based on filters
function filterProducts() {
    const price = parseInt(priceRange.value);
    const concentration = concentrationSelect.value;
    const size = sizeSelect.value;

    const perfumes = document.querySelectorAll('.perfume');
    perfumes.forEach(perfume => {
        // Fetch product attributes with fallback defaults
        const productPrice = parseInt(perfume.getAttribute('data-price') || 0);
        const productConcentration = perfume.getAttribute('data-concentration') || '';
        const productSize = perfume.getAttribute('data-size') || '';

        // Determine visibility
        const show = 
            productPrice <= price && 
            (concentration === 'all' || concentration === productConcentration) &&
            (size === 'all' || size === productSize);

        // Toggle product visibility
        perfume.style.display = show ? 'block' : 'none';

        // Debugging output
        console.log({
            product: perfume.querySelector('h3')?.innerText || 'Unknown Product',
            price: productPrice,
            concentration: productConcentration,
            size: productSize,
            visible: show,
        });
    });
}

// Sorting functionality
sortSelect.addEventListener('change', () => {
    const sortBy = sortSelect.value;
    const perfumes = Array.from(document.querySelectorAll('.perfume'));

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
        case 'reverse-alphabetical':
            perfumes.sort((a, b) => b.querySelector('h3').innerText.localeCompare(a.querySelector('h3').innerText));
            break;
        default:
            console.warn('Unknown sort option:', sortBy);
            return;
    }

    // Reattach sorted elements to the DOM
    perfumes.forEach(perfume => {
        productList.appendChild(perfume);
    });
});

// Initialize the filters
filterProducts();
