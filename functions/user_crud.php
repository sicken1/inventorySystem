<?php
require_once('db_connect.php');


function searchUser($search)
{
    $conn = get_connection();

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT UserID, UserName, FirstName, LastName, UserType, Status, DateCreated, DateUpdated
                            FROM users
                            WHERE UserName LIKE :search
                            OR FirstName LIKE :search
                            OR LastName LIKE :search
                            OR UserType LIKE :search
                            OR Status = :statusSearch
                            OR DateCreated LIKE :dateSearch
                            OR DateUpdated LIKE :dateSearch
                            ORDER BY UserID");

    // Determine if the search term is 'active' or 'inactive'
    $isActive = strtolower($search) === 'active';
    $isInactive = strtolower($search) === 'inactive';

    // Bind the search parameter
    $stmt->bindValue(':search', '%' . $search . '%');

    // Bind the status parameter
    if ($isActive) {
        $stmt->bindValue(':statusSearch', 1);
    } elseif ($isInactive) {
        $stmt->bindValue(':statusSearch', 0);
    } else {
        $stmt->bindValue(':statusSearch', '');
    }

    // Bind the date parameter
    $stmt->bindValue(':dateSearch', '%' . $search . '%');

    // Execute the query
    $stmt->execute();

    // Fetch the data
    $userList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the connection
    $conn = null;

    // Return the User list data
    return $userList;
}





function getAllUsers()
 {
     $conn = get_connection();
     
     try {
         $stmt = $conn->query("SELECT * FROM users");
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     } catch (PDOException $e) {
         // Handle the exception, such as logging or displaying an error message
         echo "Error: " . $e->getMessage();
         return array(); // Return an empty array in case of an error
     }
 }

 function check_User_existing($firstname, $lastname, $userType)
{
    $conn = get_connection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE FirstName = :firstName AND LastName = :lastName AND UserType = :userType");
    $stmt->bindParam(':firstName', $firstname);
    $stmt->bindParam(':lastName', $lastname);
    $stmt->bindParam(':userType', $userType);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return 'existing';
    }

    return null;
}

  // Function to generate a unique username
function generateUniqueUsername($firstname, $lastname) {
    $username = strtolower(substr($firstname, 0, 1) . $lastname) . rand(100, 999);
    // You can add more logic to ensure uniqueness if needed
    return $username;
}

function addUser($firstname = '', $lastname = '', $password = '', $userType = '') {
    $conn = get_connection();

    // Generate a unique username based on first name, last name, and a random number
    $username = generateUniqueUsername($firstname, $lastname);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $existingUser = check_User_existing($firstname, $lastname, $userType);
    if ($existingUser) {
        return 'existing';
    }

    // Set default profile picture filename
    $defaultProfilePicture = 'default_img.jpg';
    $profilePicture = $defaultProfilePicture;

    $stmt = $conn->prepare("INSERT INTO users (UserName, FirstName, LastName, Password, UserType, ProfilePicture) VALUES (:username, :firstname, :lastname, :password, :userType, :profilePicture)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':userType', $userType);
    $stmt->bindParam(':profilePicture', $profilePicture);

    $response = $stmt->execute(); // Returns true on success or false on failure.

    if ($response) {
        $last_id = $conn->lastInsertId();
        return $last_id;
    }

    return false;
}


// Retrieve an user record by user ID, EDIT ADMIN FUNCTION
function getUserbyUserID($UserID) {
    // Connect to the database
    $conn = get_connection();

    // Prepare the SQL query
    $query = "SELECT * FROM users WHERE UserID = :UserID";
    $stmt = $conn->prepare($query);

    // Bind parameter
    $stmt->bindParam(':UserID', $UserID);

    // Execute the query
    $stmt->execute();

    // Fetch the admin record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Close the database connection
    $conn = null;

    return $user;
}

// Update an user record
function updateUser($UserID, $firstname, $lastname, $hashedPassword, $userType, $status)
{
    // Connect to the database
    $conn = get_connection();

    $statusValue = ($status === 'Active') ? 1 : 0;
    // Prepare the SQL query
    $query = "UPDATE users SET FirstName = :firstname, LastName = :lastname, Password = :hashedPassword, UserType = :userType, Status = :status WHERE UserID = :UserID";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':hashedPassword', $hashedPassword);
    $stmt->bindParam(':userType', $userType);
    $stmt->bindParam(':status', $statusValue); // Use the numeric value
    $stmt->bindParam(':UserID', $UserID);

    // Execute the query and return the result
    return $stmt->execute();
}


?>
