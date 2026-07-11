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
        Schema::create('experience_entries', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['work', 'education', 'note']);
            $table->string('title');
            $table->string('organization')->nullable();
            $table->string('period_label')->nullable();
            $table->json('bullets')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_entries');
    }
};
