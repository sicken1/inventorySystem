<?php
require 'functions/secure_session.php';
require_once 'functions/deleteF.php';
require_once 'functions/credentials&AT.php';

if (isset($_GET['id'])) {
    $ProductID = $_GET['id'];

    // Call the deleteSaleBySaleID function
$deletedRows = deleteProductByProductID($ProductID);
saveLog($_SESSION['user']['UserID'], 'Deleted Product with Product ID '. $ProductID . ' ');

if ($deletedRows > 0) {
    $_SESSION['notification_message'] = '<div class="alert-green">Product with ID'. $ProductID. ' deleted successfully.</div>';
} else {
    $_SESSION['notification_message'] = '<div class="alert-red">Delete unsuccessful with Product ID '. $ProductID. '.</div>';
}

// Redirect to the appropriate page based on user type
if ($_SESSION['userType'] == 'admin') {
    header('Location: productList.php');
}elseif ($_SESSION['userType'] == 'employee') {
    header('Location: Emp_productList.php');
} else {
    echo "Invalid user type.";
}

// Exit to prevent further execution
exit();
}

?>