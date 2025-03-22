<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .btn-register {
            background-color: #D40000;
            border: none;
        }
        .btn-register:hover {
            background-color: #a00000;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="text-center text-danger">Register</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama User</label>
                <input type="text" name="namaUser" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="passwordUser" class="form-control" placeholder="Masukkan password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Level User</label>
                <select name="levelUser" class="form-select">
                    <option value="Superadmin">Superadmin</option>
                    <option value="Administrator">Administrator</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Status User</label>
                <select name="statusUser" class="form-select">
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-register w-100 text-white">Daftar</button>
        </form>
    </div>
</body>
</html>