<?php
session_start();

// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page after logout
    header("Location: ../");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Add your CSS and other head content here -->
</head>
<body>
    <h1>Welcome to Student Dashboard</h1>
    <!-- Your dashboard content here -->

    <!-- Logout form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>

    <!-- Add your JavaScript and other body content here -->
</body>
</html>
