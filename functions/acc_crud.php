<?php
require_once 'db_connect.php';
require_once 'user_crud.php';

function check_Username_existing($username){
        $conn = get_connection();
    
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE UserName = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $count = $stmt->fetchColumn();
    
        if ($count > 0) {
            return 'existing';
        }
    
        return null;

}

function updateAcc($UserID, $username, $firstname, $lastname, $hashedPassword, $avatar) {
    $conn = get_connection();

    // Check if the username has been changed
    if ($username != getUserByUserId($UserID)['UserName']) {
        // Username has been changed, check if the new username already exists
        $existingUsername = check_Username_existing($username);
        if ($existingUsername) {
            return 'existing';
        }
    }

    try {
        $stmt = $conn->prepare("UPDATE users 
                                SET UserName = :username, 
                                    FirstName = :firstname, 
                                    LastName = :lastname, 
                                    Password = :hashedPassword, 
                                    ProfilePicture = :avatar 
                                WHERE UserID = :userID");

        $stmt->bindParam(':userID', $UserID);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':hashedPassword', $hashedPassword);
        $stmt->bindParam(':avatar', $avatar);

        if ($stmt->execute()) {
            return true; // Return a boolean indicating success
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "PDOException: " . $e->getMessage();
        return false;
    }
}


?>