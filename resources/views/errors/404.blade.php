@extends('layouts.error')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="p-8 text-center">
    <div class="mb-6">
        <div class="inline-block p-6 bg-blue-100 rounded-full">
            <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <h1 class="mb-3 text-5xl font-bold text-gray-900">404</h1>
    <h2 class="mb-4 text-xl font-medium text-gray-700">Halaman Tidak Ditemukan</h2>

    <p class="mb-8 text-gray-500">
        Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.
    </p>

    <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
        Kembali ke Beranda
    </a>
</div>
@endsection
