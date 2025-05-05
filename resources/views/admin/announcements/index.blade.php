<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Kelola Pengumuman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">Daftar Pengumuman</h3>
                        <a href="{{ route('admin.announcements.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                            Buat Pengumuman
                        </a>
                    </div>

                    @if($announcements->isEmpty())
                        <p class="py-4 text-center text-gray-500">Belum ada pengumuman yang dibuat.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Judul</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tipe</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Biro Terpilih</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($announcements as $announcement)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $announcement->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $announcement->announcement_date->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                                {{ ucfirst($announcement->type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                @foreach($announcement->selectedBiros() as $biro)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2 mb-1">
                                                        {{ $biro->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'view-announcement-{{ $announcement->id }}')" class="text-blue-600 hover:text-blue-900">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>

                                    <x-modal name="view-announcement-{{ $announcement->id }}" focusable>
                                        <div class="p-6">
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ $announcement->title }}
                                            </h2>

                                            <div class="mt-4 text-sm text-gray-600">
                                                <p class="whitespace-pre-line">{{ $announcement->content }}</p>
                                            </div>

                                            <div class="mt-4">
                                                <h3 class="text-sm font-medium text-gray-900">Biro yang Terpilih:</h3>
                                                <div class="mt-2 space-y-1">
                                                    @foreach($announcement->selectedBiros() as $biro)
                                                        <div class="text-sm text-gray-600">• {{ $biro->name }}</div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="flex justify-end mt-6">
                                                <button type="button" x-on:click="$dispatch('close')" class="text-sm font-medium text-gray-700 hover:text-gray-500">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </x-modal>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
