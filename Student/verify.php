<?php

include '../_dbconnect.php';

if(isset($_GET['id'])) {
    $encrypted_email = $_GET['id'];
    $email = base64_decode($encrypted_email);

    $stmt = $conn->prepare("SELECT * FROM student_tb WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $is_verified = $row['is_verified'];
        if($is_verified == 1) {
            echo "Your Email is already verified.";
        } else {
            $_SESSION['verified'] = true;
            header("Location: password_change.php?id=$encrypted_email");
            exit(); // Stop further execution
        } 
    } else {
        echo "Email not found in the database.";
    }
} else {
    echo "Email parameter not provided.";
}
?>
