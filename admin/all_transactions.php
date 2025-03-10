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
    <style>
        #customer_list {
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
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

    <?php require 'partials/modal_add_transaction.php'; ?>

    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/admin_datatables.js"></script>
    <script src="../public/js/admin_all_transactions.js"></script>
    <script>
        document.getElementById("customer_search").addEventListener("input", function() {
            const searchValue = this.value.trim();
            const customerList = document.getElementById("customer_list");

            if (searchValue.length < 2) {
                customerList.innerHTML = ''; // Clear suggestions if input is too short
                return;
            }

            fetch(`../api/admin_get_customers.php?search=${encodeURIComponent(searchValue)}`)
                .then(response => response.json())
                .then(data => {
                    customerList.innerHTML = ''; // Clear previous suggestions

                    data.forEach(customer => {
                        const div = document.createElement("div");
                        div.classList.add("list-group-item", "list-group-item-action");
                        div.textContent = customer.name;
                        div.dataset.id = customer.customer_id;

                        // Handle customer selection
                        div.addEventListener("click", function() {
                            document.getElementById("customer_search").value = this.textContent;
                            document.getElementById("customer_id").value = this.dataset.id;
                            customerList.innerHTML = ''; // Hide the list after selection
                        });

                        customerList.appendChild(div);
                    });
                })
                .catch(error => console.error("Error fetching customers:", error));
        });

        // Hide suggestions when clicking outside
        document.addEventListener("click", function(event) {
            if (!document.getElementById("customer_search").contains(event.target)) {
                document.getElementById("customer_list").innerHTML = '';
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const now = new Date();
            const future = new Date(now);
            future.setDate(now.getDate() + 3); // Add 3 days for due date

            // Format date to YYYY-MM-DDTHH:MM for datetime-local input
            const formatDateTime = (date) => date.toISOString().slice(0, 16);

            document.getElementById("start_date").value = formatDateTime(now);
            document.getElementById("due_date").value = formatDateTime(future);
        });
    </script>
</body>

</html>