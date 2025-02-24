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
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name']; 
    $last_name = $_POST['last_name']; 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_id = $_SESSION['user_id'];
  
    


    // Perform a query to check user credentials in tubuan3
    $sql_tubuan3 = "SELECT * FROM tubuan3 WHERE email = '$email' AND password = '$password'";
    $result_tubuan3 = $conn->query($sql_tubuan3);

    if ($result_tubuan3->num_rows == 1) {
        // Store user ID in a session variable
        $_SESSION['user_id'] = $result_tubuan3->fetch_assoc()['id'];
        $_SESSION['email'] = $email;

        // Redirect to some page for users in tubuan1
        header("Location: residentspage1.php");
        exit();
    } elseif ($result_tubuan1->num_rows == 1) {
        // Store user ID in a session variable
        $_SESSION['user_id'] = $result_tubuan1->fetch_assoc()['id'];
        $_SESSION['email'] = $email;
        // Redirect to user_page2.php for users in tubuan1
        header("Location: residentspage1.php");
        exit();
    } elseif ($result_tubuan3->num_rows == 1) {
        // Store user ID in a session variable
        $_SESSION['user_id'] = $result_tubuan3->fetch_assoc()['id'];
        $_SESSION['email'] = $email;
        // Redirect to user_page3.php for users in tubuan3
        header("Location: residentspage1.php");
        exit();
    } else {
        // Check if the email exists but password is incorrect
        $sql_check_email = "SELECT * FROM (SELECT * FROM tubuan3 UNION SELECT * FROM tubuan3 UNION SELECT * FROM tubuan3) AS all_users WHERE email = '$email'";
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
    
    
    
    // Query to validate user credentials and fetch additional details
    $stmt = $conn->prepare("SELECT id, first_name, middle_name, last_name, email, password FROM tubuan3 WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $first_name, $middle_name, $last_name, $stored_email, $stored_password);
    $stmt->fetch();
    
    
    
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
    
    .back-to-hub-container {
            text-align: center; /* Center the button */
            margin-top: 5px; /* Add margin at the top */
        }

        .back-to-hub {
            background-color: #16a085; /* Change button color */
            color: white;
            padding: 20px 30px; /* Increase padding */
            margin-bottom: 40px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Add transition for smooth animation */
        }

        .back-to-hub:hover {
            background-color: #16a085; /* Darker color on hover */
            transform: scale(1.05); /* Scale button on hover for a smooth effect */
        }
  </style>
</head>
<body>
  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="logo-container">
      <img src="img/tubuan3logo.png" alt="Logo" width="200"> <!-- Adjust path to your logo -->
    </div>
  </nav>
  <!-- End of Topbar -->
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
        <!-- Add the "Back to the hub" button container and button -->
    <div class="back-to-hub-container">
        <button onclick="redirectToHub()" class="back-to-hub">Back to the hub</button>
    </div>
     </div>
    </div>

    <script>
        // JavaScript function to redirect back to the hub (index.php)
        function redirectToHub() {
            window.location.href = '../index.php';
        }
    </script>
      </div>
    </div>
  </body>
</html>

<?php 
include('includes/scripts.php');

?>
