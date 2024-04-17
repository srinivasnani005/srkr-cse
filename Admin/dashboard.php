<?php
$activeSection = 'dashboard';
include '../_dbconnect.php';

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
                    <h1 class="title">Home / Dashboard</h1>
                    <ul class="breadcrumbs">
                        <li><a href="#">Dashboard</a></li>
                    </ul>
                </div>
                <div class="dashboard-header-right">Total Count :<?php echo 1;  ?></div>
            </div>






            <div class="container-form">
            <?php


                $categories = array(
                    array(
                        'title' => 'S1 Student Publications',
                        'description' => 'This category includes publications by students. Explore the latest research and findings.',
                        'count' => 10,
                        'table' => 'S1'


                    ),
                    array(
                        'title' => 'S2 Student Conference Publications',
                        'description' => 'Find conference publications by students, showcasing their academic contributions.',
                        'count' => 0,
                        'table' => 'S2'


                    ),
                    array(
                        'title' => 'S3 Student Internships',
                        'description' => 'Browse through the internships undertaken by students to gain practical experience.',
                        'count' => 0,
                        'table' => 'S3'

                    ),
                    array(
                        'title' => 'S4 Student Certificate Courses',
                        'description' => 'Explore the certificate courses completed by students to enhance their skills.',
                        'count' => 0,
                        'table' => 'S4'
                    ),
                    array(
                        'title' => 'S5 Student Workshops Participated',
                        'description' => 'Discover workshops participated in by students to broaden their knowledge.',
                        'count' => 0,
                        'table' => 'S5'
                    ),
                    array(
                        'title' => 'S6 Academic Events Organized by Students',
                        'description' => 'Find out about academic events organized by students, fostering learning and collaboration.',
                        'count' => 0,
                        'table' => 'S6'
                    ),
                    array(
                        'title' => 'S7 Student NPTEL Certifications',
                        'description' => 'View NPTEL certifications achieved by students, demonstrating their expertise in various subjects.',
                        'count' => 0,
                        'table' => 'S7'
                    ),
                    array(
                        'title' => 'S8 Student Professional Body Memberships',
                        'description' => 'Explore professional body memberships held by students, connecting them with industry professionals.',
                        'count' => 0,
                        'table' => 'S8'
                    ),
                    array(
                        'title' => 'S9 Student Participations and Awards/Prizes',
                        'description' => 'Explore student participations and awards/prizes earned by students for their achievements.',
                        'count' => 0,
                        'table' => 'S9'
                    ),
                    array(
                        'title' => 'S10 Students Qualified in Competitive Exams',
                        'description' => 'Find students who have qualified in competitive exams, demonstrating their academic excellence.',
                        'count' => 0,
                        'table' => 'S10'
                    ),
                    array(
                        'title' => 'S11 Student Industry Visits',
                        'description' => 'Discover industry visits undertaken by students to gain practical insights into various sectors.',
                        'count' => 0,
                        'table' => 'S11'
                    ),
                    array(
                        'title' => 'S12 Student Outreach / Service programs participated',
                        'description' => 'Learn about outreach and service programs in which students have actively participated, contributing to society.',
                        'count' => 0,
                        'table' => 'S12'
                    ),
                    array(
                        'title' => 'S13 Student Higher Studies',
                        'description' => 'Explore the higher studies pursued by students, including postgraduate and doctoral programs.',
                        'count' => 0,
                        'table' => 'S13'
                    ),
                    array(
                        'title' => 'S14 Student Projects',
                        'description' => 'Discover student projects spanning various fields, showcasing their creativity and innovation.',
                        'count' => 0,
                        'table' => 'S14'
                    )
                );

                // Loop through the categories array to generate HTML content
                    foreach ($categories as $category) {
                        echo '<div class="box-form">';
                        echo '<span class="box-title">' . $category['title'] . '</span>';
                        echo '<hr>';
                        echo '<p class="box-description">' . $category['description'] . '</p>';
                        echo '<div class="box-actions">';
                        echo '<span class="box-count">Count: ' . $category['count'] . '</span>';
                        echo '<button type="" class="box-view" onclick="openPopup(\'' . $category['table'] . '\')">View</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                

            ?>

            </div>


            <!-- Popup container -->

            <?php

                function generatePopup($tableName, $conn) {
                    echo "<div id='{$tableName}Popup' class='popup-container'>";
                    echo "<div class='popup-header'>";
                    echo "<button class='download-button' onclick='exportToExcel(\"$tableName\")'>Download Excel</button>";
                    // h3 title for the table cliked tablename by converting the first letter to uppercase
                    echo "<h3 class='popup-title'>" . ucfirst($tableName) . "</h3>";
                    echo "<span class='popup-close' onclick='closePopup(\"{$tableName}\")'>&times;</span>";
                    echo "</div>";
                    echo "<div class='popup-content'>";

                    $column_query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'";
                    $column_result = $conn->query($column_query);

                    $columns = array();
                    if ($column_result && $column_result->num_rows > 0) {
                        while ($column = $column_result->fetch_assoc()) {
                            $columns[] = $column['COLUMN_NAME'];
                        }
                    }

                    // store the count of each student in a session variable names ad s1_count, s2_count, s3_count, etc.
                    $count_query = "SELECT Register_Number, COUNT(*) as count FROM $tableName GROUP BY Register_Number";
                    $count_result = $conn->query($count_query);

                    if ($count_result && $count_result->num_rows > 0) {
                        while ($count = $count_result->fetch_assoc()) {
                            $_SESSION[$tableName . '_count'][$count['Register_Number']] = $count['count'];
                        }
                    }

                    

                    $latest_query = "SELECT * FROM $tableName ORDER BY ID DESC LIMIT 1";
                    $latest_result = $conn->query($latest_query);

                    $data = array();
                    if ($latest_result && $latest_result->num_rows > 0) {
                        $latest_data = $latest_result->fetch_assoc();
                        foreach ($columns as $column) {
                            $data[] = $latest_data[$column];
                        }
                    }

                    echo "<table class='popup-table'>";
                    echo "<thead>";
                    echo "<tr>";
                    foreach ($columns as $column) {
                        echo "<th>{$column}</th>";
                    }
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    echo "<tr>";
                    foreach ($data as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                    echo "</tbody>";
                    echo "</table>";

                    echo "</div>";
                    echo "</div>";
                }

                // Generating popups for each table
                for ($i = 1; $i <= 14; $i++) {
                    generatePopup("s{$i}", $conn);
                }
            ?>

        </div>
    </main>

 

    </section>

    <script>
        const datalink =document.querySelectorAll('.datalink');

        datalink.forEach((link)=>{
            link.addEventListener('click',()=>{
                datalink.forEach((link)=>{
                    link.classList.remove('active');
                })
                link.classList.add('active');
            })
        })



    </script>
</body>

</html>
