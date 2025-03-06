<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eightees IMS</title>
    <?php require '../inc/head.php'; ?>
</head>

<body class="h-100 w-100 bg-slate-100">
    <div class="container-fluid poppins-regular">
        <div class="row justify-content-center login-container">
            <div class="col-md-6 col-lg-4">
                <div class="login-form">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="../public/images/eightees_logo.png" alt="" width="82px" class="mr-2">
                        <h2 class="text-left mb-4 poppins-light text-xl mt-3">Eightees Inventory Management System</h2>
                    </div>
                    <div id="error-message" class="error-message"></div>
                    <form>
                        <div class="mb-4 input-group">
                            <span class="input-group-text bg-dark text-white">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" class="form-control" id="username" placeholder="Username" required>
                        </div>

                        <div class="mb-4 input-group">
                            <span class="input-group-text bg-dark text-white">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" checked>
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <?php require '../inc/javascripts.php'; ?>
    <script src="../public/js/index_login.js"></script>
</body>

</html>