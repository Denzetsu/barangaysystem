<?php 
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags and title go here -->
</head>
<body>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">


<!-- Delete Modal -->
<?php
$query = "SELECT * FROM business_clearance";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this record?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Cancel</button>
                        <a href="addbusinessclr.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<!-- Read Modal -->
<?php

$query = "SELECT * FROM business_clearance";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="modal fade" id="readModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="readModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="readModalLabel">View Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <p><strong>Person ID:</strong> <?php echo $row['id']; ?></p>
                            <p><strong>Full Name:</strong> <?php echo $row['name']; ?></p>
                            <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                            <p><strong>Owner:</strong> <?php echo $row['owner']; ?></p>
                            <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
                            <p><strong>Date Filed:</strong> <?php echo $row['date_filed']; ?></p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>


<!-- Update Modal -->
<?php
$query = "SELECT * FROM business_clearance";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="updateModalLabel">Update Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="addbusinessclr.php" method="POST" autocomplete="off">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-form-label"><b>Name of Business/Activity:</b></label>
                
                                <input type="text" class="form-control" name="business" id="business" value="<?php echo $row['name']; ?>" placeholder="Enter Name of Business/Activity"  required>
                              
                                <label class="col-form-label"><b>Location:</b></label>
                                <div>
                                    <input type="text" id="loc" name="loc" class="form-control" value="<?php echo $row['location']; ?>"
                                    placeholder="Enter Location" required>
                                </div>                    

                                <label class="col-form-label"><b>Name of Owner/Operator:</b></label>
                                <div>
                                <input type="text" class="form-control" name="owner" id="owner" value="<?php echo $row['owner']; ?>" placeholder="Enter Name of Owner/Operator" required>
                                </div>
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-form-label"><b>Address:</b></label>
                
                                    <input type="text" class="form-control" name="address" id="adress" value="<?php echo $row['address']; ?>" placeholder="Enter address" required>
               
                                    
                                    
                                    <label class="col-form-label">Date Filed:</label>
                                    <div>
                                        <input type="datetime-local" id="date_filed" name="date_filed" class="form-control" value="<?php echo $row['date_filed']; ?>" required> 
                                    </div>
           
                                    <!-- Add more columns here -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
 

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Add Records</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="addbusinessclr.php" method="POST" autocomplete="off">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="col-form-label"><b>Name of Business/Activity:</b></label>
                
                <input type="text" class="form-control" name="business" id="business" value="" placeholder="Enter Name of Business/Activity" required>
                
                <label class="col-form-label"><b>Location:</b></label>
                <div>
                    <input type="text" id="loc" name="loc" class="form-control" value=""
                    placeholder="Enter Location" required>
                </div>

                <label class="col-form-label"><b>Name of Owner/Operator:</b></label>
                <div>
                <input type="text" class="form-control" name="owner" id="owner" value="" placeholder="Enter Name of Owner/Operator" required>
                </div>
                
              </div>
            </div>



            <div class="col-md-6">
              <div class="form-group">
              <label class="col-form-label"><b>Address:</b></label>
                <div>
                <input type="text" class="form-control" name="address" id="adress" value="" placeholder="Enter address" required>
                </div>
                
                <label for="date_filed">Date Filed:</label>
                <div>
                <input type="datetime-local" id="date_filed" name="date_filed" class="form-control" required>
                </div>
                
                <!-- Add more columns here -->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" name="add_data" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid">
    <!-- DataTales Example -->
 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="m-0 font-weight-bold text-primary">Barangay Sabutan Business Clearance Request</h1>
                        </div>
                        <div class="card-body">
                        <div class="box1 mb-4">
                                    <!-- Button trigger alert modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
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
                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    ' . $_SESSION['delete_success'] . '
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                            unset($_SESSION['delete_success']);
                                        }
                                        ?>


                                    
                                </div>
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Location</th>
                                    <th>Owner</th>
                                    <th>Address</th>
                                    <th>Date Filed</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Location</th>
                                    <th>Owner</th>
                                    <th>Address</th>
                                    <th>Date Filed</th>
                                    <th>Action</th>
                                    </tr>
                                </tfoot>

                                    <tbody>
                                        <?php
                                     
                                        $query = "SELECT * FROM business_clearance";
                                      

                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0) {
                                            foreach($query_run as $row) {
                                                ?>
                                                <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['location']; ?></td>
                                                <td><?php echo $row['owner']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><?php echo date('M. j, Y g:iA', strtotime($row['date_filed'])); ?></td>

                                                    
                                                    
                                                    <td style="width: 200px;">
                                                     <!-- Button to Open Read Modal -->
                                                     <button type="button" class="btn btn-info" data-toggle="modal" data-target="#readModal<?php echo $row['id']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                        </button>
                                                        
                                                        <!-- Button to trigger the Update Modal -->
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModal<?php echo $row['id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                        </button>
                                                        <!-- Button to Open Delete Modal -->
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $row['id']; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <!-- Button to Print Form -->
                                                        <button type="button" class="btn btn-primary" onclick="redirectToPHP()">
                                                            <i class="fas fa-print"></i>
                                                        </button>
                                                        <script>
                                                            function redirectToPHP() {
                                                                // Redirect to your PHP file
                                                                window.location.href = 'businessclr.php';
                                                            }
                                                        </script>
                                                   
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                            <td colspan="6" class="text-center">No Records Found</td>
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
</div>
<!-- End of Main Content -->


<?php 
include('includes/scripts.php');
include('includes/footer.php');

?>





