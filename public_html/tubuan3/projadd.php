<?php 
session_start();
include('includes/dbcon.php');
?>

<?php
if (isset($_POST['save'])) {
    $image_name = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $title = $_POST['title'];
    $details = $_POST['details'];
    $budget = $_POST['budget'];
    $date = $_POST['date'];
    $exp = explode(".", $image_name);
    $end = end($exp);
    $name = time() . "." . $end;
    if (!is_dir("./upload")) {
        mkdir("upload");
    }
    $path = "upload/" . $name;
    $allowed_ext = array("gif", "jpg", "jpeg", "png");

	
    if (in_array($end, $allowed_ext)) {
        if (move_uploaded_file($image_temp, $path)) {
            mysqli_query($conn, "INSERT INTO `projects3` (`image`, `title`, `details`, `budget`, `date`) VALUES ('$path', '$title', '$details', '$budget', '$date')") or die(mysqli_error($conn));

            // Add notification to the session
            if (!isset($_SESSION['notifications'])) {
                $_SESSION['notifications'] = array();
            }
            $_SESSION['notifications'][] = 'New project posted: ' . $title;

            $_SESSION['update_success'] = 'Project added successfully!';

            header("location: projects.php");
            exit();
        }
    } else {
        echo "<script>alert('Error: Go to the previous page and try again. (Image Only)')</script>";
    }
}
?>



