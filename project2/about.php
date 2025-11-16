<?php
include 'header.inc';
include 'nav.inc';
?>
<link rel="stylesheet" href="about.css">


<main class="about-page">

    <!-- Group Name -->
    <section class="group-name">
        <h2>Quantum Shield Team</h2>
    </section>

    <!-- Row 1 -->
    <section class="top-row">

        <!-- Group Introduction -->
<div class="group-introduction">
    <h2>Group Introduction</h2>
    <p>
        We are Quantum Shield, a dedicated team of cybersecurity enthusiasts committed to safeguarding digital environments. 
        Our mission is to design innovative and reliable solutions that strengthen system defenses, protect sensitive data, 
        and ensure the resilience of networks against evolving threats. With collaboration, creativity, and technical expertise, 
        we strive to make the digital world a safer place.
    </p>
    <p>
        As a team, we believe that cybersecurity is not just about technology, but also about people and trust. 
        We emphasize continuous learning, adapting to new challenges, and sharing knowledge to empower others. 
        Each member brings unique strengths from coding and system design to project management and creative problem solving  
        which allows us to approach issues from multiple perspectives.
    </p>
    <p>
        Beyond technical skills, we value teamwork, communication, and innovation. 
        We enjoy brainstorming new ideas, experimenting with emerging tools, and pushing boundaries to create solutions 
        that are both practical and forward-looking. Our vision is to contribute to a safer digital future where individuals 
        and organizations can thrive without fear of cyber threats.
    </p>
    <p>
        Looking ahead, Quantum Shield aims to expand our expertise in areas such as artificial intelligence, 
        ethical hacking, and secure software development. By combining passion with professionalism, 
        we are determined to make a lasting impact in the field of cybersecurity.
    </p>
</div>


        <!-- Group Members -->
        <div class="group-members">
            <h2>Group Members</h2>
            <ul>
                <li>Ngoi Ye Sheng <span class="student-id">106213105</span></li>
                <li>Tan Qiao En <span class="student-id">106212885</span></li>
                <li>Daniel Yong Tze Ming <span class="student-id">106213024</span></li>
                <li>Wong Joe Yee <span class="student-id">106212966</span></li>
            </ul>
        </div>
    </section>

    <section>
        <!-- Contributions -->
        <div class="members-contributions">
            <h2>Members' Contributions</h2>

<dl>

    <dt>Ngoi Ye Sheng</dt>
    <dd>
        Contributed to the development of about.html, ensuring structured content and proper integration with CSS for styling consistency.
        Worked on styles.css to enhance the website's overall layout, responsiveness, and visual appeal.  
        Actively participated in the Jira project by helping with task tracking, updating progress, and ensuring deadlines were met.  
        In Project Part 2, updated and converted the About page into about.php, implemented PHP includes, and handled group contribution documentation.
    </dd>

    <dt>Tan Qiao En</dt>
    <dd>
        Designed and implemented the jobs.html page, presenting job listings with clear formatting and user-friendly structure.  
        Contributed to CSS styling to improve readability, background, and visual hierarchy across the site.  
        Engaged in Jira project management, monitoring progress and collaborating with team members to maintain workflow efficiency.  
        In Project Part 2, created the settings.php configuration file and developed the jobs.sql database script for storing job information.
    </dd>

    <dt>Daniel Yong Tze Ming</dt>
    <dd>
        Developed the index.html homepage, focusing on clear navigation, engaging layout, and accessibility.  
        Assisted in CSS design to ensure a cohesive theme across all web pages.  
        Used Jira for project coordination, updating task statuses and assisting in organizing sprint deliverables.  
        In Project Part 2, implemented the manage.php page with advanced EOI management features and contributed to the enhancements.php documentation.
    </dd>

    <dt>Wong Joe Yee</dt>
    <dd>
        Created the apply.html page, implementing structured forms for user input and ensuring proper validation design.  
        Supported CSS design work to maintain consistent styling with the rest of the website.  
        Contributed to the Jira project board, collaborating with the team to track issues and ensure smooth project progress.  
        In Project Part 2, developed the eoi.sql database structure and implemented process_eoi.php for validating and inserting EOI submissions.
    </dd>

