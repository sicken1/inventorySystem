<?php
require_once 'db_connect.php';

function getAllUserSale($userID)
{
    $conn = get_connection();

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM vw_user_sales WHERE UserID = :userID ORDER BY SaleID");

        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute(); // Execute the prepared statement

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function getGrandTotalUserSale($userID)
{
    $conn = get_connection();

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT SUM(TotalAmount) AS GrandTotal FROM vw_user_sales WHERE UserID = :userID");

        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute(); // Execute the prepared statement

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the grand total or 0 if no records are found
        return $result ? $result['GrandTotal'] : 0;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return 0; // Return 0 in case of an error
    }
}





?>