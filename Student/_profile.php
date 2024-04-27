<?php
$activeSection = 'search';
include '../_dbconnect.php';

if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../");
    exit();
}

// $_SESSION['loggedin'] = true;
// $_SESSION['user_type'] = 'student';
// $_SESSION['Register_Number'] = $username;

// check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] === 'teacher'  || $_SESSION['user_type'] === 'admin'){
    header("Location: ../");
    exit();
}

$searchvalue = $_SESSION['Register_Number'];

$sql = "SELECT * FROM student_tb WHERE Register_Number = '$searchvalue'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo "User data not found!";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data with default values
    $name = isset($_POST["name"]) ? $_POST["name"] : $user_data["Name"];
    $location = isset($_POST["location"]) ? $_POST["location"] : $user_data["location"];
    $register_number = isset($_POST["register_number"]) ? $_POST["register_number"] : $user_data["Register_Number"];
    $year = isset($_POST["year"]) ? $_POST["year"] : $user_data["Year"];
    $email = isset($_POST["email"]) ? $_POST["email"] : $user_data["Email"];
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : $user_data["Phone_Number"];
    $mother = isset($_POST["mother"]) ? $_POST["mother"] : $user_data["Mother_Name"];
    $father = isset($_POST["father"]) ? $_POST["father"] : $user_data["Father_Name"];
    $branch = isset($_POST["branch"]) ? $_POST["branch"] : $user_data["Branch"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : $user_data["Gender"];
    $address = isset($_POST["address"]) ? $_POST["address"] : $user_data["Address"];
    $dob = isset($_POST["dob"]) ? $_POST["dob"] : $user_data["Date_of_Birth"];
    $is_verified = isset($_POST["is_verified"]) ? $_POST["is_verified"] : $user_data["is_verified"];
    $password = isset($_POST["password"]) ? $_POST["password"] : $user_data["Password"];
    $section = isset($_POST["section"]) ? $_POST["section"] : $user_data["Section"];
    $id = isset($_POST["id"]) ? $_POST["id"] : $user_data["id"];
    $count = isset($_POST["count"]) ? $_POST["count"] : $user_data["count"];
    $tenth_gpa = isset($_POST["10th_gpa"]) ? $_POST["10th_gpa"] : $user_data["10th_gpa"];
    $tenth_school_name = isset($_POST["10th_school_name"]) ? $_POST["10th_school_name"] : $user_data["10th_school_name"];
    $inter_gpa = isset($_POST["inter_gpa"]) ? $_POST["inter_gpa"] : $user_data["inter_gpa"];
    $inter_college_name = isset($_POST["inter_college_name"]) ? $_POST["inter_college_name"] : $user_data["inter_college_name"];
    $btech_cgpa = isset($_POST["btech_cgpa"]) ? $_POST["btech_cgpa"] : $user_data["btech_cgpa"];

    // Update user data in the database
    $sql = "UPDATE student_tb SET 
            Name='$name', 
            location='$location', 
            Register_Number='$register_number', 
            Year='$year', 
            Email='$email', 
            Phone_Number='$phone', 
            Mother_Name='$mother', 
            Father_Name='$father', 
            Branch='$branch', 
            Gender='$gender', 
            Address='$address', 
            Date_of_Birth='$dob', 
            is_verified='$is_verified', 
            Password='$password', 
            Section='$section', 
            id='$id', 
            count='$count', 
            10th_gpa='$tenth_gpa', 
            10th_school_name='$tenth_school_name', 
            inter_gpa='$inter_gpa', 
            inter_college_name='$inter_college_name', 
            btech_cgpa='$btech_cgpa' 
            WHERE Register_Number='$searchvalue'";

    if ($conn->query($sql) === TRUE) {
        // User data updated successfully
        // Redirect to the same page to refresh the data
        header("Location: _profile.php");
        exit();
    } else {
        // Error updating user data
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/search.css">

    <style>
        /* Add this CSS code to your existing CSS file or create a new one */

/* Profile Container */
.profile-container {
    display: flex;
    flex-direction: column;
    margin: 20px;
}

/* Profile Part 1 */
.profile-part1 {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.profile-part1-details {
    font-size: 1.2rem;
}

/* Profile Part 2 */
.profile-part2 {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile-navbar {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.profile-nav-item {
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.profile-nav-item:hover {
    background-color: #eaeaea;
}

.profile-content {
    display: none;
}

.profile-content.active {
    display: block;
}

/* Blue Table */
.blue-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.blue-table th, .blue-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}


/* Modal Overlay */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Modal Content */
.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 90%; /* Set maximum width for the modal */
    max-height: 90%; /* Set maximum height for the modal */
    overflow-y: auto; /* Enable vertical scrollbar when content exceeds height */
}

/* Modal Header */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.modal-header h2 {
    margin: 0;
}

.close {
    cursor: pointer;
    font-size: 1.5rem;
    color: #aaa;
}

.close:hover {
    color: #666;
}

/* Modal Body */
.modal-body {
    padding: 20px;
}

/* Input Container - 2 Inputs per Row on Larger Screens */
.input-container {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

/* Input Fields - 50% width on Larger Screens */
.modal-body input {
    /* width: calc(50% - 10px);  */
    margin-right: 20px;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Ensure padding and border are included in the width */
}

/* Button */
.modal-body button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.modal-body button:hover {
    background-color: #0056b3;
}

/* scroll bar hidden */
.modal-content::-webkit-scrollbar {
    display: none;
}

/* Close Button */
.close {
    font-size: 1.5rem;
}



    </style>
    <title>Search Student</title>
</head>

<body>
    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <!-- Main Content -->
    <section id="main-content">
        <div class="profile-container">
            <div class="profile-part1">
                <div class="profile-part1-pic">
                    <img src="nani.jpg" alt="Profile Picture">
                </div>

                <div class="profile-part1-details">
                    <p class="student-name"><?php echo $user_data["Name"] ?></p>
                    <p><?php echo $user_data["Register_Number"]; ?></p>
                    <p><?php echo $user_data["Branch"]; ?></p>
                </div>
            </div>

            <div class="profile-part2">
                <div class="profile-navbar">
                    <span class="profile-nav-item" onclick="showProfile('profile-step1')">Details</span>
                    <span class="profile-nav-item" onclick="showProfile('profile-step2')">Grades</span>
                    <span class="profile-nav-item" onclick="showProfile('profile-step3')">Achievements</span>
                </div>

                

                <div class="profile-part2-buttons">
                    <button class="Generate-resume" onclick="GenerateResume()">Generate Resume</button>
                    <button class="edit-button" onclick="openEditModal()">Edit Data</button>
                </div>

                <div id="profile-step1" class="profile-content active">
                    <table class="blue-table">
                        <tr>
                            <th>Register Number</th>
                            <td><?php echo $user_data["Register_Number"]; ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $user_data["Name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Branch</th>
                            <td><?php echo $user_data["Branch"]; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $user_data["Email"]; ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $user_data["Phone_Number"]; ?></td>
                        </tr>
                        <tr>
                            <th>Father Name</th>
                            <td><?php echo $user_data["Father_Name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Mother Name</th>
                            <td><?php echo $user_data["Mother_Name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td><?php echo $user_data["Date_of_Birth"]; ?></td>
                        </tr>
                        <tr>
                            <th>Academic Year</th>
                            <td><?php echo $user_data["Year"]; ?></td>
                        </tr>
                    </table>
                </div>

                <div id="profile-step2" class="profile-content">
                    <h2>Grades</h2>
                    <table class="blue-table">
                        <tr>
                            <th>10th School Name</th>
                            <td><?php echo $user_data["10th_school_name"]; ?></td>
                        </tr>
                        <tr>
                            <th>10th GPA</th>
                            <td><?php echo $user_data["10th_gpa"]; ?></td>
                        </tr>
                        <tr>
                            <th>Inter College Name</th>
                            <td><?php echo $user_data["inter_college_name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Inter GPA</th>
                            <td><?php echo $user_data["inter_gpa"]; ?></td>
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td>SRKR Engineering College</td>
                        </tr>
                        <tr>
                            <th>B.Tech CGPA</th>
                            <td><?php echo $user_data["btech_cgpa"]; ?></td>
                        </tr>
                    </table>
                </div>


                <div id="profile-step3" class="profile-content">
                    <h2>Achievements</h2>
                    <p>This is the content</p>
                </div>
            </div>

            <!-- Edit Modal -->
            <!-- Edit Modal -->
            <div id="modal" class="modal-overlay">
                <div class="modal-content" id="modalContent">
                    <div class="modal-header">
                        <h2>Edit Data</h2>
                        <span class="close" onclick="closeModal()">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="_profile.php" method="post">
                            <!-- Input fields for editing personal details -->
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo $user_data["Name"]; ?>"readonly >

                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" value="<?php echo $user_data["location"]; ?>">

                            <label for="year">Year:</label>
                            <input type="text" id="year" name="year" value="<?php echo $user_data["Year"]; ?>" hidden>

                            <label for="mother">Mother's Name:</label>
                            <input type="text" id="mother" name="mother" value="<?php echo $user_data["Mother_Name"]; ?>">

                            <label for="father">Father's Name:</label>
                            <input type="text" id="father" name="father" value="<?php echo $user_data["Father_Name"]; ?>">

                            <label for="branch">Branch:</label>
                            <input type="text" id="branch" name="branch" value="<?php echo $user_data["Branch"]; ?>">

                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender">
                                <option value="male" <?php if ($user_data["Gender"] == "male") echo "selected"; ?>>Male</option>
                                <option value="female" <?php if ($user_data["Gender"] == "female") echo "selected"; ?>>Female</option>
                            </select>


                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="<?php echo $user_data["Address"]; ?>">

                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $user_data["Date_of_Birth"]; ?>">

                            <!-- Input fields for editing 10th details -->
                            <label for="10th_school_name">10th School Name:</label>
                            <input type="text" id="10th_school_name" name="10th_school_name" value="<?php echo $user_data["10th_school_name"]; ?>">

                            <label for="10th_gpa">10th GPA:</label>
                            <input type="text" id="10th_gpa" name="10th_gpa" value="<?php echo $user_data["10th_gpa"]; ?>">

                            <!-- Input fields for editing inter details -->
                            <label for="inter_college_name">Inter College Name:</label>
                            <input type="text" id="inter_college_name" name="inter_college_name" value="<?php echo $user_data["inter_college_name"]; ?>">

                            <label for="inter_gpa">Inter GPA:</label>
                            <input type="text" id="inter_gpa" name="inter_gpa" value="<?php echo $user_data["inter_gpa"]; ?>">

                            <!-- Input fields for editing B.Tech details -->
                            <label for="btech_cgpa">B.Tech CGPA:</label>
                            <input type="text" id="btech_cgpa" name="btech_cgpa" value="<?php echo $user_data["btech_cgpa"]; ?>">

                            <button type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        function showProfile(profileStep) {
            var contents = document.querySelectorAll('.profile-content');
            contents.forEach(function (content) {
                content.classList.remove('active');
            });

            // Show the selected profile content
            var selectedContent = document.getElementById(profileStep);
            if (selectedContent) {
                selectedContent.classList.add('active');
            }
        }

        function GenerateResume() {
            window.open('resume_generate.php', '_blank', 'width=700,height=500');
        }

        function openEditModal() {
            var modal = document.getElementById('modal');
            modal.style.display = 'block';
        }

        function closeModal() {
            var modal = document.getElementById('modal');
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            var modal = document.getElementById('modal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>
