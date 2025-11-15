<?php
include 'header.inc';
include 'nav.inc';
require_once('settings.php');

// Connect to the MySQL database using settings.php variables
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

// To check if connection failed
if (!$conn) {
    echo "<p>Database connection failure</p>";
} else {
    // SQL query to select all job records from the jobs table
    $query = "SELECT * FROM jobs";
    $result = mysqli_query($conn, $query);

    // If query returns results
    if ($result) {
        echo "<main class='job-list'>";

        // Loop through each row (job record) in the jobs table
        while ($row = mysqli_fetch_assoc($result)) {
            // Start a job section with the job's reference ID as the section ID
            echo "
            <section id='" . $row['ref_id'] . "' class='job'>
                <h2>" . $row['title'] . "</h2>";

            // Display job image if the image field is not empty
            if ($row['image'] != "") {
                echo "<img src='" . $row['image'] . "' alt='" . $row['title'] . "' class='job-image'>";
            }

            // Display job details: reference ID, subtitle, salary, description, reporting manager
            echo "
                <p><strong>Reference ID:</strong> " . $row['ref_id'] . "</p>
                <p><strong>Subtitle:</strong> " . $row['subtitle'] . "</p>
                <p><strong>Salary range:</strong> " . $row['salary_range'] . "</p>
                <p><strong>Position Description:</strong> " . $row['description'] . "</p>
                <p><strong>Reports To:</strong> " . $row['reporting_manager'] . "</p>
                
                <!-- Expandable details section -->
                <details>
                    <summary>More Details</summary>
                    <p>" . $row['details'] . "</p>";

            // Display reference link if available
            if ($row['references_link'] != "") {
                echo "<a href='" . $row['references_link'] . "'>Reference Link</a>";
            }

            // Close details and section
            echo "</details>
            </section>";
        }

        echo "</main>";
    } else {
        // If query failed, show error message
        echo "<p>Unable to retrieve jobs data.</p>";
    }

    mysqli_close($conn);
}

include 'footer.inc';
?>
