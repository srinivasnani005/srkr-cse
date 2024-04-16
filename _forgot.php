<?php
session_start();

include '_dbconnect.php';

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to generate a random OTP
function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $otp;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_email'])) {
    $register_number = $_POST['register_number'];
    $email = $_POST['email'];


    $sql = "SELECT email FROM student_tb WHERE Register_Number='$register_number' AND Email='$email'" ;

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_email = $row['email']; // Fetch the stored email from the database

        if ($email == $stored_email) { // Check if entered email matches stored email
            echo $email, $stored_email;
            $otp = generateOTP();
            $_SESSION[$register_number . '_otp'] = $otp;

            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Disable verbose debug output
                $mail->isSMTP();                                          // Set mailer to use SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
                $mail->Username   = 'srinivasnani005@gmail.com';          // SMTP username (replace with your Gmail email)
                $mail->Password   = 'flkv lvmw pavy edsc';                // SMTP password (replace with your Gmail password)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = 587;                                 // TCP port to connect to

                // Recipients
                $mail->setFrom('srinivasnani005@gmail.com', 'SRKR Engineering College');
                $mail->addAddress($email);                               // Recipient's email
                $mail->isHTML(true);                                     
                $mail->Subject = 'OTP for password reset';
                $mail->Body    = "Dear student,<br><br>Your OTP for password reset is: <b>$otp</b><br><br>Your Register Number: $register_number<br><br>Regards,<br>SRKR Engineering College";

                // Send the email
                $mail->send();

                echo "<script>alert('OTP has been sent to your email.')</script>";
                echo "<script>window.location.href='forgot_password.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Something went wrong')</script>";
            }
        } else {
            echo "<script>alert('Entered email does not match the registered email. Please check your details and try again.')</script>";
        }
    } else {
        echo "<script>alert('Register Number not found.')</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_otp'])) {
    if (isset($_SESSION[$_POST['register_number'] . '_otp'])) {
        $otp_entered = $_POST['otp_entered'];
        $register_number = $_POST['register_number'];
        $stored_otp = $_SESSION[$register_number . '_otp'];

        if ($otp_entered == $stored_otp) {
            unset($_SESSION[$register_number . '_otp']);
            echo "success";
            exit;
        } else {
            echo "Invalid OTP";
            exit;
        }
    } else {
        echo "Invalid request";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $register_number = $_POST['register_number'];
    if ($new_password == $confirm_password) {
        $sql = "UPDATE student_tb SET Password='$new_password' WHERE Register_Number='$register_number'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "success"; 
            exit;
        } else {
            echo "Error updating password: " . mysqli_error($conn);
            exit;
        }
    } else {
        echo "Passwords do not match";
        exit;
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forgot Password</title>
<link rel="stylesheet" href="css/t1.css">

<style>
   
    .container {
        width: 300px;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 5px;
    }

    input[type="button"] {
        width: 100%;
        background-color: #007bff;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="button"]:hover {
        background-color: #0056b3;
    }

    label{
        margin-bottom: -10px;
    }

    .error {
        color: red;
        text-align: center;
    }

    #step2,
    #step3 {
        display: none;
    }

    #countdown {
        text-align: center;
        font-size: 18px;
        color: #333;
        margin-bottom: 20px;
    }

    .password-container {
        position: relative;
    }

    .password-container input {
        width: calc(100% - 30px);
    }

    .password-container i {
        position: absolute;
        right: 5px;
        top: 12px;
        cursor: pointer;
    }
</style>
</head>
<body>

