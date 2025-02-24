<?php
// Start a session or resume the current session
session_start();

if (isset($_POST['login'])) {
    // Establish a database connection (update with your database credentials)
    $conn = new mysqli("localhost", "u664069117_dauntless", "DauntlessBM2024", "u664069117_barangaysystem");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];
  

    // Perform a query to check user credentials in sabutan
    $sql_sabutan = "SELECT * FROM sabutan WHERE email = '$email' AND password = '$password'";
    $result_sabutan = $conn->query($sql_sabutan);

    // Perform a query to check user credentials in tubuan1
    $sql_tubuan1 = "SELECT * FROM tubuan1 WHERE email = '$email' AND password = '$password'";
    $result_tubuan1 = $conn->query($sql_tubuan1);

    // Perform a query to check user credentials in tubuan2
    $sql_tubuan2 = "SELECT * FROM tubuan2 WHERE email = '$email' AND password = '$password'";
    $result_tubuan2 = $conn->query($sql_tubuan2);

    if ($result_sabutan->num_rows == 1) {
        // Store user ID in a session variable
        $_SESSION['user_id'] = $result_sabutan->fetch_assoc()['id'];
        $_SESSION['email'] = $email;

        // Redirect to some page for users in sabutan
        header("Location: residentspage1.php");
        exit();
    } elseif ($result_tubuan1->num_rows == 1) {
        // Store user ID in a session variable
        $_SESSION['user_id'] = $result_tubuan1->fetch_assoc()['id'];
        $_SESSION['email'] = $email;
        // Redirect to user_page2.php for users in tubuan1
        header("Location: user_page2.php");
        exit();
    } elseif ($result_tubuan2->num_rows == 1) {
        // Store user ID in a session variable
        $_SESSION['user_id'] = $result_tubuan2->fetch_assoc()['id'];
        $_SESSION['email'] = $email;
        // Redirect to user_page3.php for users in tubuan2
        header("Location: user_page3.php");
        exit();
    } else {
        // Check if the email exists but password is incorrect
        $sql_check_email = "SELECT * FROM (SELECT * FROM sabutan UNION SELECT * FROM tubuan1 UNION SELECT * FROM tubuan2) AS all_users WHERE email = '$email'";
        $result_check_email = $conn->query($sql_check_email);
        
        if ($result_check_email->num_rows > 0) {
            // Display an alert for incorrect password
            echo '<script>
                    window.onload = function() {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Incorrect password. Please try again."
                        });
                    };
                </script>';
        } else {
            // Display an alert for user not existing
            echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "User does not exist. Please try again."
                });
            };
            </script>';
        }
        
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form</title> 
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>


    <style>
    .navbar {
      text-align: center; /* Center the text */
      
      padding: 10px; /* Add padding */
    }

    .logo-container {
      width: 200px; /* Fixed width for the logo container */
      margin: 0 auto; /* Center the logo horizontally */
    }

    .container {
      margin-top: 20px; /* Add margin at the bottom */
    }
  </style>
</head>
<body>
  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="logo-container">
      <img src="img/sabutanlogo.png" alt="Logo" width="200"> <!-- Adjust path to your logo -->
    </div>
  </nav>
  <!-- End of Topbar -->


  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Resident Access</span></div>
        <form action="login.php" method="POST"> <!-- Set the action to the PHP script handling the login -->
        <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required autocomplete="off">
        </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <div class="pass"><a href="adminlogin.php">Admin log in</a></div>
          <div class="row button">
            <input type="submit" name="login" value="Login">
          </div>
          <div class="signup-link">Not Yet Registered? <a href="regform.php">Signup now</a></div>
        </form>
      </div>
    </div>
  </body>
</html>

<?php 
include('includes/scripts.php');

?>
