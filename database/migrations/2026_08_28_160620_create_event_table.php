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
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->unique()->constrained('vendor_profiles')->cascadeOnDelete();
            $table->foreignId('category_id')->unique()->constrained('cotegories')->cascadeOnDelete();
            $table->string('tittle');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('poster');
            $table->string('venue_name');
            $table->text('venue_address');
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', [ 'draft','published','cancelled','completed'])->default('draft');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
