<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbcon.php');
include('printresidency.php');

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
        <h1 class="m-0 font-weight-bold text-primary">Generate Certificate of Residency</h1>


      </nav>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <form method="POST" class="row" id="certificateForm" autocomplete="off">

    

          <!-- Right column -->
          <div class="col-md-6">
            <div class="clearance-container">
            </div>

            <div class="clearance-container">
            <label class="col-form-label"><b>Name:</b></label>
              <div>
                <input type="text" id="cName" name="cName" class="form-control" value=""
                  placeholder="Enter Name" required>
              </div>
              
              <label class="col-form-label"><b>Date of Issue:</b></label>
              <div>
                <input type="text" class="form-control" name="cDateOfIssue" id="cDateOfIssue" value="" disabled>
              </div>


              <!-- Add other right column fields here -->


              <div>

                    <br>
                    <a href="viewresidency.php" class="btn btn-danger add-btn">
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

          var gen_Name = $('#cName').val();

       

          var gen_date = $('#cDateOfIssue').val();

          //DECLARATION FOR VIEW MODAL
          document.getElementById('pName').innerHTML = gen_Name;
          

          document.getElementById('pDate').innerHTML = gen_date;

          var _h = $('head').clone()
          var _p = $('.print_out_certificate').clone()
          var _el = $('<div>')
          _el.append(_h)
          _el.append("<img src='img/NewResidency3.png' height='auto' width='100%' style='position: absolute;'>");

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