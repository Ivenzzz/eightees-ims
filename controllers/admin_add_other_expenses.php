<?php
require '../inc/database.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    if ($amount > 0 && !empty($description)) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO expenses (amount, description) VALUES (?, ?)");
        $stmt->bind_param("ds", $amount, $description);
        $stmt->execute();
        $stmt->close();
    }
    
    $conn->close();
}

// Redirect back to the expenses page
header("Location: ../admin/other_expenses.php");
exit();
