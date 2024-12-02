<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scent Bonanza - Perfume Catalog</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <h1>SCENT BONANZA</h1>
                <p>Scatter your scent</p>
            </div>
            <nav>
                <a href="../HOME/home.php">HOME</a>
                <a href="../PRODUCTS/products.php">SHOP</a>
                <a href="../BRAND/brands.php">BRANDS</a>
                <a href="../ABOUT-US/about-us.php">ABOUT</a>
                <a href="#">CART (<span id="cartCount"><?php echo isset($_SESSION['cartCount']) ? $_SESSION['cartCount'] : 0; ?></span>)</a>
                <a href="../LOGIN/login.php">LOGIN</a>
            </nav>
        </div>
    </header>