<?php
include '_dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] === 'teacher'  || $_SESSION['user_type'] === 'admin'){
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
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="../js/script.js" defer></script>
    <title>Home</title>
</head>

<body>

    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <!-- Main Content -->
    <main>
        <!-- Welcom message for Admin  -->
        <p>
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['Register_Number'];
                echo "Welcome " . strtoupper($username);
            } else {
                echo "Welcome Student ";
            }
            ?>
        </p>


    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Boxicons JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.0.7/boxicons.min.js" integrity="sha512-MQTKlzvw/bRfFm3WTrMjOsK6Aq7HgC5Uesx7Gz7StMhH/GiNAGnnukDJRUV8D2KtP8sPbQj+FLB4CHiYjOY+Bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom JS -->

    </section>
</body>

</html>