</dl>

        </div>

        <!-- Group Photo -->
        <div class="group-photo">
            <h2>Group Photo</h2>
            <figure>
                <figcaption>Our team during project discussion</figcaption>
                <a href="images/group-photo.jpg">
                    <img src="images/group-photo.jpg" 
                         alt="Quantum Shield Team project group photo" 
                         title="Click to view larger image">
                </a>
            </figure>
        </div>
    </section>

    <!-- Row 2 -->
    <section class="middle-row">

        <!-- Working Experience -->
        <div class="working-experience">
            <h2>Working Experience</h2>

            <h3>Ngoi Ye Sheng</h3>
            <ul>
                <li>Impactlution (2022 - present) - CSR Project Leader</li>
                <li>Yomie Rice x Yogurt (2020 - 2021) - Barista & Cashier</li>
                <li>Ahdi Greens (2016 - present) - Grocery Assistant</li>
                <li>Atcen (2025 - present) - Assistant Trainer</li>
            </ul>

            <h3>Tan Qiao En</h3>
            <ul>
                <li>Cafe staff/server (Jan 2022 - present)</li>
                <li>Banquet VVIP staff/server (Mar 2022 - present)</li>
                <li>Buggy Driver (Jan 2025 - present)</li>
                <li>PA System / Sound & Lighting (Aug 2025 - present)</li>
                <li>Daycare Teacher (May - Aug 2024)</li>
                <li>Event Crew (Jun 2024)</li>
                <li>Promoter (Apr - Jun 2024)</li>
                <li>Sales Team (Jan 2024)</li>
                <li>Electrical Engineering (Feb 2024)</li>
            </ul>

            <h3>Daniel Yong Tze Ming</h3>
            <ul>
                <li>Freelance video editor</li>
                <li>Freelance coder</li>
            </ul>

            <h3>Wong Joe Yee</h3>
            <ul>
                <li>Service Crew (Mar - Apr 2024)</li>
                <li>Teaching Assistant (May - Jun 2024)</li>
                <li>Accounts Clerk (Mar 2025 - present)</li>
            </ul>
        </div>

        <!-- Member Interests -->
        <div class="members-interests">
            <h2>Members' Interests</h2>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Interest</th>
                        <th scope="col">Extra Hobby</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ngoi Ye Sheng</td>
                        <td>Bodybuilding</td>
                        <td>Movies</td>
                    </tr>
                    <tr>
                        <td>Tan Qiao En</td>
                        <td>Swimming</td>
                        <td>Skateboarding</td>
                    </tr>
                    <tr>
                        <td>Daniel Yong Tze Ming</td>
                        <td>Gaming</td>
                        <td>Taking naps</td>
                    </tr>
                    <tr>
                        <td>Wong Joe Yee</td>
                        <td>Editing videos</td>
                        <td>Badminton</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </section>

    <!-- Row 3 -->
    <section class="bottom-row">
        <div class="our-timetable">
            <h2>Our Swinburne Timetable</h2>
            <table>
                <tr>
                    <th>Time</th>
                    <th>08:00</th>
                    <th>09:00</th>
                    <th>10:00</th>
                    <th>11:00</th>
                    <th>12:00</th>
                    <th>13:00</th>
                    <th>14:00</th>
                    <th>15:00</th>
                    <th>16:00</th>
                    <th>17:00</th>
                </tr>

                <!-- MONDAY -->
                <tr>
                    <td><b>MON</b></td>
                    <td colspan="2" class="course">COS10009 C1<br>(G-R2.5)<br>[LECTURE]</td>
                    <td colspan="2"></td>
                    <td colspan="2" class="course">MAT2208 C1<br>(F-CUBE4&5)<br>[LECTURE]</td>
                    <td colspan="2" class="course">COS10004 C1<br>(F-CUBE4&5)<br>[LECTURE]</td>
                    <td colspan="2"></td>
                </tr>

                <!-- TUESDAY -->
                <tr>
                    <td><b>TUE</b></td>
                    <td colspan="2"></td>
                    <td colspan="2" class="course">COS10009 C1<br>(C-L2-MAC2)<br>[PRACTICAL]</td>
                    <td colspan="2" class="course">COS10004 C1<br>(C-L-L2-MAC2)<br>[PRACTICAL]</td>
                    <td colspan="2"></td>
                    <td colspan="2" class="course">COS10026 C1<br>(F-CUBE4&5)<br>[LECTURE]</td>
                </tr>

                <!-- WEDNESDAY -->
                <tr>
                    <td><b>WED</b></td>
                    <td colspan="2"></td>
                    <td colspan="2" class="course">TNE10006 C2<br>(A-L4-LH1)<br>[LECTURE]</td>
                    <td colspan="2" class="course">COS10026 C1<br>(A-L4-CSC2)<br>[PRACTICAL]</td>
                    <td colspan="4"></td>
                </tr>

                <!-- THURSDAY -->
                <tr>
                    <td><b>THU</b></td>
                    <td colspan="3"></td>
                    <td colspan="3" class="course">TNE10006 C2<br>(G-CISCO LAB)<br>[PRACTICAL]</td>
                    <td colspan="2"></td>
                    <td colspan="2" class="course">MAT2208 C1<br>(G-R2.5)<br>[LECTURE & TUTORIAL]</td>
                </tr>

                <!-- FRIDAY -->
                <tr>
                    <td><b>FRI</b></td>
                    <td colspan="10"></td>
                </tr>

                <!-- SATURDAY -->
                <tr>
                    <td><b>SAT</b></td>
                    <td colspan="10"></td>
                </tr>

                <!-- SUNDAY -->
                <tr>
                    <td><b>SUN</b></td>
                    <td colspan="10"></td>
                </tr>

            </table>
        </div>
    </section>

</main>

<?php
include("footer.inc");
?>
