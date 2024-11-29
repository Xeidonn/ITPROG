<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Scent Bonanza</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="login-page">
    <?php include '../TEST/header.php'; ?>
    <div class="login-container">
        <h2>LOGIN</h2>
        <form>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Sign In</button>
        </form>
        <a href="../FORGOT-PASSWORD/FORGOT.php">Forgot your password?</a>
        <a href="../SIGNUP/signup.php">Register a New Account</a>
    </div>
</body>
</html>