<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        #mainNavbar {
    transition: background-color 0.5s ease;
        }
        #mainNavbar.scrolled {
            background-color: rgba(0, 0, 0, 0.85);
        }

        .bg-produk {
            background: url('/img/bg-produk.png') no-repeat center center fixed;
            background-size: cover;
        }

        .bg-varian {
            background: url('/img/bg-varian.png') no-repeat center center fixed;
            background-size: cover;
        }

    </style>
</head>
<body>

    @include('nav_user')

    <div class="container">
        @yield('content')
    </div>


</body>
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
</html>
