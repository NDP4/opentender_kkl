<x-guest-with-nav-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-6 text-3xl font-bold">Kebijakan Privasi</h1>

                    <div class="prose max-w-none">
                        <p class="mb-4">Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi yang Anda berikan di platform Open Tender KKL.</p>

                        <h2 class="mt-6 mb-4 text-xl font-semibold">1. Informasi yang Kami Kumpulkan</h2>
                        <p class="mb-4">Kami mengumpulkan informasi berikut:</p>
                        <ul class="pl-6 mb-4 list-disc">
                            <li>Informasi identitas (nama, email, nomor telepon)</li>
                            <li>Informasi perusahaan (nama biro, NPWP, alamat)</li>
                            <li>Dokumen yang diunggah (KTP, akta, company profile)</li>
                            <li>Data aktivitas penggunaan platform</li>
                        </ul>

                        <h2 class="mt-6 mb-4 text-xl font-semibold">2. Penggunaan Informasi</h2>
                        <p class="mb-4">Informasi yang kami kumpulkan digunakan untuk:</p>
                        <ul class="pl-6 mb-4 list-disc">
                            <li>Memproses pendaftaran dan proposal tender</li>
                            <li>Komunikasi terkait proses tender</li>
                            <li>Evaluasi dan penilaian proposal</li>
                            <li>Peningkatan layanan platform</li>
                        </ul>

                        <h2 class="mt-6 mb-4 text-xl font-semibold">3. Perlindungan Data</h2>
                        <ul class="pl-6 mb-4 list-disc">
                            <li>Kami menggunakan enkripsi standar industri</li>
                            <li>Akses data dibatasi hanya untuk tim yang berwenang</li>
                            <li>Data disimpan di server yang aman</li>
                            <li>Backup data dilakukan secara berkala</li>
                        </ul>

                        <h2 class="mt-6 mb-4 text-xl font-semibold">4. Sharing Data</h2>
                        <p class="mb-4">Kami tidak akan membagikan data Anda kepada pihak ketiga kecuali:</p>
                        <ul class="pl-6 mb-4 list-disc">
                            <li>Diperlukan oleh hukum yang berlaku</li>
                            <li>Atas persetujuan tertulis dari Anda</li>
                            <li>Bagian dari proses evaluasi tender</li>
                        </ul>

                        <h2 class="mt-6 mb-4 text-xl font-semibold">5. Hak Pengguna</h2>
                        <p class="mb-4">Anda memiliki hak untuk:</p>
                        <ul class="pl-6 mb-4 list-disc">
                            <li>Mengakses data pribadi Anda</li>
                            <li>Memperbarui data yang tidak akurat</li>
                            <li>Meminta penghapusan data (dengan ketentuan)</li>
                            <li>Mendapatkan informasi penggunaan data</li>
                        </ul>

                        <h2 class="mt-6 mb-4 text-xl font-semibold">6. Kontak</h2>
                        <p class="mb-4">Untuk pertanyaan terkait privasi data, hubungi:</p>
                        <ul class="pl-6 mb-4 list-none">
                            <li>Email: {{ $contactSettings->email }}</li>
                            <li>Telepon: {{ $contactSettings->phone }}</li>
                        </ul>

                        <p class="mt-6 text-sm">Kebijakan privasi ini dapat diperbarui sewaktu-waktu. Perubahan akan diumumkan melalui platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-with-nav-layout>
