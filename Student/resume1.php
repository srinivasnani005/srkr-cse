<?php
// Include mpdf library
require_once 'mpdf_v8.0.10.php'; // Assuming mpdf_v8.0.10.php is in the same directory as this file


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



// Include database connection
require_once('_dbconnect.php');

// Fetch data from the student_tb table
$sql = "SELECT * FROM student_tb";
$result = $conn->query($sql);

// Check if there is any data
if ($result->num_rows > 0) {
    // Fetching data and storing it in an array
    $data = $result->fetch_assoc();
} else {
    // Handle case where no data is found
    $data = array();
}

// Close the database connection
$conn->close();

// Function to generate PDF from HTML
function generatePDF($html) {
    // Create an instance of mpdf
    $mpdf = new \Mpdf\Mpdf();

    // Write HTML content to PDF
    $mpdf->WriteHTML($html);

    // Output PDF as a download
    $mpdf->Output('resume.pdf', \Mpdf\Output\Destination::DOWNLOAD);
}

// Check if the download button is clicked
if (isset($_POST['download'])) {
    // Generate PDF from HTML content
    generatePDF(ob_get_clean());
    exit(); // Prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <!-- CSS styles -->
    <style>

body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
            color: #333;
        }

        .header p {
            margin: 5px 0;
            font-size: 18px;
            color: #666;
        }

        .bio {
            margin-bottom: 20px;
        }

        .content {
            display: flex;
            justify-content: space-between;
        }

        .left,
        .right {
            width: 48%;
        }

        .left h2,
        .right h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .left p,
        .right p {
            margin: 0;
            color: #666;
        }

        .button-container {
            text-align: center;
        }

        .download-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .download-button:hover {
            background-color: #45a049;
        }

        </style>
</head>
<body>
<div class="container">
        <div class="header">
            <h1><?php echo $data['Name']; ?></h1>
            <p><?php echo $data['Designation']; ?></p>
            <p><?php echo $data['Phone_Number']; ?></p>
            <p><?php echo $data['Email']; ?></p>
            <p><?php echo $data['Location']; ?></p>
            <p><?php echo $data['Profile_Link']; ?></p>
        </div>

        <div class="bio">
            <p><?php echo $data['Bio']; ?></p>
        </div>

        <div class="content">
            <div class="left">
                <h2>Education</h2>
                <p><?php echo $data['Education']; ?></p>

                <h2>Technical Skills</h2>
                <p><?php echo $data['Technical_Skills']; ?></p>

                <h2>Languages</h2>
                <p><?php echo $data['Languages']; ?></p>
            </div>

            <div class="right">
                <h2>Projects</h2>
                <p><?php echo $data['Projects']; ?></p>

                <h2>Internship</h2>
                <p><?php echo $data['Internship']; ?></p>

                <h2>Certifications</h2>
                <p><?php echo $data['Certifications']; ?></p>
            </div>
        </div>

        <div class="button-container">
            <form method="post">
                <button type="submit" class="download-button" name="download">Download PDF</button>
            </form>
        </div>
    </div>
</body>
</html>