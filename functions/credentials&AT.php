<?php
require_once('db_connect.php');

function saveLog($userID, $action) {
    $conn = get_connection();

    try {
        $query = "INSERT INTO audittrail (UserID, Action, ActionDate) VALUES (:userID, :action, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':action', $action);
        $stmt->execute();
        
        // You can add additional handling here if needed

    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
    }
}


function getAdminCredentials($username) {
    $conn = get_connection();

    try {
        $query = "SELECT * FROM users WHERE UserName = :UserName AND UserType = 'Admin'";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':UserName', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}

function getEmployeeCredentials($username) {
    $conn = get_connection();

    try {
        $query = "SELECT * FROM users WHERE UserName = :UserName AND UserType = 'Employee'";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':UserName', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}

?>
