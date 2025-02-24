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
    <h1 class="m-0 font-weight-bold text-primary">Request Barangay Clearance</h1>
     

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
    <form method="POST" action="submitbrgyclr.php" class="row" id="certificateForm" autocomplete="on">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label"><b>Full Name:</b></label>
            <div>
            <input type="text" class="form-control" name="cFName" id="cFName" value="" placeholder="Enter full name" required>
            </div>

            <label class="col-form-label"><b>Address:</b></label>
            <div>
            <input type="text" class="form-control" name="cAddress" id="cAddress" value="" placeholder="Enter address" required>
            </div>

            <label class="col-form-label"><b>Date of Birth:</b></label>
            <div>
                <input type="date" class="form-control" name="cDob" id="cDob" placeholder="Enter Date of Birth" required>
            </div>

            <label class="col-form-label"><b>Sex:</b></label>
            <div>
            <select name="cSex" id="cSex" class="custom-select">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
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
    <label class="col-form-label"><b>Nationality:</b></label>
            <div>
            <input type="text" class="form-control" name="cNationality" id="cNationality" value="" placeholder="Enter nationality" required>
            </div>
    
        
        <label class="col-form-label"><b>Purpose:</b></label>
            <div>
            <input type="text" class="form-control" name="cPurpose" id="cPurpose" placeholder="Enter purpose" required>
            </div>
        
       
            <label class="col-form-label"><b>Community Tax Certificate No:</b></label>
            <div>
            <input type="text" class="form-control" name="cCtc" id="cCtc" value="" placeholder="Enter CTC No." required>
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