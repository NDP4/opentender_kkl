<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Buat Pengumuman Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.announcements.store') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Tipe Pengumuman</label>
                            <select name="type" id="type" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="presentation">Pengumuman Presentasi</option>
                                <option value="winner">Pengumuman Pemenang Tender</option>
                            </select>
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Pengumuman</label>
                            <input type="text" name="title" id="title" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Isi Pengumuman</label>
                            <textarea name="content" id="content" rows="5" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                            <p class="mt-1 text-sm text-gray-500" id="content-help">Masukkan informasi lengkap tentang pengumuman.</p>
                        </div>

                        <div>
                            <label for="announcement_date" class="block text-sm font-medium text-gray-700">Tanggal Pelaksanaan</label>
                            <input type="datetime-local" name="announcement_date" id="announcement_date" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div id="presentation-biros-section">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Biro yang Lolos ke Tahap Presentasi</label>
                            <div class="mt-2 p-4 border rounded-md max-h-96 overflow-y-auto">
                                @php
                                    $reviewedBiros = \App\Models\User::whereHas('proposals', function($query) {
                                        $query->whereIn('status', ['accepted']);
                                    })->get();
                                @endphp

                                @if($reviewedBiros->isEmpty())
                                    <p class="text-gray-500">Belum ada biro yang dapat dipilih.</p>
                                @else
                                    @foreach($reviewedBiros as $biro)
                                        @php
                                            $proposal = $biro->proposals()->latest()->first();
                                        @endphp
                                        <div class="flex items-center space-x-3 py-2">
                                            <input type="checkbox"
                                                id="biro_{{ $biro->id }}"
                                                name="selected_biros[]"
                                                value="{{ $biro->id }}"
                                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="biro_{{ $biro->id }}" class="text-sm text-gray-700">
                                                {{ $biro->name }} - {{ $proposal->nama_biro }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Hanya biro yang proposalnya diterima yang dapat dipilih.</p>
                        </div>

                        <div id="winner-biros-section" style="display: none;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Biro Pemenang Tender</label>
                            <div class="mt-2 p-4 border rounded-md max-h-96 overflow-y-auto">
                                @php
                                    $confirmedBiros = \App\Models\User::whereHas('presentationConfirmations', function($query) {
                                        $query->where('status', 'confirmed');
                                    })->whereHas('proposals', function($query) {
                                        $query->where('status', 'accepted');
                                    })->get();
                                @endphp

                                @if($confirmedBiros->isEmpty())
                                    <p class="text-gray-500">Belum ada biro yang mengkonfirmasi kehadiran presentasi.</p>
                                @else
                                    @foreach($confirmedBiros as $biro)
                                        @php
                                            $proposal = $biro->proposals()->where('status', 'accepted')->latest()->first();
                                        @endphp
                                        @if($proposal)
                                            <div class="flex items-center space-x-3 py-2">
                                                <input type="radio"
                                                    id="winner_biro_{{ $biro->id }}"
                                                    name="selected_biros[]"
                                                    value="{{ $biro->id }}"
                                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded-full focus:ring-blue-500">
                                                <label for="winner_biro_{{ $biro->id }}" class="text-sm text-gray-700">
                                                    {{ $biro->name }} - {{ $proposal->nama_biro }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Hanya biro yang telah mengkonfirmasi kehadiran presentasi dan memiliki proposal yang diterima yang dapat dipilih.</p>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                Kirim Pengumuman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const presentationSection = document.getElementById('presentation-biros-section');
            const winnerSection = document.getElementById('winner-biros-section');
            const contentHelp = document.getElementById('content-help');

            typeSelect.addEventListener('change', function() {
                if (this.value === 'presentation') {
                    presentationSection.style.display = 'block';
                    winnerSection.style.display = 'none';
                    contentHelp.textContent = 'Masukkan informasi lengkap tentang jadwal dan tempat presentasi.';
                } else {
                    presentationSection.style.display = 'none';
                    winnerSection.style.display = 'block';
                    contentHelp.textContent = 'Masukkan informasi lengkap tentang pengumuman pemenang tender.';
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
