<?php
require '../inc/database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : NULL;
    $address = !empty($_POST['address']) ? $_POST['address'] : NULL;

    // Prepare SQL Query
    $sql = "INSERT INTO customers (name, phone, address) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $phone, $address);

    if ($stmt->execute()) {
        header("Location: ../admin/customers.php?success=1");
        exit();
    } else {
        header("Location: ../admin/customers.php?error=1");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
