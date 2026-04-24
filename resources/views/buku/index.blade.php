<x-app-layout>
    <div x-data="{ showForm: false, search: '' }">

        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Manajemen Data Buku
                </h2>

                <button @click="showForm = !showForm"
                    class="btn-glow-indigo px-4 py-2 bg-indigo-600 rounded-xl text-white text-xs font-bold transition-all duration-300">
                    Tambah Buku
                </button>
            </div>
        </x-slot>

        <!-- ROOT -->
        <div class="py-12 animate-fade-in">
            <div class="catalog-container sm:px-6 lg:px-8">

                <!-- HEADER + SEARCH (SAMA PERSIS KAYAK SISWA) -->
                <div class="mb-10 flex flex-col md:flex-row justify-between items-end gap-6 pb-4 border-b border-white/5">
                    <div>
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter italic">
                            Data Buku
                        </h2>
                        <p class="text-xs text-indigo-400 font-bold uppercase tracking-widest mt-1">
                            Kelola Koleksi Buku
                        </p>
                    </div>

                    <!-- SEARCH -->
                    <div class="relative w-full md:w-72 group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-600 group-focus-within:text-indigo-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>

                        <input type="text"
                            x-model="search"
                            placeholder="Cari buku..."
                            class="w-full pl-11 pr-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white placeholder-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-inner">
                    </div>
                </div>

                <!-- GRID -->
                <div class="book-grid">
                    @forelse($buku as $b)

                        <template x-if="!search 
                            || {{ json_encode(strtolower($b->judul)) }}.includes(search.toLowerCase()) 
                            || {{ json_encode(strtolower($b->pengarang)) }}.includes(search.toLowerCase())">

                            <div class="book-card-custom group">

                                <!-- COVER -->
                                <div class="book-img-container bg-gradient-to-br from-indigo-500 to-purple-600 relative">
                                    @if($b->gambar)
                                        <img src="{{ asset('storage/' . $b->gambar) }}"
                                            class="transition-transform duration-700">
                                    @else
                                        <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                                            <svg class="w-12 h-12 text-white opacity-40 mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13"></path>
                                            </svg>
                                            <p class="text-[10px] text-white/50 uppercase">No Cover</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- INFO AREA (SYNCED WITH STUDENT VIEW) -->
                                <div class="book-info-box p-4 flex flex-col h-full">
                                    <div class="mb-4">
                                        <div class="flex justify-between items-start gap-2 mb-1">
                                            <h3 class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2 leading-tight">
                                            {{ $b->judul }}
                                        </h3>
                                            <span class="flex-shrink-0 text-[10px] font-medium text-white/90">
                                            STOK: {{ $b->stok }}
                                        </span>
                                        </div>
                                        <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                        By: <span class="text-white/80 font-bold ml-1">{{ $b->pengarang }}</span>
                                    </p>
                                    </div>

                                    <!-- ACTION BUTTONS -->
                                    <div class="flex gap-2 mt-auto w-full">
                                        <a href="{{ route('buku.edit', $b->id) }}"
                                            class="btn-glow-blue flex-1 flex items-center justify-center py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-lg text-[10px] font-black uppercase tracking-widest transition-all duration-300 shadow-lg shadow-blue-900/20">
                                            Edit
                                        </a>

                                        <form action="{{ route('buku.destroy', $b->id) }}" method="POST" class="confirm flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn-glow-red w-full flex items-center justify-center py-2.5 bg-red-600 hover:bg-red-500 text-white rounded-lg text-[10px] font-black uppercase tracking-widest transition-all duration-300 shadow-lg shadow-red-900/20">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </template>

                    @empty
                        <div class="col-span-full text-center text-gray-400">
                            Data kosong
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>