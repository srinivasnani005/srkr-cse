<?php
// Check if the secret key is provided in the query string
if(isset($_GET['key']) && $_GET['key'] === 'SRKRCSE') {
    // Key is correct, allow access to admin dashboard
    echo "Welcome to the admin dashboard!";
} else {
    // Key is incorrect, display error message and redirect
    echo "You don't have access to this page.";
    header("Refresh: 5; URL=http://srkr.me");
    exit();
}
?>
