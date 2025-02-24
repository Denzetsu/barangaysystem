<?php
session_start();

// Include database connection
include('includes/dbcon.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $errors = array();
    if (empty($_POST["business"])) {
        $errors[] = "Business name is required.";
    }
    if (empty($_POST["loc"])) {
        $errors[] = "Location is required.";
    }
    if (empty($_POST["owner"])) {
        $errors[] = "Owner is required.";
    }
    if (empty($_POST["address"])) {
        $errors[] = "Address is required.";
    }
    if (empty($_POST["date_filed"])) {
        $errors[] = "Date Filed is required.";
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Prepare SQL statement
        $sql = "INSERT INTO business_clearance3 (name, location, owner, address, date_filed) VALUES (?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $name, $location, $owner, $address, $date_filed);

            // Set parameters
            $name = $_POST["business"];
            $location = $_POST["loc"];
            $owner = $_POST["owner"];
            $address = $_POST["address"];
            $date_filed = $_POST["date_filed"];

            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                // Set session message
                $_SESSION['message'] = "Request sent successfully";
                // Redirect to another page
                header("Location: reqbusinessclr.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Output validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
