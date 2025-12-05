<?php
require_once('db_connect.php');
require_once 'sale_crud.php';


function deleteSaleBySaleID($SaleID)
{
    $conn = get_connection();

    try {
        // Retrieve the quantity and productID of the sale before deleting
        $sqlSelect = "SELECT QuantitySold, ProductID FROM sales WHERE SaleID = :saleid";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bindParam(':saleid', $SaleID, PDO::PARAM_INT);
        $stmtSelect->execute();
        $saleData = $stmtSelect->fetch(PDO::FETCH_ASSOC);
        $quantity = $saleData['QuantitySold'];
        $productID = $saleData['ProductID'];

        // Delete the sale
        $sqlDelete = "DELETE FROM sales WHERE SaleID = :saleid";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bindParam(':saleid', $SaleID, PDO::PARAM_INT);
        $stmtDelete->execute();

        // Update the stock quantity
        $currentStock = getCurrentStock($productID);
        $newStock = $currentStock + $quantity;

        $sqlUpdateStock = "UPDATE products SET StockQuantity = :newStock WHERE ProductID = :productID";
        $stmtUpdateStock = $conn->prepare($sqlUpdateStock);
        $stmtUpdateStock->bindParam(':newStock', $newStock, PDO::PARAM_INT);
        $stmtUpdateStock->bindParam(':productID', $productID, PDO::PARAM_INT);
        $stmtUpdateStock->execute();

        // Return the number of affected rows
        return $stmtDelete->rowCount();
    } catch (PDOException $e) {
        // Handle the exception or log the error
        echo "Error deleting sale: " . $e->getMessage();
    }
}


function deleteCategoryByCategoryID($categoryID)
{
    $conn = get_connection();

    try {
        // Prepare the SQL statement
        $sql = "DELETE FROM categories WHERE CategoryID = :categoryID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $stmt->execute();
        
        // Return the number of affected rows
        return $stmt->rowCount();
    } catch (PDOException $e) {
        // Handle the exception or log the error
        echo "Error deleting category: " . $e->getMessage();
    }
}



function deleteUserByUserID($UserID) {
    $conn = get_connection();

    try {
        // Check if the user is trying to delete their own account
        session_start();
        if (isset($_SESSION['user']['UserID']) && $_SESSION['user']['UserID'] == $UserID) {
            echo "Error: Admin cannot delete their own account.";
            return 0; // or handle the error as needed
        }

        // Start a transaction to ensure atomicity
        $conn->beginTransaction();

        // Delete from the sales table first 
        $sqlSales = "DELETE FROM sales WHERE UserID = :userID";
        $stmtSales = $conn->prepare($sqlSales);
        $stmtSales->bindParam(':userID', $UserID, PDO::PARAM_INT);
        $stmtSales->execute();

        // Delete from the audittrail table next
        $sqlAuditTrail = "DELETE FROM audittrail WHERE UserID = :userID";
        $stmtAuditTrail = $conn->prepare($sqlAuditTrail);
        $stmtAuditTrail->bindParam(':userID', $UserID, PDO::PARAM_INT);
        $stmtAuditTrail->execute();

        // Finally, delete from the users table
        $sqlUsers = "DELETE FROM users WHERE UserID = :userID";
        $stmtUsers = $conn->prepare($sqlUsers);
        $stmtUsers->bindParam(':userID', $UserID, PDO::PARAM_INT);
        $stmtUsers->execute();

        // Commit the transaction if everything is successful
        $conn->commit();

        // Return the number of affected rows (optional)
        return $stmtUsers->rowCount();
    } catch (PDOException $e) {
        // Rollback the transaction on error
        $conn->rollBack();

        // Handle the exception or log the error
        echo "Error deleting user: " . $e->getMessage();
    }
}

// function deleteUserByUserID($UserID) {
//     $conn = get_connection();

//     try {
//         // Check if the user is trying to delete their own account
//         session_start();
//         if (isset($_SESSION['user']['UserID']) && $_SESSION['user']['UserID'] == $UserID) {
//             echo "Error: Admin cannot delete their own account.";
//             return 0; // or handle the error as needed
//         }

//         // Start a transaction to ensure atomicity
//         $conn->beginTransaction();

//         // Retrieve sales data before deleting the user
//         $sqlSales = "SELECT ProductID, QuantitySold FROM sales WHERE UserID = :userID";
//         $stmtSales = $conn->prepare($sqlSales);
//         $stmtSales->bindParam(':userID', $UserID, PDO::PARAM_INT);
//         $stmtSales->execute();
//         $salesData = $stmtSales->fetchAll(PDO::FETCH_ASSOC);

//         // Delete from the sales table
//         $sqlDeleteSales = "DELETE FROM sales WHERE UserID = :userID";
//         $stmtDeleteSales = $conn->prepare($sqlDeleteSales);
//         $stmtDeleteSales->bindParam(':userID', $UserID, PDO::PARAM_INT);
//         $stmtDeleteSales->execute();

//         // Delete from the audittrail table
//         $sqlAuditTrail = "DELETE FROM audittrail WHERE UserID = :userID";
//         $stmtAuditTrail = $conn->prepare($sqlAuditTrail);
//         $stmtAuditTrail->bindParam(':userID', $UserID, PDO::PARAM_INT);
//         $stmtAuditTrail->execute();

//         // Finally, delete from the users table
//         $sqlDeleteUser = "DELETE FROM users WHERE UserID = :userID";
//         $stmtDeleteUser = $conn->prepare($sqlDeleteUser);
//         $stmtDeleteUser->bindParam(':userID', $UserID, PDO::PARAM_INT);
//         $stmtDeleteUser->execute();

