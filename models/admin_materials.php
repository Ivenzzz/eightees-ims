<?php

function getMaterialCategories($conn) {
    $categories = [];
    $sql = "SELECT category_id, category_name FROM material_categories ORDER BY category_id DESC";
    
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        $result->free(); // Free result set
    } else {
        echo "Error: " . $conn->error;
    }
    
    return $categories;
}

function getMaterialsWithCategory($conn) {
    $sql = "SELECT m.*, 
                   c.category_name 
            FROM materials m
            JOIN material_categories c ON m.category_id = c.category_id
            ORDER BY m.material_id DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array
    } else {
        return []; // Return empty array if no materials found
    }
}
?>

