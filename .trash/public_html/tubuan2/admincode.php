<?php
// Start a session or resume the current session
session_start();

if (isset($_POST['login'])) {
    // Establish a database connection (update with your database credentials)
    $conn = new mysqli("localhost", "u664069117_dauntless", "DauntlessBM2024", "u664069117_barangaysystem");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $username = $_POST['uname'];
    $password = $_POST['pword'];

    

    // Perform a query to check user credentials in admin3
    $sql_admin3 = "SELECT * FROM admin3 WHERE Username = '$username' AND Password = '$password'";
    $result_admin3 = $conn->query($sql_admin3);

    if ($result_admin3->num_rows == 1) {
        // Store user ID and username in a session variable
        $_SESSION['user_id'] = $result_admin3->fetch_assoc()['UserID'];
        $_SESSION['username'] = $username;

        // Redirect to some page for users in admin
        header("Location: index.php");
        exit();
    } elseif ($result_admin2->num_rows == 1) {
        // Store user ID and username in a session variable
        $_SESSION['user_id'] = $result_admin2->fetch_assoc()['UserID'];
        $_SESSION['username'] = $username;

        // Redirect to user_page2.php for users in admin2
        header("Location: index.php");
        exit();
    } elseif ($result_admin3->num_rows == 1) {
        // Store user ID and username in a session variable
        $_SESSION['user_id'] = $result_admin3->fetch_assoc()['UserID'];
        $_SESSION['username'] = $username;

        // Redirect to user_page3.php for users in admin3
        header("Location: index.php");
        exit();
    } else {
        // Display an alert for incorrect credentials
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Incorrect username or password. Please try again."
                    });
                };
            </script>';
    }

    // Close the database connection
    $conn->close();
}
?>