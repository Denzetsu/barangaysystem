<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbcon.php');
include('printsummon.php');

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
        <h1 class="m-0 font-weight-bold text-primary">Generate Summon Form</h1>


      </nav>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <form method="POST" class="row" id="certificateForm" autocomplete="off">

          <div class="col-md-6">

            <!-- Common container for both columns -->



            <!-- Left column -->
            <!-- Add other left column fields here -->
            <div class="form-group">

              <label class="col-form-label"><b>Respondent's Name:</b></label>
              <div>
                <input type="text" id="cRespName" name="cRespName" class="form-control" value=""
                  placeholder="Enter Respondent's name" required>
              </div>

              <label class="col-form-label"><b>Complainant's Name:</b></label>
              <div>
                <input type="text" id="cCompName" name="cCompName" class="form-control" value=""
                  placeholder="Enter Complainant's name" required>
              </div>


              <label class="col-form-label"><b>Subject:</b></label>
              <div>
                <input type="text" class="form-control" name="cSubject" id="cSubject" value=""
                  placeholder="Enter Subject" required>
              </div>
              <label class="col-form-label"><b>To:</b></label>
              <div>
                <input type="text" class="form-control" name="cTo" id="cTo" value=""
                  placeholder="Enter Subject" required>
              </div>
              <label class="col-form-label"><b>Time:</b></label>
              <div>
              <input type="text" class="form-control" name="cTime" id="cTime" value="" placeholder="Enter Time" required>
              </div>



              <div>

                <br>
                <a href="viewblotter.php" class="btn btn-danger add-btn">
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
              <label class="col-form-label"><b>Barangay Case Number:</b></label>
              <div>
                <input type="text" class="form-control" name="cNum" id="cNum" value="" placeholder="Enter Case Number"
                  required>
              </div>
              <label class="col-form-label"><b>Day:</b></label>
              <div>
              <input type="text" class="form-control" name="cDay" id="cDay" value="" placeholder="Enter Day" required>
              </div>
              <label class="col-form-label"><b>Month:</b></label>
              <div>
              <input type="text" class="form-control" name="cMny" id="cMny" value="" placeholder="Enter Month" required>
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

          var gen_compName = $('#cCompName').val();

          var gen_respName = $('#cRespName').val();
          var gen_subject = $('#cSubject').val();
          var gen_cNum = $('#cNum').val();

          var gen_date = $('#cDateOfIssue').val();
          var gen_day = $('#cDay').val();
          var gen_mny = $('#cMny').val();
          var gen_to = $('#cTo').val();
          var gen_time = $('#cTime').val();
      

          //DECLARATION FOR VIEW MODAL
          document.getElementById('pCname').innerHTML = gen_compName;
          document.getElementById('pRname').innerHTML = gen_respName;
          document.getElementById('pSub').innerHTML = gen_subject;
          document.getElementById('pCnum').innerHTML = gen_cNum;
          document.getElementById('pDay').innerHTML = gen_day;
          document.getElementById('pMny').innerHTML = gen_mny;
          document.getElementById('pDate').innerHTML = gen_date;
          document.getElementById('pTo').innerHTML = gen_to;
          document.getElementById('pTime').innerHTML = gen_time;

          var _h = $('head').clone()
          var _p = $('.print_out_certificate').clone()
          var _el = $('<div>')
          _el.append(_h)
          _el.append("<img src='img/NewSumm3.png' height='auto' width='100%' style='position: absolute;'>");

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