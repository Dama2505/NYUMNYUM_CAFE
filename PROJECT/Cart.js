let cart = []; // Array to store cart items

// Add items to the cart
function addToCart(itemName, itemPrice, quantity = 1) {
    const item = { name: itemName, price: itemPrice, quantity };
    cart.push(item); // Add to cart array
    localStorage.setItem('cartItems', JSON.stringify(cart)); // Save to localStorage
    displayCartItems(); // Update the cart UI
    alert(`${itemName} has been added to your cart.`);
}

// Update cart display
function updateCart() {
    const cartItemsList = document.getElementById('cartItems');
    const cartTotalElement = document.getElementById('cartTotal');
    cartItemsList.innerHTML = ''; // Clear the current cart items display

    let total = 0;
    cart.forEach((item) => {
        total += item.price * item.quantity;

        // Add each item as a list element
        const listItem = document.createElement('li');
        listItem.textContent = `${item.name} x ${item.quantity} - RM${(item.price * item.quantity).toFixed(2)}`;
        cartItemsList.appendChild(listItem);
    });

    cartTotalElement.textContent = `RM${total.toFixed(2)}`; // Update total
}
// Load the cart from localStorage on page load
window.onload = function () {
    const savedCart = localStorage.getItem('cartItems');
    if (savedCart) {
        cart = JSON.parse(savedCart); // Parse the saved cart
        updateCart(); // Update the UI with loaded cart
    }
};
function addToCart(itemName, itemPrice, quantity = 1) {
    const existingItem = cart.find((item) => item.name === itemName);

    if (existingItem) {
        existingItem.quantity += quantity; // Update the quantity
    } else {
        const newItem = { name: itemName, price: itemPrice, quantity }; // Add new item
        cart.push(newItem);
    }

    localStorage.setItem('cartItems', JSON.stringify(cart)); // Save cart to localStorage
    updateCart(); // Update cart UI
    alert(`${itemName} has been added to your cart.`);
}

// Checkout functionality
document.getElementById('cart-total').addEventListener('click', function () {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    // Save the cart to local storage for the summary page
    localStorage.setItem('cartItems', JSON.stringify(cart));
    alert('Your order has been placed! Redirecting to order summary...');
    cart = []; // Clear the cart
    updateCart(); // Reset the UI

    // Redirect to Summary page
    window.location.href = 'Summary.html'; 
});

// Cancel cart functionality
document.getElementById('cart-cancel').addEventListener('click', function () {
    cart = []; // Clear the cart
    updateCart(); // Reset the UI
    alert('Your cart has been cleared!');
});
