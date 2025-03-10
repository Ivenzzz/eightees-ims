<?php
require '../inc/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['transaction_id'])) {
    $transaction_id = $_POST['transaction_id'];

    // Get the previous page URL or set a default fallback
    $previous_page = $_SERVER['HTTP_REFERER'] ?? '../admin/all_transactions.php';

    // Prepare DELETE statement
    $sql = "DELETE FROM project_transactions WHERE project_transaction_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $transaction_id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: $previous_page?success=Transaction deleted successfully");
            exit();
        } else {
            $stmt->close();
            $conn->close();
            header("Location: $previous_page?error=Failed to delete transaction");
            exit();
        }
    } else {
        header("Location: $previous_page?error=Database error: " . urlencode($conn->error));
        exit();
    }
} else {
    $previous_page = $_SERVER['HTTP_REFERER'] ?? '../admin/all_transactions.php';
    header("Location: $previous_page?error=Invalid request");
    exit();
}
