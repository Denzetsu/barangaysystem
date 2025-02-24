


<!-- ################################################ UPDATE CODE ##################################################################### -->
<?php
session_start();
include('includes/dbcon.php');

if (isset($_POST['edit'])) {
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $details = $_POST['details'];
    $budget = $_POST['budget'];
    $date = $_POST['date'];

    // Check if a file has been selected
    if (!empty($_FILES['image']['name'])) {
        // Get the previous image path from the database
        $result = mysqli_query($conn, "SELECT `image` FROM `projects` WHERE `user_id` = '$user_id'");
        $row = mysqli_fetch_assoc($result);
        $previous = $row['image'];

        $image_name = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $exp = explode(".", $image_name);
        $end = end($exp);
        $name = time() . "." . $end;

        // Create the "upload" directory if it doesn't exist
        if (!is_dir("./upload"))
            mkdir("upload");

        $path = "upload/" . $name;
        $allowed_ext = array("gif", "jpg", "jpeg", "png");

        if (in_array($end, $allowed_ext)) {
            // Check if the previous image exists before unlinking
            if (file_exists($previous) && unlink($previous)) {
                if (move_uploaded_file($image_temp, $path)) {
                    mysqli_query($conn, "UPDATE `projects` SET `title` = '$title', `details` = '$details',  `budget` = '$budget',  `date` = '$date', `image` = '$path' WHERE `user_id` = '$user_id'") or die(mysqli_error($conn));

                    // Set session variable for update success
                    $_SESSION['update_success'] = 'Project updated successfully!';

                    header("location: projects.php");
                    exit();
                }
            }
        } else {
            echo "<script>alert('Invalid image format. Only GIF, JPG, JPEG, and PNG are allowed.')</script>";
        }
    } else {
        // If no file is selected, update only text fields
        mysqli_query($conn, "UPDATE `projects` SET `title` = '$title', `details` = '$details',  `budget` = '$budget',  `date` = '$date' WHERE `user_id` = '$user_id'") or die(mysqli_error($conn));

        // Set session variable for update success
        $_SESSION['update_success'] = 'User account updated!';

        header("location: projects.php");
        exit();
    }
}
?>




<!-- ######################################## DELETE CODE ############################################################################### -->

<?php
include('includes/dbcon.php');

if (isset($_GET['user_id'])) {
    $id = $_GET['user_id'];
}

$query = "DELETE FROM `projects` WHERE `user_id` = '$id'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed" . mysqli_error($conn));
} else {
    // Deletion successful
    session_start();
    $_SESSION['delete_success'] = 'Project deleted successfully!';
    header('Location: projects.php');
    exit();
    
    
    
    
}
?>

<!-- ######################################################################################################################## -->

