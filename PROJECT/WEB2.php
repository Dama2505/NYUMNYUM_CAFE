<?php
// Database connection
$host = "localhost"; // Your database host
$dbname = "admin dashboard"; // Your database name
$username = "root"; // Your database username
$password = ""; // Your database password

$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        // Get and escape user input
        $name = $conn->real_escape_string($_POST['name']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $arrivalDate = $conn->real_escape_string($_POST['arrivalDate']);
        $arrivalTime = $conn->real_escape_string($_POST['arrivalTime']);
        $people = intval($_POST['people']);
        $idNumber = $conn->real_escape_string($_POST['id_number']); // Get ID number

        // Prepare SQL query using prepared statements
        $stmt = $conn->prepare("INSERT INTO booking (name, phone, arrival_date, arrival_time, people, status, id_number) 
                                VALUES (?, ?, ?, ?, ?, 'pending', ?)");
        
        if ($stmt === false) {
            $message = "Error preparing statement: " . $conn->error;
        } else {
            // Bind the parameters (s = string, i = integer)
            $stmt->bind_param("sssssi", $name, $phone, $arrivalDate, $arrivalTime, $people, $idNumber);

            // Execute the query
            if ($stmt->execute()) {
                $message = "Booking successfully saved!";
            } else {
                $message = "Error inserting data: " . $stmt->error;
            }

            $stmt->close(); // Close the prepared statement
        }
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Landing Page</title>
    <link rel="stylesheet" href="WEBstyle.css">
</head>
<body>
    <!-- Booking Form Section -->
    <div class="booking" id="booking-form">
        <h3>Book a Table</h3>
        <?php if (!empty($message)): ?>
            <p style="color: green;"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
    <input type="hidden" name="action" value="add"> <!-- Hidden action field -->

    <input type="text" name="name" placeholder="Name" required>
    <input type="tel" name="phone" placeholder="Phone" required>

    <label for="arrival-date">Arrival Date:</label>
    <input type="date" name="arrivalDate" required>

    <label for="arrival-time">Arrival Time:</label>
    <select name="arrivalTime" required>
        <option value="">Select Time</option>
        <option value="10:00:00">10:00 AM</option>
        <option value="10:30:00">10:30 AM</option>
        <option value="11:00:00">11:00 AM</option>
        <option value="11:30:00">11:30 AM</option>
        <option value="12:00:00">12:00 PM</option>
        <option value="12:30:00">12:30 PM</option>
        <option value="13:00:00">1:00 PM</option>
        <option value="13:30:00">1:30 PM</option>
        <option value="14:00:00">2:00 PM</option>
        <option value="14:30:00">2:30 PM</option>
        <option value="15:00:00">3:00 PM</option>
        <option value="15:30:00">3:30 PM</option>
    </select>

    <input type="number" name="people" placeholder="Number of People" required>
    <input type="text" name="id_number" placeholder="ID Order" required>

    <button type="submit">Submit</button>
    <a href="WEB2.html">
        <button type="button">Back</button>
    </a>
</form>
    </div>

    <style>
        /* Center the form */
        /* Booking Form Section */

        body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: url('sumarry.jpg') no-repeat center center fixed; /* Background image */
        background-size: cover; /* Ensures the image covers the entire page */
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
    }

        .booking {
            width: 100%;
            max-width: 500px;  /* Adjust the max width of the form */
            margin: 0 auto;    /* This centers the form horizontally */
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.6);  /* Semi-transparent background */
            color: #f5f5f5;    /* Light font color */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);  /* Soft shadow for depth */
        }

        .booking h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            font-family: 'Protest Strike', sans-serif;
            text-align: center;
        }

        .booking input,
        .booking select,
        .booking button {
            width: 100%;  /* Full-width inputs */
            padding: 12px;
            font-size: 1rem;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .booking input[type="text"],
        .booking input[type="tel"],
        .booking input[type="number"] {
            background-color: #333;  /* Dark background for inputs */
            color: #fff;  /* White text */
        }

        .booking input[type="date"],
        .booking select {
            background-color: #444;  /* Slightly lighter background */
            color: #fff;  /* White text */
        }

        .booking button {
            background-color: #f1c40f;  /* Gold color for button */
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-weight: bold;
        }

        .booking button:hover {
            background-color: #e67e22;  /* Darker gold on hover */
            transform: scale(1.05); /* Subtle scale effect */
        }

        .booking p {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 300;
            margin-top: 20px;
        }

        /* Optional: success/error message styles */
        .booking p.success {
            color: #28a745;  /* Green for success */
        }

        .booking p.error {
            color: #dc3545;  /* Red for error */
        }
    </style>
</body>
</html>
