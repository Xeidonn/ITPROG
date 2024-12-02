<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Scent Bonanza</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="login-page">
    <?php include '../TEST/header.php'; ?>
    <div class="signup-container">
        <h2>SIGN UP</h2>
        <form>
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" required>

            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>

            <button type="submit">Sign Up</button>
        </form>
        <a href="../LOGIN/login.php">Already have an account?</a>
    </div>
</body>
</html>