<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Scent Bonanza</title>
    <link rel="stylesheet" href="../CSS/style.css">>
</head>
<body class="login-page">
    <?php include '../TEST/header.php'; ?>
    <div class="forgot-password-container">
        <h2>FORGOT PASSWORD</h2>
        <p>Enter your email to recover your password:</p>
        <form>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Recover</button>
        </form>
        <a href="../LOGIN/login.php">Back to Login</a>
    </div>
</body>
</html>