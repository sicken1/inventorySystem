<?php
require 'functions/secure_session.php';
require_once 'functions/customer_crud.php';

// Retrieve user details based on the UserID
$user = getUserById($userID);

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $customers = searchCustomer($search);
} else {
  $customers = getAllCustomers();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Dashboard</title>

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
  border-radius: 10px;
}

.alert-red {
	display: inline-block;
	background-color: red;
	padding: 5px 10px;
	color: #fff;
	margin-bottom: 10px;
  border-radius: 10px;
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
    font-size: 14px; /* Change the font size as needed */
  }

  /* Adjust padding for table cells */
  td, th {
    padding: 5px; /* Change the padding as needed */
  }

  /* Adjust the pagination font size */
  .pagination {
    font-size: 12px; /* Change the font size as needed */
  }

.active-status {
    background-color: green;
    color: #fff; /* Set text color for better contrast */
    padding: 5px 10px;
    border-radius: 10px;
    display: inline-block;
  }

.inactive-status {
    background-color: red;
    color: #fff; /* Set text color for better contrast */
    padding: 5px 10px;
    border-radius: 10px;
    display: inline-block;
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
                    echo '<img src="default_avatar.png" class="img-circle user-photo" alt="Profile Picture" width="35" height="35">';
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
                    echo '<img src="default_avatar.png" class="img-circle user-photo" alt="Profile Picture" width="80" height="80">';
                }
            }      
        ?>
          <div class="user-info">
            <span class="username h5"><?php echo $_SESSION['username']; ?></span>
          </div>
        </div>
        <!-- Option for profile settings -->
        <a href="Emp_acc_settings.php?id=<?php echo $user['UserID']; ?>" class="dropdown-item option">
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
    <a href="employee_dashboard.php" class="brand-link">
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
        <a href="employee_dashboard.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt fa-lg"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
          
          <li class="nav-item">
            <a href="Emp_customerList.php" class="nav-link active">
            <i class="nav-icon fas fa-user-friends fa-lg"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Emp_saleList.php" class="nav-link">
            <i class="nav-icon fas fa-tag fa-lg"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Emp_categoriesList.php" class="nav-link">
            <i class="nav-icon fas fa-list-alt fa-lg"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Emp_productList.php" class="nav-link">
            <i class="nav-icon fas fa-box-open fa-lg"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Emp_Act_Logs.php" class="nav-link">
            <i class="nav-icon fas fa-history fa-lg"></i>
              <p>
                Activity Logs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Emp_sales_report.php" class="nav-link">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Dashboard</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="employee_dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Customers</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <hr>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="row justify-content-center">
    <div class="col-md-11">
            <div>
              <a class="btn btn-primary btn-md" href="EmpaddCustomer.php">
                  <i class="fas fa-user-plus fa-lg">
                  </i>
                  Add Customer
              </a>
            </div>
            <br>
            <?php // Check if there is a notification message in the session
              if (isset($_SESSION['notification_message'])) {
                  $notification_message = $_SESSION['notification_message'];
                  // Display the notification message
                  echo '<div class="notification">' . $notification_message . '</div>';
                  
                  // Clear the session variable to avoid displaying the same message again
                  unset($_SESSION['notification_message']);
              }?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Customer List</h3>
                <div class="card-tools">
                  <form method="GET" action="Emp_customerList.php">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID no.</th>
                      <th>Customer Name</th>
                      <th>Contact Number</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th style="width: 90px">Date Created</th>
                      <th style="width: 90px">Date Updated</th>
                      <th style="width: 90px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if (empty($customers)) : ?>
                    <tr>
                      <td colspan="8" class="text-center">--------NO RECORDS FOUND--------</td>
                    </tr>
                  <?php else : ?>
                  <?php foreach ($customers as $customer) : ?>
                    <tr>
                      <td><?php echo $customer['CustomerID']; ?></td>
                      <td><?php echo $customer['CustomerName']; ?></td>
                      <td><?php echo $customer['ContactNumber']; ?></td>
                      <td><?php echo $customer['Email']; ?></td>
                      <td><?php echo $customer['Address']; ?></td>
                      <td><?php echo $customer['DateCreated']; ?></td>
                      <td><?php echo $customer['DateUpdated']; ?></td>
                      <td>
                        <a class="btn btn-info btn-xs" href="Emp_edit_customer.php?id=<?php echo $customer['CustomerID']; ?>">
                          <i class="fas fa-pencil-alt"></i>
                          Edit
                        </a>
                        <a class="btn btn-danger btn-xs" href="delete_customer.php?id=<?php echo $customer['CustomerID']; ?>" 
                        class="delete-link" onclick="return confirm('Are you sure you want to delete this Customer?');">
                          <i class="fas fa-trash fa-xs"></i>
                          Delete
                        </a></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
        </div>
        <div class="card-footer clearfix">
            <div class="float-left showing-info"></div>
            <ul class="pagination pagination-sm m-0 float-right" id="pagination"></ul>
          </div>
        </div>
      </div>
            <!-- /.card -->
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
  // Assuming 'logs' is the array containing your data
  var customers = <?php echo json_encode($customers); ?>;
  var entriesPerPage = 10;
  var currentPage = 1;

  function updateTable(page) {
    var startIndex = (page - 1) * entriesPerPage;
    var endIndex = page * entriesPerPage - 1;
    var currentEntries = [];

    for (var i = startIndex; i <= endIndex && i < customers.length; i++) {
      currentEntries.push(customers[i]);
    }

    // Update table with current entries
    updateTableBody(currentEntries);

    // Update pagination
    updatePagination(customers.length, page);

    // Update showing info
    updateShowingInfo(startIndex + 1, Math.min(endIndex + 1, customers.length), customers.length);
  }

  function updateTableBody(entries) {
    var tableBody = $('.table tbody');
    tableBody.empty();

    if (entries.length === 0) {
      tableBody.append('<tr><td colspan="9" class="text-center">--------NO RECORDS FOUND--------</td></tr>');
    } else {
      entries.forEach(function (customer) {
        var row = '<tr><td>' + customer.CustomerID + '</td>' +
          '<td>' + customer.CustomerName + '</td>' +
          '<td>' + customer.ContactNumber + '</td>' +
          '<td>' + customer.Email + '</td>' +
          '<td>' + customer.Address + '</td>' +
          '<td>' + customer.DateCreated + '</td>' +
          '<td>' + customer.DateUpdated + '</td>' +
          '<td>' +
            '<a class="btn btn-info btn-xs" href="Emp_edit_customer.php?id=' + customer.CustomerID + '">' +
              '<i class="fas fa-pencil-alt"></i> Edit' +
            '</a>' +
            '<a class="btn btn-danger btn-xs" href="delete_customer.php?id=' + customer.CustomerID + '" class="delete-link" onclick="return confirm(\'Are you sure you want to delete this Customer and all of its Related Data?\');">' +
              '<i class="fas fa-trash fa-xs"></i> Delete' +
            '</a>' +
          '</td></tr>';
        tableBody.append(row);
      });
    }
}


