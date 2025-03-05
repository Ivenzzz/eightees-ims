<?php
require '../inc/database.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = trim($_POST['category_name']);

    if (!empty($category_name)) {
        $stmt = $conn->prepare("INSERT INTO transaction_categories (category_name) VALUES (?)");
        $stmt->bind_param("s", $category_name);

        if ($stmt->execute()) {
            header("Location: ../admin/transaction_categories.php?success=Category added successfully");
        } else {
            header("Location: ../admin/transaction_categories.php?error=Failed to add category");
        }

        $stmt->close();
    } else {
        header("Location: ../admin/transaction_categories.php?error=Category name cannot be empty");
    }
}

$conn->close();
?>
