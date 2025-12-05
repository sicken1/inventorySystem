<?php
require_once('db_connect.php');


function searchCustomer($search)
{
    $conn = get_connection();

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT CustomerID, CustomerName, ContactNumber, Email, Address, DateCreated, DateUpdated
                            FROM customers
                            WHERE CustomerID LIKE :search
                            OR CustomerName LIKE :search
                            OR ContactNumber LIKE :search
                            OR Email LIKE :search
                            OR Address LIKE :search
                            OR DateCreated LIKE :dateSearch
                            OR DateUpdated LIKE :dateSearch
                            ORDER BY CustomerID");

    // Bind the search parameter
    $stmt->bindValue(':search', '%' . $search . '%');

    // Bind the date parameter
    $stmt->bindValue(':dateSearch', '%' . $search . '%');

    // Execute the query
    $stmt->execute();

    // Fetch the data
    $customerList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the connection
    $conn = null;

    // Return the Customer list data
    return $customerList;
}

function getAllCustomers()
 {
     $conn = get_connection();
     
     try {
         $stmt = $conn->query("SELECT * FROM customers");
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     } catch (PDOException $e) {
         // Handle the exception, such as logging or displaying an error message
         echo "Error: " . $e->getMessage();
         return array(); // Return an empty array in case of an error
     }
 }

 function getCustomerbyCustomerID($CustomerID)
{
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT * FROM customers WHERE CustomerID = :CustomerID");
        $stmt->bindParam(':CustomerID', $CustomerID);
        $stmt->execute();

        // Fetch the data
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        return $customer;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}

function updateCustomer($CustomerID, $customername, $contactnumber, $email, $address)
{
    $conn = get_connection();

    try {
        // Prepare the SQL query
        $query = "UPDATE customers SET CustomerName = :customername, ContactNumber = :contactnumber, Email = :email, Address = :address WHERE CustomerID = :CustomerID";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':CustomerID', $CustomerID);
        $stmt->bindParam(':customername', $customername);
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

function check_Customer_existing($customername, $contactnumber, $email, $address)
{
    $conn = get_connection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM customers WHERE CustomerName = :customername AND ContactNumber = :contactnumber AND Email = :email AND Address = :address");
    $stmt->bindParam(':customername', $customername);
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

function addCustomer($customername, $contactnumber, $email, $address) {
    $conn = get_connection();

    $existingCustomer = check_Customer_existing($customername, $contactnumber, $email, $address);
    if ($existingCustomer) {
        return 'existing';
    }

    $stmt = $conn->prepare("INSERT INTO customers (CustomerName, ContactNumber, Email, Address) VALUES (:customername, :contactnumber, :email, :address)");
    $stmt->bindParam(':customername', $customername);
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

?>