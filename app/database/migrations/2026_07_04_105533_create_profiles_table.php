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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hero_heading');
            $table->text('hero_subheading');
            $table->text('about_paragraph_1');
            $table->text('about_paragraph_2');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('website_url')->nullable();
            $table->unsignedInteger('stats_months_internship')->default(0);
            $table->unsignedInteger('stats_technologies')->default(0);
            $table->unsignedInteger('stats_percent_learning')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
