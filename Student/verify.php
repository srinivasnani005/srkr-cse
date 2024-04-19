<?php
// Check if a verification code is provided in the URL
if(isset($_SERVER['PATH_INFO'])) {
    $verification_code = trim($_SERVER['PATH_INFO'], '/');
    
    // Your verification logic goes here
    // Check if the verification code exists in the database and mark the email as verified
    
    // For example:
    $stmt = $conn->prepare("SELECT * FROM student_tb WHERE verification_code = ?");
    $stmt->bind_param("s", $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Verification code exists, update the is_verified status to 1 if not already TRUE
        $row = $result->fetch_assoc();
        if(!$row['is_verified']) {
            $stmt = $conn->prepare("UPDATE student_tb SET is_verified = 1 WHERE verification_code = ?");
            $stmt->bind_param("s", $verification_code);
            $stmt->execute();
        }
        
        echo "Email verified successfully.";
    } else {
        echo "Invalid verification code.";
    }
} else {
    echo "Verification code not provided.";
}
?>
