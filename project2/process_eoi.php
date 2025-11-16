<?php
// Start session right after opening PHP tag
session_start();

// =============================================================================
// SQL CREATE TABLE STATEMENT FOR EOI TABLE
// =============================================================================
/*
CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `JobRefNo` varchar(5) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `StreetAddress` varchar(40) NOT NULL,
  `Suburb` varchar(40) NOT NULL,
  `State` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
  `Postcode` char(4) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Skill1` varchar(50) DEFAULT NULL,
  `Skill2` varchar(50) DEFAULT NULL,
  `Skill3` varchar(50) DEFAULT NULL,
  `Skill4` varchar(50) DEFAULT NULL,
  `Skill5` varchar(50) DEFAULT NULL,
  `OtherSkills` text DEFAULT NULL,
  `Status` enum('New','Current','Final') DEFAULT 'New'
); 

ALTER TABLE `eoi` ADD PRIMARY KEY (`EOInumber`);
ALTER TABLE `eoi` MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT;
*/
// =============================================================================

// 1. Prevent direct URL access with enhanced security
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['Job_ref_num'])) {
    header("Location: apply.php");
    exit();
}

// 2. Database connection with error handling
require_once 'settings.php';

try {
    $database_connection = new mysqli($host, $user, $pwd, $sql_db);
    
    if ($database_connection->connect_error) {
        throw new Exception("Database connection failed: " . $database_connection->connect_error);
    }
    
    // Set character set for security
    $database_connection->set_charset("utf8mb4");
} catch (Exception $connection_error) {
    error_log("Database connection error: " . $connection_error->getMessage());
    display_error_page(["System temporarily unavailable. Please try again later."]);
    exit();
}

function sanitize_input(string $raw_input): string {
    $cleaned_input = trim($raw_input);
    $cleaned_input = stripslashes($cleaned_input);
    $cleaned_input = htmlspecialchars($cleaned_input, ENT_QUOTES, 'UTF-8');
    return $cleaned_input;
}

// Validate Australian postcode for state
function is_valid_postcode_for_state(string $postcode, string $state): bool {
    $postcode_number = (int)$postcode;
    
    $state_postcode_ranges = [
        'VIC' => [[3000, 3996], [8000, 8999]],
        'NSW' => [[1000, 1999], [2000, 2599], [2619, 2899], [2921, 2999]],
        'QLD' => [[4000, 4999], [9000, 9999]],
        'WA'  => [[6000, 6797], [6800, 6999]],
        'SA'  => [[5000, 5799], [5800, 5999]],
        'TAS' => [[7000, 7999]],
        'ACT' => [[200, 299], [2600, 2618], [2900, 2920]],
        'NT'  => [[800, 899], [900, 999]]
    ];
    
    if (!isset($state_postcode_ranges[$state])) {
        return false;
    }
    
    foreach ($state_postcode_ranges[$state] as $range) {
        if ($postcode_number >= $range[0] && $postcode_number <= $range[1]) {
            return true;
        }
    }
    
    return false;
}

// Calculate age from date of birth
function calculate_age(string $date_of_birth): int {
    $birth_date = new DateTime($date_of_birth);
    $current_date = new DateTime();
    return $current_date->diff($birth_date)->y;
}

function display_error_page(array $error_messages): void {
    echo "<h2>Application Submission Failed</h2>\n";
    echo "<p>Please correct the following errors:</p>\n";
    echo "<ul>\n";
    
    foreach ($error_messages as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>\n";
    }
    
    echo "</ul>\n";
    echo "<a href='apply.php'>Return to Application Form</a>\n";
}

function display_success_page(int $eoi_number): void {
    echo "<h2>Application Submitted Successfully!</h2>\n";
    echo "<p>Thank you for your interest in joining our team.</p>\n";
    echo "<p>Your Expression of Interest has been received.</p>\n";
    echo "<p><strong>Your EOI number is: #" . htmlspecialchars((string)$eoi_number) . "</strong></p>\n";
    echo "<p>Please save this number for your records.</p>\n";
    echo "<a href='apply.php'>Submit Another Application</a><br>\n";
    echo "<a href='index.php'>Return to Homepage</a>\n";
}

// 3. Sanitize all user inputs
$application_data = [
    'job_reference'    => sanitize_input($_POST['Job_ref_num']),
    'first_name'       => sanitize_input($_POST['F_name']),
    'last_name'        => sanitize_input($_POST['L_name']),
    'date_of_birth'    => sanitize_input($_POST['DOB']),
    'gender'           => sanitize_input($_POST['gender']),
    'street_address'   => sanitize_input($_POST['Street_Add']),
    'suburb'           => sanitize_input($_POST['SuburbTown']),
    'state'            => sanitize_input($_POST['State']),
    'postcode'         => sanitize_input($_POST['Postcode']),
    'email'            => sanitize_input($_POST['Email']),
    'phone'            => sanitize_input($_POST['Phone']),
    'other_skills'     => sanitize_input($_POST['Other_skills'])
];

