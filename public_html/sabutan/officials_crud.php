<!-- ########################### add ########################################################## -->
<?php
session_start(); // Start the PHP session

include('includes/dbcon.php'); // Include database connection

if (isset($_POST['add_data'])) {

    // Sanitize and get form data
    $off = mysqli_real_escape_string($conn, $_POST['Full_Name']);
    $pos = mysqli_real_escape_string($conn, $_POST['Position']);
    
    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO officials (`Full_Name`, `Position`) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $off, $pos);

    // Execute the statement
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        // Set a success message in the session
        $_SESSION['success'] = 'Record successfully added!';
        header("Location: addofftest.php");
        exit();
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Error inserting record: ' . mysqli_error($conn);
        header("Location: addofftest.php");
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
<!-- ########################### add ########################################################## -->







<!-- ########################### update ########################################################## -->
<?php
// update.php

// Check if the form is submitted
if(isset($_POST['update_data'])){
    // Include your database connection file
    include 'dbcons.php';

    // Get the updated values from the form
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_pos = $_POST['update_position'];
    

    // Update the records in the database
    $sql = "UPDATE officials SET 
    Full_Name = '$update_name', 	
    Position = '$update_pos'
    
   
    
    WHERE UserID = $update_id";

    if ($conn->query($sql) === TRUE) {
        // If update is successful, set a session variable for success message
        session_start();
        $_SESSION['update_success'] = 'Record updated successfully!';

        // You can redirect to another page if needed
        header("Location: addofftest.php");
        exit();
    } else {
        // If there is an error in the update query
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
    }
?>
<!-- ########################### update ########################################################## -->







<!-- ########################### delete ########################################################## -->

<?php
include('includes/dbcon.php');

session_start(); // Start session before any output

if (isset($_GET['UserID'])) {
    $userid = $_GET['UserID'];

    $query = "DELETE FROM `officials` WHERE `UserID` = '$userid'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error($conn));
    } else {
        // Deletion successful
        $_SESSION['delete_success'] = 'Record deleted successfully!';
        header('Location: addofftest.php');
        exit();
    }
} else {
    // Redirect if UserID is not set in the URL
    header('Location: addofftest.php');
    exit();
}
?>

<!-- ########################### delete ########################################################## -->