<?php
require '../php/dbconnect.php'; // Database connection.

session_start(); // Start the session to access session variables.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to find the user by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Store the user's full name in the session
        $_SESSION['user'] = $user['first_name'] . ' ' . $user['last_name'];

        // Redirect to the homepage after a successful login
        header('Location: ../php/home.php');
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Scent Bonanza</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="login-page">
    <?php include '../php/header.php'; ?> <!-- Include header with dynamic login state -->
    <div class="login-container">
        <h2>LOGIN</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Sign In</button>
        </form>
        <a href="../php/forgot.php">Forgot your password?</a>
        <a href="../php/signup.php">Register a New Account</a>
    </div>
</body>
</html>
