let cart = [];
let cartTotal = 0;

// Function to add items to the cart
function addToCart(itemName, price) {
    // Add item to the cart array
    cart.push({ name: itemName, price: price });
    
    // Recalculate total
    cartTotal += price;

    // Update the cart display
    updateCart();
}

// Function to update cart display
function updateCart() {
    let cartItemsDiv = document.getElementById('cartItems');
    let cartTotalSpan = document.getElementById('cartTotal');

    // Clear the cart items display
    cartItemsDiv.innerHTML = '';

    // Loop through the cart array and display each item
    cart.forEach((item, index) => {
        cartItemsDiv.innerHTML += `<div class="cart-item">${item.name} - ₱${item.price} <button onclick="removeFromCart(${index})">Remove</button></div>`;
    });

    // Update the total
    cartTotalSpan.innerText = cartTotal;
}

// Function to remove items from the cart
function removeFromCart(index) {
    // Deduct the price from the total
    cartTotal -= cart[index].price;

    // Remove item from cart array
    cart.splice(index, 1);

    // Update the cart display
    updateCart();
}
