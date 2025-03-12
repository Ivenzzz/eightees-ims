<?php

session_start();

$title = 'Dashboard';

require '../inc/database.php';
require '../models/admin_account.php';

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
            <p>Admin Page</p>
        </div>
    </div>
    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_logout.js"></script>
</body>

</html>