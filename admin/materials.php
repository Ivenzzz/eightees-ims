<?php
session_start();
require '../inc/database.php';
require '../models/admin_materials.php';
require '../models/admin_account.php';

$title = 'Materials';
$materials = getMaterialsWithCategory($conn);
$categories = getMaterialCategories($conn); // Fetch all categories
$account_info = getAccountInfo($conn);


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
                            <li class="breadcrumb-item active" aria-current="page">Materials</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Materials Table -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow rounded">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Materials List</h5>
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                                <i class="bi bi-plus-circle"></i> Add Material
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-xs">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Material Name</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Supplier</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="materials-table">
                                    <?php if (!empty($materials)): ?>
                                        <?php foreach ($materials as $material): ?>
                                            <tr data-category="<?= htmlspecialchars($material['category_name']) ?>">
                                                <td><?= htmlspecialchars($material['material_id']) ?></td>
                                                <td><?= htmlspecialchars($material['name']) ?></td>
                                                <td><?= htmlspecialchars($material['category_name']) ?></td>
                                                <td>₱<?= number_format($material['amount'], 2) ?></td>
                                                <td><?= htmlspecialchars($material['quantity']) ?></td>
                                                <td>₱<?= number_format($material['total_price'], 2) ?></td>
                                                <td><?= htmlspecialchars($material['supplier']) ?></td>
                                                <td>
                                                    <a href="edit_material.php?id=<?= $material['material_id'] ?>" class="btn btn-warning btn-sm">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="delete_material.php?id=<?= $material['material_id'] ?>" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this material?');">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No materials found.</td>
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

    <!-- Add Material Modal -->
    <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-sm">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addMaterialModalLabel">
                        <i class="bi bi-plus-circle"></i> Add New Material
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMaterialForm" action="add_material.php" method="POST">
                        <div class="mb-4">
                            <label for="materialName" class="form-label">
                                <i class="bi bi-tag"></i> Material Name
                            </label>
                            <input type="text" class="form-control" id="materialName" name="name" required>
                        </div>
                        <div class="mb-4">
                            <label for="category" class="form-label">
                                <i class="bi bi-list-ul"></i> Category
                            </label>
                            <select class="form-select" id="category" name="category_id" required>
                                <option value="" selected disabled>Select Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['category_id']) ?>">
                                        <?= htmlspecialchars($category['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="bi bi-file-text"></i> Description
                            </label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="form-label">
                                <i class="bi bi-currency-dollar"></i> Amount (₱)
                            </label>
                            <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="form-label">
                                <i class="bi bi-box"></i> Quantity
                            </label>
                            <input type="number" class="form-control" id="quantity" name="quantity" step="0.01" required>
                        </div>
                        <div class="mb-4">
                            <label for="supplier" class="form-label">
                                <i class="bi bi-truck"></i> Supplier
                            </label>
                            <input type="text" class="form-control" id="supplier" name="supplier" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Add Material
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_logout.js"></script>
</body>

</html>