<?php
session_start();

$title = 'Customer\'s Transactions';

require '../inc/database.php';
require '../models/admin_account.php';
require '../models/admin_customers.php';
require '../models/admin_transactions.php';

$account_info = getAccountInfo($conn);
$customer_id = $_GET['customer_id'] ?? null;
$transaction_categories = getTransactionCategories($conn);

if ($customer_id) {
    $customer_transactions = getTransactionsByCustomerId($conn, $customer_id);
} else {
    die("Invalid customer ID.");
}
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

            <!-- Breadcrumb -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="customers.php">Customers</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><?= htmlspecialchars($customer_transactions[0]['customer_name'] ?? 'Customer') ?>'s Transactions</h5>
                    <div>
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                            <i class="bi bi-plus-circle"></i> Add Transaction
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="customersTransactionsTable" class="table text-xs">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
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
                                <?php if (!empty($customer_transactions)) : ?>
                                    <?php foreach ($customer_transactions as $index => $transaction) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars(date('F j, Y', strtotime($transaction['transaction_date']))) ?></td>
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
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <form action="../controllers/admin_delete_transaction.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="transaction_id" value="<?= $transaction['project_transaction_id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Are you sure you want to delete this transaction?');">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                <button class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#addDownpaymentModal<?= $transaction['project_transaction_id'] ?>"><i class="bi bi-cash-stack"></i>Add Downpayment</button>
                                            </td>
                                        </tr>
                                        <?php require 'partials/modal_add_downpayment.php'; ?>
                                        <?php require 'partials/modal_update_transaction.php'; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No transactions found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_logout.js"></script>
    <script src="../public/js/admin_datatables.js"></script>
    <script src="../public/js/admin_all_transactions.js"></script>
</body>

</html>