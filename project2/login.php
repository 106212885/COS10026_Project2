<?php
session_start();
require_once("settings.php");

// 1. Get the connection to database
$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

// 2. Sanitize input and check for relation to database's username and password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // 2.1 Using hashed password for enhanced security
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location: manage.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Username not found.";
    }

    $stmt->close();
}
?>

    <?php include_once("header.inc"); ?>

    <h1>Login</h1>

    <?php include_once("nav.inc"); ?>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form class="form-box" method="post">
        <label class="form-label">Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label class="form-label">Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input class="form-button" type="submit" value="Login">
    </form>

    <?php include_once("footer.inc"); ?>

</body>
</html>
<<<<<<< HEAD
=======

>>>>>>> 088b8c7acb4b2a949754a4ea27adf13a7ee080d0
