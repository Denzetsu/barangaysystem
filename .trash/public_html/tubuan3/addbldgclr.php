
<?php
session_start(); // Start the PHP session

include('includes/dbcon.php'); // Include database connection

if (isset($_POST['add_data'])) {
    // Sanitize and get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $location = mysqli_real_escape_string($conn, $_POST['loc']);
    $date_filed = $_POST['date_filed'];

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO building_clearance1 (`name`, `purpose`, `location`, `date_filed`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssss", $name, $purpose, $location, $date_filed);

    // Execute the statement
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        // Set a success message in the session
        $_SESSION['success'] = 'Document successfully added!';
        header("Location: viewbldgclr.php");
        exit();
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Error inserting document: ' . mysqli_error($conn);
        header("Location: viewbldgclr.php");
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>









<?php
include('includes/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $purpose = $_POST['purpose'];
    $location = $_POST['loc'];
    $date_filed = $_POST['date_filed'];

    // Prepare update query
    $query = "UPDATE building_clearance1 SET name = ?, purpose = ?, location = ?, date_filed = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $purpose, $location, $date_filed, $id);

    // Execute query
    if (mysqli_stmt_execute($stmt)) {
        // Set session message
        $_SESSION['update_success'] = 'Record updated successfully!';
        // Redirect back to the page where the update modal was triggered
        header("Location: viewbldgclr.php");
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

    $query = "DELETE FROM `building_clearance1` WHERE `id` = '$userid'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error($conn));
    } else {
        // Deletion successful
        $_SESSION['delete_success'] = 'Record deleted successfully!';
        header('Location: viewbldgclr.php');
        exit();
    }
} else {
    // Redirect if UserID is not set in the URL
    header('Location: viewbrgybldgclr.php');
    exit();
}
?>

