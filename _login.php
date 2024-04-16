<?php
include '_dbconnect.php';

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] === 'teacher') {
            header('Location: teacher/dashboard.php');
            exit();
        } elseif ($_SESSION['user_type'] === 'student') {
            header('Location: student/dashboard.php'); 
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
            $_SESSION[] = true;
            $_SESSION['user_type'] = 'student';
            header('Location: Student/dashboard.php'); 
            exit();
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
        </div>

        <div class="body-content">
            <p>Registered students can log in using their registration number as the username and password.</p>
        </div>
    </main>

    <?php include '_footer.php'; ?>
</body>
</html>
