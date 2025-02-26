<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eightees IMS</title>
    <?php require '../inc/head.php'; ?>
</head>

<body>
    <div class="container-fluid bg-slate-50 poppins-regular">
        <div class="row justify-content-center login-container">
            <div class="col-md-6 col-lg-4">
                <div class="login-form">
                    <h2 class="text-center mb-4 poppins-light">Eightees IMS</h2>
                    <div id="error-message" class="error-message"></div>
                    <form>

                        <div class="mb-3">
                            <label for="username" class="form-label">
                                <i class="fas fa-user"></i> Username
                            </label>
                            <input type="text" class="form-control" id="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" checked>
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="#!" class="text-decoration-none"><i class="fas fa-key"></i> Forgot password?</a>
                        </div>

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