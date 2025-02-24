
<!-- ########################### update ########################################################## -->

<?php
// update.php

// Check if the form is submitted
if(isset($_POST['update_data'])){
    // Include your database connection file
    include 'includes/dbcon.php';

    // Get the updated values from the form
    $update_id = $_POST['update_id'];
    $update_f_name = $_POST['update_f_name'];
    $update_l_name = $_POST['update_l_name'];
    $m_name = $_POST['m_name'];
    $s_name = $_POST['suf_name'];
    $gen = $_POST['gender'];
    $dob = $_POST['dobirth'];
    $bplace = $_POST['birth_place'];
    $work = $_POST['job'];
    $vs = $_POST['vote_s'];
    $barangay = $_POST['barangay'];
    $email = $_POST['Email'];
    $pw = $_POST['Password'];
    $fhead = $_POST['famh'];

    // Update the records in the database
    $sql = "UPDATE tubuan1 SET 
    first_name = '$update_f_name', 
    middle_name = '$m_name', 
    last_name = '$update_l_name', 
    suffix_name = '$s_name',
    gender = '$gen',
    date_of_birth ='$dob',
    birth_place ='$bplace',
    occupation ='$work',
    voter_status ='$vs',
    barangay ='$barangay',
    email ='$email',
    password ='$pw',
    family_head ='$fhead'
    
    WHERE id = $update_id";

    if ($conn->query($sql) === TRUE) {
        // If update is successful, set a session variable for success message
        session_start();
        $_SESSION['update_success'] = 'Record updated successfully!';

        // You can redirect to another page if needed
        header("Location: residents.php");
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
<!-- ########################### add ########################################################## -->

<?php
session_start(); // Start the PHP session

include('includes/dbcon.php'); // Include database connection

if (isset($_POST['savedata'])) {

    // Sanitize and get form data
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $mname = mysqli_real_escape_string($conn, $_POST['m_name']);
    $sname = mysqli_real_escape_string($conn, $_POST['suffix_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dateOfBirth = mysqli_real_escape_string($conn, $_POST['dobirth']);
    $Birthplace  = mysqli_real_escape_string($conn, $_POST['birth_place']);
    $work  = mysqli_real_escape_string($conn, $_POST['job']);
    $vs  = mysqli_real_escape_string($conn, $_POST['voter_status']);
    $brgy  = mysqli_real_escape_string($conn, $_POST['barangay']);
    $em  = mysqli_real_escape_string($conn, $_POST['Email']);
    $pw  = mysqli_real_escape_string($conn, $_POST['Password']);
    $fh  = mysqli_real_escape_string($conn, $_POST['fam_head']);

 
 
    
    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO tubuan (`first_name`, `last_name`, `middle_name`, `suffix_name`, `gender`, `date_of_birth`, `birth_place`, `occupation`, `voter_status`, `barangay`, `email`, `password`, `family_head`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $fname, $lname, $mname, $sname,  $gender, $dateOfBirth, $Birthplace, $work, $vs, $brgy, $em, $pw, $fh);

    // Execute the statement
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        // Set a success message in the session
        $_SESSION['success'] = 'Record successfully added!';
        header("Location: residents.php");
        exit();
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Error inserting record: ' . mysqli_error($conn);
        header("Location: residents.php");
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>



<!-- ########################### add ########################################################## -->

<!-- ########################### delete ########################################################## -->

<?php
include('includes/dbcon.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$query = "DELETE FROM `tubuan1` WHERE `id` = '$id'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed" . mysqli_error($conn));
} else {
    // Deletion successful
    session_start();
    $_SESSION['delete_success'] = 'Record deleted successfully!';
    header('Location: residents.php');
}
?>

<!-- ########################### delete ########################################################## -->