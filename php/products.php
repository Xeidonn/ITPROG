<?php
session_start();
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
    </div>

    
        <!-- Products List -->
        <div class="perfume-slider" id="productList">
        </div>
    </section>
    <?php include '../php/footer.php'; ?>
    <script src="../javascript/productsscript.js"></script>
</body>
</html>