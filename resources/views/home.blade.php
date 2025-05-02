<!DOCTYPE html>
<html lang="en" x-data="{ scrolled: false, open: false }" x-init="
    window.addEventListener('scroll', () => {
        scrolled = window.scrollY > 100;
    });
"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sambel Pecel Madiun Asli Selo</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-red': '#e60000',
                        'hover-color': '#FFC300',
                        'white': '#ffffff',
                        'black': '#222222',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        .dot.active {
            opacity: 1;
            background-color: var(--primary-red);
        }

        .vector {
            position: absolute;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            pointer-events: none;
            z-index: 1;
            opacity: 0.2;
            width: 80%;
            left: 500px;
            margin-bottom: 100px;
        }

        .vector2 {
            position: absolute;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            pointer-events: none;
            z-index: 0;
            opacity: 0.2;
            width: 80%;
            right: 500px;
            margin-bottom: 100px;
        }

                @keyframes fadeUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
        }
        @keyframes backgroundMove {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(10px);
        }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s ease-out both;
        }
        .animate-fade-up.delay-200 {
            animation-delay: 0.2s;
        }
        .animate-fade-up.delay-400 {
            animation-delay: 0.4s;
        }

        .animate-backgroundMove {
            animation: backgroundMove 6s ease-in-out infinite;
        }

        .translate-y-10 {
            transform: translateY(40px);
        }
        .translate-y-3 {
            transform: translateY(12px);
        }


    </style>
</head>
<body>

<nav :class="scrolled ? 'bg-primary-red shadow-md' : 'bg-transparent'" class="fixed top-0 w-full transition-all duration-300 z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ route('page.home') }}" class="navbar-brand transition-transform duration-200 hover:scale-110">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-[55px]">
        </a>

        <button @click="open = !open" class="lg:hidden focus:outline-none">
            <svg class="w-8 h-8 text-white" fill="none" stroke="white" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="hidden lg:flex space-x-8 items-center">
            <a href="{{ route('page.home') }}" class="text-white font-medium text-[16px] hover:text-hover-color">Beranda</a>
            <a href="{{ route('produk.user') }}" class="text-white font-medium text-[16px] hover:text-hover-color">Produk</a>
            <a href="{{ route('kontak') }}" class="text-white font-medium text-[16px] hover:text-hover-color">Kontak</a>

            <div class="relative group">
                <button class="text-white font-medium flex items-center gap-1 hover:text-hover-color">
                    Tentang Kami
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.35a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="absolute opacity-0 invisible group-hover:opacity-100 group-hover:visible transform scale-95 group-hover:scale-100 transition-all duration-300 ease-in-out mt-2 bg-primary-red rounded-md shadow-md w-40 z-50">
                    <a href="{{ route('sejarah') }}" class="block px-4 py-2 text-white hover:text-hover-color {{ Request::is('sejarah') ? 'text-hover-color font-bold' : '' }}">Sejarah</a>
                    <a href="{{ route('page.lokasi') }}" class="block px-4 py-2 text-white hover:text-hover-color {{ Request::is('lokasi') ? 'text-hover-color font-bold' : '' }}">Lokasi</a>
                </div>
            </div>
        </div>
    </div>

    <div x-show="open" @click.outside="open = false" x-transition class="lg:hidden bg-primary-red text-white py-2 px-4 space-y-2">
        <a href="{{ route('page.home') }}" class="block hover:text-hover-color">Beranda</a>
        <a href="{{ route('produk.user') }}" class="block hover:text-hover-color">Produk</a>
        <a href="{{ route('kontak') }}" class="block hover:text-hover-color">Kontak</a>
        <a href="{{ route('sejarah') }}" class="block hover:text-hover-color">Sejarah</a>
        <a href="{{ route('page.lokasi') }}" class="block hover:text-hover-color">Lokasi</a>
    </div>
</nav>

<section id="hero"
class="relative h-screen flex items-center justify-center text-center text-white bg-cover bg-center transition-all duration-1000"
style="background-image: url('/your-default-image.jpg');">

<div class="absolute inset-0 bg-black/50 z-[1]"></div>

<div class="relative z-[2]">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Sambel Pecel Madiun Asli Selo</h1>
    <p class="text-xl mb-8">Pedas, gurih, dan khas, cocok untuk semua hidangan!</p>
    <a href="https://wa.me/6285708945396"
    target="_blank" 
    rel="noopener noreferrer" 
    class="bg-primary-red text-white font-bold py-2 px-6 rounded-md inline-block transform transition-transform duration-300 hover:scale-105">
        Pesan Sekarang!
    </a>
</div>

</section>


