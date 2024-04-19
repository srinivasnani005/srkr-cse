<?php



$activeSection = 'uploadform';
include '../_dbconnect.php';



$professionalBodyName = $registrationDate = $membershipNumber = $membershipCard = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data after proper validation
    $professionalBodyName = test_input($_POST['professional_body_name']);
    $registrationDate = test_input($_POST['registration_date']);
    $membershipNumber = test_input($_POST['membership_number']);

    $register_number = $_SESSION['Register_Number'];

    $branch = "SELECT Branch FROM student_tb WHERE Register_Number = '$register_number'";
    $branch_result = $conn->query($branch);
    $branch_row = $branch_result->fetch_assoc();
    $branch = $branch_row['Branch'];


    $targetDir = "../uploads/S8/$branch/2024/";
    $membershipCard = $targetDir . basename($_FILES["membership_card"]["name"]);

    // Check if file is selected
    if (!empty($_FILES["membership_card"]["name"])) {
        // Check file type and size
        $allowedTypes = array('jpg', 'jpeg', 'png', 'pdf'); // Add more allowed file types if needed
        $fileType = strtolower(pathinfo($membershipCard, PATHINFO_EXTENSION));
        $maxFileSize = 5 * 1024 * 1024; // 5 MB
        if (!in_array($fileType, $allowedTypes)) {
            echo "Error: Only JPG, JPEG, PNG, and PDF files are allowed.";
        } elseif ($_FILES["membership_card"]["size"] > $maxFileSize) {
            echo "Error: File size exceeds the limit of 5MB.";
        } elseif (!move_uploaded_file($_FILES["membership_card"]["tmp_name"], $membershipCard)) {
            echo "Error: Failed to upload file.";
        }
    }

    // Database connection
   

    // Check for duplicate data before inserting
    $checkDuplicate = "SELECT * FROM student_pro_body_mem WHERE professional_body_name = ?";
    $stmt = $conn->prepare($checkDuplicate);
    $stmt->bind_param("s", $professionalBodyName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Duplicate found, you can choose to display a message or update the existing record
        echo "Record already exists. You can choose to update the existing record if needed.";
    } else {
        // No duplicate found, proceed with insertion
        $sql = "INSERT INTO student_pro_body_mem (professional_body_name, registration_date, membership_number, membership_card)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $professionalBodyName, $registrationDate, $membershipNumber, $membershipCard);

        if ($stmt->execute()) {
            echo "<div id='success-message'>Record inserted successfully</div>";
            echo "<script>setTimeout(function() { document.getElementById('success-message').style.display = 'none'; }, 6000);</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

}

// Function to sanitize form inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S8 Student Professional Body Memberships</title>
    <!-- Include CSS styles -->
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
            
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-s8" enctype="multipart/form-data">
        <!-- Form fields for S8 Student Professional Body Memberships -->
        <div class="login-box" style="background-color:#7cdd56;">
            <img src="srkrlogo.png" alt="" class="top-img" style="height: 75px; max-width: 100%;">
        </div>

        <!-- Heading -->
        <div class="login-box">
            <div class="heading">
                <h3>S8 Student Professional Body Memberships</h3>        
            </div>
        </div>

        
        <div class="login-box">
        <div class="user-box">
                <input type="text" name="RegNum"  value="<?php echo $_SESSION['Register_Number'];?>" readonly>
                <label id="register_number">Register Number<div id="mustnot"></div></label>
            </div>
        </div>


        <!-- Name of the Professional Body -->
        <div class="login-box">
            <div class="user-box">
                <select name="professional_body_name" required="">
                    <option value="" disabled selected>Select Professional Body</option>
                    <option value="IEEE">IEEE</option>
                    <option value="ACM">ACM</option>
                    <option value="ISTE">ISTE</option>
                    <option value="CSI">CSI</option>
                    <option value="ACE">ACE</option>
                    <!-- Add more options as needed -->
                </select>
                <label>Name of the Professional Body<div id="must">*</div></label>
            </div>
        </div>

        <!-- Date of registration -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="registration_date" required="">
                <label>Date of registration<div id="must">*</div></label>
            </div>
        </div>

        <!-- Membership Number -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="membership_number" required="">
                <label>Membership Number<div id="must">*</div></label>
            </div>
        </div>

        <!-- Attach membership Card -->
        <div class="login-box">
            <div class="user-box">
                <input type="file" name="membership_card">
                <label>Attach membership Card<div id="must">*</div></label>
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

    <!-- JavaScript for dynamic behavior -->
    <script>
        function clearForm() {
            document.getElementById("form-s8").reset();
        }
    </script>
</body>
</html>
