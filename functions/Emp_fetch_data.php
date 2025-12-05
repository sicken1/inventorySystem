<?php
require_once 'db_connect.php';

// Check if the required POST data is set
if (isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['user_id'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $userID = $_POST['user_id'];

    try {
                // Replace this with your actual database query
        $data = fetchDataFromDatabase($startDate, $endDate, $userID); // Pass the user ID

        // Return the fetched data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    return false;
}


function fetchDataFromDatabase($startDate, $endDate, $userID) {
    // Prepare the query
    $conn = get_connection();
    $query = "SELECT s.*, p.ProductName, p.UnitPrice, c.CustomerName, u.UserName 
            FROM sales s 
            JOIN customers c ON s.CustomerID = c.CustomerID
            JOIN users u ON s.UserID = u.UserID
            JOIN products p ON s.ProductID = p.ProductID
            WHERE s.DateCreated >= :startDate 
            AND s.DateCreated < DATE_ADD(:endDate, INTERVAL 1 DAY)
            AND s.UserID = :userID  -- Filter by user ID
            ORDER BY s.SaleID ASC";

    error_log("SQL Query: " . $query);

    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':userID', $userID);

    // Execute the query
    $stmt->execute();

    // Check for errors
    if ($stmt->errorCode() != 0) {
        throw new PDOException("Error executing query: " . implode(", ", $stmt->errorInfo()));
    }

    // Fetch the data
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

?>
