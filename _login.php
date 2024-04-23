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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

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
                include '_notification.php'; 

                showNotification("Please verify your email before logging in.", "error");
            }
        } else {
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
        .shake{
            animation: shake 0.3s;
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }

        @media screen and (max-width: 600px) {
            .form-container {
                width: 90%;
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
                    <?php
                    if (isset($loginError)) {
                        echo "<p class='error shake'>$loginError</p>";
                    }
                    ?>
                    <br>
                    <div class="input-group">
                        <input type="submit" name="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>

        <div class="body-content">
            <p>Registered students can log in using their registration number as the username and password.</p>
        </div>
    </main>

    <?php include '_footer.php'; ?>
</body>
</html>
