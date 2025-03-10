<?php
function getCustomers($conn) {
    $sql = "SELECT customer_id, name, phone, address, created_at FROM customers ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        return $customers;
    } else {
        return [];
    }
}

function getCustomersSortedByName($conn) {
    $sql = "SELECT customer_id, name, phone, address, created_at FROM customers ORDER BY name ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        return $customers;
    } else {
        return [];
    }
}

function getTransactionsByCustomerId($conn, $customer_id) {
    $sql = "SELECT pt.*, c.name AS customer_name, tc.category_name 
            FROM project_transactions pt
            JOIN customers c ON pt.customer_id = c.customer_id
            JOIN transaction_categories tc ON pt.category_id = tc.category_id
            WHERE pt.customer_id = ?
            ORDER BY pt.transaction_date DESC";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $transactions = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $transactions;
    } else {
        die("Database error: " . $conn->error);
    }
}

?>
