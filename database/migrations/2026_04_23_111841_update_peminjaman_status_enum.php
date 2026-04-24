<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'menunggu_kembali', 'kembali'])->default('menunggu')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'kembali'])->default('menunggu')->change();
        });
    }
};
