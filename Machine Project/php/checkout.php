<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Scent Bonanza</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
    require '../php/dbconnect.php'; // Database connection
    session_start(); // Start the session to access session variables
    include '../php/header.php';

    // Initialize variables for pre-filling the form fields
    $firstName = '';
    $lastName = '';

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id']; // Retrieve user ID from session
        $firstName = $_SESSION['first_name'];  // Retrieve first name from session
        $lastName = $_SESSION['last_name'];  // Retrieve last name from session
    } else {
        $userId = null; // Set user ID to null if not logged in
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $subtotal = 0;

        // Calculate the subtotal
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $subtotal += (float) filter_var($item['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            }
        }

        try {
            // Insert subtotal and user ID into the database
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, totalPrice) VALUES (:user_id, :totalPrice)");
            $stmt->execute([
                ':user_id' => $userId,
                ':totalPrice' => $subtotal
            ]);

            echo "<p>Order placed successfully!</p>";

            // Clear the cart after successful order placement
            unset($_SESSION['cart']);
        } catch (PDOException $e) {
            echo "<p>Error placing order: " . $e->getMessage() . "</p>";
        }
    }
    ?>

    <div class="checkout-container">
        <!-- Combined Delivery and Payment Section -->
        <div class="delivery-payment-section">
            <h2>Delivery and Payment Information</h2>
            <form method="POST">
                <!-- Delivery Information -->
                <fieldset>
                    <legend>Delivery Information</legend>
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="Enter your first name" required>
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Enter your last name" required>
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter your full address" required>
                </fieldset>

                <button type="submit">Submit</button>
            </form>
        </div>
        <!-- Order Summary Section -->
        <div class="order-summary-section">
            <h2>Order Summary</h2>
            <?php
            // Check if the cart session is set and not empty
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $subtotal = 0;

                // Loop through cart items and display them
                foreach ($_SESSION['cart'] as $item) {
                    echo "<div class='order-item'>";
                    echo "<p>" . htmlspecialchars($item['name']) . "</p>";
                    echo "<p>₱" . number_format((float) filter_var($item['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION), 2) . "</p>";
                    echo "</div>";
                    $subtotal += (float) filter_var($item['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                }
                
                // Display subtotal and total (add logic for shipping if needed)
                echo "<div class='order-total'>";
                echo "<p>Subtotal: ₱" . number_format($subtotal, 2) . "</p>";
                echo "<p>Shipping: To be calculated</p>";
                echo "<p><strong>Total: ₱" . number_format($subtotal, 2) . "</strong></p>";
                echo "</div>";
            } else {
                // Display message if cart is empty
                echo "<p>Your cart is empty. Add items to your cart before checking out.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
