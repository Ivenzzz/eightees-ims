<?php

session_start();

$title = 'Admin Dashboard';

require '../inc/database.php';
require '../models/admin_account.php';
require '../models/admin_customers.php';

$account_info = getAccountInfo($conn);
$customers = getCustomers($conn);

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
                            <li class="breadcrumb-item active" aria-current="page">Customers</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Customer List</h5>
                            <button class="btn btn-light">
                                <i class="bi bi-person-plus"></i> Add Customer
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-sm">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($customers)) : ?>
                                            <?php foreach ($customers as $index => $customer) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= htmlspecialchars($customer['name']) ?></td>
                                                    <td><?= htmlspecialchars($customer['phone']) ?></td>
                                                    <td><?= htmlspecialchars($customer['address']) ?></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">View Orders</button>
                                                        <button class="btn btn-warning btn-sm">
                                                            <i class="bi bi-pencil-square"></i> <!-- Edit Icon -->
                                                        </button>
                                                        <button class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i> <!-- Delete Icon -->
                                                        </button>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No customers found.</td>
                                            </tr>
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
    <script src="../public/js/index_logout.js"></script>
</body>

</html>