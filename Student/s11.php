<?php



$activeSection = 'uploadform';
include '../_dbconnect.php';

// Redirect users who are not logged in or are students
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'teacher'  || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../");
    exit();
}
// Handle logout

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../");
    exit();
}


$register_number = $_SESSION['Register_Number'];

    $branch = "SELECT Branch FROM student_tb WHERE Register_Number = '$register_number'";
    $branch_result = $conn->query($branch);
    $branch_row = $branch_result->fetch_assoc();
    $branch = $branch_row['Branch'];


    $targetDir = "../uploads/S11/$branch/2024/";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S11 Student Industry Visits</title>
    <style>
               
html {
    scroll-behavior: smooth;
}




        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');

body{
    height:100vh;
    background-color: #e2eee0;
    text-align: center;
    font-family: 'Roboto', sans-serif;
    font-size: 12px;

}

.login-box .heading {
    box-sizing: border-box;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 20px;
    font-weight: 400;
    line-height: 40px;
    color: rgb(32, 33, 36);
    line-height: 135%;
    max-width: 100%;
    min-width: 0;
}

.login-box{
    position: relative;
    margin:10px auto;
    max-width:600px;
    padding: 30px 20px;
    box-sizing: border-box;
    border-radius: 10px;
    background-color: #fff;
}

.login-box h2 {
    margin: 0 0 30px;
    padding: 0;
    text-align: center;
}



.login-box .user-box {
    position: relative;
    top:15px;
}

.login-box .user-box input {
    position: relative;
    width: 100%;
    padding: 10px 0;
    font-size: 16.5px;
    margin-bottom: 24px;
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    background: transparent;
}

.login-box .user-box label {
    position: absolute;
    top: 5px;
    left: 0;
    padding: 5px 0;
    font-size: 13px;
    pointer-events: none;
    transition: .5s;
}

.login-box .user-box input[type="date"] + label,
.login-box .user-box input[type="file"] + label 
.login-box .user-box .select-opt + label {
    position: absolute;
    top: -21px;
    left: 0;
    padding: 5px 0;
    font-size: 14px;
    pointer-events: none;
    transition: .5s;
}


.login-box .user-box input:focus:not([type="date"]) ~ label,
.login-box .user-box input:valid ~ label {
    top: -21px;
    left: 0;
    color: green;
    font-size: 15px;
}


.login-box .user-box input:focus[type="date"] ~ label,
.login-box .user-box input:focus[type="file"] ~ label,
.login-box .user-box input:valid ~ label {
    top: -21px;
    left: 0;
    color: green;
    font-size: 15px;
}




.login-box .user-box input:focus:not([type="date"]){
    border-bottom: 2px solid rgb(41, 137, 4);
    animation: slideIn 0.2s ease-in-out;
}


@keyframes slideIn {
    0%{
        border-bottom: 2px solid rgb(41, 137, 4);
        width:0px;
    }
    100%{
        border-bottom: 2px solid rgb(41, 137, 4);
        width:100%;
    }
}


.button-1{
    background-color: #3a9218;
    color:#fff;
    font-size:14px;
    padding:8px 18px;
    border: none;   
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.15s ease-in;
}

.button-1:hover{
    transition: 0.2s ease-in;
    background-color: #55ad32;
}

.button-1.clicked {
    background-color: #006400;
    transition: 0.2s ease-in;
}

.button-2{
    background-color: transparent;
    border: none;
    color:green;
    font-weight: 600;
    cursor: pointer;
    border-radius: 6px;
}

.button-2:hover{
    transition: 0.15s ease-in;

    color: #006400;
    background-color: #77777747;
}
    
.end-card{
    justify-content: space-between;
    display: flex;  
    max-width: 600px;
    margin: 0 auto;
}

#must{
    color: red;
    font-size: 15px;
    display: inline-block;
}

#mustnot{
    color: #777777;
    font-size: 15px;
    display: inline-block;
}



/* checkbox */

.checkbox-container{
    position: relative;
    height:40px;
    width: 200px;
    top:0px;
}

#checkbox1{
    top: -18px;
    left: -35px;
    height: 15px;
    width: 15px;
    cursor: pointer;
}





.offline_location{
    position: relative;
    top: 0px;
    display: none;
}

.offline_location input{
    width: 100%;
    padding: 10px 0;
    font-size: 16.5px;
    margin-bottom: 24px;
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    background: transparent;
}

.offline_location label{
    position: absolute;
    top: 5px;
    left: 0;
    padding: 5px 0;
    font-size: 13px;
    pointer-events: none;
    transition: .5s;
}

