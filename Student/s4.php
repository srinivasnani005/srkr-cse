<?php

$activeSection = 'uploadform';


include '../_dbconnect.php';

$courseName = $courseProvider = $startDate = $endDate = $enrollmentType = $facultyName = $courseCertificate = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data after proper validation
    $courseName = test_input($_POST['course_name']);
    $courseProvider = test_input($_POST['course_provider']);
    $startDate = test_input($_POST['start_date']);
    $endDate = test_input($_POST['end_date']);
    $enrollmentType = test_input($_POST['enrollment_type']);
    $facultyName = test_input($_POST['faculty_name']);

    // File upload handling
    $targetDir = "../uploads/S1/2023-2024/CSE/";
    $courseCertificate = $targetDir . basename($_FILES["file_name"]["name"]);

    if (move_uploaded_file($_FILES["file_name"]["tmp_name"], $courseCertificate)) {
        // Database connection
        

        // Check for duplicate data before inserting
        $checkDuplicate = "SELECT * FROM student_certification_courses WHERE course_name = '$courseName'";
        $result = $conn->query($checkDuplicate);

        if ($result && $result->num_rows > 0) {
            // Duplicate found, you can choose to display a message or update the existing record
            echo "Record already exists. You can choose to update the existing record if needed.";
        } else {
            // No duplicate found, proceed with insertion
            $sql = "INSERT INTO student_certification_courses (course_name, course_provider, start_date, end_date, enrollment_type, faculty_name, course_certificate)
                    VALUES ('$courseName', '$courseProvider', '$startDate', '$endDate', '$enrollmentType', '$facultyName', '$courseCertificate')";

            if ($conn->query($sql) === TRUE) {
                echo "<div id='success-message'>Record inserted successfully</div>";
                echo "<script>setTimeout(function() { document.getElementById('success-message').style.display = 'none'; }, 6000);</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
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
?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S4 Student Certification Courses</title>
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


    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-2" enctype="multipart/form-data">
        <!-- Form fields for S4 Student Certification Courses -->
        <!-- You can reuse the styling classes from the previous form -->
    
        <div class="login-box" style="background-color:#7cdd56;">
            <img src="srkrlogo.png" alt="" class="top-img" style="height: 75px; max-width: 100%;">
        </div>

        <!-- Heading -->
        <div class="login-box">
            <div class="heading">
                <h3>S4 Student Certification Courses</h3>        
            </div>
        </div>

        <div class="login-box">
        <div class="user-box">
                <input type="text" name="RegNum"  value="<?php echo $_SESSION['Register_Number'];?>" readonly>
                <label id="register_number">Register Number<div id="mustnot"></div></label>
            </div>
        </div>

        <!-- Course Name -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="course_name" required="">
                <label>Course Name<div id="must">*</div></label>
            </div>
        </div>

        <!-- Course Provider -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="course_provider" required="">
                <label>Course offered by (Cisco, AWS, Google, Udemy, etc.)<div id="must">*</div></label>
            </div>
        </div>

        <!-- Start Date -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="start_date" required="">
                <label>Start Date<div id="must">*</div></label>
            </div>
        </div>

        <!-- End Date -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="end_date" required="">
                <label>End Date<div id="must">*</div></label>
            </div>
        </div>

        <div class="login-box">
            <div class="user-box">
                <select name="enrollment_type" id="enrollment_type" required="">
                    <option value="Faculty Driven">Faculty Driven</option>
                    <option value="Self Enrollment">Self Enrollment</option>
                </select>
                <label>Select Enrollment Type<div id="must">*</div></label>
            </div>
        </div>

        <!-- Faculty Name -->
        <div class="login-box" id="faculty_name_container" style="display: none;">
            <div class="user-box">
                <input type="text" name="faculty_name" required="">
                <label>If faculty driven, name of the faculty <div id="mustnot"> (optional)</div></label>
            </div>
        </div>


        <div class="login-box">
            <div class="user-box">
                <p style="
                    text-align: left;
                    margin-left: 4px;
                    margin-top: -10px;
                    font-size: 13px;
                    color: #777777;
                    font-weight: 600;
                    ">The Student must submit all proofs in a single file (pdf) format.
                    <br>
                      It must containing the following:
                    <br>
                    <br>
                    1. 
                    <br>
                    2. 
                    <br>
                    3. 
                    <br>
                    4. 
                    <br>
                    5. 


                </p>
            </div>
        </div>

        

        <!-- Attach Course Completion Certificate -->
        <div class="login-box">
            <div class="user-box">
                <input type="file" name="file_name" >
                <label>Attach File <div id="must">*</div></label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="end-card">
            <button type="submit" class="button-1" >Submit</button>
            <button type="button" class="button-2" onclick="clearForm()">Clear form</button>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </form>

        </main>

        </section>

    


</body>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var enrollmentTypeSelect = document.getElementById('enrollment_type');
            var facultyNameContainer = document.getElementById('faculty_name_container');

            function toggleFacultyName() {
                if (enrollmentTypeSelect.value === 'Faculty Driven') {
                    facultyNameContainer.style.display = 'block';
                } else {
                    facultyNameContainer.style.display = 'none';
                }
            }

            // Toggle faculty name visibility on page load
            toggleFacultyName();

            // Toggle faculty name visibility on dropdown change
            enrollmentTypeSelect.addEventListener('change', toggleFacultyName);
        });
    </script>
</html>
