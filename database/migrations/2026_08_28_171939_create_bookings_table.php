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
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('booking_code', 50);
            $table->decimal('total_amount');
            $table->enum('status', ['pending','confirmed','cancelled','completed'])->default('pending');
            $table->enum('payment_status', ['unpaid','paid','failed','refunded'])->default('unpaid');
            $table->dateTime('booked_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings_');
    }
};
