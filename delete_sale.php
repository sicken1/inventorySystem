<?php
require 'functions/secure_session.php';
require_once 'functions/deleteF.php';
require_once 'functions/credentials&AT.php';

if (isset($_GET['id'])) {
    $SaleID = $_GET['id'];

    // Call the deleteSaleBySaleID function
$deletedRows = deleteSaleBySaleID($SaleID);
saveLog($_SESSION['user']['UserID'], 'Deleted sale with sale ID '. $SaleID . ' ');

if ($deletedRows > 0) {
    $_SESSION['notification_message'] = '<div class="alert-green">Sale with ID'. $SaleID. ' deleted successfully.</div>';
} else {
    $_SESSION['notification_message'] = '<div class="alert-red">Delete unsuccessful with sale ID '. $SaleID. '</div>';
}

// Redirect to the appropriate page based on user type
if ($_SESSION['userType'] == 'admin') {
    header('Location: saleList.php');
} elseif ($_SESSION['userType'] == 'employee') {
    header('Location: Emp_saleList.php');
} else {
    echo "Invalid user type.";
}

// Exit to prevent further execution
exit();
}

?>