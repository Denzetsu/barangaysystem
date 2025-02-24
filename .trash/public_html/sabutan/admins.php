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
$query = "SELECT * FROM admin1";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="modal fade" id="deleteModal<?php echo $row['UserID']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mt-3">Are you sure you want to delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-outline-danger" data-dismiss="modal">No</button>
                        <a href="admincrud.php?UserID=<?php echo $row['UserID']; ?>" class="btn btn-danger">Yes</a>
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
$query = "SELECT * FROM admin1";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="modal fade" id="updateModal<?php echo $row['UserID']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="updateModalLabel">Update Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="admincrud.php" method="POST" autocomplete="off">
                    <!-- Add your update form fields here -->
                    <input type="hidden" name="update_id" value="<?php echo $row['UserID']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- First Column -->
                            <div class="form-group">
                                <label for="update_admin">Username</label>
                                <input type="text" name="update_uname" class="form-control" value="<?php echo $row['Username']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_pw">Password</label>
                                <input type="text" name="update_pw" class="form-control" value="<?php echo $row['Password']; ?>">
                            </div>
                        </div>
                        <!-- Add other form fields for the update as needed -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_data" class="btn btn-success">Update</button>
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


<!-- Read Modal -->
<?php
$query = "SELECT * FROM admin1";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="modal fade" id="readModal<?php echo $row['UserID']; ?>" tabindex="-1" role="dialog" aria-labelledby="readModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="readModalLabel">View Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>ID:</strong> <?php echo $row['UserID']; ?></p>
                        <p><strong>Username:</strong> <?php echo $row['Username']; ?></p>
                        <p><strong>Password:</strong> <?php echo $row['Password']; ?></p>
                        <!-- Add other fields as needed -->
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
        <form action="admincrud.php" method="POST" autocomplete="off">
          <div class="row">
            <div class="col-md-6">
              <!-- First Column -->
              <div class="form-group">
                <label for="f_name">First Name</label>
                <input type="text" id="Username" name="Username" class="form-control">
             
               
               
             </div>
              <!-- Add other form fields for the first column as needed -->

            </div>
            <div class="col-md-6">
              <!-- Second Column -->
              <div class="form-group">

                <label for="pword">Password</label>
                <input type="text" id="pw" name="Password" class="form-control">
             </div>
              <!-- Add other form fields for the second column as needed -->

            </div>
          </div>
          <!-- Repeat the structure for additional rows if needed -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Close</button>
        <button type="submit" name="add_data" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="m-0 font-weight-bold text-primary">Barangay Sabutan Admins</h1>
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
                                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM admin1";
                                        $query_run = mysqli_query($conn, $query);


                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                                 foreach($query_run as $row)
                                                 {
                                                  ?>
                                                    <tr>
                                                    <td><?php echo $row['UserID']; ?></td>
                                                    <td><?php echo $row['Username']; ?></td>
                                                    <td><?php echo $row['Password']; ?></td>
                                                    
                                                    <td style = "width: 200px;">
                                                    
                                                    <!-- Button to Open Read Modal -->
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#readModal<?php echo $row['UserID']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                    </button>

                                                        <!-- Button to Open Update Modal -->
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModal<?php echo $row['UserID']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                        </button>

                                                        <!-- Button to Open Delete Modal -->
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $row['UserID']; ?>">
                                                       <i class="fas fa-trash"></i>
                                                       </button>


                                                    </td>
                                                
                                                    

                                                    </tr>
                                                  <?php
                                                 }
                                         }
                                         else
                                         {
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
