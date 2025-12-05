<?php
require 'functions/secure_session.php';
require_once 'functions/sale_crud.php';
require_once 'functions/fetch_data.php';


// Retrieve user details based on the UserID
$user = getUserById($userID);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
 
  <style>
    .alert-green { 
	display: inline-block;
	background-color: green;
	padding: 5px 10px;
	color: #fff;
	margin-bottom: 10px;
}

.alert-red {
	display: inline-block;
	background-color: red;
	padding: 5px 10px;
	color: #fff;
	margin-bottom: 10px;
}



  /* Adjust font size for the entire table */
  table {
    font-size: 12px; /* Change the font size as needed */
  }

  /* Adjust font size for table headers */
  th {
    font-size: 14px; /* Change the font size as needed */
  }

  /* Adjust font size for table cells */
  td {
    font-size: 12px; /* Change the font size as needed */
  }

  /* Adjust padding for table cells */
  td, th {
    padding: 5px; /* Change the padding as needed */
  }

  /* Adjust the pagination font size */
  .pagination {
    font-size: 12px; /* Change the font size as needed */
  }
  .table-bordered-no-internal-borders tbody td,
  .table-bordered-no-internal-borders tbody th,
  .table-bordered-no-internal-borders thead th{
    border-width: 0;
  }

  .user-dropdown-header {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background-color: #007bff; /* Bootstrap primary color for the header */
  padding: 10px;
}

.username {
  margin-top: 10px; /* Increased space between the photo and username */
  color: white; /* White text color for the username */
}

.option:hover,
.navbar-nav:hover {
  background-color: #ccc; /* Gray background on hover for options, user photo, and username */
  border-radius: 10px;
}

.navbar-nav {
  margin-right: 15px;
}
.dropdown-menu{
  border-radius: 10px;
}

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" role="navigation">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- User Dropdown Menu -->
    <li class="nav-item dropdown">
      <a id="userDropdownButton" class="dropdown-toggle padding-user" data-toggle="dropdown" href="#" aria-label="User Settings">
      <?php

            $avatar = $user['ProfilePicture'];
            if ($avatar) {
                $path = 'profile_img/'.$avatar;
                if(file_exists($path))
                {
                    echo '<img src="'.BASE_URL.'/profile_img/'.$avatar . '" class="img-circle user-photo" alt="Profile Picture" width="35" height="35">';
                }
                else{
                    echo '<img src="profile_img/default_avatar.png" class="img-circle user-photo" alt="Profile Picture" width="35" height="35">';
                }
            }     
        ?>
        <span class="d-none d-md-inline" style="color: black;"><?php echo $_SESSION['username']; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right user-dropdown" aria-labelledby="userDropdownButton">
        <div class="user-dropdown-header">
        <?php
            $avatar = $user['ProfilePicture'];
            if ($avatar) {
                $path = 'profile_img/'.$avatar;
                if(file_exists($path))
                {
                    echo '<img src="'.BASE_URL.'/profile_img/'.$avatar . '" class="img-circle user-photo" alt="Profile Picture" width="80" height="80">';
                }
                else{
                    echo '<img src="profile_img/default_avatar.png" class="img-circle user-photo" alt="Profile Picture" width="80" height="80">';
                }
            }      
        ?>
          <div class="user-info">
            <span class="username h5"><?php echo $_SESSION['username']; ?></span>
          </div>
        </div>
        <!-- Option for profile settings -->
        <a class="dropdown-item option" href="account_settings.php?id=<?php echo $user['UserID']; ?>">
          <i class="fas fa-cog mr-2"></i> Account Settings
        </a>
        <div class="dropdown-divider"></div>
        <!-- Logout option -->
        <a href="logout.php" class="dropdown-item option">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin_dashboard.php" class="brand-link">
      <img src="dist/img/marklogo.jpg" alt="Business Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MarkScent</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="admin_dashboard.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt fa-lg"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
          <li class="nav-item">
            <a href="userList.php" class="nav-link">
            <i class="nav-icon fas fa-users fa-lg"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="customerList.php" class="nav-link">
            <i class="nav-icon fas fa-user-friends fa-lg"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="saleList.php" class="nav-link">
            <i class="nav-icon fas fa-tag fa-lg"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="categoriesList.php" class="nav-link">
            <i class="nav-icon fas fa-list-alt fa-lg"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="productList.php" class="nav-link">
            <i class="nav-icon fas fa-box-open fa-lg"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="act_Admin_logs.php" class="nav-link">
            <i class="nav-icon fas fa-history fa-lg"></i>
              <p>
                Activity Logs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sales_report.php" class="nav-link active">
            <i class="nav-icon fas fa-table fa-lg"></i>
              <p>
                Sales Report
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  

   <!-- Main content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Sales Report</li>
            </ol>
          </div>
        <!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
    <div class="container-fluid">
        <!-- Date Range Picker Row -->
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <!-- Date filters -->
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">

                                </div>
                                <div class="panel-body">
                                    <form class="clearfix" method="post" action="">
                                        <div class="form-group">
                                            <label class="form-label">Date Range</label>
                                            <div class="input-group">
                                                <input type="text" class="datepicker form-control" id="datepicker" name="start-date" placeholder="From">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                                                <input type="text" class="datepicker form-control" name="end-date" placeholder="To">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <button type="button" id="generate-report" class="btn btn-primary">Generate Report</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Date Range Picker Row -->

        <!-- Table Row -->
        <div class="col-md-9">
        <div class="card">
        <div class="card-body">
            <div id="table-container">
            <h5 class="report-title text-center mb-2 text-primary" style="font-weight: bold;"></h5>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Sale by</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows will be populated dynamically using JavaScript or PHP -->
                    </tbody>
                </table>
                <div class="row justify-content-end">
                    <!-- "Print Report" button now on the right -->
                    <div class="col-md-4 text-right">
                    <div class="grand-total"></div>
                        <button class="btn btn-primary" id="print-report"
                        aria-label="Print Report Button">Print Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Table Row -->
