<?php
session_start();
require '../inc/database.php';
require '../models/admin_materials.php';
require '../models/admin_account.php';

$title = 'Materials';
$materials = getMaterialsWithCategory($conn);
$categories = getMaterialCategories($conn);
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
                            <table id="materialsDataTable" class="table table-bordered table-hover text-xs">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Material Name</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="materials-table">
                                    <?php if (!empty($materials)): ?>
                                        <?php foreach ($materials as $material): ?>
                                            <tr data-category="<?= htmlspecialchars($material['category_name']) ?>">
                                                <td><?= htmlspecialchars($material['material_id']) ?></td>
                                                <td><?= htmlspecialchars($material['name']) ?></td>
                                                <td><?= htmlspecialchars($material['description']) ?></td>
                                                <td>₱<?= number_format($material['amount'], 2) ?></td>
                                                <td><?= htmlspecialchars($material['quantity']) ?></td>
                                                <td>₱<?= number_format($material['total_price'], 2) ?></td>
                                                <td><?= date('F j, Y', strtotime($material['created_at'])) ?></td>
                                                <td>
                                                    <!-- Edit Button (Triggers Modal) -->
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $material['material_id'] ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>

                                                    <!-- Delete Form -->
                                                    <form action="../controllers/admin_delete_material.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="material_id" value="<?= $material['material_id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <?php require 'partials/modal_update_material.php'; ?>
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

    <?php require 'partials/modal_add_material.php'; ?>

    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_logout.js"></script>
    <script src="../public/js/admin_materials.js"></script>
</body>

</html>