
<?php
session_start(); // Start the PHP session

include('includes/dbcon.php'); // Include database connection

if (isset($_POST['add_data'])) {
    // Sanitize and get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $date_filed = mysqli_real_escape_string($conn, $_POST['date_filed']);
    $civil_status = mysqli_real_escape_string($conn, $_POST['cCivilStatus']);
    $purpose = mysqli_real_escape_string($conn, $_POST['cPurpose']);

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO certindigency1 (`full_name`, `age`, `date_filed`, `civil_status`, `purpose`) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssss", $name, $age, $date_filed, $civil_status, $purpose);

    // Execute the statement
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        // Set a success message in the session
        $_SESSION['success'] = 'Record successfully added!';
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: viewindigency.php");
        exit();
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Error inserting record: ' . mysqli_error($conn);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: viewindigency.php");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>






<?php
include('includes/dbcon.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $purpose = $_POST['purpose'];
    $civil_status = $_POST['civil_status'];
    $date_filed = $_POST['date_filed'];

    // Prepare update query
    $query = "UPDATE certindigency1 SET full_name = ?, age = ?, purpose = ?, civil_status = ?, date_filed = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    // Check if prepare was successful
    if (!$stmt) {
        echo "Error in preparing statement: " . mysqli_error($conn);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sisssi", $name, $age, $purpose, $civil_status, $date_filed, $id);

    // Execute query
    if (mysqli_stmt_execute($stmt)) {
        // Set session message
        $_SESSION['update_success'] = 'Record updated successfully!';
        // Redirect back to the page where the update modal was triggered
        header("Location: viewindigency.php");
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

    $query = "DELETE FROM `certindigency1` WHERE `id` = '$userid'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error($conn));
    } else {
        // Deletion successful
        $_SESSION['delete_success'] = 'Record deleted successfully!';
        header('Location: viewindigency.php');
        exit();
    }
} else {
    // Redirect if UserID is not set in the URL
    header('Location: viewindigency.php');
    exit();
}
?>

