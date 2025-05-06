<x-guest-with-nav-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-6">Tentang Kami</h1>

                    <div class="prose max-w-none">
                        <p class="mb-4">Open Tender KKL adalah platform digital yang dikembangkan oleh Program Studi D3 Teknik Informatika UDINUS untuk memfasilitasi proses tender Kuliah Kerja Lapangan (KKL) secara transparan dan efisien.</p>

                        <h2 class="text-xl font-semibold mt-6 mb-4">Visi</h2>
                        <p class="mb-4">Menjadi platform tender digital terpercaya yang menghubungkan Program Studi D3 Teknik Informatika UDINUS dengan biro perjalanan profesional untuk pelaksanaan KKL yang berkualitas.</p>

                        <h2 class="text-xl font-semibold mt-6 mb-4">Misi</h2>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Menyediakan platform yang transparan dan adil untuk proses tender KKL</li>
                            <li>Memudahkan proses pengajuan dan evaluasi proposal dari biro perjalanan</li>
                            <li>Memastikan kualitas pelaksanaan KKL melalui seleksi biro perjalanan yang ketat</li>
                            <li>Mengoptimalkan komunikasi antara pihak kampus dengan biro perjalanan</li>
                        </ul>

                        <h2 class="text-xl font-semibold mt-6 mb-4">Tim Kami</h2>
                        <p class="mb-4">Platform ini dikelola oleh tim yang terdiri dari:</p>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Koordinator KKL D3 Teknik Informatika</li>
                            <li>Tim Seleksi dan Evaluasi</li>
                            <li>Tim Administrasi</li>
                            <li>Tim Technical Support</li>
                        </ul>

                        <p class="mt-6">Untuk informasi lebih lanjut, silakan hubungi kami melalui:</p>
                        <ul class="list-none pl-6 mt-2">
                            <li>Email: {{ $contactSettings->email }}</li>
                            <li>Telepon: {{ $contactSettings->phone }}</li>
                            <li>Alamat: {{ $contactSettings->address }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-with-nav-layout>
