


<?php
include('includes/dbcon.php');

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $errors = array();
    if (empty($_POST["respondent_name"])) {
        $errors[] = "Respondent's name is required.";
    }
    if (empty($_POST["complainant_name"])) {
        $errors[] = "Complainant's name is required.";
    }
    if (empty($_POST["subject"])) {
        $errors[] = "Subject is required.";
    }
    if (empty($_POST["date_filed"])) {
        $errors[] = "Date filed is required.";
    }
    if (empty($_POST["status"])) {
        $errors[] = "Status is required.";
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Establish database connection (connection already included)
        // Prepare SQL statement
        $sql = "INSERT INTO blotter (respondent_name, complainant_name, subject, date_filed, status) VALUES (?, ?, ?, ?, ?)";

        // Bind parameters and execute the statement
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $respondent_name, $complainant_name, $subject, $date_filed, $status);

        // Set parameters and execute
        $respondent_name = $_POST["respondent_name"];
        $complainant_name = $_POST["complainant_name"];
        $subject = $_POST["subject"];
        $date_filed = $_POST["date_filed"];
        $status = $_POST["status"];

        if (mysqli_stmt_execute($stmt)) {
            // Set session message
            $_SESSION['message'] = "New record created successfully";
            // Redirect to another page or display a message
            header("Location: repblotter.php"); // Redirect to index.php or any other page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Output validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>

