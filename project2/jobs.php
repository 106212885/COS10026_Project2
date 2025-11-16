<?php
include 'header.inc';
?>

<h1>Job Positions</h1>

<?php
include 'nav.inc';
require_once('settings.php');
?>

<!--Animation - SPAN function-->
<section class="job-positions">
<h2>
    We're Hiring  
    <span>
        <span>CYBERSECURITY SPECIALIST</span>
        <span>NETWORK SECURITY ENGINEER</span>
        <span>CYBERSECURITY ANALYST</span>
        <span>NETWORK ADMINISTRATOR</span>
        <span>IT SUPPORT SPECIALIST</span>
    </span>
</h2>

<!--Intro - Image slides-->
<main class="slider-track">

  <article class="slider-container">
    <div class="slider-images">
      <div class="slider-img">
        <a href="#cybersecurity-specialist">
          <img src="images/cs288.jpg" alt="Cybersecurity Specialist">
        </a>
        <div class="details">
          <span class="category">CS288</span>
          <h3>Cybersecurity Specialist</h3>
          <p class="subtitle">Security Is Not Just Code—It's Confidence.</p>
        </div>
      </div>
    </div>
  </article>

  <article class="slider-container">
    <div class="slider-images">
      <div class="slider-img">
        <a href="#network-security-engineer">
          <img src="images/ne911.jpg" alt="Network Security Engineer">
        </a>
        <div class="details">
          <span class="category">NE911</span>
          <h3>Network Security Engineer</h3>
          <p class="subtitle">Fortifying Connections, Securing Every Byte.</p>
        </div>
      </div>
    </div>
  </article>

  <article class="slider-container">
    <div class="slider-images">
      <div class="slider-img">
        <a href="#cybersecurity-analyst">
          <img src="images/ca098.jpeg" alt="Cybersecurity Analyst">
        </a>
        <div class="details">
          <span class="category">CA098</span>
          <h3>Cybersecurity Analyst</h3>
          <p class="subtitle">Decoding Threats, Delivering Peace of Mind.</p>
        </div>
      </div>
    </div>
  </article>

  <article class="slider-container">
    <div class="slider-images">
      <div class="slider-img">
        <a href="#network-administrator">
          <img src="images/na718.jpg" alt="Network Administrator">
        </a>
        <div class="details">
          <span class="category">NA718</span>
          <h3>Network Administrator</h3>
          <p class="subtitle">Keeping Systems Synced, Secure, and Seamless.</p>
        </div>
      </div>
    </div>
  </article>

  <article class="slider-container">
    <div class="slider-images">
      <div class="slider-img">
        <a href="#itsupport-specialist">
          <img src="images/im404.png" alt="IT Support Specialist">
        </a>
        <div class="details">
          <span class="category">IM404</span>
          <h3>IT Support Specialist</h3>
          <p class="subtitle">Tech That Works, Support That Listens.</p>
        </div>
      </div>
    </div>
  </article>

</main>

<!--Aside, easy access for users-->
<aside>
    <p><strong>Recruiting Talent</strong></p>
        <ul>
            <li><a href="#cybersecurity-specialist">Cybersecurity Specialist</a></li>
            <li><a href="#network-security-engineer">Network Security Engineer</a></li>
            <li><a href="#cybersecurity-analyst">Cybersecurity Analyst</a></li>
            <li><a href="#network-administrator">Network Administrator</a></li>
            <li><a href="#itsupport-specialist">IT Support Specialist/ IT Manager</a></li>
        </ul>
    <p><strong>Submit your CV</strong></p>
    <a href="apply.php">Application Form</a>
</aside>

<?php
// connects my sql database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

// if connection fails, show error message and stop execution
if (!$conn) {
    echo "<p>Database connection failure</p>";
    // gets all job records from the jobs table
} else {
    $query = "SELECT * FROM jobs";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<main class='job-list'>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <section id='" . $row['ref_id'] . "'>
              <dl class='job-details'>
                <dt>
                  <strong>" . $row['title'] . "</strong>";

            // show job image
            if ($row['image'] != "") {
                echo "<img src='" . $row['image'] . "' alt='" . $row['title'] . "' class='job-image background-image'>";
            }

            // job info
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

            // adds a clickable reference link
            if ($row['references_link'] != "") {
                echo "<br><a href='" . $row['references_link'] . "'>Reference Link</a>";
            }

            echo "</details>
                </dd>
              </dl>
            </section>";
        }

        echo "</main>";
    // if query failed, then show the error message
    } else {
        echo "<p>Unable to retrieve jobs data.</p>";
    }

    mysqli_close($conn);
}
?>

<!--Animation - Closing Lines-->
<section class="job-positions">
<h3>
    Interested? <br> Think you're the right fit?   
    <span>
        <span>VISIT OUR APPLICATION PAGE</span>
        <span>& SUBMIT YOUR APPLICATION TODAY!</span>
        <span>WE ARE EXCITED TO WELCOME MOTIVATED INDIVIDUALS TO OUR TEAM!</span>
    </span>
</h3>
</section>


<?php
include 'footer.inc';
?>
