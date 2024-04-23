<?php

$activeSection = 'uploadform';


include '../_dbconnect.php';

$academicYear = $eventName = $eventType = $organizedBy = $eventCoordinator = $startDate = $endDate = $participantsCount = $feesPerStudent = $facultyInCharge = $facultyName = $reportPdf = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data after proper validation
    $academicYear = 2024;
    $eventName = test_input($_POST['event_name']);
    $eventType = test_input($_POST['event_type']);
    $organizedBy = test_input($_POST['organized_by']);
    $eventCoordinator = test_input($_POST['event_coordinator']);
    $startDate = test_input($_POST['start_date']);
    $endDate = test_input($_POST['end_date']);
    $participantsCount = test_input($_POST['participants_count']);
    $feesPerStudent = test_input($_POST['fees_per_student']);
    $facultyInCharge = test_input($_POST['faculty_in_charge']);
    $facultyName = test_input($_POST['faculty_name']);


    $register_number = $_SESSION['Register_Number'];

    $branch = "SELECT Branch FROM student_tb WHERE Register_Number = '$register_number'";
    $branch_result = $conn->query($branch);
    $branch_row = $branch_result->fetch_assoc();
    $branch = $branch_row['Branch'];


    $targetDir = "../uploads/S6/$branch/2024/";


    $reportPdf = $targetDir . basename($_FILES["report_pdf"]["name"]);

    if (move_uploaded_file($_FILES["report_pdf"]["tmp_name"], $reportPdf)) {
       

        // Check for duplicate data before inserting
        $checkDuplicate = "SELECT * FROM student_academic_events WHERE event_name = '$eventName'";
        $result = $conn->query($checkDuplicate);

        if ($result && $result->num_rows > 0) {
            // Duplicate found, you can choose to display a message or update the existing record
            echo "Record already exists. You can choose to update the existing record if needed.";
        } else {
            // No duplicate found, proceed with insertion
            $sql = "INSERT INTO student_academic_events (academic_year, event_name, event_type, organized_by, event_coordinator, start_date, end_date, participants_count, fees_per_student, faculty_in_charge, faculty_name, report_pdf, Register_Number)
                    VALUES ('$academicYear', '$eventName', '$eventType', '$organizedBy', '$eventCoordinator', '$startDate', '$endDate', '$participantsCount', '$feesPerStudent', '$facultyInCharge', '$facultyName', '$reportPdf', '$register_number')";

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
    <title>S6 Academic Events Organized by Students</title>
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

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-6" enctype="multipart/form-data">
        <!-- Form fields for S6 Academic Events Organized by Students -->
        <div class="login-box" style="background-color:#7cdd56;">
            <img src="srkrlogo.png" alt="" class="top-img" style="height: 75px; max-width: 100%;">
        </div>

        <!-- Heading -->
        <div class="login-box">
            <div class="heading">
                <h3>S6 Academic Events Organized by Students</h3>        
            </div>
        </div>


        <div class="login-box">
        <div class="user-box">
                <input type="text" name="RegNum"  value="<?php echo $_SESSION['Register_Number'];?>" readonly>
                <label id="register_number">Register Number<div id="mustnot"></div></label>
            </div>
        </div>

        

        <!-- Name of the Event -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="event_name" required="">
                <label>Name of the Event<div id="must">*</div></label>
            </div>
        </div>

        <!-- Type of the Event -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="event_type" required="">
                <label>Type of the Event<div id="must">*</div></label>
            </div>
        </div>

        <!-- Organized by -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="organized_by" required="">
                <label>Organized by<div id="must">*</div></label>
            </div>
        </div>

        <!-- Event Coordinator Name -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="event_coordinator" required="">
                <label>Event Coordinator (student) Name<div id="must">*</div></label>
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

        <!-- No. of students participated -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="participants_count" required="">
                <label>No. of students participated<div id="must">*</div></label>
            </div>
        </div>

        <!-- Participation fees per student -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="fees_per_student"required="">
                <label>Participation fees per student if any<div id="mustnot">(optional)</div></label>
            </div>
        </div>

        <!-- Faculty In-Charge -->
        <div class="login-box">
            <div class="user-box">
                <select name="faculty_in_charge" id="faculty_in_charge">
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
                <label>Faculty In-Charge If any<div id="must">*</div></label>
            </div>
        </div>

        <!-- Name of the faculty -->
        <div class="login-box" id="faculty_name_box" style="display: none;">
            <div class="user-box">
                <input type="text" name="faculty_name">
                <label>If Yes, Name of the faculty</label>
            </div>
        </div>

        <!-- Attach a report in single pdf -->
        <div class="login-box">
            <div class="user-box">
                <input type="file" name="report_pdf">
                <label>Attach a report in single pdf<div id="must">*</div></label>
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
</body>

<script>
    document.getElementById('faculty_in_charge').addEventListener('change', function() {
            var facultyNameBox = document.getElementById('faculty_name_box');
            if (this.value === 'yes') {
                facultyNameBox.style.display = 'block';
            } else {
                facultyNameBox.style.display = 'none';
            }
        });

        function clearForm() {
            document.getElementById("form-6").reset();
            document.getElementById('faculty_name_box').style.display = 'none'; // Hide faculty name box on form reset
        }
</script>
</html>
