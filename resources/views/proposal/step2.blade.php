@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Submit Proposal - Step 2') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="mb-2 text-lg font-semibold">Format Nama File:</h3>
                        <ul class="mt-1 ml-4 text-sm text-gray-600 list-disc">
                            <li>KTP: {{ Str::slug($proposal->nama_biro) }}_ktp.pdf/jpg/png</li>
                            <li>Foto Kantor: {{ Str::slug($proposal->nama_biro) }}_kantor.jpg/png</li>
                            <li>Akta Notaris: {{ Str::slug($proposal->nama_biro) }}_akta.pdf/jpg/png</li>
                            <li>Company Profile: {{ Str::slug($proposal->nama_biro) }}_companyprofile.pdf</li>
                            <li>Penawaran: {{ Str::slug($proposal->nama_biro) }}_penawaran.pdf</li>
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('proposal.submitStep2') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Scan KTP -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Scan KTP sesuai NPWP</label>
                                <input type="file"
                                    id="scan_ktp"
                                    name="scan_ktp"
                                    data-filepond
                                    accept="application/pdf,image/jpeg,image/png"
                                    required>
                                @error('scan_ktp')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Foto Kantor -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Foto Kantor</label>
                                <input type="file"
                                    id="foto_kantor"
                                    name="foto_kantor"
                                    data-filepond
                                    accept="image/jpeg,image/png"
                                    required>
                                @error('foto_kantor')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Scan Akta -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Scan Akta Notaris</label>
                                <input type="file"
                                    id="scan_akta"
                                    name="scan_akta"
                                    data-filepond
                                    accept="application/pdf,image/jpeg,image/png"
                                    required>
                                @error('scan_akta')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Company Profile -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Company Profile</label>
                                <input type="file"
                                    id="company_profile"
                                    name="company_profile"
                                    data-filepond
                                    accept="application/pdf"
                                    required>
                                @error('company_profile')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penawaran -->
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Dokumen Penawaran</label>
                                <input type="file"
                                    id="penawaran"
                                    name="penawaran"
                                    data-filepond
                                    accept="application/pdf"
                                    required>
                                @error('penawaran')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="agree_terms" name="agree_terms" type="checkbox" required
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="agree_terms" class="font-medium text-gray-700">Saya menyetujui syarat dan ketentuan yang berlaku</label>
                                </div>
                            </div>
                            @error('agree_terms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('proposal.step1') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Kembali
                            </a>
                            <button type="submit" id="submitButton" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Submit Proposal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Register FilePond plugins
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize
            );

            // Initialize FilePond for each file input
            const inputs = {
                'scan_ktp': ['application/pdf', 'image/jpeg', 'image/png'],
                'foto_kantor': ['image/jpeg', 'image/png'],
                'scan_akta': ['application/pdf', 'image/jpeg', 'image/png'],
                'company_profile': ['application/pdf'],
                'penawaran': ['application/pdf']
            };

            Object.entries(inputs).forEach(([inputId, acceptedFileTypes]) => {
                const element = document.getElementById(inputId);
                if (element) {
                    const pond = FilePond.create(element, {
                        acceptedFileTypes: acceptedFileTypes,
                        storeAsFile: true,
                        maxFileSize: '2MB',
                        labelIdle: 'Drag & Drop atau <span class="filepond--label-action">Browse</span>',
                        labelFileProcessingComplete: 'File siap diupload',
                        labelFileProcessingError: 'Error saat memproses file',
                        labelFileProcessingAborted: 'Upload dibatalkan',
                        labelMaxFileSizeExceeded: 'File terlalu besar',
                        labelMaxFileSize: 'Maksimal ukuran file adalah 2MB',
                        required: true
                    });
                }
            });

            // Handle form submission
            const form = document.querySelector('form');
            const submitButton = document.getElementById('submitButton');
            const agreeTerms = document.getElementById('agree_terms');

            if (agreeTerms && submitButton) {
                agreeTerms.addEventListener('change', () => {
                    submitButton.disabled = !agreeTerms.checked;
                });

                submitButton.disabled = !agreeTerms.checked;
            }
        });
    </script>
    @endpush
</x-app-layout>
