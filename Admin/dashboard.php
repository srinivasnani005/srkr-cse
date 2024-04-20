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
                <div class="dashboard-header-right">
                <?php
                    $totalCount = 0;
                    $individualCounts = array();

                    for ($i = 1; $i <= 14; $i++) {
                        $table = 'S' . $i;
                        $query = "SELECT COUNT(*) AS count FROM $table";
                        $result = mysqli_query($conn, $query);
                        
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $individualCounts[$table] = $row['count'];
                            $totalCount += $row['count'];
                        }
                    }

                    echo "Total Count: " . $totalCount;
                    ?>

                </div>
            </div>

            <div class="container-form">
                <?php
                $categories = array(
                    array(
                        'title' => 'S1 Student Publications',
                        'description' => 'This category includes publications by students. Explore the latest research and findings.',
                        'count' => $individualCounts['S1'],
                        'table' => 'S1'
                    ),
                    array(
                        'title' => 'S2 Student Conference Publications',
                        'description' => 'Find conference publications by students, showcasing their academic contributions.',
                        'count' => $individualCounts['S2'],
                        'table' => 'S2'
                    ),
                    array(
                        'title' => 'S3 Student Internships',
                        'description' => 'Browse through the internships undertaken by students to gain practical experience.',
                        'count' => $individualCounts['S3'],
                        'table' => 'S3'
                    ),
                    array(
                        'title' => 'S4 Student Certificate Courses',
                        'description' => 'Explore the certificate courses completed by students to enhance their skills.',
                        'count' => $individualCounts['S4'],
                        'table' => 'S4'
                    ),
                    array(
                        'title' => 'S5 Student Workshops Participated',
                        'description' => 'Discover workshops participated in by students to broaden their knowledge.',
                        'count' => $individualCounts['S5'],
                        'table' => 'S5'
                    ),
                    array(
                        'title' => 'S6 Academic Events Organized by Students',
                        'description' => 'Find out about academic events organized by students, fostering learning and collaboration.',
                        'count' => $individualCounts['S6'],
                        'table' => 'S6'
                    ),
                    array(
                        'title' => 'S7 Student NPTEL Certifications',
                        'description' => 'View NPTEL certifications achieved by students, demonstrating their expertise in various subjects.',
                        'count' => $individualCounts['S7'],
                        'table' => 'S7'
                    ),
                    array(
                        'title' => 'S8 Student Professional Body Memberships',
                        'description' => 'Explore professional body memberships held by students, connecting them with industry professionals.',
                        'count' => $individualCounts['S8'],
                        'table' => 'S8'
                    ),
                    array(
                        'title' => 'S9 Student Participations and Awards/Prizes',
                        'description' => 'Explore student participations and awards/prizes earned by students for their achievements.',
                        'count' => $individualCounts['S9'],
                        'table' => 'S9'
                    ),
                    array(
                        'title' => 'S10 Students Qualified in Competitive Exams',
                        'description' => 'Find students who have qualified in competitive exams, demonstrating their academic excellence.',
                        'count' => $individualCounts['S10'],
                        'table' => 'S10'
                    ),
                    array(
                        'title' => 'S11 Student Industry Visits',
                        'description' => 'Discover industry visits undertaken by students to gain practical insights into various sectors.',
                        'count' => $individualCounts['S11'],
                        'table' => 'S11'
                    ),
                    array(
                        'title' => 'S12 Student Outreach / Service programs participated',
                        'description' => 'Learn about outreach and service programs in which students have actively participated, contributing to society.',
                        'count' => $individualCounts['S12'],
                        'table' => 'S12'
                    ),
                    array(
                        'title' => 'S13 Student Higher Studies',
                        'description' => 'Explore the higher studies pursued by students, including postgraduate and doctoral programs.',
                        'count' => $individualCounts['S13'],
                        'table' => 'S13'
                    ),
                    array(
                        'title' => 'S14 Student Projects',
                        'description' => 'Discover student projects spanning various fields, showcasing their creativity and innovation.',
                        'count' => $individualCounts['S14'],
                        'table' => 'S14'
                    )
                );

                foreach ($categories as $category) {
                    echo '<div class="box-form">';
                    echo '<span class="box-title">' . $category['title'] . '</span>';
                    echo '<hr>';
                    echo '<p class="box-description">' . $category['description'] . '</p>';
                    echo '<div class="box-actions">';
                    echo '<span class="box-count">Count: ' . $category['count'] . '</span>';
                    echo "<a href='_viewdata.php?table={$category['table']}' class='box-view'>View</a>";
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>

    </section>

    <script>
        const datalink = document.querySelectorAll('.datalink');

        datalink.forEach((link) => {
            link.addEventListener('click', () => {
                datalink.forEach((link) => {
                    link.classList.remove('active');
                })
                link.classList.add('active');
            })
        })
    </script>
</body>

</html>
