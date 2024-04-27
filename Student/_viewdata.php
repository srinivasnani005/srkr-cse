<?php
$activeSection = 'dashboard';
include '../_dbconnect.php';
// Redirect users who are not logged in or are students
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] === 'teacher'  || $_SESSION['user_type'] === 'admin'){
    header("Location: ../");
    exit();
}


// Handle logout

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../");
    exit();
}


?>
<!doctype html>
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
    <style>
        /* Custom styling for the "View Certificate" link */
        .view-certificate-link {
            display: inline-block;
            padding: 5px 10px;
            background-color: var(--blue);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .view-certificate-link:hover {
            background-color: var(--green-clr);
        }
    </style>
    <script src="../js/script.js" defer></script>
    <title>Dashboard</title>
</head>

<body>

    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <!-- Main Content -->
    <main>
        <div id="dashboard" class="content-section visible">
            <div class="dashboard-header">
                <div class="dashboard-header-left">
                    <h1 class="title">Home / Dashboard</h1>
                    <ul class="breadcrumbs">
                        <li><a href="#">Dashboard</a></li>
                    </ul>
                </div>
                <!-- <div class="dashboard-header-right">Total Count :<?php echo 1; ?></div> -->
            </div>

            <a href="javascript:history.back()" style="text-decoration: none; color: #777777; font-size: 22px; font-weight: 800; text-align: left;">
                <i class='bx bx-arrow-back'></i>
            </a>

            <div class="leaderboard-container">

                <?php
                if (isset($_GET['table'])) {
                    $tableName = $_GET['table'];
                    $sql = "SELECT * FROM $tableName WHERE Register_Number = '{$_SESSION['Register_Number']}'";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        echo "<div class='table-container'>";
                        echo "<h2 class='table-heading'>Table: {$tableName}</h2>";
                        echo "<table class='leaderboard-table'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>S.No</th>";

                        // Display column names
                        while ($fieldinfo = $result->fetch_field()) {
                            if ($fieldinfo->name !== 'id') {
                                echo "<th>{$fieldinfo->name}</th>";
                            }
                        }
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        $serialcount = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$serialcount}</td>";
                            foreach ($row as $key => $value) {
                                if ($key === 'certificate') {
                                    // If the column corresponds to the certificate file path, create a styled link to open the file
                                    echo "<td><a href='resume.pdf' target='_blank' class='view-certificate-link'>View Certificate</a></td>";
                                } elseif ($key !== 'id') {
                                    echo "<td>{$value}</td>";
                                }
                            }
                            echo "</tr>";
                            $serialcount++;
                        }

                        echo "</tbody>";
                        echo "</table>";

                        echo "<button onclick='exportToExcel()' style='text-decoration: none; cursor:pointer; border:none; color: #fff; background-color: var(--blue); padding: 10px 15px; border-radius: 5px; margin-top: 20px; display: inline-block;'>Download Excel</button>";

                        echo "</div>";
                    } else {
                        echo "No data found";
                    }
                } else {
                    echo "Table parameter is missing";
                }
                ?>

            </div>
        </div>
    </main>
    </section>

    <script>
        function exportToExcel() {
            var table = document.querySelector('.leaderboard-table');
            var html = table.outerHTML;

            var excelFile = '\uFEFF' + html;

            var blob = new Blob([excelFile], { type: 'application/vnd.ms-excel' });

            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'table.xls';
            link.click();
        }
    </script>
</body>

</html>
