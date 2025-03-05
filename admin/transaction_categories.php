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
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Transaction Categories</h5>
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="bi bi-plus-circle"></i> Add Category
                            </button>
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
                                                    <!-- Edit Button (Triggers Modal) -->
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?= $category['category_id'] ?>">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>

                                                    <!-- Delete Form -->
                                                    <form action="../controllers/admin_delete_transaction_category.php" method="POST" style="display:inline;">
                                                        <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Category Modal -->
                                            <div class="modal fade" id="editCategoryModal<?= $category['category_id'] ?>" tabindex="-1" aria-labelledby="editCategoryLabel<?= $category['category_id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCategoryLabel<?= $category['category_id'] ?>">Edit Category</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="../controllers/admin_update_transaction_category.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="categoryName<?= $category['category_id'] ?>" class="form-label">Category Name</label>
                                                                    <input type="text" class="form-control" id="categoryName<?= $category['category_id'] ?>" name="category_name" value="<?= htmlspecialchars($category['category_name']) ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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

    <?php require 'partials/modal_add_transaction_category.php'; ?>


    <?php require '../inc/javascripts.php'; ?>
</body>

</html>