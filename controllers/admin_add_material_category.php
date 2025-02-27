<?php
require '../inc/database.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = trim($_POST["category_name"]);

    // Validate input
    if (empty($category_name)) {
        header("Location: ../admin/material_categories.php?error=Category name is required");
        exit();
    }

    // Prepare and execute SQL query using MySQLi
    $stmt = $conn->prepare("INSERT INTO material_categories (category_name) VALUES (?)");
    $stmt->bind_param("s", $category_name);

    if ($stmt->execute()) {
        header("Location: ../admin/material_categories.php?success=Category added successfully");
    } else {
        header("Location: ../admin/material_categories.php?error=Database error");
    }

    $stmt->close();
    $conn->close();
    exit();
} else {
    // Invalid request
    header("Location: ../admin/material_categories.php?error=Invalid request");
    exit();
}
