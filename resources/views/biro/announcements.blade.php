<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Pengumuman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        @if(isset($announcement))
                            @if($announcement->type === 'winner')
                                @if(in_array(auth()->id(), $announcement->selected_biro_ids))
                                    <div class="p-6 border border-green-200 rounded-lg bg-green-50">
                                        <h3 class="mb-4 text-lg font-semibold text-gray-800">Selamat! Anda Menjadi Pemenang Tender</h3>
                                        <div class="mb-6 prose max-w-none">
                                            <p>Dengan senang hati kami informasikan bahwa biro perjalanan Anda telah terpilih sebagai pemenang tender KKL D3 TI UDINUS. Keputusan ini diambil setelah melalui proses evaluasi yang menyeluruh terhadap proposal dan presentasi yang telah Anda berikan.</p>
                                            <p class="mt-4">{{ $announcement->content }}</p>
                                        </div>
                                        <div class="mt-4 text-sm text-gray-600">
                                            <p>Tanggal Pengumuman: {{ $announcement->created_at->format('d M Y H:i') }}</p>
                                            <p>Tanggal Pelaksanaan: {{ $announcement->announcement_date->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @elseif(auth()->user()->presentationConfirmations()->where('status', 'confirmed')->exists())
                                    <div class="p-6 bg-white border border-gray-200 rounded-lg">
                                        <h3 class="mb-4 text-lg font-semibold text-gray-800">Pengumuman Hasil Akhir Tender</h3>
                                        <div class="mb-6 prose max-w-none">
                                            <p>Terima kasih atas partisipasi Anda dalam proses tender KKL D3 TI UDINUS. Setelah melalui proses evaluasi yang menyeluruh, dengan berat hati kami informasikan bahwa biro perjalanan Anda belum terpilih sebagai pemenang tender KKL.</p>
                                            <p class="mt-4">Kami sangat menghargai waktu dan upaya yang telah Anda berikan selama proses tender ini.</p>
                                        </div>
                                        <div class="mt-4 text-sm text-gray-600">
                                            <p>Tanggal Pengumuman: {{ $announcement->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-6 bg-white border border-gray-200 rounded-lg">
                                        <h3 class="mb-4 text-lg font-semibold text-gray-800">Pengumuman Pemenang Tender</h3>
                                        <div class="mb-6 prose max-w-none">
                                            @php
                                                $winnerBiro = \App\Models\User::find($announcement->selected_biro_ids[0])->proposals()->latest()->first();
                                            @endphp
                                            <p>Biro terpilih dalam KKL D3 TI UDINUS adalah {{ $winnerBiro->nama_biro }}.</p>
                                        </div>
                                        <div class="mt-4 text-sm text-gray-600">
                                            <p>Tanggal Pengumuman: {{ $announcement->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @endif
                            @elseif($announcement->type === 'presentation')
                                @if($announcement->isUserSelected(auth()->user()))
                                    <div class="p-6 border border-blue-200 rounded-lg bg-blue-50">
                                        <h3 class="mb-4 text-lg font-semibold text-gray-800">{{ $announcement->title }}</h3>
                                        <div class="mb-6 prose max-w-none">
                                            {!! nl2br(e($announcement->content)) !!}

                                            @if($announcement->announcement_date)
                                                <div class="p-4 mt-4 bg-white border border-blue-200 rounded-lg">
                                                    <p class="font-semibold">Jadwal Presentasi:</p>
                                                    <p>{{ $announcement->announcement_date->format('l, d M Y H:i') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        @if(!$presentationConfirmation)
                                            <div class="mt-6">
                                                <form action="{{ route('biro.confirm-presentation') }}" method="POST" class="space-y-4">
                                                    @csrf
                                                    <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
                                                    <div class="flex space-x-4">
                                                        <button type="submit" name="status" value="confirmed" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                                                            Konfirmasi Kehadiran
                                                        </button>
                                                        <button type="submit" name="status" value="declined" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                                                            Tidak Dapat Hadir
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div class="mt-4 p-4 {{ $presentationConfirmation->status === 'confirmed' ? 'bg-green-100' : 'bg-red-100' }} rounded-lg">
                                                <p class="font-semibold">
                                                    Status Konfirmasi:
                                                    {{ $presentationConfirmation->status === 'confirmed' ? 'Akan Hadir' : 'Tidak Dapat Hadir' }}
                                                </p>
                                            </div>
                                        @endif
                                @else
                                    <div class="p-6 bg-white border border-gray-200 rounded-lg">
                                        <h3 class="mb-4 text-lg font-semibold text-gray-800">Mohon Maaf</h3>
                                        <div class="mb-6 prose max-w-none">
                                            <p>Mohon maaf proposal Anda belum terpilih untuk melanjutkan ke tahap presentasi.</p>
                                            <p>Kami mengucapkan terima kasih atas partisipasi Anda dalam proses tender ini.</p>
                                        </div>
                                        <div class="mt-4 text-sm text-gray-600">
                                            <p>Tanggal Pengumuman: {{ $announcement->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="p-6 bg-white border rounded-lg">
                                <p class="text-gray-600">Belum ada pengumuman saat ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
