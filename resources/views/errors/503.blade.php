@extends('layouts.error')

@section('title', '503 - Layanan Tidak Tersedia')

@section('content')
<div class="p-8 text-center">
    <div class="mb-6">
        <div class="inline-block p-6 bg-blue-100 rounded-full">
            <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
    </div>

    <h1 class="mb-3 text-5xl font-bold text-gray-900">503</h1>
    <h2 class="mb-4 text-xl font-medium text-gray-700">Layanan Sedang Pemeliharaan</h2>

    <p class="mb-4 text-gray-500">
        Website sedang dalam pemeliharaan untuk meningkatkan layanan kami.
    </p>
    <p class="mb-8 text-sm text-gray-400">
        Estimasi waktu: {{ isset($exception) && $exception->getMessage() ? $exception->getMessage() : '± 30 menit' }}
    </p>

    <a href="{{ url()->current() }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
        Coba Lagi
    </a>
</div>
@endsection
