<?php
session_start();
include('includes/dbcon.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Access the user ID from the session
$user_id = $_SESSION['user_id'];

// Clear notifications for the current user
if (isset($_POST['clear_notifications'])) {
    $clear_query = "DELETE FROM notifications WHERE user_id = $user_id";
    if ($conn->query($clear_query) === TRUE) {
        // Notifications cleared successfully
        echo '<script>alert("Notifications cleared successfully.");</script>';
        // Clear notifications from the session
        $_SESSION['notifications'] = array();
    } else {
        // Error clearing notifications
        echo '<script>alert("Error clearing notifications.");</script>';
    }
}
?>
