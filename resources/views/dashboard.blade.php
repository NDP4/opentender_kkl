<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->role === 'biro')
                        <div class="text-center">
                            @php
                                $totalBiro = \App\Models\User::where('role', 'biro')->count();
                                $totalSubmitted = \App\Models\Proposal::whereNotIn('status', ['draft'])->count();
                                $totalReviewed = \App\Models\Proposal::whereIn('status', ['accepted', 'rejected'])->count();
                            @endphp

                            <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-3">
                                <!-- Total Biro -->
                                <div class="p-4 bg-white border rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Total Biro Terdaftar</dt>
                                    <dd class="mt-1">
                                        <div class="text-3xl font-semibold text-gray-900">{{ $totalBiro }}</div>
                                    </dd>
                                </div>

                                <!-- Total Proposal Submitted -->
                                <div class="p-4 bg-white border rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Total Proposal Tersubmit</dt>
                                    <dd class="mt-1">
                                        <div class="text-3xl font-semibold text-blue-600">{{ $totalSubmitted }}</div>
                                    </dd>
                                </div>

                                <!-- Total Proposal Reviewed -->
                                <div class="p-4 bg-white border rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Total Proposal Direview</dt>
                                    <dd class="mt-1">
                                        <div class="text-3xl font-semibold text-green-600">{{ $totalReviewed }}</div>
                                    </dd>
                                </div>
                            </div>

                            @if($proposal && $proposal->status === 'draft')
                                <h3 class="mb-4 text-lg font-semibold">Selamat datang di Dashboard Biro Perjalanan</h3>
                                <p class="mb-6 text-gray-600">Silakan lanjutkan pengisian proposal penawaran Anda.</p>
                                <a href="{{ route('proposal.step1') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                                    Lanjutkan Proposal
                                </a>
                            @elseif(!$proposal)
                                <h3 class="mb-4 text-lg font-semibold">Selamat datang di Dashboard Biro Perjalanan</h3>
                                <p class="mb-6 text-gray-600">Silakan submit proposal penawaran Anda untuk mengikuti tender KKL.</p>
                                <a href="{{ route('proposal.step1') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                                    Submit Proposal Penawaran
                                </a>
                            @else
                                <h3 class="mb-4 text-lg font-semibold">Detail Proposal Anda</h3>
                                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                            <div class="sm:col-span-1">
                                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    @switch($proposal->status)
                                                        @case('submitted')
                                                            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu Review</span>
                                                            @break
                                                        @case('reviewing')
                                                            <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">Sedang Direview</span>
                                                            @break
                                                        @case('accepted')
                                                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Diterima</span>
                                                            @break
                                                        @case('rejected')
                                                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                                                            @break
                                                    @endswitch
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm font-medium text-gray-500">Tanggal Submit</dt>
                                                <dd class="mt-1 text-sm text-gray-900">{{ $proposal->updated_at->format('d F Y H:i') }}</dd>
                                            </div>

                                            <div class="sm:col-span-2">
                                                <dt class="text-sm font-medium text-gray-500">Nama Biro</dt>
                                                <dd class="mt-1 text-sm text-gray-900">{{ $proposal->nama_biro }}</dd>
                                            </div>

                                            <div class="sm:col-span-2">
                                                <dt class="text-sm font-medium text-gray-500">Dokumen yang Diupload</dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    <ul class="list-disc list-inside">
                                                        @foreach($proposal->files as $file)
                                                            <li>{{ $file->original_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </dd>
                                            </div>
                                        </dl>

                                        @if($proposal->status !== 'reviewing' && $proposal->status !== 'accepted')
                                            <div class="mt-6">
                                                <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-proposal-deletion')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                                                    Hapus Proposal
                                                </button>
                                            </div>

                                            <x-modal name="confirm-proposal-deletion" focusable>
                                                <form method="POST" action="{{ route('proposal.destroy', $proposal->id) }}" class="p-6">
                                                    @csrf
                                                    @method('DELETE')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        Konfirmasi Hapus Proposal
                                                    </h2>

                                                    <p class="mt-3 text-sm text-gray-600">
                                                        Apakah Anda yakin ingin menghapus proposal ini? Semua data akan terhapus permanen termasuk dokumen yang telah diupload.
                                                    </p>

                                                    <div class="flex justify-end mt-6 space-x-3">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            Batal
                                                        </x-secondary-button>

                                                        <x-danger-button type="submit">
                                                            Hapus Proposal
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        @endif
                                    </div>
                                </div>

                                @php
                                    $announcements = \App\Models\Announcement::where('type', 'presentation')
                                        ->orderBy('announcement_date', 'desc')
                                        ->get();
                                @endphp

                                @if($announcements->isNotEmpty())
                                    <div class="mt-8">
                                        <h3 class="mb-4 text-lg font-semibold">Pengumuman Terbaru</h3>
                                        <div class="space-y-4">
                                            @foreach($announcements as $announcement)
                                                <div class="p-4 border border-blue-200 rounded-lg bg-blue-50">
                                                    <h4 class="font-semibold text-blue-900">{{ $announcement->title }}</h4>
                                                    <p class="mt-2 text-blue-800">{!! nl2br(e($announcement->content)) !!}</p>
                                                    <p class="mt-2 text-sm text-blue-700">
                                                        <strong>Tanggal Presentasi:</strong>
                                                        {{ $announcement->announcement_date->isoFormat('dddd, D MMMM Y HH:mm') }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <div class="mt-8">
                                <h3 class="mb-4 text-lg font-semibold">Daftar Biro Yang Terdaftar</h3>
                                @php
                                    $registeredBiros = \App\Models\User::where('role', 'biro')
                                        ->with(['proposals' => function($query) {
                                            $query->latest();
                                        }])
                                        ->get();
                                @endphp

                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Biro</th>
                                                {{-- <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal Registrasi</th> --}}
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status Proposal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($registeredBiros as $biro)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $biro->name }}</td>
                                                {{-- <td class="px-6 py-4 whitespace-nowrap">{{ $biro->created_at->format('d M Y H:i') }}</td> --}}
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($biro->proposals->isEmpty())
                                                        <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">
                                                            Belum Submit
                                                        </span>
                                                    @else
                                                        @switch($biro->proposals->first()->status)
                                                            @case('draft')
                                                                <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                                                    Draft
                                                                </span>
                                                                @break
                                                            @case('submitted')
                                                                <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                                                    Menunggu Review
                                                                </span>
                                                                @break
                                                            @case('accepted')
                                                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                                    Diterima
                                                                </span>
                                                                @break
                                                            @case('rejected')
                                                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                                    Ditolak
                                                                </span>
                                                                @break
                                                        @endswitch
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="space-y-6">
                            @php
                                $totalBiro = \App\Models\User::where('role', 'biro')->count();
                                $totalSubmittedProposals = \App\Models\Proposal::where('status', 'submitted')->count();
                                $totalAcceptedProposals = \App\Models\Proposal::where('status', 'accepted')->count();
                                $totalRejectedProposals = \App\Models\Proposal::where('status', 'rejected')->count();
                            @endphp

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                                <!-- Total Biro Terdaftar -->
                                <div class="p-4 bg-white border rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Total Biro Terdaftar</dt>
                                    <dd class="mt-1">
                                        <div class="text-3xl font-semibold text-gray-900">{{ $totalBiro }}</div>
                                    </dd>
                                </div>

                                <!-- Total Proposal Menunggu Review -->
                                <div class="p-4 bg-white border rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Menunggu Review</dt>
                                    <dd class="mt-1">
                                        <div class="text-3xl font-semibold text-yellow-600">{{ $totalSubmittedProposals }}</div>
                                    </dd>
                                </div>

                                <!-- Total Proposal Diterima -->
                                <div class="p-4 bg-white border rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Proposal Diterima</dt>
                                    <dd class="mt-1">
                                        <div class="text-3xl font-semibold text-green-600">{{ $totalAcceptedProposals }}</div>
                                    </dd>
                                </div>

                                <!-- Total Proposal Ditolak -->
                                <div class="p-4 bg-white border rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Proposal Ditolak</dt>
                                    <dd class="mt-1">
                                        <div class="text-3xl font-semibold text-red-600">{{ $totalRejectedProposals }}</div>
                                    </dd>
                                </div>
                            </div>

                            <div class="mt-8">
                                <h3 class="mb-4 text-lg font-semibold">Daftar Biro Perjalanan</h3>
                                @php
                                    $registeredBiros = \App\Models\User::where('role', 'biro')
                                        ->with(['proposals' => function($query) {
                                            $query->latest();
                                        }])
                                        ->get();
                                @endphp

                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Biro</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal Registrasi</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status Proposal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($registeredBiros as $biro)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $biro->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $biro->email }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $biro->created_at->format('d M Y H:i') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($biro->proposals->isEmpty())
                                                        <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">
                                                            Belum Submit
                                                        </span>
                                                    @else
                                                        @switch($biro->proposals->first()->status)
                                                            @case('draft')
                                                                <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                                                    Draft
                                                                </span>
                                                                @break
                                                            @case('submitted')
                                                                <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                                                    Menunggu Review
                                                                </span>
                                                                @break
                                                            @case('accepted')
                                                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                                    Diterima
                                                                </span>
                                                                @break
                                                            @case('rejected')
                                                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                                    Ditolak
                                                                </span>
                                                                @break
                                                        @endswitch
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <h3 class="mt-8 text-lg font-semibold">Proposal yang Perlu Direview</h3>

                            @php
                                $waitingProposals = \App\Models\Proposal::where('status', 'submitted')->get();
                            @endphp

                            @if($waitingProposals->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Biro</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal Submit</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($waitingProposals as $proposal)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->nama_biro }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->email_biro }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->updated_at->format('d M Y H:i') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                                        Menunggu Review
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ route('admin.review.proposal', $proposal->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50">
                                                        Review Proposal
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="py-8 text-center">
                                    <p class="text-gray-500">Tidak ada proposal yang perlu direview saat ini.</p>
                                </div>
                            @endif

                            <div class="pt-8 mt-8 border-t">
                                <h3 class="mb-4 text-lg font-semibold">Status Pemenang Tender</h3>

                                @php
                                    $winnerAnnouncement = \App\Models\Announcement::where('type', 'winner')
                                        ->latest()
                                        ->first();

                                    if ($winnerAnnouncement) {
                                        $winnerBiro = \App\Models\User::whereIn('id', $winnerAnnouncement->selected_biro_ids)
                                            ->with(['proposals' => function($query) {
                                                $query->latest();
                                            }])
                                            ->first();
                                    }
                                @endphp

                                @if(isset($winnerBiro))
                                    <div class="p-4 border border-green-200 rounded-lg bg-green-50">
                                        <h4 class="font-semibold text-green-800">Biro Pemenang Tender KKL</h4>
                                        <div class="mt-4 space-y-2">
                                            <p><span class="font-medium">Nama Biro:</span> {{ $winnerBiro->proposals->first()->nama_biro }}</p>
                                            <p><span class="font-medium">Email:</span> {{ $winnerBiro->email }}</p>
                                            <p><span class="font-medium">Tanggal Pengumuman:</span> {{ $winnerAnnouncement->created_at->format('d M Y H:i') }}</p>
                                            <p><span class="font-medium">Tanggal Pelaksanaan:</span> {{ $winnerAnnouncement->announcement_date->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="py-4 text-center text-gray-500">Belum ada pengumuman pemenang tender.</p>
                                @endif
                            </div>

                            <div class="pt-8 mt-8 border-t">
                                <h3 class="mb-4 text-lg font-semibold">Status Konfirmasi Presentasi</h3>

                                @php
                                    $latestAnnouncement = \App\Models\Announcement::where('type', 'presentation')
                                        ->latest()
                                        ->first();

                                    if ($latestAnnouncement) {
                                        $selectedBiros = \App\Models\User::whereIn('id', $latestAnnouncement->selected_biro_ids)
                                            ->with(['proposals', 'presentationConfirmations' => function($query) use ($latestAnnouncement) {
                                                $query->where('announcement_id', $latestAnnouncement->id);
                                            }])
                                            ->get();
                                    }
                                @endphp

                                @if(isset($selectedBiros) && $selectedBiros->isNotEmpty())
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Biro</th>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status Konfirmasi</th>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Waktu Konfirmasi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($selectedBiros as $biro)
                                                    @php
                                                        $confirmation = $biro->presentationConfirmations->first();
                                                        $proposal = $biro->proposals->first();
                                                    @endphp
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->nama_biro }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">{{ $biro->email }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            @if(!$confirmation)
                                                                <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">
                                                                    Belum Konfirmasi
                                                                </span>
                                                            @elseif($confirmation->status === 'confirmed')
                                                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                                    Hadir
                                                                </span>
                                                            @else
                                                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                                    Tidak Hadir
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                            {{ $confirmation ? $confirmation->updated_at->format('d M Y H:i') : '-' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="py-4 text-center text-gray-500">Belum ada pengumuman presentasi atau belum ada biro yang terpilih.</p>
                                @endif
                            </div>

                            <div class="pt-8 mt-8 border-t">
                                <h3 class="text-lg font-semibold">Riwayat Review Proposal</h3>

                                @php
                                    $reviewedProposals = \App\Models\Proposal::whereIn('status', ['accepted', 'rejected'])->latest()->get();
                                @endphp

                                @if($reviewedProposals->count() > 0)
                                    <div class="mt-4 overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Biro</th>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal Review</th>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($reviewedProposals as $proposal)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->nama_biro }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->email_biro }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->updated_at->format('d M Y H:i') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($proposal->status === 'accepted')
                                                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                                Diterima
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                                Ditolak
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'view-proposal-{{ $proposal->id }}')" class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50">
                                                            Lihat Detail
                                                        </button>
                                                    </td>
                                                </tr>

                                                <x-modal name="view-proposal-{{ $proposal->id }}" focusable>
                                                    <div class="p-6">
                                                        <h2 class="mb-6 text-xl font-semibold leading-tight text-gray-800">
                                                            Detail Proposal - {{ $proposal->nama_biro }}
                                                        </h2>

                                                        <div class="space-y-6">
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
                                                                            @if($proposal->status === 'accepted')
                                                                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                                                    Diterima
                                                                                </span>
                                                                            @else
                                                                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                                                    Ditolak
                                                                                </span>
                                                                            @endif
                                                                        </p>
                                                                        <p><span class="font-medium">Sumber Informasi:</span> {{ ucfirst($proposal->informasi_kkl) }}</p>
                                                                        <p><span class="font-medium">Detail Informasi:</span> {{ $proposal->detail_informasi }}</p>
                                                                        @if($proposal->review_notes)
                                                                            <p><span class="font-medium">Catatan Review:</span> {{ $proposal->review_notes }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <h3 class="mb-4 text-lg font-semibold">Dokumen Proposal</h3>
                                                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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
                                                        </div>

                                                        <div class="flex justify-end mt-6">
                                                            <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                                                Tutup
                                                            </button>
                                                        </div>
                                                    </div>
                                                </x-modal>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-8 text-center">
                                        <p class="text-gray-500">Belum ada proposal yang sudah direview.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
