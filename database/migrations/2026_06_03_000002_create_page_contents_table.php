<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('page_contents', function (Blueprint $table) {
      $table->id();
      $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
      $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
      $table->string('content_key');
      $table->string('content_type')->default('text');
      $table->longText('content_value')->nullable();
      $table->unsignedInteger('sort_order')->default(0);
      $table->boolean('is_active')->default(true);
      $table->timestamps();

      $table->index(['page_id', 'content_key']);
      $table->index(['page_id', 'sort_order']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('page_contents');
  }
};
