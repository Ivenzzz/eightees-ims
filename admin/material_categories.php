<?php
session_start();

require '../inc/database.php';
require '../models/admin_materials.php';
require '../models/admin_account.php';

$title = 'Materials Categories';

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
                            <li class="breadcrumb-item"><a href="materials.php">Materials</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow rounded">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Category List</h5>
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="fa-solid fa-plus"></i> Add Category
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($category['category_id']) ?></td>
                                                <td><?= htmlspecialchars($category['category_name']) ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>

                                                    <!-- Delete Form -->
                                                    <form action="../controllers/admin_delete_material_category.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category? Deleting a category will also delete the materials under it.');">
                                                        <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No categories found.</td>
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

    <?php require 'partials/modal_add_material_category.php';  ?>

    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_logout.js"></script>
</body>

</html>