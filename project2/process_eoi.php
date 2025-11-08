<?php
// 1. Prevent direct URL access
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['Job_ref_num'])) {
    header("Location: apply.php");
    exit();
}

// 2. Database connection using settings.php
require_once 'settings.php';
$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3. Sanitize inputs function
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// 4. Sanitize all inputs
$job_ref = sanitize_input($_POST['Job_ref_num']);
$first_name = sanitize_input($_POST['F_name']);
$last_name = sanitize_input($_POST['L_name']);
$dob = sanitize_input($_POST['DOB']);
$gender = sanitize_input($_POST['gender']);
$street_address = sanitize_input($_POST['Street_Add']);
$suburb = sanitize_input($_POST['SuburbTown']);
$state = sanitize_input($_POST['State']);
$postcode = sanitize_input($_POST['Postcode']);
$email = sanitize_input($_POST['Email']);
$phone = sanitize_input($_POST['Phone']);
$other_skills = sanitize_input($_POST['Other_skills']);

// 5. Handle skills checkboxes 
$skills = isset($_POST['category']) ? $_POST['category'] : [];
$skill1 = in_array('NET_SEC_FUN', $skills) ? 'NET_SEC_FUN' : NULL;
$skill2 = in_array('OP_INF', $skills) ? 'OP_INF' : NULL;
$skill3 = in_array('CLD_TECH', $skills) ? 'CLD_TECH' : NULL;
$skill4 = in_array('RISK_COM', $skills) ? 'RISK_COM' : NULL;
$skill5 = in_array('OTHER_SKILL', $skills) ? 'OTHER_SKILL' : NULL;

// 6. Postcode validation by state function
function validate_postcode_by_state($postcode, $state) {
    $state_postcodes = [
        'VIC' => '/^3|8/',  // VIC postcodes start with 3 or 8
        'NSW' => '/^1|2/',  // NSW postcodes start with 1 or 2
        'QLD' => '/^4|9/',  // QLD postcodes start with 4 or 9
        'WA' => '/^6/',     // WA postcodes start with 6
        'SA' => '/^5/',     // SA postcodes start with 5
        'TAS' => '/^7/',    // TAS postcodes start with 7
        'ACT' => '/^0/',    // ACT postcodes start with 0
        'NT' => '/^0/'      // NT postcodes start with 0
    ];
    
    return preg_match($state_postcodes[$state], $postcode);
}

// 7. Server-side validation
$errors = [];

// Required fields validation
if (empty($job_ref)) $errors[] = "Job reference number is required.";
if (empty($first_name)) $errors[] = "First name is required.";
if (empty($last_name)) $errors[] = "Last name is required.";
if (empty($dob)) $errors[] = "Date of birth is required.";
if (empty($gender)) $errors[] = "Gender is required.";
if (empty($street_address)) $errors[] = "Street address is required.";
if (empty($suburb)) $errors[] = "Suburb/town is required.";
if (empty($state)) $errors[] = "State is required.";
if (empty($postcode)) $errors[] = "Postcode is required.";
if (empty($email)) $errors[] = "Email address is required.";
if (empty($phone)) $errors[] = "Phone number is required.";

// Name validation (alpha characters only, max 20)
if (!empty($first_name) && !preg_match("/^[a-zA-Z]{1,20}$/", $first_name)) {
    $errors[] = "First name must contain only letters and be max 20 characters.";
}
if (!empty($last_name) && !preg_match("/^[a-zA-Z]{1,20}$/", $last_name)) {
    $errors[] = "Last name must contain only letters and be max 20 characters.";
}

// Date of birth validation (age >= 18) - using your date input type
if (!empty($dob)) {
    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $today->diff($birthdate)->y;
    
    if ($age < 18) {
        $errors[] = "You must be at least 18 years old to apply. Your current age is $age years old.";
    }
    
    // Optional: Also check if date is in the future (invalid)
    if ($birthdate > $today) {
        $errors[] = "Date of birth cannot be in the future.";
    }
}

// Address validation
if (!empty($street_address) && strlen($street_address) > 40) {
    $errors[] = "Street address must be max 40 characters.";
}
if (!empty($suburb) && strlen($suburb) > 40) {
    $errors[] = "Suburb/town must be max 40 characters.";
}

// State validation
$valid_states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
if (!empty($state) && !in_array($state, $valid_states)) {
    $errors[] = "Please select a valid state.";
}

// In validation section:
if (!empty($postcode) && !empty($state) && !validate_postcode_by_state($postcode, $state)) {
    $errors[] = "Postcode does not match the selected state.";
}

// Email validation
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Phone validation (8-12 digits, spaces allowed)
if (!empty($phone)) {
    $clean_phone = preg_replace('/\s+/', '', $phone);
    if (!preg_match("/^\d{8,12}$/", $clean_phone)) {
        $errors[] = "Phone number must be 8-12 digits.";
    }
}

// Skills validation - at least one checkbox required
$skills = isset($_POST['category']) ? $_POST['category'] : [];
if (empty($skills)) {
    $errors[] = "At least one technical skill must be selected.";
}

// Other skills validation - only required if "Other Skills" checkbox is checked
if (in_array('OTHER_SKILL', $skills) && empty(trim($other_skills))) {
    $errors[] = "Please describe your other skills when 'Other Skills' is selected.";
}

// 8. Display errors or insert data
if (!empty($errors)) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Application Error</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
            .error { background: #ffe6e6; border: 1px solid #ff0000; padding: 15px; margin: 10px 0; border-radius: 5px; }
            .btn { display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        </style>
    </head>
    <body>
        <h2>There were errors in your application:</h2>
        <div class='error'>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo "</div>";
    echo "<a href='apply.php' class='btn'>Go back to application form</a>";
    echo "</body></html>";
    exit();
}

// 9. Insert into database (using YOUR table structure)
$stmt = $conn->prepare("
    INSERT INTO eoi 
    (JobRefNo, FirstName, LastName, StreetAddress, Suburb, State, Postcode, Email, Phone, Skill1, Skill2, Skill3, Skill4, Skill5, OtherSkills, Status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')
");

$stmt->bind_param(
    "sssssssssssssss",  // 15 's' characters for 15 string parameters
    $job_ref, $first_name, $last_name, $street_address, $suburb, $state, $postcode, $email, $phone,
    $skill1, $skill2, $skill3, $skill4, $skill5, $other_skills
);

if ($stmt->execute()) {
    $EOInumber = $stmt->insert_id;
    // Display confirmation with EOInumber
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Application Submitted</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; text-align: center; }
            .success { background: #e6ffe6; border: 1px solid #00ff00; padding: 20px; margin: 20px 0; border-radius: 5px; }
            .eoi-number { font-size: 24px; font-weight: bold; color: #007bff; margin: 10px 0; }
            .btn { display: inline-block; padding: 10px 20px; margin: 5px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        </style>
    </head>
    <body>
        <h2>Thank you for your application!</h2>
        <div class='success'>
            <p>Your Expression of Interest has been submitted successfully.</p>
            <p>Your unique EOI number is:</p>
            <div class='eoi-number'>#$EOInumber</div>
            <p>Please keep this number for your records.</p>
        </div>
        <div>
            <a href='apply.php' class='btn'>Submit another application</a>
            <a href='index.php' class='btn'>Return to homepage</a>
        </div>
    </body>
    </html>";
} else {
    echo "<h2>Error submitting application</h2>";
    echo "<p>There was an error processing your application. Please try again.</p>";
    echo "<p>Error: " . $stmt->error . "</p>";
    echo "<a href='apply.php'>Go back to application form</a>";
}

$stmt->close();
$conn->close();
?>