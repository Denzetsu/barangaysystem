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
 <!-- Begin Page Content -->
 <div class="container-fluid">
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="m-0 font-weight-bold text-primary">Barangay Projects</h1>
                        </div>
                        <div class="card-body">
                        <div class="box1 mb-4">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#form_modal">
        Add Project
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
      <br><br>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
        <thead style="text-align: center;">
          <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Details</th>
            <th>Budget</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = mysqli_query($conn, "SELECT * FROM `projects2`") or die(mysqli_error($conn));
          while($fetch = mysqli_fetch_array($query)){
          ?>
          <tr>
            <td style="text-align: center;"><img src="<?php echo $fetch['image']?>" height="100" width="100" alt="User Photo"></td>
            <td style = "width: 200px;"><?php echo $fetch['title']?></td>
            <td style="text-align: center; text-align: justify; width: 800px;"><?php echo $fetch['details']?></td>  
            <td style="text-align: center;"><?php echo $fetch['budget']?></td> 
            <td style="text-align: center;"><?php echo date('M. d, Y', strtotime($fetch['date'])); ?></td>
            
            
            <td style="text-align: center;">


             <!-- Button to Open Read Modal -->
             <button type="button" class="btn btn-info" data-toggle="modal" data-target="#readModal<?php echo $fetch['user_id']; ?>">
              <i class="fas fa-eye"></i>
              </button>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $fetch['user_id']?>">
              <i class="fas fa-edit"></i>
              </button>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $fetch['user_id']; ?>">
              <i class="fas fa-trash"></i> 
              </button>

            </td>
          
          </tr> 


          <!-- Edit Modal --> 
          <div class="modal fade" id="edit<?php echo $fetch['user_id']?>" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" action="projcode.php" autocomplete="off">
                  <div class="modal-header modal-header bg-success text-white">
                    <h3 class="modal-title">Edit Project</h3>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <h4>Current Photo</h4>
                        <img src="<?php echo $fetch['image']?>" height="150" width="150" alt="Current Photo">
                        <input type="hidden" name="previous" value="<?php echo $fetch['image']?>">
                        <h4>New Photo</h4>
                        <input type="file" class="form-control" name="image" accept="image/*" required="required">
                      </div>
                      <div class="form-group">
                        
                        <input type="hidden" value="<?php echo $fetch['user_id']?>" name="user_id">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="<?php echo $fetch['title']?>" required="required">

                      </div>
                      <div class="form-group">
                      <label>Details</label>
                      <textarea class="form-control" name="details" required="required"><?php echo $fetch['details']?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Budget</label>
                        <input type="text" class="form-control" value="<?php echo $fetch['budget']?>" name="budget" required="required">
                      </div>
                      <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" value="<?php echo $fetch['date']?>" type="date" name="date" id="dbrth">
                    </div>
                    </div>
                  </div>
                  <br style="clear:both;">
                  <div class="modal-footer">
                    <button class="btn btn-outline-success waves-effect" data-dismiss="modal">
                       Close
                    </button>
                    <button class="btn btn-success" name="edit" >
                       Update
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>


             
          <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal<?php echo $fetch['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this project?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Close</button>
                            <a href="projcode.php?user_id=<?php echo $fetch['user_id']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
        

    <!-- Read Modal -->
      <?php
      $query = "SELECT * FROM projects2";
      $result = mysqli_query($conn, $query);

      if (!$result) {
          die("Query Failed: " . mysqli_error($conn));
      } else {
          while ($fetch = mysqli_fetch_assoc($result)) {
              ?>
              <div class="modal fade" id="readModal<?php echo $fetch['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="readModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header bg-info text-white">
                              <h5 class="modal-title" id="readModalLabel">View Record</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <p><strong>Image:</strong></p>
                              <img src="<?php echo $fetch['image']; ?>" height="150" width="150" alt="Current Photo">
                              <input type="hidden" name="previous" value="<?php echo $fetch['image']; ?>">
                              <p><strong>Title:</strong> <?php echo $fetch['title']; ?></p>
                              <p><strong>Details:</strong> <?php echo $fetch['details']; ?></p>
                              <p><strong>Budget:</strong> <?php echo $fetch['budget']; ?></p>
                              <p><strong>Date:</strong> <?php echo $fetch['date']; ?></p>
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
        <div class="modal fade" id="form_modal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="POST" action="projadd.php" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header bg-primary text-white">
                  <h3 class="modal-title">Add Project</h3>
                </div>
                <div class="modal-body">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" class="form-control" name="image" accept="image/*" required="required">
                    </div>
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control" name="title" required="required" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label>Details</label>
                      <textarea class="form-control" name="details" required="required" autocomplete="off"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Budget</label>
                      <input type="text" class="form-control" name="budget" required="required" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" type="date" name="date" id="dbrth" autocomplete="off">
                    </div>
                  </div>
                </div>
                <br style="clear:both;">
                <div class="modal-footer">
                  <button class="btn btn-outline-primary waves-effect" type="button" data-dismiss="modal">
                    Close
                  </button>
                  <button class="btn btn-primary" name="save">
                    Save
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

  </div>
</div>

       

   
   </div> <!-- End of #content -->
  </div> <!-- End of #content-wrapper -->
<?php 
  include('includes/scripts.php');
  include('includes/footer.php');
?>