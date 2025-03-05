<?php
require '../inc/database.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['category_id'], $_POST['category_name'])) {
    $category_id = intval($_POST['category_id']);
    $category_name = trim($_POST['category_name']);

    // Validate input
    if ($category_id > 0 && !empty($category_name)) {
        // Prepare and execute update query
        $stmt = $conn->prepare("UPDATE transaction_categories SET category_name = ? WHERE category_id = ?");
        $stmt->bind_param("si", $category_name, $category_id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: ../admin/transaction_categories.php?success=Category updated successfully");
            exit;
        } else {
            $stmt->close();
            $conn->close();
            header("Location: ../admin/transaction_categories.php?error=Failed to update category");
            exit;
        }
    } else {
        header("Location: ../admin/transaction_categories.php?error=Invalid category data");
        exit;
    }
} else {
    header("Location: ../admin/transaction_categories.php?error=Invalid request");
    exit;
}
?>
