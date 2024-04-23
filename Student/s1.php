<?php


$activeSection = 'uploadform';
include '../_dbconnect.php';





$paperTitle = $journalName = $indexingInformation = $impactFactor = $impactFactorValue = $impactFactorSource = $publicationDate = $doi = $pageNumbers = $issn = $authorPosition = $coauthors = $collegeNameInPaper = $paperAttachment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paperTitle = test_input($_POST['paper_title']);
    $journalName = test_input($_POST['journal_name']);
    $indexingInformation = test_input($_POST['indexing_information']);
    $impactFactor = test_input($_POST['impact_factor']);
    if ($impactFactor == "yes") {
        $impactFactorValue = test_input($_POST['impact_factor_value']);
        $impactFactorSource = test_input($_POST['impact_factor_source']);
    }
    $publicationDate = test_input($_POST['publication_date']);
    $doi = test_input($_POST['doi']);
    $pageNumbers = test_input($_POST['page_numbers']);
    $issn = test_input($_POST['issn']);
    $authorPosition = test_input($_POST['author_position']);
    $coauthors = test_input($_POST['coauthors']);
    $collegeNameInPaper = test_input($_POST['college_name_in_paper']);

    $register_number = $_SESSION['Register_Number'];

    $branch = "SELECT Branch FROM student_tb WHERE Register_Number = '$register_number'";
    $branch_result = $conn->query($branch);
    $branch_row = $branch_result->fetch_assoc();
    $branch = $branch_row['Branch'];


    $targetDir = "uploads/S1/$branch/2024/";
    $paperAttachment = $targetDir . basename($_FILES["paper_attachment"]["name"]);

    if (move_uploaded_file($_FILES["paper_attachment"]["tmp_name"], $paperAttachment)) {
        // Database connection


        $sql = "INSERT INTO S1 (paper_title, journal_name, indexing_information, impact_factor, impact_factor_value, impact_factor_source, publication_date, doi, page_numbers, issn, author_position, coauthors, college_name_in_paper, certificate, Register_Number)
                VALUES ('$paperTitle', '$journalName', '$indexingInformation', '$impactFactor', '$impactFactorValue', '$impactFactorSource', '$publicationDate', '$doi', '$pageNumbers', '$issn', '$authorPosition', '$coauthors', '$collegeNameInPaper', '$paperAttachment', '$register_number')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='notification-container'>Record inserted successfully</div>";
            echo "<script>setTimeout(function() { document.getElementById('success-message').style.display = 'none'; }, 6000);</script>";
            // call the file to update the count in student_tb
            include 'totalcount.php';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>S1 Student Publications</title>

    <style>
        

             
html {
    scroll-behavior: smooth;
}

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');

body{
    height:100vh;
    text-align: center;
    background-color: #e2eee0;

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

.login-box .user-box select:focus + label,
.login-box .user-box select:valid + label {
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
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #d4edda; /* Green background color */
    color: #155724; /* Dark green text color */
    border: 1px solid #c3e6cb; /* Green border color */
    border-radius: 8px; /* Rounded corners */
    padding: 20px; /* Increased padding */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Increased box shadow */
    animation: slideInRight 0.5s ease-in-out, fadeOut 0.5s ease-in-out 5s forwards;
    z-index: 9999;
    max-width: 350px; /* Increased max-width for responsiveness */
    font-size: 16px; /* Increased font size */
}

/* Animation keyframes */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(0);
    }
}
@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}


    </style>
