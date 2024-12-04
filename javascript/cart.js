// cart.js

// Array to store cart items (persistent with localStorage)
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// DOM Elements
const cartCountSpan = document.getElementById('cartCount');
const cartListContainer = document.querySelector('.listCart');
const cartTotalItemsSpan = document.getElementById('cartTotalItems');
const cartTotalPriceSpan = document.getElementById('cartTotalPrice');

// Function to update cart count
function updateCartCount() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCountSpan.textContent = totalItems;
    cartTotalItemsSpan.textContent = totalItems;
}

// Function to update the cart list display
function updateCartDisplay() {
    cartListContainer.innerHTML = ''; // Clear the current list
    let totalPrice = 0;

    if (cart.length === 0) {
        cartListContainer.innerHTML = '<p>Your cart is empty.</p>';
    } else {
        cart.forEach((item, index) => {
            const itemTotal = item.quantity * item.price;
            totalPrice += itemTotal;

            cartListContainer.innerHTML += `
                <div class="cart-item">
                    <img src="${item.image}" alt="${item.name}" width="50">
                    <h4>${item.name}</h4>
                    <p>Price: ₱${item.price}</p>
                    <p>Quantity: 
                        <button onclick="changeQuantity(${index}, -1)">-</button> 
                        ${item.quantity} 
                        <button onclick="changeQuantity(${index}, 1)">+</button>
                    </p>
                    <button onclick="removeFromCart(${index})">Remove</button>
                </div>
            `;
        });

        cartTotalPriceSpan.textContent = `₱${totalPrice.toFixed(2)}`;
    }
}

// Function to add an item to the cart
function addToCart(product) {
    const existingProduct = cart.find(item => item.name === product.name);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({
            name: product.name,
            price: product.price,
            image: product.image,
            quantity: 1
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartDisplay();
}

// Function to change the quantity of an item
function changeQuantity(index, change) {
    if (cart[index].quantity + change > 0) {
        cart[index].quantity += change;
    } else {
        cart.splice(index, 1);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartDisplay();
}

// Function to remove an item from the cart
function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartDisplay();
}

// Initial update on page load
updateCartCount();
updateCartDisplay();

// Example Product Data & Adding Event Listeners (For Demo Purposes)
document.querySelectorAll('.perfume button').forEach(button => {
    button.addEventListener('click', function() {
        const productCard = this.closest('.perfume');
        const productName = productCard.querySelector('h3').textContent;
        const productPrice = parseFloat(productCard.querySelector('p').textContent.replace('₱', ''));
        const productImage = productCard.querySelector('img').src;

        addToCart({
            name: productName,
            price: productPrice,
            image: productImage
        });
    });
});
