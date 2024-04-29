<?php

$activeSection = 'createuser';
include '../_dbconnect.php';
include '../_notification.php'; 



if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../");
    exit();
}

if(!isset($_SESSION["user_type"])  ||$_SESSION["user_type"] === 'student' ) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../");
    exit();
}


if (!$_SESSION['var']) {
    header("Location: ../");
    exit();
}



require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to encrypt the email
function encryptEmail($email) {
    return base64_encode($email);
}

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $register_number = $_POST['register_number'];
    $email = $_POST['email'];
    $year = $_POST['year'];
    $branch = $_POST['branch'];
    $section = $_POST['section'];

    $password = "123456789"; // Temporary password

    if (!empty($name) && !empty($register_number) && !empty($email) && !empty($year) && !empty($branch) && !empty($section)) {
        if (!registerNumberExists($register_number)) {
            $stmt = $conn->prepare("INSERT INTO student_tb (Name, Register_Number, Email, Password, Year, Branch, Section, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, FALSE)");
            $stmt->bind_param("sssssss", $name, $register_number, $email, $password, $year, $branch, $section);

            Verification($email, $register_number, $name); // Send verification email

            if ($stmt->execute()) {
                showNotification("Account created successfully.", "success");
            } else {        
                showNotification("Error creating account.", "error");
            }

            $stmt->close();
        } else {
            showNotification("Register number already exists.", "error");
        }
    } else {        
        showNotification("Please fill in all fields.", "error");
    }
}

// Function to check if Register_Number already exists in the database
function registerNumberExists($register_number) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM student_tb WHERE Register_Number = ?");
    $stmt->bind_param("s", $register_number);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Function to send verification email
function Verification($email, $register_number, $name)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'srinivasnani005@gmail.com'; // SMTP username (replace with your Gmail email)
        $mail->Password   = 'flkv lvmw pavy edsc'; // SMTP password (replace with your Gmail password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom('srinivasnani005@gmail.com', 'Srinivas Nani');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Email Verification';

        // Email body
        $mail->Body = '
            <html>
            <head>
                <style>
                    /* Global styles */
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        max-width: 600px;
                        margin: auto;
                        background-color: #ffffff;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        background-color: #4caf50;
                        color: #ffffff;
                        padding: 10px;
                        text-align: center;
                        border-top-left-radius: 10px;
                        border-top-right-radius: 10px;
                    }
                    .content {
                        padding: 30px;
                        text-align: center;
                    }
                    .footer {
                        background-color: #4caf50;
                        color: #ffffff;
                        padding: 10px;
                        text-align: center;
                        border-bottom-left-radius: 10px;
                        border-bottom-right-radius: 10px;
                    }
                    .button {
                        display: inline-block;
                        background-color: #4caf50;
                        color: #ffffff;
                        padding: 10px 20px;
                        text-decoration: none;
                        border-radius: 5px;
                        transition: background-color 0.3s ease;
                    }
                    .button:hover {
                        background-color: #388e3c; /* Darker shade of green on hover */
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h2>Email Verification</h2>
                    </div>
                    <div class="content">
                        <p>Dear ' . $name . ',</p>
                        <p>Welcome to SRKR Engineering College! To complete your registration, please click the button below to verify your email address:</p>
                        <a href="http://srkr.me/Student/verify1.php?id=' . encryptEmail($email) . '" class="button">Verify Email</a>
                        <p style="margin-top: 20px;">Your Register Number: ' . $register_number . '</p>
                    </div>
                    <div class="footer">
                        <p>This email was sent from SRKR Engineering College. Please do not reply to this email.</p>
                    </div>
                </div>
            </body>
            </html>
        ';

        // Plain text alternative for email clients that don't support HTML
        $mail->AltBody = 'Dear ' . $name . ', Welcome to SRKR Engineering College. Please click the following link to verify your email address: https://srkr.me/Student//verify.php?email=' . $email . '. Your Register Number: ' . $register_number;

        $mail->send();
    } catch (Exception $e) {

        showNotification("Verification Email could not be sent to Register Number ' . $register_number ", "error");
    }
}





?>













<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/temp.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="../js/script.js" defer></script>
    <title>Dashboard</title>
    <style>
        /* General Styles */
body {
    font-family: 'Open Sans', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

main {
    padding: 20px;
}

.form-container {
    max-width: 600px;
    justify-content: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: 600;
    color: #333;
    text-align: center;
}


.form-label {
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
    
}

.form-input,
.form-select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    
}

.submit-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    
}

.submit-btn:hover {
    background-color: #45a049;
    
}

/* Responsive Styles */
@media screen and (max-width: 600px) {
    .form-container {
        padding: 10px;
    }

    h1 {
        font-size: 20px;
    }

    .form-label {
        font-size: 16px;
    }

    .form-input,
    .form-select {
        padding: 8px;
        margin-bottom: 10px;
    }

    .submit-btn {
        padding: 8px 16px;
    }
}

/* for small mobile */
@media screen and (max-width: 400px) {
    .form-container {
        padding: 5px;
    }

    h1 {
        font-size: 18px;
    }
    
}

        

        
    </style>
</head>
<body>

    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <main>
    <div class="form-container">
        <h1>Single User Creation</h1>
        <form action="" method="POST">
            <label for="name" class="form-label">Name:</label><br>
            <input type="text" id="name" name="name" class="form-input" required><br><br>

            <label for="register_number" class="form-label">Register Number:</label><br>
            <input type="text" id="register_number" name="register_number" class="form-input" required><br><br>

            <label for="email" class="form-label">Email:</label><br>
            <input type="email" id="email" name="email" class="form-input" required><br><br>

            <label for="year" class="form-label">Year:</label>
            <select name="year" id="year" class="form-input" required>
                <option value="">Select Year</option>
                <?php
                $currentYear = date("Y");
                for ($i = $currentYear; $i >= $currentYear - 4; $i--) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select><br><br>

            <label for="branch" class="form-label">Branch:</label>
            <select name="branch" id="branch" class="form-input" required>
                <option value="">Select Branch</option>
                <?php
                $branches = array("CSE", "ECE", "EEE", "CIVIL", "AIDS", "CSD", "MECH", "AIML", "IT");
                foreach ($branches as $branch) {
                    echo '<option value="' . $branch . '">' . $branch . '</option>';
                }
                ?>
            </select><br><br>

            <label for="section" class="form-label">Section:</label>
            <select name="section" id="section" class="form-input" required>
                <option value="">Select Section</option>
                <?php
                $sections = array("A", "B", "C", "D", "E");
                foreach ($sections as $section) {
                    echo '<option value="' . $section . '">' . $section . '</option>';
                }
                ?>
            </select><br><br>

            <input type="submit" name="submit" value="Create Account" class="submit-btn">
        </form>
    </div>
</main>


    </section>

</body>
</html>
