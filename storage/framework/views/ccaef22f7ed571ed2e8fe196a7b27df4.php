<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bengkel App</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="auth-body">

    <div class="auth-card">

        <div class="text-center mb-6">
            <h1 class="auth-title">Bengkel App</h1>
            <p class="auth-subtitle">Silakan login untuk melanjutkan</p>
        </div>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="input-auth" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="input-auth" required>
            </div>

            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p style="color: red; font-size: 0.875rem;"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <button class="btn-auth">Login</button>
        </form>

    </div>

</body>
</html><?php /**PATH C:\laragon\www\inventory-app\resources\views/auth/login.blade.php ENDPATH**/ ?>