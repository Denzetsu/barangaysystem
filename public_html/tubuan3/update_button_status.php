<?php
// Simulate updating the button status for demonstration purposes
// In a real application, you would update your database here
if (isset($_POST['button_id']) && isset($_POST['is_highlighted'])) {
    // You can add your database update logic here

    // For now, just simulate a success message
    echo 'success';
} else {
    echo 'error';
}
?>
