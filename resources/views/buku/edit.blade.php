<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Buku: {{ $buku->judul }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700 p-12">
                <form method="POST" action="{{ route('buku.update', $buku->id) }}" class="space-y-6 confirm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    @if($buku->gambar)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gambar Saat Ini</label>
                            <img src="{{ asset('storage/' . $buku->gambar) }}" class="h-40 rounded-xl object-cover border border-gray-600">
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label>Judul Buku</label>
                            <input type="text" name="judul" value="{{ $buku->judul }}" required>
                        </div>
                        <div>
                            <label>Kategori</label>
                            <select name="kategori" required class="w-full bg-black border border-white/10 rounded-xl text-[11px] font-bold text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all appearance-none">
                                <option value="Fiksi" {{ $buku->kategori == 'Fiksi' ? 'selected' : '' }} class="bg-black text-white">Fiksi</option>
                                <option value="Non-Fiksi" {{ $buku->kategori == 'Non-Fiksi' ? 'selected' : '' }} class="bg-black text-white">Non-Fiksi</option>
                                <option value="Pelajaran" {{ $buku->kategori == 'Pelajaran' ? 'selected' : '' }} class="bg-black text-white">Pelajaran</option>
                                <option value="Komik" {{ $buku->kategori == 'Komik' ? 'selected' : '' }} class="bg-black text-white">Komik</option>
                                <option value="Novel" {{ $buku->kategori == 'Novel' ? 'selected' : '' }} class="bg-black text-white">Novel</option>
                                <option value="Lainnya" {{ $buku->kategori == 'Lainnya' ? 'selected' : '' }} class="bg-black text-white">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label>Pengarang</label>
                        <input type="text" name="pengarang" value="{{ $buku->pengarang }}" required>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label>Stok</label>
                            <input type="number" name="stok" value="{{ $buku->stok }}" required>
                        </div>
                        <div>
                            <label>Ganti Gambar (Opsional)</label>
                            <input type="file" name="gambar" class="file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                        </div>
                    </div>

                    <div class="pt-6 border-t border-white/10 flex flex-col gap-4">
                        <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/20">
                            SIMPAN PERUBAHAN
                        </button>
                        <a href="{{ route('buku.index') }}" class="w-full py-4 bg-white/5 text-gray-400 rounded-2xl font-bold text-xs uppercase tracking-widest text-center hover:bg-white/10 transition">
                            BATAL & KEMBALI
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
