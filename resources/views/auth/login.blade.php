<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bengkel App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
        .auth-body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .auth-card { background: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); width: 100%; max-width: 400px; }
        .auth-title { font-size: 1.5rem; font-weight: 600; color: #1f2937; }
        .auth-subtitle { color: #6b7280; margin-top: 0.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem; }
        .input-auth { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; }
        .input-auth:focus { border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
        .btn-auth { width: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.75rem; border-radius: 0.5rem; font-weight: 500; cursor: pointer; }
    </style>
</head>

<body class="auth-body">

    <div class="auth-card">

        <div class="text-center mb-6">
            <h1 class="auth-title">Bengkel App</h1>
            <p class="auth-subtitle">Silakan login untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="input-auth" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="input-auth" required>
            </div>

            @error('email')
                <p style="color: red; font-size: 0.875rem;">{{ $message }}</p>
            @enderror

            <button class="btn-auth">Login</button>
        </form>

    </div>

</body>
</html>