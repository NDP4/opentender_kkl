@extends('layouts.error')

@section('title', '419 - Halaman Kadaluarsa')

@section('content')
<div class="p-8 text-center">
    <div class="mb-6">
        <div class="inline-block p-6 bg-purple-100 rounded-full">
            <svg class="w-16 h-16 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <h1 class="mb-3 text-5xl font-bold text-gray-900">419</h1>
    <h2 class="mb-4 text-xl font-medium text-gray-700">Halaman Kadaluarsa</h2>

    <p class="mb-8 text-gray-500">
        Maaf, sesi Anda telah berakhir. Silakan refresh halaman dan coba lagi.
    </p>

    <div class="space-x-4">
        <a href="{{ url()->current() }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
            Refresh Halaman
        </a>
        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-blue-600 transition bg-blue-100 rounded-lg hover:bg-blue-200">
            Login Kembali
        </a>
    </div>
</div>
@endsection
