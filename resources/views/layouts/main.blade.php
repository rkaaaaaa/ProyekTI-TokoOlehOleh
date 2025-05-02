<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins';
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        
        main {
            flex: 1;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-red': '#e60000',
                        'hover-color': '#FFC300',
                        'white': '#ffffff',
                        'black': '#222222',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="flex flex-col min-h-screen">

    @include('nav_user')

    <main class="flex-grow">
        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    </main>
    
    <footer class="bg-[#e60000] text-white py-6 text-center font-bold mt-auto">
        <div class="container mx-auto px-4">
            <p>&copy; {{ date('Y') }} Sambel Pecel Madiun Asli Selo. All Rights Reserved.</p>
            <p class="text-xs mt-2">Designed by Information Technology, Politeknik Negeri Madiun '23</p>
        </div>
    </footer>
</body>
</html>
