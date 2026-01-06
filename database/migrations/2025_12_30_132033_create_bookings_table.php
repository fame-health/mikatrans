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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();
            $table->foreignId('schedule_id')->nullable()->constrained('vehicle_schedules')->nullOnDelete();

            // Data pelanggan
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->text('customer_address')->nullable();

            // Detail pemesanan
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_days');
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->text('special_request')->nullable();

            // Pricing
            $table->decimal('price_per_day', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->decimal('dp_amount', 15, 2)->default(0); // Down Payment
            $table->decimal('remaining_amount', 15, 2)->default(0);

            // Status
            $table->enum('status', [
                'pending',
                'confirmed',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('pending'); // UC13: Mengubah status booking

            $table->enum('payment_status', [
                'unpaid',
                'dp_paid',
                'fully_paid'
            ])->default('unpaid');

            $table->text('cancellation_reason')->nullable(); // UC14
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
