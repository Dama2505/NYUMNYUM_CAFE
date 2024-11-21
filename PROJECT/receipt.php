<?php
// Start the session and output buffering
session_start();
ob_start();

// Check if cart data is passed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
    // Decode the JSON cart data
    $cart = json_decode($_POST['cart'], true);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'admin dashboard');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare the SQL statement to insert cart data
    $stmt = $conn->prepare('INSERT INTO customer_menu (name, price, quantity) VALUES (?, ?, ?)');

    // Insert cart items into the database and store the inserted IDs
    $inserted_ids = [];
    foreach ($cart as $item) {
        $stmt->bind_param('sdi', $item['name'], $item['price'], $item['quantity']);
        $stmt->execute();

        // Get the inserted ID and store it
        $inserted_ids[] = $conn->insert_id;
    }

    // Get the total price of the cart
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $conn->close(); // Close the database connection
} else {
    // If no cart data is passed, redirect back to the menu page
    header('Location: menu.php');
    exit();
}

// End output buffering and flush the output
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt | Nyum Nyum Cafe</title>
    <link rel="stylesheet" href="MENUstyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .receipt-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: 30px auto;
            text-align: center;
            max-width: 600px;
        }
        h1 {
            color: #333;
            font-size: 2em;
        }
        h2 {
            color: #4CAF50;
            font-size: 1.5em;
        }
        h3 {
            font-size: 1.2em;
            margin-top: 20px;
        }
        .cart-items {
            list-style-type: none;
            padding: 0;
            text-align: left;
            margin-top: 20px;
        }
        .cart-items li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            font-size: 1.1em;
        }
        .cart-items li:last-child {
            border-bottom: none;
        }
        .total {
            margin-top: 20px;
            font-size: 1.5em;
            font-weight: bold;
            color: darkslategray;
        }
        .btn {
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #DFC07F;
            color: darkslategray;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #ffcc00;
        }
        .qr-code {
            margin-top: 30px;
        }
        .whatsapp-btn {
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #25D366;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s;
        }
        .whatsapp-btn:hover {
            background-color: #128C7E;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <h1>Receipt</h1>
        <h2>Thank you for your order!</h2>
        <h3>Your Order Details:</h3>
        <ul class="cart-items">
            <?php
            // Loop through the cart and display items along with the inserted ID
            foreach ($cart as $index => $item) {
                $item_id = $inserted_ids[$index];  // Get the corresponding inserted ID
                echo "<li>Item ID: {$item_id} - 
                {$item['name']} x {$item['quantity']} - RM" . number_format($item['price'] * $item['quantity'], 2) . "</li>";
            }
            ?>
        </ul>
        <div class="total">
            Total: RM<?php echo number_format($total, 2); ?>
        </div>

        <!-- QR Code for Payment -->
        <div class="qr-code">
            <h4>Scan this QR Code to make a payment:</h4>
            <!-- You can generate a QR code URL using a service or PHP QR Code library -->
            <img src="qr.jpg" alt="QR Code" style="max-width: 200px; margin-top: 20px;"/>
        </div>

        <!-- WhatsApp Link to Send Payment Proof -->
        <div>
            <a href="https://wa.me/+60193250513?text=I%20have%20made%20the%20payment.%20Here%20is%20the%20payment%20proof." target="_blank">
                <button class="whatsapp-btn">Send Payment Proof via WhatsApp</button>
            </a>
            <button class="btn" onclick="window.location.href='WEB2.php'">Dine in</button>
        </div>

        <button class="btn" onclick="window.location.href='menu.php'">Back to Menu</button>
    </div>
</body>
</html>
