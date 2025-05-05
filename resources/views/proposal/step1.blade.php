<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Submit Proposal - Step 1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Detail Informasi Biro</h3>
                        <p class="mt-1 text-sm text-gray-600">Silakan lengkapi informasi biro perjalanan Anda.</p>
                    </div>

                    <form method="POST" action="{{ route('proposal.submitStep1') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="nama_biro" class="block text-sm font-medium text-gray-700">Nama Biro</label>
                                <input type="text" id="nama_biro" name="nama_biro" value="{{ $nama_biro }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="email_biro" class="block text-sm font-medium text-gray-700">Email Biro</label>
                                <input type="email" id="email_biro" name="email_biro" value="{{ $email_biro }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ $nomor_telepon }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="nomor_npwp" class="block text-sm font-medium text-gray-700">Nomor NPWP</label>
                                <input type="text" id="nomor_npwp" name="nomor_npwp" value="{{ $nomor_npwp }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label for="alamat_kantor" class="block text-sm font-medium text-gray-700">Alamat Kantor</label>
                                <textarea id="alamat_kantor" name="alamat_kantor" rows="3" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $alamat_kantor }}</textarea>
                            </div>

                            <div>
                                <label for="informasi_kkl" class="block text-sm font-medium text-gray-700">Mendapatkan Informasi KKL Dari</label>
                                <select id="informasi_kkl" name="informasi_kkl" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Pilih sumber informasi</option>
                                    <option value="sosial_media" {{ $informasi_kkl == 'sosial_media' ? 'selected' : '' }}>Sosial Media</option>
                                    <option value="rekanan" {{ $informasi_kkl == 'rekanan' ? 'selected' : '' }}>Rekanan</option>
                                    <option value="mahasiswa" {{ $informasi_kkl == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    <option value="lainnya" {{ $informasi_kkl == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label for="detail_informasi" class="block text-sm font-medium text-gray-700">Detail Informasi</label>
                                <input type="text" id="detail_informasi" name="detail_informasi" value="{{ $detail_informasi }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-3">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Lanjut ke Step 2
                                <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
