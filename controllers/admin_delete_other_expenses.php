<?php
session_start();
require '../inc/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expense_id'])) {
    $expense_id = intval($_POST['expense_id']); // Sanitize input

    // Prepare DELETE statement
    $stmt = $conn->prepare("DELETE FROM expenses WHERE expense_id = ?");
    $stmt->bind_param("i", $expense_id);

    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect back to expenses page
    header("Location: ../admin/other_expenses.php");
    exit();
} else {
    // Redirect if request is invalid
    header("Location: ../admin/other_expenses.php");
    exit();
}
