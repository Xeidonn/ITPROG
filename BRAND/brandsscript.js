// Define the list of brands
const brands = [
    { name: "Dior", image: "dior.jpg" },
    { name: "Versace", image: "versace.jpg" },
    { name: "Chanel", image: "chanel.jpg" },
    { name: "Creed", image: "creed.jpg" },
    { name: "Prada", image: "prada.jpg" },
    { name: "Yves Saint Laurent", image: "ysl.jpg" },
    // Add more brands as needed
];

// Load brands
document.addEventListener('DOMContentLoaded', () => {
    const brandsContainer = document.getElementById('brandsContainer');

    brands.forEach(brand => {
        const brandDiv = document.createElement('div');
        brandDiv.classList.add('brand-card');
        
        brandDiv.innerHTML = `
            <img src="${brand.image}" alt="${brand.name}">
            <h3>${brand.name}</h3>
            <button onclick="viewBrand('${brand.name}')">Explore ${brand.name}</button>
        `;
        
        brandsContainer.appendChild(brandDiv);
    });
});

// Function to redirect to the products page with the selected brand
function viewBrand(brandName) {
    window.location.href = `products.html?brand=${brandName}`;
}