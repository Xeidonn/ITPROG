<?php require '../php/dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scent Bonanza - Perfume Catalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <h1>SCENT BONANZA</h1>
                <p>Scatter your scent</p>
            </div>
            <nav>
                <a href="../php/home.php">HOME</a>
                <a href="../php/products.php">SHOP</a>
                <a href="../php/brands.php">BRANDS</a>
                <a href="../php/about-us.php">ABOUT</a>

                <a href="../php/cart.php">CART (<span id="cartCount"><?php echo isset($_SESSION['cartCount']) ? $_SESSION['cartCount'] : 0; ?></span>)</a>

                <?php if (isset($_SESSION["user"])): ?>
                    <span class="user-name"><?php echo htmlspecialchars($_SESSION['user']); ?></span>
                    <a href="../php/logout.php" class="text-link">Log-out</a>
                <?php else: ?>
                    <a href="../php/login.php">Log-in</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
</body>

</html>
