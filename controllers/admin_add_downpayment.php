<?php
require '../inc/database.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];
    $new_downpayment = floatval($_POST['new_downpayment']); // Ensure the input is a valid float

    // Get previous page URL or set a default fallback
    $previous_page = $_SERVER['HTTP_REFERER'] ?? '../admin/all_transactions.php';

    if ($transaction_id && $new_downpayment > 0) {
        // Fetch current downpayment, total, and payable amount
        $stmt = $conn->prepare("SELECT downpayment, total, payable FROM project_transactions WHERE project_transaction_id = ?");
        $stmt->bind_param("i", $transaction_id);
        $stmt->execute();
        $stmt->bind_result($current_downpayment, $total, $payable);
        $stmt->fetch();
        $stmt->close();

        if ($total !== null) { // Ensure transaction exists
            // Ensure downpayment does not exceed the remaining payable
            if ($new_downpayment > $payable) {
                $conn->close();
                header("Location: $previous_page?error=Downpayment cannot exceed the remaining balance.");
                exit();
            }

            $updated_downpayment = $current_downpayment + $new_downpayment;
            $new_payable = $total - $updated_downpayment; // Ensure payable is correct

            // Prepare SQL to update downpayment and payable
            $updateStmt = $conn->prepare("UPDATE project_transactions SET downpayment = ?, payable = ?, updated_at = NOW() WHERE project_transaction_id = ?");
            $updateStmt->bind_param("ddi", $updated_downpayment, $new_payable, $transaction_id);

            if ($updateStmt->execute()) {
                $updateStmt->close();
                $conn->close();
                header("Location: $previous_page?success=Downpayment updated successfully");
                exit();
            } else {
                $updateStmt->close();
                $conn->close();
                header("Location: $previous_page?error=Failed to update downpayment");
                exit();
            }
        } else {
            $conn->close();
            header("Location: $previous_page?error=Transaction not found");
            exit();
        }
    } else {
        header("Location: $previous_page?error=Invalid input");
        exit();
    }
} else {
    header("Location: ../admin/all_transactions.php");
    exit();
}
?>
