<?php
include('includes/dbcon.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form data is set and not empty
    if (isset($_POST['postContent']) && !empty($_POST['postContent'])) {
        $postContent = mysqli_real_escape_string($conn, $_POST['postContent']);

        // Insert the new post into the discussion_posts table
        $insertQuery = "INSERT INTO discussion_posts (post_content, post_date) VALUES ('$postContent', NOW())";

        if (mysqli_query($conn, $insertQuery)) {
            // Redirect back to the residents page after successful submission
            header("Location: residentspage1.php");
            exit();
        } else {
            // Handle the case where the insertion fails
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle the case where the post content is not set or empty
        echo "Post content is required.";
    }
} else {
    // Handle the case where the form is not submitted using POST method
    echo "Invalid request method.";
}
?>
