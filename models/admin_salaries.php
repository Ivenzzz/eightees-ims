<?php
function getEmployeeSalaries($conn) {
    $salaries = [];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM employee_salaries ORDER BY salary_id DESC");
    $stmt->execute();
    
    // Get the result set
    $result = $stmt->get_result();

    // Fetch data
    while ($row = $result->fetch_assoc()) {
        $salaries[] = $row;
    }

    // Close statement
    $stmt->close();

    return $salaries;
}

?>
