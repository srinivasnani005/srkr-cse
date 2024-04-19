<?php

// Function to create directories recursively
function createDirectories($baseDir, $branches, $years)
{
    foreach ($branches as $branch) {
        foreach ($years as $year) {
            $directory = "$baseDir/$branch/$year";
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true); // Create directory recursively
                // Create a temporary file in the directory
                $tempFile = "$directory/temp1.txt";
                file_put_contents($tempFile, "Temporary file content");
            }
        }
    }
}

// Function to get the range of years
function getYearRange()
{
    $currentYear = date("Y");
    $years = array();
    for ($i = $currentYear - 4; $i <= $currentYear + 1; $i++) {
        $years[] = $i;
    }
    return $years;
}

// Branches
$branches = array("CSE", "ECE", "EEE", "CIVIL", "AIDS", "CSD", "MECH", "AIML", "IT");

// Get the range of years (2020 to 2025)
$years = getYearRange();

// Create directories for S1 to S14
for ($i = 1; $i <= 14; $i++) {
    $baseDir = "Student/uploads/S$i";
    createDirectories($baseDir, $branches, $years);
}

echo "Directories created successfully.";

?>
