<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Nyum Nyum Cafe</title>
    <link rel="stylesheet" href="MENUstyle.css">
    <style>
        /* Your CSS styles remain the same */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
        }
        header {
            background-color: #DFC07F;
            padding: 20px;
            text-align: center;
        }
        header h1 {
            color: darkslategray;
            margin: 0;
        }
        .menu-nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .menu-nav li {
            display: inline;
        }
        .menu-nav a {
            text-decoration: none;
            color: darkslategray;
            font-weight: bold;
            padding: 7px 16px;
            transition: background-color 0.3s;
        }
        .menu-nav a:hover {
            background-color: #ffcc00;
            color: #333;
            border-radius: 5px;
        }
        .menu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }
        .menu-item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 200px;
            text-align: center;
        }
        .menu-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .add-to-cart-btn {
            padding: 10px 15px;
            background-color: darkslategray;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-transform: uppercase;
        }
        .add-to-cart-btn:hover {
            background-color: #ffcc00;
        }
        .cart {
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            background-color: #DFC07F;
        }
        .cart-items {
            list-style-type: none;
            padding: 0;
        }
        .cart-items li {
            padding: 5px 0;
        }
        .checkout-btn {
            text-decoration: none;
        }
    </style>
    <script>
        let cart = [];

        function addToCart(name, price) {
            const existingItem = cart.find(item => item.name === name);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            displayCartItems();
        }

        function displayCartItems() {
            const cartItemsList = document.getElementById('cartItems');
            const cartTotalElement = document.getElementById('cartTotal');
            cartItemsList.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                const listItem = document.createElement('li');
                listItem.textContent = `${item.name} x ${item.quantity} - RM${(item.price * item.quantity).toFixed(2)}`;
                cartItemsList.appendChild(listItem);
                total += item.price * item.quantity;
            });

            cartTotalElement.textContent = `RM${total.toFixed(2)}`;
        }

        // Function to handle checkout and redirect to receipt.php
        function checkout() {
            // Create the form data for POST
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'receipt.php';  // Redirect to receipt.php

            // Create hidden input with cart data
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'cart';
            input.value = JSON.stringify(cart);  // Pass the cart data as JSON string

            // Append the input to the form and submit it
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();  // Submit the form to receipt.php
        }
    </script>
</head>
<body>
<header>
    <div class="navbar">
        <a href="WEB2.html">
            <img src="LOGO.png" alt="Nyum Nyum Cafe Logo" class="logo">
        </a>
        <h1>Menu &nbsp; &nbsp; &nbsp; &nbsp;</h1>
        <p>&nbsp;</p>
    </div>
    <nav class="menu-nav">
        <ul>
            <li><a href="#rice">Rice</a></li>
            <li><a href="#noodles">Noodles</a></li>
            <li><a href="#Pastries">Pastries</a></li>
            <li><a href="#Drinks">Drinks</a></li>
            
        </ul>
    </nav>
</header>