function updatePagination(totalEntries, currentPage) {
  var totalPages = Math.ceil(totalEntries / entriesPerPage);
  var pagination = $('#pagination');
  pagination.empty();

  // Add "Previous" button
  pagination.append('<li class="page-item' + (currentPage === 1 ? ' disabled' : '') + '">' +
    '<a class="page-link" href="#" data-page="' + (currentPage - 1) + '">' +
    '<span aria-hidden="true">&laquo;</span></a></li>');

  for (var i = 1; i <= totalPages; i++) {
    // Skip pages with no corresponding entries
    if ((i - 1) * entriesPerPage >= totalEntries) {
      continue;
    }

    var pageLink = '<li class="page-item' + (i === currentPage ? ' active' : '') + '">' +
      '<a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
    pagination.append(pageLink);
  }

  // Add "Next" button
  pagination.append('<li class="page-item' + (currentPage === totalPages ? ' disabled' : '') + '">' +
    '<a class="page-link" href="#" data-page="' + (currentPage + 1) + '">' +
    '<span aria-hidden="true">&raquo;</span></a></li>');

  $('.pagination a').on('click', function (e) {
    e.preventDefault();
    currentPage = parseInt($(this).data('page'));
    updateTable(currentPage);
  });
}


  function updateShowingInfo(startIndex, endIndex, totalEntries) {
    var showingInfo = $('.showing-info');
    showingInfo.text('Showing ' + startIndex + ' to ' + endIndex + ' of ' + totalEntries + ' entries');
  }

  // Initialize table and pagination
  updateTable(currentPage);
});


    </script>
    <script>
  // Remove the alert message after 5 seconds
  setTimeout(function() {
    var alertMessages = document.querySelectorAll('.alert-green, .alert-red');
    alertMessages.forEach(function(alertMessage) {
      alertMessage.remove();
    });
  }, 3000); // Adjust the time as needed (in milliseconds)
</script>
</body>
</html>
