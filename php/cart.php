<?php
session_start();
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
                <!-- Cart items will be dynamically added here from cart.js -->
            </div>
            <div class="cart-total">
                <h3>Total Items: <span id="cartTotalItems">0</span></h3>
                <h3>Total Price: <span id="cartTotalPrice">$0</span></h3>
            </div>
            <button class="close">Close Cart</button>
        </div>
    </section>
    <script src="../javascript/script.js"></script>
    <script src="../javascript/cart.js"></script>
</body>
</html>
