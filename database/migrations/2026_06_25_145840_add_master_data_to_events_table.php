<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('event_type_id')->constrained('event_types')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->dropColumn(['type', 'city']);
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->string('city')->nullable();
            $table->dropForeign(['event_type_id']);
            $table->dropForeign(['city_id']);
            $table->dropColumn(['event_type_id', 'city_id']);
        });
    }
};
