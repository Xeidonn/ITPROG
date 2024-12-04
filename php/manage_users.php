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

// Initialize users_result variable for both normal and search queries
$users_result = null;

// Search for users if a search term is provided
$searchTerm = '';
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

// Handle create new user request
if (isset($_POST['create_user'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $is_disabled = 0; // New user will be enabled by default
    
    $create_query = "INSERT INTO users (first_name, last_name, email, password, is_disabled) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($create_query)) {
        $stmt->bind_param("ssssi", $first_name, $last_name, $email, $password, $is_disabled);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "User has been created successfully.";
            header("Location: manage_users.php");  // Redirect after creation
            exit();
        } else {
            $_SESSION['error_message'] = "Failed to create user.";
        }
    }
}

// Handle delete user request
if (isset($_GET['delete_user_id'])) {
    $delete_user_id = $_GET['delete_user_id'];
    $delete_query = "DELETE FROM users WHERE user_id = ?";  // Ensure user_id matches your table structure
    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $delete_user_id);
        $stmt->execute();
        $_SESSION['success_message'] = "User has been deleted successfully.";
        header("Location: manage_users.php");  // Redirect to avoid resubmission
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
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user_data['password'];  // If no password provided, keep the old one
    $is_disabled = $_POST['is_disabled']; // 0 or 1 (enabled/disabled)
    
    $update_query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, is_disabled = ? WHERE user_id = ?";
    if ($stmt = $conn->prepare($update_query)) {
        $stmt->bind_param("ssssii", $first_name, $last_name, $email, $password, $is_disabled, $update_user_id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "User has been updated successfully.";
            header("Location: manage_users.php");  // Redirect after update
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

<!-- Header Section -->
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

<!-- Admin Manage Users Section -->
<section class="dashboard">
    <div class="dashboard-container">
        <h1>Manage Users</h1>

        <!-- Success or Error Message -->
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

        <!-- User Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search users by first name, last name, or email" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- User List Table -->
        <table class="user-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($users_result && $users_result->num_rows > 0) {
                    while ($user = $users_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($user['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']) . "</td>";
                        
                        // Display user status (Enabled/Disabled)
                        $status = $user['is_disabled'] ? 'Disabled' : 'Enabled';
                        echo "<td>" . $status . "</td>";
                        
                        echo "<td>
                            <a href='manage_users.php?edit_user_id=" . $user['user_id'] . "'>Edit</a> |
                            <a href='manage_users.php?delete_user_id=" . $user['user_id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Create New User Form -->
        <h2>Create New User</h2>
        <form method="POST" action="manage_users.php">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="create_user">Create User</button>
        </form>
        

        <!-- Update User Form -->
        <?php if (isset($user_data)): ?>
            <h2>Edit User</h2>
            <form method="POST" action="manage_users.php">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_data['user_id']); ?>">

                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($user_data['first_name']); ?>" required>

                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($user_data['last_name']); ?>" required>

                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>

                <label for="password">Password (Leave empty to keep current)</label>
                <input type="password" name="password">

                <label for="is_disabled">Status</label>
                <select name="is_disabled">
                    <option value="0" <?php echo ($user_data['is_disabled'] == 0) ? 'selected' : ''; ?>>Enabled</option>
                    <option value="1" <?php echo ($user_data['is_disabled'] == 1) ? 'selected' : ''; ?>>Disabled</option>
                </select>

                <button type="submit" name="update_user">Update User</button>
            </form>
        <?php endif; ?>

        <!-- Back to Admin Home Page -->
        <section class="back-to-dashboard">
            <a href="admindashboard.php" class="back-link">Back to Dashboard</a>
        </section>
    </div>
</section>

<?php include '../php/footer.php'; ?>

</body>
</html>
