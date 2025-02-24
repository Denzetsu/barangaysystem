<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbcon.php');

// Check if the sendEmail form is submitted
if (isset($_POST['sendEmail'])) {
    // Get the recipient's email and message from the form
    $recipientEmail = $_POST['recipientEmail'];
    $emailMessage = $_POST['emailMessage'];

    // Insert the notification into the database
    $insert_query = "INSERT INTO notifications (user_id, message) VALUES ((SELECT id FROM tubuan1 WHERE email = '$recipientEmail'), '$emailMessage')";
    if ($conn->query($insert_query) === TRUE) {
        // Notification inserted successfully
        echo '<script>alert("Notification sent successfully.");</script>';
    } else {
        // Error inserting notification
        echo '<script>alert("Error sending notification.");</script>';
    }
}

// Fetch email addresses from the database
$emailArray = array();
$query = "SELECT email FROM tubuan1";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $emailArray[] = $row['email'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">


            <!-- Modals -->
            <!-- Send Email Modal -->
            <div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="color: black;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="recipientEmail">Recipient's Email</label>
                                    <select class="form-control" id="recipientEmail" name="recipientEmail" required>
                                        <option value="" selected disabled>Select Recipient's Email</option>
                                        <?php foreach ($emailArray as $email): ?>
                                            <option value="<?php echo $email; ?>">
                                                <?php echo $email; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="emailMessage">Message</label>
                                    <textarea class="form-control" id="emailMessage" name="emailMessage" rows="5"
                                        required></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="sendEmail" class="btn btn-primary">Send</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add Modal -->
            <div class="modal fade" id="residentsaddModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Records</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="sabcrud.php" method="POST" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- First Column -->
                                        <div class="form-group">
                                            <label for="f_name">First Name</label>
                                            <input type="text" name="f_name" class="form-control">

                                            <label for="l_name">Last Name</label>
                                            <input type="text" name="l_name" class="form-control">

                                            <div class="input-box">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>

                                            <label for="bplace">Birth Place</label>
                                            <input type="text" id="bplace" name="birth_place" class="form-control">

                                            <div class="input-box">
                                                <label for="fhead">Voter Status</label>
                                                <select class="form-control" name="voter_status"
                                                    aria-label="Default select example">
                                                    <option value="" selected disabled>Select Voter Status</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>

                                            <label for="email">Email</label>
                                            <input type="text" id="email" name="Email" class="form-control">

                                            <div class="input-box">
                                                <label for="fhead">Family Head</label>
                                                <select class="form-control" name="fam_head"
                                                    aria-label="Default select example">
                                                    <option value="" selected disabled>Yes or No</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Add other form fields for the first column as needed -->

                                    </div>
                                    <div class="col-md-6">
                                        <!-- Second Column -->
                                        <div class="form-group">
                                            <label for="m_name">Middle Name</label>
                                            <input type="text" name="m_name" class="form-control">

                                            <label for="s_name">Suffix Name</label>
                                            <input type="text" name="suffix_name" class="form-control">

                                            <label>Date of Birth</label>
                                            <input class="form-control" type="date" name="dobirth" id="dbrth">

                                            <label for="occupation">Occupation</label>
                                            <input type="text" name="job" id="work" class="form-control">

                                            <label for="barangay">Barangay</label>
                                            <input type="text" name="barangay" id="barangay" class="form-control">

                                            <label for="pword">Password</label>
                                            <input type="text" id="pw" name="Password" class="form-control">
                                        </div>
                                        <!-- Add other form fields for the second column as needed -->

                                    </div>
                                </div>
                                <!-- Repeat the structure for additional rows if needed -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="savedata" class="btn btn-primary">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Update Modal -->
            <div class="modal fade" id="updateeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="color: black;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Records</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="sabcrud.php" method="POST" autocomplete="off">
                                <!-- Add your update form fields here -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- First Column -->
                                        <input type="hidden" name="update_id" id="update_id">
                                        <div class="form-group">
                                            <label for="update_f_name">First Name</label>
                                            <input type="text" name="update_f_name" id="update_f_name"
                                                class="form-control">

                                            <label for="update_l_name">Last Name</label>
                                            <input type="text" name="update_l_name" id="update_l_name"
                                                class="form-control">

                                            <label for="Gender">Gender</label>
                                            <input type="text" name="gender" id="Gender" class="form-control">

                                            <label for="bplace">Birth Place</label>
                                            <input type="text" id="birthplace" name="birth_place" class="form-control">

                                            <label for="Vstatus">Voter Status</label>
                                            <input type="text" id="vs" name="vote_s" class="form-control">

                                            <label for="email">Email</label>
                                            <input type="text" id="em" name="Email" class="form-control">

                                            <label for="Famhead">Family Head</label>
                                            <input type="text" id="fhead" name="famh" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="m_name">Middle Name</label>
                                            <input type="text" name="m_name" id="middle_name" class="form-control">

                                            <label for="s_name">Suffix Name</label>
                                            <input type="text" name="suf_name" id="sf_name" class="form-control">

                                            <label>Date of Birth</label>
                                            <input class="form-control" type="date" name="dobirth" id="dbrth">

                                            <label for="occupation">Occupation</label>
                                            <input type="text" name="job" id="occ" class="form-control">

                                            <label for="barangay">Barangay</label>
                                            <input type="text" name="barangay" id="bar" class="form-control">

                                            <label for="pword">Password</label>
                                            <input type="text" id="pword" name="Password" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Add other form fields for the update as needed -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="update_data" class="btn btn-primary">Update</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <?php
            $query = "SELECT * FROM tubuan1";

            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query Failed: " . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this record?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a href="sabcrud.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h1 class="m-0 font-weight-bold text-primary">Barangay Tubuan III Resident Records</h1>
                    </div>
                    <div class="card-body">
                        <div class="box1 mb-4">
                            <!-- Button trigger alert modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#residentsaddModal">
                                Add Records
                            </button>

                            <!-- ADD SUCCESS MESSASGE -->
                            <?php
                            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    ' . $_SESSION['success'] . '
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                unset($_SESSION['success']);
                            }
                            ?>

                            <!-- UPDATE SUCCESS MESSASGE -->
                            <?php
                            if (isset($_SESSION['update_success']) && $_SESSION['update_success'] != '') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    ' . $_SESSION['update_success'] . '
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                unset($_SESSION['update_success']);
                            }
                            ?>
                            <!-- DELETE SUCCESS MESSASGE -->
                            <?php
                            if (isset($_SESSION['delete_success']) && $_SESSION['delete_success'] != '') {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    ' . $_SESSION['delete_success'] . '
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                unset($_SESSION['delete_success']);
                            }
                            ?>


                            <!-- Button trigger Send Email modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                data-target="#sendEmailModal">
                                Send Email
                            </button>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Suffix Name</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Birth Place</th>
                                        <th>Occupation</th>
                                        <th>Voter Status</th>
                                        <th>Barangay</th>
                                        <th style="text-align: center;">Email</th>
                                        <th>Password</th>
                                        <th>Family Head</th>
                                        <th style="text-align: center;">Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Suffix Name</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Birth Place</th>
                                        <th>Occupation</th>
                                        <th>Voter Status</th>
                                        <th>Barangay</th>
                                        <th style="text-align: center;">Email</th>
                                        <th>Password</th>
                                        <th>Family Head</th>
                                        <th style="text-align: center;">Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM tubuan1";
                                    $query_run = mysqli_query($conn, $query);


                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['first_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['middle_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['last_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['suffix_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['gender']; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('M. d, Y', strtotime($row['date_of_birth'])); ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['birth_place']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['occupation']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['voter_status']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['barangay']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['password']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['family_head']; ?>
                                                </td>
                                                <td style="text-align: center; width: 200px;">
                                                    <!-- Update button -->
                                                    <button type="button" class="btn btn-success update-btn" data-toggle="modal"
                                                        name="update_records" data-target="#updateeModal"
                                                        data-id="<?php echo $row['id']; ?>"
                                                        data-fname="<?php echo $row['first_name']; ?>"
                                                        data-mname="<?php echo $row['middle_name']; ?>"
                                                        data-lname="<?php echo $row['last_name']; ?>"
                                                        data-sname="<?php echo $row['suffix_name']; ?>"
                                                        data-gender="<?php echo $row['gender']; ?>"
                                                        data-dob="<?php echo $row['date_of_birth']; ?>"
                                                        data-bp="<?php echo $row['birth_place']; ?>"
                                                        data-work="<?php echo $row['occupation']; ?>"
                                                        data-vs="<?php echo $row['voter_status']; ?>"
                                                        data-barangay="<?php echo $row['barangay']; ?>"
                                                        data-email="<?php echo $row['email']; ?>"
                                                        data-pw="<?php echo $row['password']; ?>"
                                                        data-fh="<?php echo $row['family_head']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Delete button -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteModal<?php echo $row['id']; ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


        <?php
        include('includes/scripts.php');
        include('includes/footer.php');
        ?>

        <?php
        include('send_email.php');
        include('includes/dbcon.php');

        // Fetch email addresses from the database
        $query = "SELECT email FROM tubuan1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $to_email = $row['email']; // Email address from the database
        
                // Email subject and message
                $subject = "Your Subject Here";
                $message = "Your Message Here";

                // Send email
                $headers = "From: Admin"; // Replace with your email
                if (mail($to_email, $subject, $message, $headers)) {
                    echo "Email sent to: $to_email<br>";
                } else {
                    echo "Failed to send email to: $to_email<br>";
                }
            }
        } else {
            echo "Error: Unable to fetch email addresses from the database.";
        }
        ?>

        <script>
            // Script to handle update button click event
            $(document).ready(function () {
                $('.update-btn').on('click', function () {
                    $('#update_id').val($(this).data('id'));
                    $('#update_f_name').val($(this).data('fname'));
                    $('#update_l_name').val($(this).data('lname'));
                    $('#middle_name').val($(this).data('mname'));
                    $('#sf_name').val($(this).data('sname'));
                    $('#Gender').val($(this).data('gender'));
                    $('#dbrth').val($(this).data('dob'));
                    $('#birthplace').val($(this).data('bp'));
                    $('#occ').val($(this).data('work'));
                    $('#vs').val($(this).data('vs'));
                    $('#bar').val($(this).data('barangay'));
                    $('#em').val($(this).data('email'));
                    $('#pword').val($(this).data('pw'));
                    $('#fhead').val($(this).data('fh'));
                });
            });
        </script>

</body>

</html>