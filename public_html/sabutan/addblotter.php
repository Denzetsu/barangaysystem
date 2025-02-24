<?php
session_start(); // Start the PHP session

include('includes/dbcon.php'); // Include database connection

if (isset($_POST['add_data'])) {
    // Sanitize and get form data
    $date_filed = $_POST['date_filed']; 
    $respondent_name = mysqli_real_escape_string($conn, $_POST['respondent_name']);
    $complainant_name = mysqli_real_escape_string($conn, $_POST['complainant_name']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO blotter (`date_filed`, `respondent_name`, `complainant_name`, `subject`, `status`) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssss", $date_filed, $respondent_name, $complainant_name, $subject, $status);

    // Execute the statement
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        // Set a success message in the session
        $_SESSION['success'] = 'Record successfully added!';
        header("Location: viewblotter.php");
        exit();
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Error inserting record: ' . mysqli_error($conn);
        header("Location: viewblotter.php");
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
    $respondent_name = $_POST['respondent_name'];
    $complainant_name = $_POST['complainant_name'];
    $subject = $_POST['subject'];
    $date_filed = $_POST['date_filed'];
    $status = $_POST['status'];

    // Prepare update query
    $query = "UPDATE blotter SET respondent_name = ?, complainant_name = ?, subject = ?, date_filed = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $respondent_name, $complainant_name, $subject, $date_filed, $status, $id);

    // Execute query
    if (mysqli_stmt_execute($stmt)) {
        // Set session message
        $_SESSION['update_success'] = 'Record updated successfully!';
        // Redirect back to the page where the update modal was triggered
        header("Location: viewblotter.php");
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









<?php
include('includes/dbcon.php');

session_start(); // Start session before any output

if (isset($_GET['id'])) {
    $userid = $_GET['id'];

    $query = "DELETE FROM `blotter` WHERE `id` = '$userid'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error($conn));
    } else {
        // Deletion successful
        $_SESSION['delete_success'] = 'Record deleted successfully!';
        header('Location: viewblotter.php');
        exit();
    }
} else {
    // Redirect if UserID is not set in the URL
    header('Location: viewblotter.php');
    exit();
}
?>




