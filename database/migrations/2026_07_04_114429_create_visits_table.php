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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->string('path');
            $table->text('user_agent')->nullable();
            $table->string('referer')->nullable();
            $table->string('visitor_cookie', 36)->nullable();
            $table->string('session_id', 100)->nullable();
            $table->timestamps();

            $table->index('visitor_cookie');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
