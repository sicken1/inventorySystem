<?php
require_once('db_connect.php');


// Function to search for sales based on a keyword
function searchSale($search) {
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT s.*, p.ProductName, c.CustomerName, u.UserName 
                                FROM sales s 
                                JOIN customers c ON s.CustomerID = c.CustomerID
                                JOIN users u ON s.UserID = u.UserID
                                JOIN products p ON s.ProductID = p.ProductID
                                WHERE p.ProductName LIKE :search 
                                OR c.CustomerName LIKE :search 
                                OR s.QuantitySold LIKE :search 
                                OR s.TotalAmount LIKE :search 
                                OR u.UserName LIKE :search 
                                OR s.DateCreated LIKE :search
                                OR s.DateUpdated LIKE :search 
                                ORDER BY s.SaleID");

        // Bind the search parameter
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        $stmt->execute(); // Execute the statement

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function searchUserSale($search, $userID) {
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT s.*, p.ProductName, c.CustomerName, u.UserName 
                                FROM sales s 
                                JOIN customers c ON s.CustomerID = c.CustomerID
                                JOIN users u ON s.UserID = u.UserID
                                JOIN products p ON s.ProductID = p.ProductID
                                WHERE (p.ProductName LIKE :search 
                                OR c.CustomerName LIKE :search 
                                OR s.QuantitySold LIKE :search 
                                OR s.TotalAmount LIKE :search 
                                OR u.UserName LIKE :search 
                                OR s.DateCreated LIKE :search
                                OR s.DateUpdated LIKE :search)  AND u.UserID = :userID
                                ORDER BY s.SaleID");

        $searchParam = "%" . $search . "%";
        $stmt->bindParam(':search', $searchParam);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        $stmt->execute(); // Execute the prepared statement

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function getAllSale()
{
    $conn = get_connection();

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM vw_all_sales");

        $stmt->execute(); // Execute the prepared statement

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function getGrandTotalSale()
{
    $conn = get_connection();

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT SUM(TotalAmount) as grand_total FROM vw_all_sales");

        $stmt->execute(); // Execute the prepared statement

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['grand_total'] ?? 0; // Return the grand total or 0 if no result
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return 0; // Return 0 in case of an error
    }
}


function getUserSale($userID)
{
    $conn = get_connection();

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT s.*, p.ProductName, c.CustomerName, u.UserName 
        FROM sales s JOIN customers c ON s.CustomerID = c.CustomerID
        JOIN users u ON s.UserID = u.UserID
        JOIN products p ON s.ProductID = p.ProductID WHERE u.UserID = :userID Order by s.SaleID");

        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute(); // Execute the prepared statement

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}

function getProductIDByName($productname) {
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT ProductID FROM products WHERE ProductName = :productname");
        $stmt->bindParam(':productname', $productname);
        $stmt->execute();

        // Fetch the data
        $productID = $stmt->fetch(PDO::FETCH_COLUMN);

        return $productID;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}

function getCustomerIDByName($customername) {
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT CustomerID FROM customers WHERE CustomerName = :customername");
        $stmt->bindParam(':customername', $customername);
        $stmt->execute();

        // Fetch the data
        $customerID = $stmt->fetch(PDO::FETCH_COLUMN);

        return $customerID;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return false; // Return false in case of an error
    }
}


// Function to get the current stock quantity for a product
function getCurrentStock($productID) {
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("SELECT StockQuantity FROM products WHERE ProductID = :productID");
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['StockQuantity'];
        } else {
            return 0; // Default to 0 if the product is not found (you might handle this differently)
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0; // Default to 0 in case of an error
    }
}

// // Function to update the stock quantity for a product
// function updateStockQuantity($productID, $quantityChange) {
//     $conn = get_connection();

//     try {
//         $stmt = $conn->prepare("UPDATE products SET StockQuantity = StockQuantity + :quantityChange WHERE ProductID = :productID");
//         $stmt->bindParam(':quantityChange', $quantityChange);
//         $stmt->bindParam(':productID', $productID);
//         $stmt->execute();

//         // You can add additional checks or error handling if needed

//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//         // Handle the error as needed
//     }
// }

