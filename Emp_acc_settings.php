<?php
require 'functions/secure_session.php';
require_once 'functions/user_crud.php';
require_once 'functions/acc_crud.php';
require_once 'functions/credentials&AT.php';

$notification_message = '';
if (isset($_GET['id'])) {
    $UserID = $_GET['id'];
    // Retrieve the user record by ID
    $user = getUserbyUserID($UserID);
} else {
    // Redirect to the employee_dashboard.php page if none is provided
    header('Location: employee_dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $has_error = FALSE;

    if (empty($_POST['username'])) {
      $has_error = TRUE;
      $username_error_msg = 'This field is required.';
  } else {
      $username = trim(htmlspecialchars($_POST['username']));
  }
    if (empty($_POST['firstname'])) {
        $has_error = TRUE;
        $firstname_error_msg = 'This field is required.';
    } else {
        $firstname = trim(htmlspecialchars($_POST['firstname']));
    }
    if (empty($_POST['lastname'])) {
        $has_error = TRUE;
        $lastname_error_msg = 'This field is required.';
    } else {
        $lastname = trim(htmlspecialchars($_POST['lastname']));
    }
    // Check if a new password is provided
    if (!empty($_POST['password'])) {
        $password = trim(htmlspecialchars($_POST['password']));
        // Hash the password
        $hashedPassword1 = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // No new password provided, use the existing hashed password
        $hashedPassword1 = $user['Password'];
    }
            // Check if a new photo is provided
            if (empty($_FILES['picture']['name'])) {
              $avatarS = $user['ProfilePicture'];
          } else {
              $avatar_name = $_FILES['picture']['name'];
              $avatar_size = $_FILES['picture']['size'];
      
              // Validate file size (maximum 5MB)
              $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
      
              if ($avatar_size > $maxFileSize) {
                  $has_error = TRUE;
                  $profilepicture_error_msg = 'The profile picture file size should not exceed 5MB.';
              } else {
                  $avatar_tmp_name = $_FILES['picture']['tmp_name'];
                  $avatar_folder = 'profile_img/' . $avatar_name;
      
                  // Move the uploaded file to the desired location
                  if (move_uploaded_file($avatar_tmp_name, $avatar_folder)) {
                      // File upload success
                      $avatarS = $avatar_name; // Store only the filename in the $avatar variable
                  } else {
                      $has_error = true;
                      $profilepicture_error_msg = 'Failed to upload the profile picture.';
                  }
              }
          }

    if (!$has_error) {
        // Edit user record
        $username = (string) trim($_POST['username']);
        $firstname = (string) trim($_POST['firstname']);
        $lastname = (string) trim($_POST['lastname']);
        $hashedPassword = $hashedPassword1;
        $avatar = $avatarS;

        $updateAcc = updateAcc($UserID, $username, $firstname, $lastname, $hashedPassword, $avatar);

        if ($updateAcc === FALSE) {
            $notification_message = '<div class="alert-red">Error: Unable to update information.</div>';
        } else {
            $_SESSION['username'] = $username;
            $notification_message = '<div class="alert-green">The Profile information has been successfully updated.</div>';
            $selectedUser = getUserbyUserID($UserID);
            $username = $selectedUser['UserName'];
            saveLog($_SESSION['user']['UserID'], 'Updated own profile information.');
}

    }
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
            <a href="Emp_customerList.php" class="nav-link">
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
              <li class="breadcrumb-item active">Settings</li>
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
    <?php echo $notification_message; ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" name="username" class="form-control <?php if(isset($username_error_msg)) echo 'is-invalid'; ?>" placeholder="Enter Username" value="<?php if(isset($user)) echo $user['UserName'];?>">
                    <?php if(isset($username_error_msg)): ?>
                <div class="invalid-feedback"><?php echo $username_error_msg; ?></div>
            <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" class="form-control <?php if(isset($firstname_error_msg)) echo 'is-invalid'; ?>" placeholder="Enter First Name" value="<?php if(isset($user)) echo $user['FirstName'];?>">
                    <?php if(isset($firstname_error_msg)): ?>
                <div class="invalid-feedback"><?php echo $firstname_error_msg; ?></div>
            <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="LastName">Last Name</label>
                    <input type="text" name="lastname" class="form-control <?php if(isset($lastname_error_msg)) echo 'is-invalid'; ?>" placeholder="Enter Last Name"value="<?php if(isset($user)) echo $user['LastName'];?>">
                    <?php if(isset($lastname_error_msg)): ?>
                <div class="invalid-feedback"><?php echo $lastname_error_msg; ?></div>
            <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" name="password" class="form-control <?php if(isset($password_error_msg)) echo 'is-invalid'; ?>" placeholder="Enter New Password" value="">
                    <?php if(isset($password_error_msg)): ?>
                <div class="invalid-feedback"><?php echo $password_error_msg; ?></div>
            <?php endif; ?>
                  </div>
                  <div class="form-group">
                  <label for="picture">Profile Picture:</label>
                  <input type="file" name="picture" accept="image/jpg, image/jpeg, image/png">
                  <?php if(isset($profilepicture_error_msg)) echo $profilepicture_error_msg;?>
                  </div>
                <!-- /.card-body -->

                <div>
                  <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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
