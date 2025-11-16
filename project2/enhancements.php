<?php // Prevent access to enhancements.php
    header("Location: index.php");
    exit();
?>
<?php
    // Provide the manager with the ability to select the field on which to sort the order in which the EOI records are displayed.
    $query = "SELECT * FROM eoi"; //The base query for displaying table

    if (!empty($_GET['sort_field'])) { //Check if the fields that are here have been selected.
    
        $allowed = ["EOInumber", "JobRefNo", "FirstName", "LastName", "Email", "Status"]; //Set an array of what fields to use
        $sortField = $_GET['sort_field']; //Get information from the drop down box

        if (in_array($sortField, $allowed, true)) {
            $query .= " ORDER BY $sortField ASC"; //To set query to sort the fields by ascending order
        }
    }

    $result = $conn->query($query); //Activate the query
    if ($result === false) {
        echo "<p class='error'>Query error: " . $conn->error . "</p>";
    } else {
    displayEOITable($result); //Display using the function (Located in manage.php)
    $result->free(); //Free up the value.
    }
?>
<h2>List All EOIs</h2>
<form class="form-box" method="get" action="manage.php">
    <label for="sort_field">Sort by:</label>
    <select name="sort_field" id="sort_field"> <!-- Have a drop down box for selecting fields -->
        <option value="">-- Select Field --</option>
        <option value="EOInumber">EOINo</option>
        <option value="JobRefNo">JobRefNo</option>
        <option value="FirstName">First Name</option>
        <option value="LastName">Last Name</option>
        <option value="Email">Email</option>
        <option value="Status">Status</option>
    </select>
    <input type="submit" value="Sort">
</form>


<?php
// Create a manager registration page with server side validation requiring unique username and a password rule, and store this information in a table.
        $stmt = $conn->prepare("SELECT 1 FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result(); //To check the entire admins table where there is information

        if ($stmt->num_rows > 0) { //If there are usernames that match the username inputted, display unable to take username.
            $message = "This username is already taken.";
        } else {
            $res = $conn->query("SELECT password FROM admins"); //Check for password duplicates
            $passwordExists = false;

            if ($res) {
                while ($row = $res->fetch_assoc()) { //If password exists in database, then show it is unable to be used.
                    if (!$passwordExists && password_verify($password, $row['password'])) {
                        $passwordExists = true;
                    }
                }
            $res->free();
            }

            if ($passwordExists) { //Message for saying password unavailable for use.
                $message = "This password is already in use. Please choose another.";
            }
        }
?>

<?php    
    // Control access to manage.php by checking username and password.
    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $stmt->store_result(); //Check whether username from session exists in database.

    if ($stmt->num_rows !== 1) { //If no, unset the session values and stop the session.
        session_unset();
        session_destroy();
        header("Location: login.php"); //Relocate back to login.
        exit();
    } else {
        $stmt->bind_result($hashed_password);//Get hashed password
        $stmt->fetch();

        if (!password_verify($_SESSION['password'], $hashed_password)) { //If the raw session password from the login page is not verified with the hashed password from database, unset session data and destroy session.
            session_unset();
            session_destroy();
            header("Location: login.php"); //Relocate back to login.
            exit();
        }
    }

    $stmt->close();
?>

<?php

// Set invalid login attempt counter and if invalid 3 times or more, user gets locked out from logging in for 30 seconds.
if (!isset($_SESSION['errorAttempt'])) { //Set errorAttempt values
    $_SESSION['errorAttempt'] = 0;
}

if (isset($_SESSION['lockout_time']) && time() >= $_SESSION['lockout_time']) { //Reset the invalid counters and reset clock time
    unset($_SESSION['lockout_time']);
    $_SESSION['errorAttempt'] = 0;
}

if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) { //Showcase duration needed to wait for invalid trials
    $remaining = $_SESSION['lockout_time'] - time();
    $error = "Too many failed attempts. Please wait {$remaining} seconds before trying again.";
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") { //Get the server to request the information.
    $username = trim($_POST['username']); //clean the input and set username
    $password = $_POST['password']; //set password

    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result(); //compare username with the database username

    if ($stmt->num_rows === 1) { //successful username
        $stmt->bind_result($hashed_password); //check hashed password
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) { //verify the password
            $_SESSION['errorAttempt'] = 0; //Success resets invalid attempt
            unset($_SESSION['lockout_time']); //Unsets lockout duration

            $_SESSION['username'] = $username; //sets session username from user
            $_SESSION['password'] = $password; //sets session password from user
            header("Location:manage.php"); //directs to manage.php
            exit();
        } else {
            $error = "Invalid password."; //Wrong password
            $_SESSION['errorAttempt']++; //invalid tries incremented by 1
        }
    } else {
        $error = "Username not found."; //Wrong username
        $_SESSION['errorAttempt']++; //invalid tries incremented by 1
    }

    $stmt->close();

    if ($_SESSION['errorAttempt'] >= 3) { //Check if failed 3 times
        $_SESSION['lockout_time'] = time() + 30; //sets duration of locked out to 30 seconds
        $error = "Too many failed attempts. Please wait 30 seconds before trying again."; //Display error message
    }
}
?>