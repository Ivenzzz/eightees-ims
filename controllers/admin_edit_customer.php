<?php
require '../inc/database.php'; // Ensure correct path

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['customer_id']) && !empty($_POST['name'])) {
        $customer_id = $_POST['customer_id'];
        $name = $_POST['name'];
        $phone = !empty($_POST['phone']) ? $_POST['phone'] : NULL;
        $address = !empty($_POST['address']) ? $_POST['address'] : NULL;

        // Prepare SQL Query
        $sql = "UPDATE customers SET name = ?, phone = ?, address = ?, updated_at = NOW() WHERE customer_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $phone, $address, $customer_id);

        if ($stmt->execute()) {
            header("Location: ../admin/customers.php?updated=1");
            exit();
        } else {
            header("Location: ../admin/customers.php?error=1");
            exit();
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: ../admin/customers.php?error=1");
        exit();
    }
}
?>
