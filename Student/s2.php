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


$paperTitle = $conferenceName = $location = $publisher = $dateOfConference = $dateOfPublication = $issn = $pageNumbers = $scopus = $doi = $authorsCount = $authorPosition = $facultyCoauthor = $facultyNames = $paperPresented = $presentationMode = $coauthorsDetails = $financialSupport = $amountClaimed = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data after proper validation
    $paperTitle = test_input($_POST['paper_title']);
    $conferenceName = test_input($_POST['conference_name']);
    $location = test_input($_POST['location']);
    $publisher = test_input($_POST['publisher']);
    $dateOfConference = test_input($_POST['date_of_conference']);
    $dateOfPublication = test_input($_POST['date_of_publication']);
    $issn = test_input($_POST['issn']);
    $pageNumbers = test_input($_POST['page_numbers']);
    $scopus = test_input($_POST['scopus']);
    $doi = test_input($_POST['doi']);
    $authorsCount = test_input($_POST['authors_count']);
    $authorPosition = test_input($_POST['author_position']);
    $facultyCoauthor = test_input($_POST['faculty_coauthor']);
    $facultyNames = test_input($_POST['faculty_names']);
    $paperPresented = test_input($_POST['paper_presented']);
    $presentationMode = test_input($_POST['presentation_mode']);
    $coauthorsDetails = test_input($_POST['coauthors_details']);
    $financialSupport = test_input($_POST['financial_support']);
    $amountClaimed = test_input($_POST['amount_claimed']);

    session_start();
    $register_number = $_SESSION['Register_Number'];

    $branch = "SELECT Branch FROM student_tb WHERE Register_Number = '$register_number'";
    $branch_result = $conn->query($branch);
    $branch_row = $branch_result->fetch_assoc();
    $branch = $branch_row['Branch'];

    $targetDir = "uploads/S2/$branch/2024/";
    $paperAttachment = $targetDir . basename($_FILES["published_paper"]["name"]);

    if (move_uploaded_file($_FILES["published_paper"]["tmp_name"], $paperAttachment)) {
        // Database connection
        $sql = "INSERT INTO S2 (paper_title, conference_name, location, publisher, date_of_conference, date_of_publication, issn, page_numbers, scopus, doi, authors_count, author_position, faculty_coauthor, faculty_names, paper_presented, presentation_mode, coauthors_details, financial_support, amount_claimed, Register_Number, certificate)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssssssss", $paperTitle, $conferenceName, $location, $publisher, $dateOfConference, $dateOfPublication, $issn, $pageNumbers, $scopus, $doi, $authorsCount, $authorPosition, $facultyCoauthor, $facultyNames, $paperPresented, $presentationMode, $coauthorsDetails, $financialSupport, $amountClaimed, $register_number, $paperAttachment);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<div id='notification-container'>Record inserted successfully</div>";
            echo "<script>setTimeout(function() { document.getElementById('notification-container').style.display = 'none'; }, 6000);</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
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
    <title>S2 Student Conference Publications</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/temp.css">
    <script src="../js/script.js" defer></script>
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

        <a href="javascript:history.back()" style="text-decoration: none; color: #777777; font-size: 22px; font-weight: 800; text-align: left;">
        <i class='bx bx-arrow-back'></i>
    </a>
            
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-s2" enctype="multipart/form-data">
    
    <!-- Form fields for S2 Student Conference Publications -->
        <div class="login-box" style="background-color:#7cdd56;">
            <img src="srkrlogo.png" alt="" class="top-img" style="height: 75px; max-width: 100%;">
        </div>

        <!-- Heading -->
        <div class="login-box">
            <div class="heading">
                <h3>S2 Student Conference Publications</h3>
            </div>
        </div>

        <div class="login-box">
        <div class="user-box">
                <input type="text" name="RegNum"   value="<?php echo $_SESSION['Register_Number'];?>" readonly>
                <label id="register_number">Register Number<div id="mustnot"></div></label>
            </div>
        </div>

        <!-- Paper Title -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="paper_title" required="">
                <label>Paper Title<div id="must">*</div></label>
            </div>
        </div>

        <!-- Conference Name -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="conference_name" required="">
                <label>Conference Name<div id="must">*</div></label>
            </div>
        </div>

        <!-- Location -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="location" required="">
                <label>Location<div id="must">*</div></label>
            </div>
        </div>

        <!-- Publisher -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="publisher" required="">
                <label>Publisher<div id="must">*</div></label>
            </div>
        </div>

        <!-- Date of Conference -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="date_of_conference" required="">
                <label>Date of Conference<div id="must">*</div></label>
            </div>
        </div>

        <!-- Date of Publication -->
        <div class="login-box">
            <div class="user-box">
                <input type="date" name="date_of_publication" required="">
                <label>Date of Publication<div id="must">*</div></label>
            </div>
        </div>

        <!-- ISSN -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="issn" required="">
                <label>ISSN<div id="must">*</div></label>
            </div>
        </div>

        <!-- Page Numbers -->
        <div class="login-box">
            <div class="user-box">
                <input type="number" name="page_numbers" >
                <label>Page Numbers<div id="mustnot">(optional)</div></label>
            </div>
        </div>

        <!-- Is it Scopus? -->
        <div class="login-box">
            <div class="user-box">
                <select name="scopus" id="scopus">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label>Is it Scopus?<div id="must">*</div></label>
            </div>
        </div>

        <!-- DOI -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="doi" required="">
                <label>DOI<div id="must">*</div></label>
            </div>
        </div>

        <!-- How many Authors? -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="authors_count" required="">
                <label>How many Authors?<div id="must">*</div></label>
            </div>
        </div>

        <!-- Author Position -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="author_position" required="">
                <label>Author Position<div id="must">*</div></label>
            </div>
        </div>

        <!-- Any faculty as co-author? -->
        <div class="login-box">
            <div class="user-box">
                <select name="faculty_coauthor" id="faculty_coauthor">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label>Any faculty as co-author?<div id="must">*</div></label>
            </div>
        </div>

        <!-- If Yes, Name/s of the faculty -->
        <div class="login-box" id="faculty_names_box">
            <div class="user-box">
                <input type="text" name="faculty_names">
                <label>If Yes, Name/s of the faculty</label>
            </div>
        </div>

        <!-- Paper Presented -->
        <div class="login-box">
            <div class="user-box">
                <select name="paper_presented" id="paper_presented">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label>Paper Presented?<div id="must">*</div></label>
            </div>
        </div>

        <!-- Mode of Presentation -->
        <div class="login-box">
            <div class="user-box">
                <select name="presentation_mode" id="presentation_mode">
                    <option value="offline">Offline</option>
                    <option value="online">Online</option>
                </select>
                <label>Mode of Presentation<div id="must">*</div></label>
            </div>
        </div>

        <!-- Name, Designation, and Address of Co-Authors -->
        <div class="login-box">
            <div class="user-box">
                <input type="text" name="coauthors_details">
                <label>Name, Designation, and Address of Co-Authors <div id="mustnot">(optional)</div> </label>
            </div>
        </div>

        <!-- Any financial Support Received from college or not? -->
        <div class="login-box">
            <div class="user-box">
                <select name="financial_support" id="financial_support">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label>Any financial Support Received from college or not?<div id="must">*</div></label>
            </div>
        </div>

        <!-- Amount Claimed -->
        <!-- If yes, Amount Claimed -->
        <div class="login-box" id="ammount-claimed" >
            <div class="user-box">
                <input type="text" name="amount_claimed">
                <label>If yes, Amount Claimed</label>
            </div>
        </div>


        <!-- Is the college affiliation mentioned in the paper? -->
        <div class="login-box">
            <div class="user-box">
                <select name="college_affiliation" id="college_affiliation">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label>Is the college affiliation mentioned in the paper?<div id="must">*</div></label>
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

        

        <!-- Attach Paper -->
        <div class="login-box">
            <div class="user-box">
                <input type="file" name="published_paper">
                <label>Attach Paper<div id="must">*</div></label>
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


    <!-- JavaScript code -->
    <script>
        // Event listener for faculty co-author dropdown
        document.getElementById('faculty_coauthor').addEventListener('change', function() {
            var facultyNamesBox = document.getElementById('faculty_names_box');
            if (this.value === 'yes') {
                facultyNamesBox.style.display = 'block';
            } else {
                facultyNamesBox.style.display = 'none';
            }
        });

        // Event listener for paper presented dropdown
        document.getElementById('paper_presented').addEventListener('change', function() {
            var presentationModeBox = document.getElementById('presentation_mode');
            if (this.value === 'yes') {
                presentationModeBox.style.display = 'block';
            } else {
                presentationModeBox.style.display = 'none';
            }
        });

        // Event listener for financial support dropdown
        document.getElementById('financial_support').addEventListener('change', function() {
            var ammountClaimedBox = document.getElementById('ammount-claimed');
            if (this.value === 'yes') {
                ammountClaimedBox.style.display = 'block';
            } else {
                ammountClaimedBox.style.display = 'none';
            }
        });

        // Function to clear the form
        function clearForm() {
            document.getElementById("form-s2").reset();
            document.getElementById('faculty_names_box').style.display = 'none';
            document.getElementById('presentation_mode').style.display = 'none';
        }
    </script>


</html>