<main>
    <!-- Menu Items -->
     <!-- Section for Rice items -->
     <section class="menu-container" id="rice">
            <div class="menu-item" data-category="rice" data-name="Nasi Lemak Ayam Berempah" data-price="10.99">
                <img src="Nasi Lemak.jpg" alt="Nasi Lemak Ayam Berempah">
                <h3>Nasi Lemak Ayam Berempah</h3>
                <p>RM10.99</p>
                <button class="add-to-cart-btn" onclick="addToCart('Nasi Lemak Ayam Berempah', 10.99)">Add to Cart</button>
            </div>
            
            <div class="menu-item" data-category="rice"  data-name="Hainan Chicken Rice" data-price="8.00">
                <img src="Hainan Chicken Rice.jpg" alt="Hainan Chicken Rice">
                <h3>Hainan Chicken Rice</h3>
                <p>RM8.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Hainan Chicken Rice', 8.00)">Add to Cart</button>
            </div>
			<div class="menu-item" data-category="rice"  data-name="Plain Rice with Pad Kra Pao" data-price="11.00">
                <img src="Plain Rice with Pad Kra Pao.jpg" alt="Plain Rice with Pad Kra Pao">
                <h3>Plain Rice with Pad Kra Pao</h3>
                <p>RM11.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Plain Rice with Pad Kra Pao', 11.00)">Add to Cart</button>
            </div>
			 <div class="menu-item" data-category="rice" data-name="Chinese Fried Rice" data-price="8.00">
                <img src="Chinese Fried Rice.jpg" alt="Chinese Fried Rice">
                <h3>Chinese Fried Rice</h3>
                <p>RM8.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Chinese Fried Rice', 8.00)">Add to Cart</button>
            </div>
			 <div class="menu-item" data-category="rice" data-name="Stir Fried Prawn Chicken and Chili with Rice" data-price="12.00">
                <img src="Stir fried prawn chicken and Chili with Rice.jpg" alt="Stir Fried Prawn Chicken and Chili with Rice">
                <h3>Stir Fried Prawn Chicken and Chili with Rice</h3>
                <p>RM12.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Stir Fried Prawn Chicken and Chili with Rice', 12.00)">Add to Cart</button>
            </div>
        </section>

        <!-- Section for Noodles items -->
        <section class="menu-container"  id="noodles">
            <div class="menu-item" data-category="noodles" data-name="Creamy Butter Chicken Spaghetti" data-price="13.50">
                <img src="Creamy butter chicken spaghetti.jpg" alt="Creamy butter chicken spaghetti">
                <h3>Creamy Butter Chicken Spaghetti</h3>
                <p>RM13.50</p>
                <button class="add-to-cart-btn" onclick="addToCart('Creamy Butter Chicken Spaghetti', 13.50)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-name="Oglio Olio" data-price="14.50">
                <img src="Oglio Olio.jpg" alt="Oglio Olio">
                <h3>Oglio Olio</h3>
                <p>RM14.50</p>
                <button class="add-to-cart-btn" onclick="addToCart('oglio Olio', 14.50)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="noodles"  data-name="Spaghetti bolognese" data-price="12.00">
                <img src="Spaghetti bolognese.jpg" alt="Spaghetti bolognese">
                <h3>Spaghetti bolognese</h3>
                <p>RM12.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Spaghetti bolognese', 12.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="noodles"  data-name="Fried Noodles Beef or Chicken" data-price="10.00">
                <img src="Fried Noodles Beef,Chicken.jpg" alt="Fried Noodles Beef,Chicken">
                <h3>Fried Noodles Beef/Chicken</h3>
                <p>RM10.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Fried Noodles Beef,Chicken', 10.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="noodles"  data-name="Mee Kari" data-price="10.00">
                <img src="Mee Kari.jpg" alt="Mee Kari">
                <h3>Mee Kari</h3>
                <p>RM10.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Mee Kari', 10.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="noodles"  data-name="Mee Sup" data-price="12.00">
                <img src="Mee Sup.jpg" alt="Mee Sup">
                <h3>Mee Sup</h3>
                <p>RM12.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Mee Sup', 12.00)">Add to Cart</button>
            </div>
        </section>
		
		<!-- Section for Pastries items -->
        <section class="menu-container" id="Pastries">
            <div class="menu-item" data-category="Pastries" 
				 data-name="Chocolate indulgence Cake" data-price="12.00">
                <img src="Choc Indulgence.jpg" alt="Chocolate Indulgence Cake">
                <h3>Chocolate Indulgence </h3>
                <p>RM12.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Chocolate Indulgence ', 12.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="Pastries" 
				 data-name="Strawberry Cheesecake" data-price="12.00">
                <img src="Strawberry cheesecake.jpg" alt="Strawberry Cheesecake">
                <h3>Strawberry Cheesecake </h3>
                <p>RM12.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Strawberry Cheesecake', 12.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="Pastries" 
				 data-name="Biscoff Cheesecake" data-price="15.00">
                <img src="biscoff cake.jpg" alt="biscoff cake">
                <h3>Strawberry Cheesecake </h3>
                <p>RM15.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Biscoff Cheesecake', 15.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="Pastries" 
				 data-name="Blueberry Cheesecake" data-price="14.00">
                <img src="Blueberry Cheesecake.jpg" alt="Blueberry Cheesecake">
                <h3>Strawberry Cheesecake </h3>
                <p>RM14.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Blueberry Cheesecake', 14.00)">Add to Cart</button>
            </div>
  
        </section>

        <!-- Section for Drinks items -->
        <section class="menu-container" id="Drinks">
           <div class="menu-item" data-category="Drinks" data-name="Strawberry Smoothie" data-price="12.00">
			   <img src="Strawberry.jpg" alt="Strawberry Smoothie">
                <h3>Strawberry Smoothie </h3>
                <p>RM12.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Strawberry Smoothie', 12.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="Drinks" data-name="Chocolate Smoothie" data-price="12.00">
			   <img src="Choc.jpg" alt="Chocolate Smoothie">
                <h3>Chocolate Smoothie </h3>
                <p>RM12.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Chocolate Smoothie', 12.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="Drinks" data-name="Cookies n Cream Smoothie" data-price="13.00">
			   <img src="cookies n cream.jpg" alt="Chocolate Smoothie">
                <h3>Cookies n Cream Smoothie </h3>
                <p>RM13.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Cookies n Cream Smoothie', 13.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="Drinks" data-name="Raspberry Sparkling Juice" data-price="8.00">
			   <img src="rasberry sparkling.jpg" alt="Raspberry Sparkling Juice">
                <h3>Raspberry Sparkling Juice </h3>
                <p>RM8.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Raspberry Sparkling Juice', 8.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="Drinks" data-name="Watermelon Sparkling Juice" data-price="8.00">
			   <img src="watermelon sparkling.jpg" alt="watermelon sparkling Juice">
                <h3>Watermelon Sparkling Juice </h3>
                <p>RM8.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Watermelon Sparkling Juice', 8.00)">Add to Cart</button>
            </div>
			
			<div class="menu-item" data-category="Drinks" data-name="Strawberry Lychee Sparkling Juice" data-price="8.00">
			   <img src="strawberry lychee sparkling.jpg" alt="Strawberry Lychee Sparkling Juice">
                <h3>Strawberry Lychee Sparkling Juice </h3>
                <p>RM8.00</p>
                <button class="add-to-cart-btn" onclick="addToCart('Strawberry Lychee Sparkling Juice', 8.00)">Add to Cart</button>
            </div>
    </section>

    <!-- Cart Section -->
    <section class="cart">
        <h2>Your Cart</h2>
        <ul class="cart-items" id="cartItems"></ul>
        <p>Total: RM<span id="cartTotal">0.00</span></p>
        <!-- Checkout button triggers the checkout function -->
        <button class="checkout-btn" onclick="checkout()">Checkout</button>
    </section>
</main>

<?php
ob_start(); // Start output buffering

// Process the cart data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = json_decode($_POST['cart'], true);

    // Database connection
    $conn = new mysqli('localhost','root', '', 'admin dashboard');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Insert cart data into the database
    foreach ($cart as $item) {
        $stmt = $conn->prepare('INSERT INTO customer_menu (name, price, quantity) VALUES (?, ?, ?)');
        $stmt->bind_param('sdi', $item['name'], $item['price'], $item['quantity']);
        $stmt->execute();
    }

    $conn->close();

    // Redirect to receipt.php
    header('Location: receipt.php');
    exit();
}
?>

<?php
ob_end_flush(); // End output buffering and flush the output
?>
</body>
</html>
