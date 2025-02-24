<?php
// Assuming the database connection is already included
include('includes/dbcon.php');

// Function to fetch the full name based on position
function getFullNameByPosition($conn, $position) {
    $sql = "SELECT Full_Name FROM officials2 WHERE Position = '$position'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Full_Name'];
    } else {
        return "No data found";
    }
}

// Fetching names for Barangay Chairman and Secretary
$barangayChairman = getFullNameByPosition($conn, 'Barangay Chairman');
$secretary = getFullNameByPosition($conn, 'Secretary');

$conn->close();
?>



<!-- print details -->
<div style="display: none;">
  <div class="print_out_certificate">
 

    <!-- content -->
   
 

    <div style="position: absolute; line-height: 0; margin: 530px 700px 0 100px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 40px; text-decoration: underline;" id="pCname"></label></b> 

  
    </div>
    
    
    <div style="position: absolute; line-height: 0; margin: 820px 700px 0 100px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
  
     <b><label style="font-size: 40px; text-decoration: underline;" id="pRname"></label></b>
  
    </div>
    


    <div style="position: absolute; line-height: 0; margin: 525px 100px 0 1350px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
 
    <b> <label style="font-size: 40px;  text-decoration: underline;" id="pCnum">,</label></b>
   
  
    </div>
    


   
    
    
    <div style="position: absolute; line-height: 0; margin: 570px 100px 0 1100px; width: 1050px; font-family: 'Times New Roman', Times, serif;">
    <b><label style="font-size: 40px; text-decoration: underline;"  id="pSub"></b>
    
    <label></label></p> </b>
    </div>



    <div style="position: absolute; line-height: 0; margin: 1678px 800px 0 255px; width: 1150px; font-family: 'Times New Roman', Times, serif;">
    <p><b><label style="font-size: 38px;  text-decoration: underline;" id="pDate"></label></b></p>
    </div>
     
     
       <!-- secretary -->
     <div style="position: absolute; line-height: 0; margin: 1965px 650px 0 1060px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
      
      <b style="font-size: 40px;"><?php echo $secretary; ?></b> 
      
    </div>
   
    <!-- chairman -->
    <div style="position: absolute; line-height: 0; margin: 1965px 650px 0 120px; width: 1500px; font-family: 'Times New Roman', Times, serif;">
    <b style="font-size: 40px;"><?php echo $barangayChairman; ?></b> 
    </div>



   
   
  </div>
</div>
<!-- print details -->

<link rel="stylesheet" href="styles.css">

    
   
    

    
      
    
      


    