//         // Commit the transaction if everything is successful
//         $conn->commit();

//         // Update stock quantities for each sale
//         foreach ($salesData as $sale) {
//             $productID = $sale['ProductID'];
//             $quantitySold = $sale['QuantitySold'];

//             $currentStock = getCurrentStock($productID);
//             $newStock = $currentStock + $quantitySold;

//             $sqlUpdateStock = "UPDATE products SET StockQuantity = :newStock WHERE ProductID = :productID";
//             $stmtUpdateStock = $conn->prepare($sqlUpdateStock);
//             $stmtUpdateStock->bindParam(':newStock', $newStock, PDO::PARAM_INT);
//             $stmtUpdateStock->bindParam(':productID', $productID, PDO::PARAM_INT);
//             $stmtUpdateStock->execute();
//         }

//         // Return the number of affected rows from deleting the user (optional)
//         return $stmtDeleteUser->rowCount();
//     } catch (PDOException $e) {
//         // Rollback the transaction on error
//         $conn->rollBack();

//         // Handle the exception or log the error
//         echo "Error deleting user: " . $e->getMessage();
//     }
// }


function deleteCustomerByCustomerID($CustomerID) {
    $conn = get_connection();

    try {
        // Start a transaction to ensure atomicity
        $conn->beginTransaction();

        // Delete from the sales table first
        $sqlSales = "DELETE FROM sales WHERE CustomerID = :customerID";
        $stmtSales = $conn->prepare($sqlSales);
        $stmtSales->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
        $stmtSales->execute();

        // Finally, delete from the customers table
        $sqlCustomers = "DELETE FROM customers WHERE CustomerID = :customerID";
        $stmtCustomers = $conn->prepare($sqlCustomers);
        $stmtCustomers->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
        $stmtCustomers->execute();

        // Commit the transaction if everything is successful
        $conn->commit();

        // Return the number of affected rows (optional)
        return $stmtCustomers->rowCount();
    } catch (PDOException $e) {
        // Rollback the transaction on error
        $conn->rollBack();

        // Handle the exception or log the error
        echo "Error deleting customer: " . $e->getMessage();
    }
}

// function deleteCustomerByCustomerID($CustomerID) {
//     $conn = get_connection();

//     try {
//         // Start a transaction to ensure atomicity
//         $conn->beginTransaction();

//         // Retrieve sales data before deleting the customer
//         $sqlSales = "SELECT ProductID, QuantitySold FROM sales WHERE CustomerID = :customerID";
//         $stmtSales = $conn->prepare($sqlSales);
//         $stmtSales->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
//         $stmtSales->execute();
//         $salesData = $stmtSales->fetchAll(PDO::FETCH_ASSOC);

//         // Delete from the sales table
//         $sqlDeleteSales = "DELETE FROM sales WHERE CustomerID = :customerID";
//         $stmtDeleteSales = $conn->prepare($sqlDeleteSales);
//         $stmtDeleteSales->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
//         $stmtDeleteSales->execute();

//         // Finally, delete from the customers table
//         $sqlDeleteCustomer = "DELETE FROM customers WHERE CustomerID = :customerID";
//         $stmtDeleteCustomer = $conn->prepare($sqlDeleteCustomer);
//         $stmtDeleteCustomer->bindParam(':customerID', $CustomerID, PDO::PARAM_INT);
//         $stmtDeleteCustomer->execute();

//         // Commit the transaction if everything is successful
//         $conn->commit();

//         // Update stock quantities for each sale
//         foreach ($salesData as $sale) {
//             $productID = $sale['ProductID'];
//             $quantitySold = $sale['QuantitySold'];

//             $currentStock = getCurrentStock($productID);
//             $newStock = $currentStock + $quantitySold;

//             $sqlUpdateStock = "UPDATE products SET StockQuantity = :newStock WHERE ProductID = :productID";
//             $stmtUpdateStock = $conn->prepare($sqlUpdateStock);
//             $stmtUpdateStock->bindParam(':newStock', $newStock, PDO::PARAM_INT);
//             $stmtUpdateStock->bindParam(':productID', $productID, PDO::PARAM_INT);
//             $stmtUpdateStock->execute();
//         }

//         // Return the number of affected rows from deleting the customer (optional)
//         return $stmtDeleteCustomer->rowCount();
//     } catch (PDOException $e) {
//         // Rollback the transaction on error
//         $conn->rollBack();

//         // Handle the exception or log the error
//         echo "Error deleting customer: " . $e->getMessage();
//     }
// }


function deleteProductByProductID($ProductID) {
    $conn = get_connection();

    try {
        // Start a transaction to ensure atomicity
        $conn->beginTransaction();

        // Delete from the sales table first
        $sqlSales = "DELETE FROM sales WHERE ProductID = :customerID";
        $stmtSales = $conn->prepare($sqlSales);
        $stmtSales->bindParam(':customerID', $ProductID, PDO::PARAM_INT);
        $stmtSales->execute();

        // Finally, delete from the Product table
        $sqlProducts = "DELETE FROM products WHERE ProductID = :customerID";
        $stmtProducts = $conn->prepare($sqlProducts);
        $stmtProducts->bindParam(':customerID', $ProductID, PDO::PARAM_INT);
        $stmtProducts->execute();

        // Commit the transaction if everything is successful
        $conn->commit();

        // Return the number of affected rows (optional)
        return $stmtProducts->rowCount();
    } catch (PDOException $e) {
        // Rollback the transaction on error
        $conn->rollBack();

        // Handle the exception or log the error
        echo "Error deleting customer: " . $e->getMessage();
    }
}

?>