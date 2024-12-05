<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scentbonanza";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$users_result = null;
$searchTerm = '';
$sales_report = [];

// Search for users if a search term is provided
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $search_query = "SELECT * FROM users WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ?";
    $stmt = $conn->prepare($search_query);
    $searchTerm = '%' . $searchTerm . '%';  // Add wildcards for searching
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $users_result = $stmt->get_result();
} else {
    // Fetch all users if no search term
    $query = "SELECT * FROM users";
    $users_result = $conn->query($query);
}

// Generate sales report
if (isset($_POST['generate_report'])) {
    $report_query = "SELECT 
                        COUNT(*) AS total_orders, 
                        SUM(total_amount) AS total_sales, 
                        COUNT(CASE WHEN status = 'Completed' THEN 1 END) AS completed_orders 
                     FROM orders";
    $report_result = $conn->query($report_query);
    if ($report_result) {
        $sales_report = $report_result->fetch_assoc();
    } else {
        $_SESSION['error_message'] = "Failed to generate sales report.";
    }
}

// Handle create new user request
if (isset($_POST['create_user'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $is_disabled = 0; // New user will be enabled by default

    $create_query = "INSERT INTO users (first_name, last_name, email, password, is_disabled) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($create_query)) {
        $stmt->bind_param("ssssi", $first_name, $last_name, $email, $password, $is_disabled);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "User has been created successfully.";
            header("Location: manage_users.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Failed to create user.";
        }
    }
}

// Handle delete user request
if (isset($_GET['delete_user_id'])) {
    $delete_user_id = $_GET['delete_user_id'];
    $delete_query = "DELETE FROM users WHERE user_id = ?";
    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $delete_user_id);
        $stmt->execute();
        $_SESSION['success_message'] = "User has been deleted successfully.";
        header("Location: manage_users.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Failed to delete user.";
    }
}

// Handle update user request
if (isset($_GET['edit_user_id'])) {
    $edit_user_id = $_GET['edit_user_id'];
    $query = "SELECT * FROM users WHERE user_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $edit_user_id);
        $stmt->execute();
        $user_result = $stmt->get_result();
        $user_data = $user_result->fetch_assoc();
    }
}

if (isset($_POST['update_user'])) {
    $update_user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user_data['password'];
    $is_disabled = $_POST['is_disabled'];

    $update_query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, is_disabled = ? WHERE user_id = ?";
    if ($stmt = $conn->prepare($update_query)) {
        $stmt->bind_param("ssssii", $first_name, $last_name, $email, $password, $is_disabled, $update_user_id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "User has been updated successfully.";
            header("Location: manage_users.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Failed to update user.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Scent Bonanza</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo">
            <h1>SCENT BONANZA</h1>
            <p>Scatter your scent</p>
        </div>
        <nav>
            <?php if (isset($_SESSION["user"])): ?>
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['user']); ?></span>
                <a href="../php/logout.php" class="text-link">Log-out</a>
            <?php else: ?>
                <a href="../php/login.php">Log-in</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<section class="dashboard">
    <div class="dashboard-container">
        <h1>Manage Users</h1>

        <!-- Success or Error Messages -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['success_message']; ?>
                <?php unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error_message']; ?>
                <?php unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>

        <!-- Sales Report Section -->
        <h2>Sales Report</h2>
        <form method="POST">
            <button type="submit" name="generate_report">Generate Sales Report</button>
        </form>

        <?php if (!empty($sales_report)): ?>
            <div class="sales-report">
                <p><strong>Total Orders:</strong> <?php echo htmlspecialchars($sales_report['total_orders']); ?></p>
                <p><strong>Total Sales:</strong> $<?php echo htmlspecialchars(number_format($sales_report['total_sales'], 2)); ?></p>
                <p><strong>Completed Orders:</strong> <?php echo htmlspecialchars($sales_report['completed_orders']); ?></p>
            </div>
        <?php endif; ?>

        <!-- User Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search users by first name, last name, or email" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- User Table -->
        <table class="user-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users_result && $users_result->num_rows > 0): ?>
                    <?php while ($user = $users_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo $user['is_disabled'] ? 'Disabled' : 'Enabled'; ?></td>
                            <td>
                                <a href="manage_users.php?edit_user_id=<?php echo htmlspecialchars($user['user_id']); ?>">Edit</a> |
                                <a href="manage_users.php?delete_user_id=<?php echo htmlspecialchars($user['user_id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="footer">
    <div class="copyright">
         &copy; <?php echo date("Y"); ?>, Scent Bonanza
    </div>
</section>
</body>
</html>