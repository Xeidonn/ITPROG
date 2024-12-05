<?php
session_start();
require '../php/dbconnect.php'; 

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    
    header("Location: ../php/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Scent Bonanza</title>
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
            <?php if (isset($_SESSION["user"])): ?>
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['user']); ?></span>
                <a href="../php/logout.php" class="text-link">Log-out</a>
            <?php else: ?>
                <a href="../php/login.php">Log-in</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<section class="dashboard">
    <div class="dashboard-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></h1>

        <div class="dashboard-cards">
            <div class="card">
                <img src="../images/user.png" alt="User Icon">
                <button class="button" onclick="window.location.href='../php/manage_users.php'">Manage Users</button>
            </div>
            <div class="card">
                <img src="../images/product-icon.png" alt="Perfume Icon">
                <button class="button" onclick="window.location.href='../php/manage_products.php'">Manage Products</button>
            </div>
            <div class="card">
                <img src="../images/order.png" alt="Order Icon">
                <button class="button" onclick="window.location.href='../php/manage_orders.php'">Manage Orders</button>
            </div>
        </div>

    </div>
</section>

<?php include '../php/footer.php'; ?>

</body>
</html>
