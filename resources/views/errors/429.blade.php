@extends('layouts.error')

@section('title', '429 - Terlalu Banyak Permintaan')

@section('content')
<div class="p-8 text-center">
    <div class="mb-6">
        <div class="inline-block p-6 bg-orange-100 rounded-full">
            <svg class="w-16 h-16 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <h1 class="mb-3 text-5xl font-bold text-gray-900">429</h1>
    <h2 class="mb-4 text-xl font-medium text-gray-700">Terlalu Banyak Permintaan</h2>

    <p class="mb-4 text-gray-500">
        Anda telah membuat terlalu banyak permintaan dalam waktu singkat.
    </p>
    <p class="mb-8 text-sm text-gray-400">
        Silakan tunggu beberapa saat sebelum mencoba lagi.
    </p>

    <div class="space-x-4">
        <button onclick="window.location.reload()" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
            Coba Lagi
        </button>
        <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-blue-600 transition bg-blue-100 rounded-lg hover:bg-blue-200">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
