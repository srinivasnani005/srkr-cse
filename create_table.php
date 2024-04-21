<?php
// Database configuration
include '_dbconnect.php';

// Connect to MySQL server
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Read ncu.sql file
$sqlFile = 'ncu.sql';
$sql = file_get_contents($sqlFile);

// Execute each query from the ncu.sql file
$queries = explode(';', $sql);
foreach ($queries as $query) {
    // Trim white space
    $query = trim($query);
    
    // Execute query if it's not empty
    if (!empty($query)) {
        if (mysqli_query($conn, $query)) {
            echo "Query executed successfully: $query<br>";
        } else {
            echo "Error executing query: $query<br>" . mysqli_error($conn) . "<br>";
        }
    }
}

// Close connection
mysqli_close($conn);
?>
