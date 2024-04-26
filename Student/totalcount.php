<?php

include '../_dbconnect.php';

// Get all distinct Register Numbers of students
$sqlGetRegisterNumbers = "SELECT DISTINCT Register_Number FROM student_tb";
$stmtGetRegisterNumbers = $conn->prepare($sqlGetRegisterNumbers);
$stmtGetRegisterNumbers->execute();
$stmtGetRegisterNumbers->bind_result($registerNumber);

// Iterate over each student's register number
while ($stmtGetRegisterNumbers->fetch()) {
    // Array to store counts for each table for the current student
    $tableCounts = array();

    // Iterate through tables S1 to S14
    for ($i = 1; $i <= 14; $i++) {
        $tableName = 's' . $i;
        
        // Count rows in each table where 'Register_Number' matches for the current student
        $sqlCount = "SELECT COUNT(*) AS count FROM $tableName WHERE Register_Number = ?";
        $stmtCount = $conn->prepare($sqlCount);
        $stmtCount->bind_param('s', $registerNumber);
        $stmtCount->execute();
        $stmtCount->bind_result($count);
        $stmtCount->fetch();
        $stmtCount->close();

        // Store the count in the array
        $tableCounts[$tableName] = $count;
    }

    // Calculate total count for the current student
    $totalCount = array_sum($tableCounts);

    // Update the 'count' column in 'student_tb' for the current student
    $sqlUpdate = "UPDATE student_tb SET count = ? WHERE Register_Number = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param('is', $totalCount, $registerNumber);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

$stmtGetRegisterNumbers->close();
$conn->close();

?>
