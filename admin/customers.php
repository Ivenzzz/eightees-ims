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
                    <div class="card shadow text-xs">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Customer List</h5>
                            <button class="btn btn-light btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                <i class="bi bi-plus-circle"></i> Add Customer
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="customersTable" class="table table-bordered table-striped text-xs">
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
                                                        <a href="customer_transactions.php?customer_id=<?= $customer['customer_id'] ?>" class="btn btn-info btn-sm">
                                                            View Transactions
                                                        </a>
                                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCustomerModal<?= $customer['customer_id'] ?>">
                                                            <i class="bi bi-pencil-square"></i> <!-- Edit Icon -->
                                                        </button>
                                                        <form action="../controllers/admin_delete_customer.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="customer_id" value="<?= $customer['customer_id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer? This will also delete the associated transactions.');">
                                                                <i class="bi bi-trash"></i> <!-- Delete Icon -->
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Edit Customer Modal -->
                                                <div class="modal fade" id="editCustomerModal<?= $customer['customer_id'] ?>" tabindex="-1" aria-labelledby="editCustomerLabel<?= $customer['customer_id'] ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editCustomerLabel<?= $customer['customer_id'] ?>">Edit Customer</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="../controllers/admin_edit_customer.php" method="POST">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="customer_id" value="<?= $customer['customer_id'] ?>">

                                                                    <div class="mb-3">
                                                                        <label for="name<?= $customer['customer_id'] ?>" class="form-label">Name</label>
                                                                        <input type="text" class="form-control" id="name<?= $customer['customer_id'] ?>" name="name" value="<?= htmlspecialchars($customer['name']) ?>" required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="phone<?= $customer['customer_id'] ?>" class="form-label">Phone</label>
                                                                        <input type="text" class="form-control" id="phone<?= $customer['customer_id'] ?>" name="phone" value="<?= htmlspecialchars($customer['phone']) ?>">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="address<?= $customer['customer_id'] ?>" class="form-label">Address</label>
                                                                        <input type="text" class="form-control" id="address<?= $customer['customer_id'] ?>" name="address" value="<?= htmlspecialchars($customer['address']) ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

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

    <?php require 'partials/modal_add_customer.php'; ?>


    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_logout.js"></script>
    <script>
        $(document).ready(function() {
            $('#customersTable').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search filter
                "ordering": true, // Enable column sorting
                "info": true, // Show info (e.g., "Showing 1 to 10 of 50 entries")
                "lengthMenu": [5, 10, 25, 50, 100], // Dropdown to select number of rows
                "language": {
                    "search": "Search Customers:", // Custom label for search
                    "lengthMenu": "Show _MENU_ entries"
                }
            });
        });
    </script>

</body>

</html>