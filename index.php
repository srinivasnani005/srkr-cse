<?php 
include '_dbconnect.php'; 

// Query to get total number of students
$sql_students = "SELECT COUNT(*) AS total_students FROM student_tb";
$result_students = mysqli_query($conn, $sql_students);
$row_students = mysqli_fetch_assoc($result_students);
$total_students = $row_students['total_students'];

// Query to get total number of teachers
$sql_teacher = "SELECT COUNT(*) AS total_teachers FROM teacher_tb";
$result_teacher = mysqli_query($conn, $sql_teacher);
$row_teachers = mysqli_fetch_assoc($result_teacher);
$total_teachers = $row_teachers["total_teachers"];

// Query to get total number of certificates from tables s1 to s14
$total_certificates = 0;
for ($i = 1; $i <= 14; $i++) {
    $table_name = "s" . $i;
    $sql_certificates = "SELECT COUNT(*) AS count FROM $table_name";
    $result_certificates = mysqli_query($conn, $sql_certificates);
    $row_certificates = mysqli_fetch_assoc($result_certificates);
    $total_certificates += $row_certificates['count'];
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Data Management System</title>
    <link rel="icon" href="path/to/favicon.png" type="image/png">
    <link rel="stylesheet" href="css/t1.css">
    <style>
        /* Add your custom styles here */
        .body-content {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 50px;
            flex-direction: row;
        }

        .content-item {
            /* flex-basis: calc(50% - 40px); */
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .content-item h2 {
            margin-bottom: 10px;
        }

        .content-item p {
            color: #666;
        }

    </style>
</head>
<body>
    <?php include '_nav.php'; ?>
    <main>
        <div class="background-image">
            <div class="background-content">
                <h1 class="background-title">Academic Data Management System</h1>
                <p class="background-text">Empowering students with seamless academic management.</p>
                <a href="#" class="download-btn">View Grades</a>
                <a href="#" class="whats-new-btn">What's New</a>
            </div>
        </div>

        <div class="body-content">
            <div class="content-item">
                <h2>Total Number of Students</h2>
                <p>Currently enrolled students in the system.</p>
                <h3><?php echo $total_students; ?></h3>
            </div>

            <div class="content-item">
                <h2>Total Number of Teachers</h2>
                <p>Number of teachers in the system.</p>
                <h3><?php echo $total_teachers; ?></h3>
            </div>

            <div class="content-item">
                <h2>Total Number of Certificates</h2>
                <p>Number of certificates issued.</p>
                <h3><?php echo $total_certificates; ?></h3>
            </div>
        </div>
    </main>

    <?php include '_modal.php'; ?>
    <!-- Include any additional components or modules here -->
    <?php include '_footer.php'; ?>

    <script src="js/t1.js" defer></script>
</body>
</html>
