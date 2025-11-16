<?php
session_start();
require_once("settings.php");

// Connect to database
$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

// Initialize attempt counter
if (!isset($_SESSION['errorAttempt'])) {
    $_SESSION['errorAttempt'] = 0;
}

// If lockout expired, reset attempts
if (isset($_SESSION['lockout_time']) && time() >= $_SESSION['lockout_time']) {
    unset($_SESSION['lockout_time']);
    $_SESSION['errorAttempt'] = 0;
}

// If still locked out
if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
    $remaining = $_SESSION['lockout_time'] - time();
    $error = "Too many failed attempts. Please wait {$remaining} seconds before trying again.";
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Success: reset attempts and lockout
            $_SESSION['errorAttempt'] = 0;
            unset($_SESSION['lockout_time']);

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location:manage.php");
            exit();
        } else {
            $error = "Invalid password.";
            $_SESSION['errorAttempt']++;
        }
    } else {
        $error = "Username not found.";
        $_SESSION['errorAttempt']++;
    }

    $stmt->close();

    // If 3 or more failed attempts, set lockout
    if ($_SESSION['errorAttempt'] >= 3) {
        $_SESSION['lockout_time'] = time() + 30; // 30 seconds lockout
        $error = "Too many failed attempts. Please wait 30 seconds before trying again.";
    }
}
?>

<?php include_once("header.inc"); ?>

<h1>Login</h1>

<?php include_once("nav.inc"); ?>

<form class="form-box" method="post">
    <h1 class="form-title">Login</h1>
    <label class="form-label">Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label class="form-label">Password:</label><br>
    <input type="password" name="password" required><br><br>

    <?php
    if ($error) {
        echo '<p class="error">' . $error . '</p>';
    }
    ?>
    <input class="form-button" type="submit" value="Login">
</form>

<?php include_once("footer.inc"); ?>
</body>
</html>