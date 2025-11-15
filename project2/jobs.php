<?php
include 'header.inc';
include 'nav.inc';
require_once('settings.php');

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    echo "<p>Database connection failure</p>";
} else {
    $query = "SELECT * FROM jobs";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<main class='job-list'>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <section id='" . $row['ref_id'] . "'>
              <h2>" . $row['title'] . "</h2>
              <dl class='job-details'>
                <dt>
                  <strong>" . $row['title'] . "</strong>";

            if ($row['image'] != "") {
                echo "<img src='" . $row['image'] . "' alt='" . $row['title'] . "' class='job-image'>";
            }

            echo "</dt>
                <dd>
                  <strong>Reference ID:</strong> " . $row['ref_id'] . "<br>
                  <strong>Position Title:</strong> " . $row['title'] . "<br>
                  <strong>Position Description:</strong> " . $row['description'] . "<br>
                  <strong>Salary range:</strong> " . $row['salary_range'] . "<br>
                  <a href='#" . $row['ref_id'] . "-details' class='button'>More Details</a><br>
                  <details>
                    <summary id='" . $row['ref_id'] . "-details'></summary>
                    The title of the position to whom the successful applicant will report: " . $row['reporting_manager'] . "<br>
                    " . $row['details'];

            if ($row['references_link'] != "") {
                echo "<br><a href='" . $row['references_link'] . "'>Reference Link</a>";
            }

            echo "</details>
                </dd>
              </dl>
            </section>";
        }

        echo "</main>";
    } else {
        echo "<p>Unable to retrieve jobs data.</p>";
    }

    mysqli_close($conn);
}

include 'footer.inc';
?>
