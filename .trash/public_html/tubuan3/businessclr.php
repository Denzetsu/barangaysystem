<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbcon.php');
include('printbrgybusinessclr.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta tags and title go here -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <h1 class="m-0 font-weight-bold text-primary">Generate Barangay Business Clearance</h1>


      </nav>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <form method="POST" class="row" id="certificateForm" autocomplete="on">

          <div class="col-md-6">

            <!-- Common container for both columns -->



            <!-- Left column -->
            <!-- Add other left column fields here -->
            <div class="form-group">

            <label class="col-form-label"><b>Name of Business/Activity:</b></label>
            <div>
            <input type="text" class="form-control" name="cBname" id="cBname" value="" placeholder="Enter Business/Activity name" required>
            </div>

            <label class="col-form-label"><b>Location:</b></label>
            <div>
            <input type="text" class="form-control" name="cLoc" id="cLoc" value="" placeholder="Enter Location" required>
            </div>

            <label class="col-form-label"><b>Name of Owner/Operator:</b></label>
            <div>
            <input type="text" class="form-control" name="cOwner" id="cOwner" value="" placeholder="Enter Owner/Operator" required>
            </div>

        
                <label class="col-form-label"><b>Place of Issue:</b></label>
                <div>
                <input type="text" class="form-control" name="cPlaceOfIssue" id="cPlaceOfIssue" value="Brgy. Tubuan III" placeholder="Enter place of issue" disabled>
                </div>
                <label class="col-form-label"><b>O.R No:</b></label>
                <div>
                <input type="text" class="form-control" name="cOrNo" id="cOrNo" value="" placeholder="Enter O.R No." required>
                </div>
             
              <div>

                <br>
                <a href="viewbusinessclr.php" class="btn btn-danger add-btn">
                  <span class="btn-wrap">
                    <i class="fas fa-arrow-left"></i> Back
                  </span>
                </a>
                <button type="submit" class="btn btn-primary add-btn" onclick="generateCertificate()">
                  <span class="btn-wrap">
                    <i class="fas fa-plus"></i> Generate
                  </span>
                </button>


              </div>
            </div>

          </div>



          <!-- Right column -->
          <div class="col-md-6">
            <div class="clearance-container">
            </div>

            <div class="clearance-container">
            
            <label class="col-form-label"><b>Address:</b></label>
            <div>
            <input type="text" class="form-control" name="cAdd" id="cAdd" value="" placeholder="Enter Address" required>
            </div>

            
            <label class="col-form-label"><b>Day:</b></label>
            <div>
            <input type="text" class="form-control" name="cDay" id="cDay" value="" placeholder="Enter Day" required>
            </div>
            <label class="col-form-label"><b>Month and Year:</b></label>
            <div>
            <input type="text" class="form-control" name="cMny" id="cMny" value="" placeholder="Enter Month and Year" required>
            </div>
            <label class="col-form-label"><b>Permit No:</b></label>
            <div>
            <input type="text" class="form-control" name="cPermit" id="cPermit" value="" placeholder="Enter Permit No." required>
            </div>
            <label class="col-form-label"><b>Date of Issue:</b></label>
            <div>
            <input type="text" class="form-control" name="cDateOfIssue" id="cDateOfIssue" value="" disabled>
            </div>

             
              <!-- Add other right column fields here -->
            </div>

          </div>

        </form>



      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <script>
      $(document).ready(function () {
        $('#sortTbl').DataTable();
      });

      $(document).ready(function () {
        const date = new Date();

        const options = {
          year: 'numeric',
          month: 'long',
          day: 'numeric',
        };

        $("#cDateOfIssue").val(date.toLocaleString('en-IN', options));
      })

      //generate certificate
      function generateCertificate() {

        $("form").on("submit", function (event) {
          event.preventDefault();

          //getting textbox values

            var gen_bname = $('#cBname').val();
            var gen_loc = $('#cLoc').val();
            var gen_own = $('#cOwner').val();
       
            var gen_day = $('#cDay').val();
            var gen_mny = $('#cMny').val();
            var gen_add = $('#cAdd').val();
          
            var gen_permit = $('#cPermit').val();
            var gen_place = $('#cPlaceOfIssue').val();
            var gen_date = $('#cDateOfIssue').val();
           
            var gen_Or = $('#cOrNo').val();
         

          //DECLARATION FOR VIEW MODAL
            document.getElementById('pBname').innerHTML = gen_bname;
            document.getElementById('pLoc').innerHTML = gen_loc;
            document.getElementById('pOwn').innerHTML = gen_own;
        
            document.getElementById('pDay').innerHTML = gen_day;
            document.getElementById('pMny').innerHTML = gen_mny;
            document.getElementById('pAdd').innerHTML = gen_add;
       
            document.getElementById('pPermit').innerHTML = gen_permit;
            document.getElementById('pPlace').innerHTML = gen_place;
            document.getElementById('pDate').innerHTML = gen_date;
            document.getElementById('pOR').innerHTML = gen_Or;

          var _h = $('head').clone()
          var _p = $('.print_out_certificate').clone()
          var _el = $('<div>')
          _el.append(_h)
          _el.append("<img src='img/businessclearance.png' height='auto' width='100%' style='position: absolute;'>");

          _el.append(_p)
          var nw = window.open("", "_blank", "width=5000, top=0, left=0")
          nw.document.write(_el.html())
          nw.document.close()
          setTimeout(() => {
            nw.print()
            setTimeout(() => {
              nw.close();
            }, 200);
          }, 500);
        })
      }
    </script>

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>


</body>

</html>