<section id="produk" class="product-section py-16 bg-primary-red text-white relative overflow-hidden white-vectors">
    <div class="vector absolute top-0 left-0 w-full h-full opacity-20 transition-transform duration-[3000ms] ease-in-out" id="backgroundVector">
        <img src="{{ asset('images/texture2.png') }}" alt="texture" class="w-full h-full object-cover">
    </div>

    <div class="container mx-auto px-4 md:px-8 relative z-10">
        <h2 class="text-4xl font-bold text-left mt-30 opacity-0 translate-y-10 transition-all duration-700 ease-out" id="produkTitle">
            Produk Kami
        </h2>
        <div class="flex flex-col md:flex-row items-start gap-10">
            <div class="md:w-1/2 flex flex-col justify-start mt-5 opacity-0 translate-y-10 transition-all duration-700 ease-out delay-200" id="produkDesc">
                <p class="text-lg leading-relaxed">
                    Sambal kacang premium dibuat dari kacang pilihan, gula merah, cabai, dan daun jeruk, 
                    menghasilkan rasa gurih, manis, dan pedas dengan aroma khas yang menggugah selera. 
                    Cocok untuk sate, siomay, dan hidangan favoritmu!
                </p>
            </div>
            <div class="md:w-1/2 flex justify-end opacity-0 translate-y-10 transition-all duration-700 ease-out delay-400" id="produkImg">
                <img src="{{ asset('images/produk.png') }}" alt="Sambel Pecel Madiun"
                    class="w-full max-w-[400px] rounded-xl ml-auto">
            </div>
        </div>
    </div>
</section>



    
<section class="py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-fixed z-0" style="background-image: url('{{ asset('images/bgvarian.jpeg') }}');"></div>
    <div class="absolute inset-0 bg-black/60 z-0"></div>

    <div class="relative z-10">
        <div class="container mx-auto px-4 md:px-8 text-center">
            <h2 class="text-5xl font-bold mb-12 text-white">Varian Rasa</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                <div class="flex flex-col items-center p-6 transition-all hover:-translate-y-2 hover:shadow-white-2xl">
                    <img src="{{ asset('images/varian-sedang.png') }}" alt="Varian Sedang"
                        class="w-full max-w-[800px] h-auto object-contain mb-4">
                    <h3 class="text-4xl font-bold text-green-400">Sedang</h3>
                </div>
                <div class="flex flex-col items-center p-6 transition-all hover:-translate-y-2 hover:shadow-white-2xl">
                    <img src="{{ asset('images/varian-pedas.png') }}" alt="Varian Pedas"
                        class="w-full max-w-[800px] h-auto object-contain mb-4">
                    <h3 class="text-4xl font-bold text-blue-500">Pedas</h3>
                </div>
                <div class="flex flex-col items-center p-6 transition-all hover:-translate-y-2 hover:shadow-white-2xl">
                    <img src="{{ asset('images/varian-extra.png') }}" alt="Varian Extra Pedas"
                        class="w-full max-w-[800px] h-auto object-contain mb-4">
                    <h3 class="text-4xl font-bold text-primary-red">Extra Pedas</h3>
                </div>
            </div>
        </div>
    </div>
