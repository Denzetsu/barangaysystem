<?php
session_start(); // Start the PHP session

include('includes/dbcon.php'); // Include database connection

if (isset($_POST['add_data'])) {
    // Sanitize and get form data
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['business']);
    $location = mysqli_real_escape_string($conn, $_POST['loc']);
    $owner = mysqli_real_escape_string($conn, $_POST['owner']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $date_filed = $_POST['date_filed'];

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO business_clearance2 (`id`, `name`, `location`, `owner`, `address`, `date_filed`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $id, $name, $location, $owner, $address, $date_filed);

    // Execute the statement
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        // Set a success message in the session
        $_SESSION['success'] = 'Record successfully added!';
        header("Location: viewbusinessclr.php");
        exit();
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Error inserting record: ' . mysqli_error($conn);
        header("Location: viewbusinessclr.php");
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>







<!-- ###################################UPDATE########################### -->
<?php
include('includes/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['business'];
    $location = $_POST['loc'];
    $owner = $_POST['owner'];
    $address = $_POST['address'];
    $date_filed = $_POST['date_filed'];

    // Prepare update query
    $query = "UPDATE business_clearance2 SET name = ?, location = ?, owner = ?, address = ?, date_filed = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $name, $location, $owner, $address, $date_filed, $id);

    // Execute query
    if (mysqli_stmt_execute($stmt)) {
        // Set session message
        $_SESSION['update_success'] = 'Record updated successfully!';
        // Redirect back to the page where the update modal was triggered
        header("Location: viewbusinessclr.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
// Close connection
mysqli_close($conn);
?>


<!-- ###################################DELETE########################### -->
<?php
include('includes/dbcon.php');

session_start(); // Start session before any output

if (isset($_GET['id'])) {
    $userid = $_GET['id'];

    $query = "DELETE FROM `business_clearance2` WHERE `id` = '$userid'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error($conn));
    } else {
        // Deletion successful
        $_SESSION['delete_success'] = 'Record deleted successfully!';
        header('Location: viewbusinessclr.php');
        exit();
    }
} else {
    // Redirect if UserID is not set in the URL
    header('Location: viewbusinessclr.php');
    exit();
}
?>