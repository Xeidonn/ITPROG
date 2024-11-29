<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scent Bonanza - Perfume Catalog</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <?php include '../TEST/header.php'; ?>

    <div id="slideshow">
        <div class="slides">
          <div class="slide active">
            <img src="dior.jpg" alt="Slide 1" style="width:100%; height:100%;">
          </div>
          <div class="slide">
            <img src="versace.jpg" alt="Slide 2" style="width:100%; height:100%;">
          </div>
          <div class="slide">
            <img src="YSL.jpg" alt="Slide 3" style="width:100%; height:100%;">
          </div>
          <div class="slide">
            <img src="roja.jpg" alt="Slide 4" style="width:100%; height:100%;">
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
            $bestSellers = [
                ['img' => 'perfume10.jpg', 'name' => 'Versace Eros EDP 200ml', 'price' => '₱8,700.00'],
                ['img' => 'perfume10.jpg', 'name' => 'Versace Eros EDP 200ml', 'price' => '₱8,700.00'],
                ['img' => 'perfume10.jpg', 'name' => 'Versace Eros EDP 200ml', 'price' => '₱8,700.00'],
                ['img' => 'perfume10.jpg', 'name' => 'Versace Eros EDP 200ml', 'price' => '₱8,700.00'],
                // Add more products here as needed
            ];

            foreach ($bestSellers as $product) {
                echo '<div class="perfume">';
                echo '<img src="' . $product['img'] . '" alt="' . $product['name'] . '">';
                echo '<h3>' . $product['name'] . '</h3>';
                echo '<p>' . $product['price'] . '</p>';
                echo '<button>ADD TO CART</button>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <section class="new-arrivals">
    <h2>NEW ARRIVAL</h2>
    <div class="carousel-container">
    <button class="new-arrivals-prev" onclick="prevNewArrivalsSlide()">&#10094;</button>
        <div class="perfume-slider new-arrivals-slider">
            <div class="carousel-track"></div>
                <div class="perfume2">
                    <img src="perfume6.jpg" alt="INGENIOUS GINGER PERFUME 100ML">
                    <h3>INGENIOUS GINGER PERFUME 100ML</h3>
                    <p>FROM ₱2,160.00</p>
                    <button>ADD TO CART</button>
                </div>
                <div class="perfume2">
                    <img src="perfume7.jpg" alt="SUNSET HOUR PERFUME 100ML">
                    <h3>SUNSET HOUR PERFUME 100ML</h3>
                    <p>FROM ₱2,160.00</p>
                    <button>ADD TO CART</button>
                </div>
                <div class="perfume2">
                    <img src="perfume8.jpg" alt="BOHEMIAN LIME PERFUME 100ML">
                    <h3>BOHEMIAN LIME PERFUME 100ML</h3>
                    <p>FROM ₱2,160.00</p>
                    <button>ADD TO CART</button>
                </div>
                <div class="perfume2">
                    <img src="perfume9.jpg" alt="WOOD INFUSION PERFUME 100ML">
                    <h3>WOOD INFUSION PERFUME 100ML</h3>
                    <p>FROM ₱2,160.00</p>
                    <button>ADD TO CART</button>
                </div>
        </div>
    <button class="new-arrivals-next" onclick="nextNewArrivalsSlide()">&#10095;</button>
    </div>
    </section>

    <?php include '../TEST/footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>
