document.addEventListener('DOMContentLoaded', () => {
    const brandsContainer = document.getElementById('brandsContainer');

    // Ensure brandsFromDatabase exists
    if (brandsFromDatabase.length > 0) {
        brandsFromDatabase.forEach(brand => {
            const brandDiv = document.createElement('div');
            brandDiv.classList.add('brand-card');

            // Create the HTML structure for each brand
            brandDiv.innerHTML = `
                <img src="${brand.image}" alt="${brand.name}">
                <h3>${brand.name}</h3>
                <button onclick="viewBrand('${brand.name}')">Explore ${brand.name}</button>
            `;

            brandsContainer.appendChild(brandDiv);
        });
    } else {
        brandsContainer.innerHTML = `<p>No brands available at the moment.</p>`;
    }
});

// Redirects to the products page with the selected brand
function viewBrand(brandName) {
    window.location.href = `../php/products.php?brand=${encodeURIComponent(brandName)}`;
}
