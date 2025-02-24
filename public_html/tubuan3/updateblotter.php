
<?php
// Check if the form is submitted
if(isset($_POST['update_data'])){
    // Include your database connection file
    include 'includes/dbcon.php';

    // Get the updated values from the form
    $update_id = $_POST['update_id'];
    $update_status = $_POST['update_status'];

    // Prepare and bind parameters
    $stmt = $conn->prepare("UPDATE blotter_3 SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $update_status, $update_id);

    // Execute the update statement
    if ($stmt->execute()) {
        // If update is successful, set a session variable for success message
        session_start();
        $_SESSION['update_success'] = 'Record updated successfully!';

        // You can redirect to another page if needed
        header("Location: viewblotter.php");
        exit();
    } else {
        // If there is an error in the update query
        echo "Error updating record: " . $conn->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>