.offline_location input:focus{
    border-bottom: 2px solid rgb(41, 137, 4);
    animation: slideIn 0.2s ease-in-out;
}


/* -------Select Options------------- */





.login-box .user-box select {
    position: relative;
    width: 100%;
    padding: 10px 0;
    font-size: 16.5px;
    margin-bottom: 24px;
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    background: transparent;
}

.login-box .user-box select:focus,
.login-box .user-box select:valid {
    border-bottom: 2px solid rgb(41, 137, 4);
    animation: slideIn 0.2s ease-in-out;
}

.login-box .user-box select + label {
    position: absolute;
    top: -21px;
    left: 0;
    padding: 5px 0;
    font-size: 14px;
    pointer-events: none;
    transition: .5s;
}

.login-box .user-box select:not(:focus):valid {
    border-bottom: 1px solid black;
}


.login-box .user-box select:focus + label,
.login-box .user-box select:valid:focus + label {
    top: -21px;
    left: 0;
    color: green;
    font-size: 15px;
}
        /* Make necessary adjustments as per your requirements */


#register_number{
    top: -21px;
    left: 0;
    color: green;
    font-size: 15px;
}

    </style>
</head>
<body>

        <?php include '_side.php'; ?>
        <?php include '_nav.php'; ?>

        <!-- Main Content -->
        <main>    

        
        <a href="javascript:history.back()" style="text-decoration: none; color: #777777; font-size: 22px; font-weight: 800; text-align: left;">
        <i class='bx bx-arrow-back'></i>
    </a>
            
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-s11" enctype="multipart/form-data">
        <!-- Form fields for S11 Student Industry Visits -->
        <div class="login-box">
            <img src="srkrlogo.png" alt="" class="top-img" style="height: 75px; max-width: 100%;">
        </div>

        <div class="login-box">
            <div class="heading">
                <h3>S11 Student Industry Visits</h3>        
            </div>
        </div>

        
        <div class="login-box">
        <div class="user-box">
                <input type="text" name="RegNum"  value="<?php echo $_SESSION['Register_Number'];?>" readonly>
                <label id="register_number">Register Number<div id="mustnot"></div></label>
            </div>
        </div>


        <!-- Date of Visit -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="date_of_visit" required="">
                <label>Date of Visit<div id="must">*</div></label>
            </div>
        </div>

        <!-- Company/Industry Name -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="company_name" required="">
                <label>Company/Industry Name<div id="must">*</div></label>
            </div>
        </div>

        <!-- Place -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="place" required="">
                <label>Place<div id="must">*</div></label>
            </div>
        </div>

        <!-- Company Contact Person -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="contact_person" required="">
                <label>Company Contact Person<div id="must">*</div></label>
            </div>
        </div>

        <!-- Purpose of Visit -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="purpose_of_visit" required="">
                <label>Purpose of Visit<div id="must">*</div></label>
            </div>
        </div>

        <!-- Attach Proof: (Email, Geo Tagged photos, Certificate if any) -->
        <div class="login-box">
            <div class="user-box">
                <input type="file" name="proof_attachment" required="">
                <label>Attach Proof: (Email, Geo Tagged photos, Certificate if any)<div id="must">*</div></label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="end-card">
            <button type="submit" class="button-1">Submit</button>
            <button type="button" class="button-2" onclick="clearForm()">Clear form</button>
        </div>
    </form>

    </main>

</section>

    <script>
        // JavaScript code for showing/hiding faculty name box
        function clearForm() {
            document.getElementById("form-s11").reset();
        }
    </script>
</body>
</html>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data after proper validation
    $dateOfVisit = test_input($_POST['date_of_visit']);
    $companyName = test_input($_POST['company_name']);
    $place = test_input($_POST['place']);
    $contactPerson = test_input($_POST['contact_person']);
    $purposeOfVisit = test_input($_POST['purpose_of_visit']);

    $proofAttachment = $targetDir . basename($_FILES["proof_attachment"]["name"]);

    if (move_uploaded_file($_FILES["proof_attachment"]["tmp_name"], $proofAttachment)) {
        // Insert data into S11 table
        $sql = "INSERT INTO S11 (date_of_visit, company_name, place, contact_person, purpose_of_visit, proof_attachment)
                VALUES ('$dateOfVisit', '$companyName', '$place', '$contactPerson', '$purposeOfVisit', '$proofAttachment')";

        if ($conn->query($sql) === TRUE) {
            echo "<div id='success-message'>Record inserted successfully</div>";
            echo "<script>setTimeout(function() { document.getElementById('success-message').style.display = 'none'; }, 6000);</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

// Function to sanitize form inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close connection
$conn->close();
?>
