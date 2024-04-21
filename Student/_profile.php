<?php
$activeSection = 'search';
include '../_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['Register_Number'])) {
    header("Location: ../");
    exit();
}

// Fetch user data
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
    // Fetch form data
    $name = $_POST["name"];
    $location = $_POST["location"];
    $year = $_POST["year"];
    $mother = $_POST["mother"];
    $father = $_POST["father"];
    $branch = $_POST["branch"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $dob = $_POST["dob"];

    // Update user data in the database
    $sql = "UPDATE student_tb SET 
            Name='$name', 
            location='$location', 
            Year='$year', 
            Mother_Name='$mother', 
            Father_Name='$father', 
            Branch='$branch', 
            Gender='$gender', 
            Address='$address', 
            Date_of_Birth='$dob' 
            WHERE Register_Number='$searchvalue'";

    if ($conn->query($sql) === TRUE) {
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


/* Modal */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    
}

.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.modal-header h2 {
    font-size: 1.5rem;
}

.close {
    cursor: pointer;
    font-size: 1.5rem;
    color: #aaa;
}

.close:hover {
    color: #666;
}

.modal-body label {
    margin-bottom: 5px;
}

.modal-body input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.modal-body button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.modal-body button:hover {
    background-color: #0056b3;
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
                    <form action="_profile.php" method="post">
                        <label for="10th_school_name">10th School Name:</label>
                        <input type="text" id="10th_school_name" name="10th_school_name" value="<?php echo $user_data["10th_school_name"]; ?>">

                        <label for="10th_gpa">10th GPA:</label>
                        <input type="text" id="10th_gpa" name="10th_gpa" value="<?php echo $user_data["10th_gpa"]; ?>">

                        <label for="inter_college_name">Inter College Name:</label>
                        <input type="text" id="inter_college_name" name="inter_college_name" value="<?php echo $user_data["inter_college_name"]; ?>">

                        <label for="inter_gpa">Inter GPA:</label>
                        <input type="text" id="inter_gpa" name="inter_gpa" value="<?php echo $user_data["inter_gpa"]; ?>">

                        <p>College Name: SRKR Engineering College</p>
                        <label for="btech_cgpa">B.Tech CGPA:</label>
                        <input type="text" id="btech_cgpa" name="btech_cgpa" value="<?php echo $user_data["btech_cgpa"]; ?>">

                        <button type="submit">Save</button>
                    </form>
                </div>

                <div id="profile-step3" class="profile-content">
                    <h2>Achievements</h2>
                    <p>This is the content</p>
                </div>
            </div>

            <!-- Edit Modal -->
            <div id="modal" class="modal-overlay">
                <div class="modal-content" id="modalContent">
                    <div class="modal-header">
                        <h2>Edit Data</h2>
                        <span class="close" onclick="closeModal()">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="_profile.php" method="post">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo $user_data["Name"]; ?>">

                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" value="<?php echo $user_data["location"]; ?>">

                            <label for="year">Year:</label>
                            <input type="text" id="year" name="year" value="<?php echo $user_data["Year"]; ?>">

                            <label for="mother">Mother's Name:</label>
                            <input type="text" id="mother" name="mother" value="<?php echo $user_data["Mother_Name"]; ?>">

                            <label for="father">Father's Name:</label>
                            <input type="text" id="father" name="father" value="<?php echo $user_data["Father_Name"]; ?>">

                            <label for="branch">Branch:</label>
                            <input type="text" id="branch" name="branch" value="<?php echo $user_data["Branch"]; ?>">

                            <label for="gender">Gender:</label>
                            <input type="text" id="gender" name="gender" value="<?php echo $user_data["Gender"]; ?>">

                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="<?php echo $user_data["Address"]; ?>">

                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $user_data["Date_of_Birth"]; ?>">

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
