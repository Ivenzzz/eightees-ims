<?php
require '../inc/database.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $transaction_date = $_POST['transaction_date'];
    $customer_id = intval($_POST['customer_id']);
    $team_name = trim($_POST['team_name']);
    $category_id = intval($_POST['category_id']);
    $description = trim($_POST['description'] ?? '');
    $quantity = intval($_POST['quantity']);
    $amount = floatval($_POST['amount']);
    $downpayment = isset($_POST['downpayment']) ? floatval($_POST['downpayment']) : 0.00;
    $start_date = $_POST['start_date'];
    $due_date = $_POST['due_date'];

    // Calculate total and payable amounts
    $total = $quantity * $amount;
    $payable = max(0, $total - $downpayment); // Ensure payable is not negative

    // File upload handling
    $upload_dir = '/eightees_ims/storage/uploads/';
    $design_file = null;

    if (!empty($_FILES['design_file']['name'])) {
        $file_tmp = $_FILES['design_file']['tmp_name'];
        $file_name = basename($_FILES['design_file']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'pdf', 'ai', 'eps', 'psd', 'svg'];

        if (in_array($file_ext, $allowed_exts)) {
            $new_file_name = uniqid('design_', true) . '.' . $file_ext;
            $file_path = $upload_dir . $new_file_name;

            // Move the uploaded file to the correct location
            if (move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'] . $file_path)) {
                $design_file = $file_path;
            } else {
                die('Error uploading file.');
            }
        } else {
            die('Invalid file type. Allowed types: jpg, jpeg, png, pdf, ai, eps, psd, svg.');
        }
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO project_transactions 
        (transaction_date, customer_id, team_name, category_id, description, design_file, quantity, amount, downpayment, total, payable, start_date, due_date, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

    $stmt->bind_param("sissssdddssss", 
        $transaction_date, $customer_id, $team_name, $category_id, 
        $description, $design_file, $quantity, $amount, $downpayment, 
        $total, $payable, $start_date, $due_date
    );

    if ($stmt->execute()) {
        // Redirect back with success message
        header("Location: ../admin/all_transactions.php?success=Transaction added successfully");
        exit();
    } else {
        die("Database error: " . $stmt->error);
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    die("Invalid request.");
}
?>
