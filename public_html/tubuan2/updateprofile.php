<?php
session_start();
include('includes/dbcon.php');

if(isset($_POST['update_profile'])) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name']; 
    $last_name = $_POST['last_name']; 
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $user_id = $_SESSION['user_id'];

    // First, check if the current password matches the one stored in the database
    $stmt = $conn->prepare("SELECT password FROM tubuan2 WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    $stmt->close();

    // If both the current and new password fields are empty, retain the existing password
if(empty($current_password) && empty($new_password)) {
    // Do nothing, keep the existing password
    $new_password = $stored_password;
} elseif (!empty($current_password) && !empty($new_password)) {
    // If both current and new passwords are provided, verify the current password
    if($current_password === $stored_password) {
        // Current password is correct, update the new password
        $new_password = $new_password;
        $_SESSION['update_success'] = 'Your profile updated successfully!';
    } else {
        // Current password is incorrect, set an update error message
        $_SESSION['update_error'] = 'Current password is incorrect. Password not updated.';
        header("Location: userprofile.php");
        exit();
    }
} else {
    // If only one of the password fields is empty, set an update error message
    $_SESSION['update_error'] = 'Both current and new password must be provided to change the password.';
    header("Location: userprofile.php");
    exit();
}


    // Prepare and execute SQL statement to update user profile
    $stmt = $conn->prepare("UPDATE tubuan2 SET email = ?, first_name = ?, middle_name = ?, last_name = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $email, $first_name, $middle_name, $last_name, $new_password, $user_id);

    if($stmt->execute()) {
        // Update session variables with new data
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['middle_name'] = $middle_name; 
        $_SESSION['last_name'] = $last_name; 
        
        $_SESSION['update_success'] = 'Your profile updated successfully!';

        header("Location: userprofile.php");
        exit();
    } else {
        // If there's an error, display an error message or handle it appropriately
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
