<?php
include('includes/header.php');
include('includes/navtubuan3.php');
include('includes/dbcon.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}


// Include database connection
include('db_connection.php');

// Access the user ID from the session
$user_id = $_SESSION['user_id'];

// Triggering Notifications (for demonstration purposes)
// Assuming an admin sends a notification to the currently logged-in user
if (isset($_GET['send_notification'])) {
    // Message to be sent as a notification
    $message = "This is a test notification from the admin.";

    // Insert the notification into the database
    $insert_query = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$message')";
    if ($conn->query($insert_query) === TRUE) {
        // Notification inserted successfully
        echo '<script>alert("Notification sent successfully.");</script>';
    } else {
        // Error inserting notification
        echo '<script>alert("Error sending notification.");</script>';
    }
}

// Fetch notifications for the current user
$query = "SELECT * FROM notifications WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($query);

// Array to store fetched notifications
$notifications = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row['message'];
    }
    // Store notifications in the session
    $_SESSION['notifications'] = $notifications;
} else {
    // If no notifications, set empty array in session
    $_SESSION['notifications'] = array();
}

// Clear notifications for the current user
if (isset($_POST['clear_notifications'])) {
    $clear_query = "DELETE FROM notifications WHERE user_id = $user_id";
    if ($conn->query($clear_query) === TRUE) {
        // Notifications cleared successfully
        echo '<script>alert("Notifications cleared successfully.");</script>';
        // Refresh the page to reflect the changes
        header("Refresh:0");
    } else {
        // Error clearing notifications
        echo '<script>alert("Error clearing notifications.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" type="text/css" href="css/other.css">
</head>

<body>
    

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <h1 class="m-0 font-weight-bold text-primary">Barangay Tubuan III </h1>
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span id="notification-counter" class="badge badge-danger badge-counter">
                            <?php echo count($_SESSION['notifications']); ?>
                        </span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Notifications
                        </h6>
                        <?php
                        // Check if there are notifications to display
                        if (!empty($notifications)) {
                            // Loop through notifications and display each one
                            foreach ($notifications as $notification) {
                                echo '<a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>

                                        <span class="medium text-black-500">', "Admin: " . $notification . '</span>
                                    </div>
                                </a>';
                            }
                            // Add a clear button if there are notifications
                            echo '<a class="dropdown-item text-center small text-gray-500 clear-notifications" onclick="clearNotifications()" href="#">
                                Clear All
                            </a>';
                        } else {
                            // Display a message if there are no notifications
                            echo '<a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="small text-gray-500">No notifications</span>
                                </div>
                            </a>';
                        }
                        ?>
                    </div>
                </li>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?php echo $email; ?>
                        </span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div id="calendar"></div>
            </div>

           <!-- Content Row -->
            <!-- Discussion Forum Section -->
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Discussion Forum</h6>
                        </div>
                        <div class="card-body">
                            <!-- Discussion Form -->
                            <form action="process_discussion.php" method="post">
                                <div class="form-group">
                                    <label for="postContent">Post something:</label>
                                    <textarea class="form-control" id="postContent" name="postContent" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                            <!-- Display Existing Posts -->
                            <?php
                            $query = "SELECT * FROM discussion_posts3 ORDER BY post_date DESC";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="card mt-3">
                                            <div class="card-body">
                                                <p class="card-text">' . $row['post_content'] . '</p>
                                                <small class="text-muted">Posted on ' . $row['post_date'] . '</small>
                                            </div>
                                          </div>';
                                }
                            } else {
                                echo '<p class="text-muted">No posts yet.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
     <div class="row">

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>



<script>
    $(document).ready(function () {
        // Load notifications from local storage when the page loads
        var notifications = localStorage.getItem('notifications');
        if (notifications) {
            $('.dropdown-list').append(notifications);
        }

        // Clear all notifications
        $(document).on('click', '.clear-notifications', function () {
            // Clear notifications from the dropdown
            $('.dropdown-list').empty().append('<a class="dropdown-item d-flex align-items-center" href="#"><div class="mr-3"><div class="icon-circle bg-primary"><i class="fas fa-file-alt text-white"></i></div></div><div><class="small text-gray-500"> Empty Notification. </h4></div></a>');

            // AJAX request to clear notifications from the session
            $.ajax({
                url: 'notifications.php',
                method: 'POST',
                data: { clear_notifications: true },
                success: function (response) {
                    console.log('Notifications cleared successfully');
                    // Update notification counter after clearing notifications
                    updateNotificationCounter();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Failed to clear notifications:', textStatus, errorThrown);
                }
            });
        });
    });

    // Function to update the notification counter
    function updateNotificationCounter() {
        // Get the number of notifications
        var notificationCount = <?php echo count($_SESSION['notifications']); ?>;

        // Update the counter with the new count
        $('#notification-counter').text(notificationCount);
    }

    // Call the function initially to set the counter
    updateNotificationCounter();
</script>

<script>
    // Function to clear notifications
    function clearNotifications() {
        // Clear notifications from the dropdown
        $('.dropdown-list').empty().append('<a class="dropdown-item d-flex align-items-center" href="#"><div class="mr-3"><div class="icon-circle bg-primary"><i class="fas fa-file-alt text-white"></i></div></div><div><class="small text-gray-500"> Empty Notification. </h4></div></a>');

        // AJAX request to clear notifications from the session
        $.ajax({
            url: 'notifications.php',
            method: 'POST',
            data: { clear_notifications: true },
            success: function (response) {
                console.log('Notifications cleared successfully');
                // Update notification counter after clearing notifications
                updateNotificationCounter();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Failed to clear notifications:', textStatus, errorThrown);
            }
        });
    }
</script>

</body>

</html>
