<?php

$activeSection = 'deleteaccount';
include '../_dbconnect.php';
include '../_notification.php';



if(!isset($_SESSION["user_type"])  ||$_SESSION["user_type"] === 'student' ) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../");
    exit();
}


if (!$_SESSION['var']) {
    header("Location: ../");
    exit();
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
    <link rel="stylesheet" href="../css/temp.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="../js/script.js" defer></script>
    <title>Dashboard</title>
    <style>

main {
    padding: 20px;
}

.main-wrapper {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.main-heading {
    text-align: center;
    margin-bottom: 20px;
}

.form-label {
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
}

.form-select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.form-button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

.form-button:hover {
    background-color: #45a049;
}

.success-message {
    color: #4CAF50;
    text-align: center;
    margin-top: 20px;
}

.error-message {
    color: #FF6347;
    text-align: center;
    margin-top: 20px;
}

        
    </style>
</head>
<body>

    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <main>

<div class="main-wrapper">
    <h1 class="main-heading">Deactivate Student Accounts</h1>
    
    <!-- Deactivation by Year and Branch Form -->
    <form class="deactivate-form" method="POST" action="">
        <label for="year" class="form-label">Select Year:</label>
        <select name="year" id="year" class="form-select">
            <?php
            // Get current year
            $current_year = date("Y");
            
            // Generate options for the last 5 years
            for ($i = 0; $i < 5; $i++) {
                $year_option = $current_year - $i;
                echo "<option value='$year_option'>$year_option</option>";
            }
            ?>
        </select>
        <br>
        <label for="branch" class="form-label">Select Branch:</label>
        <select name="branch" id="branch" class="form-select">
            <option value="CSE">CSE</option>
            <option value="CSD">CSD</option>
            <option value="ECE">ECE</option>
            <option value="EEE">EEE</option>
            <option value="MECH">MECH</option>
            <option value="IT">IT</option>
            <option value="CIVIL">CIVIL</option>
            <option value="AIDS">AIDS</option>
            <option value="AIML">AIML</option>
        </select>
        <br>
        <button type="submit" name="deactivate" class="form-button">Deactivate Accounts</button>
    </form>

</div>
    
<div class="main-wrapper">
    <!-- Deactivation by Register_Number and Branch Form -->
    <form class="deactivate-form" method="POST" action="">
        <label for="register_number" class="form-label">Enter Register Number:</label>
        <input type="text" id="register_number" name="register_number" class="form-select" required>
        <br>
        <label for="branch" class="form-label">Select Branch:</label>
        <select name="branch" id="branch" class="form-select">
            <option value="CSE">CSE</option>
            <option value="CSD">CSD</option>
            <option value="ECE">ECE</option>
            <option value="EEE">EEE</option>
            <option value="MECH">MECH</option>
            <option value="IT">IT</option>
            <option value="CIVIL">CIVIL</option>
            <option value="AIDS">AIDS</option>
            <option value="AIML">AIML</option>
        </select>
        <br>
        <button type="submit" name="deactivate_register" class="form-button">Deactivate Account</button>
    </form>

    <!-- PHP code for deactivation -->
    <?php
    // Deactivate student accounts based on form submission
    if(isset($_POST['deactivate'])) {
        $year = $_POST['year'];
        $branch = $_POST['branch'];

        // Query to update student accounts
        $sql = "UPDATE student_tb SET is_verified = 2 WHERE year = '$year' AND branch = '$branch'";

        if ($conn->query($sql) === TRUE) {
            showNotification("Student accounts deactivated successfully.", "success");
        } else {
            showNotification(" Error updating student accounts: " . $conn->error , "error");
       }
    }

    // Deactivate student account by Register Number and Branch
    if(isset($_POST['deactivate_register'])) {
        $register_number = $_POST['register_number'];
        $branch = $_POST['branch'];

        // Query to update student accounts
        $sql = "UPDATE student_tb SET is_verified = 2 WHERE Register_Number = '$register_number' AND branch = '$branch'";

        if ($conn->query($sql) === TRUE) {
            showNotification("Student account deactivated successfully.", "success");
        } else {
            showNotification("Error updating student account: " . $conn->error, "error");
        }
    }
    ?>
</div>

</main>

        

    </section>


</body>
</html>
