<?php

    
    $servername = "sql6.freesqldatabase.com";
    $username = "sql6700121";
    $password = "Ri5k55LMWk";
    $dbname = "sql6700121";

    // $servername = 'localhost';
    // $username = 'root';
    // $password = "";
    // $dbname = "ncu";


    // $servername = 'monorail.proxy.rlwy.net';
    // $username = 'root';
    // $password = 'wSsZTpOPdrGHqdGuvbRNVMbDIgmJqUpe';
    // $dbname = 'railway';
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
?>