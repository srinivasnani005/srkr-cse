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



// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS S14 (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    academic_year VARCHAR(255) NOT NULL,
    project_title VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    description TEXT NOT NULL,
    faculty_mentor VARCHAR(255) NOT NULL,
    project_domain VARCHAR(255) NOT NULL,
    tools_used VARCHAR(255) NOT NULL,
    semester VARCHAR(255) NOT NULL,
    github_link VARCHAR(255) NOT NULL
)";

// Close connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $academic_year = $_POST['academic_year'];
    $project_title = $_POST['project_title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $faculty_mentor = $_POST['faculty_mentor'];
    $project_domain = $_POST['project_domain'];
    $tools_used = $_POST['tools_used'];
    $semester = $_POST['semester'];
    $github_link = $_POST['github_link'];

    // Insert data into database

    
$register_number = $_SESSION['Register_Number'];

$branch = "SELECT Branch FROM student_tb WHERE Register_Number = '$register_number'";
$branch_result = $conn->query($branch);
$branch_row = $branch_result->fetch_assoc();
$branch = $branch_row['Branch'];


$targetDir = "../uploads/S7/$branch/2024/";


    $sql = "INSERT INTO S14 (academic_year, project_title, start_date, end_date, description, faculty_mentor, project_domain, tools_used, semester, github_link)
            VALUES ('$academic_year', '$project_title', '$start_date', '$end_date', '$description', '$faculty_mentor', '$project_domain', '$tools_used', '$semester', '$github_link')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        include 'totalcount.php';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S14 Student Projects</title>
    <style>
        /* Your CSS styles here */


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

    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-s14">
        <!-- Form fields for S14 Student Projects -->
        <div class="login-box">
            <div class="heading">
                <h3>S14 Student Projects</h3>
            </div>
        </div>

        
        <div class="login-box">
        <div class="user-box">
                <input type="text" name="RegNum"  value="<?php echo $_SESSION['Register_Number'];?>" readonly>
                <label id="register_number">Register Number<div id="mustnot"></div></label>
            </div>
        </div>


        <!-- Academic Year -->
        <!-- <div class="login-box">
            <div class="user-box">
                <input type="text" name="academic_year" required>
                <label>Academic Year *</label>
            </div>
        </div> -->

        <!-- Project Title -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="project_title" required>
                <label>Project Title *</label>
            </div>
        </div>

        <!-- Start Date -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="start_date" required>
                <label>Start Date *</label>
            </div>
        </div>

        <!-- End Date -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="end_date" required>
                <label>End Date *</label>
            </div>
        </div>

        <!-- Description -->
        <div class="login-box">
            <div class="user-box">
                <textarea name="description" required></textarea>
                <label>Description *</label>
            </div>
        </div>

        <!-- Faculty Mentor -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="faculty_mentor" required>
                <label>Faculty Mentor *</label>
            </div>
        </div>

        <!-- Project Domain -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="project_domain" required>
                <label>Project Domain *</label>
            </div>
        </div>

        <!-- Tools Used -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="tools_used" required>
                <label>Tools Used *</label>
            </div>
        </div>

        <!-- Semester -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="semester" required>
                <label>Semester *</label>
            </div>
        </div>

        <!-- Github Link -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="github_link" required>
                <label>Github Link *</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="end-card">
            <button type="submit">Submit</button>
        </div>
    </form>

    </main>

</section>
    <!-- JavaScript for dynamic behavior -->
    <script>
        function clearForm() {
            document.getElementById("form-s14").reset();
        }
    </script>
</body>
</html>
