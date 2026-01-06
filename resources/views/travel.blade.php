

    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Layanan Travel - MIKA TRANS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Metadata tetap sama -->
    <meta name="description" content="PT MIKATRANS PEKANBARU: Layanan Sewa Bus Pariwisata Premium (31-50 Seat) & Travel Executive Pekanbaru - Tembilahan. Armada modern, aman, dan tepat waktu.">
    <meta name="keywords" content="mika trans, bus pariwisata pekanbaru, travel pekanbaru tembilahan, sewa bus riau, sewa bus pariwisata riau, travel mika trans, tiket travel pekanbaru">
    <meta name="author" content="MIKA TRANS">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="http://mikatrans.com/">

    <!-- Open Graph Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://mikatrans.com/">
    <meta property="og:title" content="Mika Trans Pekanbaru | Sewa Bus Pariwisata & Travel Riau">
    <meta property="og:description" content="Solusi perjalanan nyaman di Riau. Sewa Bus Pariwisata dan Travel Executive Pekanbaru-Tembilahan PP. Hubungi +62 822-8802-3332.">
    <meta property="og:image" content="{{ asset('image/travel.png') }}">

    <!-- Twitter Cards -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://mikatrans.com/">
    <meta property="twitter:title" content="Mika Trans Pekanbaru | Sewa Bus Pariwisata & Travel Riau">
    <meta property="twitter:description" content="Layanan transportasi bus & travel terbaik di Pekanbaru dengan armada modern dan driver profesional.">
    <meta property="twitter:image" content="{{ asset('image/travel.png') }}">

    <!-- Geo Tags -->
    <meta name="geo.region" content="ID-RI">
    <meta name="geo.placename" content="Pekanbaru">
    <meta name="geo.position" content="0.507068;101.447779">
    <meta name="ICBM" content="0.507068, 101.447779">

    <!-- Schema.org -->
    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "TransportationBusiness",
      "@id": "https://mikatrans.com/#business",
      "name": "PT MIKATRANS PEKANBARU",
      "url": "https://mikatrans.com",
      "logo": "https://mikatrans.com/image/gambar.png",
      "image": "https://mikatrans.com/image/gambar.png",
      "telephone": "+62-822-8802-3332",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jalan H. Usman, Kubang Jaya",
        "addressLocality": "Pekanbaru",
        "addressRegion": "Riau",
        "postalCode": "28293",
        "addressCountry": "ID"
      }
    }
    </script>
    @endverbatim

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f172a',
                        'primary-light': '#1e293b',
                        'primary-dark': '#020617',
                        accent: '#fbbf24',
                        'accent-light': '#fcd34d',
                        'accent-dark': '#f59e0b'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif']
                    },
                    screens: {
                        'xs': '475px',
                    }
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        body {
            overflow-x: hidden;
            width: 100%;
        }

        .gradient-accent {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }

        .gradient-dark {
            background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .shine-effect {
            position: relative;
            overflow: hidden;
        }

        .shine-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .shine-effect:hover::before {
            left: 100%;
        }

        /* Fix untuk mobile touch */
        button, a {
            touch-action: manipulation;
        }

        /* Animasi bounce untuk mobile */
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 3s infinite ease-in-out;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #fbbf24;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-md shadow-lg fixed w-full top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center space-x-4 group">
                    <div class="gradient-accent text-white rounded-lg p-0 shadow-lg group-hover:scale-10 transition-transform duration-300">
                        <img src="{{ asset('image/gambar.png') }}" alt="Logo MIKA TRANS" class="w-16 h-16 object-contain">
                    </div>
                    <div>
                        <span class="text-2xl font-bold text-primary">MIKA</span>
                        <span class="text-2xl font-bold text-accent">TRANS</span>
                        <div class="text-sm text-gray-500 -mt-1">Premium Bus dan Travel di Pekanbaru</div>
                    </div>
                </div>

                <div class="hidden lg:flex items-center space-x-6">
                    <a href="/" class="text-gray-700 text-sm hover:text-accent transition-colors relative group">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/bus" class="text-gray-700 text-sm hover:text-accent transition-colors relative group">
                        Bus
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/travel" class="text-primary text-sm font-semibold hover:text-accent transition-colors relative group">
                        Travel
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-accent"></span>
                    </a>
                    <a href="/#tentang" class="text-gray-700 text-sm hover:text-accent transition-colors relative group">
                        Tentang
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/#kontak" class="text-gray-700 text-sm hover:text-accent transition-colors relative group">
                        Kontak
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <button class="gradient-accent text-primary-dark text-sm font-bold px-5 py-2 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-ticket-alt mr-1.5"></i>
                        Pesan Tiket
                    </button>
                </div>

                <button id="mobile-menu-btn" class="lg:hidden text-primary focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <div id="mobile-menu" class="hidden lg:hidden pb-4 space-y-1">
                <a href="/" class="block py-2 text-sm text-gray-700 hover:bg-accent/10 px-3 rounded-lg transition">Home</a>
                <a href="/bus" class="block py-2 text-sm text-gray-700 hover:bg-accent/10 px-3 rounded-lg transition">Bus</a>
                <a href="/travel" class="block py-2 text-sm text-primary font-semibold bg-accent/10 px-3 rounded-lg">Travel</a>
                <a href="/#tentang" class="block py-2 text-sm text-gray-700 hover:bg-accent/10 px-3 rounded-lg transition">Tentang</a>
                <a href="/#kontak" class="block py-2 text-sm text-gray-700 hover:bg-accent/10 px-3 rounded-lg transition">Kontak</a>
                <button class="w-full gradient-accent text-sm text-primary-dark font-bold py-2 rounded-lg mt-2">
                    <i class="fas fa-ticket-alt mr-1.5"></i>
                    Pesan Tiket
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
<!-- Hero Section -->
    <section class="pt-32 pb-16 gradient-dark text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-48 h-48 bg-accent rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <span class="bg-accent/20 text-accent px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-accent/30">
                    🚗 Layanan Travel Premium
                </span>
                <h1 class="text-4xl lg:text-5xl font-bold mt-6 mb-4">
                    Perjalanan Cepat & <span class="gradient-accent bg-clip-text text-transparent">Eksklusif</span>
                </h1>
                <p class="text-lg text-gray-300 mb-8">
                    Layanan travel antar kota dengan mobil premium, lebih cepat, privat, dan nyaman. Door-to-door service untuk kepuasan maksimal Anda.
                </p>
            </div>
        </div>
    </section>

    <!-- Filter Section - Mobile Friendly -->
    <section class="py-6 bg-white shadow-md -mt-8 relative z-10 mx-4 rounded-2xl">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 gap-3 xs:gap-4">
                <div class="col-span-1 xs:col-span-2">
                    <label class="block text-xs xs:text-sm font-semibold text-gray-700 mb-1">Lokasi Jemput</label>
                    <div class="relative">
                        <i class="fas fa-map-marker-alt absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Alamat jemput" class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                    </div>
                </div>
                <div class="col-span-1 xs:col-span-2">
                    <label class="block text-xs xs:text-sm font-semibold text-gray-700 mb-1">Lokasi Tujuan</label>
                    <div class="relative">
                        <i class="fas fa-flag absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Alamat tujuan" class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                    </div>
                </div>
                <div class="col-span-1 xs:col-span-2">
                    <label class="block text-xs xs:text-sm font-semibold text-gray-700 mb-1">Tanggal & Waktu</label>
                    <div class="relative">
                        <i class="fas fa-calendar-alt absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                        <input type="datetime-local" class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                    </div>
                </div>
                <div class="col-span-1 xs:col-span-2 flex items-end">
                    <button class="w-full gradient-accent text-primary-dark font-bold py-2.5 text-sm xs:text-base rounded-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i>
                        Cari Travel
                    </button>
                </div>
            </div>
        </div>
    </section>

   <!-- Tipe Travel Section -->
<section id="jadwal" class="py-20 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <span class="bg-accent/10 text-accent-dark px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border border-accent/20">
                Time Schedule
            </span>
            <h2 class="text-4xl font-extrabold text-primary mt-4">
                Travel <span class="gradient-accent bg-clip-text text-transparent">Executive</span>
            </h2>
            <div class="w-24 h-1.5 gradient-accent mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-600 mt-4 max-w-xl mx-auto">
                Nikmati fleksibilitas perjalanan dengan layanan door-to-door yang tepat waktu dan armada terbaru kami.
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-12 items-center">

            <div class="lg:col-span-5 relative group">
                <div class="absolute -inset-4 gradient-accent opacity-20 blur-2xl rounded-full group-hover:opacity-30 transition duration-500"></div>
                <div class="relative z-10 overflow-hidden rounded-3xl shadow-2xl border-8 border-white">
                    <img src="{{ asset('image/travel.png') }}"
                         alt="Travel Executive"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent flex items-end p-8">
                        <div>
                            <p class="text-accent font-bold">Armada Premium</p>
                            <p class="text-white text-sm opacity-90">Toyota Hiace & Innova Zenix</p>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-6 -right-6 z-20 bg-white p-4 rounded-2xl shadow-xl border border-gray-100 hidden md:block animate-bounce-slow">
                    <div class="flex items-center space-x-3">
                        <div class="bg-green-100 p-2 rounded-lg text-green-600">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Status Layanan</p>
                            <p class="text-sm font-bold text-primary">Tersedia Setiap Hari</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="mb-8">
                    <h3 class="text-3xl font-bold text-primary flex items-center">
                        <i class="fas fa-route text-accent mr-4"></i>
                        Pekanbaru <i class="fas fa-long-arrow-alt-right mx-3 text-gray-300"></i> Tembilahan
                    </h3>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-accent transition-colors">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                                <i class="fas fa-sun text-xl"></i>
                            </span>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-tighter">Keberangkatan</span>
                        </div>
                        <h4 class="text-xl font-bold text-primary">Sesi Pagi</h4>
                        <p class="text-3xl font-black text-primary mt-1">10.00 <span class="text-sm font-medium text-gray-500">WIB</span></p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-accent transition-colors">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-indigo-50 text-indigo-600 p-2 rounded-lg">
                                <i class="fas fa-moon text-xl"></i>
                            </span>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-tighter">Keberangkatan</span>
                        </div>
                        <h4 class="text-xl font-bold text-primary">Sesi Malam</h4>
                        <p class="text-3xl font-black text-primary mt-1">21.00 <span class="text-sm font-medium text-gray-500">WIB</span></p>
                    </div>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center p-4 bg-white rounded-xl border-l-4 border-accent shadow-sm">
                        <i class="fas fa-id-badge text-accent w-8 text-center text-lg"></i>
                        <span class="ml-3 font-medium text-gray-700">Carter harian & Drop-off Bandara tersedia</span>
                    </div>
                    <div class="flex items-center p-4 bg-white rounded-xl border-l-4 border-accent shadow-sm">
                        <i class="fas fa-box-open text-accent w-8 text-center text-lg"></i>
                        <span class="ml-3 font-medium text-gray-700">Layanan titip paket kilat (Max 30 kg)</span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/6281399441555"
                       class="flex-1 shine-effect inline-flex items-center justify-center gradient-dark text-white font-bold py-4 rounded-2xl hover:shadow-2xl transition-all duration-300">
                        <i class="fab fa-whatsapp text-xl mr-3"></i>
                        Pesan Kursi Sekarang
                    </a>
                    <div class="flex flex-col justify-center px-4 py-2 bg-gray-100 rounded-2xl text-center sm:text-left">
                        <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Hotline 24/7</span>
                        <span class="text-primary font-bold">0813-9944-1555</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite ease-in-out;
    }
