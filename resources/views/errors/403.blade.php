@extends('layouts.error')

@section('title', '403 - Akses Ditolak')

@section('content')
<div class="p-8 text-center">
    <div class="mb-6">
        <div class="inline-block p-6 bg-red-100 rounded-full">
            <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H8m4-6V4m0 0h2m-2 0H8m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <h1 class="mb-3 text-5xl font-bold text-gray-900">403</h1>
    <h2 class="mb-4 text-xl font-medium text-gray-700">Akses Ditolak</h2>

    <p class="mb-8 text-gray-500">
        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
    </p>

    <a href="{{ url()->previous() }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
        Kembali
    </a>
</div>
@endsection
