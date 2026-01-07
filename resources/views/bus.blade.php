<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Bus - MIKA TRANS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mika Trans Pekanbaru | Sewa Bus Pariwisata & Travel Riau Terpercaya</title>
    <meta name="description" content="PT MIKATRANS PEKANBARU: Layanan Sewa Bus Pariwisata Premium (31-50 Seat) & Travel Executive Pekanbaru - Tembilahan. Armada modern, aman, dan tepat waktu.">
    <meta name="keywords" content="mika trans, bus pariwisata pekanbaru, travel pekanbaru tembilahan, sewa bus riau, sewa bus pariwisata riau, travel mika trans, tiket travel pekanbaru">
    <meta name="author" content="MIKA TRANS">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="http://mikatrans.com/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="http://mikatrans.com/">
    <meta property="og:title" content="Mika Trans Pekanbaru | Sewa Bus Pariwisata & Travel Riau">
    <meta property="og:description" content="Solusi perjalanan nyaman di Riau. Sewa Bus Pariwisata dan Travel Executive Pekanbaru-Tembilahan PP. Hubungi +62 822-8802-3332.">
    <meta property="og:image" content="{{ asset('image/bus.png') }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://mikatrans.com/">
    <meta property="twitter:title" content="Mika Trans Pekanbaru | Sewa Bus Pariwisata & Travel Riau">
    <meta property="twitter:description" content="Layanan transportasi bus & travel terbaik di Pekanbaru dengan armada modern dan driver profesional.">
    <meta property="twitter:image" content="{{ asset('image/bus.png') }}">

    <meta name="geo.region" content="ID-RI">
    <meta name="geo.placename" content="Pekanbaru">
    <meta name="geo.position" content="0.507068;101.447779">
    <meta name="ICBM" content="0.507068, 101.447779">

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

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
                    }
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
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
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-md shadow-lg fixed w-full top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center space-x-4 group">
                    <div class="gradient-accent text-white rounded-lg p-0 shadow-lg group-hover:scale-10 transition-transform duration-300">
                        <img src="{{ asset('image/gambar.png') }}" alt="Logo MIKA TRANS" class="w-14 h-14 object-contain">
                    </div>
                    <div>
                        <span class="text-2xl font-bold text-primary">MIKA</span>
                        <span class="text-2xl font-bold text-accent">TRANS</span>
                        <div class="text-xs text-gray-500 -mt-1">Premium Bus dan Travel di Pekanbaru</div>
                    </div>
                </div>

                <div class="hidden lg:flex items-center space-x-6">
                    <a href="/" class="text-gray-700 text-sm hover:text-accent transition-colors relative group">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/bus" class="text-primary text-sm font-semibold hover:text-accent transition-colors relative group">
                        Bus
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-accent"></span>
                    </a>
                    <a href="/travel" class="text-gray-700 text-sm hover:text-accent transition-colors relative group">
                        Travel
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
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
                       <button onclick="window.location.href='/admin/login'" class="login-admin-btn gradient-accent text-primary-dark text-sm font-bold px-5 py-2 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center">
        <i class="fas fa-user-shield mr-1.5"></i>
        Login
    </button>
                </div>

                <button id="mobile-menu-btn" class="lg:hidden text-primary focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <div id="mobile-menu" class="hidden lg:hidden pb-4 space-y-1">
                <a href="/" class="block py-2 text-sm text-gray-700 hover:bg-accent/10 px-3 rounded-lg transition">Home</a>
                <a href="/bus" class="block py-2 text-sm text-primary font-semibold bg-accent/10 px-3 rounded-lg">Bus</a>
                <a href="/travel" class="block py-2 text-sm text-gray-700 hover:bg-accent/10 px-3 rounded-lg transition">Travel</a>
                <a href="/#tentang" class="block py-2 text-sm text-gray-700 hover:bg-accent/10 px-3 rounded-lg transition">Tentang</a>
                <a href="/#kontak" class="block py-2 text-sm text-gray-700 hover:bg-accent/10 px-3 rounded-lg transition">Kontak</a>
                <button class="w-full gradient-accent text-sm text-primary-dark font-bold py-2 rounded-lg mt-2">
                    <i class="fas fa-ticket-alt mr-1.5"></i>
                    Pesan Tiket
                </button>
                   <button onclick="window.location.href='/admin/login'" class="login-admin-btn gradient-accent text-primary-dark text-sm font-bold px-5 py-2 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center">
        <i class="fas fa-user-shield mr-1.5"></i>
        Login
    </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 gradient-dark text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-48 h-48 bg-accent rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <span class="bg-accent/20 text-accent px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-accent/30">
                    🚌 Layanan Bus Premium
                </span>
                <h1 class="text-4xl lg:text-5xl font-bold mt-6 mb-4">
                    Perjalanan Jauh <span class="gradient-accent bg-clip-text text-transparent">Lebih Nyaman</span>
                </h1>
                <p class="text-lg text-gray-300 mb-8">
                    Nikmati perjalanan antar kota dengan bus premium kami. Kursi lebar, AC sejuk, dan fasilitas lengkap untuk kenyamanan maksimal Anda.
                </p>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-8 bg-white shadow-md -mt-8 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kota Asal</label>
                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                        <option>Jakarta</option>
                        <option>Bandung</option>
                        <option>Surabaya</option>
                        <option>Yogyakarta</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kota Tujuan</label>
                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                        <option>Bandung</option>
                        <option>Jakarta</option>
                        <option>Malang</option>
                        <option>Semarang</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                    <input type="date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                </div>
                <div class="flex items-end">
                    <button class="w-full gradient-accent text-primary-dark font-bold py-3 rounded-lg hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-search mr-2"></i>
                        Cari Bus
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Kelas Bus Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Pilihan Kelas</span>
                <h2 class="text-3xl font-bold text-primary mb-3 mt-2">
                    Kelas <span class="gradient-accent bg-clip-text text-transparent">Bus Premium</span>
                </h2>
                <p class="text-gray-600 text-sm max-w-2xl mx-auto">Pilih kelas yang sesuai dengan kebutuhan dan kenyamanan perjalanan Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Ekonomi -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover-lift border-2 border-gray-100">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white text-center">
                        <i class="fas fa-bus text-5xl mb-4"></i>
                        <h3 class="text-2xl font-bold">Ekonomi</h3>
                        <p class="text-sm text-blue-100 mt-2">Hemat & Nyaman</p>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-6">
                            <span class="text-gray-500 text-sm">Mulai dari</span>
                            <div class="text-4xl font-bold text-primary mt-1">75K</div>
                            <span class="text-sm text-gray-500">per orang</span>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Kursi standar reclining
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                AC & WiFi gratis
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Air mineral
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Toilet di dalam bus
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Bagasi 20kg
                            </li>
                        </ul>
                        <button class="w-full bg-primary text-white font-bold py-3 rounded-lg hover:bg-primary-light transition-all duration-300">
                            Pilih Kelas Ini
                        </button>
                    </div>
                </div>

                <!-- Executive -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover-lift border-2 border-accent transform scale-105">
                    <div class="gradient-accent p-6 text-primary-dark text-center relative">
                        <div class="absolute top-2 right-2 bg-white text-accent text-xs font-bold px-3 py-1 rounded-full">
                            POPULER
                        </div>
                        <i class="fas fa-bus text-5xl mb-4"></i>
                        <h3 class="text-2xl font-bold">Executive</h3>
                        <p class="text-sm text-primary-dark/80 mt-2">Kenyamanan Lebih</p>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-6">
                            <span class="text-gray-500 text-sm">Mulai dari</span>
                            <div class="text-4xl font-bold text-primary mt-1">120K</div>
                            <span class="text-sm text-gray-500">per orang</span>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-accent mr-3"></i>
                                Kursi lebar dengan legroom extra
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-accent mr-3"></i>
                                AC & WiFi premium
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-accent mr-3"></i>
                                Snack & minuman
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-accent mr-3"></i>
                                USB charging port
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-accent mr-3"></i>
                                Bagasi 30kg
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-accent mr-3"></i>
                                Entertainment system
                            </li>
                        </ul>
                        <button class="w-full gradient-accent text-primary-dark font-bold py-3 rounded-lg shine-effect hover:shadow-xl transition-all duration-300">
                            Pilih Kelas Ini
                        </button>
                    </div>
                </div>

                <!-- VIP -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover-lift border-2 border-gray-100">
                    <div class="bg-gradient-to-br from-purple-600 to-purple-700 p-6 text-white text-center">
                        <i class="fas fa-crown text-5xl mb-4"></i>
                        <h3 class="text-2xl font-bold">VIP</h3>
                        <p class="text-sm text-purple-100 mt-2">Kemewahan Maksimal</p>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-6">
                            <span class="text-gray-500 text-sm">Mulai dari</span>
                            <div class="text-4xl font-bold text-primary mt-1">180K</div>
                            <span class="text-sm text-gray-500">per orang</span>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Kursi sofa reclining 160°
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                AC individual control
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Meal box premium
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Personal TV & headphone
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Bagasi unlimited
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Priority boarding
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Blanket & pillow
                            </li>
                        </ul>
                        <button class="w-full bg-purple-600 text-white font-bold py-3 rounded-lg hover:bg-purple-700 transition-all duration-300">
                            Pilih Kelas Ini
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section id="jadwal" class="py-20 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <span class="bg-accent/10 text-accent-dark px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border border-accent/20">
                Layanan Armada
            </span>
            <h2 class="text-4xl font-extrabold text-primary mt-4">
                Bus <span class="gradient-accent bg-clip-text text-transparent">Pariwisata</span>
            </h2>
            <div class="w-24 h-1.5 gradient-accent mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-600 mt-4 max-w-xl mx-auto">
                Solusi perjalanan grup yang aman dan nyaman dengan berbagai pilihan kapasitas armada untuk kebutuhan acara Anda.
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-12 items-center">

            <div class="lg:col-span-5 relative group">
                <div class="absolute -inset-4 gradient-accent opacity-20 blur-2xl rounded-full group-hover:opacity-30 transition duration-500"></div>
                <div class="relative z-10 overflow-hidden rounded-3xl shadow-2xl border-8 border-white">
                    <img src="{{ asset('image/bus.png') }}"
                         alt="Bus Pariwisata Mika Trans"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent flex items-end p-8">
                        <div>
                            <p class="text-accent font-bold text-lg">Mika Trans</p>
                            <p class="text-white text-sm opacity-90">Unit Bersih & Driver Berpengalaman</p>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-6 -right-6 z-20 bg-white p-5 rounded-2xl shadow-xl border border-gray-100 hidden md:block animate-bounce-slow">
                    <div class="flex items-center space-x-3">
                        <div class="bg-accent/10 p-2 rounded-lg text-accent-dark">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Kapasitas Kursi</p>
                            <p class="text-sm font-bold text-primary">31 & 50 Seat Available</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="mb-8">
                    <h3 class="text-3xl font-bold text-primary flex items-center">
                        <i class="fas fa-star text-accent mr-4"></i>
                        Pilihan Paket Wisata
                    </h3>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                        <div class="bg-orange-50 text-orange-600 p-3 rounded-xl">
                            <i class="fas fa-users-items text-xl"></i>
                        </div>
                        <span class="font-bold text-gray-700">Family Gathering</span>
                    </div>

                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                        <div class="bg-blue-50 text-blue-600 p-3 rounded-xl">
                            <i class="fas fa-graduation-cap text-xl"></i>
                        </div>
                        <span class="font-bold text-gray-700">Study Tour</span>
                    </div>

                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                        <div class="bg-green-50 text-green-600 p-3 rounded-xl">
                            <i class="fas fa-mosque text-xl"></i>
                        </div>
                        <span class="font-bold text-gray-700">Perjalanan Ziarah</span>
                    </div>

                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                        <div class="bg-purple-50 text-purple-600 p-3 rounded-xl">
                            <i class="fas fa-map-marked-alt text-xl"></i>
                        </div>
                        <span class="font-bold text-gray-700">Tour Wisata</span>
                    </div>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center p-4 bg-white rounded-xl border-l-4 border-accent shadow-sm">
                        <i class="fas fa-check-circle text-accent w-8 text-center text-lg"></i>
                        <span class="ml-3 font-medium text-gray-700">Melayani paket wisata lainnya (DLL) sesuai kebutuhan.</span>
                    </div>
                    <div class="flex items-center p-4 bg-white rounded-xl border-l-4 border-accent shadow-sm">
                        <i class="fas fa-shield-check text-accent w-8 text-center text-lg"></i>
                        <span class="ml-3 font-medium text-gray-700">Pengecekan unit rutin demi keamanan perjalanan.</span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/6281399441555"
                       class="flex-1 shine-effect inline-flex items-center justify-center gradient-dark text-white font-bold py-4 rounded-2xl hover:shadow-2xl transition-all duration-300">
                        <i class="fab fa-whatsapp text-xl mr-3"></i>
                        Booking Bus Sekarang
                    </a>
                    <div class="flex flex-col justify-center px-4 py-2 bg-gray-100 rounded-2xl text-center sm:text-left">
                        <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Hotline</span>
                        <span class="text-primary font-bold">0813-9944-1555</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

    <!-- Footer -->
    <footer id="kontak" class="gradient-dark text-white pt-16 pb-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-20 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-20 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-4 gap-12">
                <!-- Brand & Deskripsi -->
                <div>
                    <div class="flex items-center space-x-2 mb-6">
     <div class="gradient-accent text-white rounded-lg p-0 shadow-lg group-hover:scale-10 transition-transform duration-300">
        <!-- Logo besar -->
        <img src="{{ asset('image/gambar.png') }}" alt="Logo TravelBus" class="w-16 h-16 object-contain">
    </div>
    <div>


                            <span class="text-2xl font-bold">Travel</span><span class="text-2xl font-bold text-accent">Bus</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm mb-6">
                        Perjalanan nyaman, aman, dan terpercaya ke seluruh Indonesia dengan armada modern dan layanan premium.
                    </p>
                    <div class="flex space-x-4">
