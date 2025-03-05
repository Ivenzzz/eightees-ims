<?php

function getAllTransactions($conn)
{
    $transactions = [];
    $sql = "SELECT pt.*, c.name AS customer_name, tc.category_name 
            FROM project_transactions pt
            JOIN customers c ON pt.customer_id = c.customer_id
            JOIN transaction_categories tc ON pt.category_id = tc.category_id
            ORDER BY pt.transaction_date DESC";

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $transactions[] = $row;
        }
        $result->free();
    } else {
        echo "Error: " . $conn->error;
    }

    return $transactions;
}

function getTransactionCategories($conn)
{
    $categories = [];
    $sql = "SELECT category_id, category_name FROM transaction_categories ORDER BY category_id DESC";

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        $result->free(); // Free result set
    } else {
        echo "Error: " . $conn->error;
    }

    return $categories;
}
