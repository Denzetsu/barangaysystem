<?php


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Access the username from the session
$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" type="text/css" href="css/other.css">
</head>

<body>

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-text mx-3">Welcome
                <?php echo strstr($email, '@', true); ?>!
            </div>


        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="residentspage1.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-book-open"></i>
                <span>Request Documents</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Documents</h6>
                    <a class="collapse-item" href="reqindigency.php">Certificate of Indigency</a>
                    <a class="collapse-item" href="reqresidency.php">Certificate of Residency</a>
                    <a class="collapse-item" href="reqbusinessclr.php">Business Clearance</a>
                    <a class="collapse-item" href="reqbldgclr.php">Building Clearance</a>
                    <a class="collapse-item" href="reqbrgyclearance.php">Barangay Clearance</a>
                    <a class="collapse-item" href="reqsenior.php">Application of Senior ID</a>
                
             
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userprofile.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Update Profile</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="repblotter.php">
                <i class="fas fa-flag"></i>
                <span>Report Blotter</span></a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="calendarsab.php">
                <i class="fas fa-calendar"></i>
                <span>Calendar</span></a>
        </li>




        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->


    </ul>
    <!-- End of Sidebar -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Calendar -->
    <script>
        // Get current date
        var currentDate = new Date();

        // Month array
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        // Function to generate calendar
        function generateCalendar(year, month) {
            // Get the element where calendar will be appended
            var calendarElement = document.getElementById("calendar");

            // Clear any previous content
            calendarElement.innerHTML = '';

            // Create header
            var header = document.createElement("h2");
            header.textContent = monthNames[month] + " " + year;
            calendarElement.appendChild(header);

            // Create table
            var table = document.createElement("table");
            table.classList.add("navcalendar-table");

            // Create table header (days of the week)
            var headerRow = document.createElement("tr");
            for (var i = 0; i < 7; i++) {
                var th = document.createElement("th");
                th.textContent = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"][i];
                headerRow.appendChild(th);
            }
            table.appendChild(headerRow);

            // Calculate the first day of the month
            var firstDayOfMonth = new Date(year, month, 1).getDay();

            // Calculate the number of days in the month
            var daysInMonth = new Date(year, month + 1, 0).getDate();

            // Calculate total number of cells needed in the table
            var totalCells = Math.ceil((firstDayOfMonth + daysInMonth) / 7) * 7;

            // Generate cells for the calendar
            var day = 1;
            for (var i = 0; i < totalCells; i++) {
                if (i % 7 === 0) {
                    var row = document.createElement("tr");
                    table.appendChild(row);
                }
                var cell = document.createElement("td");
                if (i >= firstDayOfMonth && day <= daysInMonth) {
                    cell.textContent = day;
                    if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
                        cell.classList.add("highlighted-date"); // Add class for current date
                    }
                    day++;
                }
                row.appendChild(cell);
            }

            calendarElement.appendChild(table);
        }

        // Generate calendar for the current month
        generateCalendar(currentDate.getFullYear(), currentDate.getMonth());

        function toggleSidebar() {
            const sidebar = document.getElementById('accordionSidebar');
            sidebar.classList.toggle('sidebar-collapsed');

            const calendar = document.getElementById('calendar');
            if (sidebar.classList.contains('sidebar-collapsed')) {
                // If sidebar is collapsed, hide the calendar
                calendar.style.display = 'none';
            } else {
                // If sidebar is expanded, show the calendar
                calendar.style.display = 'block';
            }
        }

        // Event listener for the sidebar toggle button
        document.getElementById('sidebarToggle').addEventListener('click', toggleSidebar);
    </script>

</body>

</html>