<?php
require '../inc/database.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['material_id'])) {
    $material_id = intval($_POST['material_id']);

    // Prepare delete query
    $sql = "DELETE FROM materials WHERE material_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $material_id);

        if ($stmt->execute()) {
            // Redirect back with success message (optional)
            header("Location: ../admin/materials.php?status=deleted");
        } else {
            // Redirect back with error message (optional)
            header("Location: ../admin/materials.php?status=error");
        }

        $stmt->close();
    }
} else {
    // Redirect if accessed improperly
    header("Location: ../admin/materials.php");
}

$conn->close();
exit();
