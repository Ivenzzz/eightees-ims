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
?>
