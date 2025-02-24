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
$query = "SELECT * FROM blotter_3";

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
                        <a href="addblotter.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
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
$query = "SELECT blotter_3.*, case_numbers_3.case_number 
FROM blotter_3 
INNER JOIN case_numbers_3 ON blotter_3.id = case_numbers_3.blotter_id";


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
                        <p><strong>Case No:</strong> <?php echo $row['case_number']; ?></p>
                        <p><strong>Respondent's Name:</strong> <?php echo $row['respondent_name']; ?></p>
                        <p><strong>Complainant's Name:</strong> <?php echo $row['complainant_name']; ?></p>
                        <p><strong>Subject:</strong> <?php echo $row['subject']; ?></p>
                        <p><strong>Date Filed:</strong> <?php echo $row['date_filed']; ?></p>
                        <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
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
$query = "SELECT blotter_3.*, case_numbers_3.case_number 
FROM blotter_3 
INNER JOIN case_numbers_3 ON blotter_3.id = case_numbers_3.blotter_id";

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
                <form action="addblotter.php" method="POST" autocomplete="off">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="respondent_name">Respondent's Name</label>
                                <input type="text" class="form-control" id="respondent_name" name="respondent_name" value="<?php echo $row['respondent_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $row['subject']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Active" <?php if ($row['status'] == 'Active') echo 'selected'; ?>>Active</option>
                                <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="Settled" <?php if ($row['status'] == 'Settled') echo 'selected'; ?>>Settled</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="complainant_name">Complainant's Name</label>
                                <input type="text" class="form-control" id="complainant_name" name="complainant_name" value="<?php echo $row['complainant_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="date_filed">Date Filed</label>
                                <input type="datetime-local" class="form-control" id="date_filed" name="date_filed" value="<?php echo $row['date_filed']; ?>" required>
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
        <form action="addblotter.php" method="POST" autocomplete="off">
          <div class="row">
            <div class="col-md-6">
              <!-- First Column -->
              <!-- Add other form fields for the first column as needed -->
              <div class="form-group">
                <label for="respondent_name">Respondent's Name</label>
                <input type="text" id="respondent_name" name="respondent_name" class="form-control">
              </div>
              <!-- Add other form fields for the first column as needed -->
              <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control">
              </div>
              <div class="form-group">
                <label class="col-form-label">Status:</label>
                <select name="status" id="status" class="custom-select" required>
                    <option value="" selected disabled>Select Status</option>
                    <option value="Active">Active</option>
                </select>
            </div>
            </div>
            <div class="col-md-6">
              <!-- Second Column -->
              <div class="form-group">
                <label for="complainant_name">Complainant's Name</label>
                <input type="text" id="complainant_name" name="complainant_name" class="form-control">
              </div>
              <!-- Add other form fields for the second column as needed -->
            <div class="form-group">
            <label>Date Filed:</label>
            <input type="datetime-local" id="date_filed" name="date_filed" class="form-control" required>
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
                            <h1 class="m-0 font-weight-bold text-primary">Barangay Tubuan III Blotter</h1>
                        </div>
                        <div class="card-body">
                        <div class="box1 mb-4">
                                    <!-- Button trigger alert modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                        Add Records
                                        </button>
                                      <!-- Button to Print Form -->
                                            <select id="redirectSelect" class="btn btn-primary" onchange="redirectToPHP()" style="width: 150px;">
                                                <option value="">🖨️Print</option>
                                                <option value="summonform.php">Summon</option>
                                                <option value="cfaform.php">Cfa form</option>
                                                <!-- Add more options if needed -->
                                            </select>

                                            <script>
                                                function redirectToPHP() {
                                                    var selectedOption = document.getElementById("redirectSelect").value;
                                                    if (selectedOption !== "") {
                                                        // Redirect to the selected PHP file
                                                        window.location.href = selectedOption;
                                                    }
                                                }
                                            </script>

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
                                            <th>Case ID</th>
                                            <th>Respondent's Name</th>
                                            <th>Complainant's Name</th>
                                            <th>Subject</th>
                                            <th>Date Filed</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Case ID</th>
                                            <th>Respondent's Name</th>
                                            <th>Complainant's Name</th>
                                            <th>Subject</th>
                                            <th>Date Filed</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $query = "SELECT blotter_3.*, case_numbers_3.case_number 
                                                  FROM blotter_3 
                                                  INNER JOIN case_numbers_3 ON blotter_3.id = case_numbers_3.blotter_id";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0) {
                                            foreach($query_run as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['case_number']; ?></td>
                                                    <td><?php echo $row['respondent_name']; ?></td>
                                                    <td><?php echo $row['complainant_name']; ?></td>
                                                    <td><?php echo $row['subject']; ?></td>
                                                    <td><?php echo date('M. j, Y g:iA', strtotime($row['date_filed'])); ?></td>
                                                    <td><?php echo $row['status']; ?></td>
                                                    
                                                    
                                                    <td style="width: 200px;">
                                                     <!-- Button to Open Read Modal -->
                                                     <button type="button" class="btn btn-info" data-toggle="modal" data-target="#readModal<?php echo $row['id']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                        </button>
                                                         <!-- Button to Open Update Modal -->
                                                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModal<?php echo $row['id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                        </button>
                                                        <!-- Button to Open Delete Modal -->
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $row['id']; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                      
                                                   
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

// Add this script to your HTML file
<script>
$(document).ready(function() {
    // Check if there are any highlighted buttons stored in local storage
    var highlightedButtons = JSON.parse(localStorage.getItem('highlightedButtons'));

    // Loop through each highlighted button ID and apply the highlight class
    if (highlightedButtons) {
        highlightedButtons.forEach(function(buttonId) {
            $('[data-id="' + buttonId + '"]').addClass('highlight');
        });
    }
});

// Update the toggleHighlight function
function toggleHighlight(button) {
    // Check if the button contains the class btn-outline-dark
    if ($(button).hasClass('btn-outline-dark')) {
        // Toggle the highlight class only for buttons with the class btn-outline-dark
        $(button).toggleClass('highlight');
        var isHighlighted = $(button).hasClass('highlight');
        var buttonId = $(button).data('id');

        // Update local storage to store the highlighted state of the button
        var highlightedButtons = JSON.parse(localStorage.getItem('highlightedButtons')) || [];
        if (isHighlighted) {
            // Add button ID to the array if it's highlighted
            highlightedButtons.push(buttonId);
        } else {
            // Remove button ID from the array if it's unhighlighted
            highlightedButtons = highlightedButtons.filter(function(id) {
                return id !== buttonId;
            });
        }
        localStorage.setItem('highlightedButtons', JSON.stringify(highlightedButtons));

        // Send AJAX request to update the status of the button
        $.ajax({
            type: "POST",
            url: "update_button_status.php",
            data: { button_id: buttonId, is_highlighted: isHighlighted },
            success: function(response) {
                console.log('Button status updated successfully');

                // Add real-time notification if button is highlighted
                if (isHighlighted) {
                    addRealtimeNotification(buttonId);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating button status');
            }
        });
    }
}


function addRealtimeNotification(buttonId) {
    // Send AJAX request to add real-time notification
    $.ajax({
        type: "POST",
        url: "notifications.php",
        data: { notifications: true, notification: "Claim your Form in the Barangay" },
        success: function(response) {
            console.log('Real-time notification added successfully');
        },
        error: function(xhr, status, error) {
            console.error('Error adding real-time notification');
        }
    });
}
</script>




<style>

.highlight {
    background-color: greenyellow;
}
</style>
