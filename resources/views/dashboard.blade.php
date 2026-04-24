<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8 text-gray-900 dark:text-gray-100">
                <h3 class="text-3xl font-black mb-2 tracking-tight">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Ini adalah ringkasan sistem perpustakaan Anda hari ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                @if(Auth::user()->role == 'admin')
                    <!-- Card: Manajemen Buku -->
                    <a href="{{ route('buku.index') }}" class="relative group block bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition"></div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $total_buku }}</span>
                        </div>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white relative z-10">Total Buku</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 relative z-10">Kelola koleksi & stok perpus.</p>
                    </a>

                    <!-- Card: Kelola Siswa -->
                    <a href="{{ route('admin.siswa.index') }}" class="relative group block bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-teal-500/10 rounded-full blur-2xl group-hover:bg-teal-500/20 transition"></div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div class="w-12 h-12 bg-teal-50 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center text-teal-600 dark:text-teal-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $total_siswa }}</span>
                        </div>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white relative z-10">Total Siswa</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 relative z-10">Manajemen data anggota.</p>
                    </a>

                    <!-- Card: Persetujuan -->
                    <a href="{{ route('admin.peminjaman.index') }}" class="relative group block bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition"></div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $total_peminjaman }}</span>
                        </div>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white relative z-10">Peminjaman</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 relative z-10">Total transaksi sirkulasi.</p>
                    </a>
                @endif

                @if(Auth::user()->role == 'siswa')
                    <!-- Card: Pinjam Buku -->
                    <a href="{{ route('pinjam.index') }}" class="relative group block bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition"></div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $total_buku }}</span>
                        </div>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white relative z-10">Katalog Buku</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 relative z-10">Cari dan pinjam koleksi.</p>
                    </a>

                    <!-- Card: Riwayat Saya -->
                    <a href="{{ route('riwayat') }}" class="relative group block bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-yellow-500/10 rounded-full blur-2xl group-hover:bg-yellow-500/20 transition"></div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div class="w-12 h-12 bg-yellow-50 dark:bg-yellow-900/30 rounded-2xl flex items-center justify-center text-yellow-600 dark:text-yellow-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white relative z-10">Riwayat Saya</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 relative z-10">Status pinjam & kembali.</p>
                    </a>
                @endif

                <!-- Card: Profil -->
                <a href="{{ route('profile.edit') }}" class="relative group block bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-500/10 rounded-full blur-2xl group-hover:bg-orange-500/20 transition"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center text-orange-600 dark:text-orange-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    </div>
                    <h4 class="text-base font-bold text-gray-900 dark:text-white relative z-10">Profil</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 relative z-10">Pengaturan akun.</p>
                </a>

            </div>

            @if(Auth::user()->role == 'admin')
                <!-- Section: Grafik -->
                <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Grafik Tren Peminjaman -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Tren Peminjaman</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Statistik 6 bulan terakhir</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            </div>
                        </div>
                        <div class="relative h-64">
                            <canvas id="borrowingChart"></canvas>
                        </div>
                    </div>

                    <!-- Grafik Status Peminjaman -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Status Peminjaman</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Distribusi status saat ini</p>
                            </div>
                            <div class="w-10 h-10 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                        </div>
                        <div class="relative h-64">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart.js scripts -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctxBorrow = document.getElementById('borrowingChart').getContext('2d');
                        const ctxStatus = document.getElementById('statusChart').getContext('2d');

                        // Common Chart Options
                        const options = {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: true,
                                        color: 'rgba(156, 163, 175, 0.1)'
                                    },
                                    ticks: {
                                        stepSize: 1
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        };

                        // 1. Tren Peminjaman Chart
                        new Chart(ctxBorrow, {
                            type: 'line',
                            data: {
                                labels: @json($chartData['labels']),
                                datasets: [{
                                    label: 'Jumlah Peminjaman',
                                    data: @json($chartData['data']),
                                    borderColor: '#3b82f6',
                                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                    borderWidth: 3,
                                    fill: true,
                                    tension: 0.4,
                                    pointBackgroundColor: '#3b82f6',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointRadius: 4,
                                    pointHoverRadius: 6
                                }]
                            },
                            options: options
                        });

                        // 2. Status Peminjaman Chart
                        new Chart(ctxStatus, {
                            type: 'bar',
                            data: {
                                labels: @json($chartData['status_labels']),
                                datasets: [{
                                    label: 'Total',
                                    data: @json($chartData['status_data']),
                                    backgroundColor: [
                                        'rgba(245, 158, 11, 0.8)', // Menunggu
                                        'rgba(16, 185, 129, 0.8)',  // Disetujui
                                        'rgba(239, 68, 68, 0.8)',   // Ditolak
                                        'rgba(99, 102, 241, 0.8)'   // Kembali
                                    ],
                                    borderRadius: 10,
                                    barThickness: 40
                                }]
                            },
                            options: options
                        });
                    });
                </script>
            @endif

            </div>
        </div>
    </div>
</x-app-layout>
