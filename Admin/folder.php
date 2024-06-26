<?php
$activeSection = 'Folder';
include '../_dbconnect.php';

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

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../");
    exit();
}


// Function to retrieve folder names
function getFolders($dir) {
    $folders = array_filter(glob($dir . '/*'), 'is_dir');
    $folderNames = array();
    foreach ($folders as $folder) {
        $folderNames[] = basename($folder);
    }
    return $folderNames;
}

// Handle folder download request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['downloadFolder'])) {
    $folderName = $_POST['downloadFolder'];
    $zipFileName = "$folderName.zip";
    $folderPath = "../Student/uploads/$folderName/";

    // Check if folder exists
    if (!is_dir($folderPath)) {
        echo "<script>alert('Folder not found.');</script>";
        exit();
    }

    // Create a zip archive
    $zip = new ZipArchive;
    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderPath), RecursiveIteratorIterator::LEAVES_ONLY);
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen("../Student/uploads/") + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();

        // Send zip file to the browser
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=$zipFileName");
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile($zipFileName);

        // Delete zip file after sending
        unlink($zipFileName);
        exit;
    } else {
        echo "<script>alert('Failed to create zip file.');</script>";
    }
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
       
       .unique-folder-container {
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
              margin-top: 50px;

       }

       .unique-folder-btn {
           /* green background with folder shaped items and bigger*/
           background-color: #4CAF50;
           border: none;
           color: white;
           padding: 15px 32px;
           text-align: center;
           text-decoration: none;
           display: inline-block;
           font-size: 16px;
           margin: 10px 8px;
           cursor: pointer;
           border-radius: 12px;
           width: 200px;
           height: 100px;

           
       }

       .unique-folder-btn:active, .unique-folder-btn:focus, .unique-folder-btn:hover {
           outline: none;
       }

       .unique-folder-btn:hover {
           background-color: #45a049;
       }

       /* responsive  */
       @media screen and (max-width: 600px) {
           .unique-folder-container {
               margin-top: 20px;
           }
       }
   </style>
    <title>Dashboard</title>
</head>

<body>

    <?php include '_side.php'; ?>
    <?php include '_nav.php'; ?>

    <!-- Main Content -->
    <main>
        <div class="unique-folder-container">
            <?php
            // Display available folders
            $folders = getFolders('../Student/uploads');
            foreach ($folders as $folder) {
                echo "<form action='folder.php' method='post'>";
                echo "<input type='hidden' name='downloadFolder' value='$folder'>";
                echo "<button type='submit' class='unique-folder-btn'>$folder</button>";
                echo "</form>";
            }
            ?>
        </div>
    </main>

 

    </section>

    <script>
        


    </script>
</body>

</html>
