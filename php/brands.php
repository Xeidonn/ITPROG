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

    <script>
        const brandsFromDatabase = <?php
        $servername = "localhost";
        $username = "root";
        $password = '';
        $dbname = "scentbonanza";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT DISTINCT PerfumeBrandName AS name, brandImage AS image 
                FROM perfumes 
                WHERE quantity > 0"; // Fetch only brands with products in stock
        $result = $conn->query($sql);

        $brands = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $brands[] = [
                    "name" => htmlspecialchars($row['name']),
                    "image" => htmlspecialchars($row['image'])
                ];
            }
        }
        $conn->close();

        echo json_encode($brands);
        ?>;
    </script>
    <script src="../javascript/brandsscript.js"></script>
</body>
</html>
