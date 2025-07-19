<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengunjung_id');
            $table->date('tanggal_kunjungan');
            $table->string('tujuan');
            $table->timestamps();

            // Relasi ke tabel pengunjungs
            $table->foreign('pengunjung_id')
                  ->references('id')
                  ->on('pengunjung')
                  ->onDelete('cascade');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
