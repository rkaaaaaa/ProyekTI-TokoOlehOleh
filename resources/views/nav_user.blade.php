<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary-red': '#e60000',
                    '[#FFC300]': '#FFC300',
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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<nav class="bg-[#e60000] shadow-md w-full z-50 font-poppins">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ route('page.home') }}" class="navbar-brand transition-transform duration-200 hover:scale-110">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-[55px]">
        </a>

        <button x-data="{}" @click="$store.navMenu.toggle()" class="lg:hidden focus:outline-none">
            <svg class="w-8 h-8 text-white" fill="none" stroke="white" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="hidden lg:flex space-x-8 items-center">
            <a href="{{ route('page.home') }}" class="text-white font-medium text-[16px] hover:text-[#FFC300] {{ Request::is('/') ? 'text-[#FFC300] font-bold' : '' }}">Beranda</a>
            <a href="{{ route('produk.user') }}" class="text-white font-medium text-[16px] hover:text-[#FFC300] {{ Request::is('produk') ? 'text-[#FFC300] font-bold' : '' }}">Produk</a>
            <a href="{{ route('kontak') }}" class="text-white font-medium text-[16px] hover:text-[#FFC300] {{ Request::is('kontak') ? 'text-[#FFC300] font-bold' : '' }}">Kontak</a>

            <div class="relative group">
                <button class="text-white font-medium flex items-center gap-1 hover:text-[#FFC300]">
                    Tentang Kami
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.35a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="absolute opacity-0 invisible group-hover:opacity-100 group-hover:visible transform scale-95 group-hover:scale-100 transition-all duration-300 ease-in-out mt-2 bg-[#e60000] rounded-md shadow-md w-40 z-50">
                    <a href="{{ route('sejarah') }}" class="block px-4 py-2 text-white hover:text-[#FFC300] {{ Request::is('sejarah') ? 'text-[#FFC300]' : '' }}">Sejarah</a>
                    <a href="{{ route('page.lokasi') }}" class="block px-4 py-2 text-white hover:text-[#FFC300] {{ Request::is('lokasi') ? 'text-[#FFC300]' : '' }}">Lokasi</a>
                </div>
            </div>
            
        </div>
    </div>

    <div x-data="{}" x-show="$store.navMenu.open" @click.outside="$store.navMenu.close()" x-transition class="lg:hidden bg-primary-red text-white py-2 px-4 space-y-2">
        <a href="{{ route('page.home') }}" class="block hover:text-[#FFC300] {{ Request::is('/') ? 'text-[#FFC300] font-bold' : '' }}">Beranda</a>
        <a href="{{ route('produk.user') }}" class="block hover:text-[#FFC300] {{ Request::is('produk') ? 'text-[#FFC300] font-bold' : '' }}">Produk</a>
        <a href="{{ route('kontak') }}" class="block hover:text-[#FFC300] {{ Request::is('kontak') ? 'text-[#FFC300] font-bold' : '' }}">Kontak</a>
        <a href="{{ route('sejarah') }}" class="block hover:text-[#FFC300] {{ Request::is('sejarah') ? 'text-[#FFC300] font-bold' : '' }}">Sejarah</a>
        <a href="{{ route('page.lokasi') }}" class="block hover:text-[#FFC300] {{ Request::is('lokasi') ? 'text-[#FFC300] font-bold' : '' }}">Lokasi</a>
    </div>
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('navMenu', {
            open: false,
            toggle() {
                this.open = !this.open;
            },
            close() {
                this.open = false;
            }
        });
    });
</script>
