<?php 
include('includes/header.php');
include('includes/navtubuan1.php');
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
    <h1 class="m-0 font-weight-bold text-primary">Request Business Clearance</h1>
     

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
    <form method="POST" action="submitbusinessclr.php" class="row" id="certificateForm" autocomplete="on">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label"><b>Name of Business/Activity:</b></label>
            <div>
            <input type="text" class="form-control" name="business" id="business" value="" placeholder="Enter Name of Business/Activity" required>
            </div>

            
            <label class="col-form-label"><b>Location:</b></label>
              <div>
                <input type="text" id="loc" name="loc" class="form-control" value=""
                  placeholder="Enter Location" required>
              </div>
            <label class="col-form-label"><b>Name of Owner/Operator:</b></label>
            <div>
            <input type="text" class="form-control" name="owner" id="owner" value="" placeholder="Enter Name of Owner/Operator" required>
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
    <label class="col-form-label"><b>Address:</b></label>
            <div>
            <input type="text" class="form-control" name="address" id="adress" value="" placeholder="Enter address" required>
            </div>

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