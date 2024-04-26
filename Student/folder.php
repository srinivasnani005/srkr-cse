<?php
$activeSection = 'Folder';
include '_dbconnect.php';
// Redirect users who are not logged in or are students
if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] === 'student') {
    header("Location: ../");
    exit();
}

// Handle logout

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../");
    exit();
}




// This PHP script handles the folder selection and initiates a download process for the selected folder.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['downloadFolder'])) {
    $folderName = $_POST['downloadFolder'];
    $zip = new ZipArchive;
    $zipFileName = "$folderName.zip";

    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        $folderPath = "../Student/uploads/$folderName/";
        if (is_dir($folderPath)) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderPath), RecursiveIteratorIterator::LEAVES_ONLY);
            foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen("../Student/uploads/") + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
        }
        $zip->close();

        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=$zipFileName");
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile($zipFileName);
        unlink($zipFileName);
        exit;
    } else {
        echo "<script>alert('Failed to create zip file.');</script>";
    }
}

function getFolders($dir) {
    $folders = array_filter(glob($dir . '/*'), 'is_dir');
    $folderNames = array();
    foreach ($folders as $folder) {
        $folderNames[] = basename($folder);
    }
    return $folderNames;
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
    <link rel="stylesheet" href="css/temp.css">
    <script src="js/script.js" defer></script>
    <style>
       
       .unique-folder-container {
           text-align:left;
           margin-top: 20px;
           display: flex;
           flex-direction: row;
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
            // Assuming the getFolders function is defined elsewhere in your script.
            $folders = getFolders('uploads/');
            foreach ($folders as $folder) {
                echo "<form action='folder.php' method='post'>";
                echo "<input type='hidden' name='downloadFolder' value='$folder'>";
                echo "<button type='submit' class='unique-folder-btn'>$folder</button>";

                echo "</form>";
            }
            ?>
        </div>

        Currently folders are not available please check back later.


            
    </main>

 

    </section>

    <script>
        


    </script>
</body>

</html>
