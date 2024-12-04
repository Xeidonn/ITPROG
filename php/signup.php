<?php
require '../php/dbconnect.php'; // Database connection.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Scent Bonanza</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="login-page">
    <?php include '../php/header.php'; ?>
    <div class="signup-container">
        <h2>SIGN UP</h2>
        <form method="post">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" required>

            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Sign Up</button>
        </form>
        <a href="../php/login.php">Already have an account?</a>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$first_name, $last_name, $email, $password]);
        // After a certain condition (e.g., user logs in)
        header("Location: ../php/home.php");
        exit;  // Always call exit after the header redirect to ensure the script stops executing.
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>