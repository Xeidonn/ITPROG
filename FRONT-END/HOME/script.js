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

// Number of items to show
const slidesToShow = 4; 
const slideWidth = 100 / slidesToShow;

// Set width for each perfume dynamically
newArrivalsSlides.forEach(slide => {
    slide.style.flex = `0 0 ${slideWidth}%`;
});

let currentIndex = 1; // Start at the first slide

// Update the slide position dynamically based on current index
function updateSlidePosition() {
    const offset = -currentIndex * slideWidth;
    newArrivalsSlider.style.transform = `translateX(${offset}%)`;
}

// Event listeners for navigation
document.querySelector('.next').addEventListener('click', () => {
    const totalSlides = newArrivalsSlider.querySelectorAll('.perfume').length;
    if (currentIndex < totalSlides - slidesToShow) {
        currentIndex++;
        updateSlidePosition();
    }
});

document.querySelector('.prev').addEventListener('click', () => {
    if (currentIndex > 1) {
        currentIndex--;
        updateSlidePosition();
    }
});


// Function to add a new perfume
function addNewPerfume(name, price) {
    const newPerfume = document.createElement('div');
    newPerfume.classList.add('perfume');
    newPerfume.style.flex = `0 0 ${slideWidth}%`;
    newPerfume.innerHTML = `
        <h3>${name}</h3>
        <p>₱${price}</p>
        <button onclick="addToCart('${name}', ${price})">Add to Cart</button>`;
    newArrivalsSlider.appendChild(newPerfume);

    // Update the total width of the carousel track
    const totalSlides = newArrivalsSlider.querySelectorAll('.perfume').length;
    newArrivalsSlider.style.width = `${totalSlides * slideWidth}%`;

    // Ensure slider works with the new slide
    updateSlidePosition();
}


// Initialize the new arrivals slider
showNewArrivalsSlides(newArrivalsSlideIndex);
