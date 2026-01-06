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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete(); // Admin Bus atau Admin Travel
            $table->enum('type', ['bus', 'travel_car']);
            $table->string('name'); // Nama armada
            $table->string('license_plate')->unique();
            $table->string('brand')->nullable(); // Merk kendaraan
            $table->year('year')->nullable();
            $table->integer('seat_capacity');
            $table->enum('status', ['available', 'booked', 'maintenance'])->default('available'); // UC10
            $table->json('facilities')->nullable(); // UC11: fasilitas armada (AC, WiFi, TV, etc)
            $table->text('description')->nullable();
            $table->decimal('price_per_day', 15, 2)->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
