<head>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/temp.css">
    <script src="../js/script.js" defer></script>
</head>
<style>
    .college-logo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }
</style>
<section id="sidebar">
    <a href="" class="brand">
        <img src="logo.png" alt="SRKR Logo" class="college-logo">
        <?php         

     

        if(isset($_SESSION['Register_Number'])) {
            $username = $_SESSION['Register_Number'];
            echo strtoupper($username);
        } else {
            echo "StudentSite";
        }
        ?>
    </a>
    <ul class="side-menu">
        <li><a href="dashboard.php" class="body-link <?php echo ($activeSection === 'dashboard') ? 'active' : ''; ?>" data-section="dashboard"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
        <li class="divider" data-text="main">Main</li>
        <li>
            <a href="#" class="body-link <?php echo ($activeSection === 'academicyears') ? 'active' : ''; ?>" data-section="Academicyears"><i class='bx bxs-inbox icon' ></i> Academic Years<i class='bx bx-chevron-right icon-right' ></i></a>
            <ul class="side-dropdown">
                <li><a href="#">2023-2027</a></li>
                <li><a href="#">2022-2026</a></li>
                <li><a href="#">2021-2025</a></li>
                <li><a href="#">2020-2024</a></li>
                <li><a href="#">2019-2023</a></li>
                <li><a href="#">2018-2022</a></li>
            </ul>
        </li>
        <li><a href="leaderboard.php" class="body-link <?php echo ($activeSection === 'leaderboard') ? 'active' : ''; ?>" data-section="leaderboard"><i class='bx bxs-chart icon' ></i>LeaderBoard</a></li>
        <!-- <li><a href="certificates.php" class="body-link <?php echo ($activeSection === 'certificates') ? 'active' : ''; ?>" data-section="certificates"><i class='bx bxs-book icon' ></i>Certificates</a></li> -->
        <li><a href="uploadform.php" class="body-link <?php echo ($activeSection === 'uploadform') ? 'active' : ''; ?>" data-section="uploadform"><i class='bx bxs-widget icon' ></i>Upload Form</a></li>
        <!-- <li><a href="folder.php" class="body-link <?php echo ($activeSection === 'Folder') ? 'active' : ''; ?>" id="load_content_btn" data-section="Folder"><i class='bx bxs-widget icon' ></i>/</a></li> -->
        <li class="divider" data-text="study and forms"></li>
        <li><a href="#" class="body-link" data-section="yourcertificates"><i class='bx bx-table icon' ></i>Your Certificates</a></li>
        <li>
            <!-- <a href="#"><i class='bx bxs-notepad icon' ></i> Fields <i class='bx bx-chevron-right icon-right' ></i></a>
            <ul class="side-dropdown">
                <li><a href="#">F1</a></li>
                <li><a href="#">F2</a></li>
                <li><a href="#">F3</a></li>
                <li><a href="#">F4</a></li>
            </ul> -->
        <li>
            <a href="#"><i class='bx bxs-notepad icon' ></i> Student Journalpub <i class='bx bx-chevron-right icon-right' ></i></a>
            <ul class="side-dropdown">
                <li><a href="#">S1</a></li>
                <li><a href="#">S2</a></li>
                <li><a href="#">S3</a></li>
                <li><a href="#">S4</a></li>
                <li><a href="#">S5</a></li>
                <li><a href="#">S6</a></li>
            </ul>
        </li>
    </ul>
</section>
