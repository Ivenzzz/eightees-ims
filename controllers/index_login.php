<?php
session_start();
require '../inc/database.php'; // Include database connection

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['username']) || !isset($data['password'])) {
        echo json_encode(["status" => "error", "message" => "Missing username or password"]);
        exit;
    }

    $username = trim($data['username']);
    $password = trim($data['password']);

    // Prepare SQL statement to fetch user
    $stmt = $conn->prepare("SELECT account_id, username, password FROM accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify user and password
    if ($user && password_verify($password, $user['password'])) {
        // Store session variables
        $_SESSION["account_id"] = $user["account_id"];
        $_SESSION["username"] = $user["username"];

        echo json_encode(["status" => "success", "message" => "Login successful"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username and password"]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
