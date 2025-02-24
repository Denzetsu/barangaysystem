<?php
// Assuming you have started the session somewhere in your code.


include('includes/header.php');
include('includes/navsabutan.php');
include('includes/dbcon.php');

// Assuming $_SESSION['user_id'] contains the user ID after login.
$user_id = $_SESSION['user_id'];

// Fetch user information from the database based on the user ID
$sql = "SELECT * FROM sabutan WHERE id = $user_id"; // Assuming your table name is 'users'
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$email = $row['email'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$middle_name = $row['middle_name'];
$password = $row['password'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change User Profile</title>
</head>

<body>
  <div id="content-wrapper" class="d-flex flex-column">

    <div id="content">
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow ">
        <div id="content" class="d-flex justify-content-center align-items-center">
          <h1 class="m-0 font-weight-bold text-primary">Update Your Profile</h1>
        </div>
      </nav>

      <!-- UPDATE SUCCESS MESSAGE -->
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
      // UPDATE ERROR MESSAGE
      if (isset($_SESSION['update_error']) && $_SESSION['update_error'] != '') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          ' . $_SESSION['update_error'] . '
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>';
        unset($_SESSION['update_error']);
      }
      ?>
      <div class="container">
        <table class="table table-unbordered" id="dataTable" width="30%" cellspacing="10">
          <tr>
            <th>Email</th>
            <td>
              <?php echo $email; ?>
            </td>
          </tr>
          <tr>
            <th>First Name</th>
            <td>
              <?php echo $first_name; ?>
            </td>
          </tr>
          <tr>
            <th>Middle Name</th>
            <td>
              <?php echo $middle_name; ?>
            </td>
          </tr>
          <tr>
            <th>Last Name</th>
            <td>
              <?php echo $last_name; ?>
            </td>
          </tr>

          <tr>
            <th>Password</th>
            <td>
              <div class="input-group">
                <span id="displayPassword" class="form-control">
                  <?php echo str_repeat('*', strlen($password)); ?>
                </span>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" id="toggleDisplayPassword">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                  </button>
                </div>
              </div>
            </td>
          </tr>

          <!-- Add additional rows/columns for more user profile information if needed -->
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProfileModal">
          Update Profile
        </button>
      </div>
    </div>

    <!-- Update Profile Modal -->
    <div class="modal" id="updateProfileModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update Profile</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="post" action="updateprofile.php">
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
              </div>
              <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="first_name"
                  value="<?php echo $first_name; ?>">
              </div>
              <div class="form-group">
                <label for="firstName">Middle Name:</label>
                <input type="text" class="form-control" id="firstName" name="middle_name"
                  value="<?php echo $middle_name; ?>">
              </div>
              <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="last_name"
                  value="<?php echo $last_name; ?>">
              </div>

              <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
              </div>
              <!-- Add new password field -->
              <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
              </div>
              <!-- Add more input fields for additional profile information if needed -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      });
    </script>

    <script>
      document.getElementById('toggleDisplayPassword').addEventListener('click', function () {
        const displayPassword = document.getElementById('displayPassword');
        const icon = this.querySelector('i');

        if (displayPassword.textContent === "<?php echo str_repeat('*', strlen($password)); ?>") {
          displayPassword.textContent = "<?php echo $password; ?>";
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          displayPassword.textContent = "<?php echo str_repeat('*', strlen($password)); ?>";
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      });
    </script>



    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>

  </div>
</body>

</html>