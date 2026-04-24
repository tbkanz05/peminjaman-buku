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
        Schema::table('detail_peminjamen', function (Blueprint $table) {
            $table->dropForeign(['buku_id']);
            $table->foreign('buku_id')
                  ->references('id')->on('bukus')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_peminjamen', function (Blueprint $table) {
            $table->dropForeign(['buku_id']);
            $table->foreign('buku_id')
                  ->references('id')->on('bukus');
        });
    }
};
