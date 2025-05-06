@extends('layouts.error')

@section('title', '500 - Kesalahan Server')

@section('content')
<div class="p-8 text-center">
    <div class="mb-6">
        <div class="inline-block p-6 bg-yellow-100 rounded-full">
            <svg class="w-16 h-16 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
    </div>

    <h1 class="mb-3 text-5xl font-bold text-gray-900">500</h1>
    <h2 class="mb-4 text-xl font-medium text-gray-700">Kesalahan Server</h2>

    <p class="mb-8 text-gray-500">
        Maaf, telah terjadi kesalahan pada server kami. Tim kami sedang bekerja untuk memperbaikinya.
    </p>

    <div class="space-x-4">
        <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
            Kembali ke Beranda
        </a>
        <a href="{{ url()->current() }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-blue-600 transition bg-blue-100 rounded-lg hover:bg-blue-200">
            Coba Lagi
        </a>
    </div>
</div>
@endsection
