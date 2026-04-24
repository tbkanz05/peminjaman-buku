<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Katalog Buku & Peminjaman') }}
        </h2>
    </x-slot>

    <!-- ROOT -->
    <div class="py-12 animate-fade-in" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HEADER + SEARCH -->
            <div class="mb-10 flex flex-col md:flex-row justify-between items-center md:items-end gap-6 pb-4 border-b border-white/5">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tighter italic">
                        Katalog Buku
                    </h2>
                    <p class="text-xs text-indigo-400 font-bold uppercase tracking-widest mt-1">
                        Jelajahi dan Pinjam Koleksi Terbaik Kami
                    </p>
                </div>

                <!-- INPUT SEARCH -->
                <div class="relative w-full md:w-72 group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-600 group-focus-within:text-indigo-500 transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" x-model="search" placeholder="Cari buku..."
                        class="w-full pl-11 pr-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white placeholder-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-inner">
                </div>
            </div>

            <!-- GRID BUKU -->
            <div class="book-grid">
                @forelse($buku as $b)
                    <template
                        x-if="!search 
                        || {{ json_encode(strtolower($b->judul)) }}.includes(search.toLowerCase()) 
                        || {{ json_encode(strtolower($b->pengarang)) }}.includes(search.toLowerCase())
                        || {{ json_encode(strtolower($b->kategori)) }}.includes(search.toLowerCase())">

                        <div class="book-card-custom group" x-data="{ showBorrowForm: false }">

                            <!-- COVER AREA -->
                            <div class="book-img-container bg-gradient-to-br from-indigo-500 to-purple-600">
                                @if($b->gambar)
                                    <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}"
                                        class="transition-transform duration-700"
                                        :class="showBorrowForm ? 'blur-sm grayscale' : ''">
                                @else
                                    <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                                        <svg class="w-12 h-12 text-white opacity-40 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                        <p class="text-[10px] text-white/50 font-medium uppercase tracking-widest text-center">
                                            No Cover
                                        </p>
                                    </div>
                                @endif

                                <!-- OVERLAY FORM IF ACTIVE -->
                                <div x-show="showBorrowForm"
                                    class="absolute inset-0 z-30 flex flex-col p-5 rounded-2xl border border-indigo-500/50"
                                    style="background-color: rgba(0, 0, 0, 0.98) !important; backdrop-filter: blur(10px);"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-4"
                                    x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">

                                    <div class="mb-4">
                                        <p
                                            class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1 italic">
                                            Konfirmasi</p>
                                        <h4 class="text-xs font-bold text-white line-clamp-2 leading-tight">Pinjam:
                                            {{ $b->judul }}</h4>
                                    </div>

                                    <form method="POST" action="{{ route('pinjam.store') }}"
                                        class="confirm flex-1 flex flex-col justify-between">
                                        @csrf
                                        <input type="hidden" name="buku_id" value="{{ $b->id }}">

                                        <div class="space-y-2">
                                            <label
                                                class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Kapan
                                                Dikembalikan?</label>
                                            <input type="date" name="jatuh_tempo" required min="{{ date('Y-m-d') }}"
                                                value="{{ date('Y-m-d') }}"
                                                class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-[11px] text-white font-bold focus:border-indigo-500 focus:ring-0 transition-all">
                                        </div>

                                        <div class="grid grid-cols-2 gap-2 mt-4">
                                            <button type="button" @click="showBorrowForm = false"
                                                class="py-2 bg-white/10 text-white rounded-lg font-bold text-[9px] uppercase tracking-widest hover:bg-white/20 transition">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="btn-glow-indigo py-2 bg-indigo-600 text-white rounded-lg font-black text-[9px] uppercase tracking-widest hover:bg-indigo-700 transition-all duration-300">
                                                Kirim
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- INFO AREA (ALWAYS VISIBLE OR PARTIALLY OBSCURED) -->
                            <div class="book-info-box">
                                <div class="mb-4">
                                    <div class="flex justify-between items-start gap-2 mb-1">
                                        <div class="flex flex-col">
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[7px] font-black bg-indigo-500/20 text-indigo-400 uppercase tracking-widest mb-1 w-fit border border-indigo-500/20">
                                                {{ $b->kategori ?? 'UMUM' }}
                                            </span>
                                            <h3
                                                class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2 leading-tight">
                                                {{ $b->judul }}
                                            </h3>
                                        </div>
                                        <span class="flex-shrink-0 text-[10px] font-medium text-white/90">
                                            STOK: {{ $b->stok }}
                                        </span>
                                    </div>
                                    <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                        By: <span class="text-white/80 font-bold ml-1">{{ $b->pengarang }}</span>
                                    </p>
                                </div>

                                <div>
                                    @if($b->stok > 0)
                                        <button type="button" @click="showBorrowForm = true"
                                            class="btn-glow-indigo w-full px-4 py-2 bg-indigo-600 rounded-xl text-white text-xs font-bold hover:bg-indigo-700 transition-all duration-300">
                                            PINJAM SEKARANG
                                        </button>
                                    @else
                                        <button disabled
                                            class="w-full px-4 py-2 bg-gray-500 rounded-xl text-white text-xs font-bold cursor-not-allowed">
                                            STOK HABIS
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </template>
                @empty
                    <div class="col-span-full text-center text-gray-400">
                        Data buku kosong
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>