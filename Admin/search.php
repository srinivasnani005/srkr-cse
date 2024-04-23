<?php
$activeSection = 'search';
include '../_dbconnect.php';

$searchvalue = $_GET['search'];

$sql = "SELECT * FROM student_tb WHERE Register_Number = '$searchvalue'";
$result = $conn->query($sql);

// Check if user data is found
if ($result->num_rows > 0) {
    // User data found, fetch and store in $user_data
    $user_data = $result->fetch_assoc();
} else {
    // User data not found, handle accordingly
    // For example, redirect to an error page or display a message
    echo "User data not found!";
    exit();
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $father = $_POST["father"];
    $mother = $_POST["mother"];
    $dob = $_POST["dob"];
    $year = $_POST["year"];

    // Update user data in the database
    $sql = "UPDATE student_tb SET Name='$name', Email='$email', Phone_Number='$phone', Father_Name='$father', Mother_Name='$mother', Date_of_Birth='$dob', Year='$year' WHERE Register_Number='$username'";

    if ($conn->query($sql) === TRUE) {
        // User data updated successfully
        // Redirect to the same page to refresh the data
        header("Location: search.php");
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
    <script src="../js/script.js" defer></script>
    <title>Search Student</title>
</head>

<body>

    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <!-- Main Content -->
    <section id="main-content">
        <div class="profile-container" >
            <div class="profile-part1">
                <div class="profile-part1-pic">
                    <img src="nani.jpg" alt="Profile Picture">
                </div>

                <div class="profile-part1-details">
                    <p class="student-name"><?php echo $user_data["Name"]?></p>
                    <p> <?php echo $user_data["Register_Number"]; ?></p>
                    <p><?php echo $user_data["Branch"]; ?></p>
                </div>
            </div>

            
            <div class="profile-part2">
            <div class="profile-navbar">
                <span class="profile-nav-item" onclick="showProfile('profile-step1')">Details</span>
                <span class="profile-nav-item" onclick="showProfile('profile-step2')">Internships</span>
                <span class="profile-nav-item" onclick="showProfile('profile-step3')">Achievements</span>
                <!-- <span class="profile-nav-item" onclick="showProfile('profile-step4')">Projects</span> -->
            </div>



                <!-- <div class="profile-part2-buttons">
                    <button class="Generate-resume" onclick="GenerateResume()">Generate Resume</button>
                    <button class="edit-button" onclick="openEditModal()">Edit Data</button>

                </div> -->

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
                    <h2>Step 2 Content</h2>
                    <p>This is the content for Step 2.</p>
                </div>

                <div id="profile-step3" class="profile-content">
                    <h2>Step 3 Content</h2>
                    <p>This is the content for Step 3.</p>
                </div>

                <div id="profile-step4" class="profile-content">
                    <h2>Step 4 Content</h2>
                    <p>This is the content for Step 4.</p>
                </div>
            </div>


            <div id="modal" class="modal-overlay">
                <div class="modal-content" id="modalContent">
                    <div class="modal-header">
                        <h2>Edit Data</h2>
                        <span class="close" onclick="closeModal()">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="student_profile1.php" method="post">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo $user_data["Name"]; ?>">

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $user_data["Email"]; ?>">

                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone" value="<?php echo $user_data["Phone_Number"]; ?>">

                            <label for="father">Father Name:</label>
                            <input type="text" id="father" name="father" value="<?php echo $user_data["Father_Name"]; ?>">

                            <label for="mother">Mother Name:</label>
                            <input type="text" id="mother" name="mother" value="<?php echo $user_data["Mother_Name"]; ?>">

                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $user_data["Date_of_Birth"]; ?>">

                            <label for="year">Academic Year:</label>
                            <input type="text" id="year" name="year" value="<?php echo $user_data["Year"]; ?>">

                            <button type="submit">Save</button>
                        </form>        
                    </div>
                </div>

            </div>
        </div>
    </section>

 

    </section>

    <script>
        function showProfile(profileStep) {
        var contents = document.querySelectorAll('.profile-content');
        contents.forEach(function(content) {
            content.classList.remove('active');
        });

        // Show the selected profile content
        var selectedContent = document.getElementById(profileStep);
        if (selectedContent) {
            selectedContent.classList.add('active');
        }
    }

    // create a function for generate button where it opens a pop up to select the ui for resume
    function GenerateResume() {
        window.open('resume_generate.php', '_blank', 'width=700,height=500');
    }

    // create a function for edit button where it opens a pop up to edit the data
    function openEditModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
    }

    function closeModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
    }

    // Close the modal if user clicks outside the modal
    window.onclick = function(event) {
        var modal = document.getElementById('modal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    

    </script>
</body>

</html>