function addSale($productID, $customerID, $quantity, $totalAmount, $userID) {
    $conn = get_connection();

    try {
        $conn->beginTransaction();

        // Check if there is enough stock
        $currentStock = getCurrentStock($productID);
        
        if ($currentStock >= $quantity) {
            // Deduct the sold quantity from the product stock
            // updateStockQuantity($productID, -$quantity);

            // Insert the sale into the sales table
            $stmt = $conn->prepare("INSERT INTO sales (ProductID, CustomerID, QuantitySold, TotalAmount, UserID) 
                                    VALUES (:productID, :customerID, :quantity, :totalAmount, :userID)");

            $stmt->bindParam(':productID', $productID);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':totalAmount', $totalAmount);
            $stmt->bindParam(':userID', $userID);

            $stmt->execute();

            $conn->commit();
            return true;
        } else {
            // Rollback the transaction if there's not enough stock
            $conn->rollBack();
            return false; // Return false to indicate insufficient stock
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getSaleBySaleID($saleID)
{
    $conn = get_connection(); 

    try {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT s.*, p.ProductName, c.CustomerName, u.UserName 
        FROM sales s 
        JOIN customers c ON s.CustomerID = c.CustomerID
        JOIN users u ON s.UserID = u.UserID
        JOIN products p ON s.ProductID = p.ProductID
        WHERE s.SaleID = :saleID");

        // Bind the SaleID parameter
        $stmt->bindParam(':saleID', $saleID);

        $stmt->execute(); // Execute the prepared statement

        $sale = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchAll

        // Close the database connection
        $conn = null;
        return $sale;
    } catch (PDOException $e) {
        // Handle the exception, such as logging or displaying an error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}


// // Function to update an existing sale
// function updateSale($saleID, $productID, $customerID, $quantity, $totalAmount, $userID) {
//     $conn = get_connection();

//     try {
//         $conn->beginTransaction();

//         // Continue with the sale update
//         $stmt = $conn->prepare("UPDATE sales 
//                                SET ProductID = :productID, 
//                                    CustomerID = :customerID, 
//                                    QuantitySold = :quantity, 
//                                    TotalAmount = :totalAmount, 
//                                    UserID = :userID 
//                                WHERE SaleID = :saleID");

//         $stmt->bindParam(':saleID', $saleID);
//         $stmt->bindParam(':productID', $productID);
//         $stmt->bindParam(':customerID', $customerID);
//         $stmt->bindParam(':quantity', $quantity);
//         $stmt->bindParam(':totalAmount', $totalAmount);
//         $stmt->bindParam(':userID', $userID);

//         $stmt->execute();

//         $conn->commit();
//         return true;
//     } catch (PDOException $e) {
//         // Handle other PDO exceptions
//         echo "Error: " . $e->getMessage();
//     }
// }


// Function to update an existing sale
function updateSale($saleID, $productID, $customerID, $quantity, $totalAmount, $userID) {
    $conn = get_connection();

    try {
        $conn->beginTransaction();

        // Get existing sale information
        $existingSale = getSaleBySaleID($saleID);
        $existingProductID = $existingSale['ProductID'];
        $existingQuantity = $existingSale['QuantitySold'];

        // Check if the product or quantity has changed
        if ($productID != $existingProductID || $quantity != $existingQuantity) {
            // If the product or quantity has changed, update the stock quantity

            // Check if there is enough stock for the new quantity
            $currentStock = getCurrentStock($productID);

            if ($currentStock < $quantity) {
                // Insufficient stock
                $conn->rollBack();
                return false;
            }

            // Update the sale record and handle stock quantity
            if (!updateSaleAndStock($conn, $saleID, $productID, $customerID, $quantity, $totalAmount, $userID, $existingProductID, $existingQuantity)) {
                $conn->rollBack();
                return false;
            }
        } else {
            // Continue with the sale update
            $stmt = $conn->prepare("UPDATE sales 
                                   SET ProductID = :productID, 
                                       CustomerID = :customerID, 
                                       QuantitySold = :quantity, 
                                       TotalAmount = :totalAmount, 
                                       UserID = :userID 
                                   WHERE SaleID = :saleID");

            $stmt->bindParam(':saleID', $saleID);
            $stmt->bindParam(':productID', $productID);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':totalAmount', $totalAmount);
            $stmt->bindParam(':userID', $userID);

            $stmt->execute();

            $conn->commit();
            return true;
        }
    } catch (PDOException $e) {
        // Handle other PDO exceptions
        echo "Error: " . $e->getMessage();
    }
}

// Function to update sale record and handle stock quantity
function updateSaleAndStock($conn, $saleID, $productID, $customerID, $quantity, $totalAmount, $userID, $existingProductID, $existingQuantity) {
    try {
        $updateSaleQuery = "UPDATE sales 
                            SET ProductID = :productID, 
                                CustomerID = :customerID, 
                                QuantitySold = :quantity, 
                                TotalAmount = :totalAmount, 
                                UserID = :userID 
                            WHERE SaleID = :saleID";

        $stmt = $conn->prepare($updateSaleQuery);
        $stmt->bindParam(':saleID', $saleID);
        $stmt->bindParam(':productID', $productID);
        $stmt->bindParam(':customerID', $customerID);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':totalAmount', $totalAmount);
        $stmt->bindParam(':userID', $userID);

        $stmt->execute();

        $conn->commit(); // Commit the transaction if successful

        // Deduct the new quantity from the stock
        updateStockQuantity($productID, -$quantity);
        // Add back the existing quantity to the stock for the old product
        updateStockQuantity($existingProductID, $existingQuantity);

        return true;
    } catch (Exception $e) {
        // Update failed, restore the previous quantity to the stock
        updateStockQuantity($productID, $existingQuantity);
        return false;
    }
}
// Function to update the stock quantity for a product
function updateStockQuantity($productID, $quantityChange) {
    $conn = get_connection();

    try {
        $stmt = $conn->prepare("UPDATE products SET StockQuantity = StockQuantity + :quantityChange WHERE ProductID = :productID");
        $stmt->bindParam(':quantityChange', $quantityChange);
        $stmt->bindParam(':productID', $productID);
        $stmt->execute();

        // You can add additional checks or error handling if needed

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        // Handle the error as needed
    }
}
