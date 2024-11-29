// Define the list of brands
const brands = [
    { name: "Dior", image: "brandimages/dior.png" },
    { name: "Versace", image: "brandimages/versace.png" },
    { name: "Chanel", image: "brandimages/chanel.png" },
    { name: "Creed", image: "brandimages/creed.png" },
    { name: "Prada", image: "brandimages/prada.png" },
    { name: "Yves Saint Laurent", image: "brandimages/ysl.png" },
    { name: "Jean Paul Gaultier", image:"brandimages/jpg.png"},
    { name: "Roja Parfum", image:"brandimages/roja.png"}
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