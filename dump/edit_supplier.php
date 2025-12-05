<?php
require_once 'functions/supplier_crud.php';
require 'functions/secure_session.php';

if (isset($_GET['id'])) {
    $supplierID = $_GET['id'];
    // Retrieve the supplier record by ID
    $supplier = getSupplierbySupplierID($supplierID);
} else {
    // Redirect to the supplierList.php page if none is provided
    header('Location: supplierList.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $has_error = FALSE;
    

    if(empty($_POST['suppliername']))
    {
        $has_error = TRUE;
        $suppliername_error_msg = 'This field is required.';
    }
    else
    {
        $suppliername = trim(htmlspecialchars($_POST['suppliername']));
    }

    if (empty($_POST['contactnumber'])) {
        $has_error = TRUE;
        $contactnumber_error_msg = 'This field is required.';
    } else {
        $contactnumber = trim(htmlspecialchars($_POST['contactnumber']));
    
        // Check if the contact number is exactly 11 digits
        if (!preg_match('/^\d{11}$/', $contactnumber)) {
            $has_error = TRUE;
            $contactnumber_error_msg = 'Contact number must be 11 digits.';
        }
    }
    

    if(empty($_POST['email']))
    {
        $has_error = TRUE;
        $email_error_msg = "The email field is reqiured";
    }
    else{
        $email = trim(htmlspecialchars($_POST['email']));
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $has_error = TRUE;
            $email_error_msg = 'Please provide a valid email address.';
        }

    }

    if(empty($_POST['address']))
    {
        $has_error = TRUE;
        $address_error_msg = 'The userType is required.';
    }
    else 
    {
        $address = trim(htmlspecialchars($_POST['address']));
    }


    if (!$has_error)
    {
        $suppliername = (string) trim($_POST['suppliername']);
        $contactnumber = (string) trim($_POST['contactnumber']);
        $email = (string) trim($_POST['email']);
        $address = (string) trim($_POST['address']);

        // Edit supplier record
        $updateSupplier = updateSupplier($supplierID, $suppliername, $contactnumber, $email, $address);

        header('Location: supplierList.php');
        exit();
    }
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

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
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin_dashboard.php" class="brand-link">
      <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
          <li class="nav-item">
            <a href="userList.php" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="customerList.php" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Customers
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="customerList.php" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="categoriesList.php" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="productList.php" class="nav-link">
            <i class="nav-icon fas fa-cubes"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="customerList.php" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
              <p>
                Purchases
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="supplierList.php" class="nav-link active">
            <i class="nav-icon fas fa-address-book"></i>
              <p>
                Supplier
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
              <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Supplier</li>
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
    <div class="col-md-10">
            <div>
              <a class="btn btn-primary btn-md" href="supplierList.php">
                  <i class="fas fa-arrow-left fa-lg">
                  </i>
                  Go Back
              </a>
            </div>
            <br>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Supplier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="firstname">Supplier Name</label>
                    <input type="text" name="suppliername" class="form-control <?php if(isset($suppliername_error_msg)) echo 'is-invalid'; ?>" placeholder="Enter Supplier Name" value="<?php if(isset($supplier)) echo $supplier['SupplierName'];?>">
                    <?php if(isset($suppliername_error_msg)): ?>
                <div class="invalid-feedback"><?php echo $suppliername_error_msg; ?></div>
            <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="contactnumber">Contact Number</label>
                    <input type="text" name="contactnumber" class="form-control <?php if(isset($contactnumber_error_msg)) echo 'is-invalid'; ?>" placeholder="Enter Contact Number"value="<?php if(isset($supplier)) echo $supplier['ContactNumber'];?>">
                    <?php if(isset($contactnumber_error_msg)): ?>
                <div class="invalid-feedback"><?php echo $contactnumber_error_msg; ?></div>
            <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="text" name="email" class="form-control <?php if(isset($email_error_msg)) echo 'is-invalid'; ?>" placeholder="Enter New Email" value="<?php if(isset($supplier)) echo $supplier['Email'];?>">
                    <?php if(isset($email_error_msg)): ?>
                <div class="invalid-feedback"><?php echo $email_error_msg; ?></div>
            <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" name="address" class="form-control <?php if(isset($address_error_msg)) echo 'is-invalid'; ?>" placeholder="Enter New Address" value="<?php if(isset($supplier)) echo $supplier['Address'];?>">
                    <?php if(isset($address_error_msg)): ?>
                <div class="invalid-feedback"><?php echo $address_error_msg; ?></div>
            <?php endif; ?>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
        </div>
            <!-- /.card -->

          </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Second Year &copy; 2022-2023 - Project</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Info M</b>
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
</body>
</html>
