
<!-- ########################### add ########################################################## -->
<?php
session_start(); // Start the PHP session

include('includes/dbcon.php'); // Include database connection

if (isset($_POST['add_data'])) {

    // Sanitize and get form data
    $uname = mysqli_real_escape_string($conn, $_POST['Username']);
    $pw = mysqli_real_escape_string($conn, $_POST['Password']);
    
    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO admin1 (`Username`, `Password`) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $uname, $pw);

    // Execute the statement
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        // Set a success message in the session
        $_SESSION['success'] = 'Record successfully added!';
        header("Location: admins.php");
        exit();
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Error inserting record: ' . mysqli_error($conn);
        header("Location: admins.php");
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
    $update_uname = $_POST['update_uname'];
    $update_pw = $_POST['update_pw'];
    

    // Update the records in the database
    $sql = "UPDATE admin1 SET 
    Username = '$update_uname', 	
    Password = '$update_pw'
    
   
    
    WHERE UserID = $update_id";

    if ($conn->query($sql) === TRUE) {
        // If update is successful, set a session variable for success message
        session_start();
        $_SESSION['update_success'] = 'Record updated successfully!';

        // You can redirect to another page if needed
        header("Location: admins.php");
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

    $query = "DELETE FROM `admin1` WHERE `UserID` = '$userid'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error($conn));
    } else {
        // Deletion successful
        $_SESSION['delete_success'] = 'Record deleted successfully!';
        header('Location: admins.php');
        exit();
    }
} else {
    // Redirect if UserID is not set in the URL
    header('Location: admins.php');
    exit();
}
?>

<!-- ########################### delete ########################################################## -->