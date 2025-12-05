<?php
require_once 'db_connect.php';



function searchLog($search)
{
    $conn = get_connection(); 

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT a.AuditID, a.Action, a.ActionDate, u.UserName, u.UserType
        FROM audittrail a JOIN users u ON a.UserID = u.UserID
        WHERE a.AuditID LIKE :search OR a.Action LIKE :search OR a.ActionDate LIKE :search OR u.UserName LIKE :search OR u.UserType LIKE :search order by a.AuditID");

        $searchParam = "%" . $search . "%";
        $stmt->bindParam(':search', $searchParam);

        $stmt->execute(); // Execute the prepared statement

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function getAllLogs()
{
    $conn = get_connection(); 

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT a.*, u.UserName, u.UserType
        FROM audittrail a JOIN users u ON a.UserID = u.UserID order by a.AuditID");

        $stmt->execute(); // Execute the prepared statement

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function searchUserLog($search, $userID)
{
    $conn = get_connection();
    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT a.AuditID, a.Action, a.ActionDate, u.UserName, u.UserType
        FROM audittrail a JOIN users u ON a.UserID = u.UserID
        WHERE (a.AuditID LIKE :search OR a.Action LIKE :search OR a.ActionDate LIKE :search OR u.UserName LIKE :search OR u.UserType LIKE :search)
        AND u.UserID = :userID
        ORDER BY a.AuditID");

        $searchParam = "%" . $search . "%";
        $stmt->bindParam(':search', $searchParam);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        $stmt->execute(); // Execute the prepared statement

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}



function getUserLogs($userID)
{
    $conn = get_connection();

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM vw_user_logs WHERE UserID = :userID");

        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute(); // Execute the prepared statement

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

?>