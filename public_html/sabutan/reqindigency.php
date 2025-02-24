<?php 
include('includes/header.php');
include('includes/navsabutan.php');
include('includes/dbcon.php');

// Start the session
session_start();

// Assuming user information is stored in the session after login
$user_full_name = isset($_SESSION['user_full_name']) ? $_SESSION['user_full_name'] : '';

// Alternatively, if you need to fetch user information from the database, you can do it here
// For example:
// $user_id = $_SESSION['user_id']; // Assuming you store user ID in the session
// $query = "SELECT full_name FROM users WHERE id = '$user_id'";
// $result = mysqli_query($connection, $query);
// if ($result && mysqli_num_rows($result) > 0) {
//     $user = mysqli_fetch_assoc($result);
//     $user_full_name = $user['full_name'];
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags and title go here -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <h1 class="m-0 font-weight-bold text-primary">Request Certificate of Indigency</h1>
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
    <?php
    if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['message'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        unset($_SESSION['message']);
    }
     ?>
    <form method="POST" action="submitindigency.php" class="row" id="certificateForm" autocomplete="on">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label"><b>Full Name:</b></label>
            <div>
            <input type="text" class="form-control" name="cFName" id="cFName" value="<?php echo htmlspecialchars($user_full_name); ?>" placeholder="Enter full name">
            </div>

            <label class="col-form-label"><b>Age:</b></label>
              <div>
                <input type="text" id="cAge" name="cAge" class="form-control" value=""
                  placeholder="Enter Age" required>
              </div>

            <label class="col-form-label"><b>Civil Status:</b></label>
                <div>
                <select name="cCivilStatus" id="cCivilStatus" class="custom-select">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Separated">Separated</option>
                    <option value="Widowed">Widowed</option>
                </select>
                </div>

              <div>
                <br>
                <button type="submit" class="btn btn-primary add-btn">
                    <span class="btn-wrap">
                        <i class="fas fa-plus"></i> Submit
                    </span>
                </button>
              </div>
        </div>
    </div>

    <!-- 2nd row -->
    <div class="col-md-6">
    <div class="form-group">
        <label class="col-form-label"><b>Purpose:</b></label>
            <div>
            <input type="text" class="form-control" name="cPurpose" id="cPurpose" placeholder="Enter purpose" required>
            </div>

        <label class="col-form-label"><b>Date Filed:</b></label>
        <input type="datetime-local" id="date_filed" name="date_filed" class="form-control" disabled>
    </div>
    </div>
</form>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

  <?php 
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>

<script>
    // Set the "Date Filed" field to the current date and time in local format
    document.addEventListener('DOMContentLoaded', function() {
        var dateFiled = document.getElementById('date_filed');
        var now = new Date();

        // Get local time components
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2); // Months are zero-indexed
        var day = ('0' + now.getDate()).slice(-2);
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);

        // Format as "YYYY-MM-DDTHH:MM"
        var localDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Set the value
        dateFiled.value = localDatetime;
    });
</script>

</body>
</html>
