<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Riwayat Peminjaman: {{ $siswa->name }}
            </h2>
            <a href="{{ route('admin.siswa.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Daftar Buku yang Dipinjam</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 datatable">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Judul Buku</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tgl Pinjam</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tgl Kembali</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($peminjaman as $p)
                                <tr class="transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $p->detail->buku->judul ?? 'Buku dihapus' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $p->tanggal_pinjam }}
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
                                            $hex = $statusHex[$p->status] ?? '#9ca3af';
                                            $label = $statusLabels[$p->status] ?? $p->status;
                                        @endphp
                                        <span style="color: {{ $hex }} !important; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em;">
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $p->tanggal_kembali ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400 italic">
                                        Siswa ini belum memiliki riwayat peminjaman.
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
