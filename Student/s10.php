<?php



$activeSection = 'uploadform';
include '../_dbconnect.php';

// Redirect users who are not logged in or are students
if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] === 'student') {
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
$sql = "CREATE TABLE IF NOT EXISTS Students_Competitive_Exams (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    academic_year VARCHAR(255) NOT NULL,
    exam_name VARCHAR(255) NOT NULL,
    exam_date DATE NOT NULL,
    score DECIMAL(5,2) NOT NULL,
    rank VARCHAR(255),
    level VARCHAR(255) NOT NULL,
    score_card_path VARCHAR(255) NOT NULL
)";



// Close connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $academic_year = $_POST['academic_year'];
    $exam_name = $_POST['exam_name'];
    $exam_date = $_POST['exam_date'];
    $score = $_POST['score'];
    $rank = $_POST['rank'];
    $level = $_POST['level'];

    $register_number = $_SESSION['Register_Number'];

    $branch = "SELECT Branch FROM student_tb WHERE Register_Number = '$register_number'";
    $branch_result = $conn->query($branch);
    $branch_row = $branch_result->fetch_assoc();
    $branch = $branch_row['Branch'];


    $targetDir = "../uploads/S10/$branch/2024/";
    $scoreCard = $targetDir . basename($_FILES["score_card"]["name"]);

    if (move_uploaded_file($_FILES["score_card"]["tmp_name"], $scoreCard)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["score_card"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Insert data into database
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Students_Competitive_Exams (academic_year, exam_name, exam_date, score, rank, level, score_card_path)
            VALUES ('$academic_year', '$exam_name', '$exam_date', '$score', '$rank', '$level', '$scoreCard')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S10 Students Qualified in Competitive Exams</title>

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
            
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-s10">
        <!-- Form fields for S10 Students Qualified in Competitive Exams -->
        <div class="login-box">
            <div class="heading">
                <h3>S10 Students Qualified in Competitive Exams</h3>        
            </div>
        </div>

        
        <div class="login-box">
        <div class="user-box">
                <input type="text" name="RegNum"  value="<?php echo $_SESSION['Register_Number'];?>" readonly>
                <label id="register_number">Register Number<div id="mustnot"></div></label>
            </div>
        </div>

<!-- 
        Academic Year
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="academic_year" required="">
                <label>Academic Year *</label>
            </div>
        </div> -->

        <!-- Name of the competitive exam -->
        <div class="login-box">
            <div class="user-box">
                <select name="exam_name" required="">
                    <option value="">Select Exam</option>
                    <option value="GATE">GATE</option>
                    <option value="CAT">CAT</option>
                    <option value="GRE">GRE</option>
                    <option value="TOEFL">TOEFL</option>
                    <option value="APPSC">APPSC</option>
                    <option value="UPSC">UPSC</option>
                    <option value="Bank">Bank</option>
                    <option value="Other">Other</option>
                </select>
                <label>Name of the competitive exam *</label>
            </div>
        </div>

        <!-- Date of Exam -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="exam_date" required="">
                <label>Date of Exam *</label>
            </div>
        </div>

        <!-- Score -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="score" required="">
                <label>Score *</label>
            </div>
        </div>

        <!-- Rank if any -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="rank">
                <label>Rank if any</label>
            </div>
        </div>

        <!-- Level -->
        <div class="login-box">
            <div class="user-box">
                <select name="level" required="">
                    <option value="">Select Level</option>
                    <option value="State">State</option>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
                <label>Level *</label>
            </div>
        </div>

        <!-- Attach Score Card/ Rank Card -->
        <div class="login-box">
            <div class="user-box">
                <input type="file" name="score_card" required="">
                <label>Attach Score Card/ Rank Card *</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="end-card">
            <button type="submit">Submit</button>
            <button type="button" onclick="clearForm()">Clear form</button>
        </div>
    </form>

    </main>

</section>

    <!-- JavaScript for dynamic behavior -->
    <script>
        function clearForm() {
            document.getElementById("form-s10").reset();
        }
    </script>
</body>
</html>
