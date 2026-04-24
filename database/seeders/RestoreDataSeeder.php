<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RestoreDataSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun Admin
        User::create([
            'name' => 'Admin Perpus',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Buat akun Siswa
        User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        // Buat beberapa data Buku
        Buku::create([
            'judul' => 'Belajar Laravel 11',
            'pengarang' => 'Taylor Otwell',
            'stok' => 10,
        ]);

        Buku::create([
            'judul' => 'Pemrograman Web Modern',
            'pengarang' => 'Sandhika Galih',
            'stok' => 5,
        ]);

        Buku::create([
            'judul' => 'Seni Berpikir Jernih',
            'pengarang' => 'Rolf Dobelli',
            'stok' => 7,
        ]);
    }
}
