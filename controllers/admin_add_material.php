<?php
require '../inc/database.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize input
    $name = trim($_POST['name']);
    $category_id = intval($_POST['category_id']);
    $description = trim($_POST['description']);
    $amount = floatval($_POST['amount']);
    $quantity = floatval($_POST['quantity']);
    $supplier = trim($_POST['supplier']);
    $total_price = $amount * $quantity; // Calculate total price

    // Validate required fields
    if (empty($name) || empty($category_id) || empty($description) || $amount <= 0 || $quantity <= 0 || empty($supplier)) {
        header("Location: ../admin/materials.php");
        exit();
    }

    // Prepare SQL statement to insert the material
    $sql = "INSERT INTO materials (category_id, name, description, amount, quantity, total_price, supplier) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issddds", $category_id, $name, $description, $amount, $quantity, $total_price, $supplier);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    header("Location: ../admin/materials.php"); // Redirect back to materials list
    exit();
}
?>
