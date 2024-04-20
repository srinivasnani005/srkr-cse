<?php

include '../_dbconnect1.php';

// Check if email parameter exists in the URL
if(isset($_GET['id'])) {
    // Decrypt the email parameter
    $encrypted_email = $_GET['id'];
    $email = base64_decode($encrypted_email);

    // Check if the decrypted email exists in the student_tb table
    $stmt = $conn->prepare("SELECT * FROM student_tb WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $is_verified = $row['is_verified'];
        if($is_verified == 1) {
            // Email is already verified
            echo "Your Email is already verified.";
        } else {
            // Email exists and verification is pending
            $name = $row['Name'];

            if(isset($_POST['change_password'])) {
                $new_password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                if($new_password === $confirm_password) {
                    // Update the password in the database
                    $update_stmt = $conn->prepare("UPDATE student_tb SET Password = ?, is_verified = 1 WHERE Email = ?");
                    $update_stmt->bind_param("ss", $new_password, $email);
                    if($update_stmt->execute()) {
                        echo "Password updated successfully.";
                    } else {
                        echo "Failed to update password.";
                    }
                } else {
                    echo "Passwords do not match.";
                }
            } else {
                // Display the form to change the password
                ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/t1.css">
    <style>
          body {
                                margin: 0;
                                padding: 0;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                background-color: #f5f5f5;
                            }

                            .container {
                                background-color: #ffffff;
                                padding: 20px;
                                border-radius: 8px;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                text-align: center;
                            }

                            h2 {
                                margin-top: 0;
                            }

                            form {
                                margin-top: 20px;
                            }

                            label, input {
                                display: block;
                                margin-bottom: 10px;
                            }

                            input[type="password"] {
                                width: 100%;
                                padding: 10px;
                                border: 1px solid #cccccc;
                                border-radius: 4px;
                            }

                            input[type="submit"] {
                                background-color: #007bff;
                                color: #ffffff;
                                border: none;
                                padding: 10px 20px;
                                border-radius: 4px;
                                cursor: pointer;
                            }

                            input[type="submit"]:hover {
                                background-color: #0056b3;
                            }
    </style>
</head>
<body>
    <?php include '_nav.php'; ?>
    <main>
        <div class="background-image">
            <div class="container">
                    <h2>Change Password</h2>
                    <p>Welcome, <?php echo $name; ?>!</p>
                    <form action="" method="post">
                        <label for="password">New Password:</label>
                        <input type="password" id="password" name="password" required>
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="submit" name="change_password" value="Change Password">
                    </form>
                </div>
           
        </div>

        <div class="body-content">
        </div>
    </main>

    <?php include '../_footer.php'; ?>
</body>
</html>

<?php
            }
        }
    } else {
        echo "Email not found in the database.";
    }
} else {
    echo "Email parameter not provided.";
}
?>
