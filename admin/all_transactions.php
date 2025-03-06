<?php
session_start();

require '../inc/database.php';
require '../models/admin_transactions.php';
require '../models/admin_account.php';
require '../models/admin_customers.php';

$title = 'All Transactions';
$account_info = getAccountInfo($conn);
$transactions = getAllTransactions($conn);
$customers = getCustomersSortedByName($conn);
$transaction_categories = getTransactionCategories($conn);

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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Project Transactions</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">All Transactions</h5>
                            <div>
                                <a href="transaction_categories.php" class="btn btn-light btn-sm">
                                    <i class="bi bi-box-arrow-up-right"></i> Categories
                                </a>
                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                                    <i class="bi bi-plus-circle"></i> Add Transaction
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="transactionsTable" class="table text-xs">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction Date</th>
                                        <th>Customer</th>
                                        <th>Team Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Design</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th>Downpayment</th>
                                        <th>Payable</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($transactions)) : ?>
                                        <?php foreach ($transactions as $index => $transaction) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars(date('F j, Y', strtotime($transaction['transaction_date']))) ?></td>
                                                <td><?= htmlspecialchars($transaction['customer_name']) ?></td>
                                                <td><?= htmlspecialchars($transaction['team_name']) ?></td>
                                                <td><?= htmlspecialchars($transaction['category_name']) ?></td>
                                                <td><?= htmlspecialchars($transaction['description']) ?></td>
                                                <td>
                                                    <?php if (isset($transaction['design_file']) && !empty($transaction['design_file'])): ?>
                                                        <span class="design-hoverable"
                                                            data-bs-toggle="popover"
                                                            data-bs-trigger="hover focus"
                                                            data-bs-html="true"
                                                            data-bs-content="<img src='<?= htmlspecialchars($transaction['design_file']) ?>' width='1000px' class='img-fluid'>">
                                                            <a href="">Available</a>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-muted">Unavailable</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($transaction['quantity']) ?></td>
                                                <td><?= number_format($transaction['amount'], 2) ?></td>
                                                <td><?= number_format($transaction['total'], 2) ?></td>
                                                <td><?= number_format($transaction['downpayment'], 2) ?></td>
                                                <td><?= number_format($transaction['payable'], 2) ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#editTransactionModal<?= $transaction['project_transaction_id'] ?>">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <form action="../controllers/admin_delete_transaction.php" method="POST" style="display:inline;">
                                                        <input type="hidden" name="transaction_id" value="<?= $transaction['project_transaction_id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Are you sure you want to delete this transaction?');">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#addDownpaymentModal<?= $transaction['project_transaction_id'] ?>">
                                                        <i class="bi bi-cash-stack"></i> Add Downpayment
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php require 'partials/modal_add_downpayment.php'; ?>
                                            <?php require 'partials/modal_update_transaction.php'; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransactionModalLabel">Add New Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTransactionForm" method="POST" action="../controllers/admin_add_transaction.php">
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Transaction Date</label>
                            <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Customer</label>
                            <select class="form-select" id="customer_id" name="customer_id" required>
                                <option value="" disabled selected>Select Customer</option>
                                <?php foreach ($customers as $customer): ?>
                                    <option value="<?= $customer['customer_id'] ?>"><?= htmlspecialchars($customer['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="team_name" class="form-label">Team Name</label>
                            <input type="text" class="form-control" id="team_name" name="team_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" disabled selected>Select Category</option>
                                <?php foreach ($transaction_categories as $category): ?>
                                    <option value="<?= $category['category_id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>

                        <div class="mb-3">
                            <label for="design_file" class="form-label">Design File</label>
                            <input type="file" class="form-control" id="design_file" name="design_file">
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="downpayment" class="form-label">Downpayment</label>
                            <input type="number" step="0.01" class="form-control" id="downpayment" name="downpayment" value="0.00">
                        </div>

                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="datetime-local" class="form-control" id="due_date" name="due_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/admin_datatables.js"></script>
    <script src="../public/js/admin_all_transactions.js"></script>
    <script src="../public/js/admin_all_transactions.js"></script>
</body>

</html>