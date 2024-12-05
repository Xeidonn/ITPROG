<?php
require '../php/dbconnect.php'; // Database connection.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        echo "A password reset link has been sent to your email.";
    } else {
        echo "No account found with that email.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Scent Bonanza</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="login-page">
    <?php include '../php/header.php'; ?>
    <div class="forgot-password-container">
        <h2>FORGOT PASSWORD</h2>
        <p>Enter your email to recover your password:</p>
        <form method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Recover</button>
        </form>
        <a href="../php/login.php">Back to Login</a>
    </div>
</body>
</html>