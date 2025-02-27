<?php
require '../inc/database.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_id'])) {
    $category_id = intval($_POST['category_id']); // Convert to integer for security

    // Prepare DELETE statement
    $stmt = $conn->prepare("DELETE FROM material_categories WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);

    if ($stmt->execute()) {
        header("Location: ../admin/material_categories.php?success=Category deleted successfully");
    } else {
        header("Location: ../admin/material_categories.php?error=Failed to delete category");
    }

    $stmt->close();
    $conn->close();
    exit();
} else {
    // Invalid request
    header("Location: ../admin/material_categories.php?error=Invalid request");
    exit();
}
