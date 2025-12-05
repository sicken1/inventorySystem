<?php
require 'functions/secure_session.php';
require_once 'functions/deleteF.php';
require_once 'functions/credentials&AT.php';

if (isset($_GET['id'])) {
    $categoryID = $_GET['id'];

    // Call the function
$deletedRows = deleteCategoryByCategoryID($categoryID);
saveLog($_SESSION['user']['UserID'], 'Deleted category with category ID '. $categoryID . ' ');

if ($deletedRows > 0) {
    $_SESSION['notification_message'] = '<div class="alert-green">Category with ID'. $categoryID. ' deleted successfully.</div>';
} else {
    $_SESSION['notification_message'] = '<div class="alert-red">Deletion unsuccessful category ID'. $categoryID. ' is used in products.</div>';
}

// Redirect to the appropriate page based on user type
if ($_SESSION['userType'] == 'admin') {
    header('Location: categoriesList.php');
} elseif ($_SESSION['userType'] == 'employee') {
    header('Location: Emp_categoriesList.php');
} else {
    echo "Invalid user type.";
}

// Exit to prevent further execution
exit();
}

?>