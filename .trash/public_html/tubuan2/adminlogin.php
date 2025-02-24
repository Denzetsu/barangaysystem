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
    $username = $_POST['uname'];
    $password = $_POST['pword'];

    // Perform a query to check user credentials in admin
    $sql_admin = "SELECT * FROM admin1 WHERE Username = '$username' AND Password = '$password'";
    $result_admin = $conn->query($sql_admin);

    // Perform a query to check user credentials in admin2
    $sql_admin2 = "SELECT * FROM admin2 WHERE Username = '$username' AND Password = '$password'";
    $result_admin2 = $conn->query($sql_admin2);

    // Perform a query to check user credentials in admin3
    $sql_admin3 = "SELECT * FROM admin3 WHERE Username = '$username' AND Password = '$password'";
    $result_admin3 = $conn->query($sql_admin3);

    if ($result_admin->num_rows == 1) {
        // Store user ID and username in session variables
        $_SESSION['user_id'] = $result_admin->fetch_assoc()['UserID'];
        $_SESSION['username'] = $username;
    
        // Redirect to some page for users in admin
        header("Location: index.php");
        exit();
    } elseif ($result_admin2->num_rows == 1) {
        // Store user ID and username in session variables
        $_SESSION['user_id'] = $result_admin2->fetch_assoc()['UserID'];
        $_SESSION['username'] = $username;
    
        // Redirect to user_page2.php for users in admin2
        header("Location: index.php");
        exit();
    } elseif ($result_admin3->num_rows == 1) {
        // Store user ID and username in session variables
        $_SESSION['user_id'] = $result_admin3->fetch_assoc()['UserID'];
        $_SESSION['username'] = $username;
    
        // Redirect to user_page3.php for users in admin3
        header("Location: index.php");
        exit();
    } else {
        // Display an alert for incorrect credentials
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Incorrect username or password. Please try again."
                    });
                };
            </script>';
    }
    
    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
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
      <img src="img/tubuan2logo.png" alt="Logo" width="200"> <!-- Adjust path to your logo -->
    </div>
  </nav>
  <!-- End of Topbar -->
<body>
<div class="container">
    <div class="wrapper">
        <div class="title"><span>Admin Access</span></div>
        <form action="adminlogin.php" method="post" autocomplete="off">
        <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name="uname" placeholder="Username" value="<?php echo isset($_POST['uname']) ? htmlspecialchars($_POST['uname']) : ''; ?>" required>
        </div>
            <div class="row">
                <i class="fas fa-lock"></i>
                <input type="password" name="pword" placeholder="Password" required>
            </div>
            <div class="pass"><a href="login.php">Resident login</a></div>
            <div class="row button">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
