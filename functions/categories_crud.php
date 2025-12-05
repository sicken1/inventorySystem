<?php
require_once('db_connect.php');

function getAllCategories() {
    $conn = get_connection(); // Assuming you have a function named get_connection for database connection

    try {
        $stmt = $conn->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function searchCategory($search)
{
    $conn = get_connection();

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT CategoryID, CategoryName, DateCreated, DateUpdated
                            FROM categories
                            WHERE CategoryID LIKE :search
                            OR CategoryName LIKE :search
                            OR DateCreated LIKE :dateSearch
                            OR DateUpdated LIKE :dateSearch
                            ORDER BY CategoryID");

    // Bind the search parameter
    $stmt->bindValue(':search', '%' . $search . '%');

    // Bind the date parameter
    $stmt->bindValue(':dateSearch', '%' . $search . '%');

    // Execute the query
    $stmt->execute();

    // Fetch the data
    $categoryList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the connection
    $conn = null;

    // Return the Category list data
    return $categoryList;
}


function check_Category_existing($categoryname)
{
    $conn = get_connection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM categories WHERE CategoryName = :categoryname");
    $stmt->bindParam(':categoryname', $categoryname);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return 'existing';
    }

    return null;
}

function addCategory($categoryname) {
    $conn = get_connection();

    $existingCategory = check_Category_existing($categoryname);
    if ($existingCategory) {
        return 'existing';
    }

    $stmt = $conn->prepare("INSERT INTO categories (CategoryName) VALUES (:categoryname)");
    $stmt->bindParam(':categoryname', $categoryname);

    $response = $stmt->execute(); // Returns true on success or false on failure.

    if ($response) {
        $last_id = $conn->lastInsertId();
        return $last_id;
    }

    return false;
}



function getCategorybyCategoryID($categoryID){

    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT * FROM categories WHERE CategoryID = :categoryID");
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->execute();

        // Fetch the data
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}


function updateCategory($categoryID, $categoryname)
{
    $conn = get_connection();

    try {
        // Prepare the SQL query
        $query = "UPDATE categories SET CategoryName = :categoryname WHERE CategoryID = :categoryID";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->bindParam(':categoryname', $categoryname);

        // Execute the query
        $stmt->execute();

        // Check if any rows were affected
        $rowCount = $stmt->rowCount();

        // Return true if the update was successful (at least one row affected), otherwise return false
        return $rowCount > 0;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}


function getCategoryIDByName($category){

    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT * FROM categories WHERE CategoryName = :categoryname");
        $stmt->bindParam(':categoryname', $category);
        $stmt->execute();

        // Fetch the data
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category['CategoryID'];
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}



?>