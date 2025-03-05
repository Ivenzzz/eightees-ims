<?php
require '../inc/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['category_id'])) {
    $category_id = intval($_POST['category_id']);

    // Ensure a valid ID is provided
    if ($category_id > 0) {
        // Prepare DELETE query
        $stmt = $conn->prepare("DELETE FROM transaction_categories WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: ../admin/transaction_categories.php?success=Category deleted successfully");
            exit;
        } else {
            $stmt->close();
            $conn->close();
            header("Location: ../admin/transaction_categories.php?error=Failed to delete category");
            exit;
        }
    } else {
        header("Location: ../admin/transaction_categories.php?error=Invalid category ID");
        exit;
    }
} else {
    header("Location: ../admin/transaction_categories.php?error=Invalid request");
    exit;
}
?>
