<?php
// Database connection
$host = 'localhost';
$db = 'admin dashboard';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $conn->real_escape_string($_POST['name']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $arrivalDate = $conn->real_escape_string($_POST['arrivalDate']);
        $arrivalTime = $conn->real_escape_string($_POST['arrivalTime']);
        $people = intval($_POST['people']);
        $idNumber = $conn->real_escape_string($_POST['id_number']); // Get ID number

        // Insert booking into the database
        $sql = "INSERT INTO booking (name, phone, arrival_date, arrival_time, people, status, id_number) 
                VALUES ('$name', '$phone', '$arrivalDate', '$arrivalTime', $people, 'pending', '$idNumber')";
        $conn->query($sql);
    } elseif ($action === 'delete') {
        $id = intval($_POST['id']);
        $sql = "DELETE FROM booking WHERE id = $id";
        $conn->query($sql);
    } elseif ($action === 'accept') {
        $id = intval($_POST['id']);
        $sql = "UPDATE booking SET status = 'accepted' WHERE id = $id";
        $conn->query($sql);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch bookings
$sql = "SELECT * FROM booking";
$result = $conn->query($sql);
$bookings = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Nyum Nyum Cafe</title>
    <style>
    /* General Styling */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #fdf3e7, #f8e4c9); /* Cream gradient background */
    }

    /* Header */
    header {
        background-color: #8B5E3C;  /* Rich Brown */
        color: white;
        padding: 20px 0;
        text-align: center;
    }

    header .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #A67B5B;  /* Light Brown */
    }

    header .navbar .logo {
        width: 100px;
        height: auto;
    }

    header nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    header nav ul li {
        margin-left: 20px;
    }

    header nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        padding: 10px;
        border-radius: 4px;
    }

    header nav ul li a:hover {
        background-color: #7B4F32; /* Darker Brown Hover */
    }

    /* Main Section */
    main {
        padding: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff; /* White table background */
        margin-top: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #8B5E3C; /* Rich Brown for header */
        color: white;
    }

    /* Button Styling */
    button {
        padding: 12px 20px;
        margin: 5px;
        border: none;
        cursor: pointer;
        background-color: #D7A779; /* Creamy Brown */
        color: white;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.2s ease-in-out;
    }

    button:hover {
        background-color: #C4976E;  /* Darker Creamy Brown on hover */
        transform: scale(1.05);
    }

    .delete-btn {
        background-color: #FF4C37;  /* Red for delete */
    }

    .delete-btn:hover {
        background-color: #D32F2F;  /* Darker Red on hover */
    }

    /* Accept Button Styling */
button[type="submit"]:not(.delete-btn) {
    background-color: #4CAF50; /* Green for accept button */
}

button[type="submit"]:not(.delete-btn):hover {
    background-color: #45a049; /* Darker Green on hover */
}


    /* Modal Styling */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: #fff; /* White modal background */
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .modal-content input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .modal-content button {
        background-color: #8B5E3C;  /* Rich Brown button for modal */
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        font-weight: bold;
    }

    .modal-content button:hover {
        background-color: #7B4F32;  /* Darker brown on hover */
    }

    /* Footer */
    footer {
        background-color: #8B5E3C;  /* Rich Brown for footer */
        color: white;
        text-align: center;
        padding: 10px;
        margin-top: 20px;
    }

    footer p {
        margin: 0;
    }
</style>

</head>
<body>
    <header>
        <div class="navbar">
            <a href="WEB2.html">
                <img src="LOGO.png" alt="Nyum Nyum Cafe Logo" class="logo">
            </a>
            <nav>
                <ul>
                    <li><a href="LOGIN.html">Log Out</a></li>
                </ul>
            </nav>
        </div>
        <h1>Admin Dashboard | Nyum Nyum Cafe</h1>
    </header>

    <main>
        <h2>Booking Management</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Arrival Date</th>
                    <th>Arrival Time</th>
                    <th>People</th>
                    <th>ID Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($bookings) > 0): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr id="booking-<?= $booking['id'] ?>">
                            <td><?= htmlspecialchars($booking['name']) ?></td>
                            <td><?= htmlspecialchars($booking['phone']) ?></td>
                            <td><?= htmlspecialchars($booking['arrival_date']) ?></td>
                            <td><?= htmlspecialchars($booking['arrival_time']) ?></td>
                            <td><?= htmlspecialchars($booking['people']) ?></td>
                            <td><?= htmlspecialchars($booking['id_number']) ?></td>
                            <td><?= htmlspecialchars($booking['status']) ?></td>
                            <td>
                                <?php if ($booking['status'] == 'pending'): ?>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                                        <input type="hidden" name="action" value="accept">
                                        <button type="submit">Accept</button>
                                    </form>
                                <?php endif; ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <button onclick="document.getElementById('bookingModal').style.display='flex'">Add Booking</button>
    </main>

    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <h3>Add Booking</h3>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
                <label for="phone">Phone:</label>
                <input type="text" name="phone" required>
                <label for="arrivalDate">Arrival Date:</label>
                <input type="date" name="arrivalDate" required>
                <label for="arrivalTime">Arrival Time:</label>
                <input type="time" name="arrivalTime" required>
                <label for="people">Number of People:</label>
                <input type="number" name="people" required>
                <label for="id_number">ID Number:</label>
                <input type="text" name="id_number" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Nyum Nyum Cafe</p>
    </footer>

    <script>
        // Close the modal when clicked outside
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        });
    </script>
</body>
</html>
