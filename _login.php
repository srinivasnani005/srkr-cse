<?php
include '_dbconnect.php';


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] === 'teacher') {
            header('Location: teacher/dashboard.php');
            exit();
        } elseif ($_SESSION['user_type'] === 'student') {
            header('Location: Student/dashboard.php');
            exit();
        }
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to check if the user exists and is verified
        $query = "SELECT * FROM student_tb WHERE Register_Number='$username' AND password='$password'";
        $result_student = mysqli_query($conn, $query);

        if (mysqli_num_rows($result_student) == 1) {
            $row = mysqli_fetch_assoc($result_student);
            if ($row['is_verified'] == 1) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_type'] = 'student';
                $_SESSION['Register_Number'] = $username;
                header('Location: Student/dashboard.php');
                exit();
            } else {
                $verificationMessage = "Please verify your email before logging in.";
            }
        } else {
            // Invalid credentials
            $loginError = "Invalid username or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/t1.css">
    <style>
        /* Notification styles */
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideInRight 0.5s ease-in-out, fadeOut 0.5s ease-in-out 5s forwards;
            z-index: 9999;
            max-width: 300px; /* Limiting width for responsiveness */
        }

        /* Animation keyframes */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <?php include '_nav.php'; ?>
    <main>
        <div class="background-image">
            <div class="form-container">
                <h2>Login</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="input-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="input-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="input-group">
                        <a href="_forgot.php" class="forgot-password">Forgot Password?</a>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="submit" name="submit" value="Login">
                    </div>
                    <?php
                    if (isset($loginError)) {
                        echo "<p class='error'>$loginError</p>";
                    }
                    ?>
                </form>
            </div>
            <?php if (isset($verificationMessage)): ?>
                <div class="notification-container">
                    <p><?php echo $verificationMessage; ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="body-content">
            <p>Registered students can log in using their registration number as the username and password.</p>
        </div>
    </main>

    <?php include '_footer.php'; ?>
</body>
</html>

