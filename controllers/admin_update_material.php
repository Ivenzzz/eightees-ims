<?php
require '../inc/database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $material_id = intval($_POST['material_id']);
    $category_id = intval($_POST['category_id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $amount = floatval($_POST['amount']);
    $quantity = floatval($_POST['quantity']);
    $supplier = trim($_POST['supplier']);

    // Calculate total price
    $total_price = $amount * $quantity;

    try {
        // Prepare update statement
        $sql = "UPDATE materials 
                SET category_id = ?, name = ?, description = ?, amount = ?, quantity = ?, total_price = ?, supplier = ?, updated_at = NOW() 
                WHERE material_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issdddsi", $category_id, $name, $description, $amount, $quantity, $total_price, $supplier, $material_id);

        if ($stmt->execute()) {
            $message = "Material updated successfully.";
        } else {
            $message = "Failed to update material.";
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }

    // Redirect back to materials page with a message parameter
    header("Location: ../admin/materials.php?message=" . urlencode($message));
    exit();
} else {
    // Redirect if accessed directly
    header("Location: ../admin/materials.php");
    exit();
}
?>
