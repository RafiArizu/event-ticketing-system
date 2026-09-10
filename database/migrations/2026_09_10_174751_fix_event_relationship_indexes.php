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
        
    Schema::table('events', function (Blueprint $table) {
        $table->dropForeign(['vendor_id']);
        $table->dropForeign(['category_id']);

        $table->dropUnique('events_vendor_id_unique');
        $table->dropUnique('events_category_id_unique');

        $table->index('vendor_id');
        $table->index('category_id');

        $table->foreign('vendor_id')
            ->references('id')
            ->on('vendor')
            ->cascadeOnDelete();

        $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->cascadeOnDelete();
    });

    Schema::table('ticket_categories', function (Blueprint $table) {
        $table->dropForeign(['event_id']);
        $table->dropUnique('ticket_categories_event_id_unique');
        $table->index('event_id');

        $table->foreign('event_id')
            ->references('id')
            ->on('events')
            ->cascadeOnDelete();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
