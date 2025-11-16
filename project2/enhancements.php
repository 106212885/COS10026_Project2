<?php    
    // Check whether username and password is correct.
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
?>

<?php

// Create admins where username and passwords are unique
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
            }
        }
?>

<?php

// Set invalid login attempt counter and if invalid 3 times or more, user gets locked out from logging in for 30 seconds.
if (!isset($_SESSION['errorAttempt'])) {
    $_SESSION['errorAttempt'] = 0;
}

if (isset($_SESSION['lockout_time']) && time() >= $_SESSION['lockout_time']) {
    unset($_SESSION['lockout_time']);
    $_SESSION['errorAttempt'] = 0;
}

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

    if ($_SESSION['errorAttempt'] >= 3) {
        $_SESSION['lockout_time'] = time() + 30;
        $error = "Too many failed attempts. Please wait 30 seconds before trying again.";
    }
}
?>