<!-- connection establishment for the databse ncu and with phpmyadmin -->
<?php
$servername = "sql6.freesqldatabase.com";
$username = "sql6698211";
$password = "ymWFtw4aWS";
$dbname = "sql6698211";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