<div class="flex items-center gap-4">
    <a href="https://www.facebook.com/profile.php?id=100094387691878" target="_blank" class="text-gray-400 hover:text-accent transition">
        <i class="fab fa-facebook-f text-xl"></i>
    </a>

    <a href="https://www.instagram.com/mikatranspariwisata/" target="_blank" class="text-gray-400 hover:text-accent transition">
        <i class="fab fa-instagram text-xl"></i>
    </a>

    <a href="https://maps.app.goo.gl/HTqwqutpMskqaCzL6" target="_blank" class="text-gray-400 hover:text-accent transition">
        <i class="fas fa-map-marker-alt text-xl"></i>
    </a>

    <a href="https://wa.me/6282288023332" target="_blank" class="text-gray-400 hover:text-accent transition flex items-center gap-2">
        <i class="fab fa-whatsapp text-xl"></i>
        <span class="text-sm font-medium"></span>
    </a>
</div>         </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li><a href="#home" class="hover:text-accent transition">Home</a></li>
                        <li><a href="#jadwal" class="hover:text-accent transition">Jadwal</a></li>
                        <li><a href="#booking" class="hover:text-accent transition">Booking</a></li>
                        <li><a href="#tentang" class="hover:text-accent transition">Tentang Kami</a></li>
                        <li><a href="#kontak" class="hover:text-accent transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Layanan Kami</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li>Bus Ekonomi</li>
                        <li>Bus Executive</li>
                        <li>Bus VIP</li>
                        <li>Travel Antar Kota</li>
                        <li>Paket Wisata</li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Hubungi Kami</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-accent mt-1 mr-3"></i>
                            Jalan. H. Usman, Kubang Jaya, Kec. Siak Hulu, Kabupaten Kampar, Riau 28293, Indonesia
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt text-accent mr-3"></i>
                            0822-8802-3332
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-accent mr-3"></i>
                            mikatanspariwisata@gmail.com
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-500 text-sm">
                © 2026 PT.MIKA TRANS. All rights reserved. | Dibuat dengan ❤️ untuk perjalanan Anda
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <!-- JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // ==================
        // 1. Mobile Menu Toggle
        // ==================
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
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
            const mobileLinks = mobileMenu.querySelectorAll('a');
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

                // Sesuaikan nilai ini dengan tinggi navbar Anda (termasuk shadow/margin)
                const navbarOffset = 90; // ±90px biasanya cukup untuk navbar fixed + shadow

                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - navbarOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            });
        });

        // ==================
        // 3. Optional: Tutup mobile menu saat klik di luar area menu (extra UX)
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
    });
    </script>
</body>
</html>
