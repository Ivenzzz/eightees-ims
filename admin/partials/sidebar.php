<div class="sidebar d-flex flex-column p-3">
    <?php
        $current_page = basename($_SERVER['REQUEST_URI']);
        if ($current_page == '' || $current_page == 'index.php') {
            $current_page = 'index';
        }
    ?>

    <a href="#" class="mb-4">
        <img src="../public/images/shirt.png" alt="Dashboard Icon" class="icon" style="width: 1.2rem; height: 1.2rem;">
        <span class="text ms-2">Admin</span>
    </a>

    <!-- Dashboard Link -->
    <a href="index.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['index.php', 'index_table_view.php', 'clinical_info.php', 'transferred_residents.php', 'deceased_residents.php']) ? 'active' : '' ?>">
        <i class="icon fa-solid fa-chart-simple text-green-700"></i>
        <span class="text ms-2">Dashboard</span>
    </a>

    <!-- Materials with Submenu -->
    <a href="#materialsSubmenu" class="d-flex align-items-center" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="materialsSubmenu">
        <i class="icon fa-solid fa-trowel-bricks text-red-500"></i>
        <span class="text ms-2">Materials</span>
        <i class="fas fa-chevron-down ms-auto"></i>
    </a>
    <div class="collapse ps-4 mt-1 <?= in_array(basename($_SERVER['PHP_SELF']), ['materials.php', 'add_material.php', 'material_categories.php']) ? 'show' : '' ?>" id="materialsSubmenu">  
        <a href="materials.php" class="d-block ps-4 text-sm submenu-link <?= basename($_SERVER['PHP_SELF']) == 'materials.php' ? 'active' : '' ?>">Add Material</a>
        <a href="material_categories.php" class="d-block ps-4 text-sm submenu-link <?= basename($_SERVER['PHP_SELF']) == 'material_categories.php' ? 'active' : '' ?>">Categories</a>
    </div>

    <!-- Customers with Submenu -->
    <a href="#customersSubmenu" class="d-flex align-items-center" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="customersSubmenu">
        <i class="icon bi bi-person-raised-hand text-indigo-500"></i>
        <span class="text ms-2">Customers</span>
        <i class="fas fa-chevron-down ms-auto"></i>
    </a>
    <div class="collapse ps-4 mt-1 <?= in_array(basename($_SERVER['PHP_SELF']), ['customers.php', 'all_transactions.php', 'transaction_categories.php']) ? 'show' : '' ?>" id="customersSubmenu">  
        <a href="customers.php" class="d-block ps-4 text-sm submenu-link <?= basename($_SERVER['PHP_SELF']) == 'customers.php' ? 'active' : '' ?>">Customers</a>
        <a href="all_transactions.php" class="d-block ps-4 text-sm submenu-link <?= basename($_SERVER['PHP_SELF']) == 'all_transactions.php' ? 'active' : '' ?>">Transactions</a>
        <a href="transaction_categories.php" class="d-block ps-4 text-sm submenu-link <?= basename($_SERVER['PHP_SELF']) == 'transaction_categories.php' ? 'active' : '' ?>">Transaction Categories</a>
    </div>


    <a href="expenses.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['expenses.php']) ? 'active' : '' ?>">
        <i class="icon fa-solid fa-money-bill-1-wave text-amber-500"></i>
        <span class="text">Expenses</span>
    </a>

    

    <!-- Logout Button -->
    <button id="logoutBtn" class="btn btn-danger w-100 d-flex align-items-center mt-3">
        <i class="fa-solid fa-box-arrow-right me-2"></i> Logout
    </button>
</div>