</div>
</div>
</div>
</div>
<!-- /.container-fluid -->
</section>


</div>
   <!-- /.content-wrapper -->
   
   <footer class="main-footer">
    <strong>Third Year &copy; 2023-2024 - Project</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Advance Database</b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- jQuery and Moment.js -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script>
   $(document).ready(function () {
  // Date range picker initialization for "From" field
$('input[name="start-date"]').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true,
  opens: 'left',
  autoUpdateInput: false,
  locale: {
    format: 'YYYY-MM-DD'
  },
  startDate: moment(),
  minDate: '2020-01-01',
  maxDate: moment()
});

// Handle date range picker change for "From" field
$('input[name="start-date"]').on('apply.daterangepicker', function (ev, picker) {
  // Update the input field value
  $(this).val(picker.startDate.format('YYYY-MM-DD'));

  // Trigger a change event on the input field to make sure other scripts are notified
  $(this).trigger('change');
});

// Date range picker initialization for "To" field
$('input[name="end-date"]').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true,
  opens: 'left',
  autoUpdateInput: false,
  locale: {
    format: 'YYYY-MM-DD'
  },
  startDate: moment(),
  minDate: '2020-01-01',
  maxDate: moment()
});

// Handle date range picker change for "To" field
$('input[name="end-date"]').on('apply.daterangepicker', function (ev, picker) {
  // Update the input field value
  $(this).val(picker.startDate.format('YYYY-MM-DD'));

  // Trigger a change event on the input field to make sure other scripts are notified
  $(this).trigger('change');
});


// Function to display a message when no records are found
function showNoRecordsMessage() {
    var tableBody = $('#table-container').find('tbody');
    tableBody.empty(); // Clear existing rows

    var noRecordsMessage = '<tr>';
    noRecordsMessage += '<td colspan="7" class="text-center">--------NO RECORDS FOUND--------</td>';
    noRecordsMessage += '</tr>';

    tableBody.append(noRecordsMessage);

    // Set the grand total to 0
    $('.grand-total').html('<strong>Grand Total: ₱0.00</strong>');
}


// Function to hide the "No Records" message
function hideNoRecordsMessage() {
    var tableBody = $('#table-container').find('tbody');
    var noRecordsRow = tableBody.find('td[colspan="5"].text-center');

    if (noRecordsRow.length > 0) {
        noRecordsRow.parent().remove();
    }
}

