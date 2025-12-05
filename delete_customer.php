<?php
require 'functions/secure_session.php';
require_once 'functions/deleteF.php';
require_once 'functions/credentials&AT.php';

if (isset($_GET['id'])) {
    $CustomerID = $_GET['id'];

    // Call the deleteSaleBySaleID function
$deletedRows = deleteCustomerByCustomerID($CustomerID);
saveLog($_SESSION['user']['UserID'], 'Deleted Customer with Customer ID '. $CustomerID . ' ');

if ($deletedRows > 0) {
    $_SESSION['notification_message'] = '<div class="alert-green">Customer with ID'. $CustomerID. ' deleted successfully.</div>';
} else {
    $_SESSION['notification_message'] = '<div class="alert-red">Delete unsuccessful with Customer ID '. $CustomerID. '.</div>';
}

// Redirect to the appropriate page based on user type
if ($_SESSION['userType'] == 'admin') {
    header('Location: customerList.php');
}elseif ($_SESSION['userType'] == 'employee') {
    header('Location: Emp_customerList.php');
} else {
    echo "Invalid user type.";
}

// Exit to prevent further execution
exit();
}

?>