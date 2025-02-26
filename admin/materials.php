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
    <style>
        .category-toggle {
            padding: 0.2rem 0.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            user-select: none;
            font-weight: bold;
        }
        .category-checked {
            background-color: #0284c7; /* Bootstrap Primary */
            color: white;
        }
        .category-unchecked {
            background-color: #6c757d; /* Bootstrap Secondary */
            color: white;
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
                            <li class="breadcrumb-item active" aria-current="page">Materials</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12 d-flex flex-wrap gap-2">
                    <?php foreach ($categories as $category): ?>
                        <div class="category-toggle category-checked" 
                             data-category="<?= htmlspecialchars($category['category_name']) ?>">
                            <?= htmlspecialchars($category['category_name']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Materials Table -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow rounded">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Materials List</h5>
                            <a href="add_material.php" class="btn btn-light btn-sm">Add Material</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-xs">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Material Name</th>
                                        <th>Category</th>
                                        <th>Unit</th>
                                        <th>Price/Unit</th>
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
                                                <td><?= htmlspecialchars($material['unit']) ?></td>
                                                <td>₱<?= number_format($material['price_per_unit'], 2) ?></td>
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

    <?php require '../inc/javascripts.php'; ?>

    <script>
        $(document).ready(function() {
            $(".category-toggle").click(function() {
                let category = $(this).data("category");

                // Toggle class to change color
                $(this).toggleClass("category-checked category-unchecked");

                // Get currently active categories
                let activeCategories = $(".category-checked").map(function() {
                    return $(this).data("category");
                }).get();

                // Show or hide table rows
                $("#materials-table tr").each(function() {
                    let materialCategory = $(this).data("category");
                    if (activeCategories.includes(materialCategory)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
