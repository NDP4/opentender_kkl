<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Open Tender KKL - D3 Teknik Informatika UDINUS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <!-- Loading Spinner -->
    <div id="loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
        <div class="w-16 h-16 border-t-4 border-b-4 border-blue-600 rounded-full animate-spin"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed z-40 w-full bg-white shadow-lg">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-blue-600">OpenTender KKL</a>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 transition hover:text-blue-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 transition hover:text-blue-600">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-12 bg-gradient-to-br from-blue-50 to-white">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:gap-12">
                <div class="lg:w-1/2">
                    <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl md:text-6xl">
                        Tender Portal KKL <span class="text-blue-600">D3 TI UDINUS</span>
                    </h1>
                    <p class="mt-6 text-lg text-gray-600">
                        Platform untuk biro perjalanan wisata dalam mengajukan penawaran paket perjalanan KKL D3 Teknik Informatika UDINUS. Daftarkan perusahaan Anda dan ikuti proses tender dengan mudah dan transparan.
                    </p>
                    <div class="mt-8">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                                Daftar Sekarang
                                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="mt-12 lg:mt-0 lg:w-1/2">
                    <img src="https://via.placeholder.com/600x400" alt="Hero Image" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-16 bg-white">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Cara Mengikuti Tender</h2>
                <p class="mt-4 text-lg text-gray-600">Ikuti langkah-langkah sederhana berikut untuk mengajukan penawaran</p>
            </div>

            <div class="mt-16">
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Step 1 -->
                    <div class="relative p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                        <div class="absolute flex items-center justify-center w-8 h-8 font-bold text-white bg-blue-600 rounded-full -top-4 left-4">1</div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Pendaftaran</h3>
                        <p class="mt-4 text-gray-600">Daftar menggunakan email resmi perusahaan Anda melalui tombol register</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                        <div class="absolute flex items-center justify-center w-8 h-8 font-bold text-white bg-blue-600 rounded-full -top-4 left-4">2</div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Verifikasi Email</h3>
                        <p class="mt-4 text-gray-600">Periksa email Anda dan klik tautan verifikasi yang kami kirimkan</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                        <div class="absolute flex items-center justify-center w-8 h-8 font-bold text-white bg-blue-600 rounded-full -top-4 left-4">3</div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Submit Proposal</h3>
                        <p class="mt-4 text-gray-600">Lengkapi data dan unggah dokumen yang diperlukan di dashboard</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                        <div class="absolute flex items-center justify-center w-8 h-8 font-bold text-white bg-blue-600 rounded-full -top-4 left-4">4</div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Seleksi Berkas</h3>
                        <p class="mt-4 text-gray-600">Tim kami akan menyeleksi berkas penawaran yang telah diajukan</p>
                    </div>

                    <!-- Step 5 -->
                    <div class="relative p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                        <div class="absolute flex items-center justify-center w-8 h-8 font-bold text-white bg-blue-600 rounded-full -top-4 left-4">5</div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Presentasi</h3>
                        <p class="mt-4 text-gray-600">Biro yang lolos seleksi berkas akan diundang untuk presentasi</p>
                    </div>

                    <!-- Step 6 -->
                    <div class="relative p-6 bg-white border border-gray-100 rounded-lg shadow-lg">
                        <div class="absolute flex items-center justify-center w-8 h-8 font-bold text-white bg-blue-600 rounded-full -top-4 left-4">6</div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Pengumuman</h3>
                        <p class="mt-4 text-gray-600">Pengumuman biro perjalanan yang terpilih akan diinformasikan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white bg-gray-900">
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div>
                    <h3 class="text-xl font-bold">OpenTender KKL</h3>
                    <p class="mt-4 text-gray-400">Platform tender untuk biro perjalanan KKL D3 Teknik Informatika UDINUS</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold">Kontak</h3>
                    <ul class="mt-4 space-y-2 text-gray-400">
                        <li>Email: kkl@dinus.ac.id</li>
                        <li>Phone: (024) 3517261</li>
                        <li>Address: Jl. Imam Bonjol No.207, Semarang</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold">Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-400 transition hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-white">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 mt-8 text-center text-gray-400 border-t border-gray-800">
                <p>&copy; {{ date('Y') }} OpenTender KKL. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Loader
        window.addEventListener('load', function() {
            document.getElementById('loader').style.display = 'none';
        });
    </script>
</body>
</html>
