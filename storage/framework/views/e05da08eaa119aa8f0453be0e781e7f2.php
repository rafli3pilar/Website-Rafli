<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/assets/bootstrap.min.css')); ?>">
</head>
<style>
    body {
        background:url("<?php echo e(asset('bg-unpam.jpg')); ?>") no-repeat center center fixed;
        background-size: cover;
    }
    .bg-overlay {
        background-color: rgba(255, 255, 255,0.8);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        padding: 20px;
    }
</style>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow" style="width: 400px;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Login</h5>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
             <!-- 👇 Akses Demo ditambahkan di bawah -->
            <div class="mt-3 text-center small text-muted">
                <strong>Akses Demo</strong><br>
             Email: <code>rafli3pilar@gmail.com</code><br>
             Password: <code>12345</code>
        </div>
    </div>

    <script src="<?php echo e(asset('assets/assets/jquery-3.6.1.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/assets/bootstrap.min.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\rest-api\resources\views/auth/login.blade.php ENDPATH**/ ?>