<?php
session_start();

require '../inc/database.php';
require '../models/admin_transactions.php';

$title = 'Transaction Categories';

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
                            <li class="breadcrumb-item active" aria-current="page">Transaction Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Transaction Categories</h5>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($transaction_categories)) : ?>
                                        <?php foreach ($transaction_categories as $index => $category) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars($category['category_name']) ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No categories found.</td>
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

    <?php require '../inc/javascripts.php'; ?>
</body>

</html>