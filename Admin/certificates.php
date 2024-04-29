<?php
$activeSection = 'certificates';
include '../_dbconnect.php';

if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../");
    exit();
}

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
    <script src="../js/script.js" defer></script>

    <style>
        /* Main Content styles */
        .main {
            padding: 20px;
        }

        .container {
            max-width: 100%;
            /* margin: 0 auto; */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
            margin-left: 20px;
            background-color: #fff;
            overflow-x: auto;
            justify-content: left;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap;
        }

        .table th {
            background-color: #28a745; /* Green color */
            color: #fff;
            white-space: nowrap;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table a {
            color: #007bff;
            text-decoration: none;
        }

        .table a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Certificates</title>
</head>

<body>

    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <!-- Main Content -->
    <main>
        <div class="container">
            <h2>Uploaded Forms (Recently Submitted)</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Register Number</th>
                        <th>Student Name</th>
                        <th>Form Name</th>
                        <th>Certificate Name</th>
                        <th>Form Uploaded Date</th>
                        <th>View Certificate</th>
                        <th>Download Certificate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetching data from all s1 to s14 tables
                    for ($i = 1; $i <= 14; $i++) {
                        $tableName = 's' . $i;
                        // Fetching data from the current table, ordered by submission date in descending order
                        $sql = "SELECT $tableName.*, student_tb.name FROM $tableName JOIN student_tb ON $tableName.Register_Number = student_tb.Register_Number ORDER BY $tableName.submission_date DESC";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>" . $row['Register_Number'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td><b>" . $tableName . "</b></td>"; // Displaying table name as Form Name
                                echo "<td>" . $row['certificate_name'] . "</td>";
                                echo "<td>" . $row['submission_date'] . "</td>";
                                echo "<td><a href='" . $row['certificate'] . "' target='_blank'>View Certificate</a></td>";
                                echo "<td><a href='" . $row['certificate'] . "' download>Download Certificate</a></td>";
                                echo "</tr>";
                                $count++;
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
