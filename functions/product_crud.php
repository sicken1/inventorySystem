<?php
require_once('db_connect.php');

function getAllProduct()
{
    $conn = get_connection();

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->query("SELECT p.*, c.CategoryName FROM products p JOIN categories c ON p.CategoryID = c.CategoryID Order by p.ProductId ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function searchProduct($search)
{
    $conn = get_connection();

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT p.*, c.CategoryName 
                                FROM products p 
                                JOIN categories c ON p.CategoryID = c.CategoryID
                                WHERE p.ProductName LIKE :search
                                OR p.Description LIKE :search
                                OR c.CategoryName LIKE :search
                                OR p.StockQuantity LIKE :search
                                OR p.UnitPrice LIKE :search
                                OR p.DateCreated LIKE :dateSearch
                                OR p.DateUpdated LIKE :dateSearch
                                ORDER BY p.ProductID");

        // Bind the search parameter
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        // Bind the date parameter
        $stmt->bindValue(':dateSearch', '%' . $search . '%', PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}


// Retrieve an product record by product ID, EDIT ADMIN FUNCTION
function getProductbyProductID($productID)
{
    // Connect to the database
    $conn = get_connection();

    // Prepare the SQL query
    $query = "SELECT p.*, c.CategoryName FROM products p JOIN categories c ON p.CategoryID = c.CategoryID WHERE ProductID = :productID";
    $stmt = $conn->prepare($query);

    // Bind parameter
    $stmt->bindParam(':productID', $productID);

    // Execute the query
    $stmt->execute();

    // Fetch the admin record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Close the database connection
    $conn = null;

    return $user;
}


// Update an product record
function updateProduct($productID, $productname, $description, $categoryID, $stockquantity, $unitprice)
{
    // Connect to the database
    $conn = get_connection();

    try {
        // Prepare the SQL query
        $query = "UPDATE products SET ProductName = :productname, Description = :description, CategoryID = :categoryID, StockQuantity = :stockquantity, UnitPrice = :unitprice WHERE ProductID = :ProductID";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':productname', $productname);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->bindParam(':stockquantity', $stockquantity);
        $stmt->bindParam(':unitprice', $unitprice);
        $stmt->bindParam(':ProductID', $productID);

        // Execute the query
        $stmt->execute();

        // Check if any rows were affected
        $rowCount = $stmt->rowCount();

        // Return true if the update was successful (at least one row affected), otherwise return false
        return $rowCount > 0;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function check_Product_existing($productname)
{
    $conn = get_connection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE ProductName = :productname");
    $stmt->bindParam(':productname', $productname);
    // $stmt->bindParam(':description', $description);
    // $stmt->bindParam(':categoryID', $categoryID);

    $stmt->execute();

    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return 'existing';
    }

    return null;
}

function addProduct($productname, $description, $categoryID, $stockquantity, $unitprice) {
    $conn = get_connection();

    $existingProduct = check_Product_existing($productname);
    if ($existingProduct) {
        return 'existing';
    }

    $stmt = $conn->prepare("INSERT INTO products (ProductName, Description, CategoryID, StockQuantity, UnitPrice) VALUES (:productname, :description, :categoryID, :stockquantity, :unitprice)");
    $stmt->bindParam(':productname', $productname);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':categoryID', $categoryID);
    $stmt->bindParam(':stockquantity', $stockquantity);
    $stmt->bindParam(':unitprice', $unitprice);

    $response = $stmt->execute(); // Returns true on success or false on failure.

    if ($response) {
        $last_id = $conn->lastInsertId();
        return $last_id;
    }

    return false;
}
?>