</section>



    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="flex flex-col items-center">
                    <div class="h-32 w-32 rounded-full flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logoiso.png') }}" alt="Logo ISO 22000">
                    </div>
                    <p class="text-sm">
                        Produk ini juga telah memenuhi standar ISO 22000, menjamin kualitas dan keamanan selama proses produksinya.
                    </p>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="h-32 w-32 rounded-full flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logo-bpom.png') }}" alt="Logo BPOM">
                    </div>
                    <p class="text-sm">
                        Sambel pecel ini telah teruji dan memiliki sertifikasi dari Badan POM sehingga terjamin keamanan untuk dikonsumsi.
                    </p>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="h-32 w-32 rounded-full flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logo-halal.png') }}" alt="Logo Halal">
                    </div>
                    <p class="text-sm">
                        Sambel Pecel Asli Selo sudah lulus uji sertifikasi halal dari MUI dengan LPPOM sebagai lembaga audit.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak" class="py-16 bg-white relative">
        <div class="vector2 absolute top-0 left-0 w-full h-full opacity-20 transition-transform duration-[3000ms] ease-in-out" id="backgroundVectorKontak">
            <img src="{{ asset('images/texture-whites.png') }}" alt="texture" class="w-full h-full object-cover">
        </div>
    
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 opacity-0 translate-y-10 transition-all duration-700 ease-out" id="kontakText">
                    <h2 class="text-3xl font-bold text-primary-red mb-6">Mau ke Toko?</h2>
                    <div class="flex items-start mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-primary-red mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p>
                            <strong>Alamat:</strong> Jl. Sido Mulyo I No.10, RT.46/RW.11, Kanigoro, Kec. Kartoharjo, Kota Madiun, Jawa Timur 63118
                        </p>
                    </div>
                    <div class="flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-red mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p><strong>Jam Buka:</strong> 07:00 - 17:00</p>
                    </div>
                    <a href="https://maps.app.goo.gl/1NUvPZFRUxF4QPrh7" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="bg-primary-red text-white font-bold py-2 px-6 rounded-md inline-block transform transition-transform duration-300 hover:scale-105">
                        Lihat di Maps
                    </a>
                </div>
                <div class="md:w-1/2 opacity-0 translate-y-10 transition-all duration-700 ease-out delay-200" id="kontakMap">
                    <div class="rounded-lg overflow-hidden shadow-lg h-64 bg-white">
                        <div class="w-full h-full flex items-center justify-center">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.5088788653793!2d111.5425276!3d-7.628291900000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79bffe07d8fb2d%3A0xa83cbdf4f16ea33e!2sToko%20Oleh-Oleh%20Khas%20Madiun%203R!5e0!3m2!1sid!2sid!4v1745504464665!5m2!1sid!2sid" width="700" height="550" style="border:0; background-color:transparent;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <section class="py-16 bg-white relative">
        <div class="vector2 absolute top-0 left-0 w-full h-full opacity-20 transition-transform duration-[3000ms] ease-in-out" id="backgroundVectorKontak">
            <img src="{{ asset('images/texture-whites.png') }}" alt="texture" class="w-full h-full object-cover">
        </div>        
        <div class="container mx-auto px-4 md:px-8">
            <h2 class="text-4xl font-bold text-center text-red-600 mb-12">Testimoni</h2>
    
            <div class="swiper mySwiper h-[500px]">
                <div class="swiper-wrapper">
                    @forelse ($testimonis as $item)
                        <div class="swiper-slide">
                            <div class="flex flex-col items-center justify-center p-6 text-white shadow-lg mx-4">
                                @if($item->gambarTestimoni && Storage::disk('public')->exists($item->gambarTestimoni))
                                    <img src="{{ asset('storage/' . $item->gambarTestimoni) }}" 
                                        alt="Testimoni {{ $loop->iteration }}" 
                                        class="rounded-lg w-full h-64 object-cover mb-4">
                                @else
                                    <div class="rounded-lg w-full h-64 bg-gray-700 flex items-center justify-center mb-4">
                                        <span class="text-gray-400">Gambar tidak tersedia</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="flex items-center justify-center p-6">
                                <p class="text-center text-gray-500">Belum ada testimoni</p>
                            </div>
                        </div>
                    @endforelse
                </div>
    
                <div class="swiper-button-next after:text-red-600"></div>
                <div class="swiper-button-prev after:text-red-600"></div>
                <div class="swiper-pagination mt-6"></div>
            </div>
        </div>
    </section>
    
    
    <section>
        <footer class="bg-primary-red text-white py-6 text-center font-bold z-10">
            <div class="container mx-auto px-4">
                <p>&copy; {{ date('Y') }} Sambel Pecel Madiun Asli Selo. All Rights Reserved.</p>
                <p class="text-xs mt-2">Designed by Information Technology, Politeknik Negeri Madiun '23</p>
            </div>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        document.addEventListener('DOMContentLoaded', function () {
        const sectionKontak = document.querySelector('#kontak');
        const kontakText = document.getElementById('kontakText');
        const kontakMap = document.getElementById('kontakMap');
        const bgKontak = document.getElementById('backgroundVectorKontak');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    kontakText.classList.remove('opacity-0', 'translate-y-10');
                    kontakMap.classList.remove('opacity-0', 'translate-y-10');

                    bgKontak.classList.add('translate-y-3');
                }
            });
        }, {
            threshold: 0.3
        });

        observer.observe(sectionKontak);
    });


        document.addEventListener('DOMContentLoaded', function () {
        const section = document.querySelector('#produk');
        const title = document.getElementById('produkTitle');
        const desc = document.getElementById('produkDesc');
        const img = document.getElementById('produkImg');
        const bg = document.getElementById('backgroundVector');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    title.classList.remove('opacity-0', 'translate-y-10');
                    desc.classList.remove('opacity-0', 'translate-y-10');
                    img.classList.remove('opacity-0', 'translate-y-10');

                    bg.classList.add('translate-y-3');
                }
            });
        }, {
            threshold: 0.3
        });

        observer.observe(section);
    }); 

        const backgroundImages = [
            '{{ asset('images/slide11.jpeg') }}',
            '{{ asset('images/slide2.jpeg') }}',
            '{{ asset('images/slide3.jpeg') }}',
            '{{ asset('images/slide4.jpeg') }}'
        ];
    
        const heroSection = document.getElementById('hero');
        const dots = document.querySelectorAll('.carousel-indicators .dot');
        let currentSlide = 0;
    
        function changeSlide(index) {
            heroSection.style.backgroundImage = `url('${backgroundImages[index]}')`;
    
            dots.forEach((dot, i) => {
                dot.classList.remove('opacity-100', 'bg-primary-red');
                dot.classList.add('opacity-60', 'bg-white');
                if (i === index) {
                    dot.classList.remove('opacity-60', 'bg-white');
                    dot.classList.add('opacity-100', 'bg-primary-red');
                }
            });
    
            currentSlide = index;
        }
    
        function initCarousel() {
            changeSlide(0); 
    
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    changeSlide(index);
                });
            });
    
            setInterval(() => {
                const nextSlide = (currentSlide + 1) % backgroundImages.length;
                changeSlide(nextSlide);
            }, 5000);
    
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        }
        
        window.addEventListener('DOMContentLoaded', initCarousel);
    </script>
</body>
</html>
