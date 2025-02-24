<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables except for notifications
    foreach ($_SESSION as $key => $value) {
        if ($key !== 'notifications') {
            unset($_SESSION[$key]);
        }
    }
}

// Redirect to the login page or any other desired location
header("Location: login.php");
exit();
?>
