<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="css/reg.css">
  <link rel="stylesheet" href="css/other.css">
</head>

<body>
  <?php
  // Start the session
  session_start();

  // Check if the form has been submitted
  if (isset($_POST['submit'])) {

    if ($_POST['verification_code'] == $_SESSION['verification_code']) {
      $fname = $_POST['Fname'];
      $mname = $_POST['Mname'];
      $lname = $_POST['Lname'];
      $sname = $_POST['Sname'];
      $gender = $_POST['Gender'];
      $dateofbirth = $_POST['dateofbirth'];
      $Bplace = $_POST['Bplace'];
      $Work = $_POST['Work'];
      $Vstatus = $_POST['Vstatus'];
      $Town = $_POST['Town'];
      $Email = $_POST['Email'];
      $Pword = $_POST['Pword'];
      $Fhead = $_POST['Fhead'];

      // Establish a database connection (update with your database credentials)
      $conn = new mysqli("localhost", "u664069117_dauntless", "DauntlessBM2024", "u664069117_barangaysystem");

      // Check the connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Check if the email already exists in any of the tables
      $emailExists = false;

      $tables = ['tubuan1'];

      foreach ($tables as $table) {
        $sql = "SELECT COUNT(*) as count FROM $table WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
          $emailExists = true;
          break; // Exit the loop if email exists in any table
        }
      }

      if ($emailExists) {
        // Show error SweetAlert if email already exists
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Email already exists. Please use a different email."
        });
        </script>';
        $conn->close();
        exit; // Stop further execution
      } else {
        // Proceed with the insertion
        // Determine the appropriate table based on the "Town" value
        $table = 'tubuan1';


        // Prepare and execute an SQL query to insert data into the determined table
        $sql = "INSERT INTO $table (first_name, middle_name, last_name, suffix_name, gender, date_of_birth, birth_place, occupation, voter_status, barangay, email, password, family_head) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
          // Bind parameters
          $stmt->bind_param("sssssssssssss", $fname, $mname, $lname, $sname, $gender, $dateofbirth, $Bplace, $Work, $Vstatus, $Town, $Email, $Pword, $Fhead);

          // Execute the query
          if ($stmt->execute()) {
            // Registration successful
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Data inserted successfully into the appropriate table."
                }).then(function() {
                    window.location.href = "regform.php"; // Redirect after success
                });
                </script>';
          } else {
            // Registration failed
            echo "Error: " . $stmt->error;
          }

          // Close the statement
          $stmt->close();
        } else {
          // Query preparation failed
          echo "Error: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
      }

    } else {
      // Verification code does not match, show error message
      echo '<script>        
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Incorrect Code. Please Try Again."
    });;</script>';
      // Optionally, you can redirect the user back to the form or take other actions
    }

  }
  ?>
  <section class="container">
    <header>Fill Out Registration Form</header>
    <form action="regform.php" class="form" method="post" autocomplete="off">
      <div class="input-box">
        <label>First Name</label>
        <input type="text" name="Fname" placeholder="Enter first name" required
          value="<?php echo isset($fname) ? $fname : ''; ?>" />
      </div>
      <div class="column">
        <div class="input-box">
          <label>Middle Name</label>
          <input type="text" name="Mname" placeholder="Enter middle name" required
            value="<?php echo isset($mname) ? $mname : ''; ?>" />
        </div>
        <div class="input-box">
          <label>Last Name</label>
          <input type="text" name="Lname" placeholder="Enter Last name" required
            value="<?php echo isset($lname) ? $lname : ''; ?>" />
        </div>
      </div>
      <div class="column">
        <div class="input-box">
          <label>Suffix Name</label>
          <input type="text" name="Sname" placeholder="Enter Suffix name"
            value="<?php echo isset($sname) ? $sname : ''; ?>" />
        </div>
        <div class="input-box">
          <label>Gender</label>
          <select class="select-box" name="Gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
          </select>
        </div>
      </div>
      <div class="column">
        <div class="input-box">
          <label>Birth Date</label>
          <input type="date" name="dateofbirth" placeholder="Enter birth date" required />
        </div>
        <div class="input-box">
          <label>Birth Place</label>
          <input type="text" name="Bplace" placeholder="Enter Birth Place" required
            value="<?php echo isset($Bplace) ? $Bplace : ''; ?>" />
        </div>
      </div>
      <div class="column">
        <div class="input-box">
          <label>Occupation</label>
          <input type="text" name="Work" placeholder="Type N/A if unemployed" required
            value="<?php echo isset($Work) ? $Work : ''; ?>" />
        </div>
        <div class="input-box">
          <label>Voter Status</label>
          <select class="select-box" name="Vstatus" required>
            <option value="" selected disabled>Select Voter Status</option>
            <option value="Yes" <?php echo (isset($_POST['Vstatus']) && $_POST['Vstatus'] == 'Yes') ? 'selected' : ''; ?>>
              Yes</option>
            <option value="No" <?php echo (isset($_POST['Vstatus']) && $_POST['Vstatus'] == 'No') ? 'selected' : ''; ?>>No
            </option>

          </select>
        </div>
      </div>



      <div class="column">

        <div class="input-box">
          <label>Email</label>
          <input type="text" name="Email" id="inputEmail" required value="<?php echo isset($Email) ? $Email : ''; ?>" />
        </div>

        <div class="input-box">
          <label>Barangay</label>
          <select class="select-box" name="Town" required>
            <option value="" selected disabled>Select Barangay</option>
            <option value="Tubuan III" <?php echo (isset($_POST['Town']) && $_POST['Town'] == 'Tubuan III') ? 'selected' : ''; ?>>Tubuan III</option>
            </select>
        </div>

      </div>

      <div class="column">
        <div class="input-box">
          <button type="button" id="sendCodeBtn">Send Code</button>
        </div>


        <div class="input-box">
          <label>Verify Code</label>
          <input type="text" name="verification_code" placeholder="Input Code" required>
        </div>
      </div>




      <div class="column">
        <div class="input-box">
          <label>Password</label>
          <input type="Password" name="Pword" required value="<?php echo isset($Pword) ? $Pword : ''; ?>" />
        </div>
        <div class="input-box">
          <label>Family Head</label>
          <select class="select-box" name="Fhead" required>
            <option value="" selected disabled>Yes or No?</option>
            <option value="Yes" <?php echo (isset($_POST['Fhead']) && $_POST['Fhead'] == 'Yes') ? 'selected' : ''; ?>>Yes
            </option>
            <option value="No" <?php echo (isset($_POST['Fhead']) && $_POST['Fhead'] == 'No') ? 'selected' : ''; ?>>No
            </option>
          </select>
        </div>
      </div>
      <button type="submit" id="submitBtn" name="submit" disabled>Submit</button>

      <div class="signup-link">Already Registered? <a href="login.php" class="signup">Return to Log in</a></div>
    </form>
  </section>
</body>

</html>

<?php
include('includes/scripts.php');
?>

<script>
  document.getElementById("sendCodeBtn").addEventListener("click", function () {
    var email = document.getElementById("inputEmail").value;
    if (email.trim() === "") {
      Swal.fire({
            icon: "warning",
            title: "Email Address is empty.",
            text: "Please Enter your Email Address."
        });
      return;
    }

    // Make an AJAX request to send the email
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "send_code.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText); // Log the response from the server
        // Enable the Submit button after sending the code
        document.getElementById("submitBtn").disabled = false;

        Swal.fire({
            icon: "info",
            title: "Verification Email.",
            text: "Verification Code has been sent to your Email."
        });
      }
    };
    xhr.send("email=" + email);
  });
</script>