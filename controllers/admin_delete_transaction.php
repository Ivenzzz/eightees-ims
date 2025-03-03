<?php
require '../inc/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['transaction_id'])) {
    $transaction_id = $_POST['transaction_id'];

    // Prepare DELETE statement
    $sql = "DELETE FROM project_transactions WHERE project_transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transaction_id);

    $stmt->execute();
    
    $stmt->close();
    $conn->close();

    // Redirect back to the transactions page
    header("Location: ../admin/all_transactions.php");
    exit();
} else {
    header("Location: ../admin/all_transactions.php");
    exit();
}
