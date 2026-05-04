<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bengkel App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="auth-body">

    <div class="auth-container px-4 sm:px-0">

        <div class="auth-card">

            <div class="text-center mb-6">
                <h1 class="auth-title">Bengkel App</h1>
                <p class="auth-subtitle">Silakan login untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="input-auth">
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="input-auth">
                </div>

                <button class="btn-auth">Login</button>
            </form>

        </div>

    </div>

</body>
</html>