// 4. Process skills checkboxes with constants
define('SKILL_NETWORK_SECURITY', 'NET_SEC_FUN');
define('SKILL_OPERATIONS_INFRA', 'OP_INF');
define('SKILL_CLOUD_TECH', 'CLD_TECH');
define('SKILL_RISK_COMMUNICATION', 'RISK_COM');
define('SKILL_OTHER', 'OTHER_SKILL');

$submitted_skills = $_POST['category'] ?? [];
$processed_skills = [
    'network_skill'    => in_array(SKILL_NETWORK_SECURITY, $submitted_skills) ? SKILL_NETWORK_SECURITY : null,
    'operations_skill' => in_array(SKILL_OPERATIONS_INFRA, $submitted_skills) ? SKILL_OPERATIONS_INFRA : null,
    'cloud_skill'      => in_array(SKILL_CLOUD_TECH, $submitted_skills) ? SKILL_CLOUD_TECH : null,
    'risk_skill'       => in_array(SKILL_RISK_COMMUNICATION, $submitted_skills) ? SKILL_RISK_COMMUNICATION : null,
    'other_skill'      => in_array(SKILL_OTHER, $submitted_skills) ? SKILL_OTHER : null
];

// 5. Comprehensive validation
$validation_errors = [];

// Required fields validation
$required_fields = [
    'job_reference'    => 'Job reference number',
    'first_name'       => 'First name', 
    'last_name'        => 'Last name',
    'date_of_birth'    => 'Date of birth',
    'gender'           => 'Gender',
    'street_address'   => 'Street address',
    'suburb'           => 'Suburb/town',
    'state'            => 'State',
    'postcode'         => 'Postcode',
    'email'            => 'Email address',
    'phone'            => 'Phone number'
];

foreach ($required_fields as $field => $label) {
    if (empty($application_data[$field])) {
        $validation_errors[] = "{$label} is required.";
    }
}

// Job reference validation
if (!empty($application_data['job_reference']) && !preg_match("/^[A-Za-z]{2}[0-9]{3}$/", $application_data['job_reference'])) {
    $validation_errors[] = "Job reference must be in format: 2 letters followed by 3 numbers (e.g., CS288).";
}

// Name validation (alpha with spaces/hyphens, max 20 characters)
if (!empty($application_data['first_name']) && !preg_match("/^[A-Za-z\s\-]{1,20}$/", $application_data['first_name'])) {
    $validation_errors[] = "First name must contain only letters, spaces and hyphens (max 20 characters).";
}

if (!empty($application_data['last_name']) && !preg_match("/^[A-Za-z\s\-]{1,20}$/", $application_data['last_name'])) {
    $validation_errors[] = "Last name must contain only letters, spaces and hyphens (max 20 characters).";
}

// Age validation (minimum 23 years)
if (!empty($application_data['date_of_birth'])) {
    $applicant_age = calculate_age($application_data['date_of_birth']);
    
    if ($applicant_age < 23) {
        $validation_errors[] = "You must be at least 23 years old. Current age: {$applicant_age} years.";
    }
    
    // Validate date is not in future
    $birth_date = new DateTime($application_data['date_of_birth']);
    $current_date = new DateTime();
    if ($birth_date > $current_date) {
        $validation_errors[] = "Date of birth cannot be in the future.";
    }
}

// Address field length validation
if (!empty($application_data['street_address'])) {
    if (!preg_match("/^[A-Za-z0-9\s\-\/\.\,\']{1,40}$/", $application_data['street_address'])) {
        $validation_errors[] = "Street address can only contain letters, numbers, spaces, hyphens, slashes, dots, commas, and apostrophes.";
    }
    
    if (strlen($application_data['street_address']) > 40) {
        $validation_errors[] = "Street address must not exceed 40 characters.";
    }
}

if (!empty($application_data['suburb'])) {
    if (!preg_match("/^[A-Za-z\s\-\.\']{1,40}$/", $application_data['suburb'])) {
        $validation_errors[] = "Suburb/town can only contain letters, spaces, dots, and hyphens.";
    }
    
    if (strlen($application_data['suburb']) > 40) {
        $validation_errors[] = "Suburb/town must not exceed 40 characters.";
    }
}

// State validation
$valid_australian_states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
if (!empty($application_data['state']) && !in_array($application_data['state'], $valid_australian_states)) {
    $validation_errors[] = "Please select a valid Australian state or territory.";
}

