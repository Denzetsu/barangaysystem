<?php
session_start();

// Include database connection
include('includes/dbcon.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $errors = array();
    if (empty($_POST["cFName"])) {
        $errors[] = "Full Name is required.";
    }
    if (empty($_POST["cAge"])) {
        $errors[] = "Age is required.";
    }
    if (empty($_POST["cCivilStatus"])) {
        $errors[] = "Civil Status is required.";
    }
    if (empty($_POST["cPurpose"])) {
        $errors[] = "Purpose is required.";
    }
    if (empty($_POST["date_filed"])) {
        $errors[] = "Date Filed is required.";
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Prepare SQL statement
        $sql = "INSERT INTO certindigency (full_name, age, civil_status, purpose, date_filed) VALUES (?, ?, ?, ?, ?)";

        // Bind parameters and execute the statement
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $name, $age, $civilStatus, $purpose, $dateFiled);

        // Set parameters and execute
        $name = $_POST["cFName"];
        $age = $_POST["cAge"];
        $civilStatus = $_POST["cCivilStatus"];
        $purpose = $_POST["cPurpose"];
        $dateFiled = $_POST["date_filed"];

        if (mysqli_stmt_execute($stmt)) {
            // Set session message
            $_SESSION['message'] = "Request successfully sent";
            // Redirect to another page or display a message
            header("Location: reqindigency.php"); // Redirect to index.php or any other page
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
