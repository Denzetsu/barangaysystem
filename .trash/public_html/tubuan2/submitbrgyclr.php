

<?php
include('includes/dbcon.php');

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $errors = array();
    if (empty($_POST["cFName"])) {
        $errors[] = "Full Name is required.";
    }
    if (empty($_POST["cAddress"])) {
        $errors[] = "Address is required.";
    }
    if (empty($_POST["cDob"])) {
        $errors[] = "Date of Birth is required.";
    }
    if (empty($_POST["cSex"])) {
        $errors[] = "Sex is required.";
    }
    if (empty($_POST["cCivilStatus"])) {
        $errors[] = "Civil Status is required.";
    }
    if (empty($_POST["cNationality"])) {
        $errors[] = "Nationality is required.";
    }
    if (empty($_POST["cPurpose"])) {
        $errors[] = "Purpose is required.";
    }
    if (empty($_POST["cCtc"])) {
        $errors[] = "CTC No. is required.";
    }
    if (empty($_POST["date_filed"])) {
        $errors[] = "Date Filed is required.";
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Establish database connection (connection already included)
        // Prepare SQL statement
        $sql = "INSERT INTO brgy_clearance2 (full_name, address, date_of_birth, sex, civil_status, nationality, purpose, ctc_no, date_filed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Bind parameters and execute the statement
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $full_name, $address, $date_of_birth, $sex, $civil_status, $nationality, $purpose, $ctc_no, $date_filed);

        // Set parameters and execute
        $full_name = $_POST["cFName"];
        $address = $_POST["cAddress"];
        $date_of_birth = $_POST["cDob"];
        $sex = $_POST["cSex"];
        $civil_status = $_POST["cCivilStatus"];
        $nationality = $_POST["cNationality"];
        $purpose = $_POST["cPurpose"];
        $ctc_no = $_POST["cCtc"];
        $date_filed = $_POST["date_filed"];

        if (mysqli_stmt_execute($stmt)) {
            // Set session message
            $_SESSION['message'] = "Request successfully sent";
            // Redirect to another page or display a message
            header("Location: reqbrgyclearance.php"); // Redirect to index.php or any other page
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
