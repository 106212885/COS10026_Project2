<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="UTF-8">
        <meta name="description" content="Home page of our cybersecurity company">
        <meta name="keywords" content="cybersecurity, security, IT, protection">
        <meta name="author" content="Quantum Shield's website developers">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Quantum Shield: Your Online Barrier</title>
    </head>
    <body class="index-page">
        <?php
            include 'header.inc';
            include 'nav.inc';
        ?>
        <hr>
        <section class="index-title"> <!--introduction-->
            <h2 class="big-title"><span>Welcome to Quantum Shield,</span></h2>
            <h3 class="first-title"><span>The online barrier that keeps your data secure all across the world.</span></h3>
            <p class="sec-title"><strong>At Quantum Shield, we understand the importance of cybersecurity in today's digital age. <br> Our team of experts is dedicated to providing top-notch security solutions to protect your sensitive information from cyber threats.</strong></p>
            <p class="third-title"><strong><em>Our services include:</em></strong></p>
            <ul class="job-lists">
                <li><strong>Network Security</strong></li>
                <li><strong>Data Encryption</strong></li>
                <li><strong>Threat Detection and Response</strong></li>
                <li><strong>Security Audits</strong></li>
                <li><strong>Employee Training</strong></li>
            </ul>
         <p class="small-title"><strong>We pride ourselves on our commitment to excellence and our ability to stay ahead of the ever-evolving landscape of cybersecurity.</strong></p>
        </section>
        <br>
        <section class="index-title"> <!--Job positions-->
            <h2 class="big-title"><span>Join Our Team</span></h2>
            <p class="small-title"><strong>We are always looking for talented individuals to join our team.<br>If you are passionate about cybersecurity and want to make a difference, we encourage you to explore our current job openings and apply today.</strong></p>
            <p class="third-title"><strong><em>Our job positions include:</em></strong></p>
            <ul class="job-lists">
                <li><strong>Cybersecurity Specialist</strong></li>
                <li><strong>Network Security Engineer</strong></li>
                <li><strong>Cybersecurity Administrator</strong></li>
                <li><strong>Network Administrator</strong></li>
                <li><strong>IT Support Specialist/IT Manager</strong></li>
            </ul> <!--Link to jobs page-->
            <p class="small-title"><strong>We offer competitive salaries, comprehensive benefits, and opportunities for professional growth and development.</strong></p>
            <h2 class="big-title">Visit our</h2>
            <p class="small-title"><strong>Job Details page to learn more about our current openings and how to apply.</strong></p>
            <a href="jobs.html" class="index-button">Job Details</a>
            <h4 class="last-title">Together, we can create a safer digital world for everyone.</h4>
        </section>
        <?php
            include 'footer.inc';
        ?>
    </body>
</html>