// Postcode validation
if (!empty($application_data['postcode']) && !empty($application_data['state'])) {
    if (!is_valid_postcode_for_state($application_data['postcode'], $application_data['state'])) {
        $state_error_messages = [
            'VIC' => "Victoria postcodes: 3000-3999 (metro) or 8000-8999 (business)",
            'NSW' => "NSW postcodes: 1000-1999, 2000-2599, 2619-2899, or 2921-2999",
            'QLD' => "Queensland postcodes: 4000-4999 (SE) or 9000-9999 (regional)",
            'WA'  => "Western Australia postcodes: 6000-6797 or 6800-6999",
            'SA'  => "South Australia postcodes: 5000-5799 or 5800-5999", 
            'TAS' => "Tasmania postcodes: 7000-7999",
            'ACT' => "ACT postcodes: 0200-0299, 2600-2618, or 2900-2920",
            'NT'  => "Northern Territory postcodes: 0800-0899 or 0900-0999"
        ];
        
        $validation_errors[] = "Invalid postcode for {$application_data['state']}. " . 
                              $state_error_messages[$application_data['state']];
    }
}

// Email validation
if (!empty($application_data['email'])) {
    if (!filter_var($application_data['email'], FILTER_VALIDATE_EMAIL)) {
        $validation_errors[] = "Please enter a valid email address.";
    }
}

// Phone number validation
if (!empty($application_data['phone'])) {
    // Remove all spaces to count actual digits
    $clean_phone = preg_replace('/\s+/', '', $application_data['phone']);
    $digit_count = strlen($clean_phone);
    
    // Check if contains only digits and spaces
    if (!preg_match("/^[0-9 ]+$/", $application_data['phone'])) {
        $validation_errors[] = "Phone number can only contain digits and spaces.";
    }
    
    // Check digit count
    if ($digit_count < 8 || $digit_count > 12) {
        $validation_errors[] = "Phone number must contain 8-12 digits.";
    }
}

// Skills validation
if (empty($submitted_skills)) {
    $validation_errors[] = "Please select at least one technical skill.";
}

// Other skills description validation
if ($processed_skills['other_skill'] && empty(trim($application_data['other_skills']))) {
    $validation_errors[] = "Please describe your other skills when 'Other Skills' is selected.";
}

// Simple Other Skills validation
if (!empty(trim($application_data['other_skills'])) && !in_array('OTHER_SKILL', $submitted_skills)) {
    $validation_errors[] = "Please check the 'Other Skills' checkbox if you want to describe other skills.";
}

// 6. Process application or display errors
if (!empty($validation_errors)) {
    error_log("Validation failed for job " . ($application_data['job_reference'] ?? 'unknown') . " - Errors: " . implode(", ", $validation_errors));

    // Save all form data to session
    $_SESSION['form_data'] = [
        'Job_ref_num' => $_POST['Job_ref_num'],
        'F_name' => $_POST['F_name'],
        'L_name' => $_POST['L_name'],
        'DOB' => $_POST['DOB'],
        'gender' => $_POST['gender'],
        'Street_Add' => $_POST['Street_Add'],
        'SuburbTown' => $_POST['SuburbTown'],
        'State' => $_POST['State'],
        'Postcode' => $_POST['Postcode'],
        'Email' => $_POST['Email'],
        'Phone' => $_POST['Phone'],
        'Other_skills' => $_POST['Other_skills'],
        'category' => $submitted_skills
    ];
    
    // Show errors on validation page using the reusable function
    display_error_page($validation_errors);
    exit();
}

// 7. Database insertion with prepared statement
try {
    $insert_statement = $database_connection->prepare("
        INSERT INTO eoi 
        (JobRefNo, FirstName, LastName, StreetAddress, Suburb, State, Postcode, 
         Email, Phone, Skill1, Skill2, Skill3, Skill4, Skill5, OtherSkills, Status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')
    ");
    
    if (!$insert_statement) {
        throw new Exception("Prepare failed: " . $database_connection->error);
    }
    
    $insert_statement->bind_param(
        "sssssssssssssss",
        $application_data['job_reference'],
        $application_data['first_name'],
        $application_data['last_name'], 
        $application_data['street_address'],
        $application_data['suburb'],
        $application_data['state'],
        $application_data['postcode'],
        $application_data['email'],
        $application_data['phone'],
        $processed_skills['network_skill'],
        $processed_skills['operations_skill'],
        $processed_skills['cloud_skill'],
        $processed_skills['risk_skill'],
        $processed_skills['other_skill'],
        $application_data['other_skills']
    );
    
    if ($insert_statement->execute()) {
        $eoi_number = $insert_statement->insert_id;
        
        // Clear stored form data on success
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        
        display_success_page($eoi_number);
    } else {
        throw new Exception("Execution failed: " . $insert_statement->error);
    }

    $insert_statement->close();
    
} catch (Exception $database_error) {
    error_log("Database error: " . $database_error->getMessage());
    display_error_page(["System error: Unable to process application. Please try again."]);
} finally {
    $database_connection->close();
}
?>
