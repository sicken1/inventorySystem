<?php
require 'functions/secure_session.php';
require_once 'functions/audit_logs.php';
require_once 'functions/sale_crud.php';
require_once 'functions/product_crud.php';
require_once 'functions/customer_crud.php';
require_once 'functions/user_crud.php';




// Retrieve user details based on the UserID
$user = getUserById($userID);
$products = getAllProduct();
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
        <li class="nav-item menu-open">
            <a href="admin_dashboard.php" class="nav-link active">
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
            <a href="sales_report.php" class="nav-link">
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
          <strong><h1 class="m-0" style="font-weight: bold;">Admin Dashboard</h1></strong>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
   <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-3 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php
            $grandTotal = getGrandTotalSale();
            echo "<h3>₱{$grandTotal}</h3>";
            ?>
                <p>Total Sale</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="saleList.php" class="small-box-footer">View Sale <i class="fas fa-eye"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
            $productCount = count(getAllProduct());
            echo "<h3>{$productCount}</h3>";
            ?>
                <p>Products</p>
              </div>
              <div class="icon">
              <i class="fas fa-box"></i>
              </div>
              <a href="productList.php" class="small-box-footer">View Products<i class="fas fa-eye"></i></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php
            $UCount = count(getAllUsers());
            echo "<h3 style='color: #fff;'>{$UCount}</h3>";
            ?>
                <p style='color: #fff;'>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="userList.php" class="small-box-footer">View Users<i class="fas fa-eye"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php
            $customerCount = count(getAllCustomers());
            echo "<h3>{$customerCount}</h3>";
            ?>
                <p>Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="customerList.php" class="small-box-footer">View Customers <i class="fas fa-eye"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <hr>
        </div>
        <div class="container-fluid">
  <div class="row">
    <div class="col-md-9">
      <!-- Small boxes, charts, and other content -->
      <div style=" border: 1px solid #ccc; margin-bottom: 10px;">
        <canvas id="stockChart" style="width: 100%; height: 500px;"></canvas>
      </div>
    </div>
    <div class="col-md-3">
      <?php
      $outOfStockProducts = array_filter($products, function ($product) {
        return $product['StockQuantity'] == 0;
      });

      if (!empty($outOfStockProducts)) {
        echo '<div class="card">';
        echo '<div class="card-header bg-danger">';
        echo '<h3 class="card-title">Out-of-Stock Product/s</h3>';
        echo '</div>';
        echo '<div class="card-body p-0">';
        echo '<table class="table table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Product Name</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($outOfStockProducts as $product) {
            echo "<tr><td style='font-size: 15px;'>{$product['ProductName']}</td></tr>";
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="alert alert-success" role="alert">';
        echo '<h4 class="alert-heading">No out-of-stock products!</h4>';
        echo '<p class="mb-0">All products are currently in stock. Great job!</p>';
        echo '</div>';
    }
      ?>
    </div>
  </div>
</div>

        </div>
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
  var products = <?php echo json_encode($products); ?>;

  // Extract product names and stock levels
  var labels = products.map(product => product.ProductName);
  var stockLevels = products.map(product => product.StockQuantity);

  // Get the canvas element
  var ctx = document.getElementById('stockChart').getContext('2d');

  var stockChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [{
      label: 'Stock Level',
      data: stockLevels,
      backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Default color for all bars
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      x: {
        beginAtZero: true,
        ticks: {
          autoSkip: false,
          maxRotation: 45,
          minRotation: 45,
          fontSize: 10
        }
      },
      y: {
        beginAtZero: true
      }
    },
    plugins: {
      legend: {
        display: false
      }
    }
  }
});

</script>



</body>
</html>