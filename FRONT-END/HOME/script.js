/* Slideshow */
let slideIndex = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');

function showSlides() {
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.opacity = "0";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.opacity = "1";

  // Dots
  for (let i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000); // Change image every 3 seconds
}

showSlides();

/* Cart */
let cart = [];
let cartTotal = 0;

function addToCart(itemName, price) {
    cart.push({ name: itemName, price: price });
    cartTotal += price;
    updateCart();
}

function updateCart() {
    let cartItemsDiv = document.getElementById('cartItems');
    let cartTotalSpan = document.getElementById('cartTotal');
    cartItemsDiv.innerHTML = '';
    cart.forEach((item, index) => {
        cartItemsDiv.innerHTML += `<div class="cart-item">${item.name} - ₱${item.price} <button onclick="removeFromCart(${index})">Remove</button></div>`;
    });
    cartTotalSpan.innerText = cartTotal;
}

function removeFromCart(index) {
    cartTotal -= cart[index].price;
    cart.splice(index, 1);
    updateCart();
}

// Carousel slider logic for New Arrivals
let newArrivalsSlideIndex = 0;
const newArrivalsSlider = document.querySelector('.new-arrivals-slider');
const newArrivalsSlides = document.querySelectorAll('.new-arrivals-slider .perfume');
const newArrivalsVisibleSlides = 4;  // Limit to 4 perfumes

function showNewArrivalsSlides(index) {
    const maxIndex = newArrivalsSlides.length - newArrivalsVisibleSlides;
    if (index < 0) newArrivalsSlideIndex = 0;
    else if (index > maxIndex) newArrivalsSlideIndex = maxIndex;
    else newArrivalsSlideIndex = index;
    const offset = -(newArrivalsSlideIndex * (100 / newArrivalsVisibleSlides));
    newArrivalsSlider.style.transform = `translateX(${offset}%)`;
}

function nextNewArrivalsSlide() {
    showNewArrivalsSlides(newArrivalsSlideIndex + 1);
}

function prevNewArrivalsSlide() {
    showNewArrivalsSlides(newArrivalsSlideIndex - 1);
}

// Initialize the new arrivals slider
showNewArrivalsSlides(newArrivalsSlideIndex);

