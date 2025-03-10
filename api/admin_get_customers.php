<?php
require '../inc/database.php'; // Include database connection

$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT customer_id, name FROM customers WHERE name LIKE ? LIMIT 10";
$stmt = $conn->prepare($query);
$searchTerm = "%$search%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();

$result = $stmt->get_result();
$customers = [];

while ($row = $result->fetch_assoc()) {
    $customers[] = $row;
}

echo json_encode($customers);

$stmt->close();
$conn->close();
?>
