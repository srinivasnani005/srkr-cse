<?php

include '../_dbconnect.php';



$registerNumber = $_SESSION['Register_Number'];

// Array to store counts for each table
$tableCounts = array();

// Iterate through tables S1 to S14
for ($i = 1; $i <= 14; $i++) {
    $tableName = 's' . $i;
    
    // Count rows in each table where 'Register_Number' matches
    $sqlCount = "SELECT COUNT(*) AS count FROM $tableName WHERE Register_Number = ?";
    $stmt = $conn->prepare($sqlCount);
    $stmt->bind_param('s', $registerNumber);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Store the count in the array
    $tableCounts[$tableName] = $count;
}

// Calculate total count
$totalCount = array_sum($tableCounts);

// Update the 'count' column in 'student_tb'
$sqlUpdate = "UPDATE student_tb SET count = ? WHERE Register_Number = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param('is', $totalCount, $registerNumber);
$stmtUpdate->execute();
$stmtUpdate->close();


?>
