<?php
session_start(); // Start session to store cart data

// Handle the form submission to add products to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the product data from the POST request
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Add the product to the session cart array
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Push the product details into the cart array
    $_SESSION['cart'][] = ['name' => $productName, 'price' => $productPrice];

    // Redirect to the same page to prevent duplicate form submissions
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit(); // Ensure no further code is executed after the redirect
}
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
        <h2 id="productTitle">Our Products</h2>

        <!-- Filters Section -->
        <div class="filters">
            <label for="priceRange">Price Range:</label>
            <input type="range" id="priceRange" min="2000" max="30000" step="500">
            <span id="priceRangeValue">₱2000 - ₱30000</span>

            <label for="concentrationSelect">Concentration:</label>
            <select id="concentrationSelect">
                <option value="all">All</option>
                <option value="EDP">EDP</option>
                <option value="EDT">EDT</option>
            </select>

            <label for="sizeSelect">Size:</label>
            <select id="sizeSelect">
                <option value="all">All</option>
                <option value="60ml">60ml</option>
                <option value="100ml">100ml</option>
                <option value="150ml">150ml</option>
            </select>
        </div>

        <label for="sortSelect">Sort by:</label>
        <select id="sortSelect">
            <option value="default">Select Sort Option</option>
            <option value="price-low-high">Price: Low to High</option>
            <option value="price-high-low">Price: High to Low</option>
            <option value="alphabetical">Alphabetical: A-Z</option>
            <option value="best-seller">Best Seller</option>
            <option value="old-new">Oldest to Newest</option>
        </select>

        <!-- Products List -->
        <div class="perfume-slider" id="productList">
            <?php
            // Define products array
            $products = [
                ["name" => "Dior Sauvage EDP 100ml", "concentration" => "EDP", "size" => "100ml", "brand" => "Dior", "price" => 7500, "image" => "../images/productsimages/dior-sauvage.png"],
                ["name" => "Versace Eros EDP 200ml", "concentration" => "EDP", "size" => "200ml", "brand" => "Versace", "price" => 8700, "image" => "../images/productsimages/versace-eros.png"],
                ["name" => "Chanel Bleu de Chanel EDP 100ml", "concentration" => "EDP", "size" => "100ml", "brand" => "Chanel", "price" => 9000, "image" => "../images/productsImages/chanel-bleu.png"],
                ["name" => "Creed Aventus 100ml", "concentration" => "EDP", "size" => "100ml", "brand" => "Creed", "price" => 28000, "image" => "../images/productsimages/creed-aventus.png"],
                ["name" => "Prada Luna Rossa Ocean EDP 100ml", "concentration" => "EDP", "size" => "100ml", "brand" => "Prada", "price" => 8500, "image" => "../images/productsimages/prada-lunna-rossa-ocean.png"],
                ["name" => "Yves Saint Laurent Y EDP 60ml", "concentration" => "EDP", "size" => "60ml", "brand" => "Yves Saint Laurent", "price" => 7000, "image" => "../images/productsimages/ysl-y.png"]
            ];

            foreach ($products as $product) {
                echo "<div class='perfume' data-price='" . $product['price'] . "' data-concentration='" . $product['concentration'] . "' data-size='" . $product['size'] . "'>";
                echo "<form method='POST'>";
                echo "<img src='" . $product['image'] . "' alt='" . htmlspecialchars($product['name']) . "'>";
                echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
                echo "<p>Price: ₱" . number_format($product['price'], 2) . "</p>";
                echo "<input type='hidden' name='product_name' value='" . htmlspecialchars($product['name']) . "'>";
                echo "<input type='hidden' name='product_price' value='" . $product['price'] . "'>";
                echo "<button type='submit'>ADD TO CART</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

    <?php include '../php/footer.php'; ?>
    <script src="../javascript/script.js"></script>
</body>
</html>
