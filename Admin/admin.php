<?php
session_start();
$_SESSION['var'] = false;

if (!isset($_GET['id'])) {
    http_response_code(403);
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Access Forbidden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: linear-gradient(45deg, #f2f2f2 25%, transparent 25%, transparent 75%, #f2f2f2 75%, #f2f2f2), linear-gradient(45deg, #f2f2f2 25%, transparent 25%, transparent 75%, #f2f2f2 75%, #f2f2f2);
            background-size: 20px 20px;
            animation: backgroundMove 6s infinite linear;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            animation: fadeIn 1s ease;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .button-container {
            text-align: center;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            animation: pulse 1s infinite alternate;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button:active {
            background-color: #3e8e41;
            transform: scale(0.95);
        }

        @keyframes pulse {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.05);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes backgroundMove {
            from {
                background-position: 0 0;
            }
            to {
                background-position: 40px 40px;
            }
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Access Forbidden</h1>
        <p>Oops! You don't have permission to access this page.</p>
        <p>Redirecting in <span id='countdown'>6</span> seconds...</p>
    </div>

    <script>
        var countdown = 6;
        var countdownElement = document.getElementById('countdown');

        function redirectToParent() {
            window.location.href = '../';
        }

        function updateCountdown() {
            countdown--;
            countdownElement.textContent = countdown;

            if (countdown <= 0) {
                redirectToParent();
            } else {
                setTimeout(updateCountdown, 1000); // Update countdown every second
            }
        }

        updateCountdown(); // Start countdown
    </script>
</body>
</html>";
    exit();
}

$correct_id = "SRKRCSE";
$id_from_url = $_GET['id'];

if ($id_from_url === $correct_id) {
    $_SESSION['var'] = true;
} else {
    http_response_code(403);
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Access Forbidden</title>
        <style>
            /* Styles for access forbidden page */
        </style>
    </head>
    <body>
        <div class='error-container'>
            <h1>Access Forbidden</h1>
            <p>Oops! You don't have permission to access this page.</p>
            <p>Redirecting in <span id='countdown'>6</span> seconds...</p>
        </div>

        <script>
            /* JavaScript for countdown and redirection */
        </script>
    </body>
    </html>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Styles for admin dashboard */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: linear-gradient(45deg, #f2f2f2 25%, transparent 25%, transparent 75%, #f2f2f2 75%, #f2f2f2), linear-gradient(45deg, #f2f2f2 25%, transparent 25%, transparent 75%, #f2f2f2 75%, #f2f2f2);
            background-size: 20px 20px;
            animation: backgroundMove 6s infinite linear;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            animation: fadeIn 1s ease;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .button-container {
            text-align: center;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            animation: pulse 1s infinite alternate;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button:active {
            background-color: #3e8e41;
            transform: scale(0.95);
        }

        @keyframes pulse {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.05);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes backgroundMove {
            from {
                background-position: 0 0;
            }
            to {
                background-position: 40px 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Admin Login</h1>
        <div class="button-container">
            <button class="button" onclick="redirect()">Click here to access</button>
        </div>
    </div>

    <script>
        function fadeOut(element) {
            var opacity = 1;
            var timer = setInterval(function() {
                if (opacity <= 0.1) {
                    clearInterval(timer);
                    element.style.display = 'none';
                }
                element.style.opacity = opacity;
                element.style.filter = 'alpha(opacity=' + opacity * 100 + ")";
                opacity -= opacity * 0.1;
            }, 50);
        }

        function redirect() {
            <?php $_SESSION['var'] = true; ?>

            var container = document.querySelector('.container');
            fadeOut(container);
            
            setTimeout(function() {
                window.location.href = 'Admin/index.php';
            }, 500);
        }
    </script>
</body>
</html>
