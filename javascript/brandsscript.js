// Define the list of brands
const brands = [
    { name: "Dior", image: "../images/dior-brand.png" },
    { name: "Versace", image: "../images/versace-brand.png" },
    { name: "Chanel", image: "../images/chanel-brand.png" },
    { name: "Creed", image: "../images/creed-brand.png" },
    { name: "Prada", image: "../images/prada.png" },
    { name: "Yves Saint Laurent", image: "../images/ysl-brand.png" },
    { name: "Jean Paul Gaultier", image:"../images/jpg-brand.png"},
    { name: "Roja Parfum", image:"../images/roja-brand.png"}
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
    window.location.href = `../php/products.php?brand=${brandName}`;
}