// Function to update the table content
function updateTable(data) {
    // Hide the "No Records" message if it was previously displayed
    hideNoRecordsMessage();

    var tableBody = $('#table-container').find('tbody');
    tableBody.empty(); // Clear existing rows

    // Iterate through the fetched data and append rows to the table
    data.forEach(function (row) {
        var tableRow = '<tr>';
        tableRow += '<td>' + row.DateCreated + '</td>';
        tableRow += '<td>' + row.ProductName + '</td>';
        tableRow += '<td>' + row.CustomerName + '</td>';
        tableRow += '<td>' + row.UserName + '</td>';
        tableRow += '<td>' + row.UnitPrice + '</td>';
        tableRow += '<td>' + row.QuantitySold + '</td>';
        tableRow += '<td>' + row.TotalAmount + '</td>';
        tableRow += '</tr>';
        tableBody.append(tableRow);
    });
    var grandTotal = 0;
        data.forEach(function (row) {
            grandTotal += parseFloat(row.TotalAmount);
        });

        $('.grand-total').html('<strong>Grand Total: ₱' + grandTotal.toFixed(2) + '</strong>');
}
// Handle button click to generate report
$('#generate-report').on('click', function (e) {
  e.preventDefault();

// Fetch the selected date range
var startDate = $('input[name="start-date"]').val();
var endDate = $('input[name="end-date"]').val();

// Make an AJAX request to the server to fetch data based on the selected date range
$.ajax({
    url: 'functions/fetch_data.php', // Replace with your server-side endpoint
    type: 'POST',
    data: { start_date: startDate, end_date: endDate },
    dataType: 'json',
    success: function (data) {
        // Check if there are any records
        if (data.length > 0) {
            // Update the table content with the fetched data
            updateTable(data);
             // Update the report title
        $('.report-title').html('Sale Report From ' + startDate + ' To ' + endDate);

// Display the grand total
$('.grand-total').html('<strong>Grand Total: ₱' + grandTotal.toFixed(2) + '</strong>');
        } else {
            // Display a message when no records are found
            $('.report-title').html('Sale Report From ' + startDate + ' To ' + endDate);
            showNoRecordsMessage();
        }
    },
    error: function (error) {
        console.error('Error fetching data:', error);
    }
    });
  });

    // Handle button click to print report
$('#print-report').on('click', function () {
    // Call the print function
    printReport();
});

// Function to print the report
function printReport() {
    // Create a new window for printing
    var printWindow = window.open('', '_blank');

    // Update the content of the new window with the report content
    printWindow.document.write('<html><head><title>Sales Report</title></head><body style="text-align:center;">');
    printWindow.document.write('<h2>' + $('.report-title').html() + '</h2>');

    // Start of the table
    printWindow.document.write('<table border="1" style="margin: 0 auto; border-collapse: collapse; width: 80%;">');

    // Table headers
    printWindow.document.write('<thead><tr>');
    printWindow.document.write('<th>Date</th>');
    printWindow.document.write('<th>Product Name</th>');
    printWindow.document.write('<th>Customer Name</th>');
    printWindow.document.write('<th>Sale by</th>');
    printWindow.document.write('<th>Unit Price</th>');
    printWindow.document.write('<th>Quantity</th>');
    printWindow.document.write('<th>Total</th>');
    printWindow.document.write('</tr></thead>');

    // Table body
    printWindow.document.write('<tbody>');
    $('#table-container').find('tbody tr').each(function () {
        printWindow.document.write('<tr>');
        $(this).find('td').each(function () {
            // Center-align the content in the cells
            printWindow.document.write('<td style="text-align:center;">' + $(this).html() + '</td>');
        });
        printWindow.document.write('</tr>');
    });
    printWindow.document.write('</tbody>');

    // End of the table
    printWindow.document.write('</table>');
    
    // Grand Total
    printWindow.document.write('<p style="margin-top: 10px; text-align:right;margin-right: 133px">' + $('.grand-total').html() + '</p>');
    
    printWindow.document.write('</body></html>');

    // Close the document
    printWindow.document.close();

    // Trigger the print dialog
    printWindow.print();
}


});


  </script>


</body>
</html>