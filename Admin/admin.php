<?php
session_start();

if (!isset($_SESSION['var'])) {
    $_SESSION['var'] = false;
}

if ($_SESSION['var']) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    http_response_code(403);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Forbidden</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .error-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 300px;
            text-align: center;
            animation: fadeIn 1s ease-out;
        }

        h1 {
            color: #e74c3c;
            font-size: 28px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
        }

        #countdown {
            font-size: 36px;
            font-weight: bold;
            color: #e74c3c;
            animation: pulse 1s infinite alternate;
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
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Access Forbidden</h1>
        <p>Oops! You don't have permission to access this page.</p>
        <p>Redirecting in <span id="countdown">6</span> seconds...</p>
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
</html>
<?php
    exit();
}

$correct_id = "SRKRCSE";
$id_from_url = $_GET['id'];

if ($id_from_url !== $correct_id) {
    http_response_code(403);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Forbidden</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .error-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 300px;
            text-align: center;
            animation: fadeIn 1s ease-out;
        }

        h1 {
            color: #e74c3c;
            font-size: 28px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
        }

        #countdown {
            font-size: 36px;
            font-weight: bold;
            color: #e74c3c;
            animation: pulse 1s infinite alternate;
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
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Access Forbidden</h1>
        <p>Oops! You don't have permission to access this page.</p>
        <p>Redirecting in <span id="countdown">6</span> seconds...</p>
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
</html>
<?php
    exit();
}

$_SESSION['var'] = true;
header("Location: index.php");
exit();
?>
