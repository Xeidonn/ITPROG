// Product list
const products = [
    //  NAME, CONCENTRATION, SIZE, BRAND, PRICE, IMAGE
        
        // DIOR
    { name: "Dior Sauvage EDP 100ml", concentration: "EDP", size: "100ml", brand: "Dior", price: 7500, image: "productsImages/dior-sauvage.png" },
    //add more if ever

        // VERSACE
    { name: "Versace Eros EDP 200ml", concentration: "EDP", size: "200ml", brand: "Versace", price: 8700, image: "productsImages/versace-eros.png" },
    //add more if ever

        // CHANEL
    { name: "Chanel Bleu de Chanel EDP 100ml", concentration: "EDP", size: "100ml", brand: "Chanel", price: 9000, image: "productsImages/chanel-bleu.png" },
    //add more if ever

        // CREED
    { name: "Creed Aventus 100ml", brand: "Creed", concentration: "EDP", size: "100ml", price: 28000, image: "productsImages/creed-aventus.png" },

        // PRADA
    { name: "Prada Luna Rossa Ocean EDP 100ml", concentration: "EDP", size: "100ml", brand: "Prada", price: 8500, image: "productsImages/prada-lunna-rossa-ocean.png" },
    //add more if ever

        // YVES SAINT LAURENT
    { name: "Yves Saint Laurent Y EDP 60ml", concentration: "EDP", size: "60ml", brand: "Yves Saint Laurent", price: 7000, image: "productsImages/ysl-y.png" },
    //add more if ever


    // Add more products
];

// Loads the products based on the selected brand and filters
document.addEventListener('DOMContentLoaded', () => {
    const productList = document.getElementById('productList');
    const productTitle = document.getElementById('productTitle');
    const priceRange = document.getElementById('priceRange');
    const priceRangeValue = document.getElementById('priceRangeValue');
    const concentrationSelect = document.getElementById('concentrationSelect');
    const sizeSelect = document.getElementById('sizeSelect');
    
    // Get the brand parameter from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const selectedBrand = urlParams.get('brand');
    
    // Update the title to show the selected brand
    if (selectedBrand) {
        productTitle.textContent = `Products by ${selectedBrand}`;
    } else {
        productTitle.textContent = "Our Products";
    }

    // Function to filter and display products
    function filterProducts() {
        const maxPrice = parseInt(priceRange.value);
        const selectedConcentration = concentrationSelect.value;
        const selectedSize = sizeSelect.value;

        // Filter products by selected brand, price range, concentration, and size
        const filteredProducts = products.filter(product => {
            const matchesBrand = selectedBrand ? product.brand === selectedBrand : true;
            const matchesPrice = product.price <= maxPrice;
            const matchesConcentration = selectedConcentration === "all" || product.concentration === selectedConcentration;
            const matchesSize = selectedSize === "all" || product.size === selectedSize;

            return matchesBrand && matchesPrice && matchesConcentration && matchesSize;
        });

        // Clear the product list
        productList.innerHTML = "";

        // Display the filtered products
        filteredProducts.forEach(product => {
            const productDiv = document.createElement('div');
            productDiv.classList.add('perfume');
            
            productDiv.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>Price: ₱${product.price}</p>
                <button onclick="addToCart('${product.name}', ${product.price})">Add to Cart</button>
            `;
            
            productList.appendChild(productDiv);
        });

        if (filteredProducts.length === 0) {
            productList.innerHTML = "<p>No products found matching the selected criteria.</p>";
        }
    }

    // Update price range label and filter products
    priceRange.addEventListener('input', function() {
        priceRangeValue.textContent = `₱2000 - ₱${priceRange.value}`;
        filterProducts();
    });

    // Filter products when concentration or size is changed
    concentrationSelect.addEventListener('change', filterProducts);
    sizeSelect.addEventListener('change', filterProducts);

    // Initial filter
    filterProducts();
});

// Add to Cart Function (same as before)
function addToCart(itemName, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push({ name: itemName, price: price });
    localStorage.setItem('cart', JSON.stringify(cart));
    alert(`${itemName} added to cart!`);
}
