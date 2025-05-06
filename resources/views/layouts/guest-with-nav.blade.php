<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Open Tender KKL - D3 Teknik Informatika UDINUS</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%232563eb'><path d='M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z'/></svg>" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
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

    <!-- Main Content -->
    <main class="pt-16">
        {{ $slot }}
    </main>

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
                        <li>Email: {{ $contactSettings->email }}</li>
                        <li>Phone: {{ $contactSettings->phone }}</li>
                        <li>Address: {{ $contactSettings->address }}</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold">Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="{{ route('about') }}" class="text-gray-400 transition hover:text-white">Tentang Kami</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-400 transition hover:text-white">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 transition hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 mt-8 text-center text-gray-400 border-t border-gray-800">
                <p>&copy; {{ date('Y') }} OpenTender KKL. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
