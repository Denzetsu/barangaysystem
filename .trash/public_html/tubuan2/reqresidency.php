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
    <h1 class="m-0 font-weight-bold text-primary">Request Certificate of Residency</h1>
     

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
    <form method="POST" action="submitresidency.php" class="row" id="certificateForm" autocomplete="on">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label"><b>Full Name:</b></label>
            <div>
            <input type="text" class="form-control" name="cFName" id="cFName" value="" placeholder="Enter full name" required>
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
    
            <label class="col-form-label"><b>Date Filed:</b></label>
            <input type="datetime-local" id="date_filed" name="date_filed" class="form-control" required>
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

  
</body>
</html>