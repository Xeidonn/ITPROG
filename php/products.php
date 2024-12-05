<?php
session_start(); // Start session to store cart data

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scentbonanza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to add products to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the product data from the POST request
    $productId = intval($_POST['product_id']);
    $quantity = 1; // Assuming 1 unit is added to the cart per request

    // Fetch the product quantity from the database
    $sql = "SELECT * FROM perfumes WHERE perfumeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);

    if (!$stmt->execute()) {
        die("Error fetching product: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Check if enough quantity is available
        if ($product['quantity'] >= $quantity) {
            // Deduct quantity
            $newquantity = $product['quantity'] - $quantity;
            $updateSql = "UPDATE perfumes SET quantity = ? WHERE perfumeID = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ii", $newquantity, $productId);

            if ($updateStmt->execute()) {
                // Add the product to the session cart array
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                $_SESSION['cart'][] = [
                    'id' => $productId,
                    'name' => $product['perfumeName'],
                    'price' => $product['price'],
                ];

                // Redirect to avoid duplicate submissions
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            } else {
                echo "Error updating quantity.";
            }
        } else {
            echo "Insufficient quantity available.";
        }
    } else {
        echo "Product not found.";
    }
}

// Get the selected brand from the query parameter (if any)
$selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Scent Bonanza</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../php/header.php'; ?>

    <section class="products-section">
        <h2>
            <?php echo $selectedBrand ? "Products by " . htmlspecialchars($selectedBrand) : "All Products"; ?>
        </h2>

        <!-- Products List -->
        <div class="perfume-slider" id="productList">
            <?php
            // Fetch products from the database
            $sql = "SELECT * FROM perfumes WHERE quantity > 0"; // Only show products in stock
            if ($selectedBrand) {
                $sql .= " AND PerfumeBrandName = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $selectedBrand);
                $stmt->execute();
                $result = $stmt->get_result();
            } else {
                $result = $conn->query($sql);
            }

            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    echo "<div class='perfume' data-price='" . htmlspecialchars($product['price']) . "' data-concentration='" . htmlspecialchars($product['concentration']) . "' data-size='" . htmlspecialchars($product['sizes']) . "'>";
                    echo "<form method='POST'>";
                    echo "<img src='" . htmlspecialchars($product['image']) . "' alt='" . htmlspecialchars($product['perfumeName']) . "'>";
                    echo "<h3>" . htmlspecialchars($product['PerfumeBrandName']) . " - " . htmlspecialchars($product['perfumeName']) . "</h3>";
                    echo "<p>Price: ₱" . number_format((float)$product['price'], 2) . "</p>";
                    echo "<p>Size: " . htmlspecialchars($product['sizes']) . "</p>"; // Display size
                    echo "<p>Concentration: " . htmlspecialchars($product['concentration']) . "</p>"; // Display concentration
                    echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($product['perfumeID']) . "'>";
                    echo "<button type='submit'>ADD TO CART</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No products available" . ($selectedBrand ? " for " . htmlspecialchars($selectedBrand) : "") . ".</p>";
            }

            $conn->close(); // Close the database connection
            ?>
        </div>
    </section>

    <?php include '../php/footer.php'; ?>
    <script src="../javascript/script.js"></script>
</body>
</html>
