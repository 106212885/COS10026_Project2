<?php
session_start();

if (!isset($_SESSION['username'])) { //If username not set, redirect back to login
    header("Location: login.php");
    exit();
} else {
    require_once("settings.php");

    $conn = new mysqli($host, $user, $pwd, $sql_db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows !== 1) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (!password_verify($_SESSION['password'], $hashed_password)) {
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        }
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $message = "Username and password are required.";
    } else {
        $stmt = $conn->prepare("SELECT 1 FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "This username is already taken.";
        } else {
            $res = $conn->query("SELECT password FROM admins");
            $passwordExists = false;

            if ($res) {
                while ($row = $res->fetch_assoc()) {
                    if (!$passwordExists && password_verify($password, $row['password'])) {
                        $passwordExists = true;
                    }
                }
            $res->free();
            }

            if ($passwordExists) {
                $message = "This password is already in use. Please choose another.";
            } else { //Insert the new admin into the admins.sql
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //hash the password and store
                $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)"); //prepare the query
                if ($stmt) {
                    $stmt->bind_param("ss", $username, $hashedPassword); //add the values to the database
                    if ($stmt->execute()) {
                        $message = "Admin added successfully."; //Admin successfully added into database
                    } else {
                        $message = "Error adding admin: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $message = "Prepare failed: " . $conn->error;
                }
            }
        }
    }
}
?>

<?php include_once("header.inc"); ?>
<h1>Add Admin</h1>
<?php include_once("nav.inc"); ?>

<form class="form-box" method="POST" action="add_admins.php"> <!-- form for adding admins -->
    <h1 class="form-title">Add Admins</h1>
    <label class="form-label">Username: </label><br>
    <input type="text" name="username" required><br><br>
    <label class="form-label">Password: </label><br>
    <input type="password" name="password" required><br><br>
    <!-- if there is an error, show the error -->
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <button class="form-button" type="submit">Add Admin</button>
</form>

<?php include_once("footer.inc"); ?>
</body>
</html>