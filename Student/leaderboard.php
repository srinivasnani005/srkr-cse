<?php
$activeSection = 'leaderboard';

include '../_dbconnect.php';

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


// call the file once to update the count 
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
                    <h1 class="title">Home / Leaderboard</h1>
                    <ul class="breadcrumbs">
                        <li><a href="#">Leaderboard</a></li>
                    </ul>
                </div>
                <div class="dashboard-header-right">Total Count :<?php echo 1;  ?></div>
            </div>

            <div class="leaderboard-container">
                    <table class="leaderboard-table">
                        <thead>
                            <tr>
                                <!-- serial number -->
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Register Number</th>
                                <th>Branch</th>
                                <th>Total Count</th>
                                <?php
                                for ($i = 1; $i <= 14; $i++) {
                                    echo "<th>S{$i}</th>";
                                }
                                ?>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $sql = "SELECT * FROM student_tb ORDER BY count DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<tr>";
                                $serialcount=1;
                                while ($eachcount = $result->fetch_assoc()) {
                                    echo "<td>{$serialcount }.</td>";
                                    echo "<td>{$eachcount['Name']}</td>";
                                    echo "<td>{$eachcount['Register_Number']}</td>";
                                    echo "<td>{$eachcount['Branch']}</td>";
                                    $total_count = isset($eachcount['count']) ? $eachcount['count'] : 0;
                                    echo "<td>{$total_count}</td>";

                                    for ($i = 1; $i <= 14; $i++) {
                                        $table_name = "s" . $i;
                                        $sql1 = "SELECT COUNT(*) as count FROM {$table_name} WHERE Register_Number = '{$eachcount['Register_Number']}'";

                                        $result1 = $conn->query($sql1);
                                        $count = 0;
                                        if ($result1->num_rows > 0) {
                                            $count = $result1->fetch_assoc()['count'];
                                        }

                                        echo "<td>{$count}</td>";
                                        $total_count += $count;
                                        
                                    }
                                    $serialcount++;
                                    echo "</tr>";

                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </main>
    </section>

    <script>
    </script>
</body>

</html>
