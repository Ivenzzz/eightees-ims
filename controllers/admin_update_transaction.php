<?php
require '../inc/database.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];
    $team_name = trim($_POST['team_name']);
    $category_id = intval($_POST['category_id']);
    $description = trim($_POST['description']);
    $quantity = intval($_POST['quantity']);
    $amount = floatval($_POST['amount']);
    $downpayment = isset($_POST['downpayment']) ? floatval($_POST['downpayment']) : 0.00;

    // Calculate total and payable amounts
    $total = $quantity * $amount;
    $payable = max(0, $total - $downpayment); // Ensure payable is not negative

    $upload_dir = '/eightees_ims/storage/uploads/';
    $design_file = null;

    if (!empty($_FILES['design_file']['name'])) {
        $file_tmp = $_FILES['design_file']['tmp_name'];
        $file_name = basename($_FILES['design_file']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'pdf', 'ai', 'eps'];

        if (in_array($file_ext, $allowed_exts)) {
            $new_file_name = uniqid('design_', true) . '.' . $file_ext;
            $file_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'] . $file_path)) {
                $design_file = $file_path;
            } else {
                die('Error uploading file.');
            }
        } else {
            die('Invalid file type. Allowed types: jpg, jpeg, png, pdf, ai, eps.');
        }
    }

    // Prepare SQL statement
    if ($design_file) {
        $sql = "UPDATE project_transactions 
                SET team_name=?, category_id=?, description=?, quantity=?, amount=?, downpayment=?, total=?, payable=?, design_file=?, updated_at=NOW() 
                WHERE project_transaction_id=?";
    } else {
        $sql = "UPDATE project_transactions 
                SET team_name=?, category_id=?, description=?, quantity=?, amount=?, downpayment=?, total=?, payable=?, updated_at=NOW() 
                WHERE project_transaction_id=?";
    }

    if ($stmt = $conn->prepare($sql)) {
        if ($design_file) {
            $stmt->bind_param("sisiddddsi", $team_name, $category_id, $description, $quantity, $amount, $downpayment, $total, $payable, $design_file, $transaction_id);
        } else {
            $stmt->bind_param("sisiddddi", $team_name, $category_id, $description, $quantity, $amount, $downpayment, $total, $payable, $transaction_id);
        }

        if ($stmt->execute()) {
            header("Location: ../admin/all_transactions.php?success=Transaction updated successfully");
            exit();
        } else {
            die("Error updating record: " . $stmt->error);
        }
    } else {
        die("Database error: " . $conn->error);
    }
}
?>
