


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

    <div style="position: absolute; line-height: 0; margin: 441px 600px 0 1315px; width: 1350px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 45px;" id="pPno"></label></b> 
    </div>
   
    <div style="position: absolute; line-height: 0; margin: 960px 200px 0 370px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 45px; text-decoration: underline;" id="pName"></label></b> 
    </div>
    <div style="position: absolute; line-height: 0; margin: 1022px 200px 0 370px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 45px; text-decoration: underline;" id="pLoc"></label></b> 
    </div>
    <div style="position: absolute; line-height: 0; margin: 1084px 200px 0 370px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 45px; text-decoration: underline;" id="pPurpose"></label></b> 
    </div>
    
    <div style="position: absolute; line-height: 0; margin: 2008px 650px 0 220px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 40px;" id="pOR"></label></b> 
    </div>

    <div style="position: absolute; line-height: 0; margin: 2063px 650px 0 320px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 40px;" id="pPlace"></label></b> 
    </div>

    <div style="position: absolute; line-height: 0; margin: 2120px 600px 0 300px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 40px;" id="pDate"></label></b> 
    </div>

  
    <div style="position: absolute; line-height: 0; margin: 1810px 750px 0 500px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 40px;" id="pDay"></label></b> 
    </div>
    <div style="position: absolute; line-height: 0; margin: 1810px 740px 0 750px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 40px;" id="pMny"></label></b> 
    </div>
    
    
    <div style="position: absolute; line-height: 0; margin: 2000px 650px 0 800px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
       <b style="font-size: 40px;"><?php echo $fullName; ?></b>  
    </div>



   
  </div>
</div>
<!-- print details -->

<link rel="stylesheet" href="styles.css">

    
   
    

    
      
    
      


    