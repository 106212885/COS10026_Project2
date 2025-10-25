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
            <section id='{$row['ref_id']}' class='job'>
                <h2>{$row['title']}</h2>
                <img src='{$row['image']}' alt='{$row['title']}' class='job-image'>
                <p><strong>Reference ID:</strong> {$row['ref_id']}</p>
                <p><strong>Salary range:</strong> {$row['salary_range']}</p>
                <p><strong>Position Description:</strong> {$row['description']}</p>
                <p><strong>Reports To:</strong> {$row['manager']}</p>
                <details>
                    <summary>More Details</summary>
                    <p>{$row['details']}</p>
                    <a href='{$row['link']}'>Reference Link</a>
                </details>
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
