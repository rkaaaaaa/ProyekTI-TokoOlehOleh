<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .btn-login {
            background-color: #D40000;
            color: white;
        }

        .btn-login:hover {
            background-color: #A00000;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="text-center mb-4">Login</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="namaUser" class="form-label">Nama User</label>
                <input type="text" id="namaUser" name="namaUser"
                    class="form-control {{ $errors->has('namaUser') ? 'is-invalid' : '' }}" placeholder="Nama User"
                    required>
                @if ($errors->has('namaUser'))
                    <div class="invalid-feedback">{{ $errors->first('namaUser') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="passwordUser" class="form-label">Password</label>
                <input type="password" id="passwordUser" name="passwordUser"
                    class="form-control {{ $errors->has('passwordUser') ? 'is-invalid' : '' }}" placeholder="Password"
                    required>
                @if ($errors->has('passwordUser'))
                    <div class="invalid-feedback">{{ $errors->first('passwordUser') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
    </div>
</body>

</html>
