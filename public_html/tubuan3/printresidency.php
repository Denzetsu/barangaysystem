<?php
// Assuming the database connection is already included
include('includes/dbcon.php');

// Set the position you want to filter by (e.g., 'Secretary' or 'Barangay Chairman')
$position = 'Barangay Chairman';  // You can change this to any position you want

// Query to fetch the user's name based on Position
$sql = "SELECT Full_Name FROM officials3 WHERE Position = '$position'";  // Filter by Position
$result = $conn->query($sql);

// Check if the user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullName = $row['Full_Name'];
} else {
    $fullName = "No data found";  // Handle case where no user is found
}

$conn->close();
?>




<!-- print details -->
<div style="display: none;">
  <div class="print_out_certificate">
 

    <!-- content -->
   
 

    <div style="position: absolute; line-height: 0; margin: 790px 650px 0 900px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 45px;  font-family: 'Times New Roman', Times, serif;" id="pName">,</label></b>
    
  
    </div>
    
    


    <div style="position: absolute; line-height: 0; margin: 1195px 600px 0 480px; width: 1150px; font-family: 'Times New Roman', Times, serif;">
    <p><b><label style="font-size: 45px;" id="pDate"></label></b></p>
    </div>
    
    
     <div style="position: absolute; line-height: 0; margin: 1830px 650px 0 720px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
      <b style="font-size: 45px;"><?php echo $fullName; ?></b>  
    </div>



   
  </div>
</div>
<!-- print details -->

<link rel="stylesheet" href="styles.css">


