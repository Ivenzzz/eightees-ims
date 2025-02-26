<?php
function getAccountInfo($conn) {
    // Check if session account_id exists
    if (!isset($_SESSION['account_id'])) {
        return null; // No user logged in
    }

    $account_id = $_SESSION['account_id'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT account_id, username, role, profile_pic, created_at FROM accounts WHERE account_id = ?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch and return account details
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null; // Account not found
    }
}
?>
