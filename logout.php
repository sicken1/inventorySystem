<?php
require 'functions/secure_session.php';
require_once 'functions/audit_logs.php';
require_once 'functions/credentials&AT.php';

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    // Log the logout event
    $userId = $_SESSION['user']['UserID'];

    // Use your existing saveLog function to log the logout event
    saveLog($userId, 'Logout');
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page (you can change the URL accordingly)
header("Location: index.php");
exit();
?>
