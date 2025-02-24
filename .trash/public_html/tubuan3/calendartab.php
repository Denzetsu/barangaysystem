<?php
require_once('schedule/db-connect.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbcon.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Access the username from the session
$username = $_SESSION['username'];

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="schedule/css/bootstrap.min.css">
    <link rel="stylesheet" href="schedule/fullcalendar/lib/main.min.css">
    <script src="schedule/js/jquery-3.6.0.min.js"></script>
    <script src="schedule/js/bootstrap.min.js"></script>
    <script src="schedule/fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Nunito,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #000 !important;
            border-style: solid;
            border-width: 1px !important;
        }
    </style>
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

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php echo $username; ?>
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

                    <div class="container py-5" id="page-container">
                        <div class="row">
                            <div class="col-md-9">
                                <div id="calendar"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="cardt rounded-0 shadow">
                                    <div class="card-header bg-gradient bg-primary text-light">
                                        <h5 class="card-title">Schedule Form</h5>
                                    </div>
                                    <div class="card-body">

                                        <form action="schedule/save_schedule.php" method="post" id="schedule-form">
                                            <input type="hidden" name="id" value="">
                                            <div class="form-group mb-2">
                                                <label for="title" class="control-label">Title</label>
                                                <input type="text" class="form-control form-control-sm rounded-0"
                                                    name="title" id="title" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="description" class="control-label">Description</label>
                                                <textarea rows="3" class="form-control form-control-sm rounded-0"
                                                    name="description" id="description" required></textarea>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="start_datetime" class="control-label">Start</label>
                                                <input type="datetime-local"
                                                    class="form-control form-control-sm rounded-0" name="start_datetime"
                                                    id="start_datetime" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="end_datetime" class="control-label">End</label>
                                                <input type="datetime-local"
                                                    class="form-control form-control-sm rounded-0" name="end_datetime"
                                                    id="end_datetime" required>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-sm rounded-0" type="submit"
                                                form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                            <button class="btn btn-default border btn-sm rounded-0" type="reset"
                                                form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Event Details Modal -->
                    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-0">
                                <div class="modal-header rounded-0">
                                    <h5 class="modal-title">Schedule Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body rounded-0">
                                    <div class="container-fluid">
                                        <dl>
                                            <dt class="text-muted">Title</dt>
                                            <dd id="title" class="fw-bold fs-4"></dd>
                                            <dt class="text-muted">Description</dt>
                                            <dd id="description" class=""></dd>
                                            <dt class="text-muted">Start</dt>
                                            <dd id="start" class=""></dd>
                                            <dt class="text-muted">End</dt>
                                            <dd id="end" class=""></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="modal-footer rounded-0">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit"
                                            data-id="">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete"
                                            data-id="">Delete</button>
                                        <button type="button" class="btn btn-secondary btn-sm rounded-0"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Event Details Modal -->

                    <?php
                    $schedules = $conn->query("SELECT * FROM `schedule_list1`");
                    $sched_res = [];
                    foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
                        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
                        $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
                        $sched_res[$row['id']] = $row;
                    }
                    ?>
                    <?php
                    if (isset($conn))
                        $conn->close();
                    ?>

                </div>



            </div>
            <!-- /.container-fluid -->

            <div>

            </div>
        </div>
        <!-- End of Main Content -->

        <?php
        include('includes/scripts.php');
        include('includes/footer.php');
        ?>

        <script>
            var scheds = <?php echo json_encode($sched_res); ?>;
        </script>
        <script src="schedule/js/script.js"></script>

        <script>
            // Function to update the notification counter
            function updateNotificationCounter() {
                // Get the number of notifications
                var notificationCount = <?php echo isset($_SESSION['notifications']) ? count($_SESSION['notifications']) : 0; ?>;

                // Update the counter with the new count
                document.getElementById('notification-counter').textContent = notificationCount;
            }

            // Call the function initially to set the counter
            updateNotificationCounter();
        </script>

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
                        data: { notifications: true },
                        success: function (response) {
                            console.log('Notifications cleared successfully');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Failed to clear notifications:', textStatus, errorThrown);
                        }
                    });
                });
            });
        </script>

    </div>
    <!-- End of Content Wrapper -->

    <?php
    if (isset($conn))
        $conn->close();
    ?>

</body>