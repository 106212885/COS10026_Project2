<!DOCTYPE html>
<html lang="en">
    <body>
        <!-- Company Logo and Navigation Bar  -->
        <?php
            session_start();

            // Get stored form data and errors
            $form_data = $_SESSION['form_data'] ?? [];
            $form_errors = $_SESSION['form_errors'] ?? [];

            // Helper function to safely output values
            function get_value($field) {
                global $form_data;
                return isset($form_data[$field]) ? htmlspecialchars($form_data[$field]) : '';
            }

            // Helper function for checkboxes with auto-check for first skill
            function is_checked($value, $auto_check = false) {
                global $form_data;
                
                // If we have stored form data (from validation errors), use that
                if (isset($form_data['category']) && is_array($form_data['category'])) {
                    return in_array($value, $form_data['category']) ? 'checked' : '';
                }
                
                // If no stored data and it's the auto-check skill, check it (first load only)
                if ($auto_check && empty($form_data)) {
                    return 'checked';
                }
                
                return '';
            }

            // Helper function for radio buttons
            function is_selected($field, $value) {
                global $form_data;
                return (isset($form_data[$field]) && $form_data[$field] === $value) ? 'checked' : '';
            }

            // Helper function for dropdown selection
            function is_option_selected($field, $value) {
                global $form_data;
                return (isset($form_data[$field]) && $form_data[$field] === $value) ? 'selected' : '';
            }
            
            include 'header.inc';
            ?>
            <h1>Job Applications</h1>
            <?php
            include 'nav.inc';
            ?>

        <!-- Job Application Form -->
        <form class="form-box" method="post" action="process_eoi.php" novalidate="novalidate">

            <h1 class="form-title">Job Application</h1>

            <!-- Job References Numbers  -->
            <p class="form-details">
                <label for="Job_ref_num" class="form-label-required">Job reference number </label>
                <select name="Job_ref_num" id="Job_ref_num" required="required">
                    <option value="">Please Select</option>
                    <option value="CS288" <?php echo is_option_selected('Job_ref_num', 'CS288'); ?>>CS288 | CYBERSECURITY SPECIALIST</option>			
                    <option value="NE911" <?php echo is_option_selected('Job_ref_num', 'NE911'); ?>>NE911 | NETWORK SECURITY ENGINEER</option>
                    <option value="CA098" <?php echo is_option_selected('Job_ref_num', 'CA098'); ?>>CA098 | CYBERSECURITY ANALYST</option>
                    <option value="NA718" <?php echo is_option_selected('Job_ref_num', 'NA718'); ?>>NA718 | NETWORK ADMINISTRATOR</option>
                    <option value="IM404" <?php echo is_option_selected('Job_ref_num', 'IM404'); ?>>IM404 | IT SUPPORT SPECIALIST</option>				
                </select>
            </p>

            <!-- First Name, Last Name and Date of Birth  -->
            <p class="form-details">
                <label for="F_name" class="form-label-required">First name </label>
                <input type="text" name="F_name" id="F_name" pattern="[A-Za-z]+" maxlength="20" size="20" title="Only Alphabetic are Allowed" value="<?php echo get_value('F_name'); ?>" required>
            </p>
            <p class="form-details">
                <label for="L_name" class="form-label-required"> Last name </label>
                <input type="text" name="L_name" id="L_name" pattern="[A-Za-z]+" maxlength="20" size="20" title="Only Alphabetic are Allowed" value="<?php echo get_value('L_name'); ?>" required>
            </p>
            <p class="form-details">
                <label for="DOB" class="form-label-required">Date of birth</label> 
                <input type="date" name="DOB" id="DOB" value="<?php echo get_value('DOB'); ?>" required>
            </p>
            
            <!-- Follow according to the requirement set gender in a fieldset  -->
            <fieldset>    
                <legend class="form-label-required">Gender</legend>
                <label for="male">Male </label>
                <input type="radio" name="gender" id="male" value="M" <?php echo is_selected('gender', 'M'); ?> required>
                <label for="female">Female </label>
                <input type="radio" name="gender" id="female" value="F" <?php echo is_selected('gender', 'F'); ?>>
            </fieldset>

            <!-- Address, Email and Phone Number  -->
            <p class="form-details">
                <label for="Street_Add" class="form-label-required">Street Address </label>
                <input type="text" name="Street_Add" id="Street_Add" placeholder="Example: 45 Collins Street" maxlength="40" size="40" pattern="[A-Za-z0-9\s\-\/\.\,]+" value="<?php echo get_value('Street_Add'); ?>" required>
            </p>
            <p class="form-details">
                <label for="SuburbTown" class="form-label-required">Suburb/town </label>
                <input type="text" name="SuburbTown" id="SuburbTown" placeholder="Example: Richmond" maxlength="40" size="40" pattern="[A-Za-z\s\-]+" value="<?php echo get_value('SuburbTown'); ?>" required>
            </p>
            <p class="form-details">
                <label for="State" class="form-label-required">State </label>
                <select name="State" id="State" required="required">
                    <option value="">Please Select</option>
                    <option value="VIC" <?php echo is_option_selected('State', 'VIC'); ?>>VIC</option>			
                    <option value="NSW" <?php echo is_option_selected('State', 'NSW'); ?>>NSW</option>
                    <option value="QLD" <?php echo is_option_selected('State', 'QLD'); ?>>QLD</option>
                    <option value="NT" <?php echo is_option_selected('State', 'NT'); ?>>NT</option>
                    <option value="WA" <?php echo is_option_selected('State', 'WA'); ?>>WA</option>
                    <option value="SA" <?php echo is_option_selected('State', 'SA'); ?>>SA</option>
                    <option value="TAS" <?php echo is_option_selected('State', 'TAS'); ?>>TAS</option>
                    <option value="ACT" <?php echo is_option_selected('State', 'ACT'); ?>>ACT</option>
                </select>
            </p>
            <p class="form-details">
                <label for="Postcode" class="form-label-required">Postcode </label>
                <input type="text" name="Postcode" id="Postcode" placeholder="Example: 3000" maxlength="4" size="4" title="Please Enter 4 digits Only" value="<?php echo get_value('Postcode'); ?>" required>
            </p>
            <p class="form-details">
                <label for="Email" class="form-label-required">Email address </label>
                <input type="email" name="Email" placeholder="Example: name@domain.com" id="Email" value="<?php echo get_value('Email'); ?>" required>
            </p>
            <p class="form-details">
                <label for="Phone" class="form-label-required">Phone number</label>
                <input type="tel" name="Phone" id="Phone" maxlength="12" size="12"
                    placeholder="Example: 012 3456789" 
                    pattern="[0-9 ]{8,12}" value="<?php echo get_value('Phone'); ?>" required>
            </p>

            <!-- Required technical list and Other Skills  -->
            <p class="form-label-required">Required technical list</p>
                <!-- Required technical list and Other Skills  -->
                <label for="NET_SEC_FUN"><input type="checkbox" id="NET_SEC_FUN" name="category[]" value="NET_SEC_FUN" <?php echo is_checked('NET_SEC_FUN', true); ?> />Networking & Security Fundamentals</label>    
                <label for="OP_INF"><input type="checkbox" id="OP_INF" name="category[]" value="OP_INF" <?php echo is_checked('OP_INF'); ?>/>Operating Systems & Infrastructure</label> 
                <label for="CLD_TECH"><input type="checkbox" id="CLD_TECH" name="category[]" value="CLD_TECH" <?php echo is_checked('CLD_TECH'); ?>/>Cloud Technologies</label> 
                <label for="RISK_COM"><input type="checkbox" id="RISK_COM" name="category[]" value="RISK_COM" <?php echo is_checked('RISK_COM'); ?>/>Risk & Compliance Knowledge</label>  
                <label for="OTHER_SKILL"><input type="checkbox" id="OTHER_SKILL" name="category[]" value="OTHER_SKILL" <?php echo is_checked('OTHER_SKILL'); ?>/>Other Skills</label>

            <p class="form-details">
                <label for="Other_skills" class="form-label">Other Skills</label><br>
                <textarea id="Other_skills" name="Other_skills" rows="5" cols="65" placeholder="Please elaborate more if you have other skills..."><?php echo get_value('Other_skills'); ?></textarea>
            </p>

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

        <?php
            include 'footer.inc';
        ?>
    </body>
</html>
