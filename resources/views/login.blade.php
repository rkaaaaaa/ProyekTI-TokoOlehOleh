<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/texture-whites.png') }}');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            opacity: 0.1;
            z-index: -1;
        }

        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
        }

        .btn-login {
            background-color: #D40000;
            color: white;
        }

        .btn-login:hover {
            background-color: #A00000;
        }

        .input-group-text {
            background-color: #f0f0f0;
        }

        .form-control:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="text-center mb-4">Login</h2>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error umum --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-3">
                <label for="namaUser" class="form-label">Nama User</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" id="namaUser" name="namaUser"
                        class="form-control @error('namaUser') is-invalid @enderror" value="{{ old('namaUser') }}"
                        placeholder="Nama User" autocomplete="off" required>
                </div>
                @error('namaUser')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="passwordUser" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" id="passwordUser" name="passwordUser"
                        class="form-control {{ $errors->has('passwordUser') ? 'is-invalid' : '' }}"
                        placeholder="Password" autocomplete="new-password" required>
                    <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
                @if ($errors->has('passwordUser'))
                    <div class="invalid-feedback d-block">{{ $errors->first('passwordUser') }}</div>
                @endif
            </div>

            <button id="btnLogin" type="submit"
                class="btn btn-login w-100 d-flex justify-content-center align-items-center">
                <span id="btnText">Login</span>
                <div id="btnSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></div>
            </button>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("passwordUser");
            const icon = document.getElementById("eyeIcon");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

    <script>
        const form = document.querySelector('form');
        const btnLogin = document.getElementById('btnLogin');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');

        // Reset state setiap load
        window.addEventListener('load', function() {
            btnLogin.disabled = false;
            btnSpinner.classList.add('d-none');
            btnText.textContent = 'Login';
        });

        form.addEventListener('submit', function() {
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            btnLogin.disabled = true;
            btnSpinner.classList.remove('d-none');
            btnText.textContent = 'Proses min...';
        });
    </script>
</body>

</html>
