<?php

session_start();

require '../inc/database.php';
require '../models/admin_account.php';
require '../models/admin_salaries.php';

$title = 'Salaries';
$account_info = getAccountInfo($conn);
$salaries = getEmployeeSalaries($conn);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require '../inc/head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>

<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">

        <?php require 'partials/header.php'; ?>
        <div class="container mt-4 px-5">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">   
                            <h4 class="mb-0">Employee Salaries</h4>
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addSalaryModal">
                                <i class="bi bi-plus-circle"></i> Add Salary
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="salariesTable" class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Employee Name</th>
                                            <th>Salary Period</th>
                                            <th>Present Days</th>
                                            <th>Absent Days</th>
                                            <th>Overtime Hours</th>
                                            <th>Total Salary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $row_number = 1; // Initialize row counter
                                        foreach ($salaries as $salary):
                                        ?>
                                            <tr>
                                                <td><?= $row_number ?></td>
                                                <td><?= htmlspecialchars($salary['employee_name']) ?></td>
                                                <td>
                                                    <?php
                                                    $date = DateTime::createFromFormat('Y-m', $salary['salary_period']);
                                                    echo $date ? $date->format('F Y') : htmlspecialchars($salary['salary_period']);
                                                    ?>
                                                </td>
                                                <td><?= htmlspecialchars($salary['present_days']) ?></td>
                                                <td><?= htmlspecialchars($salary['absent_days']) ?></td>
                                                <td><?= htmlspecialchars($salary['overtime_hours']) ?></td>
                                                <td>₱<?= number_format($salary['total_salary'], 2) ?></td>
                                                <td>
                                                    <!-- Delete Form -->
                                                    <form action="../controllers/admin_delete_salary.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="salary_id" value="<?= $salary['salary_id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                            $row_number++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_logout.js"></script>
    <script src="../public/js/admin_datatables.js"></script>
</body>

</html>