</head>
<body>

        <?php include '_side.php'; ?>
        <?php include '_nav.php'; ?>

        <!-- Main Content -->
        <main>



    <!-- create a back to dahboard button where it has to close the current tab and move tot he previous tab okay   -->
    <a href="javascript:history.back()" style="text-decoration: none; color: #777777; font-size: 22px; font-weight: 800; text-align: left;">
        <i class='bx bx-arrow-back'></i>
    </a>

    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-s1" enctype="multipart/form-data">
        
    
    <!-- Form fields for S1 Student Publications -->
        <div class="login-box" style="background-color:#7cdd56;">
            <img src="srkrlogo.png" alt="" class="top-img" style="height: 75px; max-width: 100%;">
        </div>

        <!-- Heading -->
        <div class="login-box">
            <div class="heading">
                <h3>S1 Student Publications</h3>        
            </div>
        </div>

        <div class="login-box">
        <div class="user-box">
                <input type="text" name="RegNum"  value="<?php echo $_SESSION['Register_Number'];?>" readonly>
                <label id="register_number">Register Number<div id="mustnot"></div></label>
            </div>
        </div>

        <!-- Paper Title -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="paper_title" required="">
                <label>Paper Title <div id="must">*</div></label>
            </div>
        </div>

        <!-- Journal Name -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="journal_name" required="">
                <label>Journal Name <div id="must">*</div></label>
            </div>
        </div>

        <div class="login-box">
            <div class="user-box">
                <select name="indexing_information" id="indexing_information">
                    <option value="Scopus">Scopus</option>
                    <option value="SCI/SCIE">SCI/SCIE</option>
                    <option value="ESCI">ESCI</option>
                    <option value="Both Scopus and Web of Science">Both Scopus and Web of Science</option>
                    <option value="Google Scholar">Google Scholar</option>
                    <option value="Other">Other</option>
                </select>
                <label>Major Indexing Information <div id="must">*</div></label>
            </div>
        </div>

        <!-- Impact Factor -->
        <div class="login-box">
            <div class="user-box">
                <select name="impact_factor" id="impact_factor">
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
                <label>Impact Factor <div id="must">*</div></label>
            </div>
        </div>

        <!-- If Yes, What is Impact factor? -->
        <div class="login-box" id="impact_factor_value_box" style="display: none;">
            <div class="user-box">
                <input type="text" name="impact_factor_value">
                <label>If Yes, What is Impact factor? <div id="must">*</div></label>
            </div>
        </div>

        <!-- Source of Impact factor -->
        <div class="login-box" id="impact_factor_source_box" style="display: none;">
            <div class="user-box">
                <input type="text" name="impact_factor_source">
                <label>Source of Impact factor <div id="must">*</div></label>
            </div>
        </div>

        <!-- Date of Publication -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="publication_date" required="">
                <label>Date of Publication <div id="must">*</div></label>
            </div>
        </div>

        <!-- DOI -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="doi" required="">
                <label>DOI <div id="must">*</div></label>
            </div>
        </div>

        <!-- Page Numbers -->
        <div class="login-box">
            <div class="user-box">
                <input type="number" name="page_numbers" required="">
                <label>Page Numbers <div id="must">*</div></label>
            </div>
        </div>

        <!-- ISSN -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="issn" required="">
                <label>ISSN <div id="must">*</div></label>
            </div>
        </div>

        <!-- Author Position -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="author_position" required="">
                <label>Author Position <div id="must">*</div></label>
            </div>
        </div>

        <!-- Name of Coauthors -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="coauthors">
                <label>Name of Coauthors <div id="mustnot">(optional)</div></label>
            </div>
        </div>

        <!-- College Name in Paper -->
        <div class="login-box">
            <div class="user-box">
                <select name="college_name_in_paper" id="college_name_in_paper">
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
                <label>College Name in Paper<div id="must">*</div></label>
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

        <!-- Attach the Paper -->
        <div class="login-box">
            <div class="user-box">
                <input type="file" name="paper_attachment">
                <label>Attach the Paper<div id="must">*</div></label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="end-card">
            <button type="submit" class="button-1">Submit</button>
            <button type="button" class="button-2" onclick="clearForm()">Clear form</button>
        </div>

        <br><br><br><br><br>        
    </form>

    </main>

    </section>


</body>
    <script>
        document.getElementById('impact_factor').addEventListener('change', function() {
            var impactFactorValueBox = document.getElementById('impact_factor_value_box');
            var impactFactorSourceBox = document.getElementById('impact_factor_source_box');
            if (this.value === 'yes') {
                impactFactorValueBox.style.display = 'block';
                impactFactorSourceBox.style.display = 'block';
            } else {
                impactFactorValueBox.style.display = 'none';
                impactFactorSourceBox.style.display = 'none';
            }
        });

        document.getElementById('college_name_in_paper').addEventListener('change', function() {
            var collegeNameBox = document.getElementById('college_name_box');
            if (this.value === 'yes') {
                collegeNameBox.style.display = 'block';
            } else {
                collegeNameBox.style.display = 'none';
            }
        });

        function clearForm() {
            document.getElementById("form-s1").reset();
            document.getElementById('impact_factor_value_box').style.display = 'none';
            document.getElementById('impact_factor_source_box').style.display = 'none';
            document.getElementById('college_name_box').style.display = 'none';
        }
    </script>
</html>
