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
        Schema::create('booking_travels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('tanggal_booking');
            $table->string('nama_penumpang');
            $table->string('nomor_hp', 20)->nullable();
            $table->integer('no_kursi');

            $table->enum('jadwal_berangkat', ['PAGI', 'MALAM']);

            $table->string('alamat_penjemputan');
            $table->string('tujuan');

            $table->enum('status', [
                'PROSES',
                'LAGI_DI_JALAN',
                'SELESAI'
            ])->default('PROSES');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_travels');
    }
};