</style>

    <!-- Rute Populer - Mobile Optimized -->
    <section class="py-12 xs:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="text-accent font-semibold text-xs xs:text-sm uppercase tracking-wider">Rute Tersedia</span>
                <h2 class="text-2xl xs:text-3xl font-bold text-primary mb-3 mt-2">
                    Rute <span class="gradient-accent bg-clip-text text-transparent">Travel Populer</span>
                </h2>
            </div>

            <div class="space-y-4">
                <!-- Rute Card 1 -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 xs:p-6 hover-lift">
                    <div class="flex flex-col xs:flex-row xs:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-50 p-3 xs:p-4 rounded-xl">
                                <i class="fas fa-car text-green-600 text-2xl xs:text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col xs:flex-row xs:items-center space-y-1 xs:space-y-0 xs:space-x-3 mb-2">
                                    <h3 class="text-lg xs:text-xl font-bold text-primary">Tembilahan</h3>
                                    <i class="fas fa-arrow-right text-accent hidden xs:block"></i>
                                    <i class="fas fa-arrow-down text-accent xs:hidden text-sm"></i>
                                    <h3 class="text-lg xs:text-xl font-bold text-primary">Pekanbaru</h3>
                                </div>
                                <div class="flex flex-wrap items-center gap-2 xs:gap-4 text-xs xs:text-sm text-gray-600">
                                    <span><i class="fas fa-clock text-accent mr-1"></i> 6-7 Jam</span>
                                    <span><i class="fas fa-road text-accent mr-1"></i> 350 km</span>
                                    <span class="bg-green-100 text-green-700 px-2 xs:px-3 py-1 rounded-full text-xs font-semibold">SHARING</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between xs:justify-end space-x-4 xs:space-x-6">
                            <div class="text-right">
                                <div class="text-xs xs:text-sm text-gray-500">Mulai dari</div>
                                <div class="text-2xl xs:text-3xl font-bold text-primary">200K</div>
                                <div class="text-xs text-green-600 font-semibold"><i class="fas fa-users mr-1"></i> 10 Kursi</div>
                            </div>
                            <button class="gradient-accent text-primary-dark font-bold px-4 xs:px-6 py-2 xs:py-3 rounded-lg hover:shadow-xl transition-all duration-300 whitespace-nowrap text-sm xs:text-base">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Rute Card 2 -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 xs:p-6 hover-lift">
                    <div class="flex flex-col xs:flex-row xs:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-accent/10 p-3 xs:p-4 rounded-xl">
                                <i class="fas fa-car text-accent text-2xl xs:text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col xs:flex-row xs:items-center space-y-1 xs:space-y-0 xs:space-x-3 mb-2">
                                    <h3 class="text-lg xs:text-xl font-bold text-primary">Pekanbaru</h3>
                                    <i class="fas fa-arrow-right text-accent hidden xs:block"></i>
                                    <i class="fas fa-arrow-down text-accent xs:hidden text-sm"></i>
                                    <h3 class="text-lg xs:text-xl font-bold text-primary">Tembilahan</h3>
                                </div>
                                <div class="flex flex-wrap items-center gap-2 xs:gap-4 text-xs xs:text-sm text-gray-600">
                                    <span><i class="fas fa-clock text-accent mr-1"></i> 4-5 Jam</span>
                                    <span><i class="fas fa-road text-accent mr-1"></i> 230 km</span>
                                    <span class="bg-accent/20 text-accent-dark px-2 xs:px-3 py-1 rounded-full text-xs font-semibold">UMUM</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between xs:justify-end space-x-4 xs:space-x-6">
                            <div class="text-right">
                                <div class="text-xs xs:text-sm text-gray-500">Mulai dari</div>
                                <div class="text-2xl xs:text-3xl font-bold text-primary">200K</div>
                                <div class="text-xs text-orange-600 font-semibold"><i class="fas fa-car mr-1"></i> 10 Kursi</div>
                            </div>
                            <button class="gradient-accent text-primary-dark font-bold px-4 xs:px-6 py-2 xs:py-3 rounded-lg hover:shadow-xl transition-all duration-300 whitespace-nowrap text-sm xs:text-base">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8 xs:mt-10">
                <button class="bg-white hover:bg-primary text-primary hover:text-white font-bold px-6 xs:px-8 py-2.5 xs:py-3 rounded-xl shadow-lg border-2 border-primary transition-all duration-300 hover:scale-105 text-sm xs:text-base">
                    Lihat Semua Rute <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Keunggulan - Mobile Optimized -->
    <section class="py-12 xs:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="text-accent font-semibold text-xs xs:text-sm uppercase tracking-wider">Mengapa Memilih Kami</span>
                <h2 class="text-2xl xs:text-3xl font-bold text-primary mb-3 mt-2">
                    Keunggulan <span class="gradient-accent bg-clip-text text-transparent">Travel Kami</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-4 xs:gap-6">
                <div class="bg-white p-4 xs:p-6 rounded-xl shadow-lg hover-lift text-center">
                    <div class="gradient-accent w-12 h-12 xs:w-16 xs:h-16 rounded-full flex items-center justify-center mx-auto mb-3 xs:mb-4">
                        <i class="fas fa-clock text-xl xs:text-3xl text-primary-dark"></i>
                    </div>
                    <h4 class="text-base xs:text-lg font-bold text-primary mb-1 xs:mb-2">Tepat Waktu</h4>
                    <p class="text-xs xs:text-sm text-gray-600">Selalu on-time sesuai jadwal</p>
                </div>

                <div class="bg-white p-4 xs:p-6 rounded-xl shadow-lg hover-lift text-center">
                    <div class="gradient-accent w-12 h-12 xs:w-16 xs:h-16 rounded-full flex items-center justify-center mx-auto mb-3 xs:mb-4">
                        <i class="fas fa-shield-alt text-xl xs:text-3xl text-primary-dark"></i>
                    </div>
                    <h4 class="text-base xs:text-lg font-bold text-primary mb-1 xs:mb-2">Aman Terpercaya</h4>
                    <p class="text-xs xs:text-sm text-gray-600">Driver profesional berizin</p>
                </div>

                <div class="bg-white p-4 xs:p-6 rounded-xl shadow-lg hover-lift text-center">
                    <div class="gradient-accent w-12 h-12 xs:w-16 xs:h-16 rounded-full flex items-center justify-center mx-auto mb-3 xs:mb-4">
                        <i class="fas fa-home text-xl xs:text-3xl text-primary-dark"></i>
                    </div>
                    <h4 class="text-base xs:text-lg font-bold text-primary mb-1 xs:mb-2">Door to Door</h4>
                    <p class="text-xs xs:text-sm text-gray-600">Jemput sampai lokasi tujuan</p>
                </div>

                <div class="bg-white p-4 xs:p-6 rounded-xl shadow-lg hover-lift text-center">
                    <div class="gradient-accent w-12 h-12 xs:w-16 xs:h-16 rounded-full flex items-center justify-center mx-auto mb-3 xs:mb-4">
                        <i class="fas fa-headset text-xl xs:text-3xl text-primary-dark"></i>
                    </div>
                    <h4 class="text-base xs:text-lg font-bold text-primary mb-1 xs:mb-2">24/7 Support</h4>
                    <p class="text-xs xs:text-sm text-gray-600">Customer service siap membantu</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer - Mobile Optimized -->
    <footer id="kontak" class="gradient-dark text-white pt-12 xs:pt-16 pb-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-20 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-20 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Brand & Deskripsi -->
                <div class="xs:col-span-2 lg:col-span-1">
                    <div class="flex items-center space-x-2 xs:space-x-4 mb-6">
                        <div class="gradient-accent text-white rounded-lg p-0 shadow-lg w-12 h-12 xs:w-16 xs:h-16">
                            <img src="{{ asset('image/gambar.png') }}" alt="Logo MIKA TRANS" class="w-full h-full object-contain p-1">
                        </div>
                        <div>
                            <div class="flex items-baseline">
                                <span class="text-xl xs:text-2xl font-bold">MIKA</span>
                                <span class="text-xl xs:text-2xl font-bold text-accent">TRANS</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Premium Bus & Travel</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-xs xs:text-sm mb-6">
                        Perjalanan nyaman, aman, dan terpercaya ke seluruh Indonesia dengan armada modern dan layanan premium.
                    </p>
                    <div class="flex items-center gap-3 xs:gap-4">
                        <a href="https://www.facebook.com/profile.php?id=100094387691878" target="_blank" class="text-gray-400 hover:text-accent transition">
                            <i class="fab fa-facebook-f text-lg xs:text-xl"></i>
                        </a>
                        <a href="https://www.instagram.com/mikatrans_travel/" target="_blank" class="text-gray-400 hover:text-accent transition">
                            <i class="fab fa-instagram text-lg xs:text-xl"></i>
                        </a>
                        <a href="https://maps.app.goo.gl/BZriUxe5ao7tvNYy5" target="_blank" class="text-gray-400 hover:text-accent transition">
                            <i class="fas fa-map-marker-alt text-lg xs:text-xl"></i>
                        </a>
                        <a href="https://wa.me/6281399441555" target="_blank" class="text-gray-400 hover:text-accent transition">
                            <i class="fab fa-whatsapp text-lg xs:text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Layanan -->
                <div>
                    <h4 class="text-base xs:text-lg font-bold mb-4 xs:mb-6">Layanan Kami</h4>
                    <ul class="space-y-2 xs:space-y-3 text-gray-400 text-xs xs:text-sm">
                        <li class="flex items-center">
                            <i class="fas fa-circle text-accent text-[6px] mr-2"></i>
                            Travel Sharing
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-circle text-accent text-[6px] mr-2"></i>
                            Travel Private
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-circle text-accent text-[6px] mr-2"></i>
                            Travel Luxury
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-circle text-accent text-[6px] mr-2"></i>
                            Bus Antar Kota
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-circle text-accent text-[6px] mr-2"></i>
                            Paket Wisata
                        </li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="xs:col-span-2 lg:col-span-1">
                    <h4 class="text-base xs:text-lg font-bold mb-4 xs:mb-6">Hubungi Kami</h4>
                    <ul class="space-y-3 xs:space-y-4 text-gray-400 text-xs xs:text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-accent mt-0.5 mr-3 text-sm"></i>
                            <span>Jl. SM Amin, Air Hitam, Pekanbaru</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt text-accent mr-3 text-sm"></i>
                            0813-9944-1555
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-accent mr-3 text-sm"></i>
                            info@mikatrans.id
                        </li>
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp text-accent mr-3 text-sm"></i>
                            0813-9944-1555
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 xs:mt-12 pt-6 xs:pt-8 text-center text-gray-500 text-xs xs:text-sm">
                © 2026 PT. MIKA TRANS. All rights reserved. | Dibuat dengan ❤️ untuk perjalanan Anda
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // ==================
        // 1. Mobile Menu Toggle
        // ==================
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');

                // Toggle icon hamburger ↔ times
                const icon = mobileBtn.querySelector('i');
                if (icon.classList.contains('fa-bars')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });

            // Auto close menu ketika link diklik (mobile)
            const mobileLinks = mobileMenu.querySelectorAll('a, button');
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    // Reset icon ke hamburger
                    const icon = mobileBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                });
            });
        }

        // ==================
        // 2. Smooth Scroll dengan offset navbar
        // ==================
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (!targetId || targetId === '#') return;

                const target = document.querySelector(targetId);
                if (!target) return;

                const navbarHeight = document.querySelector('nav').offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
                const offsetPosition = targetPosition - navbarHeight - 10;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            });
        });

        // ==================
        // 3. Tutup mobile menu saat klik di luar
        // ==================
        document.addEventListener('click', (e) => {
            if (!mobileMenu || !mobileBtn) return;

            const isClickInsideMenu = mobileMenu.contains(e.target);
            const isClickOnButton = mobileBtn.contains(e.target);

            if (!isClickInsideMenu && !isClickOnButton && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                const icon = mobileBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // ==================
        // 4. Optimize input pada mobile
        // ==================
        const inputs = document.querySelectorAll('input[type="text"], input[type="datetime-local"]');
        inputs.forEach(input => {
            input.addEventListener('touchstart', function(e) {
                e.stopPropagation();
            });
        });

        // ==================
        // 5. Fix viewport height untuk mobile
        // ==================
        function setVh() {
            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }
        setVh();
        window.addEventListener('resize', setVh);
        window.addEventListener('orientationchange', setVh);
    });

    // ==================
    // 6. Optimize untuk mobile performance
    // ==================
    let deferredPrompt;
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
    });
    </script>
</body>
</html>
