<?php
session_start();

// 1. For handling logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// 2. Checking if the admin is set.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
else{
    // 3. Load database settings
    require_once("settings.php");

    $conn = new mysqli($host, $user, $pwd, $sql_db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 3.1 enhancements: Check whether username and password is correct.
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

// 4. Handle form actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 4.1 Delete EOIs by JobRefNo
    if (!empty($_POST['delete_jobrefno'])) {
        $jobref = $_POST['delete_jobrefno'];
        $stmt = $conn->prepare("DELETE FROM eoi WHERE JobRefNo = ?");
        $stmt->bind_param("s", $jobref);
        $stmt->execute();
        echo "<p>Deleted EOIs for JobRefNo: " . $jobref . "</p>";
        $stmt->close();
    }

    // 4.2 Update EOI status by Email
    if (!empty($_POST['update_status_email']) && isset($_POST['new_status']) && $_POST['new_status'] !== "") {
        $email = $_POST['update_status_email'];
        $status = $_POST['new_status'];
        $stmt = $conn->prepare("UPDATE eoi SET Status = ? WHERE Email = ?");
        $stmt->bind_param("ss", $status, $email);
        $stmt->execute();

        echo "<p>Updated status for applicant with email: " . $email . "</p>";
        echo "<p>Rows updated: " . $stmt->affected_rows . "</p>";

        $stmt->close();
    } elseif (isset($_POST['new_status']) && $_POST['new_status'] === "") {
        echo "<p style='color:red;'>Please select a valid status.</p>";
    }
}

// 5. Display EOIs in a table
function displayEOITable($result) {
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>
                <th>JobRefNo</th><th>FirstName</th><th>LastName</th>
                <th>StreetAddress</th><th>Suburb</th><th>State</th><th>Postcode</th>
                <th>Email</th><th>Phone</th><th>Skills</th><th>OtherSkills</th><th>Status</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['JobRefNo'] . "</td>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['StreetAddress'] . "</td>";
            echo "<td>" . $row['Suburb'] . "</td>";
            echo "<td>" . $row['State'] . "</td>";
            echo "<td>" . $row['Postcode'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td>" . $row['Phone'] . "</td>";
            echo "<td>" . implode(", ", array_filter([
                $row['Skill1'], $row['Skill2'], $row['Skill3'], $row['Skill4'], $row['Skill5']
            ])) . "</td>";
            echo "<td>" . $row['OtherSkills'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No results found.</p>";
    }
}
?>


 <?php include_once("header.inc"); ?>

    <h1>Manage</h1>

    <?php include_once("nav.inc"); ?>

    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

    <!-- Logout Button -->
    <form method="post">
        <input type="submit" name="logout" value="Logout">
    </form>

    <section class="manage-title">
    <h2>List All EOIs</h2>
    <?php
    $result = $conn->query("SELECT * FROM eoi");
    displayEOITable($result);
    ?>

    <h2>Search EOIs by JobRefNo</h2>
    <form class = "form-box" method="get">
        <input type="text" name="jobref_search" placeholder="JobRefNo">
        <input type="submit" value="Search">
    </form>
    <?php
    if (!empty($_GET['jobref_search'])) {
        $jobref = $_GET['jobref_search'];
        $stmt = $conn->prepare("SELECT * FROM eoi WHERE JobRefNo = ?");
        $stmt->bind_param("s", $jobref);
        $stmt->execute();
        $result = $stmt->get_result();
        displayEOITable($result);
        $stmt->close();
    }
    ?>

    <h2>Search EOIs by Applicant Name</h2>
    <form class="form-box" method="get">
        <input type="text" name="fname" placeholder="First Name">
        <input type="text" name="lname" placeholder="Last Name">
        <input type="submit" value="Search">
    </form>
    <?php
    if (!empty($_GET['fname']) || !empty($_GET['lname'])) {
        $query = "SELECT * FROM eoi WHERE ";
        $params = [];
        $types = "";

        if (!empty($_GET['fname'])) {
            $query .= "FirstName = ?";
            $params[] = $_GET['fname'];
            $types .= "s";
        }

        if (!empty($_GET['lname'])) {
            if (!empty($_GET['fname'])) {
                $query .= " AND ";
            }
            $query .= "LastName = ?";
            $params[] = $_GET['lname'];
            $types .= "s";
        }

        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        displayEOITable($result);
        $stmt->close();
    }
    ?>

    <h2>Delete EOIs by JobRefNo</h2>
    <form class = "form-box" method="post">
        <input type="text" name="delete_jobrefno" placeholder="JobRefNo to delete">
        <input type="submit" value="Delete">
    </form>

    <h2>Update EOI Status by Email</h2>
    <form class = "form-box" method="post">
        <input type="email" name="update_status_email" placeholder="Applicant Email" required>
        <select name="new_status" required>
            <option value="">-- Select Status --</option>
            <option value="NEW">NEW</option>
            <option value="CURRENT">CURRENT</option>
            <option value="FINAL">FINAL</option>
        </select>
        <input type="submit" value="Update">
    </form>

    </section>
    <?php include_once("footer.inc"); ?>

</body>
</html>
