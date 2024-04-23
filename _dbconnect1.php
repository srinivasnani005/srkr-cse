<?php

    
    $servername = 'monorail.proxy.rlwy.net:18487/railway';
    $username = 'root';
    $password = 'nAgtMgrMqAgytkhHsIqfSnsskuHuedmm';
    $dbname = 'railway';

    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
?>