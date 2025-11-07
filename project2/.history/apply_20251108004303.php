<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="UTF-8">
        <meta name="description" content="Job Details page of our cybersecurity company">
        <meta name="keywords" content="cybersecurity, security, IT, protection">
        <meta name="author" content="Quantum Shield's website developers">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Application Page</title>
    </head>

    <body>
        <!-- Company Logo and Navigation Bar  -->
        <header>
            <img src= "images/Quantum_Shield_Logo.png" alt="Quantum Shield Logo" class="logo">
            <h1>
                Job Application
            </h1>
            <nav>
            <a href="index.html">Home</a> |
            <a href="jobs.html">Job Details</a> |
            <a href="apply.html">Application Form</a> |
            <a href="about.html">About Us</a> |
            <a href="mailto:info@quantumshield.com.au">Contact Us</a>
        </nav>
        </header>

        <hr>

        <!-- Job Application Form -->
        <form class="form-box" method="post" action="https://mercury.swin.edu.au/it000000/formtest.php" >

            <h1 class="form-title">Job Application</h1>

            <!-- Job References Numbers  -->
            <p class="form-details">
                <label for="Job_ref_num" class="form-label-required">Job reference number </label>
                    <select name="Job_ref_num" id="Job_ref_num" required="required">
                        <option value="" selected>Please Select</option>
                        <option value="CS288">CS288 | CYBERSECURITY SPECIALIST</option>			
                        <option value="NE911">NE911 | NETWORK SECURITY ENGINEER</option>
                        <option value="CA098">CA098 | CYBERSECURITY ANALYST</option>
                        <option value="NA718">NA718 | NETWORK ADMINISTRATOR</option>
                        <option value="IM404">IM404 | IT SUPPORT SPECIALIST</option>				
                    </select>
            
            <!-- First Name, Last Name and Date of Birth  -->
            </p >
            <p class="form-details">
                <label for="F_name" class="form-label-required">First name </label>
                <input type="text" name="F_name" id="F_name" pattern="[A-Za-z]+" maxlength="20" size="20" title="Only Alphabetic are Allowed" required>
            </p >
            <p class="form-details">
                <label for="L_name" class="form-label-required"> Last name </label>
                <input type="text" name="L_name" id="L_name" pattern="[A-Za-z]+" maxlength="20" size="20" title="Only Alphabetic are Allowed" required>
            </p >
            <p class="form-details">
                <label for="DOB" class="form-label-required">Date of birth</label> 
                <input type="date" name= "DOB" id="DOB" required>
            </p >
            
            <!-- Follow according to the requirement set gender in a fieldset  -->
            <fieldset>    
                <legend class="form-label-required">Gender</legend>
                <label for="male">Male </label>
                <input type="radio" name="gender" id="male" value="M" required>
                <label for="female">Female </label>
                <input type="radio" name="gender" id="female" value="F">
            </fieldset>

            <!-- Address, Email and Phone Number  -->
            <p class="form-details">
                <label for="Street_Add" class="form-label-required">Street Address </label>
                <input type="text" name="Street_Add" id="Street_Add" placeholder="Example: 45 Collins Street" maxlength="40" size="40" required>
            </p >
            <p class="form-details">
                <label for="SuburbTown" class="form-label-required">Suburb/town </label>
                <input type="text" name="SuburbTown" id="SuburbTown" placeholder="Example: Richmond" maxlength="40" size="40" required>
            </p >
            <p class="form-details">
                <label for="State" class="form-label-required">State </label>
                    <select name="State" id="State" required="required">
                        <option value="" selected>Please Select</option>
                        <option value="VIC">VIC</option>			
                        <option value="NSW">NSW</option>
                        <option value="QLD">QLD</option>
                        <option value="NT">NT</option>
                        <option value="WA">WA</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="ACT">ACT</option>
                    </select>
            </p >
            <p class="form-details">
                <label for="Postcode" class="form-label-required">Postcode </label>
                <input type="text" name="Postcode" id="Postcode" placeholder="Example: 3000" maxlength="4" size="4" title="Please Enter 4 digits Only" required>
            </p >
            <p class="form-details">
                <label for="Email" class="form-label-required">Email address </label>
                <input type="email" name="Email" placeholder="Example: name@domain.com" id="Email" required>
            </p >
            <p class="form-details">
                <label for="Phone" class="form-label-required">Phone number</label>
                <input type="tel" name="Phone" id="Phone" maxlength="12" size="12"
                    placeholder="Example: 012 3456789" 
                    pattern="[0-9 ]{8,12}"  required>
            </p >

            <!-- Required technical list and Other Skills  -->
            <p class="form-label-required">Required technical list</p>
                <label for="NET_SEC_FUN"><input type="checkbox" id="NET_SEC_FUN" name="category[]" value="NET_SEC_FUN" checked="checked"/>Networking & Security Fundamentals</label>    
                <label for="OP_INF"><input type="checkbox" id="OP_INF" name="category[]" value="OP_INF"/>Operating Systems & Infrastructure</label> 
                <label for="CLD_TECH"><input type="checkbox" id="CLD_TECH" name="category[]" value="CLD_TECH"/>Cloud Technologies</label> 
                <label for="RISK_COM"><input type="checkbox" id="RISK_COM" name="category[]" value="RISK_COM"/>Risk & Compliance Knowledge</label> 
                <label for="PRO_SCRP"><input type="checkbox" id="PRO_SCRP" name="category[]" value="PRO_SCRP"/>Programming & Scripting</label> 

            <p class="form-details">
                <label for="Other_skills" class="form-label">Other Skills</label><br />
                <textarea id="Other_skills" name="comments" rows="5" cols="65" placeholder="Please elaborate more if you have other skills..."></textarea>
            </p >

            <!-- Additional CV Upload  -->
            <fieldset>
                <legend class="form-label">CV Upload</legend>
                <strong>Please upload your CV here:</strong>
                <label for="fileUpload" class="cv-button">Choose File</label>
                <input type="file" id="fileUpload" name="attachment">
            </fieldset>
                <br>

            <!-- Submit Button  -->
                <input class="form-button" type="submit" value="Apply">
        </form>

        <footer class="footer">
            <hr>
            <p class="leftfooter">&copy; 2025 Quantum Shield. All rights reserved.</p >
            <p class="rightfooter"><a href="https://danielyongtm.atlassian.net/jira/software/projects/PROJ/boards/34?atlOrigin=eyJpIjoiNjQxZjBlZDhhYmJlNDE0ZDhiOTU4MzdkYjQwNzg0OTMiLCJwIjoiaiJ9">View our Jira project</a ></p>
        </footer>
    </body>
</html>