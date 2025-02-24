<?php 
include('includes/header.php');
include('includes/navtubuan2.php');
include('includes/dbcon.php');


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
    <h1 class="m-0 font-weight-bold text-primary">Report Blotter</h1>
     

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
    <form method="POST" action="submitblottercode.php" class="row" id="certificateForm" autocomplete="off">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label"><b>Respondent's Name:</b></label>
            <input type="text" class="form-control" name="respondent_name" id="respondent_name" placeholder="Enter full name" required>
        </div> 
        <div class="form-group">
            <label class="col-form-label"><b>Subject:</b></label>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter subject" required>
        </div>
        <div class="form-group">
            <label class="col-form-label"><b>Status:</b></label>
            <select name="status" id="status" class="custom-select" required>
                <option value="" selected disabled>Select Status</option>
                <option value="Active">Active</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label"><b>Complainant's Name:</b></label>
            <input type="text" class="form-control" name="complainant_name" id="complainant_name" placeholder="Enter full name" required>
        </div>
        <div class="form-group">
            <label class="col-form-label"><b>Date Filed:</b></label>
            <input type="datetime-local" id="date_filed" name="date_filed" class="form-control" required>
        </div>
       
    </div>
    <div class="col-md-6">
    <button type="submit" class="btn btn-primary add-btn">
            <span class="btn-wrap">
                <i class="fas fa-plus"></i> Submit
            </span>
        </button>
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

  
</body>
</html>