<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Review Proposal - {{ $proposal->nama_biro }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 space-y-4">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <h3 class="text-lg font-semibold">Informasi Biro</h3>
                                <div class="mt-4 space-y-2">
                                    <p><span class="font-medium">Nama Biro:</span> {{ $proposal->nama_biro }}</p>
                                    <p><span class="font-medium">Email:</span> {{ $proposal->email_biro }}</p>
                                    <p><span class="font-medium">No. Telepon:</span> {{ $proposal->nomor_telepon }}</p>
                                    <p><span class="font-medium">Alamat:</span> {{ $proposal->alamat_kantor }}</p>
                                    <p><span class="font-medium">NPWP:</span> {{ $proposal->nomor_npwp }}</p>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Detail Pengajuan</h3>
                                <div class="mt-4 space-y-2">
                                    <p><span class="font-medium">Tanggal Submit:</span> {{ $proposal->updated_at->format('d F Y H:i') }}</p>
                                    <p><span class="font-medium">Status:</span>
                                        <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                            Menunggu Review
                                        </span>
                                    </p>
                                    <p><span class="font-medium">Sumber Informasi:</span> {{ ucfirst($proposal->informasi_kkl) }}</p>
                                    <p><span class="font-medium">Detail Informasi:</span> {{ $proposal->detail_informasi }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-lg font-semibold">Dokumen Proposal</h3>
                            <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                                @foreach($proposal->files as $file)
                                    <div class="p-4 border rounded-lg">
                                        <h4 class="mb-2 font-medium">{{ ucfirst(str_replace('_', ' ', $file->type)) }}</h4>
                                        @if(in_array(strtolower(pathinfo($file->original_name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']))
                                            <img src="{{ Storage::url($file->file_path) }}" alt="{{ $file->type }}" class="object-cover w-full h-48 mb-2 rounded">
                                        @endif
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">{{ $file->original_name }}</span>
                                            <a href="{{ route('admin.download.file', $file->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-8">
                            <form action="{{ route('admin.review.submit', $proposal->id) }}" method="POST">
                                @csrf
                                <div class="p-4 border rounded-lg">
                                    <h3 class="mb-4 text-lg font-semibold">Review Proposal</h3>
                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-medium text-gray-700">Status Review</label>
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <input type="radio" name="status" value="accepted" id="status_accepted" class="w-4 h-4 text-blue-600 border-gray-300" required>
                                                <label for="status_accepted" class="ml-2 text-sm text-gray-700">Terima Proposal</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" name="status" value="rejected" id="status_rejected" class="w-4 h-4 text-blue-600 border-gray-300" required>
                                                <label for="status_rejected" class="ml-2 text-sm text-gray-700">Tolak Proposal</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="review_notes" class="block mb-2 text-sm font-medium text-gray-700">Catatan Review</label>
                                        <textarea id="review_notes" name="review_notes" rows="4" class="block w-full p-2 text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required></textarea>
                                    </div>
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                            Kembali
                                        </a>
                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                            Submit Review
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
