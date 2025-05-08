<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f4f4;
            min-height: 100vh;
        }
        .login-admin-container {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.12);
            padding: 32px 28px;
        }
        .login-admin-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4e3b31;
            text-align: center;
            margin-bottom: 18px;
        }
        .login-admin-form label {
            font-weight: 500;
        }
        .login-admin-form input {
            border-radius: 6px;
            border: 1px solid #c69c6d;
            padding: 8px;
            margin-bottom: 12px;
        }
        .login-admin-form button {
            background: #c69c6d;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 24px;
            font-weight: bold;
            width: 100%;
            margin-top: 8px;
        }
        .login-admin-form button:hover {
            background: #a4784f;
        }
    </style>
</head>
<body>
    <div class="login-admin-container">
        <div class="login-admin-title">Login Admin</div>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form class="login-admin-form" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback" style="color:#a3342f; font-size:0.95rem;">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback" style="color:#a3342f; font-size:0.95rem;">{{ $message }}</div>
            @enderror

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html> 