<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Peminjaman Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-r-lg shadow-sm" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 datatable">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Buku</th>
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
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $d->detail->buku->judul ?? 'Buku dihapus' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($d->tanggal_pinjam)->translatedFormat('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-indigo-500 dark:text-indigo-400">
                                            {{ $d->jatuh_tempo ? \Carbon\Carbon::parse($d->jatuh_tempo)->translatedFormat('d M Y') : '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @php
                                            $statusLabels = [
                                                'menunggu' => 'Menunggu Pinjam',
                                                'disetujui' => 'Dipinjam',
                                                'ditolak' => 'Ditolak',
                                                'menunggu_kembali' => 'Menunggu Konfirmasi Kembali',
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
                                             @if($currentDenda > 0 && $d->status == 'disetujui')
                                                 <span class="block text-[9px] uppercase tracking-tighter">Berjalan</span>
                                             @endif
                                         </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($d->status == 'disetujui')
                                            <form method="POST" action="{{ route('kembali', $d->id) }}" class="confirm">
                                                @csrf
                                                <button type="submit" class="btn-glow-indigo inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg transition-all duration-300 font-bold">
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-600 italic">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400 italic">
                                        Anda belum pernah meminjam buku.
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
