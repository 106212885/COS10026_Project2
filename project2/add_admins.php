<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once("settings.php"); 

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $message = "Username and password are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ss", $username, $hashedPassword);
            if ($stmt->execute()) {
                $message = "Admin added successfully.";
            } else {
                $message = "Error adding admin: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Prepare failed: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Admin</title>
</head>
<body>
    <h2>Add Admin</h2>
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST" action="add_admins.php">
        <label>Username: <input type="text" name="username" required></label><br><br>
        <label>Password: <input type="password" name="password" required></label><br><br>
        <button type="submit">Add Admin</button>
    </form>
    <?php
    include_once("footer.inc");
    ?>
</body>
</html>