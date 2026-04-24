<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Persetujuan Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-r-lg shadow-sm animate-fade-in-down" role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900/30 dark:text-red-400 rounded-r-lg shadow-sm animate-fade-in-down" role="alert">
                    <p class="font-bold">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Daftar Permintaan Pinjam</h3>
                    <a href="{{ route('admin.peminjaman.cetak') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Cetak Laporan
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 datatable">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tgl Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Batas Kembali</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Denda</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($data as $d)
                                <tr class="transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold uppercase">
                                                {{ substr($d->user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    <a href="{{ route('admin.siswa.show', $d->user_id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                        {{ $d->user->name }}
                                                    </a>
                                                </div>
                                                <div class="text-xs text-indigo-600 dark:text-indigo-400 font-medium">Meminjam: {{ $d->detail->buku->judul ?? 'Buku dihapus' }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $d->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ \Carbon\Carbon::parse($d->created_at)->translatedFormat('d M Y') }}</div>
                                        <div class="text-[10px] text-indigo-400 font-bold uppercase">{{ \Carbon\Carbon::parse($d->created_at)->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-xs font-bold text-indigo-500 dark:text-indigo-400">
                                            {{ $d->jatuh_tempo ? \Carbon\Carbon::parse($d->jatuh_tempo)->translatedFormat('d M Y') : '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @php
                                            $statusLabels = [
                                                'menunggu' => 'Menunggu Pinjam',
                                                'disetujui' => 'Dipinjam',
                                                'ditolak' => 'Ditolak',
                                                'menunggu_kembali' => 'Menunggu Kembali',
                                                'kembali' => 'Sudah Kembali',
                                            ];
                                            $statusHex = [
                                                'menunggu' => '#eab308',
                                                'disetujui' => '#22c55e',
                                                'ditolak' => '#ef4444',
                                                'menunggu_kembali' => '#a855f7',
                                                'kembali' => '#ffffff',
                                            ];
                                            $hex = $statusHex[$d->status] ?? '#9ca3af';
                                            $label = $statusLabels[$d->status] ?? $d->status;
                                        @endphp
                                        <span style="color: {{ $hex }} !important; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em;">
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $currentDenda = $d->calculateDenda();
                                        @endphp
                                        <div class="text-sm {{ $currentDenda > 0 ? 'text-red-600 font-bold' : 'text-gray-500' }}">
                                            {{ $currentDenda > 0 ? 'Rp ' . number_format($currentDenda, 0, ',', '.') : '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($d->status == 'menunggu')
                                            <div class="flex justify-end space-x-2">
                                                <form method="POST" action="{{ route('admin.peminjaman.acc', $d->id) }}" class="confirm">
                                                    @csrf
                                                    <button type="submit" class="btn-glow-green inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-500 text-white rounded-lg transition-all duration-300 text-xs font-bold">
                                                        Setujui Pinjam
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.peminjaman.tolak', $d->id) }}" class="confirm">
                                                    @csrf
                                                    <button type="submit" class="btn-glow-red inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-500 text-white rounded-lg transition-all duration-300 text-xs font-bold">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($d->status == 'menunggu_kembali')
                                            <div class="flex justify-end">
                                                <form method="POST" action="{{ route('admin.peminjaman.acc-kembali', $d->id) }}" class="confirm">
                                                    @csrf
                                                    <button type="submit" class="btn-glow-purple inline-flex items-center px-3 py-1.5 bg-purple-600 hover:bg-purple-500 text-white rounded-lg transition-all duration-300 text-xs font-bold">
                                                        Konfirmasi Kembali
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($d->status == 'kembali' || $d->status == 'ditolak')
                                            <div class="flex justify-end">
                                                <form method="POST" action="{{ route('admin.peminjaman.destroy', $d->id) }}" class="confirm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-glow-red inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-500 text-white rounded-lg transition-all duration-300 text-xs font-bold">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-600 italic">Dipinjam</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400 italic">
                                        Tidak ada permintaan peminjaman saat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>