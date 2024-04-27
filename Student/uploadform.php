<?php
$activeSection = 'uploadform';
include '../_dbconnect.php';

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
    <title>Upload Form</title>
</head>

<body>

    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <!-- Main Content -->
    <main>


    <div id="createform" class="content-section visible">
                <h1 class="title">Upload Form</h1>
                <ul class="breadcrumbs">
                    <li><a href="#">Home</a></li>
                    <li class="divider">/</li>
                    <li><a href="#" class="active">Upload Form</a></li>
                </ul>



            <div class="container-form">
                <?php
                    $categories = array(
                        array(
                          'title' => 'S1 Student Publications',
                          'description' => 'This category includes publications by students. Explore the latest research and findings.',
                          'filename' => 's1.php'
                      ),
                      array(
                          'title' => 'S2 Student Conference Publications',
                          'description' => 'Find conference publications by students, showcasing their academic contributions.',
                          'filename' => 's2.php'
                      ),
                      array(
                          'title' => 'S3 Student Internships',
                          'description' => 'Browse through the internships undertaken by students to gain practical experience.',
                          'filename' => 's3.php'
                      ),
                      array(
                          'title' => 'S4 Student Certificate Courses',
                          'description' => 'Explore the certificate courses completed by students to enhance their skills.',
                          'filename' => 's4.php'
                      ),
                      array(
                          'title' => 'S5 Student Workshops Participated',
                          'description' => 'Discover workshops participated in by students to broaden their knowledge.',
                          'filename' => 's5.php'
                      ),
                      array(
                          'title' => 'S6 Academic Events Organized by Students',
                          'description' => 'Find out about academic events organized by students, fostering learning and collaboration.',
                          'filename' => 's6.php'
                      ),
                      array(
                          'title' => 'S7 Student NPTEL Certifications',
                          'description' => 'View NPTEL certifications achieved by students, demonstrating their expertise in various subjects.',
                          'filename' => 's7.php'
                      ),
                      array(
                          'title' => 'S8 Student Professional Body Memberships',
                          'description' => 'Explore professional body memberships held by students, connecting them with industry professionals.',
                          'filename' => 's8.php'
                      ),
                      array(
                          'title' => 'S9 Student Participations and Awards/Prizes',
                          'description' => 'Explore student participations and awards/prizes earned by students for their achievements.',
                          'filename' => 's9.php'
                      ),
                      array(
                          'title' => 'S10 Students Qualified in Competitive Exams',
                          'description' => 'Find students who have qualified in competitive exams, demonstrating their academic excellence.',
                          'filename' => 's10.php'
                      ),
                      array(
                          'title' => 'S11 Student Industry Visits',
                          'description' => 'Discover industry visits undertaken by students to gain practical insights into various sectors.',
                          'filename' => 's11.php'
                      ),
                      array(
                          'title' => 'S12 Student Outreach / Service programs participated',
                          'description' => 'Learn about outreach and service programs in which students have actively participated, contributing to society.',
                          'filename' => 's12.php'
                      ),
                      array(
                          'title' => 'S13 Student Higher Studies',
                          'description' => 'Explore the higher studies pursued by students, including postgraduate and doctoral programs.',
                          'filename' => 's13.php'
                      ),
                      array(
                          'title' => 'S14 Student Projects',
                          'description' => 'Discover student projects spanning various fields, showcasing their creativity and innovation.',
                          'filename' => 's14.php'
                      )
                  );

                    // Loop through the categories array to generate HTML content for the create form
                    foreach ($categories as $category) {
                        echo '<div class="create-form-box">';
                        echo '<span class="create-form-title">' . $category['title'] . '</span>';
                        echo '<hr>';
                        echo '<p class="create-form-description">' . $category['description'] . '</p>';
                        echo '<div class="create-form-actions">';
                        // open form from teh Forms folder and then s1.php....
                        echo '<button class="create-form-button" onclick="openForm(\'' . $category['filename'] . '\')">Upload Form</button>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div id="' . $category['filename'] . '-container" class="hidden-form-container"></div>';



                        

                    }
                    ?>
                    
                </div>






                
            </div>




            
    </main>

 

    </section>

    <script>

    function openForm(filename) {
        window.open(filename, '_parent');
    }
        


    </script>
</body>

</html>
