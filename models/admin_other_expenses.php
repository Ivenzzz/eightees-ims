<?php
function getExpenses($conn) {
    $sql = "SELECT * FROM expenses ORDER BY expense_id DESC";
    $result = $conn->query($sql);

    $expenses = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $expenses[] = $row;
        }
    }
    return $expenses;
}
?>