<?php include '_nav.php'; ?>
    <main>
        <div class="background-image">
        <div class="container">
            <h2>Forgot Password</h2>
            <div id="step1">
                <form id="forgotPasswordForm" method="post">
                    <label for="register_number">Register Number:</label><br>
                    <input type="text" id="register_number" name="register_number" required><br><br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required><br><br>
                    <input type="button" onclick="sendOTP()" value="Send OTP">
                    <p id="step1Error" class="error"></p>
                </form>
            </div>
            <div id="step2">
                <p id="countdown"></p>
                <form id="verifyOTPForm" method="post">
                    <label for="otp_entered">Enter OTP:</label><br>
                    <input type="text" id="otp_entered" name="otp_entered" required><br><br>
                    <input type="button" onclick="verifyOTP()" value="Verify OTP">
                    <input type="button" onclick="goBackToStep1()" value="Back">
                    <p id="step2Error" class="error"></p>
                </form>
            </div>
            <div id="step3">
                <form id="changePasswordForm" method="post">
                    <label for="new_password">New Password:</label><br>
                    <div class="password-container">
                        <input type="password" id="new_password" name="new_password" required>
                        <i class="fas fa-eye" onclick="togglePasswordVisibility('new_password')"></i>
                    </div><br>
                    <label for="confirm_password">Confirm Password:</label><br>
                    <div class="password-container">
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <i class="fas fa-eye" onclick="togglePasswordVisibility('confirm_password')"></i>
                    </div><br>
                    <input type="button" onclick="changePassword()" value="Change Password">
                    <input type="button" onclick="goBackToStep2()" value="Back">
                    <p id="step3Error" class="error"></p>
                </form>
            </div>
        </div>
    </div>
    
        <div class="body-content">
        </div>
    </main>

    <?php include '_footer.php'; ?>




<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
var countdownTimer;
function sendOTP() {
    var register_number = document.getElementById("register_number").value;
    var email = document.getElementById("email").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response.includes("OTP has been sent")) {
                document.getElementById("step1Error").innerHTML = "";
                document.getElementById("step1").style.display = "none";
                document.getElementById("step2").style.display = "block";
                startCountdown();
            } else {
                document.getElementById("step1Error").innerHTML = response;
                // Clear entered OTP and reset step
                document.getElementById("otp_entered").value = "";
                document.getElementById("step2").style.display = "none";
                document.getElementById("step1").style.display = "block";
            }
        }
    };
    xhr.send("send_email=1&register_number=" + register_number + "&email=" + email);
}

function verifyOTP() {
    var otp_entered = document.getElementById("otp_entered").value;
    var register_number = document.getElementById("register_number").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response == "success") {
                document.getElementById("step2Error").innerHTML = "";
                document.getElementById("step2").style.display = "none";
                document.getElementById("step3").style.display = "block";
                document.getElementById("confirm_password").focus();
            } else {
                document.getElementById("step2Error").innerHTML = response;
            }
        }
    };
    xhr.send("verify_otp=1&otp_entered=" + otp_entered + "&register_number=" + register_number);
}



function changePassword() {
    var new_password = document.getElementById("new_password").value;
    var confirm_password = document.getElementById("confirm_password").value;
    var register_number = document.getElementById("register_number").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response == "success") {
                document.getElementById("step3Error").innerHTML = "Password changed successfully!";
            } else {
                document.getElementById("step3Error").innerHTML = response;
            }
        }
    };
    xhr.send("change_password=1&new_password=" + new_password + "&confirm_password=" + confirm_password + "&register_number=" + register_number);
}

function startCountdown() {
    var seconds = 100;
    var countdown = document.getElementById("countdown");
    countdown.innerHTML = "Resend OTP in " + seconds + " seconds";

    countdownTimer = setInterval(function() {
        seconds--;
        countdown.innerHTML = "Resend OTP in " + seconds + " seconds";

        if (seconds <= 0) {
            clearInterval(countdownTimer);
            countdown.innerHTML = "<a href='#' onclick='sendOTP()'>Resend OTP</a>";
        }
    }, 1000);
}

function goBackToStep1() {
    clearInterval(countdownTimer);
    document.getElementById("step2").style.display = "none";
    document.getElementById("step1").style.display = "block";
}

function goBackToStep2() {
    document.getElementById("step3").style.display = "none";
    document.getElementById("step2").style.display = "block";
}

function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    var eyeIcon = passwordInput.nextElementSibling;

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
</script>

</body>
</html>
