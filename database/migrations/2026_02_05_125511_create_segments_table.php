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
        Schema::create('segments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programmes')->onDelete('cascade');
            $table->foreignId('departure_id')->constrained('etapes')->onDelete('cascade');
            $table->foreignId('arrival_id')->constrained('etapes')->onDelete('cascade');
            $table->decimal('tariff', 8, 2);
            $table->float('distance_in_km');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segments');
    }
};
