<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands - Scent Bonanza</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../php/header.php'; ?>
    <section class="brands-section">
        <h2>Our Brands</h2>
        <div class="brands-container" id="brandsContainer">
            <!-- Brands will be dynamically loaded here -->
        </div>
    </section>
    <?php include '../php/footer.php'; ?>
    <script src="../javascript/brandsscript.js"></script>
</body>
</html>