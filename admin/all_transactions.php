<?php
session_start();

require '../inc/database.php';
require '../models/admin_transactions.php';

$title = 'All Transactions';
$transactions = getAllTransactions($conn);
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
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">All Transactions</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="transactionsTable" class="table table-bordered table-hover text-xs">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction Date</th>
                                            <th>Customer</th>
                                            <th>Team Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Total</th>
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
                                                    <td><?= htmlspecialchars($transaction['quantity']) ?></td>
                                                    <td><?= number_format($transaction['amount'], 2) ?></td>
                                                    <td><?= number_format($transaction['total'], 2) ?></td>
                                                    <td><?= number_format($transaction['payable'], 2) ?></td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm mb-2">
                                                            <i class="bi bi-pencil-square"></i> <!-- Edit Icon -->
                                                        </button>
                                                        <form action="../controllers/admin_delete_transaction.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="transaction_id" value="<?= $transaction['project_transaction_id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Are you sure you want to delete this transaction?');">
                                                                <i class="bi bi-trash"></i> <!-- Delete Icon -->
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
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
    </div>

    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/admin_datatables.js"></script>
</body>

</html>
