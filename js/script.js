// Get cart data from localStorage (or initialize empty array)

import {cart} from './cart.js';



// Function to update cart count in UI
function updateCartUI() {
  //localStorage.clear();
    document.getElementById("cartNumber").innerText = cart.length;
}

// Function to add product to cart
function addToCart(productId) {
    if (!cart.includes(productId)) {
        cart.push(productId); // Add product ID to array
        localStorage.setItem("cart", JSON.stringify(cart)); // Save to localStorage
        updateCartUI();
    }else {
      cart.push(productId); // Add product ID to array
      localStorage.setItem("cart", JSON.stringify(cart)); // Save to localStorage
      updateCartUI();
    }
}

// Add event listener to all "Add to Cart" buttons
document.querySelectorAll(".addCartBtn").forEach(button => {
    button.addEventListener("click", function () {
        let productId = this.getAttribute("data-id");
        console.log(productId);
        addToCart(productId);
    });
});

// Update UI when page loads
updateCartUI();