<?php
require '../inc/database.php'; // Ensure this path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['customer_id'])) {
        $customer_id = $_POST['customer_id'];

        // Prepare SQL Query
        $sql = "DELETE FROM customers WHERE customer_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customer_id);

        if ($stmt->execute()) {
            header("Location: ../admin/customers.php?deleted=1");
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
