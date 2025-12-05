<?php
require 'functions/secure_session.php';
require_once 'functions/deleteF.php';
require_once 'functions/credentials&AT.php';

if (isset($_GET['id'])) {
    $UserID = $_GET['id'];

    // Call the deleteSaleBySaleID function
$deletedRows = deleteUserByUserID($UserID);
saveLog($_SESSION['user']['UserID'], 'Deleted user with user ID '. $UserID . ' ');

if ($deletedRows > 0) {
    $_SESSION['notification_message'] = '<div class="alert-green">User with ID'. $UserID. ' deleted successfully.</div>';
} else {
    $_SESSION['notification_message'] = '<div class="alert-red">Delete unsuccessful with user ID '. $UserID. '. Cannot delete Own Data.</div>';
}

// Redirect to the appropriate page based on user type
if ($_SESSION['userType'] == 'admin') {
    header('Location: userList.php');
} else {
    echo "Invalid user type.";
}

// Exit to prevent further execution
exit();
}

?>