<?php

require '../_dbconnect.php';


$var = isset($_SESSION['var']) ? $_SESSION['var'] : false;

if (substr($_SERVER['REQUEST_URI'], -7) === "SRKRCSE" || !$var) {
    header("Location: ../");
    exit();
}

$loginSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tablename = "admin_tb"; 

    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    $sql = "SELECT * FROM $tablename WHERE username='$enteredUsername' AND password='$enteredPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["username"] = $enteredUsername;
        $_SESSION["user_type"] = $user["user_type"];
        $loginSuccess = true;
        header("Location: dashboard.php");
        exit();
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('https://www.transparenttextures.com/patterns/always-grey.png'); /* Background texture */
            animation: backgroundAnimate 10s infinite linear;
        }

        @keyframes backgroundAnimate {
            from { background-position: 0 0; }
            to { background-position: 100px 75px; }
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .login-container:hover {
            transform: scale(1.05);
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: all 0.3s ease;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px #4CAF50;
            transform: scale(1.02);
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: calc(100% - 20px);
            transition: background-color 0.3s, transform 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        input[type="submit"]:active {
            background-color: #3e8e41;
            transform: scale(0.95);
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .error-message.shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }


        .animated-text {
            font-size: 20px;
            color: #333;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .animated-text.visible {
            opacity: 1;
        }

        .success-message {
            color: green;
            margin-top: 10px;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .success-message.visible {
            opacity: 1;
        }

        .shake{
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }


        
    </style>
</head>
<body>
    <div class="login-container">
        <?php if ($loginSuccess): ?>
            <h2 class="animated-text visible">Welcome Back!</h2>
            <p class="success-message visible">Login Successful!</p>
        <?php else: ?>
            <h2 class="animated-text">Welcome Admin!</h2>
        <?php endif; ?>
        <form id="login-form" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <br><br>
            <input type="password" name="password" placeholder="Password" required>
            <br><br>
            <input type="submit" value="Login">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$loginSuccess): ?>
                <p class="error-message shake">Invalid username or password!</p>
                <script>
                    var errorMessage = document.querySelector('.error-message');
                    errorMessage.classList.add('shake');
                    setTimeout(function() {
                        errorMessage.classList.remove('shake');
                        errorMessage.style.opacity = '0';
                    }, 6000); 
                </script>
            <?php endif; ?>
        </form>
    </div>

    <script>
        window.onload = function() {
            document.querySelector('.animated-text').classList.add('visible');
            <?php if ($loginSuccess): ?>
                document.querySelector('.success-message').classList.add('visible');
            <?php endif; ?>
        };
    </script>
</body>
</html>
