<?php
require_once('functions/credentials&AT.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $has_error = FALSE;
    $password = ''; 
    
    if (empty($_POST['username'])) {
        $has_error = TRUE;
        $username_error_msg = 'This field is required.';
    } else {
        $username = trim(htmlspecialchars($_POST['username']));
    }

    if (empty($_POST['password'])) {
        $has_error = TRUE;
        $password_error_msg = 'The field is required.';
    } else {
        $password = trim(htmlspecialchars($_POST['password']));
    }

    if (empty($_POST['userType'])) {
        $has_error = TRUE;
        $userType_error_msg = 'The userType is required.';
    } else {
        $userType = trim(htmlspecialchars($_POST['userType']));
    }

    if (!$has_error) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userType = $_POST['userType'];

        if ($userType === 'Admin') {
            $admin = getAdminCredentials($username);
            if ($admin) {
                if (password_verify($password, $admin['Password'])) {
                    if ($admin['Status'] == 1) {
                        // Admin login successful
                        session_start();
                        $_SESSION['userType'] = 'admin';
                        $_SESSION['username'] = $username;

                        saveLog($admin['UserID'], 'Logged in');
                        header('Location: admin_dashboard.php');
                        exit();
                    } else {
                        $login_error_msg = 'Account is inactive. Please contact the administrator to reactivate your account.';
                    }
                } else {
                    $login_error_msg = 'Invalid username or password.';
                }
            } else {
                $login_error_msg = 'Invalid username or password or userType.';
            }
        } elseif ($userType === 'Employee') {
            $employee = getEmployeeCredentials($username);
            if ($employee) {
                if (password_verify($password, $employee['Password'])) {
                    if ($employee['Status'] == 1) {
                        // Employee login successful
                        session_start();
                        $_SESSION['userType'] = 'employee';
                        $_SESSION['username'] = $username;

                        saveLog($employee['UserID'], 'Logged in');
                        header('Location: employee_dashboard.php');
                        exit();
                    } else {
                        $login_error_msg = 'Account is inactive. Please contact the administrator to reactivate your account.';
                    }
                } else {
                    $login_error_msg = 'Invalid username or password.';
                }
            } else {
                $login_error_msg = 'Invalid username or password or user type.';
            }
        } else {
            $login_error_msg = 'Please select a user type.';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    .error-message {
        color: red;
    }
</style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-body">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/marklogo.jpg"
                       alt="Business Logo picture">
                </div>
                <b class="profile-username text-center" style="display: block; text-align: center;">IMS MARKSCENT</b>
          <p class="login-box-msg">Sign in to start your work</p>
          <?php if(isset($login_error_msg)) echo '<span class="error-message">' .$login_error_msg. '</span>';?>
          <form action="" method="post">
          <label for="username">Username</label>
          <br>
          <?php if(isset($username_error_msg)) echo '<span class="error-message">' .$username_error_msg. '</span>';?>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="username" name="username" value="<?php if(isset($username)) echo $username;?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <label for="password">Password</label>
            <br>
            <?php if(isset($password_error_msg)) echo '<span class="error-message">' .$password_error_msg. '</span>';?>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="password" name="password" value="<?php if(isset($password)) echo $password;?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
                <!-- select -->
            <div class="form-group">
                <label for="userType">Select User Type</label>
                <br>
                    <?php if(isset($userType_error_msg)) echo '<span class="error-message">' .$userType_error_msg. '</span>';?>
                    <select class="form-control" name="userType">
                        <option value="Admin">ADMIN</option>
                        <option value="Employee">EMPLOYEE</option>
                    </select>
            </div>
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Log In</button>
              </div>       
            </div>
          </form>  
          </div> 
          </div>
        </div>
      </div>
    </div>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>