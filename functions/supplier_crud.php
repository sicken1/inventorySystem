<?php
require_once('db_connect.php');


function getAllSupplier() {
    $conn = get_connection(); // Assuming you have a function named get_connection for database connection

    try {
        $stmt = $conn->query("SELECT * FROM suppliers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function searchSupplier($search)
{
    $conn = get_connection();

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT SupplierID, SupplierName, ContactNumber, Email, Address, DateCreated, DateUpdated
                            FROM suppliers
                            WHERE SupplierID LIKE :search
                            OR SupplierName LIKE :search
                            OR ContactNumber LIKE :search
                            OR Email LIKE :search
                            OR Address LIKE :search
                            OR DateCreated LIKE :dateSearch
                            OR DateUpdated LIKE :dateSearch
                            ORDER BY SupplierID");

    // Bind the search parameter
    $stmt->bindValue(':search', '%' . $search . '%');

    // Bind the date parameter
    $stmt->bindValue(':dateSearch', '%' . $search . '%');

    // Execute the query
    $stmt->execute();

    // Fetch the data
    $supplierList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the connection
    $conn = null;

    // Return the Customer list data
    return $supplierList;
}

function check_Supplier_existing($suppliername, $contactnumber, $email, $address)
{
    $conn = get_connection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM suppliers WHERE SupplierName = :suppliername AND ContactNumber = :contactnumber AND Email = :email AND Address = :address");
    $stmt->bindParam(':suppliername', $suppliername);
    $stmt->bindParam(':contactnumber', $contactnumber);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return 'existing';
    }

    return null;
}

function addSupplier($suppliername, $contactnumber, $email, $address) {
    $conn = get_connection();

    $existingSupplier = check_Supplier_existing($suppliername, $contactnumber, $email, $address);
    if ($existingSupplier) {
        return 'existing';
    }

    $stmt = $conn->prepare("INSERT INTO suppliers (SupplierName, ContactNumber, Email, Address) VALUES (:suppliername, :contactnumber, :email, :address)");
    $stmt->bindParam(':suppliername', $suppliername);
    $stmt->bindParam(':contactnumber', $contactnumber);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);

    $response = $stmt->execute(); // Returns true on success or false on failure.

    if ($response) {
        $last_id = $conn->lastInsertId();
        return $last_id;
    }

    return false;
}


function getSupplierbySupplierID($supplierID)
{
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT * FROM suppliers WHERE SupplierID = :supplierID");
        $stmt->bindParam(':supplierID', $supplierID);
        $stmt->execute();

        // Fetch the data
        $supplier = $stmt->fetch(PDO::FETCH_ASSOC);

        return $supplier;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}

function updateSupplier($supplierID, $suppliername, $contactnumber, $email, $address)
{
    $conn = get_connection();

    try {
        // Prepare the SQL query
        $query = "UPDATE suppliers SET SupplierName = :suppliername, ContactNumber = :contactnumber, Email = :email, Address = :address WHERE SupplierID = :supplierID";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':supplierID', $supplierID);
        $stmt->bindParam(':suppliername', $suppliername);
        $stmt->bindParam(':contactnumber', $contactnumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);

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
?>