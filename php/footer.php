<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scent Bonanza - Perfume Catalog</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<section class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h4>SCENT BONANZA</h4>
                <ul>
                    <li><a href="../php/about-us.php">About Us</a></li>
                    <li><a href="../php/brands.php">Our Brands</a></li>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">The Stores</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>INFO</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Returns Policy</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Shipping Policies</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>STAY UP TO DATE</h4>
                <p>Subscribe to our newsletter to receive exclusive news about our new items and promotions.</p>
                <form action="subscribe.php" method="post">
                    <input type="email" name="email" placeholder="Enter your email">
                    <button type="submit">OK</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            &copy; <?php echo date("Y"); ?>, Scent Bonanza
        </div>
    </section>