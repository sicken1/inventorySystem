<?php
require_once 'db_connect.php';

session_start();

    if (!isset($_SESSION['username']) || !isset($_SESSION['userType'])) {
        // User is not logged in. Redirect them back to login page
        header('Location: index.php');
        exit;
    }
$userID = getUserIdByUsernameAndType($_SESSION['username'], $_SESSION['userType']);

// Set the UserID in the session
$_SESSION['user']['UserID'] = $userID;


function getUserIdByUsernameAndType($username, $userType) {
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT UserID FROM users WHERE UserName = :username AND UserType = :userType");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':userType', $userType);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['UserID'];
        } else {
            // No matching user found
            return null;
        }
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return null;
    }
}


function getUserById($userID) {
    // Connect to the database
    $conn = get_connection();

    // Prepare the SQL query
    $query = "SELECT * FROM users WHERE UserID = :UserID";
    $stmt = $conn->prepare($query);

    // Bind parameter
    $stmt->bindParam(':UserID', $userID);

    // Execute the query
    $stmt->execute();

    // Fetch the admin record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Close the database connection
    $conn = null;

    return $user;
}

?>