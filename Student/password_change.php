<?php

include '../_dbconnect.php';

// Redirect users who are not logged in or are students
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'teacher'  || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../");
    exit();
}

// Handle logout

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../");
    exit();
}


if(isset($_SESSION['verified']) && $_SESSION['verified'] === true) {
    if(isset($_POST['change_password']) && isset($_POST['email'])) {
        $new_password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_POST['email'];

        if($new_password === $confirm_password) {
            $update_stmt = $conn->prepare("UPDATE student_tb SET Password = ?, is_verified = 1 WHERE Email = ?");
            $update_stmt->bind_param("ss", $new_password, $email);
            if($update_stmt->execute()) {
                echo "Password updated successfully.";
            } else {
                echo "Failed to update password.";
            }
        } else {
            // Passwords do not match, show notification
            include '../_notification.php';
            showNotification("Passwords do not match.", "error");
        }
    } else {
        // Fetch user details including name
        $email = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM student_tb WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $name = $row['Name'];

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <link rel="stylesheet" href="../css/t1.css">
            <style>
                body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="password"] {
            width: calc(100% - 22px); /* Subtracting padding and border */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            transition: border-color 0.3s;
            
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            margin-bottom: 20px;    
            text-align: center;
            color:#333;
        }

        @media screen and (max-width: 600px) {
            .container {
                margin: 20px auto;
                width: 80%;
            }
        }
            </style>
        </head>
        <body>
            <?php include '../_nav.php'; ?>
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
} else {
    header("Location: https://srkr.me");
    exit();
}
?>
