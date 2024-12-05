<?php
session_start(); // Start the session at the very top

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
    <title>Scent Bonanza - Perfume Catalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../php/header.php'; ?>

    <div id="slideshow">
        <!-- Your slideshow code -->
        <div class="slides">
          <div class="slide active">
            <img src="../images/dior-banner.jpg" alt="Slide 1" style="width:100%; height:100%;">
          </div>
          <div class="slide">
            <img src="../images/versace-banner.jpg" alt="Slide 2" style="width:100%; height:100%;">
          </div>
          <div class="slide">
            <img src="../images/YSL-banner.jpg" alt="Slide 3" style="width:100%; height:100%;">
          </div>
          <div class="slide">
            <img src="../images/roja-banner.jpg" alt="Slide 4" style="width:100%; height:100%;">
          </div>
        </div>
        <div class="navigation">
          <span class="dot active"></span>
          <span class="dot"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
    </div>

    <section class="banner">
        <h2>BEST SELLERS</h2>
        <div class="perfume-slider best-seller-slider">
            <?php
            // Array of best sellers
            $bestSellers = [
                ['img' => '../images/perfume5.jpg', 'name' => 'Versace Eros EDP 100ml', 'price' => '₱6,720.00'],
                ['img' => '../images/dior-sauvage-100ml.jpg', 'name' => 'Dior Sauvage EDT 100ml', 'price' => '₱6,160.00'],
                ['img' => '../images/dior-sauvage-edp-100ml.jpg', 'name' => 'Dior Sauvage EDP 100ml', 'price' => '₱7.280.00'],
                ['img' => '../images/perfume10.jpg', 'name' => 'YSL Y EDT 100ml', 'price' => '₱6,720.00'],
            ];

            // Loop through each product and display it in a form
            foreach ($bestSellers as $product) {
                echo "<div class='perfume'>";
                echo "<form method='POST'>";
                echo "<img src='" . $product['img'] . "' alt='" . htmlspecialchars($product['name']) . "'>";
                echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
                echo "<p>" . htmlspecialchars($product['price']) . "</p>";

                // Add hidden fields for product name and price
                echo "<input type='hidden' name='product_name' value='" . htmlspecialchars($product['name']) . "'>";
                echo "<input type='hidden' name='product_price' value='" . htmlspecialchars($product['price']) . "'>";

                // Add to Cart button
                echo "<button type='submit'>ADD TO CART</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

    <section class="new-arrivals">
        <h2>NEW ARRIVAL</h2>
        <div class="carousel-container">
            <button class="new-arrivals-prev" onclick="prevNewArrivalsSlide()">&#10094;</button>
            <div class="perfume-slider new-arrivals-slider">
                <?php
                // Array of new arrivals
                $newArrivals = [
                    ['img' => '../images/perfume6.jpg', 'name' => 'INGENIOUS GINGER PERFUME 100ML', 'price' => '₱2,160.00'],
                    ['img' => '../images/perfume7.jpg', 'name' => 'SUNSET HOUR PERFUME 100ML', 'price' => '₱2,160.00'],
                    ['img' => '../images/perfume8.jpg', 'name' => 'BOHEMIAN LIME PERFUME 100ML', 'price' => '₱2,160.00'],
                    ['img' => '../images/perfume9.jpg', 'name' => 'WOOD INFUSION PERFUME 100ML', 'price' => '₱2,160.00'],
                ];

                // Loop through each new arrival product and display it in a form
                foreach ($newArrivals as $product) {
                    echo "<div class='perfume2'>";
                    echo "<form method='POST'>";
                    echo "<img src='" . $product['img'] . "' alt='" . htmlspecialchars($product['name']) . "'>";
                    echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
                    echo "<p>" . htmlspecialchars($product['price']) . "</p>";

                    // Add hidden fields for product name and price
                    echo "<input type='hidden' name='product_name' value='" . htmlspecialchars($product['name']) . "'>";
                    echo "<input type='hidden' name='product_price' value='" . htmlspecialchars($product['price']) . "'>";

                    // Add to Cart button
                    echo "<button type='submit'>ADD TO CART</button>";
                    echo "</form>";
                    echo "</div>";
                }
                ?>
            </div>
            <button class="new-arrivals-next" onclick="nextNewArrivalsSlide()">&#10095;</button>
        </div>
    </section>

    <?php include '../php/footer.php'; ?>
    <script src="../javascript/script.js"></script>
</body>
</html>
