// Load cart from localStorage or initialize an empty array
let cart;
try {
    cart = JSON.parse(localStorage.getItem('cartItems')) || [];
} catch (error) {
    console.error("Error parsing cart data:", error);
    cart = [];
}

window.cart = cart; // Expose cart globally for debugging

function displayBookingDetails() {
    const bookingDetailsString = sessionStorage.getItem('bookingDetails');
    console.log('Booking Details from sessionStorage:', bookingDetailsString);

    if (bookingDetailsString) {
        const bookingDetails = JSON.parse(bookingDetailsString);

        // Populate the booking details in the DOM
        document.getElementById('bookingName').textContent = `Name: ${bookingDetails.name}`;
        document.getElementById('bookingPhone').textContent = `Phone: ${bookingDetails.phone}`;
        document.getElementById('bookingDate').textContent = `Arrival Date: ${bookingDetails.arrivalDate}`;
        document.getElementById('bookingTime').textContent = `Arrival Time: ${bookingDetails.arrivalTime}`;
        document.getElementById('bookingPeople').textContent = `Number of People: ${bookingDetails.people}`;
    } else {
        console.warn('No booking details found in sessionStorage.');
        document.getElementById('bookingDetails').innerHTML = '<p>No booking details available.</p>';
    }
}


// Function to display all cart items
function displayCartItems() {
    const cartItemsList = document.getElementById('cartItems'); // UL or div to display cart items
    const cartTotalElement = document.getElementById('cartTotal'); // Element for displaying the total price

    // Clear previous items
    cartItemsList.innerHTML = '';

    if (!cart || cart.length === 0) {
        // Display a message if the cart is empty
        cartItemsList.innerHTML = '<p>Your cart is empty.</p>';
        cartTotalElement.textContent = 'RM0.00';
        return;
    }

    // Populate the cart items and calculate the total
    let total = 0;
    cart.forEach((item) => {
        const listItem = document.createElement('li');
        listItem.textContent = `${item.name} x ${item.quantity || 1} - RM${(item.price * (item.quantity || 1)).toFixed(2)}`;
        cartItemsList.appendChild(listItem);

        total += item.price * (item.quantity || 1);
    });

    // Update the total price
    cartTotalElement.textContent = `RM${total.toFixed(2)}`;
}
// Save to localStorage
let bookings = JSON.parse(localStorage.getItem('bookings')) || [];
bookings.push(bookingDetails);
localStorage.setItem('bookings', JSON.stringify(bookings));

// Load cart items on page load
window.onload = function () {
    console.log("Cart data loaded:", cart);
    displayCartItems();
    displayBookingDetails();
};




