<?php
session_start();
require '../inc/database.php';
require '../models/admin_other_expenses.php';
require '../models/admin_account.php';

$title = 'Other Expenses';
$account_info = getAccountInfo($conn);
$other_expenses = getExpenses($conn);
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
                            <h4 class="mb-0">Other Expenses</h4>
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addOtherExpenseModal">
                                <i class="bi bi-plus-circle"></i> Add Expense
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="expensesTable" class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Amount</th>
                                        <th>Expense Date</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row_number = 1; // Initialize row number
                                    foreach ($other_expenses as $expense):
                                    ?>
                                        <tr>
                                            <td><?= $row_number ?></td> <!-- Row Number -->
                                            <td>₱<?= number_format($expense['amount'], 2) ?></td>
                                            <td><?= date("F j, Y", strtotime($expense['expense_date'])) ?></td>
                                            <td><?= htmlspecialchars($expense['description']) ?></td>
                                            <td>
                                                <form action="../controllers/admin_delete_other_expenses.php" method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                                    <input type="hidden" name="expense_id" value="<?= $expense['expense_id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                        $row_number++; // Increment row number
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

    <div class="modal fade" id="addOtherExpenseModal" tabindex="-1" aria-labelledby="addOtherExpenseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOtherExpenseLabel">Add New Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/admin_add_other_expenses.php" method="POST">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount (₱)</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_logout.js"></script>
    <script src="../public/js/admin_datatables.js"></script>

</body>

</html>