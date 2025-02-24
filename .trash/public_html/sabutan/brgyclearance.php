<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbcon.php');
include('printbrgyclearance.php');

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
        <h1 class="m-0 font-weight-bold text-primary">Generate Barangay Clearance</h1>


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

            <label class="col-form-label"><b>Full Name:</b></label>
            <div>
            <input type="text" class="form-control" name="cFName" id="cFName" value="" placeholder="Enter full name" required>
            </div>

            <label class="col-form-label"><b>Address:</b></label>
            <div>
            <input type="text" class="form-control" name="cAddress" id="cAddress" value="" placeholder="Enter address" required>
            </div>

            <label class="col-form-label"><b>Date of Birth:</b></label>
            <div>
            <input type="text" class="form-control" name="cDob" id="cDob" value="" placeholder="Enter Date of Birth" required>
            </div>

            <label class="col-form-label"><b>Sex:</b></label>
            <div>
            <select name="cSex" id="cSex" class="custom-select">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            </div>
            <label class="col-form-label"><b>Civil Status:</b></label>
                <div>
                <select name="cCivilStatus" id="cCivilStatus" class="custom-select">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Separated">Separated</option>
                    <option value="Widowed">Widowed</option>
                </select>
                </div>
                <label class="col-form-label"><b>Place of Issue:</b></label>
                <div>
                <input type="text" class="form-control" name="cPlaceOfIssue" id="cPlaceOfIssue" value="Brgy. Sabutan" placeholder="Enter place of issue" disabled>
                </div>
                <label class="col-form-label"><b>O.R No:</b></label>
                <div>
                <input type="text" class="form-control" name="cOrNo" id="cOrNo" value="" placeholder="Enter O.R No." required>
                </div>
              <div>

                <br>
                <a href="viewbrgyclearance.php" class="btn btn-danger add-btn">
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
            
            <label class="col-form-label"><b>Nationality:</b></label>
            <div>
            <input type="text" class="form-control" name="cNationality" id="cNationality" value="" placeholder="Enter nationality" required>
            </div>

            <label class="col-form-label"><b>Purpose:</b></label>
            <div>
            <input type="text" class="form-control" name="cPurpose" id="cPurpose" placeholder="Enter purpose" required>
            </div>
            <label class="col-form-label"><b>CTC No:</b></label>
            <div>
            <input type="text" class="form-control" name="cCtc" id="cCtc" value="" placeholder="Enter CTC No." required>
            </div>
            <label class="col-form-label"><b>Day:</b></label>
            <div>
            <input type="text" class="form-control" name="cDay" id="cDay" value="" placeholder="Enter Day" required>
            </div>
            <label class="col-form-label"><b>Month and Year:</b></label>
            <div>
            <input type="text" class="form-control" name="cMny" id="cMny" value="" placeholder="Enter Month and Year" required>
            </div>
           
            <label class="col-form-label"><b>Clearance Fee:</b></label>
            <div>
            <input type="text" class="form-control" name="cClearanceFee" id="cClearanceFee" value="" placeholder="Enter clearance fee" required>
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

            var gen_fName = $('#cFName').val();
            var gen_address = $('#cAddress').val();
            var gen_dob = $('#cDob').val();
            var gen_sex = $('#cSex').val();
            var gen_civil = $('#cCivilStatus').val();
            var gen_day = $('#cDay').val();
            var gen_mny = $('#cMny').val();
            var gen_nationality = $('#cNationality').val();
            var gen_purpose = $('#cPurpose').val();
            var gen_ctc = $('#cCtc').val();
            var gen_place = $('#cPlaceOfIssue').val();
            var gen_date = $('#cDateOfIssue').val();
            var gen_clearance = $('#cClearanceFee').val();
            var gen_Or = $('#cOrNo').val();
         

          //DECLARATION FOR VIEW MODAL
            document.getElementById('pName').innerHTML = gen_fName;
            document.getElementById('pAddress').innerHTML = gen_address;
            document.getElementById('pDob').innerHTML = gen_dob;
            document.getElementById('pSex').innerHTML = gen_sex;
            document.getElementById('pCivil').innerHTML = gen_civil;
            document.getElementById('pDay').innerHTML = gen_day;
            document.getElementById('pMny').innerHTML = gen_mny;
            document.getElementById('pNationality').innerHTML = gen_nationality;
            document.getElementById('pPurpose').innerHTML = gen_purpose;
            document.getElementById('pCtc').innerHTML = gen_ctc;
            document.getElementById('pPlace').innerHTML = gen_place;
            document.getElementById('pDate').innerHTML = gen_date;
            document.getElementById('pClearance').innerHTML = gen_clearance;
            document.getElementById('pOR').innerHTML = gen_Or;

          var _h = $('head').clone()
          var _p = $('.print_out_certificate').clone()
          var _el = $('<div>')
          _el.append(_h)
          _el.append("<img src='img/brgyclearance.png' height='auto' width='100%' style='position: absolute;'>");

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