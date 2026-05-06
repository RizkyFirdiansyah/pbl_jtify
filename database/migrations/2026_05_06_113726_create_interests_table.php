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
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('information_id')->constrained('information')->cascadeOnDelete();
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $table->timestamps();

            // Unique constraint: 1 user hanya 1 interest per information
            $table->unique(['user_id', 'information_id']);

            // Index untuk query admin (daftar peminat per informasi)
            $table->index(['information_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interests');
    }
};
