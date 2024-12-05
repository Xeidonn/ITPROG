<?php
session_start(); // Start session to retrieve cart data

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "scentbonanza";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a delete request has been made
if (isset($_POST['delete_product_id'])) {
    // Get the product index in the session array
    $deleteProductId = $_POST['delete_product_id'];

    // Retrieve product details from the session cart
    $removedProduct = $_SESSION['cart'][$deleteProductId];
    $productId = $removedProduct['id']; // Assuming the 'id' field is stored in the cart
    $quantity = 1; // Adjust based on the quantity logic in your application

    // Remove the product from the cart
    unset($_SESSION['cart'][$deleteProductId]);

    // Reindex the cart array to fix any index gaps
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Increment the stock quantity in the database
    $updateSql = "UPDATE perfumes SET quantity = quantity + ? WHERE perfumeID = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ii", $quantity, $productId);

    if (!$stmt->execute()) {
        echo "Error updating the stock: " . $stmt->error;
    }

    $stmt->close();
}

// Define discount if not set
$discount = 0; // Set to 0 or define your discount logic here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scent Bonanza - Perfume Catalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../php/header.php'; ?>
    
    <!-- Cart Display Section -->
    <section class="cart-section">
        <div class="cart-container">
            <h2>Your Cart</h2>
            <div class="listCart">
                <?php
                // Check if the cart session is set and not empty
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    $totalPrice = 0;
                    $totalItems = count($_SESSION['cart']);

                    // Start the table structure
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Product</th>";
                    echo "<th>Price</th>";
                    echo "<th>Action</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    // Loop through the cart and display the items in table rows
                    foreach ($_SESSION['cart'] as $index => $item) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($item['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['price']) . "</td>";

                        // Create a delete button for each item
                        echo "<td>";
                        echo "<form method='POST' style='display:inline;'>";
                        echo "<input type='hidden' name='delete_product_id' value='$index'>";
                        echo "<button type='submit'>Delete</button>";
                        echo "</form>";
                        echo "</td>";

                        echo "</tr>";

                        // Add the price to the total price (remove currency symbol for calculations)
                        $totalPrice += (float) filter_var($item['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    }

                    // Close the table structure
                    echo "</tbody>";
                    echo "</table>";

                    // Calculate the discount
                    $discountAmount = $totalPrice * $discount;
                    $totalPriceAfterDiscount = $totalPrice - $discountAmount;

                    // Display total items, total price, and discounted price
                    echo "<h3>Total Items: <span id='cartTotalItems'>{$totalItems}</span></h3>";
                    echo "<h3>Total Price: <span id='cartTotalPrice'>₱" . number_format($totalPrice, 2) . "</span></h3>";
                    if ($discount > 0) {
                        echo "<h3>Discount Applied: <span>-₱" . number_format($discountAmount, 2) . "</span></h3>";
                        echo "<h3>Total Price After Discount: <span>₱" . number_format($totalPriceAfterDiscount, 2) . "</span></h3>";
                    }
                } else {
                    // If cart is empty, display a message
                    echo "<p>Your cart is empty. Please add some items before proceeding to checkout.</p>";
                }
                ?>
            </div>

            <!-- Checkout and Close Cart Buttons -->
            <div style="margin-top: 20px;">
                <button onclick="window.location.href = '../php/home.php';">Close Cart</button>
                <?php
                // Disable the checkout button if the cart is empty
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    echo "<button onclick=\"window.location.href = '../php/checkout.php';\">Proceed to Checkout</button>";
                } else {
                    // Display a disabled button and message when the cart is empty
                    echo "<button disabled>Proceed to Checkout</button>";
                }
                ?>
            </div>
        </div>
    </section>

    <script src="../javascript/script.js"></script>
    <script src="../javascript/cart.js"></script>
</body>
</html>
