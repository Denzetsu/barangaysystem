<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbcon.php');
?>


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






                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>




                <!-- Nav Item - User Information -->

                <?php


                // Check if the user is logged in
                if (!isset($_SESSION['user_id'])) {
                    // Redirect to the login page or display an error message
                    header("Location: login.php");
                    exit();
                }

                // Access the username from the session
                $username = $_SESSION['username'];
                ?>

                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
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
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Residents</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                                        <?php
                                        $query = "SELECT * FROM tubuan1";
                                        $query_run = mysqli_query($conn, $query);

                                        if ($cat_total = mysqli_num_rows($query_run)) {
                                            echo '<h4 class="mb-0"> ' . $cat_total . ' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"> No Data </h4>';
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Administrators</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                                        <?php
                                        $query = "SELECT * FROM admin2";
                                        $query_run = mysqli_query($conn, $query);

                                        if ($cat_total = mysqli_num_rows($query_run)) {
                                            echo '<h4 class="mb-0"> ' . $cat_total . ' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"> No Data </h4>';
                                        }
                                        ?>



                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-key fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Projects
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?php
                                                $query = "SELECT * FROM projects1";
                                                $query_run = mysqli_query($conn, $query);

                                                if ($cat_total = mysqli_num_rows($query_run)) {
                                                    echo '<h4 class="mb-0"> ' . $cat_total . ' </h4>';
                                                } else {
                                                    echo '<h4 class="mb-0"> No Data </h4>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-auto">


                                    <i class="fas fa-home fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Blotters</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?php
                                                $query = "SELECT * FROM blotter";
                                                $query_run = mysqli_query($conn, $query);

                                                if ($cat_total = mysqli_num_rows($query_run)) {
                                                    echo '<h4 class="mb-0"> ' . $cat_total . ' </h4>';
                                                } else {
                                                    echo '<h4 class="mb-0"> No Data </h4>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-flag fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Voters
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?php
                                                $query = "SELECT voter_status FROM tubuan1";
                                                $query_run = mysqli_query($conn, $query);

                                                if ($query_run) {
                                                    $cat_total = mysqli_num_rows($query_run);
                                                    if ($cat_total > 0) {
                                                        // Count the number of 'Yes' values in the voter_status column
                                                        $yesCount = 0;

                                                        // Fetch and check the voter status for each row
                                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                                            $voterStatus = $row['voter_status'];
                                                            if ($voterStatus == 'Yes') {
                                                                $yesCount++;
                                                            }
                                                        }

                                                        // Display the count of 'Yes' values
                                                        echo '<h4 class="mb-0">' . $yesCount . '</h4>';
                                                    } else {
                                                        echo '<h4 class="mb-0">No Data</h4>';
                                                    }
                                                } else {
                                                    echo '<h4 class="mb-0">Query Error</h4>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-auto">


                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-6 mb-4">





                </div>

                <div class="col-lg-6 mb-4">





                </div>
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
                            <form action="process_discussionadmin.php" method="post">
                                <div class="form-group">
                                    <label for="postContent">Post something:</label>
                                    <textarea class="form-control" id="postContent" name="postContent" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                            <!-- Display Existing Posts -->
                            <?php
                            $query = "SELECT * FROM discussion_posts_admin1 ORDER BY post_date DESC";
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
        

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->





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