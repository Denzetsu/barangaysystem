<?php
session_start();

// Include database connection
include('includes/dbcon.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $errors = array();
    if (empty($_POST["name"])) {
        $errors[] = "Name is required.";
    }
    if (empty($_POST["cPurpose"])) {
        $errors[] = "Purpose is required.";
    }
    if (empty($_POST["loc"])) {
        $errors[] = "Location is required.";
    }
    if (empty($_POST["date_filed"])) {
        $errors[] = "Date Filed is required.";
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Prepare SQL statement
        $sql = "INSERT INTO building_clearance3 (name, purpose, location, date_filed) VALUES (?, ?, ?, ?)";

        // Bind parameters and execute the statement
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $purpose, $location, $date_filed);

        // Set parameters and execute
        $name = $_POST["name"];
        $purpose = $_POST["cPurpose"];
        $location = $_POST["loc"];
        $date_filed = $_POST["date_filed"];

        if (mysqli_stmt_execute($stmt)) {
            // Set session message
            $_SESSION['message'] = "Document successfully filed";
            // Redirect to another page or display a message
            header("Location: reqbldgclr.php"); // Redirect to index.php or any other page
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
