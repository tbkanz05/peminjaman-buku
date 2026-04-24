<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Data Siswa') }}
            </h2>
            <a href="{{ route('admin.siswa.create') }}" class="btn-glow-indigo w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 transition-all duration-300">
                Tambah Siswa
            </a>
        </div>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 datatable">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($siswa as $s)
                                <tr class="transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.siswa.show', $s->id) }}" class="text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                            {{ $s->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $s->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('admin.siswa.edit', $s->id) }}" 
                                                class="btn-glow-blue inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-bold text-[10px] text-white uppercase tracking-widest hover:bg-blue-500 transition-all duration-300">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.siswa.destroy', $s->id) }}" method="POST" class="confirm inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="btn-glow-red inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-xl font-bold text-[10px] text-white uppercase tracking-widest hover:bg-red-500 transition-all duration-300">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
